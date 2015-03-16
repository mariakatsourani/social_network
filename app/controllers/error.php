<?php
class Error extends Controller{

    protected $errors = [];

    public function index(){
        echo "Some error occurred";
    }

    public function add($newError){
        $this->errors[] = $newError;
    }

    public function message(){
        echo "Could not send message.";
    }

    public function notLoggedin(){
        echo "Sorry you have to login to do that!";
    }

    public function notFound(){
        echo "This page was not found";
    }

}