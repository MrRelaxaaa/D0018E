<?php
function getcart(){
  require_once 'config.php';
  $getitems = "select * from shoppingcart";

  $run_getitems = mysqli_query($link, $getitems);


  while ($row_items=mysqli_fetch_array($run_getitems)){

      $product_id = $row_items['Produktnr'];
      $product_title = $row_items['Name'];
      $product_price = $row_items['Price'];
      $product_desc = $row_items['description'];
      $product_img = $row_items['image'];

      echo "
            <figure class='product-container'>
      			<img src='$product_img' />
      				<figcaption>
        			<h1>$product_title</h1>
        				<p>$product_desc</p>
        				<div class='price'>
          				$product_price:-
        				</div>
    						<br>
    						<input type='submit' name='$product_id' class='add-cart' value='Add to cart'/>
              </figure>

      ";

  }

}
?>
