<?
$cryptinstall="crypt/cryptographp.fct.php";
include $cryptinstall;  
include "header.php";
echo "
<div id=\"left\">";
include("includes/left.php");	
echo" </div>
<div id=\"middle\" class=\"feature\" style=\"padding-right: 10px;\">";
global $userinfo;
if ($_SESSION['login'] !== 'YES') {
    echo "<center><h1><b>You must be logged into the site in order to use this page.</b><br /><br /><a href=\"login.php?ref=$ref\">Click here to log in, </a><br /><br /><a href=\"index.php?ref=$ref\">or click here to sign up</a></h1></center>";
    
echo
"</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
    exit;
}
if ($userinfo['email_verified'] != 1) {
    echo "<center><h1><b>You need to verify your email before you can enter your promo code.</b><br />To do so please check the email you received upon signing up.<br /> <a href=\"verify.php\">[Go To The Verification Page]</a> </h1></center>";
    
echo
"</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
    exit;
}

if (isset($_POST['u'])) {
$ccode = mysql_real_escape_string($_POST['couponcode']);
$ccaptcha = mysql_real_escape_string($_POST['code']);


    if (!$ccode) { $error .= '<font color=red>Please Enter in your promo code.</font><br>'; }
    if (!chk_crypt($ccaptcha)) { $error .= '<font color=red>The Captcha Was Not Correctly Filled In.</font><br>'; }
    }
  if (($ccode) && ($ccaptcha) && (!$error)) {
	$getcoupon=mysql_query("select * from coupons WHERE code = '".$ccode."' and active='1'");
	
	if (mysql_num_rows($getcoupon)!==0) {
	$cc=mysql_fetch_array($getcoupon) or die(mysql_error());
	if ($cc['limit'] > 0) {
	$q1 = "UPDATE users SET current_balance=current_balance+'".$cc['value']."' WHERE id='".$userinfo['id']."'";
	mysql_query($q1) or die(mysql_error());
	$q2 = "UPDATE coupons SET limit=limit-1 WHERE code = '".$ccode."'";
	mysql_query($q2) or die(mysql_error());
	$messagejoin = "<br><b><b style=\"color:green;\">".$userinfo['username']."</b> Just redeemed a promo code worth \$".$cc['value']."!</b>";
	$usernamebot = "<img src=\"images/bot.png\" alt=\"\" /><span class=\"botchat\">KingCashGPT Bot</span>";
	$querychat =" INSERT INTO `shoutbox` VALUES('', NOW(), '".mysql_real_escape_string($usernamebot)."', '".mysql_real_escape_string($messagejoin)."')";
	mysql_query($querychat) or die(mysql_error());
	} else {
 	$q2 = "UPDATE coupons SET active='2' WHERE code = '".$ccode."' and active='1'";
 	echo "This Promo Code has expired.";
	break;
	}
	
} else {
$getcoupon=mysql_query("select * from coupons WHERE code= ".$ccode."");
if (mysql_num_rows($getcoupon)!==0) {
echo "This Promo Code has expired.";
break;
}
}

echo"
	
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
    exit;

	} else {
echo"
<h1>King Of The Hill | Promo</h1>
".$error." <br />
<span>Enter in your promo code below:</span><br />
<form method='POST'>
<br />
<input type=hidden name=u value=".$userinfo['username'].">
<span style=\"margin-left: 10px;\">Coupon Code:</span><br /> <input type=text name=couponcode><br />
<span style=\"margin-left: 10px;\">Captcha:</span> <br /><tr><br /><span> <table><tr><td><img id='cryptogram' src='crypt/cryptographp.php?cfg=0&'></td><td><a title='' style=\"cursor:pointer\" onclick=\"javascript:document.images.cryptogram.src='crypt/cryptographp.php?cfg=0&&'+Math.round(Math.random(0)*1000)+1\"><img style=\"position:relative; right: 0px;\" src=\"crypt/images/reload.png\"></a></td></tr></table> 

</span><input type=\"text\" name=\"code\"></tr>
<input type=submit value=Submit>
</form>

</div>
	<div id=\"right\">";
	}
		include("includes/right.php");
	echo "</div>";

include "footer.php";
exit;
?>