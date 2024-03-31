<?php

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $this->connection = mysqli_connect("localhost", "root", "", "webphim");
        // $this->connection = mysqli_connect("	sql111.infinityfree.com", "if0_36275262", "834zst2y", "if0_36275262_webphim");

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
