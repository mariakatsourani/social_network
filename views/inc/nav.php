<?php
$user = new UserController();
$username = $user->getUsername($_SESSION['user_id']);
?>

<nav>
    <ul>
        <li><input type="text" id="search_button"  placeholder=" Search more jokes..."/></li>
        <li><a href="wall">Wall</a></li>
        <li><a href="<?php echo $username['username'];?>">My profile</a></li>
        <li><span id="line"></span></li>
        <li><a href="logout">Log out</a></li>
    </ul>
</nav>