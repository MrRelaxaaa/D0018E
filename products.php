<?php
include 'functions.php';
$link = db_con();
check_sess();
if(isset($_SESSION['usern'])){
	$username2 =  $_SESSION['usern'];
}
$param_comment = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 $param_kundnr = "(SELECT Kundnr FROM logins WHERE Username = '".$username2."')";
   $param_comment = ($_POST["Comment"]);
	 $prod_id = $_SESSION['product_id'];
   $sql = "INSERT INTO comments (Produktnr, Comment, Added, Kundnr) VALUES ($prod_id, '$param_comment', now(), $param_kundnr)";
	 echo $sql;
   (mysqli_query($link, $sql));
  //Close db connection
  mysqli_close($link);
	header("Location: products.php?viewProduct=$prod_id");
}
?>
<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/productpage.css">
		<meta charset="utf-8">
		<title>Product</title>
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
				<a href="redirect.php?page=profile.php">Profile</a><br>
				<a href="logout.php">Logout</a>
			</div>
		</div>
		<div class="cart">
			<a href="redirect.php?page=shopping-cart.php"><img src="images/basket.ico" height="50px" width="50px"/></a>
		</div>
	</div>
		<div class="bread-container">
      <?php getProductpage(); ?>
      <div class="write-comment">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <textarea placeholder="Write a comment!" rows="5" cols="60" name="Comment" id='Comment' value="<?php echo $param_comment?>"></textarea>
				<input type="submit" name="Submit" class="add-comment"/>
      </div>
			<?php getProductComment(); ?>
		</div>
	</body>
</html>
