<?php

namespace App\Model;

abstract class Model
{
    public static function getConnection()
    {
        global $dbConfig;
        $user = $dbConfig['user'];
        $pass = $dbConfig['pass'];
        $dbname = $dbConfig['name'];
        $host = $dbConfig['host'];

        try {
            $db = new \PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $user, $pass);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $db->query('SET NAMES utf8');
        } catch (\PDOException $error) {
            echo $error->getMessage();
            exit('Database error');
        }
        return $db;
    }
}
