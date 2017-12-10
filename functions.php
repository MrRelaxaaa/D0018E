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
      $product_stock = $row_items['Stock'];

      echo "
            <figure class='product-container'>
      			<a href='products.php?viewProduct=$product_id'><img src='$product_img'/></a>
      				<figcaption>
        			<h1>$product_title</h1>
        				<p>$product_desc</p>
        				<div class='price'>
          				$product_price:-
        				</div>
                <p>In stock: $product_stock</p>
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
  $_SESSION['dblink'] = $link;
  $getUsern = $_SESSION['usern'];
  $getId = "(SELECT Kundnr FROM logins WHERE Username='$getUsern')";
  $getProdnr = "SELECT Produktnr, CartID FROM shoppingcart WHERE Kundnr = ($getId)";
  $run_getProdnr= mysqli_query($link, $getProdnr);
  $total_price = 0;
  while($rowitems = mysqli_fetch_array($run_getProdnr)){
     $cart_id = $rowitems['CartID'];
     $prod = $rowitems['Produktnr'];
     $getAssets = "SELECT * FROM assets WHERE Produktnr = $prod";
     $run_getAssets= mysqli_query($link, $getAssets);
    while ($row_items=mysqli_fetch_array($run_getAssets)){

        $product_id = $row_items['Produktnr'];
        $product_title = $row_items['Name'];
        $product_price = $row_items['Price'];
        $product_img = $row_items['image'];
        $product_desc = $row_items['Description'];
        $product_stock = $row_items['Stock'];
        $total_price = $total_price + $product_price;
        $getQTY = "SELECT * FROM shoppingcart WHERE Produktnr=$product_id";
        $quantity = mysqli_query($_SESSION['dblink'], $getQTY);
        $getamount = mysqli_fetch_assoc($quantity);

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
                    <p>$product_price kr</p>
                  </div>
                  <form method='post' action='shopping-cart.php'>
                  <div class='quantity'>
                    <h1>Amount</h1>
                      <input type='number' value=".$getamount['QTY']." name='quantity' min='1' max='$product_stock' style='font: 16pt Courier; width: 3ch; height: 1em'/>
                      <input type='hidden' name='hidden' value='$product_id'></input>
                      <button type='submit' name='set'>set</button>
                </div>
                </form>
                <div class='remove'>
                  <a href='shopping-cart.php?removeCart=$cart_id'><img src='images/remove.png'/></a>
                </div>
                </div>
            ";
            if(isset($_POST['set'])){
              $sql = "UPDATE shoppingcart SET QTY = '$_POST[quantity]' WHERE Produktnr = '$_POST[hidden]'";
              mysqli_query($_SESSION['dblink'], $sql);
            }
    }
  }
  echo "
          <div class='order'>
            <div class='sub-total'>
              <h1>Total</h1>
              <p>$total_price kr</p>
            </div>
            <a href='shopping-cart.php?placeOrder=$getUsern'><input type='submit' class='order-button' value='Order'/></a>
          </div>
  ";
}

function getProductpage(){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $_SESSION['dblink'] = $link;
  if(isset($_GET['viewProduct'])){
    $prod_id = $_GET['viewProduct'];
    $_SESSION['product_id'] = $prod_id;
    $get_prod = "SELECT * FROM assets WHERE Produktnr=$prod_id";
    $run_get_prod= mysqli_query($link, $get_prod);
    while ($row_items=mysqli_fetch_array($run_get_prod)){

       $product_id = $row_items['Produktnr'];
       $product_title = $row_items['Name'];
       $product_price = $row_items['Price'];
       $product_img = $row_items['image'];
       $product_desc = $row_items['Description'];
       $product_stock = $row_items['Stock'];
       $product_likes = $row_items['likes'];
       $product_dislikes = $row_items['dislikes'];

       echo "
               <div class='product-container'>
                 <div class='img-container'>
                   <img src='$product_img'/>
                   <div class='product-description'>
                     <h1>$product_title</h1>
                     </div>
                 </div>
                <div class='vl'></div>
                 <div class='product-description'>
                   <p>$product_desc</p>
                   <p>In stock: $product_stock</p>
                   <p>$product_price kr</p>
                   <div class='product-rating-icon'>
                   <a href='likehelper.php?liked=like'><img src='images/up.png'/></a>
                   <a href='likehelper.php?liked=dislike'><img src='images/down.png'/></a>
                   <br>
                   <p>$product_likes liked | $product_dislikes disliked</p>
                   </div>
                   <a href='shop.php?addCart=$product_id'><button class='add-cart'>Add to cart</button></a>
                 </div>
               </div>
       ";
     }
  }
}

