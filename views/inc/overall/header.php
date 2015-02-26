<!doctype html>
<html>
	<?php //include 'inc/head.php' ?>
            <head>
                <title><?php echo $pageTitle ?></title>
                <link rel="stylesheet" type="text/css" href="views/css/main.css">
                <link rel="stylesheet" type="text/css" href="views/css/content.css">
                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
            </head>


	<body>
        <?php
            //$user = new UserController();
            //echo "here:";
           // var_dump($db);
           //$user->registerAction($db);
        ?>
            <?php //include 'inc/header.php' ?>
                    <header>
            <div id="top">
                <div id="logo">
                    <img src="views/img/joke.png"/>
                </div>

                <?php
                ?>
                <nav>
                    <ul>
                        <li><input type="text" id="search_button"  placeholder=" Search more jokes..."/></li>
                        <li><a href="wall.php">Wall</a></li>
                        <li><a href="account.php">Account</a></li>
                        <li><span id="line"></span></li>
                        <li><a href="index.php">log out</a></li>
                    </ul>
                </nav>

            </div>
            <div id="clear"></div>
        </header>

                    <div id="container">
            <?php //include 'inc/aside.php' ?>
                    <!--<aside>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </aside>-->

                        <div class="content">
