<?php

    class DataBase 
    {
        private $HOST; 
        private $USER; 
        private $PASSWORD;   

        public function __construct(string $host, string $user, string $password)
        {
            $this->HOST = $host;
            $this->USER = $user;
            $this->PASSWORD = $password;

        }

        public function connectDatabase()
        {
            $mysqli = new mysqli($this->HOST, $this->USER, $this->PASSWORD);
            
            if (!$mysqli) {
                return 'Error ' . mysqli_connect_error();
            } else {
                // $mysqli->query("Drop DATABASE my_database");

                $mysqli->query("CREATE DATABASE IF NOT EXISTS my_database;");
                $connect = mysqli_connect($this->HOST, $this->USER, $this->PASSWORD, "my_database");
                return $connect;
            }
        }
    }
 
    $DataBase = new DataBase(HOST,USER,PASSWORD);
    $db = $DataBase->connectDatabase();
?>