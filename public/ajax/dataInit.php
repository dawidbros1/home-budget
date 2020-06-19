<?php

session_start();

require_once __DIR__ . './../../vendor/autoload.php';
require_once __DIR__ . './../../config/config.php';

if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
    \App\Controller\ErrorController::sendError(2);
    exit();
}

$id = $_SESSION['user_id'];
$currentUser = \App\Repository\UserRepository::getCurrentUser();
