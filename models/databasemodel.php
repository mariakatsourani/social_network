<?php
class DatabaseModel {
    private $_connection;
    private static $_instance;

    private function __construct(){//private to prevent multiple db objects
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

    public function formatFields($data){
        if ($data == "*"){
            $fields = "*";
        }else{
            $fields= '';
            end($data); // move the internal pointer to the end of the array
            $lastElement = key($data); // fetches the key of the element pointed to by the internal pointer

            foreach($data as $key => $value){
                $fields .= $key;
                if ($key != $lastElement){
                    $fields .= ", ";
                }
            }
        }

        return $fields;
    }

    public function formatValues($data){
    $values= '(';
    end($data); // move the internal pointer to the end of the array
    $lastElement = key($data); // fetches the key of the element pointed to by the internal pointer

    foreach($data as $key => $value){
        $values .= "'" . $value . "'";
        if ($key != $lastElement){
            $values .= ", ";
        }else{
            $values .= ")";
        }
    }
    return $values;
}

    public function formatForUpdate($data){
        $fieldsValues= '';
        end($data); // move the internal pointer to the end of the array
        $lastElement = key($data); // fetches the key of the element pointed to by the internal pointer

        foreach($data as $key => $value){
            $fieldsValues .= $key . "='" . $value . "'";
            if ($key != $lastElement){
                $fieldsValues .= ", ";
            }else{
                $fieldsValues .= "";
            }
        }
        return $fieldsValues;
    }

    public function formatConditions($data){
        //todo
        //where
        if(isset($data['where'])){
            $conditions = ' WHERE ';

            end($data['where']);
            $lastElement = key($data['where']);

            foreach($data['where'] as $field => $value){
                $conditions .= $field . "='" . $value . "'";
                if ($field != $lastElement){
                    $conditions .= " AND ";
                }
            }
        }
        //order by
        if(isset($data['order_by'])){

        }
        //limit
        if(isset($data['limit'])){

        }

        return $conditions;
    }

    public function checkStmSuccess($stm){
        if($stm->execute()){
            echo "Successfully executed.";
            return true;
        }else{
            echo "Execution failed.";
            return false;
        }
    }

    public function insert($table, $data){
        $fields = $this->formatFields($data);
        $values = $this->formatValues($data);
        $insertStm = $this->_connection->prepare("INSERT INTO $table ($fields) VALUES $values");
        $this->checkStmSuccess($insertStm);
    }

    public function query($sqlQuery){
        $queryStm = $this->_connection->prepare($sqlQuery);
        $this->checkStmSuccess($queryStm);
        $result = $queryStm->fetchAll();
        var_dump($result);
    }

    public function update($table, $data, $conditions){
        $fieldsValues = $this->formatForUpdate($data);
        $conditions = $this->formatConditions($conditions);
        $updateStm = $this->_connection->prepare("UPDATE $table SET $fieldsValues $conditions");
        $this->checkStmSuccess($updateStm);
    }

    public function delete($table, $conditions){
        $conditions = $this->formatConditions($conditions);
        $deleteStm = $this->_connection->prepare("DELETE FROM $table $conditions");
        $this->checkStmSuccess($deleteStm);
    }

    public function getAllUsers(){
        $stm = $this->_connection->prepare("SELECT * FROM users");
        $stm->execute();
        $result = $stm->fetchAll();
        var_dump($result);
    }


}