<?php
include 'functions.php';
check_sess();
$link = db_con();
if ($_SESSION['usern'] != "root"){
  header("location: home.php");
}
?>


<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/admin.css">
<meta charset="utf-8">
<title>Edit</title>
</head>
<body>
<div class="nav">
  <div class="dropdown2">
    <span><a href="#"><img src="images/profile.png" height="50px" width="50px"/></a></span>
    <div class="dropdown-content2">
      <a href="admin.php">Admin page</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<div class="bread-container">
  <?php editProd(); ?>

  		<link rel="stylesheet" href="css/products.css">
  	</head>
  	<body>
  		<div class="bread-container">
  			<?php showItems(); ?>
  		</div>
  	</body>
</div>
</body>
</html>
