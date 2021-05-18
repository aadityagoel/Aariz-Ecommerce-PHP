<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}
function get_safe_value($con, $str){
    if($str != ''){
    	$str=trim($str);
        return mysqli_real_escape_string($con, $str);
    }   
}

function get_product($con, $limit='', $cat_id='', $product_id=''){
	// $sql = "select * from product where status = 1";
	$sql = "select product.*, categories.categories from product,categories where product.categories_id = categories.id and categories.status = 1 and product.status = 1 ";
	if ($cat_id!='') {
		$sql.=" and product.categories_id = $cat_id";
	}

	if ($product_id!='') {
		$sql.=" and product.id = $product_id";
	}

	$sql.=" order by product.id desc";

	if($limit!='') {
		$sql.=" limit $limit";
	}
	$res = mysqli_query($con, $sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$data[]=$row;
	}
	return $data;
}

function get_category($con, $limit=''){
	$sql = "select * from categories where status = 1";
	if($limit!='') {
		$sql.=" limit $limit";
	}
	$cat_res = mysqli_query($con, $sql);
	$cat_arr = array();
	while($row = mysqli_fetch_assoc($cat_res)) {
		$cat_arr[]=$row;
	}
	return $cat_arr;
}
?>