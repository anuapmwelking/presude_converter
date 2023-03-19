<?php session_start(); ?>

<?php include('Crypto.php')?>
<?php include('header.php'); ?>
<div class="container ">
  <div class="my-3">
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
 	error_reporting(0);
	
	$workingKey='A1CA24D953911417B218CCC9F7E902D2';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
		$responseMap [$information [0]] = $information [1];
	}

$order_id = $responseMap ['order_id'];
$reason = $responseMap ['merchant_param1'];
$tracking_id = $responseMap ['tracking_id'];
$bank_ref_no = $responseMap ['bank_ref_no'];
$order_status = $responseMap ['order_status'];
$payment_mode = $responseMap ['payment_mode'];
$card_name = $responseMap ['card_name'];
$currency = $responseMap ['currency'];
$amount = $responseMap ['amount'];
$billing_name = $responseMap ['billing_name'];
$billing_address = $responseMap ['billing_address'];
$billing_city = $responseMap ['billing_city'];
$billing_state = $responseMap ['billing_state'];
$billing_zip = $responseMap ['billing_zip'];
$billing_country = $responseMap ['billing_country'];
$billing_tel = $responseMap ['billing_tel'];
$billing_email = $responseMap ['billing_email'];
$trans_date = $responseMap ['trans_date'];
session_start();

if($order_status==="Success"){
// if($_SESSION['oId']===$order_id)
// {
  $sql = "INSERT INTO payments (order_id, tracking_id, bank_ref_no, order_status, payment_mode, card_name, currency, billing_name, billing_address, billing_city, billing_state, billing_zip, billing_country, billing_tel, billing_email, trans_date,  reason, amount,transaction_status)
VALUES ('$order_id','$tracking_id','$bank_ref_no','$order_status','$payment_mode','$card_name','$currency','$billing_name','$billing_address','$billing_city','$billing_state','$billing_zip','$billing_country','$billing_tel','$billing_email','$trans_date','$reason','$amount','Successful')";
//   echo "ORDER ID - ". $_SESSION['oId'];
		echo "<h3><br>Thank you. Your transaction is <b>Successful</b>. </h3><br><br>";
		echo"<table class='table my-3'>
		
  <thead>
    <tr>
      <th>Order ID</th>
      <th> $order_id </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>Tracking ID</th>
      <td>$tracking_id</td>
    </tr>
    <tr>
      <th>Bank Ref N.o</th>
      <td>$bank_ref_no</td>
    </tr>
    <tr>
      <th>Order Status</th>
      <td>$order_status</td>
    </tr>
        <tr>
      <th>Payment Mode</th>
      <td>$payment_mode</td>
    </tr>
        <tr>
      <th>Card Name</th>
      <td>$card_name</td>
    </tr>
        <tr>
      <th>Total Amount</th>
      <td>$amount / $currency </td>
    </tr>
        <tr>
      <th>Name & Address </th>
      <td>$billing_name | $billing_address, $billing_city, $billing_state, $billing_zip, $billing_country </td>
    </tr>
        </tr>

        <tr>
      <th>Contact Details</th>
      <td>$billing_tel / $billing_email</td>
    </tr>
            <tr>
      <th>Transaction Date</th>
      <td>$trans_date</td>
    </tr>
    
  </tbody>
</table>";

    // }
	}

	else if($order_status==="Aborted")
	{
		echo "<br><h4>Sorry!! Your Transaction Denied.</h4>";
	
    $sql = "INSERT INTO payments (order_id, tracking_id, bank_ref_no, order_status, payment_mode, card_name, currency, billing_name, billing_address, billing_city, billing_state, billing_zip, billing_country, billing_tel, billing_email, trans_date,  reason, amount,transaction_status)
VALUES ('$order_id','$tracking_id','$bank_ref_no','$order_status','$payment_mode','$card_name','$currency','$billing_name','$billing_address','$billing_city','$billing_state','$billing_zip','$billing_country','$billing_tel','$billing_email','$trans_date','$reason','$amount','Failed')";
	}

	else if($order_status==="Failure")
	{
    
		echo "<br><h4>Sorry!! Your Transaction declined. </h4>";

    $sql = "INSERT INTO payments (order_id, tracking_id, bank_ref_no, order_status, payment_mode, card_name, currency, billing_name, billing_address, billing_city, billing_state, billing_zip, billing_country, billing_tel, billing_email, trans_date,  reason, amount,transaction_status)
VALUES ('$order_id','$tracking_id','$bank_ref_no','$order_status','$payment_mode','$card_name','$currency','$billing_name','$billing_address','$billing_city','$billing_state','$billing_zip','$billing_country','$billing_tel','$billing_email','$trans_date','$reason','$amount','Failed')";
}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	}

?>

  </div>
</div>
<?php
if($order_status==="Success")
{
  ?>
  <div class="container">
    <div class="text-center"">
  <button class="btn-primary" onclick="window.print()">Print</button>
</div>
</div>
  <?php
}
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
<?php include('footer.php'); ?>