<?php
include 'functions.php';
check_sess();
?>
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="css/main.css">
		<meta charset="utf-8">
		<title>Home</title>
	</head>
	<body>
		<div class="nav">
	    <div class="dropdown">
	      <span><a href="home.php"><img src="images/logo.svg" height="50px" width="50px"/></a></span>
	      <div class="dropdown-content">
	        <a href="login.php">Login</a><br>
	        <a href="shop.php">Shop</a>
	      </div>
	    </div>
	    <div class="dropdown2">
				<span><a href="#"><img src="images/profile.png" height="50px" width="50px"/></a></span>
				<div class="dropdown-content2">
					<a href="profile.php">Profile</a><br>
					<a href="logout.php">Logout</a>
				</div>
			</div>
			<div class="cart">
				<a href="#"><img src="images/basket.ico" height="50px" width="50px"/></a>
			</div>
		</div>
		<div class="bread-container">
      <img src="images/logo.svg" height="400px" width="400px"/>
      <br>
      <p>Gertzell-Hultstrand</p>
      <p>est. 2017</p>
		</div>
	</body>
</html>
