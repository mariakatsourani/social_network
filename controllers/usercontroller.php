<?php
class UserController{
    //The index action that is run when user visits asd.com/user
    public function indexAction(){
        require_once "./views/index.php";
    }

    public function registerAction($db){
        //todo stergios
        $conn = $db->getConnection();
        $stm = $conn->prepare("SELECT * FROM users");
        $stm->execute();
        $result = $stm->fetchAll();
        var_dump($result);
    }

    public function loginAction(){
        //todo stergios
    }

    public function logoutAction(){
        //todo stergios
    }

    public function sendFriendRequestAction(){
        //todo maria
    }

    public function acceptFriendRequestAction(){
        //todo maria
    }

    public function rejectFriendRequestAction(){
        //todo maria
    }
}