<?php
<<<<<<< HEAD
require_once 'config.php';
$username = "";
$password = "";
=======
include 'functions.php';
check_sess();
$link = db_con();
$username = "";
$password = "";
$_SESSION['inloggad'] = "#";
$_SESSION['cart'] = "#";
>>>>>>> Sprint3
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
		//Don't run else statement if no username entered
} elseif(empty(trim($_POST["password"]))){
		//See above
}	else{
	$sql = "SELECT Username, Password FROM logins WHERE (Username, Password) = (?, ?)";
	if($stmt = mysqli_prepare($link, $sql)){
			//Bind params to stmt ($link + $stmt)
<<<<<<< HEAD
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password); 
            //set parameters from post
            $param_username = trim($_POST["username"]);
			$param_password = trim($_POST["password"]);
=======
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            //set parameters from post
            $param_username = trim($_POST["username"]);
			      $param_password = trim($_POST["password"]);
            $_SESSION['usern'] = $param_username;
>>>>>>> Sprint3

            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // store result
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
					$query = "SELECT Firstname, Lastname, Address FROM users WHERE Kundnr = (SELECT Kundnr FROM logins WHERE Username = '" . trim($_POST["username"]) . "')";
<<<<<<< HEAD
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
						
=======


					$test = (mysqli_query($link, $query));
						while($kundnr = mysqli_fetch_assoc($test)){

					 $_SESSION['Firstname'] = $kundnr['Firstname'];
					 $_SESSION['Lastname'] = $kundnr['Lastname'];
					 $_SESSION['Address'] = $kundnr['Address'];
           $_SESSION['inloggad'] = "profile.php";
           $_SESSION['cart'] = "shopping-cart.php";
					 echo $_SESSION['firstname'];
					}
          if ($_SESSION['usern'] != "root"){
					       header("location: home.php");
               }
          else {
            header("location: admin.php");
          }

>>>>>>> Sprint3
                } else{
					mysqli_stmt_close($stmt);
                    echo "User Not Found";
                }
            } else{
<<<<<<< HEAD
				
                echo "error line 38";
            }

            
=======

                echo "error line 38";
            }


>>>>>>> Sprint3
        }
	}
}
?>
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
<<<<<<< HEAD
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="login-register.css">
		<meta charset="utf-8">
		<title>test</title>
=======
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/login-register.css">
		<meta charset="utf-8">
		<title>Login</title>
>>>>>>> Sprint3
	</head>
	<body>
	<div class="nav">
		<div class="dropdown">
<<<<<<< HEAD
			<span><a href="home.php"><img src="logo.svg" height="50px" width="50px"/></a></span>
=======
			<span><a href="home.php"><img src="images/logo.svg" height="50px" width="50px"/></a></span>
>>>>>>> Sprint3
			<div class="dropdown-content">
				<a href="login.php">Login</a><br>
				<a href="shop.php">Shop</a>
			</div>
		</div>
		<div class="dropdown2">
<<<<<<< HEAD
			<span><a href="#"><img src="profile.png" height="50px" width="50px"/></a></span>
			<div class="dropdown-content2">
				<a href="profile.php">Profile</a><br>
				<a href="#">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="#"><img src="basket.ico" height="50px" width="50px"/></a>
=======
			<span><a href="#"><img src="images/profile.png" height="50px" width="50px"/></a></span>
			<div class="dropdown-content2">
				<a href="redirect.php?page=profile.php">Profile</a><br> <!--  "profile.php" -->
				<a href="logout.php">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="#"><img src="images/basket.ico" height="50px" width="50px"/></a>
>>>>>>> Sprint3
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
