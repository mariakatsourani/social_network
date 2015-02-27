<?php
class UserController{
    //The index action that is run when user visits asd.com/user
    public function indexAction(){
        if (!$this->isLoggedin()){
            require_once './views/index.php';
        }else{
            //header('Location: /social_network-stergiosbranch/user/profile/');
           $this->profileAction();//redirect to profile if logged in
        }
    }

    public function profileAction(){
        $this->protected_page('profile');
        //require_once './views/profile.php';
    }

    public function wallAction(){
        $this->protected_page('wall');
    }

    public function messagesAction(){
        $this->protected_page('messages');
    }

    public function isLoggedin(){
        return (isset($_SESSION['status']) == 'logged_in') ? true : false;
    }

    public function protected_page($page){
        if (!$this->isLoggedin()){
            //$this->indexAction();
            header('Location: /social_network-stergiosbranch/user/');
        }else{
            require_once './views/' . $page . '.php';
        }
    }

    //LOGIN, REGISTER, LOGOUT
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
                $_SESSION['status'] = "logged_in";
                $_SESSION['user_id'] = $user_details['user_id'];
                $this->profileAction();
                //header('Location: /social_network-stergiosbranch/user/profile/');
            }else{
                echo "wrong password";
            }
        }
    }

    public function logoutAction(){
        $_SESSION = array();
        session_destroy();
        $this->indexAction();
    }

    //FRIEND REQUEST
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