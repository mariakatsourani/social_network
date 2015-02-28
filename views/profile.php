<?php $pageTitle = "Account settings";
include 'inc/overall/header.php';
include("/views/inc/aside.php");

/*$fields = array('username', 'email', 'registration_date', 'joke');
$where = array('user_id' => $_SESSION['user_id']);
$result = $db->query_where('users', $fields, $where);
$user_info = $result[0];*/
$cont = new UserController();
//echo "user:" . $GLOBALS["username_in_path"] ;//**********************************
$user_info = $cont->showUserAction();
//var_dump($user_info);

//echo $user->userExists($GLOBALS['username_in_path']);

//if not friend show add friend

//if state 1 show friend request sent && you have sent requset

//if state 1 show accept friend request && you have received requset

//if state 2 -> friends sens message / delete friend

?>

<div id="profile">
    <div id="profile_pic">
        <?php
            if(empty($user_info['image'])) {
                echo "<img src='/social_network/views/img/profile_images/default_profile.png'/>";
            }else{
                echo "<img src='/social_network/views/img/profile_images/" . $user_info['image'] . "/>'";
            }
        ?>
    </div>

    <div id="profile_info">

        <div class="details"><?php echo $user_info['username']; ?></div>
        <div class="details"><?php echo $user_info['email']; ?></div>
        <div class="details">Member since: <?php echo $user_info['registration_date']; ?></div>
    </div>

    <div class="clear"></div>

    <div id="profile_joke">
        <?php echo $user_info['joke'];
            if ($user_info['user_id'] != $_SESSION['user_id']){
                include '/inc/relationship.php';
            }
        ?>
    </div>
</div>

<?php include 'inc/overall/footer.php' ?>