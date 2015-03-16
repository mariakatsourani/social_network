<?php
class User extends Controller{

    private $userModel;

    public function __contsruct(){
        //create a user model and populate it
        //$this->userModel = $this->model('user');

        //var_dump($this->userModel);
        //$user->name = $name;
        //echo $user->name;

    }

    public function index($username = ''){
        $this->view('login_register', []);
        //$this->profile($username);
        //header('location:profile/' . $username);
    }

    public function register(){
        $db = Database::getInstance();
        $data = array(
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_BCRYPT)
        );
        $db->insert('users', $data);
        $this->view('login_register', []);
    }

    public function login(){
        $db = Database::getInstance();
        $fields = array('user_id', 'password');
        $whereClause = array('username' => $_POST['username']);
        $result = $db->query_where('users', $fields, $whereClause, 'AND');
        if (count($result) == 1){//if we only get 1 result from db then user exists
            $user_details = $result[0];//the result array contains an array with fields retrieved from db
            if ( password_verify($_POST['password'], $user_details['password']) ) {
                $_SESSION['status'] = "logged_in";
                $_SESSION['user_id'] = $user_details['user_id'];
                //echo $this->getUsername($_SESSION['user_id']);
                //$this->profile($this->getUsername($_SESSION['user_id']));
                header('Location: /mvc_app/public/user/profile/');
            }else{
                echo "wrong password";
            }
        }
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        header('Location: /mvc_app/public/user/');
    }

    public function profile($username = ''){
        if (empty($username)){
           if ($this->isLoggedin()){
               $username = $this->getUsername($_SESSION['user_id']);

           }else{//todo
               echo "profile does not exist";
               //$error = new Error();
              //$error->notFound();
           }
        }/**/
        $db = Database::getInstance();
        $fields = ['user_id', 'username', 'email', 'registration_date', 'joke', 'image'];
        $where = ['username' => $username];
        $result = $db->query_where('users', $fields, $where, 'AND');
        if($result){
            $data = $result[0];
        }
        //$data = $result ? $result[0] : [];
        //return $result[0];

            /*$data = [
                 'username'             => $username,
             'email'                => '',
             'joke'                 => '',
             'registration_date'    => '' ];*/
        $this->view('profile', $data);
    }

    public function edit(){
        $db = Database::getInstance();
        $sql = "UPDATE users SET joke =:new_joke
                WHERE user_id =:logged_in";
        $params = ['new_joke' => $_POST['new_joke'],
                   'logged_in' => $_SESSION['user_id']
        ];
        $db->query_sql($sql, $params);
        header('location:http://localhost/mvc_app/public/user/profile/');
    }

    public function isLoggedin(){
        return (isset($_SESSION['status']) == 'logged_in') ? true : false;
    }

    public function getUsername($user_id){
        $db = Database::getInstance();
        $fields = array('username');
        $where = array('user_id' => $user_id);
        $result = $db->query_where('users', $fields, $where, 'AND');
        if($result){
            return $result[0]['username'];
        }
    }

    public function getUserid($username){
        $db = Database::getInstance();
        $result = $db->query_where('users', ['user_id'], ['username' => $username], 'AND');
        if($result){
            return $result[0]['user_id'];
        }
    }


}