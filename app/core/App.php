<?php

class App{

    protected $controller = 'home'; //contains the controller object
    protected $method = 'index'; //contains the method of the controller
    protected $params = []; //if any params stored here

    public function __construct(){
        $url = $this->parseUrl();

        //does the controller file exist
        if(file_exists('../app/controllers/' . $url[0] . '.php')){
            $this->controller = $url[0]; //replace the home controller
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        //does the method exist in the given controller
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1]; //replace the index method
                unset($url[1]);
            }
        }

        //if $url has values rebase array and pass it
        //else the $url is empty pass an empty array
        $this->params = $url ? array_values($url) : [];

        //uses the controller obj to call the method in that controller and passes the param array
        call_user_func_array([$this->controller, $this->method], $this->params);
        //var_dump($this->params);
    }

    public function parseUrl(){//protected
        if(isset($_GET['url'])){
            /*$url = rtrim($_GET['url'], DIRECTORY_SEPARATOR);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url, FILTER_SANITIZE_URL);
            return $url;*/
            return $url = explode('/', filter_var( rtrim($_GET['url'],DIRECTORY_SEPARATOR ), FILTER_SANITIZE_URL) );
        }
    }
}