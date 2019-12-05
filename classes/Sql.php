<?php

class Sql extends PDO
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=php7db', 'root', 'Server45Server7AGCD');
    }

    private function setParams($statement, $params = array())
    {
        foreach ($params as $key => $value) {
            $this->setParam($statement,$key, $value);
        }
    }

    private function setParam($statement, $key, $value)
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->connection->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;

    }

    public function select($rawQuery, $params = array())
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($rawQuery, $params = array())
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt;
    }

}
