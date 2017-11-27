<?php
require_once 'config.php';
require 'getProfileInfo.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//var_dump($_SESSION);
$username2 =  $_SESSION['usern'];
#get profile info

$profile_array = getProfile($username2, $link);

#set profile info

$param_firstname = $profile_array['f'];
$param_lastname = $profile_array['l'];
$param_address = $profile_array['a'];


if($_SERVER["REQUEST_METHOD"] == "POST"){
   $param_firstname = ($_POST["firstname"]);
   $param_lastname = ($_POST["lastname"]);
   $param_address = ($_POST["address"]);
   $sql = "UPDATE users SET firstname='".$param_firstname ."', lastname='".$param_lastname ."',  address='".$param_address ."' WHERE kundnr = (SELECT Kundnr FROM logins WHERE Username = '".$username2."')";
   (mysqli_query($link, $sql));

  //Close db connection
  mysqli_close($link);
}
?>

<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/profile.css">
		<link rel="stylesheet" href="css/login-register.css">
		<meta charset="utf-8">
		<title>Profile</title>
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
				<a href="#">Profile</a><br>
				<a href="logout.php">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="#"><img src="images/basket.ico" height="50px" width="50px"/></a>
		</div>
	</div>
		<div class="bread-container">
      <div class="profile-edit">
        <div class="profile-icon">
					<img src="images/profile.png" height="100px" width="100px"/>
				</div>
				<div class="vl">
				</div>
				<div class="profile-table">
		          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		          <input type='text' value="<?php echo $param_firstname?>" name="firstname" id='firstname' maxlength="50" value="" />
							<br><br>
							<input type='text' value="<?php echo $param_lastname?>" name="lastname" id='lastname' maxlength="50" value="" />
							<br><br>
							<input type='text' value="<?php echo $param_address?>" name="address" id='address' maxlength="50" value="" />
				</div>
				<input type="submit" name="Submit" class="profile-edit-button" value="Sumbit changes"/>
      </div>
		</div>
	</body>
</html>
