<?php

    class Database {
        private static $instance = null;
        private $connection;
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "stock_management";

        private function __construct() {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            if(mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
            }
        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new Database();
            }
            return self::$instance;
        }

        public function getConnection() {
            return $this->connection;
        }
    }

?>