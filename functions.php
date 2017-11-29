<?php
function db_con(){
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'eshop');

  /* Attempt to connect to MySQL database */
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  return $link;
}
// Check connection

function check_sess(){
  if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
  }
}

function getitems(){
  /* Attempt to connect to MySQL database */
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $_SESSION['dblink'] = $link;
  $getitems = "select * from assets";

  $run_getitems = mysqli_query($link, $getitems);


  while ($row_items=mysqli_fetch_array($run_getitems)){

      $product_id = $row_items['Produktnr'];
      $product_title = $row_items['Name'];
      $product_price = $row_items['Price'];
      $product_img = $row_items['image'];
      $product_desc = $row_items['Description'];

      echo "
            <figure class='product-container'>
      			<img src='$product_img'/>
      				<figcaption>
        			<h1>$product_title</h1>
        				<p>$product_desc</p>
        				<div class='price'>
          				$product_price:-
        				</div>
    						<br>
                <a href='shop.php?addCart=$product_id'><button class='add-cart'>Add to cart</button></a>
              </figure>
          ";
  }
}

function getOrder(){
  /* Attempt to connect to MySQL database */
  check_sess();
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $getUsern = $_SESSION['usern'];
  $getId = "(SELECT Kundnr FROM logins WHERE Username='$getUsern')";
  $getProdnr = "select Produktnr from shoppingcart where Kundnr = ($getId)";
  $run_getProdnr= mysqli_query($link, $getProdnr);
  $implode_getProdnr = "";
  while($rowitems = mysqli_fetch_array($run_getProdnr)){
     $prod = $rowitems['Produktnr'];
     $getAssets = "SELECT * FROM assets WHERE Produktnr = $prod";
     $run_getAssets= mysqli_query($link, $getAssets);
    while ($row_items=mysqli_fetch_array($run_getAssets)){

        $product_id = $row_items['Produktnr'];
        $product_title = $row_items['Name'];
        $product_price = $row_items['Price'];
        $product_img = $row_items['image'];
        $product_desc = $row_items['Description'];

        echo "
                <div class='shopping-cart'>
                  <div class='asset-image'>
                    <img src='$product_img' width='174px' height='130px'/>
                  </div>
                  <div class='asset-desc'>
                    <h1>$product_title</h1>
                    <p>$product_desc</p>
                  </div>
                  <div class='asset-desc'>
                    <h1>Price</h1>
                    <p>$product_price:-</p>
                  </div>
                  <div class='quantity'>
                    <h1>Amount</h1>
                  <input type='number' name='quantity' min='1' max='10' style='font: 24pt Courier; width: 3ch; height: 1em'/>
                </div>
                <div class='remove'>
                  <img src='images/remove.png'/>
                </div>
                </div>
            ";
    }
    }
}

function cart(){
  if($_SESSION['inloggad'] !== '#'){
    $getUsern = $_SESSION['usern'];
    if(isset($_GET['addCart'])){
      $prod_id = $_GET['addCart'];
      $getId = "(SELECT Kundnr FROM logins WHERE Username='$getUsern')";
      $addcart = "INSERT INTO shoppingcart (Kundnr, Produktnr, QTY) VALUES ($getId, $prod_id, 1)";
      mysqli_query($_SESSION['dblink'], $addcart);
    }
  }
}

function getProfile($username, $link){
  //include 'config.php';
  //  echo $link;
  $query = "SELECT firstname, lastname, address FROM users WHERE Kundnr = (SELECT Kundnr FROM logins WHERE Username = '" . $username . "')";
  #test log in : Echo "Logged in as: " .$username2;
  $test = (mysqli_query($link, $query));
	while($kundnr = mysqli_fetch_assoc($test)){
 		$firstname = $kundnr['firstname'];
 		$lastname = $kundnr['lastname'];
 		$address = $kundnr['address'];
  }
  $out['f'] = $firstname;
  $out['l'] = $lastname;
  $out['a'] = $address;
  return $out;
}
?>
