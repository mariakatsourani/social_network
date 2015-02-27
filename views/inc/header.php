<header>
	<div id="top">
		<div id="logo">
			<img src="/img/joke.png" />
		</div>

        <?php
        if( (isset($_SESSION['status'])) && ($_SESSION['status'] == "logged_in")) {
            include 'nav.php';
        }else{
            echo "login plz";
        }
        ?>

	</div>
		<div id="clear"></div>
</header>