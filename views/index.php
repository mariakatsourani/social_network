<!doctype html>
<html>
	<head>
		<title><?php echo $pageTitle ?></title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<header>
			<div id="top">
				<div id="logo">
					<h3><a href="index.php">joke it</a></h3>
				</div>
				
				<nav>
					<ul>
						<li><input type="text" id="search_button"  placeholder=" Search more jokes..."/></li>
						<li><a href="profile.php">Profile</a></li>
						<li><a href="dashboard.php">Dashboard</a></li>
						<li><a href="account.php">Account</a></li>
						<li><span id="line"></span></li>
						<li><a href="signIn.php">log out</a></li>
					</ul>
				</nav>
				<div id="clear"></div>
				<div id="container">
					<aside>
						<ul>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</aside>
					<div class="content">
						<div id="login">
					        <h2>Login Form:</h2>
					        <form action="./user/login" method="post">
					            <input type="text" name="email" placeholder="email" />
					            <input type="password" name="password" placeholder="password" />
					            <input type="submit" value="Login" name="submit"/>
					        </form>
					    </div>

					    <div id="register">
					        <h2>Register Form:</h2>
					        <form action="./user/register" method="post">
					            <input type="text" name="username" placeholder="your name" />
					            <input type="text" name="email" placeholder="email" />
					            <input type="password" name="password1" placeholder="password" />
					            <input type="password" name="password2" placeholder="repeat password" />
					            <input type="submit" value="Register" name="submit"/>
					        </form>
   						</div>
					</div>
				</div>
			</div>
		</header>
		<footer>
		</footer>
	</body>
</html>