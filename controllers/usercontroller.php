<?php
class UserController{
    //The index action that is run when user visits asd.com/user
    public function indexAction(){
        require_once "./views/index.php";
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
        $whereClause = array(
            "username" => $_POST['username']
        );
        //
        $user_details = $db->query_where('users', $whereClause);
       // echo $user_details['password'];
        if ( password_verify($_POST['password'], $user_details['password']) ) {
            $_SESSION['status'] = "logged_in";
            $_SESSION['user_id'] = $user_details['user_id'];
            var_dump($_SESSION);
            echo "<a href='account'>Account</a>";
            if(isset($_SESSION['status'])){
                echo "log out";
            }
        }else{
            echo "wrong password";
        }

        //$getPasswordStm = $db->prepare("SELECT password FROM users WHERE username = :username");

        /*if($getPasswordStm->execute()){
            if($getPasswordStm->rowCount() == 1){
                $stored_password = $getPasswordStm->fetchColumn(0);
                if ( password_verify($password, $stored_password) ){
                    $loginStm = $db->prepare("SELECT user_id, username, password, user_role_id FROM users
                              WHERE username = :username AND password = :password");
                    $loginStm->bindParam(':username' , $username , PDO:: PARAM_STR);
                    $loginStm->bindParam(':password' , $stored_password, PDO:: PARAM_STR);
                    if($loginStm->execute()){
                        if($loginStm->rowCount() == 1){
                            $_SESSION['status'] = "loggedin";
                            $_SESSION['user_id'] = $loginStm->fetchColumn(0);
                            //$_SESSION['username'] = $username;
                            //$_SESSION['user_role'] = $loginStm->fetchColumn(3);// 3 is the index of field in the statement
                            $_SESSION['user_role'] = get_privileges($_SESSION['user_id'], $db);
                            $_SESSION['username'] = get_username($_SESSION['user_id'], $db);
                            return true;
                        }else{ return false; }
                    }else{ echo "Login query execution failed!"; }
                }
            }
        }else{ echo "Password match query execution failed!"; }*/
    }

    public function accountAction(){
        include './views/account.php';
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