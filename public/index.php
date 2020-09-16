<?php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Function/Session.php';

if (isset($_REQUEST['action'])) {

    if (App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
        $id = $_SESSION['user_id'];
        $currentUser = \App\Repository\UserRepository::getCurrentUser();
    }

    switch ($_REQUEST['action']) {
            // ==== Użytkownik ==== //

        case 'register': {
                \App\Controller\AuthController::registerAction();
                break;
            }

        case 'login': {
                \App\Controller\AuthController::loginAction();
                break;
            }

        case 'logout': {
                \App\Controller\AuthController::logoutAction();
                break;
            }

            // ==== Kategorie ==== //

        case 'addCategory': {
                \App\Controller\CategoryController::addCategory();
                break;
            }

        case 'editCategory': {
                \App\Controller\CategoryController::editCategory();
                break;
            }

        case 'listCategories': {
                \App\Controller\CategoryController::listCategory();
                break;
            }

            // ==== Produkt ==== //

        case 'addProduct': {
                \App\Controller\ProductController::addProduct();
                break;
            }

        case 'editProduct': {
                \App\Controller\ProductController::editProduct();
                break;
            }

        case 'listProducts': {
                \App\Controller\ProductController::listProducts();
                break;
            }
            // ==== Zakupy ==== //

        case 'addShoppingList': {
                \App\Controller\ShoppingListController::addShoppingList();
                break;
            }

        case 'editShoppingList': {
                \App\Controller\ShoppingListController::editShoppingList();
                break;
            }

        case 'listShoppingList': {
                \App\Controller\ShoppingListController::listShoppingList();
                break;
            }

        case 'listShoppingListOnlyView': {
                \App\Controller\ShoppingListController::listShoppingListOnlyView();
                break;
            }

            // ==== Podsumowanie ==== //

        case 'summary': {
                require_once __DIR__ . './../src/view/Summary/summary.php';
                break;
            }

        case 'fullSummary': {
                require_once __DIR__ . './../src/view/Summary/fullSummary.php';
                break;
            }

            // ==== Podstawa ==== //

        case 'start': {
                require_once __DIR__ . './../src/view/start.php';
                break;
            }

        default:
            header('Location: ./index.php?action=start');
            break;
    }
} else {
    header('Location: ./index.php?action=login');
    // echo "else";
}
