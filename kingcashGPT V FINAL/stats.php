<?php
session_start();
include "header.php";
echo "
	<div id=\"left\">";
		include("includes/left.php");	
	echo" </div>
	<center>
	<div id=\"middle\" class=\"feature\">";
global $userinfo;
if ($_SESSION['login'] !== 'YES') {
    echo "<center><h1>Something is wrong here!</h1><br />You must be logged into the site in order to use this page.<br />
    <a href=\"login.php\">Click here to log in, </a><br /><br />
    <a href=\"register.php\">or click here to sign up.</a></center>";
} else {
	
	$query = "SELECT * FROM `users` WHERE username='".$userinfo['username']."'";
	$result = mysql_query($query) or die(mysql_error());
	$user = mysql_fetch_array($result) or die(mysql_error());
	$totalbonus = $user['referrals'] * 0.20;
	echo "
	<table width=\"500\" cellpadding=\"3\" cellspacing=\"3\">
	<tr><th colspan=\"2\"><h1>My Account</h1></th></tr>
	<tr>
		<td><h3>Total Earnings:</h3></td>
		<td>$".$user['total_earned']."</td>
	</tr><tr>
		<td><h3>Current Balance:</h3></td>
		<td>$".$user['current_balance']." [<a href='ctp.php'>Convert To Points</a>] "; if ($user['current_balance'] >= 3.00) {echo"[<a href='cashout.php'>Cashout</a>]";} else {echo"[<a href='offers.php?&type=12&sort=Cash,high'>Earn Cash</a>]";} echo"</td>
	</tr><tr>
		<td><h3>Total Points Earned:</h3></td>
		<td>".$user['total_points_earned']." Points</td>
	</tr><tr>
		</tr><tr>
		<td><h3>Current Point Balance:</h3></td>
		<td>".$user['current_points_balance']." Points "; if ($user['current_points_balance'] >= 300) {echo"[<a href='cashoutpoints.php'>Redeem Points</a>]";} else {echo"[<a href='offers.php?&type=12&sort=Points,high'>Earn Points</a>]";} echo"</td>
	</tr><tr>
		<td><h3>Offers Completed:</h3></td>";
		if ($totalcompleted > 0) {
		echo " <td> ".$totalcompleted." offers</td>";
		} else {
		echo" <td> User has not completed any offers</td>";
		}
		echo" 
	</tr><tr>	
			
		<td><h3>Total Referrals:</h3></td>";
		if ($user['referrals'] > 0) {
		echo " <td> ".$user['referrals']."</td>";
		} else {
		echo " <td> User has no referrals</td>";
		}
		echo"
	</tr><tr>
		<td><h3>Total Referral Bonus:</h3></td>
		<td>$".$totalbonus."</td>
	</tr>
</table><br />";
	if ($user['paypal']=='') { $user['paypal']='None'; }
	if ($user['referrer']=='') { $user['referrer']='None'; }
	if ($_GET['action']=='update') {
		if ($_GET['submit']!='true') {
			if ($_GET['field']== 'paypal') {
				echo "<table cellpadding=\"2\" cellspacing=\"2\">
				<form action='?action=update&field=".$_GET['field']."&submit=true' method='POST'>
				<tr>
					<td>New ".$_GET['field']." Address:</td>
					<td><input type='text' name='new".$_GET['field']."' value=''></td>
				</tr><tr>
					<td>Confirm New ".$_GET['field']." Address:</td>
					<td><input type='text' name='rnew".$_GET['field']."' value=''></td>
				</tr><tr>
					<td></td>
					<td><input type='submit' value='Update'></td>
				</tr>
				</form>
				</table>";
			}
		} elseif ($_GET['submit']=='true') {
			if (!is_valid_email($_POST['new'.$_GET['field']])) { $error .= '<font color=red>Invalid E-Mail Address.</font><br />'; }
			if ($_POST['new'.$_GET['field']] != $_POST['rnew'.$_GET['field']]) { $error .= '<font color=red>E-Mails Doesn\'t Match.</font><br />'; }
			if (!$error) {
				$query = "UPDATE users SET ".mysql_real_escape_string($_GET['field'])."='".mysql_real_escape_string($_POST['new'.$_GET['field']])."' WHERE id='".$userinfo['id']."'";
				mysql_query($query) or die(mysql_error());
				$user[$_GET['field']]=$_POST['new'.$_GET['field']];
				echo $_GET['field']." E-Mail updated.<br />";
			}
		}
	}
	echo $error."<br />
	<table width=\"500\" cellpadding=\"3\" cellspacing=\"3\">
	<tr><th colspan=\"2\"><h1>Personal Information</h1></th></tr>
	<tr>
		<td><h3>E-Mail:</h3></td>
		<td>".$user['email']."</td>
	</tr><tr>
		<td><h3>PayPal:</h3></td>
		<td>".$user['paypal']." [<a href='?action=update&field=paypal'>Update</a>]</td>
	</tr><tr>
		<td><h3>Referrer:</h3></td>
		<td>".$user['referrer']."</td>
	</tr>
</table><br />";
	echo "<table width=\"500\" cellpadding=\"3\" cellspacing=\"3\">
	<tr><th colspan=\"2\"><h1>Referrer Tools</h1></th></tr>
	<tr>
	<td><h3>Referral Link:</h3></td>
	<td>http://".$_SERVER['SERVER_NAME']."/register.php?ref=".$userinfo['username']."</td>
	</tr>
	<tr>
	<td><h3>Banners:</h3></td>
	<td>[<a href='banners.php'>Get Referral Banners</a>]</td>
	</tr>"; 
	echo "</td></tr></table>";
	
}
echo "
	</div>
	</center>
	<div id=\"right\">";
	include("includes/right.php");
	echo "</div>";
	include "footer.php";
?>