<?php

class Controller {
    public function model($model){//protected
        //file check
        require_once '../app/models/' . $model . '.php';
        echo "bla";
        $obj = new $model();
        var_dump($obj);
        return $obj;
        //return new $model();

    }

    public function view($view, $data){
        //file check
        require_once '../app/views/' . $view . '.php';
    }
}