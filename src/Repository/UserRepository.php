<?php

namespace App\Repository;

use App\Model\Model;
use App\Model\User;

class UserRepository extends Model
{
    public static function checkIfUserIsLoggedIn()
    {
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function findOneByEmailAndPassword($email, $password)
    {
        $db = self::getConnection();

        $passHash = md5($password);

        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $statement = $db->prepare($sql);

        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->bindValue(':password', $passHash, \PDO::PARAM_STR);

        $statement->execute();

        $userArray = $statement->fetch();

        if (!$userArray) {
            return null;
        }

        $user = new User();
        $user->setId($userArray['id']);
        $user->setEmail($userArray['email']);
        $user->setPassword(null);

        return $user;
    }


    public static function getUserByEmail($email)
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $db->prepare($sql);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();

        $user = self::createUsersByData($result);
        return $user[0];
    }

    public static function getUserByIdEmail($email)
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $db->prepare($sql);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        $user = self::createUsersByData($result);
        return $user[0]->getId();
    }

    public static function getCurrentUser()
    {
        $db = self::getConnection();
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $_SESSION['user_id'], \PDO::PARAM_INT);
        $statement->execute();

        $userArray = $statement->fetch();

        if (!$userArray) {
            return null;
        }

        $user = new User();
        $user->setId($userArray['id']);
        $user->setEmail($userArray['email']);
        $user->setPassword($userArray['password']);

        return $user;
    }

    public static function createUsersByData($data)
    {

        if ($data == NULL) {
            return NULL;
        }

        $users[] = new \App\Model\User;

        foreach ($data as $key => $simpleDataGame) {
            $user = new \App\Model\User;
            $user->setId($simpleDataGame['id']);
            $user->setEmail($simpleDataGame['email']);
            $user->setPassword(null);

            $users[$key] = $user;
        }

        return $users;
    }

    public static function checkUniqueEmail($email)
    {
        $db = self::getConnection();

        $sql = "SELECT email FROM users WHERE email = :email";
        $statement = $db->prepare($sql);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) == 0) return true;
        else return false;
    }

    public static function checkIfExistsEmail($email)
    {
        $db = self::getConnection();

        $sql = "SELECT email FROM users WHERE email = :email";
        $statement = $db->prepare($sql);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) == 1) return true;
        else return false;
    }

    public static function save($user)
    {
        $db = self::getConnection();

        if ($user->getId() !== null) {
            $statement = $db->prepare('UPDATE users SET 
                email = :email,
                password = :password
                WHERE id = :id');
            $statement->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        } else {
            $statement = $db->prepare('INSERT INTO users VALUES (NULL,:email,:password)');
        }

        $statement->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);

        $statement->execute();
    }
}
