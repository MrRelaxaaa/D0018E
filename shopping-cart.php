<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cart.css">
		<meta charset="utf-8">
		<title>Shopping Cart</title>
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
      <div class="shopping-cart">
        <div class="asset-image">
          <img src="bikes/bike2.jpeg" width="174px" height="130px"/>
        </div>
        <div class="asset-desc">
          <h1>Giant 1</h1>
          <p>Central suspension</p>
        </div>
        <div class="asset-desc">
          <h1>Price</h1>
          <p>14999:-</p>
        </div>
        <div class="quantity">
          <h1>Amount</h1>
        <input type="number" name="quantity" min="1" max="10" style="font: 24pt Courier; width: 3ch; height: 1em"/>
      </div>
      <div class="remove">
        <img src="images/remove.png"/>
      </div>
      </div>
      <div class="order">
        <div class="sub-total">
          <h1>Total</h1>
          <p>12999:-</p>
        </div>
        <input type="submit" name="Submit" class="order-button" value="Order"/>
      </div>
		</div>
	</body>
</html>
