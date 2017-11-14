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
          <input type='text' placeholder="username" name="username" id='username' maxlength="50" value="" required/>
          <br>
          <br>
          <input type='password' placeholder="password" name="password" id='password' maxlength="50" value="" required/>
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
