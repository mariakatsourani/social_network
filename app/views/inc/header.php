<header>
	<div id="top">
		<div id="logo">
			<img src="/social_network/views/img/joke.png" />
		</div>

        <?php
        if( (isset($_SESSION['status'])) && ($_SESSION['status'] == "logged_in")) {
            include 'nav.php';
        }

        ?>

	</div>
		<div class="clear"></div>
</header>