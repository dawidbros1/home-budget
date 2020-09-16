<?php

namespace App\Repository;

class CategoryRepository extends \App\Model\Model
{
    public static function createObjectByData($data)
    {

        if ($data == NULL) {
            return NULL;
        }

        $categories[] = new \App\Model\Category;

        foreach ($data as $key => $simpleDataGame) {
            $category = new \App\Model\Category;
            $category->setId($simpleDataGame['id']);
            $category->setName($simpleDataGame['name']);
            $category->setUser_id($simpleDataGame['user_id']);
            $categories[$key] = $category;
        }

        return $categories;
    }

    public static function getCategoryById($id)
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM categories WHERE user_id = :user_id AND id = :id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $currentUser->getId(), \PDO::PARAM_INT);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $category = self::createObjectByData($result);
        return $category;
    }

    public static function checkIfIsThereCategoryById($id)
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM categories WHERE id = :id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllCategoriesForCurrentUser()
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM categories WHERE user_id = :user_id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $currentUser->getId(), \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $categories = self::createObjectByData($result);
        return $categories;
    }

    public static function save($category)
    {
        $db = self::getConnection();

        if ($category->getId() !== null) {
            $statement = $db->prepare('UPDATE categories SET 
                name = :name,
                user_id = :user_id
                WHERE id = :id');
            $statement->bindValue(':id', $category->getId(), \PDO::PARAM_INT);
        } else {
            $statement = $db->prepare('INSERT INTO categories VALUES (NULL,:name,:user_id)');
        }

        $statement->bindValue(':user_id', $category->getUser_id(), \PDO::PARAM_STR);
        $statement->bindValue(':name', $category->getName(), \PDO::PARAM_STR);
        $statement->execute();
    }
}
