<?php $pageTitle = "Social Network Joke it" ?>

<?php include 'inc/overall/header.php';
    if(isset($_SESSION['status'])){
        echo "log out";
    }
?>

<div id="forms">
	<div id="login">

        <form action="./user/login" method="post">
            <ul>
                <li class="form_titles">Login</li>
                <li><input type="text" name="username" placeholder="Username" /></li>
                <li><input type="password" name="password" placeholder="Password" /></li>
                <li><input type="submit" value="Login" name="submit"/></li>
            </ul>
        </form>
    </div>

    <div id="register">
        <form action="./user/register" method="post">
            <ul>
                <li class="form_titles">Register</li>
                <li><input type="text" name="username" placeholder="Username" /></li>
                <li><input type="text" name="email" placeholder="Email" /></li>
                <li><input type="password" name="password" placeholder="Password"/></li>
                <li><input type="password" name="confirm_password" placeholder="Confirm Password"/></li>
                <li><input type="submit" value="Register" name="submit"/></li>
            </ul>
        </form>
	</div>
</div>

<?php include 'inc/overall/footer.php' ?>