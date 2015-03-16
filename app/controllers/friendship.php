<?php
class Friendship extends Controller{

    public function index(){

    }

    public function wall(){
        $data = $this->getAll();
        $this->view('wall', $data);
    }

    public function getAll(){
        $db = Database::getInstance();

        //get all friend ids
        $getFriendships = "SELECT requested_by, received_by FROM friendships
                WHERE (requested_by =:logged_in OR received_by =:logged_in2)
                AND state = 2";
        $params = ['logged_in' => $_SESSION['user_id'],
            'logged_in2' => $_SESSION['user_id']];
        $friends = $db->query_sql($getFriendships, $params);
        foreach($friends as $friend){
            foreach($friend as $value){
                if ($value != $_SESSION['user_id']){
                    $friend_ids[] = $value;
                }
            }
        }
        //get friend info
        foreach($friend_ids as $key => $friend_id) {
            $getJokes = "SELECT username, joke FROM users WHERE user_id = :friend_id";
            $params = ['friend_id' => $friend_id];
            $result = $db->query_sql($getJokes, $params);
            $data[] = $result[0];
        }
        return $data;
    }


    private function friendshipExists($username = ''){
        $db = Database::getInstance();

        $user = new User();
        $profile_id = $user->getUserid($username);

        $sql = "SELECT * from friendships
                WHERE (requested_by =:logged_in and received_by =:profile_id )
                OR (requested_by =:profile_id2 and received_by =:logged_in2 )";
        $params = [
            'logged_in' => $_SESSION['user_id'],
            'profile_id' => $profile_id,
            'profile_id2' => $profile_id,
            'logged_in2' => $_SESSION['user_id']
        ];
        $result = $db->query_sql($sql, $params);
        if($result){
            //var_dump($result[0]);
            return $result[0];
        }else{
            //echo "false";
            return false;
        }
    }

    public function add($username = ''){
        $db = Database::getInstance();

        $user = new User();
        $profile_id = $user->getUserid($username);

        $sql = "SELECT NULL from friendships WHERE (requested_by =:logged_in and received_by =:profile_id )
                OR (requested_by =:profile_id2 and received_by =:logged_in2 )";
        $params = [
            'logged_in' => $_SESSION['user_id'],
            'profile_id' => $profile_id,
            'profile_id2' => $profile_id,
            'logged_in2' => $_SESSION['user_id']
        ];
        $result = $db->query_sql($sql, $params);
        //var_dump($result);

        if($result){
            echo "friendship exists. Cannot add friend.";
        }else if($profile_id == $_SESSION['user_id']){
            $error = new Error();
            $error->index();
        }//else if username does not exist
        else{
            //
            $data = [
                'requested_by' => $_SESSION['user_id'],
                'received_by' => $profile_id
            ];
            $db->insert('friendships', $data);
            header('location:http://localhost/mvc_app/public/user/profile/' . $username);
        }

    }

    public function accept($username = ''){
        $result = $this->friendshipExists($username);

        if($result){
            if($result['state'] == 1){
                if($result['requested_by'] == $_SESSION['user_id']){
                    echo "You are the one who requested to be friends with this person.";
                }else{
                    $db = Database::getInstance();
                    $sql = "UPDATE friendships SET state = 2
                            WHERE requested_by =:profile_id AND received_by =:logged_in";
                    $params = [
                        'profile_id'=> $result['requested_by'],
                        'logged_in'=> $_SESSION['user_id']
                    ];
                    $db->query_sql($sql, $params);
                    header('location:http://localhost/mvc_app/public/user/profile/' . $username);
                }
            }else if($result['state'] == 2){
                echo "you are already friends with this user.";
            }
        }else{
            echo "No friendship exists.";
        }
    }

    public function delete($username = ''){
        $db = Database::getInstance();
        $result = $this->friendshipExists($username);

        $sql = "DELETE FROM friendships
                WHERE friendship_id =:fr_id";
        $params = ['fr_id' => $result['friendship_id']];

        $db->query_sql($sql, $params);
        header('location:http://localhost/mvc_app/public/user/profile/' . $username);
    }

    public function getFriendship($profile_id){
        $db = Database::getInstance();
        $sql = "SELECT requested_by, received_by, state FROM friendships
                WHERE (requested_by = :logged_in OR received_by = :logged_in2)
                AND (requested_by = :profile OR received_by = :profile2)";
        $params = [
            'logged_in' => $_SESSION['user_id'],
            'logged_in2' => $_SESSION['user_id'],
            'profile' => $profile_id,
            'profile2' => $profile_id
        ];
        $results = $db->query_sql($sql, $params);
        return $results;
    }
}