function getProductComment(){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $_SESSION['dblink'] = $link;
  if(isset($_GET['viewProduct'])){
    $prod_id = $_GET['viewProduct'];
    $get_comment = "SELECT * FROM comments WHERE Produktnr=$prod_id";
    $run_get_comment= mysqli_query($link, $get_comment);
    while ($row_items=mysqli_fetch_array($run_get_comment)){
        $user_id = $row_items['Kundnr'];
        $comment = $row_items['Comment'];
        $created_at = $row_items['Added'];
        $get_username = "SELECT Username FROM logins WHERE Kundnr=$user_id";
        $run_get_username= mysqli_query($link, $get_username);
        while ($row_items=mysqli_fetch_array($run_get_username)){
          $username = $row_items['Username'];
          echo"
                <div class='view-comments'>
                  <div class='comment-info'><div class='user-icon'><img src='images/profile.png'/></div><div class='user-info'>$username</div><div class='user-date'>$created_at pm</div></div>
                  <div class='comment'>$comment</div>
                </div>
          ";
        }
    }
  }
}

function addCart(){
  if($_SESSION['inloggad'] !== '#'){
    $getUsern = $_SESSION['usern'];
    if(isset($_GET['addCart'])){
      $prod_id = $_GET['addCart'];
      $getId = "(SELECT Kundnr FROM logins WHERE Username='$getUsern')";
      $getPrice = "(SELECT Price FROM assets WHERE Produktnr=$prod_id)";
      $addcart = "INSERT INTO shoppingcart (Kundnr, Produktnr, QTY, Price) VALUES ($getId, $prod_id, 1, $getPrice)";
      mysqli_query($_SESSION['dblink'], $addcart);
    }
  }
}

function removeCart(){
  if($_SESSION['inloggad'] !== '#'){
    $getUsern = $_SESSION['usern'];
    if(isset($_GET['removeCart'])){
      $cart_id = $_GET['removeCart'];
      $getId = "(SELECT Kundnr FROM logins WHERE Username='$getUsern')";
      $removecart = "DELETE FROM shoppingcart WHERE CartID=$cart_id";
      mysqli_query($_SESSION['dblink'], $removecart);
    }
  }
}

function addOrder(){
  if($_SESSION['inloggad'] !== '#'){
    if(isset($_GET['placeOrder'])){
      $username = $_GET['placeOrder'];
      $getId = "(SELECT Kundnr FROM logins WHERE Username='$username')";
      $add_order = "INSERT INTO userorder (Kundnr, Produktnr, QTY, Dates, Price) SELECT s.Kundnr, s.Produktnr, s.QTY, now(), a.Price FROM (SELECT * FROM shoppingcart WHERE Kundnr = $getId) s JOIN assets a ON a.Produktnr = s.Produktnr";

      $get_prod = "SELECT Produktnr FROM shoppingcart WHERE Kundnr=$getId";
      $run_get_prod= mysqli_query($_SESSION['dblink'], $get_prod);
      while($array = mysqli_fetch_array($run_get_prod, MYSQLI_NUM)){
        $value = $array[0];
        $qty = "(SELECT QTY FROM shoppingcart WHERE Produktnr = $value)";
        $stock = "(SELECT Stock FROM assets WHERE Produktnr = $value)";
        $qty_sql = mysqli_query($_SESSION['dblink'], $qty);
        $stock_sql = mysqli_query($_SESSION['dblink'], $stock);
        $QTY_array = mysqli_fetch_array($qty_sql, MYSQLI_NUM);
        $stock_array = mysqli_fetch_array($stock_sql, MYSQLI_NUM);
        echo $QTY_array[0];
        if($QTY_array[0]> $stock_array[0]){
          return 0;
        }
      }
      $run_get_prod= mysqli_query($_SESSION['dblink'], $get_prod);
      while($array = mysqli_fetch_array($run_get_prod, MYSQLI_NUM)){
        $value = $array[0];
        $orderQTY = "(SELECT QTY FROM shoppingcart WHERE Produktnr = $value)";
        $subtract_asset_qty = "UPDATE assets SET Stock = Stock - $orderQTY WHERE Produktnr = $value";
        mysqli_query($_SESSION['dblink'], $subtract_asset_qty);
      }

      mysqli_query($_SESSION['dblink'], $add_order);

      $removecart = "DELETE FROM shoppingcart WHERE Kundnr=$getId";
      mysqli_query($_SESSION['dblink'], $removecart);
    }
  }
}

function getProfile($username, $link){
  $query = "SELECT firstname, lastname, address FROM users WHERE Kundnr = (SELECT Kundnr FROM logins WHERE Username = '" . $username . "')";
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
