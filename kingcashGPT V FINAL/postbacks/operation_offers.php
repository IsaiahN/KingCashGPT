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


$operation_offers_ip = '174.132.180.124';
$request_ip = $_SERVER['REMOTE_ADDR'];
/*
%websiteid% 	The ID of the Website being credited/reversed.
%campaignid% 	The ID of the Campaign being credited/reversed.
%campaignname% 	The name of the Campaign being credited/reversed.
%rate% 	The amount you were credited/reversed.
%ip% 	The IP of the user who completed this campaign.
%yti% or %yti1% 	This variable contains your tracking info.
%yti2% 	This variable contains your tracking info.
%yti3% 	This variable contains your tracking info.
%yti4% 	This variable contains your tracking info.
%yti5% 	This variable contains your tracking info.
%credit% 	1 = Credit, -1 = Reverse
%datetime% 	This date and time of this PostBack.

Below is an example of how the PostBack would be used:
http://mysite.com/postbackscript.php?campaignid=%campaignid%&yti=%yti%&credit=%credit%
*/

// epic edge media
if ($request_ip == $operation_offers_ip ) {
	$ip = mysql_real_escape_string($_GET['ip']);
	$credit = mysql_real_escape_string($_GET['credit']);
	$campaignid = mysql_real_escape_string($_GET['campaignid']);
	$rate = mysql_real_escape_string($_GET['rate']);
	$yti = mysql_real_escape_string($_GET['yti']); //possibly username
	$yti2 = mysql_real_escape_string($_GET['yti2']); // points or cash
	
	$rate = $rate * .60;
	$offerselect = mysql_fetch_assoc(mysql_query("SELECT * FROM offers WHERE cid='999".$campaignid."'"));
	
	 if($credit == 1){ //completed
	    $date = date("F j, Y, g:i a");
	    $users = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username='".$yti."' LIMIT 1"));
	    $qcomplete = "INSERT INTO `completed`(`id`, `offer_id`, `user_id`, `date_submitted`, `reward`) VALUES ('','999".$campaignid."','".$users['id']."','".$date."','".$rate."')";
	    mysql_query($qcomplete) or die(mysql_error()); //puts offer into the completed list
	    
	    $delpending = "DELETE * FROM pending WHERE  user_id='".$users['id']."' AND offer_id='999".$campaignid."' ";
	    mysql_query($delpending); // removes offer from the pending list.
	    
	    if ( $offerselect['reward_type'] == "Points") { //points offer
	    $rate = $rate * 100; //gets you accurate points
	    $pointsadd = "UPDATE `users` SET `total_points_earned`=total_points_earned + ".$rate.", `current_points_balance`=current_points_balance + ".$rate." WHERE username = '".$yti."'";
	    mysql_query($pointsadd) or die(mysql_error()); // add points. 
	    $rate = money_format('%i', $rate);   
	    $messagejoin = "<br><b><b style=\"color:green;\">".$yti."</b> earned ".$rate." points on <b>".$offerselect['name']."!</b>"; 
	    
	    } else if ($offerselect['reward_type'] == "Cash") { //cash offer
	    $cashadd = "UPDATE `users` SET `total_earned`=total_earned + ".$rate.", `current_balance`=current_balance + ".$rate." WHERE username = '".$yti."'";
	    mysql_query($cashadd) or die(mysql_error()); // add cash.
	    $rate = money_format('$%i', $rate);  
	    $messagejoin = "<br><b><b style=\"color:green;\">".$yti."</b> earned ".$rate." on ".$offerselect['name']."!</b>";
	    }
	    
	    	$usernamebot = "<img src=\"images/bot.png\" alt=\"\" /><span class=\"botchat\">KingCashGPT Bot</span>";
		$querychat =" INSERT INTO `shoutbox` VALUES('', NOW(), '".mysql_real_escape_string($usernamebot)."', '".mysql_real_escape_string($messagejoin)."')";
		mysql_query($querychat) or die(mysql_error());
		echo "Success: ".$yti." gained ".$rate." dollars/points";
	    	mysql_close();
		
		
	 }else if($credit == -1) { //reversal
	    $date = date("F j, Y, g:i a");
	    $users = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username='".$yti."' LIMIT 1"));
	   	
	    $delcomplete = "DELETE * FROM completed WHERE  user_id='".$users['id']."' AND offer_id='999".$campaignid."' ";
	    mysql_query($delcomplete); // removes offer from the completed list.
	    $delpending = "DELETE * FROM pending WHERE  user_id='".$users['id']."' AND offer_id='999".$campaignid."' ";
	    mysql_query($delpending); // removes offer from the pending list.
	    $setdeny = "INSERT INTO `pending`(`id`, `offer_id`, `user_id`, `date_submitted`, `reward`, `status`) VALUES ('','999".$campaignid."','".$users['id']."','".$date."','".$rate."', '2')";
	    mysql_query($setdeny); //sets it to denied
	      
	    if ( $offerselect['reward_type'] == "Points") { //points offer
	    $rate = $rate * 100; //gets you accurate points
	    $pointssub = "UPDATE `users` SET `total_points_earned`=total_points_earned - ".$rate.", `current_points_balance`=current_points_balance - ".$rate." WHERE username = '".$yti."'";
	    mysql_query($pointssub) or die(mysql_error()); // subtracts points.    
	    } else if ($offerselect['reward_type'] == "Cash") { //cash offer
	    $cashsub = "UPDATE `users` SET `total_earned`=total_earned - ".$rate.", `current_balance`=current_balance - ".$rate." WHERE username = '".$yti."'";
	    mysql_query($cashsub) or die(mysql_error()); // subtracts cash. 
	    }
		
		echo "Success: ".$yti." lost ".$rate." dollars/points";
		mysql_close();
		
	}
}
else {
echo" there has been an error";
exit;
}
?>