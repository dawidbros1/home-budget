<?php

namespace App\Controller;

class ProductController
{
    public static function addProduct()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        if (
            isset($_REQUEST['name']) && !empty($_REQUEST['name']) &&
            isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id']) &&
            isset($_REQUEST['price']) && !empty($_REQUEST['price'])
        ) {
            header('Location: ./index.php?action=addProduct');

            if (\App\Repository\CategoryRepository::checkIfIsThereCategoryById($_REQUEST['category_id'])) {
                global $currentUser;
                $_SESSION['info'] = "Dodano produkt";
                $product = new \App\Model\Product;
                $product->setName($_REQUEST['name']);
                $product->setCategory_id($_REQUEST['category_id']);
                $product->setPrice($_REQUEST['price']);
                $product->setUser_id($currentUser->getId());
                \App\Repository\ProductRepository::save($product);
            }
        }

        require_once __DIR__ . '/../View/Product/addProduct.php';
    }

    public static function editProduct()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        header('Location: ./index.php?action=listProducts');

        if (
            isset($_REQUEST['name']) && !empty($_REQUEST['name']) &&
            isset($_REQUEST['id']) && !empty($_REQUEST['id']) &&
            isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id']) &&
            isset($_REQUEST['edited']) && !empty($_REQUEST['edited']) &&
            isset($_REQUEST['price']) && !empty($_REQUEST['price'])
        ) {
            $names = $_REQUEST['name'];
            $ids = $_REQUEST['id'];
            $category_id = $_REQUEST['category_id'];
            $price = $_REQUEST['price'];
            $edited = $_REQUEST['edited'];

            for ($i = 0; $i < count($names); $i++) {
                if ($edited[$i] == 1) {
                    $product = \App\Repository\ProductRepository::getProductById($ids[$i]);
                    $product = $product[0];

                    if ($product != NULL) {
                        $product->setName($names[$i]);
                        $product->setCategory_id($category_id[$i]);
                        $product->setPrice($price[$i]);
                        \App\Repository\ProductRepository::save($product);
                    }
                }
            }
        }
    }

    public static function listProducts()
    {

        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        require_once __DIR__ . '/../View/Product/listProducts.php';
    }
}
