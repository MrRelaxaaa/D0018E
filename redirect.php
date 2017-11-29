<?php
include 'functions.php';
check_sess();
$var_link = $_GET['page'];
if($_SESSION['inloggad'] != '#'){
  echo $_SESSION['inloggad'];
  header('Location: '.$var_link);
  exit;
}
header('Location: login.php');
 ?>
