<?php
require_once 'config.php';
$username = "";
$password = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
		//Don't run else statement if no username entered
} elseif(empty(trim($_POST["password"]))){
		//See above
}	else{
	$sql = "SELECT Username, Password FROM logins WHERE (Username, Password) = (?, ?)";
	if($stmt = mysqli_prepare($link, $sql)){
			//Bind params to stmt ($link + $stmt)
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password); 
            //set parameters from post
            $param_username = trim($_POST["username"]);
			$param_password = trim($_POST["password"]);

            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // store result
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
					$query = "SELECT Firstname, Lastname, Address FROM users WHERE Kundnr = (SELECT Kundnr FROM logins WHERE Username = '" . trim($_POST["username"]) . "')";
					session_start();
					 
					$test = (mysqli_query($link, $query));
						while($kundnr = mysqli_fetch_assoc($test)){
						//mysqli_fetch_row(
					 $_SESSION['Firstname'] = $kundnr['Firstname'];
					 $_SESSION['Lastname'] = $kundnr['Lastname'];
					 $_SESSION['Address'] = $kundnr['Address'];
					 echo $_SESSION['firstname'];
					}

					header("location: profile.php");
						
                } else{
					mysqli_stmt_close($stmt);
                    echo "User Not Found";
                }
            } else{
				
                echo "error line 38";
            }

            
        }
	}
}
?>
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/login-register.css">
		<meta charset="utf-8">
		<title>test</title>
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
				<a href="#">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="#"><img src="images/basket.ico" height="50px" width="50px"/></a>
		</div>
	</div>
		<div class="bread-container">
      <div class="login-box">
        <div class="login-holder">
					<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
          <input type='text' placeholder="username" name="username" id='username' maxlength="50" value="<?php echo $username; ?>" required/>
          <br>
          <br>
          <input type='password' placeholder="password" name="password" id='password' maxlength="50" value="<?php echo $password; ?>" required/>
          <br>
          <br>
          <input type="submit" name="Submit" class="button" value="Login"/>
          <br>
          <br>
          <font color="#DDDDDD">not registered?  </font><a href="register.php"><font color="#4CAF50">Create an account</font></a>
					</form>
        </div>
      </div>
		</div>
	</body>
</html>
