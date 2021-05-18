<?php
  require('connection.inc.php');
  require('functions.inc.php');
  // prx($_SERVER['DOCUMENT_ROOT']);
  session_start();
  if(isset($_SESSION['ADMIN_LOGIN']))
  {
  	$username =  $_SESSION['ADMIN_USERNAME'];
  }else{
    header('location:login.php');
    die();
  }
?>