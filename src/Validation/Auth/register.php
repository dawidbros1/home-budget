<?php

if (
    isset($_REQUEST['email']) &&
    isset($_REQUEST['password']) &&
    isset($_REQUEST['confirm_password'])
) { // Czy jest wysłany formularz

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];

    $error = false;

    // Start => Walidacja danych wysłanych przez użytkownika

    if (!isset($_REQUEST['checkbox'])) {
        $_SESSION['error:register:regulations'] = 'Nie zaakceptowano regulaminu';
        $error = true;
    }

    if ($password != $confirm_password) {
        $_SESSION['error:register:password:unique'] = 'Podane hasła nie są takie same';
        $error = true;
    }

    if (strlen($password) < 5 || strlen($password) > 16) {
        $_SESSION['error:register:password:length'] = 'Hasło musi zawierać od 5 do 16 znaków';
        $error = true;
    }

    if (!(\App\Repository\UserRepository::checkUniqueEmail($email))) {
        $_SESSION['error:register:email:unique'] = 'Podany adres email jest już zajęty';
        $error = true;
    }

    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $_SESSION['error:register:email:validate'] = 'Niepoprawny adres email';
        $error = true;
    }

    // Koniec => Walidacja danych wysłanych przez użytkownika

    if (!$error) { // Walidacja danych przebiegła pomyślnie
        header('Location: ./index.php?action=login');

        $_SESSION['register:new:account:info'] = 'Twoje konto zostało założone. Możesz się teraz na nie zalogować';

        $_SESSION['login:email:value'] = $email;

        $hashPassword = md5($password);
        $user = new \App\Model\User;
        $user->setEmail($email);
        $user->setPassword($hashPassword);
        \App\Repository\UserRepository::save($user);

        $category = new \App\Model\Category;
        $category->setName('Nieskategoryzowane');
        $category->setUser_id(\App\Repository\UserRepository::getUserByIdEmail($email));
        \App\Repository\CategoryRepository::save($category);
    }
}
