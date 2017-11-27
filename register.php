<?php
require_once 'config.php';
$username = $firstname = $lastname = $email = $address = $password = "";
$username_err = $password_err = "";
//Run on post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        //Prepare a select statement
        $sql = "SELECT Username FROM logins WHERE Username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            //Set parameters
            $param_username = trim($_POST["username"]);
            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "UserNIsTaken";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "error line 29";
            }
            mysqli_stmt_close($stmt);
        }
    }
    //Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "EnterPW";
    } elseif(strlen(trim($_POST['password'])) < 3){
        $password_err = "pw<3";
    } else{
        $password = trim($_POST['password']);
    }
    //Dont run if validation error
    if(empty($username_err) && empty($password_err)){
        //Prepare an insert statement
        $sql = "INSERT INTO logins (Username, Password) VALUES (?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            //Set parameters
            $param_username = $username; //trim($_POST["username"]);
            $param_password = $password; //password_hash($password, PASSWORD_DEFAULT);
			if(empty($param_username)){
			echo "$param_username tom";}
            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //Redirect to login page
                header("location: login.php");
            } else{
                echo "Login error line 61";
            }
        }
        //Close statement
        mysqli_stmt_close($stmt);

		//Insert userinfo into users table
		$param_username = trim($_POST["username"]);
		$sql = "INSERT INTO users (Kundnr, Firstname, Lastname, Email, Address) VALUES ((select Kundnr from logins where Username = '".$param_username."'), ?, ?, ?, ?)";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssss", $param_firstname, $param_lastname, $param_email, $param_address);
			$param_firstname = trim($_POST["firstname"]);
			$param_lastname = trim($_POST["lastname"]);
			$param_email = trim($_POST["email"]);
			$param_address = trim($_POST["address"]);
			//$pk = mysqli_fetch_row(mysqli_query($link, "SELECT Kundnr FROM logins WHERE Username = $param"));
			 mysqli_stmt_execute($stmt);
			 mysqli_stmt_close($stmt);
		}
    }
    //Close db connection
    mysqli_close($link);
}
?>
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/login-register.css">
		<meta charset="utf-8">
		<title>Register</title>
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
				<a href="#">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="#"><img src="images/basket.ico" height="50px" width="50px"/></a>
		</div>
	</div>
		<div class="bread-container">
      <div class="registration-box">
        <div class="registration-holder">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <input type='text' placeholder="firstname" name="firstname" id='firstname' maxlength="50" value="<?php echo $firstname; ?>" required/>
          <br>
          <br>
          <input type='text' placeholder="lastname" name="lastname" id='lastname' maxlength="50" value="<?php echo $lastname; ?>" required/>
          <br>
          <br>
          <input type='text' placeholder="username" name="username" id='username' maxlength="50" value="<?php echo $username; ?>" required/>
					<br>
          <br>
          <input type='password' placeholder="password" name="password" id='password' maxlength="50" value="<?php echo $password; ?>" required/>
					<br>
          <br>
          <input type='email' placeholder="e-mail" name="email" id='email' maxlength="50" value="<?php echo $email; ?>" required/>
					<br>
          <br>
          <input type='text' placeholder="address" name="address" id='address' maxlength="50" value="<?php echo $address; ?>" required/>
					<br>
          <br>
          <input type="submit" name="Submit" class="button" value="Register">
        </form>
        </div>
      </div>
		</div>
	</body>
</html>
