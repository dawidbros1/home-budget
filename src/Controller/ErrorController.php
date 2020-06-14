<?php

namespace App\Controller;

// Error list:
// 0 Blokada konta
// 1 Brak uprawnień
// 2 Dostep wyłącznie po zalogowaniu się
// 3 Nie wypełniony formularz - Błąd w formularzu
// 4 Brak zasobów (np: brak gier lub użytkowników) zawartość jest pusta
// 5 
// 6
// 7
// 8
// 9

class ErrorController
{
    public static function sendError($number)
    {

        switch ($number) {
            case 0: {
                    \App\Controller\AuthController::logout();

                    require_once __DIR__ . '/../View/Error/accountIsDisabled.php';
                    break;
                }

            case 1: {
                    require_once __DIR__ . '/../View/Error/notAuthorized.php';
                    break;
                }

            case 2: {
                    require_once __DIR__ . '/../View/Error/loginRequired.php';
                    break;
                }

            case 3: {
                    require_once __DIR__ . '/../View/Error/formNotCompleted.php';
                    break;
                }

            case 4: {
                    require_once __DIR__ . '/../View/Error/contentIsEmpty.php';
                    break;
                }

            case 5: {
                    require_once __DIR__ . '/../View/Error/contentDoesNotExist.php';
                    break;
                }
        }
    }
}
