<?php
session_start();
$firstname = $_SESSION['Firstname']/*"Jens"*/;
$lastname = $_SESSION['Lastname'];
$address = $_SESSION['Address']; ?>
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="profile.css">
		<link rel="stylesheet" href="login-register.css">
		<meta charset="utf-8">
		<title>profile</title>
	</head>
	<body>
	<div class="nav">
    <div class="dropdown">
      <span><a href="home.php"><img src="logo.svg" height="50px" width="50px"/></a></span>
      <div class="dropdown-content">
        <a href="login.php">Login</a><br>
        <a href="shop.php">Shop</a>
      </div>
    </div>
    <div class="dropdown2">
			<span><a href="#"><img src="profile.png" height="50px" width="50px"/></a></span>
			<div class="dropdown-content2">
				<a href="#">Profile</a><br>
				<a href="#">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="#"><img src="basket.ico" height="50px" width="50px"/></a>
		</div>
	</div>
		<div class="bread-container">
      <div class="profile-edit">
        <div class="profile-icon">
					<img src="profile.png" height="100px" width="100px"/>
				</div>
				<div class="vl">
				</div>
				<div class="profile-table">
		          <form action="" method="post">
		          <input type='text' placeholder=<?php echo $firstname?> name="firstname" id='firstname' maxlength="50" value="" />
							<br><br>
							<input type='text' placeholder=<?php echo $lastname?> name="lastname" id='lastname' maxlength="50" value="" />
							<br><br>
							<input type='text' placeholder=<?php echo $address?> name="address" id='address' maxlength="50" value="" />
				</div>
				<input type="submit" name="Submit" class="profile-edit-button" value="Sumbit changes"/>
      </div>
		</div>
	</body>
</html>