<?php
include "mysql.php";


$adscend_ip = '72.52.162.102';
$adscend_ip2 = '199.59.164.3';
$adscend_ip3 = '199.59.164.5';
$epic_media_ip = '174.120.146.36';
$request_ip = $_SERVER['REMOTE_ADDR'];
/*
[OID]	ID number of the offer that credited
[ONM]	Name of the offer
[SID]	The SubID that was passed in the offer link
[PAY]	Commission earned (Will be negative if status is revoked)
[STS]	Status of the lead. 1 for payable, 2 for revoked
[IP]	IP address of the user
[TID]	Unique transaction ID
[RND]	Randomly generated number


Example usage of variables within a postback URL:
http://yoursite.com/postback.php?campid=[OID]&name=[ONM]&rate=[PAY]&sid=[SID]&status=[STS]&ip=[IP] 
*/

// epic edge media
if(($request_ip == $adscend_ip ) || ($request_ip == $adscend_ip2 ) || ($request_ip == $adscend_ip3 )) {

	$ip = mysql_real_escape_string($_GET['ip']);
	$credit = mysql_real_escape_string($_GET['status']);
	$campaignid = mysql_real_escape_string($_GET['campid']);
	$rate = mysql_real_escape_string($_GET['rate']);
	$yti = mysql_real_escape_string($_GET['sid']); //possibly username

	
	$rate = $rate * .60;
	$offerselect = mysql_fetch_assoc(mysql_query("SELECT * FROM offers WHERE cid='".$campaignid."'"));
	
	 if($credit == 1){ //completed
	    $date = date("F j, Y, g:i a");
	    $users = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username='".$yti."' LIMIT 1"));
	    $qcomplete = "INSERT INTO `completed`(`id`, `offer_id`, `user_id`, `date_submitted`, `reward`) VALUES ('','".$campaignid."','".$users['id']."','".$date."','".$rate."')";
	    mysql_query($qcomplete) or die(mysql_error()); //puts offer into the completed list
	    
	    $delpending = "DELETE * FROM pending WHERE  user_id='".$users['id']."' AND offer_id='".$campaignid."' ";
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
		
		
	 }else if($credit == 2) { //reversal
	    $date = date("F j, Y, g:i a");
	    $users = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username='".$yti."' LIMIT 1"));
	   	
	    $delcomplete = "DELETE * FROM completed WHERE  user_id='".$users['id']."' AND offer_id='".$campaignid."' ";
	    mysql_query($delcomplete); // removes offer from the completed list.
	    $delpending = "DELETE * FROM pending WHERE  user_id='".$users['id']."' AND offer_id='".$campaignid."' ";
	    mysql_query($delpending); // removes offer from the pending list.
	    $setdeny = "INSERT INTO `pending`(`id`, `offer_id`, `user_id`, `date_submitted`, `reward`, `status`) VALUES ('','".$campaignid."','".$users['id']."','".$date."','".$rate."', '2')";
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