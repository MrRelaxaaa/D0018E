<?php
include 'functions.php';
db_con();
check_sess();
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$_SESSION['dblink'] = $link;
$username = $_SESSION['usern'];
$var_liked = $_GET['liked'];
echo $var_liked;
$is_set = "";
if($var_liked == "like"){
 $getid = "(SELECT Kundnr FROM logins WHERE Username='$username')";
 $prod_id = $_SESSION['product_id'];
 $sql = "SELECT Liked FROM hasliked WHERE Produktnr=$prod_id AND Kundnr=$getid";
 $test = (mysqli_query($link, $sql));
 while($liked = mysqli_fetch_assoc($test)){
     $is_set = $liked['Liked'];
 }
 if($is_set == ""){
   $ins_like = "INSERT INTO hasliked (Produktnr, Kundnr, Liked) VALUES ($prod_id, (SELECT Kundnr FROM logins WHERE Username='$username'), 1)";
   mysqli_query($link, $ins_like);
 }elseif($is_set == 0){
    $update = "UPDATE hasliked SET Liked=1 WHERE Produktnr=$prod_id AND Kundnr=(SELECT Kundnr FROM logins WHERE Username='$username')";
    mysqli_query($link, $update);
  }
 mysqli_close($link);
}

elseif($var_liked == "dislike"){
 $getid = "(SELECT Kundnr FROM logins WHERE Username='$username')";
 $prod_id = $_SESSION['product_id'];
 $sql = "SELECT Liked FROM hasliked WHERE Produktnr=$prod_id AND Kundnr=$getid";
 $test = (mysqli_query($link, $sql));
 while($liked = mysqli_fetch_assoc($test)){
     $is_set = $liked['Liked'];
 }
 if($is_set == ""){
   $ins_dislike = "INSERT INTO hasliked (Produktnr, Kundnr, Liked) VALUES ($prod_id, (SELECT Kundnr FROM logins WHERE Username='$username'), 0)";
   mysqli_query($link, $ins_dislike);
 }
 elseif($is_set == 1){
   $update = "UPDATE hasliked SET Liked=0 WHERE Produktnr=$prod_id AND Kundnr=(SELECT Kundnr FROM logins WHERE Username='$username')";
   mysqli_query($link, $update);
 }

 mysqli_close($link);
}
else {
  echo "Error line 49; neither dis or like";
}
header("Location: products.php?viewProduct=$prod_id");
?>