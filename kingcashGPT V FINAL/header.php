<?php
ini_set('zlib.output_compression', 'On');  
ini_set('zlib.output_compression_level', '1');
include "functions.php";
include "mysql.php";

while($setup = mysql_fetch_assoc(mysql_query("SELECT * FROM config"))) {
	$config_var_1 = $setup['config'];
    $config_var_2 = $setup['value'];
    $configs[$config_var_1] = $config_var_2;
}

if ( isset($_SERVER["REMOTE_ADDR"]) )    {
		$ip =  $_SERVER["REMOTE_ADDR"];
} else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
		$ip =  $_SERVER["HTTP_CLIENT_IP"];
} 

$banned  = mysql_query("select * from `banned` where ip_address = '".$ip."'");
while($banned_cause = mysql_fetch_assoc($banned))

if (mysql_num_rows($banned) >= 1) {
	header("Location: banned.php");
}

if($_GET['referral']) {
$expire = time()+60*60*24*30;
$referral = $_GET['referral'];
setcookie('referral', $referral, $time);
echo '<script> window.location="'.$_SERVER['PHP_SELF'].'"; </script>';

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<head>
<link rel="icon" type="image/png" href="/favicon.ico" />
<title><?= $configs['sitename']; ?> - <?= $configs['slogan']; ?></title>
<link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']; ?>/style.css" type="text/css" media="screen" />
<? if ($_SERVER['PHP_SELF'] == "/index.php") {?>
<link rel="stylesheet" href="slider/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="slider/images/orman.css" type="text/css" media="screen" />
<?}?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta name="Description" content="It's easy to earn money online doing paid surveys on KingCashGPT! This site is great for single parents or college students who want to make money online. " />
<meta name="Keywords" content="earn cash, earn money at home, paid surveys, make money online, free cash, free stuff, free groceries, work from home, stay at home mom, single parents, earn money college student, high school students" />
<script src="cufon-yui.js" type="text/javascript"></script>
<script src="Pristina_400.font.js" type="text/javascript"></script>
<script type="text/javascript">
Cufon.replace('h1');
Cufon.replace('h2');
Cufon.replace('#menu a');
Cufon.replace('.midbottom table');
Cufon.replace('.font');
Cufon.replace('#navigation span');
Cufon.replace('#navigation a');
</script>
</head>
<?php flush(); ?>
<body>

<?
//if ($_GET['referral'] != "") {
if (!isset($_GET['referral']) ) {
    $referral = strip_tags($_GET['referral']);
}
?>
<div id="wrapper">
<div id="header">
	<div id="navigation">
		<?
		if ($_SESSION['login'] == 'YES') {
				echo "
				<span>Welcome Back, <font color=\"#FF8300\">".$_SESSION[username]."</font> | </span>
				<a href=\"logout.php\">Logout</a>";
			} else {
				echo "
				<span>Welcome, User! | </span>
				<a href=\"login.php\">Login</a>";
			}
			$get_offers = mysql_query("SELECT * FROM `offers` WHERE active=1");
			$total_offers = mysql_num_rows($get_offers);
			
			$get_users = mysql_query("SELECT * FROM `users`");  
			$total_users = mysql_num_rows($get_users);   
			
			while($user = mysql_fetch_array($get_users)) {
				$total_money = $total_money + $user['total_earned'];
				$total_points = $total_points + $user['total_points_earned'];
			}

	echo '</div><div id="menu">';

if ($_SESSION['login'] == 'YES') {
$button_register = "";
$log_in_out = "<li><a href=\"logout.php?do=logout\">Logout</a></li>";
$getuserinfo = mysql_query("SELECT * FROM `users` WHERE id='".$_SESSION['userid']."'");
$userinfo = mysql_fetch_assoc($getuserinfo);

    mysql_query("UPDATE `users` SET `userIP` = '".$ip."' WHERE id='".$_SESSION['userid']."'");
    if ($userinfo['banned'] != "") {
        die("<h1 color=\"red\"><b>Your account has been terminated on the grounds of fraudulent activity.</b><br />Reason: ".$userinfo['banned']."</h1> <br /> <span>If you believe that this termination is in error,  <br /> Contact the Admin : support@kingcashgpt.com</span>");
    }
} else {
$button_register =  "<li id=\"register\"><a href=\"http://".$_SERVER['SERVER_NAME']."/register.php\">Register</a></li>";
$log_in_out    = "<li id=\"login\"><a href=\"http://".$_SERVER['SERVER_NAME']."/login.php\">Login</a></li>";
}
?>
<ul>
<li><a href="http://<?=$_SERVER['SERVER_NAME']; ?>/index.php">Home</a></li>
<li><a href='http://<?=$_SERVER['SERVER_NAME']; ?>/forums'>Forums</a></li>
<? echo $button_register ; ?>
<li><a href='http://<?=$_SERVER['SERVER_NAME']; ?>/offers.php'>Offer Central</a></li>
<? if ($_SESSION['login'] == 'YES'){ 
echo "
<li><a href='http://".$_SERVER['SERVER_NAME']."/stats.php'>My Account</a></li>
<li><a href='http://".$_SERVER['SERVER_NAME']."/cashout.php'>Cashout</a></li>";
}
$_SESSION['username'] = $userinfo['username']; // This is for the welcome username section
echo $log_in_out;
echo '
</ul>
</div>
</div>
<div id="main">';	
if ($_SESSION['login'] == 'YES' && $userinfo['email_verified'] != 1) {
echo '<h1 color="red">Your email has not been verified.<br />You will not be able to use the site until you verify your account.</h1><br /><a href="verify.php">Click here to go to the email verification page.</a><br /></br> ';
}
?>