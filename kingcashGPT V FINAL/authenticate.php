<?php
session_start();
include "header.php";
echo "<div id=\"left\">";
include("includes/left.php");	
echo" </div>
<div id=\"middle\" class=\"feature\" >";
 
if (!isset($_POST['username']) || !isset($_POST['password'])) { // checks to see if user has entered in information
echo "<h1>Login Error: Fields Left Blank! </h1><br /><span>Please make sure that you fill in all fields!</span> <br/> <a href=\"#\" ONCLICK=\"history.go(-1)\">[Go Back]</a> 
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}
global $userinfo; // has user information from header.

$login_user = mysql_query("SELECT * FROM `users` WHERE `username` = '".$_POST['username']."' AND `userpass` = '".md5($_POST["password"])."'");

if (mysql_num_rows($login_user) < 1) { // wrong login information
echo "<h1>Login Failed: Incorrect Login</h1> <br /><span>Please make sure that you have correctly filled in your login information.</span>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
} 
else {
$_SESSION['login'] = 'YES';
$member = mysql_fetch_assoc($login_user);
$_SESSION['userid'] = $member['id'];
    
if ( isset($_SERVER["REMOTE_ADDR"]) )    {
		$ip =  $_SERVER["REMOTE_ADDR"];
} else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
		$ip =  $_SERVER["HTTP_CLIENT_IP"];
} 
    
echo "</br><div align='center'><h1>Thank you for logging in,".$member['username']."
<br />
<meta http-equiv=\"refresh\" content=\"0;url=stats.php?\">
<a href=\"stats.php\">If this page does not refesh, click here.</a></h1>";
echo "
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}
?>