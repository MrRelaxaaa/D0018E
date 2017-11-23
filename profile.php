<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//var_dump($_SESSION);

$Firstname['Firstname'] = "";
$Lastname['Lastname'] = "";
$Addres['Address'] = "";
$username2 =  $_SESSION['usern'];
Echo "Inloggad som: " .$username2;
require_once 'config.php';
$query = "SELECT Firstname, Lastname, Address FROM users WHERE Kundnr = (SELECT Kundnr FROM logins WHERE Username = '" . $username2 . "')";

$test = (mysqli_query($link, $query));
	while($kundnr = mysqli_fetch_assoc($test)){
 		$Firstname['Firstname'] = $kundnr['Firstname'];
 		$Lastname['Lastname'] = $kundnr['Lastname'];
 		$Address['Address'] = $kundnr['Address'];
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
		<title>profile</title>
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
		          <form action="" method="post">
		          <input type='text' placeholder="<?php echo $Firstname['Firstname']?>" name="firstname" id='firstname' maxlength="50" value="" />
							<br><br>
							<input type='text' placeholder="<?php echo $Lastname['Lastname']?>" name="lastname" id='lastname' maxlength="50" value="" />
							<br><br>
							<input type='text' placeholder="<?php echo $Address['Address']?>" name="address" id='address' maxlength="50" value="" />
				</div>
				<input type="submit" name="Submit" class="profile-edit-button" value="Sumbit changes"/>
      </div>
		</div>
	</body>
</html>
