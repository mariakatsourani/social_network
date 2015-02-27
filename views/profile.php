<?php $pageTitle = "Account settings";
include 'inc/overall/header.php';
include("/views/inc/aside.php"); ?>

<div id="profile">
    <div id="profile_pic">
        <img src="/social_network-stergiosbranch/views/img/default_profile.png"/>
    </div>

    <div id="profile_info">
        <?php
            $fields = array('username', 'email', 'registration_date', 'joke');
            $where = array('user_id' => $_SESSION['user_id']);
            $result = $db->query_where('users', $fields, $where);
            $user_info = $result[0];

        ?>
        <div class="details"><?php echo $user_info['username']; ?></div>
        <div class="details"><?php echo $user_info['email']; ?></div>
        <div class="details">Member since: <?php echo $user_info['registration_date']; ?></div>
    </div>

    <div class="clear"></div>

    <div id="profile_joke">
        <?php echo $user_info['joke']; ?>
    </div>
</div>

<?php include 'inc/overall/footer.php' ?>