<?php

if (isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {

    $to_email = $_REQUEST['email'];

    if (\App\Repository\UserRepository::checkIfExistsEmail($to_email)) {

        $_SESSION['forgotPassword:email:correct'] = 'Na podany adres email został wysłany link z resetowaniem hasła'; // Poprawny adres email

        $key = randomString(12);

        $_SESSION['resetPassword:email'] = $to_email;
        $_SESSION['resetPassword:key'] =  $key;

        // Wysłanie wiadomości - START
        $link = 'http://localhost/home-budget/public/index.php?action=resetPassword&email=' . $to_email . '&key=' . $key;
        $now = date('Y-m-d H:i:s');
        $subject = "[HomeBudget] Reset hasła";
        $message = '
        <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
                Otrzymaliśmy wiadomość, że zapomniałeś hasła do serwisu HomeBudget. <br><br>
                Oto link do wygenerowania nowego hasła: <br><br>    
                <a href = ' . $link . '>' . $link . '</a> <br><br>
                <b>Jeżeli to nie ty wysłałeś prośbę o reset hasła, prosimy o niekliknięcie w link, gdyż to spowoduje zresetowanie twojego hasła. Prosimy również o usunięcie tej wiadomości.</b><br><br>
                Prośba o reset hasła została wysłana  ' . $now . '. <br><br>
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

        // if (mail($to_email, $subject, $message, $headers)) {
        //     echo "Email successfully sent to $to_email...";
        // } else {
        //     echo "Email sending failed...";
        // }

        // Wysłanie wiadomości - KONIEC

    } else {
        $_SESSION['error:forgotPassword:email'] = 'Podane adres email nie jest zarejestowany w naszym systemie'; // Brak podanego adresu email w bazie danych
    }
}
