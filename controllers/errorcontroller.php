<?php
class ErrorController{
    public function indexAction(){
        echo "some unknown error! please try again!";
    }

    public function notFoundAction(){
        require_once "./views/404.html";
    }

    public function urlErrorAction(){
        echo "your URL is not valid!";
    }
}