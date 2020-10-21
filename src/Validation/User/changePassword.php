<?php

if (
    isset($_REQUEST['password_old']) && !empty($_REQUEST['password_old']) &&
    isset($_REQUEST['password_new']) && !empty($_REQUEST['password_new']) &&
    isset($_REQUEST['password_confirm_new']) && !empty($_REQUEST['password_confirm_new'])
) { // Czy jest wysłany formularz
    global $currentUser;

    $oldPassword = $_REQUEST['password_old'];
    $newPassword = $_REQUEST['password_new'];
    $confirmNewPassowrd = $_REQUEST['password_confirm_new'];
    $error = false;

    $oldPasswordHash = md5($oldPassword);

    if ($oldPasswordHash != $currentUser->getPassword()) {
        $_SESSION['error:changePassword:password:old'] = 'Stare hasło zostało błędnie wpisane';
        $error = true;
    }

    if ($newPassword != $confirmNewPassowrd) {
        $_SESSION['error:changePassword:password:unique'] = 'Podane hasła nie są takie same';
        $error = true;
    }

    if (!checkIfLengthOfStringIsBetweenNumbers($newPassword, 4, 17)) {
        $_SESSION['error:changePassword:password:length'] = 'Hasło musi zawierać od 5 do 16 znaków';
        $error = true;
    }

    if ($currentUser->getPassword() == md5($newPassword)) {
        $_SESSION['error:changePassword:password:same'] = 'Stare oraz nowe hasło są jednakowe';
        $error = true;
    }

    if (!$error) {
        header("Location: index.php?action=changePassword");
        $_SESSION['info'] = "Twoje hasło zostało zmienione";
        $currentUser->setPassword(md5($newPassword));
        \App\Repository\UserRepository::save($currentUser);
        exit();
    }
}
