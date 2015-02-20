<?php
class DatabaseModel {
    private $_connection;
    private static $_instance;

    private function __construct(){
        $dsn = 'mysql:dbname=social_network;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $this->_connection = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

    public static function getInstance(){
        if(!self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getConnection(){
        return $this->_connection;
    }

    public function query($table, $data){
        $stm = $this->_connection->prepare("SELECT * FROM users");
        $stm->execute();
        $result = $stm->fetchAll();
        var_dump($result);
    }

    public function getAllUsers(){
        $stm = $this->_connection->prepare("SELECT * FROM users");
        $stm->execute();
        $result = $stm->fetchAll();
        var_dump($result);
    }


}