<<<<<<< HEAD
=======
<?php
include 'functions.php';
db_con();
check_sess();
?>
>>>>>>> Sprint3
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
<<<<<<< HEAD
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="products.css">
		<meta charset="utf-8">
		<title>test</title>
=======
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/products.css">
		<meta charset="utf-8">
		<title>Shop</title>
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
		</div>
	</div>
		<div class="bread-container">
			<figure class="product-container">
  			<img src="bike3.jpg" />
  				<figcaption>
    			<h1>Giant 1</h1>
    				<p>Giant down-hill bike.</p>
    				<div class="price">
      				14.999:-
    				</div>
						<br>
						<input type="submit" name="Submit" class="add-cart" value="Add to cart"/>
			</figure>

			<figure class="product-container">
  			<img src="bike2.jpeg" />
  				<figcaption>
    			<h1>Giant 1</h1>
    				<p>Giant down-hill bike.</p>
    				<div class="price">
      				12.499:-
    				</div>
						<br>
						<input type="submit" name="Submit" class="add-cart" value="Add to cart"/>
			</figure>

			<figure class="product-container">
  			<img src="bike3.jpg" />
  				<figcaption>
    			<h1>Giant 1</h1>
    				<p>Giant down-hill bike.</p>
    				<div class="price">
      				14.999:-
    				</div>
						<br>
						<input type="submit" name="Submit" class="add-cart" value="Add to cart"/>
			</figure>
=======
			<span><a href="#"><img src="images/profile.png" height="50px" width="50px"/></a></span>
			<div class="dropdown-content2">
				<a href="redirect.php?page=profile.php">Profile</a><br>
				<a href="logout.php">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="redirect.php?page=shopping-cart.php"><img src="images/basket.ico" height="50px" width="50px"/></a>
		</div>
	</div>
		<div class="bread-container">
			<?php getitems(); ?>
      <?php addCart(); ?>
>>>>>>> Sprint3
		</div>
	</body>
</html>
