<?
$cryptinstall="crypt/cryptographp.fct.php";
include $cryptinstall;  
include "header.php";
echo' <div id="left">';
		include("includes/left.php");
echo '</div>
	<div id="middle" class="feature">
	<h1>Register</h1>';
if (isset($_POST['username']) && isset($_POST['password'])) {
	if (!InputCheck($_POST['username']))  { $error .= '<span class="red">Please do not enter in any special characters (A-Z, 0-9 Only) </span> <br /> '; } else { $username = trim($_POST['username']); }
	$password = md5(trim($_POST['password']));
	$passwordrepeat = md5(trim($_POST['passwordrepeat']));
	$email = trim($_POST['email']);
	$emailrepeat = trim($_POST['emailrepeat']);
	$paypal = trim($_POST['paypal']);
	$country = trim($_POST['country']);
	$date = date("F j, Y, g:i a");
    if ($_POST['referral']) {
    	$referral = trim($_POST['referral']);
    	$result = mysql_query("SELECT * FROM users WHERE username ='".mysql_real_escape_string($referral)."'") or die(mysql_error())
    	if (mysql_num_rows($result) >= 1 ) {
    		$error .= '<span class="red">The Referral Code that was presented is invalid  <br /> <a href=\"#\" ONCLICK=\"history.go(-1)\">[Go Back]</a>.</span> <br /> ';
    	}
    	unset($_COOKIE['referral']);
    } else {
    	$referral = '';
    }
    if (!isset($username)) { $error .= '<span class="red">Please Enter Your Username.</span> <br /> '; }
    if (!isset($password)){ $error .= '<span class="red">Please Enter Your Password In the Proper Field.</span> <br /> '; }
    if (!isset($email)){ $error .= '<span class="red">Please Enter E-Mail in E-Mail Field.</span> <br /> '; }
    if ($password != $passwordrepeat) { $error .= '<span class="red">Passwords Do Not Match.</span> <br /> '; }
    if (!validate_email($email)) { $error .= '<span class="red">E-Mail Address Is Invalid.</span> <br /> '; }
    if ($email != $emailrepeat) { $error .= '<span class="red">E-Mail Addresses Do Not Match.</span> <br /> '; }
    $chkmem = mysql_query("SELECT * FROM `users` WHERE username ='".$username."'");
    if (mysql_num_rows($chkmem) > 0 ) { $error .= '<span class="red">This Username Is Already In Usage. Please Try Another.</span> <br /> '; }
    $chkemail = mysql_query("SELECT * FROM `users` WHERE email='".$email."'");
	if (mysql_num_rows(chkemail) > 0 ) { $error .= '<span class="red">This E-Mail Is Already In Usage. Please Try Another.</span> <br /> '; }
    if (!chk_crypt($_POST['code'])) { $error .= '<span class="red">The Captcha Was Not Correctly Filled In.</span> <br /> '; }
 }
	if (($username) && ($password) && (!$error)) {
		$rand = md5(rand(5000, 10000));
		$register_user = "INSERT INTO `users` VALUES('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','0','".mysql_real_escape_string($email)."','".$rand."','1','".mysql_real_escape_string($paypal)."','No Alertpay','".$country."','".$ip."','".$ip."','".$date."','".$configs['signupbonus']."','".$configs['signupbonus']."','0','0','".mysql_real_escape_string($referral)."','','','')";
		mysql_query($register_user) or die(mysql_error());
		$messagejoin = "Welcome our new member, <b style=\"color:green;\">".$username."</b> who just joined KingCashGPT!";
		$usernamebot = "<img src=\"images/bot.png\" alt=\"\" /><span class=\"botchat\">KingCashGPT Bot</span>";
		$querychat =" INSERT INTO `shoutbox` VALUES('', NOW(), '".mysql_real_escape_string($usernamebot)."', '".mysql_real_escape_string($messagejoin)."')";
		mysql_query($querychat) or die(mysql_error());
	if (isset($referral)) {
		mysql_query("UPDATE `users` SET referrals=referrals+1, current_balance=current_balance+'".$configs['refbonus']."', total_earned=total_earned+'".$configs['refbonus']."' WHERE username ='".mysql_real_escape_string($referral)."'") or die(mysql_error());
	}

$subject = 'Welcome To KingCashGPT,'.$username.'!';
$message = "Hello ".$username.",\n
\n
Thank you for joining KingCashGpt,\n
<a href=\"www.kingcashgpt.com/offers.php\">>>Click Here to Visit Offers Central <<</a> \n
\n
Good luck on your earnings Journey, \n
The KingCashGpt Staff";

$headers = 'From: admin@kingcashgpt.com' . "\r\n" .
    'Reply-To: admin@kingcashgpt.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($email, $subject, $message, $headers);


echo "<h1>Registration successful, ".$username.". <br /> <a href=\"offers.php\">Click Here</a> to go to the offers page. </h1>";
    } else {
$urlstr = "http://api.wipmania.com/".$_SERVER['REMOTE_ADDR']."";
$country = file_get_contents($urlstr);
if (!isset($country)) {
require_once 'geoip2.inc';
$getipcountry=geoip_open('GeoIP2.dat',GEOIP_STANDARD);
$country=geoip_country_name_by_addr($getipcountry,$_SERVER['REMOTE_ADDR']);
echo "<h3>Your country code was not located, so we have used a backup service. <br />  If the country shown below is incorrect, please <a href=\"mailto:admin@kingcashgpt.com\">contact us</a> with your username. <br />(Note: Your country code needs to be accurate in order to complete offers!)</h3>";
}
echo $error;
echo "
<form method='POST' action='#'>
<table>
  <tbody>
    <tr>
    <td>Username<span class=\"red\">*</span></td>
	<td><input type ='text' name ='username' value ='".htmlentities($_POST['username'])."'></td>
    </tr>
	<tr>
	<td>E-Mail<span class=\"red\">*</span></td>
	<td><input type ='text' name ='email' value ='".htmlentities($_POST['email'])."'></td>
    </tr>
	<tr>
	<td>Repeat Email<span class=\"red\">*</span></td>
	<td><input type ='text' name ='emailrepeat' value ='".htmlentities($_POST['emailrepeat'])."'></td>
    </tr>
	<tr>
	<td>PayPal</td><td><input type ='text' name ='paypal' value ='".htmlentities($_POST['paypal'])."'></td>
    </tr>
	<tr>
	<td>Password<span class=\"red\">*</span></td>
	<td><input type ='password' name ='password' value =''> <br /> </td>
    </tr>
	<tr>
	<td>Repeat Password<span class=\"red\">*</span></td>
	<td><input type ='password' name ='passwordrepeat' value =''> <br /> </td>
    </tr>
	<tr>
	<td>"; ?> 
    
   <?php dsp_crypt(0,1); ?> 
    
    <?
    echo " <br /></td><td><input type=\"text\" name=\"code\"></td>
    </tr>
	<tr>
	<td>Country:</td>
	<td style=\"padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-weight: bold;\">".$country."  </td>";
    if ($_COOKIE['referral']) { echo "<input type ='hidden' name ='referral' value ='".htmlentities($_COOKIE['referral'])."'>"; }
    echo "
    </tr>
  </tbody>
</table>
<input type ='hidden' name ='country' value ='".$country."'>
<input type ='submit' value ='Submit'>
</form>";
}

echo '
	</div>
	<div id="right">';
		include("includes/right.php");
echo '</div>';
include "footer.php";
?>