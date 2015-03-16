<?php
class Message extends Controller{

    public function index(){

    }

    public function read($username){
        $user = new User();
        $receiver_id = $user->getUserid($username);

        if (empty($username)){
            $error = new Error();
            $error->message();
        }else{
            $db = Database::getInstance();
            $sql = "SELECT sender_id, content, sent_at FROM messages
                    WHERE (sender_id =:logged_in AND receiver_id =:profile_id)
                    OR (sender_id =:profile_id2 AND receiver_id =:logged_in2)
                    ORDER BY sent_at ASC";
            $params = [
                'logged_in' => $_SESSION['user_id'],
                'profile_id' => $receiver_id,
                'profile_id2' => $receiver_id,
                'logged_in2' => $_SESSION['user_id']
            ];
            $data['msgs'] = $db->query_sql($sql, $params);
            $data['to'] = $username;
            //var_dump($data);
            $this->view('messages', $data);
        }
    }

    public function send($to = ''){
        //insert
        $user = new User();
        $receiver_id = $user->getUserid($to);
        $db = Database::getInstance();
        $data = array(
            "content" => $_POST['msg_content'],
            "sender_id" => $_SESSION['user_id'],
            "receiver_id" => $receiver_id
        );
        $db->insert('messages', $data);
        header('location:http://localhost/mvc_app/public/message/read/' . $to );
    }

}