<?php

class Database
{
    const HOST = "localhost";
    const DBNAME = "news";
    const USER = "root";
    const PASS = "";

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO(sprintf("mysql:host=%s;dbname=%s", self::HOST, self::DBNAME), self::USER, self::PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $this->conn->query("set names utf8");
    }

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }

    public function select($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetchAll();
    }

    public function selectSingle($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetch();
    }

    public function insert($sql, $params)
    {
        $this->execute($sql, $params);
    }

    public function update($sql, $params)
    {
        $this->execute($sql, $params);
    }

    public function delete($sql, $params = [])
    {
        $this->execute($sql, $params);
    }

    private function execute($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
