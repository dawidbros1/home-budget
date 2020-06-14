<?php

namespace App\Controller;

class CategoryController
{
    public static function addCategory()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
            header('Location: ./index.php?action=addCategory');

            global $currentUser;

            $_SESSION['category:info'] = "Dodano kategorię";
            $category = new \App\Model\Category;
            $category->setName($_REQUEST['name']);
            $category->setUser_id($currentUser->getId());
            \App\Repository\CategoryRepository::save($category);
        }

        require_once __DIR__ . '/../View/Category/addCategory.php';
    }

    public static function editCategory()
    {
        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        header('Location: ./index.php?action=listCategories');

        if (
            isset($_REQUEST['name']) && !empty($_REQUEST['name']) &&
            isset($_REQUEST['id']) && !empty($_REQUEST['id'])
        ) {
            $names = $_REQUEST['name'];
            $ids = $_REQUEST['id'];

            for ($i = 0; $i < count($names); $i++) {
                $category = \App\Repository\CategoryRepository::getCategoryById($ids[$i]);

                if ($category[0] != NULL) {
                    $category[0]->setName($names[$i]);
                    \App\Repository\CategoryRepository::save($category[0]);
                }
            }
        }
    }

    public static function listCategory()
    {

        if (!\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
            header('Location: ./index.php?action=start');
            exit();
        }

        require_once __DIR__ . '/../View/Category/listCategories.php';
    }
}
