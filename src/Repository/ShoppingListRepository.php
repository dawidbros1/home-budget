<?php

namespace App\Repository;

class ShoppingListRepository extends \App\Model\Model
{
    public function createObjectByData($data)
    {

        if ($data == NULL) {
            return NULL;
        }

        $categories[] = new \App\Model\ShoppingList;

        foreach ($data as $key => $simpleDataGame) {
            $shoppingList = new \App\Model\ShoppingList;
            $shoppingList->setId($simpleDataGame['id']);
            $shoppingList->setProduct_id($simpleDataGame['product_id']);
            $shoppingList->setPrice($simpleDataGame['price']);
            $shoppingList->setAmount($simpleDataGame['amount']);
            $shoppingList->setDate($simpleDataGame['date']);
            $shoppingList->setUser_id($simpleDataGame['user_id']);
            $shoppingList->setDiscount($simpleDataGame['discount']);

            $shoppingLists[$key] = $shoppingList;
        }

        return $shoppingLists;
    }

    public function getShoppingListById($id)
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM shopping_list WHERE user_id = :user_id AND id = :id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $currentUser->getId(), \PDO::PARAM_INT);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $shoppingList = self::createObjectByData($result);
        return $shoppingList;
    }

    public function deleteShoppingListById($id)
    {
        $db = self::getConnection();
        $sql = 'DELETE FROM shopping_list WHERE id = :id';
        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function checkIfItIsMyShoppingList($id)
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM shopping_list WHERE id = :id AND user_id = :user_id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->bindValue(':user_id', $currentUser->getId(), \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfIsThereShoppingListById($id)
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM shopping_list WHERE id = :id";
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

    public function getAllShoppingListForCurrentUser()
    {
        global $currentUser;

        $db = self::getConnection();
        $sql = "SELECT * FROM shopping_list WHERE user_id = :user_id";
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

    public function getAllShoppingListByProductId($product_id)
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM shopping_list WHERE product_id = :product_id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':product_id', $product_id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result) {
            $products = self::createObjectByData($result);
            return $products;
        } else {
            return false;
        }
    }

    public function getMinDate()
    {
        $db = self::getConnection();
        $sql = "SELECT date FROM shopping_list";
        $statement = $db->prepare($sql);
        $statement->execute();
        $dates = $statement->fetchAll();

        if ($dates) {

            $minDate = date_create($dates[0]['date']);
            $minDate = date_format($minDate, 'Y');;


            foreach ($dates as $date) {
                $date = date_create($date['date']);
                $year = date_format($date, 'Y');

                if ($minDate > $year) {
                    $minDate = $year;
                }
            }
            return $minDate;
        } else {
            return false;
        }
    }

    public function getAllShoppingListByProductIdWithDate($product_id, $year, $month)
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM shopping_list WHERE product_id = :product_id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':product_id', $product_id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        $array = [];

        if ($result) {
            $products = self::createObjectByData($result);

            foreach ($products as $product) {
                $date = date_create($product->getDate());
                $pYear = date_format($date, 'Y');
                $pMonth = date_format($date, 'm');

                if ($pYear == $year && $pMonth == $month) {
                    array_push($array, $product);
                }
            }

            return $array;
        } else {
            return false;
        }
    }

    public function getAllShoppingListForCurrentUserWithFullDate($date)
    {
        global $currentUser;
        $db = self::getConnection();
        $sql = "SELECT * FROM shopping_list WHERE user_id = :user_id AND date = :date";
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $currentUser->getId(), \PDO::PARAM_INT);
        $statement->bindValue(':date', $date, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();

        $products = self::createObjectByData($result);

        if ($products) {
            return $products;
        } else {
            return false;
        }
    }

    public function save($shoppingList)
    {
        $db = self::getConnection();

        if ($shoppingList->getId() !== null) {
            $statement = $db->prepare('UPDATE shopping_list SET 
                product_id = :product_id,
                price = :price,
                amount = :amount,
                date = :date,
                user_id = :user_id,
                discount = :discount
                WHERE id = :id');
            $statement->bindValue(':id', $shoppingList->getId(), \PDO::PARAM_INT);
        } else {
            $statement = $db->prepare('INSERT INTO shopping_list VALUES (NULL,:product_id,:price,:amount,:date,:user_id,:discount)');
        }

        $statement->bindValue(':product_id', $shoppingList->getProduct_id(), \PDO::PARAM_INT);
        $statement->bindValue(':price', $shoppingList->getPrice(), \PDO::PARAM_STR);
        $statement->bindValue(':amount', $shoppingList->getAmount(), \PDO::PARAM_STR);
        $statement->bindValue(':user_id', $shoppingList->getUser_id(), \PDO::PARAM_INT);
        $statement->bindValue(':date', $shoppingList->getDate(), \PDO::PARAM_STR);
        $statement->bindValue(':discount', $shoppingList->getDiscount(), \PDO::PARAM_STR);
        $statement->execute();
    }
}
