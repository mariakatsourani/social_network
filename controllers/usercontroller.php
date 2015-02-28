<?php
class UserController{
    //The index action that is run when user visits asd.com/user
    public function indexAction(){
        if (!$this->isLoggedin()){
            require_once './views/login_register.php';
        }else{
            require_once './views/profile.php';
            /*$username = $this->getUsername($_SESSION['user_id']);
            $username = $username['username'];
            $url = 'Location: /social_network/user/' . $username . '/';
            header($url);*/
           //$this->profileAction();//redirect to profile if logged in
        }
    }

    /**/public function profileAction(){
        $this->protected_page('profile');
        //require_once './views/profile.php';
    }

    public function showUserAction(){
        $db = DatabaseModel::getInstance();
        $fields = array('user_id', 'username', 'email', 'registration_date', 'joke', 'image');
        $where = array('username' => $GLOBALS['username_in_path']);//**********************************
        $result = $db->query_where('users', $fields, $where, 'AND');
        return $result[0];
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
            header('Location: /social_network/user/');
        }else{
            require_once './views/' . $page . '.php';
        }
    }

    public function getUsername($user_id){
        $db = DatabaseModel::getInstance();
        $fields = array('username');
        $where = array('user_id' => $user_id);
        $result = $db->query_where('users', $fields, $where, 'AND');
        if($result){
            return $result[0];
        }
    }

    public function getUserid($username){
        $db = DatabaseModel::getInstance();
        $fields = array('user_id');
        $where = array('username' => $username);
        $result = $db->query_where('users', $fields, $where, 'AND');
        if($result){
            return $result[0];
        }
    }

    public function userExists($identifier){
        $db = DatabaseModel::getInstance();
        $where = array('user_id' => $identifier,
            'username' => $identifier,
            'email' => $identifier);
        $result = $db->query_where('users', array('NULL'), $where, 'OR');
        return ($result) ? true : false;
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
        $result = $db->query_where('users', $fields, $whereClause, 'AND');
        if (count($result) == 1){//if we only get 1 result from db then user exists
            $user_details = $result[0];//the result array contains an array with fields retrieved from db
            if ( password_verify($_POST['password'], $user_details['password']) ) {
                $_SESSION['status'] = "logged_in";
                $_SESSION['user_id'] = $user_details['user_id'];
                $this->profileAction();
                //header('Location: /social_network/user/profile/');
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
        echo "hej" . $GLOBALS['username_in_path'];
        /*$to = 13;
        $db = DatabaseModel::getInstance();
        $data = array(
            "requested_by" => $_SESSION['user_id'],
            "received_by" => $to,
            "state" => 1
        );
        $db->insert('friendships', $data);
        */
    }

    public function acceptFriendRequestAction(){
        //todo maria
    }

    public function declineFriendRequestAction(){
        //todo maria
    }
}