<?php
$pageTitle = $data['username'] . "s Profile";
include 'inc/overall/header.php';
include 'inc/aside.php';
?>

<div id="profile">
    <div id="profile_info">

        <div class="details" id="profile_pic">
            <?php
            if(empty($user_info['image'])) {
                echo "<img src='/mvc_app/public/img/profile_images/default_profile.png'/>";
            }else{
                echo "<img src='/mvc_app/public/img/profile_images/" . $user_info['image'] . "'/>";
            }/**/
            ?>
        </div>

        <div class="details"><?php echo $data['username'];?></div>
        <div class="details"><?php echo $data['email']; ?></div>
        <div class="details">Member since: <?php echo $data['registration_date']; ?></div>

        <div class="details">
            <form id="edit_joke" method="post" action="http://localhost/mvc_app/public/user/edit/">
                <textarea name="new_joke"> <?php echo $data['joke']; ?> </textarea>
                <input type="submit" name="edit" value="Save" />
            </form>
    </div>

    </div>

<?php
    if ($data['user_id'] != $_SESSION['user_id']){
        include '/inc/relationship.php';
    }
?>

</div>

<?php include 'inc/overall/footer.php' ?>