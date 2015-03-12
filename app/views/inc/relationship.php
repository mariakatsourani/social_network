<div id="relationship">

<?php //check relationship between logged in user and profile_id
$user = new User();
$profile_id = $user->getUserid($data['username']);
$profile_id = $profile_id['user_id'];

if($_SESSION['user_id'] != $profile_id){ //check if it is the logged in users' profile-handled with includes as well

    $friendship = new Friendship();
    $result = $friendship->getFriendship($profile_id);
    if(!empty($result)){
        $result = $result[0];
    }

    echo "<ul>";

    if(empty($result)){
        echo "<li><a href=''>Add Friend</a></li>";
    }else{
        if ($result['state'] == 1){
            if($result['requested_by'] == $profile_id){
                echo "<li><a href='http://localhost/mvc_app/public/friendship/accept/'>Accept request</a></li>";
            }else{
                echo "<li><a href='' class='not-active'>Waiting for response</a></li>";
            }
        }else if ($result['state'] == 2){
            echo "<li><a href='http://localhost/mvc_app/public/friendship/delete/'>Delete friend</a></li>";
            echo "<li><a href='http://localhost/mvc_app/public/message/'>Send Message</a></li>";
        }
    }

    echo "</ul>";
}

?>

</div>
