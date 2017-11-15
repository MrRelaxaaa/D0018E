<?php
require_once 'config.php';
$username = '';
$password = '';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
	
        
} elseif(empty(trim($_POST["password"]))){
}	else{
	$sql = "SELECT Uname, Pword FROM logins WHERE (Uname, Pword) = (?, ?)";
	if($stmt = mysqli_prepare($link, $sql)){
		
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // Set parameters
            $param_username = trim($_POST["username"]);
			$param_password = trim($_POST["password"]);
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    //$username = trim($_POST["username"]);
					echo "user found";
					//mysqli_stmt_close($stmt);
					/* $sql = "SELECT ID FROM logins where (Uname, Pword) = ($param_username, $param_password)";
					$stmt = mysqli_prepare($link, $sql);
					if(mysqli_stmt_execute($stmt)){
						mysqli_stmt_store_result($stmt);
						//Return user data
					}*/
					
                } else{
                    echo "User Not Found";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
			
            mysqli_stmt_close($stmt);
        }
	}
}

?>
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="test.css">
		<meta charset="utf-8">
		<title>test</title>
	</head>
	<body>

		<div class="dropdown">
			<span><a href="home.php"><img src="logo.svg" height="50px" width="50px"/></a></span>
			<div class="dropdown-content">
				<a href="login.php">Login</a><br>
				<a href="shop.php">Shop</a>
			</div>
		</div>
		<div class="dropdown2">
			<span><a href="#"><img src="profile.png" height="40px" width="40px"/></a></span>
			<div class="dropdown-content2">
				<a href="#">Profile</a><br>
				<a href="#">Logout</a>
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
		<div class="cart-dropup">
			<span><a href="#"><img src="cart.png" height="40px" width="40px"/></a></span>
			<div class="dropup-content">
			</div>
		</div>
	</body>
</html>
