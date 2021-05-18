<?php
session_start();
unset ($_SESSION['ADMIN_LOGIN']);
unset ($_SESSION['ADMIN_USERNAME']);
session_destroy();
header('location:login.php');
die(); 

?>