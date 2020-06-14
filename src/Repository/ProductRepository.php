<?php

namespace App\Repository;

class ProductRepository extends \App\Model\Model
{
    public function createObjectByData($data)
    {

        if ($data == NULL) {
            return NULL;
        }

        $products[] = new \App\Model\Product;

        foreach ($data as $key => $simpleDataGame) {
            $product = new \App\Model\Product;
            $product->setId($simpleDataGame['id']);
            $product->setName($simpleDataGame['name']);
            $product->setCategory_id($simpleDataGame['category_id']);
            $product->setPrice($simpleDataGame['price']);
            $product->setUser_id($simpleDataGame['user_id']);
            $products[$key] = $product;
        }

        return $products;
    }

    public function getProductById($id)
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM products WHERE user_id = :user_id AND id = :id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $currentUser->getId(), \PDO::PARAM_INT);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $product = self::createObjectByData($result);
        return $product;
    }

    public function checkIfIsThereProductById($id)
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM products WHERE id = :id";
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

    public function getAllProductsForCurrentUser()
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM products WHERE user_id = :user_id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $currentUser->getId(), \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result) {
            $products = self::createObjectByData($result);
            return $products;
        } else {
            return false;
        }
    }

    public function getAllProductsByCategoryId($category_id)
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM products WHERE category_id = :category_id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':category_id', $category_id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result) {
            $products = self::createObjectByData($result);
            return $products;
        } else {
            return false;
        }
    }


    public function save($product)
    {
        $db = self::getConnection();

        if ($product->getId() !== null) {
            $statement = $db->prepare('UPDATE products SET 
                name = :name,
                category_id = :category_id,
                price = :price,
                user_id =:user_id
                WHERE id = :id');
            $statement->bindValue(':id', $product->getId(), \PDO::PARAM_INT);
        } else {
            $statement = $db->prepare('INSERT INTO products VALUES (NULL,:name,:category_id,:price,:user_id)');
        }

        $statement->bindValue(':name', $product->getName(), \PDO::PARAM_STR);
        $statement->bindValue(':category_id', $product->getCategory_id(), \PDO::PARAM_INT);
        $statement->bindValue(':price', $product->getPrice(), \PDO::PARAM_STR);
        $statement->bindValue(':user_id', $product->getUser_id(), \PDO::PARAM_STR);
        $statement->execute();
    }
}
