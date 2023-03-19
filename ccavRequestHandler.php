<?php
session_start();
?>
<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<?php
   
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "presude-dashboard";
    // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// $_SESSION['oId'] = $_POST['order_id'];
// $_SESSION['amnt'] = $_POST['amount'];
// $_SESSION['crncy'] = $_POST['currency'];
// $_SESSION['name'] = $_POST['billing_name'];

$tran_order_id = $_POST ['order_id'];
$tran_reason = $_POST ['merchant_param1'];
$tran_currency = $_POST ['currency'];
$tran_amount = $_POST ['amount'];
$tran_billing_name = $_POST ['billing_name'];
$tran_billing_address = $_POST ['billing_address'];
$tran_billing_city = $_POST ['billing_city'];
$tran_billing_state = $_POST ['billing_state'];
$tran_billing_zip = $_POST ['billing_zip'];
$tran_billing_country = $_POST ['billing_country'];
$tran_billing_tel = $_POST ['billing_tel'];
$tran_billing_email = $_POST ['billing_email'];


$sql = "INSERT INTO transactions (order_id,currency, billing_name, billing_address, billing_city, billing_state, billing_zip, billing_country, billing_tel, billing_email,  reason, amount)
VALUES ('$tran_order_id','$tran_currency','$tran_billing_name','$tran_billing_address','$tran_billing_city','$tran_billing_state','$tran_billing_zip','$tran_billing_country','$tran_billing_tel','$tran_billing_email','$tran_reason','$tran_amount')";
?>
<?php

if ($conn->query($sql) === TRUE) {
  // echo "New record created successfully";
//   echo $reason;
} else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
<?php include('Crypto.php')?>
<?php

	error_reporting(0);

	$merchant_data='2';
	$working_key='A1CA24D953911417B218CCC9F7E902D2';//Shared by CCAVENUES
	$access_code='AVJF19KB19AU19FJUA';//Shared by CCAVENUES

	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
<?php
// 	echo $_SESSION['oId'];
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>

<script language='javascript'>document.redirect.submit();</script>
</body>
</html>
