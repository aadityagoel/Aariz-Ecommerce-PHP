<?php
$con = mysqli_connect("localhost:3307", "root", "", "aariz_ecom");
// global $con;

// server path
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].'/aariz_ecom/');
define('SITE_PATH', 'http://localhost:1234/aariz_ecom/');

// image path
define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH.'media/product/');


?>
