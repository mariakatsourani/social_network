<?php $pageTitle = "THIS IS a joke";
include 'inc/overall/header.php';

?>

    <div id="forms">
        <div id="login">

            <form action="login" method="post">
                <ul>
                    <li class="form_titles">Login</li>
                    <li><input type="text" name="username" placeholder="Username" /></li>
                    <li><input type="password" name="password" placeholder="Password" /></li>
                    <li><input type="submit" value="Login" name="submit"/></li>
                </ul>
            </form>
        </div>

        <div id="register">
            <form action="register" method="post">
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

    <div class="clear"></div>

    <div id="errors">
        This is not an actual error!
    </div>

<?php include 'inc/overall/footer.php' ?>