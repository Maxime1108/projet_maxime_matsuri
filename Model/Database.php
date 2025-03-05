<?php

namespace Model;

class Database
{
    private $host = 'localhost';
    private $db = 'japan_shop_db';
    private $username = 'root';
    private $password = '';
    private $database = null;

    public function dbConnect()
    {
        try {
            $pdo = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);

            $this->database = $pdo;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $this->database;
    }
}
