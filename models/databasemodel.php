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
        $fields = '';
        end($data); // move the internal pointer to the end of the array
        $lastElement = key($data); // fetches the key of the element pointed to by the internal pointer

        if ($data == "*"){
            $fields = "*";
        }else if ($this->isAssoc($data)){
            foreach($data as $key => $value){
                $fields .= $key;
                if ($key != $lastElement){
                    $fields .= ", ";
                }
            }
        }else{
            foreach($data as $key => $value){
                $fields .= $value;
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

    function isAssoc($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    public function formatConditions($data){
        $conditions = '';
            end($data);
            $lastElement = key($data);
            foreach($data as $field => $value){
                $conditions .= $field . "='" . $value . "'";
                if ($field != $lastElement){
                    $conditions .= " AND ";
                }
            }
        //var_dump($conditions);
        //echo $conditions;
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
        //echo "INSERT INTO" .  $table . " (" . $fields .")VALUES " . $values;
        $insertStm = $this->_connection->prepare("INSERT INTO $table ($fields) VALUES $values");
        $this->checkStmSuccess($insertStm);
    }

    public function query_where($table, $fields, $conditions){
        $fields = $this->formatFields($fields);
        $whereClause = $this->formatConditions($conditions);
        //echo "SELECT " . $fields . " FROM " . $table . " WHERE " . $whereClause;
        $queryStm = $this->_connection->prepare("SELECT $fields FROM $table WHERE $whereClause");
        $this->checkStmSuccess($queryStm);
        $result = $queryStm->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }

    public function update($table, $data, $conditions){//todo
        $fieldsValues = $this->formatForUpdate($data);
        $conditions = $this->formatConditions($conditions);
        $updateStm = $this->_connection->prepare("UPDATE $table SET $fieldsValues $conditions");
        $this->checkStmSuccess($updateStm);
    }

    public function delete($table, $conditions){//todo
        $conditions = $this->formatConditions($conditions);
        $deleteStm = $this->_connection->prepare("DELETE FROM $table $conditions");
        $this->checkStmSuccess($deleteStm);
    }

}