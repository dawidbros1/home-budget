<?php

if (isset($_REQUEST['email']) && !empty($_REQUEST['email']) && isset($_REQUEST['key']) && !empty($_REQUEST['key'])) {

    $to_email = $_REQUEST['email'];
    $key = $_REQUEST['key'];

    if (\App\Repository\UserRepository::checkIfExistsEmail($to_email)) {

        if (isset($_SESSION['resetPassword:email']) && isset($_SESSION['resetPassword:key']) && $to_email == $_SESSION['resetPassword:email'] && $key == $_SESSION['resetPassword:key']) {

            // session_destroy();
            unset($_SESSION['resetPassword:email']);
            unset($_SESSION['resetPassword:key']);

            $user = App\Repository\UserRepository::getUserByEmail($to_email);

            if ($user != null) {
                $password = randomString(12);
                $user->setPassword(md5($password));
                \App\Repository\UserRepository::save($user);
                $subject = "[HomeBudget] Nowe hasło";

                $userName = removeCharsAfterMonkey($to_email);

                $message = '
                    <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            Witaj ' . $userName . ', <br><br>
                            Chcieliśmy Cię poinformować, że Twoje hasło do serwisu HomeBudget zostało zresetowane. <br><br>
                            Twoje nowe hasło to: ' . $password . ' <br><br>
                            Zalecamy zalogowanie się w serwisie HomeBudget i zmianę hasła. <br><br>
                            Ta wiadomość została wysłana autoamtycznie, więc prosimy o nie odpowiadnia na nią. <br><br>
                            Pozdrowienia, <br>
                            HomeBudget 
                        </body>
                    </html>
                    ';

                $headers = "From: sender\'s email";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                mail($to_email, $subject, $message, $headers);
            }
        } else {
            header("Location: index.php?action=welcome");
            exit();
        }
    }
} else {
    header("Location: index.php?action=welcome");
    exit();
}
