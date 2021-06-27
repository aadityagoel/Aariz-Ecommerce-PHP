<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
require('../connection.inc.php');

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;

// echo '<pre>';
// print_r($_POST);
// die();

$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		$order_id = $_POST["ORDERID"];
		$payment_status = 'success';
		$txn_id = $_POST["TXNID"];
		$payment_mode = $_POST["PAYMENTMODE"];
		$txn_date = $_POST["TXNDATE"];
		$txn_status = $_POST["RESPMSG"];
		$bank_txn_id = $_POST["BANKTXNID"];
		$bank_name = $_POST["BANKNAME"];
		$checksum_hash = $_POST["CHECKSUMHASH"];
		
		mysqli_query($con, "update orders set payment_status='$payment_status', txn_id='$txn_id', payment_mode='$payment_mode', txn_date='$txn_date', txn_status='$txn_status', bank_txn_id='$bank_txn_id', bank_name='$bank_name', checksum_hash='$checksum_hash' where order_id = '$order_id'");

		header('Location: ../thank_you.php');
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>