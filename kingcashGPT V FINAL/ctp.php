<?
session_start();
include "header.php";
echo "
<div id=\"left\">";
include("includes/left.php");	
echo" </div>
<div id=\"middle\" class=\"feature\" >";
global $userinfo;
if ($_SESSION['login'] !== 'YES') {
    echo "<center><h1><b>You must be logged into the site in order to use this page.</b><br><br><a href=\"login.php?ref=$ref\">Click here to log in, </a><br><br><a href=\"index.php?ref=$ref\">or click here to sign up</a></h1></center>";
    
echo
"</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
    exit;
}
if ($userinfo['current_balance'] == 0.00) {
echo "<center><h1><b>You will need to earn some cash so that you will have cash to transfer -__- ......<br><a href=\"offers.php\">[Go To Offers Page]</a> </h1></center>";
    
echo
"</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
    exit;
}
if ($userinfo['email_verified'] != 1) {
    echo "<center><h1><b>You need to verify your email before you can transfer credits.</b><br>To do so please check the email you received upon signing up.<br> <a href=\"verify.php\">[Go To The Verification Page]</a> </h1></center>";
    
echo
"</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
    exit;
}
if ($_POST['transfer']!='') {
	if (!is_numeric($_POST['transfer'])) {
		$error .= "<center><font color=\"red\"><b>Transfer amount should be numberic.<br>Example: 1.30 or 5.00</b></font></center>";
	}

	if ($_POST['transfer']>$userinfo['current_balance']) {
		$error .= "<center><font color=\"red\"><b>You have less then $".htmlentities($_POST['transfer'])." in your balance.<br>Please enter in $".$userinfo['current_balance']." or less.</b></font></center>";
	}
}
if (($error=='') && ($_POST['transfer'])) {
	$transfer = mysql_real_escape_string($_POST['transfer']);
	$transfer2 = $transfer * 100;
	$q2 = "UPDATE users SET current_balance=current_balance-'".$transfer."' WHERE id='".$userinfo['id']."'";
	mysql_query($q2) or die(mysql_error());
	
	$q1 = "UPDATE users SET current_points_balance=current_points_balance+'".$transfer2."' WHERE id='".$userinfo['id']."'";
	mysql_query($q1) or die(mysql_error());

	echo "<center><td><b>Your Transfer has been completed!</b></td><br> <a href=\"offers.php\">[Back To Offer Central]</a> </center>";
	echo
"<meta http-equiv=\"refresh\" content=\"1\"></div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
    exit;
}

echo"

<h1>Convert Cash To Points</h1>
".$error."
<form method='POST'>
<span>Please enter the amount that you wish to convert below:</span><br>
<tr><td>Amount:</td><td><input type=text name='transfer' value='".htmlentities($_POST['transfer'])."'></td></tr>
<input type=hidden name=user value='".$userinfo[username]."'>
<input type=submit value=Submit>
</form>

</div>
	<div id=\"right\">";
		include("includes/right.php");
	echo "</div>";

include "footer.php";
exit;
?>