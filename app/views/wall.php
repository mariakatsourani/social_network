<?php $pageTitle = "Your Wall" ?>

<?php include 'inc/overall/header.php';
include 'inc/aside.php';
?>

<div id="wall">

<?php
foreach($data as $entry) {  ?>

    <div class="friends_status">
        <div class="user_pic_small"><img src='/mvc_app/public/img/profile_images/default_profile.png'/></div>
        <div class="username"><a href="http://localhost/mvc_app/public/user/profile/<?php echo $entry['username']?>"><?php echo $entry['username']?><a/></div>
        <div class="joke"><?php echo $entry['joke']?></div>
    </div>

<?php
}//end foreach
?>

</div>

<?php include 'inc/overall/footer.php' ?>