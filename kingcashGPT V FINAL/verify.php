<?
session_start();
include "header.php";
echo "<div id=\"left\">";
include("includes/left.php");		
echo "</div>
<div id=\"middle\" class=\"feature\">
<h1>Verifying your Email Address</h1>
<center style=\"padding-bottom:15px;\" >This should only take a moment....</center>";
if ($userinfo['email_verified'] == 1) {
    echo "<center><font color=\"blue\"><h1>Your email has already been verified.</h1></font></center>";
    
echo "</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}
$_GET['code']   = mysql_real_escape_string($_GET['code']);
$_GET['email']  = mysql_real_escape_string($_GET['email']);
$_GET['resend'] = mysql_real_escape_string($_GET['resend']);
if ($_GET['resend'] != "") {
    $email      = $userinfo['email'];
    $emailcheck = $userinfo['email_check'];
    mail($email, "".$config['sitename']." Email Verification", "Hi ".$userinfo['username'].",

To verify your email address please visit the link below.
$siteurl/verify.php?email=$email&code=$emailcheck to verify your account.

Thank you for verifying your email,
The ".$configs['sitename']." Staff", "From: ."$configs['siteadmin']."");
    echo "<center>You should receive an email shortly.<br />Be sure to check your inbox and spam folder.</center>";
    
   	echo "</div>
	<div id=\"right\">";
		include("includes/right.php");
	echo "</div>";

include "footer.php";
exit;
}
if ($_GET['code'] != "" && $_GET['email'] != "") {
    $validify = mysql_query("SELECT * FROM `users` where `email`='".$_GET['email']."' and `email_check`='".$_GET['code']."'");
    if (mysql_num_rows($validify) < 1) {
        echo "<p>Sorry, but this seems to be an invalid validation link. Please check your email and make sure you copied the link correctly. If this message is in error, please submit a support ticket.</p>";
   
    } else {
        mysql_query("UPDATE `users` SET email_verified=1 where email='".$_GET['email']."' and email_check='".$_GET['code']."'");
        echo "<p>Thank you for taking the time to verify your email address!<br />You are now able to cashout! <a href=\"offers.php\">[Go Offers]</a></p>";
    }
} else {
    echo "<center><form action=\"verify.php\" method=\"get\">
<span>Email</span><br /><input type=\"text\" name=\"email\" value=\"".htmlentities($_GET['email'])."\"><br />
<span>Verification Code</span><br /><input type=\"text\" name=\"code\" value=\"".htmlentities($_GET['code'])."\"><br /><br />
<input type=\"submit\" style=\"margin-bottom:10px;\" class=\"button\" value=\"Verify Your Email\">
</form>
<a href=\"verify.php?resend=1\" >Click Here to Resend Verification Email</a>
</center>
";
}

	echo "</div>
	<div id=\"right\">";
		include("includes/right.php");
	echo "</div>";

include "footer.php";
?>