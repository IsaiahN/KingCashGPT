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
echo "<h1>You must be logged into the site in order to use this page. <br /> <a href=\"login.php?ref=$ref\">Click here to log in, </a><br /> <a href=\"index.php?ref=$ref\">or here to sign up</a></h1>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}

if ($userinfo['email_verified'] != 1) {
    echo "<h1>You need to verify your email before you can cashout. <br /> Please check the email you received when you signed up. <br /> <a href=\"#\" ONCLICK=\"history.go(-1)\">[Go Back]</a></h1>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}
if ($configs['mincashout'] > $userinfo['current_balance']) { // not enough
if ($configs['mincashoutpoints'] > $userinfo['current_points_balance']) { 
echo "<h1>You don't have enough funds in your balance.  <br /> The Minimal cashout value is $".$configs['mincashout'].". <br /> Please do more <a href='offers.php'>offers</a> and try to cashout later.</h1>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
	}
}
if (($userinfo['paypal']=='')) {
echo "<span class=\"red\">Please Go to My Account to update your PayPal address to cashout. <a href=\"#\" ONCLICK=\"history.go(-1)\">[Go Back]</a></span>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}

if ($userinfo['paypal']!='') {
	$to .= "<input type ='radio' name ='type' value ='paypal'>PayPal [".$userinfo['paypal']."] <br /> ";
}
if ($_POST['amount']!='') {
	if (!is_numeric($_POST['amount'])) {
		$error .= "<span class=\"red\">Amount should contain only numbers.</span>";
	}
	if ($_POST['amount']>$userinfo['current_balance']) {
		$error .= "<span class=\"red\">You have less then $".htmlentities($_POST['amount'])." in your balance. <br /> Please return to <a href='cashout.php'>cashout</a> page and enter $".$userinfo['current_balance']." or less.</span>";
	}
}
if (($error=='') && ($_POST['amount'])) {
	$amount = mysql_real_escape_string($_POST['amount']);
	$query = "INSERT INTO cashouts VALUES('','".$userinfo['id']."', '".$_POST['type']."', '".$amount."', '0','','')";
	mysql_query($query) or die(mysql_error());
	$query = "UPDATE users SET current_balance=current_balance-'".$amount."' WHERE id='".$userinfo['id']."'";
	mysql_query($query) or die(mysql_error());
echo "Thank you for cashing out, you should recieve your payment within 24 hours.";
	$messagejoin = " <br /> <b style=\"color:green;\">".$userinfo['username']." just cashed out \$".$_POST['amount']."!</b>";
	$usernamebot = "<img src=\"images/bot.png\" alt=\"\" /><span class=\"botchat\">KingCashGPT Bot</span>";
	$querychat =" INSERT INTO `shoutbox` VALUES('', NOW(), '".mysql_real_escape_string($usernamebot)."', '".mysql_real_escape_string($messagejoin)."')";
	mysql_query($querychat) or die(mysql_error());
}
echo $error."<form method=POST><table cellpadding=\"2\" cellspacing=\"2\">
<tr><th colspan=\"2\"><h1>Cashout Your Earnings</h1></th></tr> <br /> 
<td>Need to Redeem Points?</td><td><a href=\"cashoutpoints.php\">Click Here</a> </td>
<tr>
	<td>Amount to Cashout:</td>
	<td><input type ='text' name ='amount' value ='".$userinfo['current_balance']."'></td>
</tr>
<tr>
	<td colspan=\"2\"><input type ='submit' class ='submitbutton' name ='Submit' value ='Cashout'></td>
</tr> 
<br /> 
</table></form> <br />  [<a href='offers.php'>Return to offers page</a>] 
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
?>