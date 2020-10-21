<?php


if (
    isset($_REQUEST['email']) &&
    isset($_REQUEST['password'])
) { // Czy jest wysłany formularz

    $user = \App\Repository\UserRepository::findOneByEmailAndPassword($_REQUEST['email'], $_REQUEST['password']);

    if (!$user) {
        $correctEmail = \App\Repository\UserRepository::checkIfExistsEmail($_REQUEST['email']);
        if ($correctEmail) {
            $_SESSION['error:login:password'] = 'Nieprawidłowe hasło';
            $_SESSION['login:email:value'] = $_REQUEST['email'];
        } else {
            $_SESSION['error:login:email'] = 'Niepoprawny adres email';
        }
    } else {
        header('Location: ./index.php?action=listGames');
        $_SESSION['user_id'] =  $user->getId();
    }
}
