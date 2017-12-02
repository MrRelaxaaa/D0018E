<?php

//require_once 'config.php';

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
