<?php
include 'functions.php';
check_sess();
$link = db_con();
if ($_SESSION['usern'] != "root"){
  header("location: home.php");
}
$Name = "Namn";
$Price = "Pris";
$Stock = "Lager";
$Description = "Beskrivning";
//$image = "Bildnamn";
$dir = "bikes/";
//$_FILES["fileToUpload"]["name"] = "";
$fileToUpload = "";
$file = $dir . basename($_FILES["fileToUpload"]["name"]);
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $file = $dir . basename($_FILES["fileToUpload"]["name"]);
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file);
  $Name = $_POST['Name'];
  $Price = $_POST['Price'];
  $Stock = $_POST['Stock'];
  $Description = $_POST['Description'];
  settype($Price, "integer");
  settype($Stock, "integer");
  $sql = "INSERT INTO assets (Name, Price, Stock, Description, image) VALUES ('$Name', $Price, $Stock, '$Description', '$file')";
  echo $sql;
  mysqli_query($link, $sql);
  mysqli_close($link);
}


?>


<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/login-register.css">
<meta charset="utf-8">
<title>ADMIN :O</title>
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
    <a href="logout.php">Logout</a>
  </div>
</div>
</div>
<div class="bread-container">

  <div class="registration-box">
    <div class="registration-holder">
      <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
      <form action="admin.php" method="post" enctype="multipart/form-data">
          <input type='text' placeholder="Name" name="Name" id='Name' maxlength="50" value="<?php echo $Name; ?>" required/>
          <br>
          <br>
          <input type='text' placeholder="Price" name="Price" id='Price' maxlength="50" value="<?php echo $Price; ?>" required/>
          <br>
          <br>
          <input type='text' placeholder="Stock" name="Stock" id='Stock' maxlength="50" value="<?php echo $Stock; ?>" required/>
          <br>
          <br>
          <input type='text' placeholder="Description" name="Description" id='Description' maxlength="50" value="<?php echo $Description; ?>" required/>
          <br>
          <br>
          <!-- <input type='text' placeholder="image" name="image" id='image' maxlength="50" value="<?php echo $image; ?>" required/>
          <br>
          <br> -->
          <input type="file" name="fileToUpload" id="fileToUpload">
          <!-- <input type="submit" value="Upload" name="submit"> -->
          <!-- </form> -->
          <br>
          <br>
          <input type="submit" name="Submit" class="button" value="Lägg till">
    </form>
    </div>
  </div>
</div>

</body>
</html>
