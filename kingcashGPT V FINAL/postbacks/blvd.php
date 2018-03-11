<?php
$database = "kingcash_gpt"; //your database name
$dbuser   = "kingcash_admin"; //admin user of the database
$dbpass   = "jomiks"; //password of the admin user of the database
$c= mysql_connect('localhost', $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($database);
if (!$c)
  {
  die('Could not connect: ' . mysql_error());
  }



$blvd_ip = '174.143.53.42';
$blvd_ip2 = '24.234.84.133';
$request_ip = $_SERVER['REMOTE_ADDR'];

// epic edge media
if (($request_ip == $blvd_ip ) || ($request_ip == $blvd_ip2 )) {
	$campaignid = mysql_real_escape_string($_GET['CampId']);
	$rate = mysql_real_escape_string($_GET['Earn']);
	$yti = mysql_real_escape_string($_GET['SubId']); //possibly username
	$name = mysql_real_escape_string($_GET['CampaignName']);

	

	 $date = date("F j, Y, g:i a");
	    $users = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username='".$yti."' LIMIT 1"));
	    $qcomplete = "INSERT INTO `completed`(`id`, `offer_id`, `user_id`, `date_submitted`, `reward`) VALUES ('','1234567','".$users['id']."','".$date."','".$rate."')";
	    mysql_query($qcomplete) or die(mysql_error()); //puts offer into the completed list
	    $pointsadd = "UPDATE `users` SET `total_points_earned`=total_points_earned + ".$rate.", `current_points_balance`=current_points_balance + ".$rate." WHERE username = '".$yti."'";
	    mysql_query($pointsadd) or die(mysql_error()); // add points.   
	    $rate = money_format('%i', $rate); 
	    $messagejoin = "<br><b><b style=\"color:green;\">".$yti."</b> earned ".$rate." points on <b>Reward Tool: ".$name."</b>!"; 
	    
	    	$usernamebot = "<img src=\"images/bot.png\" alt=\"\" /><span class=\"botchat\">KingCashGPT Bot</span>";
		$querychat =" INSERT INTO `shoutbox` VALUES('', NOW(), '".mysql_real_escape_string($usernamebot)."', '".mysql_real_escape_string($messagejoin)."')";
		mysql_query($querychat) or die(mysql_error());
		echo "Success: ".$yti." gained ".$rate." points";
	    	mysql_close();
		
}		
else {
echo" Your Ip did not match things properly";
exit;
}
?>