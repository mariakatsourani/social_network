<?php
class ErrorController{
    public function indexAction(){
        echo "An unknown error occured!";
    }

    public function notFoundAction(){
        require_once "./views/404.html";
    }

    public function urlErrorAction(){
        echo "This URL is not valid!";
    }
}