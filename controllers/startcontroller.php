<?php
class StartController{
    //Start controller and index action are what the user see when they visit
    //the root of the site. ex: asd.com
    public function indexAction(){
        //header('Location: /user/');
        require_once "./views/index.php";
    }
}