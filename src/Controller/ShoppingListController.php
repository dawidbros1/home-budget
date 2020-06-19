<?php

namespace App\Controller;

class ShoppingListController
{
    public static function addShoppingList()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        if (
            isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id']) &&
            isset($_REQUEST['price']) && !empty($_REQUEST['price']) &&
            isset($_REQUEST['date']) && !empty($_REQUEST['date']) &&
            isset($_REQUEST['discount']) && !empty($_REQUEST['discount']) &&
            isset($_REQUEST['amount']) && !empty($_REQUEST['amount'])
        ) {
            header('Location: ./index.php?action=addShoppingList');

            global $currentUser;
            $product_id = $_REQUEST['product_id'];
            $price = $_REQUEST['price'];
            $date = $_REQUEST['date'];
            $amount = $_REQUEST['amount'];
            $discount = $_REQUEST['discount'];

            for ($i = 0; $i < count($product_id); $i++) {
                if (\App\Repository\ProductRepository::checkIfIsThereProductById($product_id[$i])) {
                    $shoppingList = new \App\Model\ShoppingList;
                    $shoppingList->setProduct_id($product_id[$i]);
                    $shoppingList->setPrice($price[$i]);
                    $shoppingList->setAmount($amount[$i]);
                    $shoppingList->setDate($date);
                    $shoppingList->setDiscount($discount[$i]);
                    $shoppingList->setUser_id($currentUser->getId());

                    \App\Repository\ShoppingListRepository::save($shoppingList);
                }
            }
        }

        require_once __DIR__ . '/../View/ShoppingList/addShoppingList.php';
    }

    public static function editShoppingList()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        if (
            isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id']) &&
            isset($_REQUEST['price']) && !empty($_REQUEST['price']) &&
            isset($_REQUEST['date']) && !empty($_REQUEST['date']) &&
            isset($_REQUEST['id']) && !empty($_REQUEST['id']) &&
            isset($_REQUEST['discount']) && !empty($_REQUEST['discount']) &&
            isset($_REQUEST['amount']) && !empty($_REQUEST['amount'])
        ) {
            header('Location: ./index.php?action=listShoppingList');

            $product_id = $_REQUEST['product_id'];
            $price = $_REQUEST['price'];
            $date = $_REQUEST['date'];
            $amount = $_REQUEST['amount'];
            $id = $_REQUEST['id'];
            $discount = $_REQUEST['discount'];
            $deleteStatus = $_REQUEST['delete'];

            for ($i = 0; $i < count($product_id); $i++) {
                if ($deleteStatus[$i]) {
                    self::deleteShoppingList($id[$i]);
                } else {
                    if (\App\Repository\ProductRepository::checkIfIsThereProductById($product_id[$i])) {
                        if (\App\Repository\ShoppingListRepository::checkIfIsThereShoppingListById($id[$i])) {
                            $shoppingList = \App\Repository\ShoppingListRepository::getShoppingListById($id[$i]);
                            $shoppingList = $shoppingList[0];
                            $shoppingList->setProduct_id($product_id[$i]);
                            $shoppingList->setPrice($price[$i]);
                            $shoppingList->setAmount($amount[$i]);
                            $shoppingList->setDate($date[$i]);
                            $shoppingList->setDiscount($discount[$i]);
                            \App\Repository\ShoppingListRepository::save($shoppingList);
                        }
                    }
                }
            }
        }

        require_once __DIR__ . '/../View/ShoppingList/listShoppingList.php';
    }

    public static function deleteShoppingList($id)
    {
        if (\App\Repository\ShoppingListRepository::checkIfIsThereShoppingListById($id)) {
            if (\App\Repository\ShoppingListRepository::checkIfItIsMyShoppingList($id)) {
                \App\Repository\ShoppingListRepository::deleteShoppingListById($id);
            }
        }
    }

    public static function listShoppingList()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }
        require_once __DIR__ . '/../View/ShoppingList/listShoppingList.php';
    }

    public static function listShoppingListOnlyView()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }
        require_once __DIR__ . '/../View/ShoppingList/listShoppingListOnlyView.php';
    }
}
