<?php
session_start();


$first_name = $_GET['first_name'];
$last_name  = $_GET['last_name'];
$email      = $_GET['email'];
$phone      = $_GET['phone'];
$company    = $_GET['company'];
$country    = $_GET['country'];
$city       = $_GET['city'];
$product    = $_GET['product'];
$type       = $_GET['type'];
$size       = $_GET['size'];
$quantity   = $_GET['quantity'];
$message    = $_GET['message'];



$oid        = 'your-oid';
$retURL     = 'the-return-url';
$debug      = 'debug-mode';
$debugEmail = 'debug-mail';


$myvars = "oid=$oid&retURL=$retURL&debug=$debug&debugEmail=$debugEmail&first_name=$first_name&last_name=$last_name&email=$email&phone=$phone&company=$company&country=$country&city=$city&00N0X00000CrHzi=$product&00N0X00000AlPaB=$type&00N0X00000AlPaA=$size&00N0X00000AlPaC=$quantity&00N0X00000AlPa9=$message";

$_SESSION["vars"] = $myvars;
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
</head>
<body>



<?php

$url = 'https://go.pardot.com/your-pardot-url';

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
?>

<div style="opacity:0">
<?php var_dump($response); ?>
</div>


</body>
</html>