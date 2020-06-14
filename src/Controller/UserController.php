<?php

namespace App\Controller;

class UserController
{

    public function requireLoggedIn()
    {
        if (!(\App\Repository\UserRepository::checkIfUserIsLoggedIn())) {
            \App\Controller\ErrorController::sendError(2);
            exit();
        }
    }

    public function requireAdmin()
    {
        self::requireLoggedIn();

        if (!(\App\Repository\UserRepository::checkRole('admin'))) {
            \App\Controller\ErrorController::sendError(1);
            exit();
        }
    }

    public function requireAdminOrDeveloper()
    {
        self::requireLoggedIn();

        if (!(\App\Repository\UserRepository::checkRole('admin') || \App\Repository\UserRepository::checkRole('developer'))) {
            \App\Controller\ErrorController::sendError(1);
            exit();
        }
    }
}
