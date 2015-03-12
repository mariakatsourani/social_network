<?php
class Friendship extends Controller{

    public function index(){

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

    public function wall(){
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
            //foreach only once call view here
        }
        $this->view('wall', $data);
    }

    public function showAll(){

    }

    public function add(){

    }

    public function accept(){

    }

    public function decline(){

    }

    public function delete(){
        echo "ARE YOU SURE YOU WANT TO DELETE YOUR FRIEND?";
    }

}