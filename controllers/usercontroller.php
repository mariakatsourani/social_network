<?php
class UserController{
    //The index action that is run when user visits asd.com/user
    public function indexAction(){
        require_once "./views/index.php";
    }

    public function accountAction(){
        require_once './views/account.php';
    }

    public function registerAction(){
        $db = DatabaseModel::getInstance();
        $data = array(
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_BCRYPT)
        );
        $db->insert('users', $data);
    }

    public function loginAction(){
        $db = DatabaseModel::getInstance();
        $fields = array('user_id', 'password');
        $whereClause = array('username' => $_POST['username']);
        $result = $db->query_where('users', $fields, $whereClause);
        if (count($result) == 1){//if we only get 1 result from db then user exists
            $user_details = $result[0];//the result array contains an array with fields retrieved from db
            if ( password_verify($_POST['password'], $user_details['password']) ) {
                //session_start();
                $_SESSION['status'] = "logged_in";
                $_SESSION['user_id'] = $user_details['user_id'];
                var_dump($_SESSION);
                echo "<a href='account'>Account</a>";
            }else{
                echo "wrong password";
            }
        }
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