<?php //query to check if friends if friend request exists

$profile_id = $user->getUserid($GLOBALS["username_in_path"]);
$profile_id = $profile_id['user_id'];

$db = DatabaseModel::getInstance();
$where = array(
    'requested_by' => $_SESSION['user_id'],
    'received_by' => $_SESSION['user_id']
);
$results = $db->query_where('friendships', array('requested_by', 'received_by', 'state'), $where, 'OR');
var_dump($results);
echo "user:" . $profile_id;

echo "<ul>";

foreach($results as $result){
    if ( ($result['requested_by'] == $profile_id) || ($result['received_by'] == $profile_id) ){
        if ($result['state'] == 1){
            if($result['requested_by'] == $profile_id){
                echo "<li><a href=''>Accept request...</a></li>";
            }else{
                echo "<li><a href=''>Waiting for response...</a></li>";
            }
        }else if ($result['state'] == 2){
            echo "<li><a href=''>Friends :) Delete from friends</a></li>";
            echo "<li><a href=''>Send Message</a></li>";
        }
        $flag = true;
    }
}

if(!isset($flag)){
    echo "<li><a href=''>Add to Friends</a></li>";
}

echo "</ul>";
