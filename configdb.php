<?php

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $this->connection = mysqli_connect("localhost", "root", "", "webphim");
        mysqli_set_charset($this->connection, "utf8");
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
