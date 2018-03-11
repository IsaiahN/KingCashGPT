<?php
if ($_GET['do'] == "pendingoffers") {
	if ($_POST['deny']) {
		mysql_query("UPDATE `pending` SET status=2 WHERE offer_id='".$_POST['offer']."' AND user_id='".$_POST['user']."'");
		print "<b>Offer Denied</b>";
	}
	if ($_POST['approve']) {
		mysql_query("INSERT INTO `completed` VALUES('','".$_POST['offer']."','".$_POST['user']."','".$_POST['date']."','".$_POST['reward']."')") or die(mysql_error());
		mysql_query("DELETE FROM `pending` WHERE offer_id='".$_POST['offer']."' AND user_id='".$_POST['user']."'") or die(mysql_error());
		mysql_query("UPDATE `users` SET total_earned=total_earned+'".$_POST['reward']."',current_balance=current_balance+'".$_POST['reward']."' WHERE id='".$_POST['user']."'") or die(mysql_error());
		$refearnings = $_POST['reward']/100*$configs['refearning'];
		echo "UPDATE `users` SET total_earned=total_earned+'".$refearnings."',current_balance=current_balance+'".$refearnings."'  WHERE referrer='".mysql_real_escape_string($_POST['referrer'])."'";
		if ($_POST['referrer']) {
		mysql_query("UPDATE `users` SET total_earned=total_earned+'".$refearnings."',current_balance=current_balance+'".$refearnings."'  WHERE username='".mysql_real_escape_string($_POST['referrer'])."'");
		}
		print "<b>Offer Approved</b>";
		
	}
	print "<table width=100% cellpadding=\"4\" cellspacing=\"4\">
	<tr><th>Pending Offers</th></tr>
	<tr>
		<td>Username</td>
		<td>Offer</td>
		<td>Date Submited</td>
		<td>Reward</td>
		<td>Action</td>
		<td></td>
	</tr>";
    $getpending = "SELECT * FROM `pending` WHERE status=1";
    $pending = mysql_query($getpending) or die(mysql_error());
	if (mysql_num_rows($pending)==0) {
		print "<tr><th><b>No Pending Offers</b></th></tr>";
	} else {
		while ($pend=mysql_fetch_array($pending)) {
			$getuser = mysql_query("SELECT * FROM `users` WHERE id='".$pend['user_id']."'") or die(mysql_error());
			$user = mysql_fetch_array($getuser) or die(mysql_error());
			$getoffer = mysql_query("SELECT * FROM `offers` WHERE id='".$pend['offer_id']."'") or die(mysql_error());
			$offer = mysql_fetch_array($getoffer) or die(mysql_error());
			print "<form method=POST>
			<tr>
				<td><input type=hidden name=user value='".$user['id']."'>".$user['username']."[".$user['id']."]
				<input type=hidden name=referrer value='".$user['referrer']."'></td>
				<td><input type=hidden name=offer value='".$offer['id']."'>".$offer['name']."</td>
				<td><input type=hidden name=date value='".$pend['date_submitted']."'>".$pend['date_submitted']."</td>
				<td><input type=hidden name=reward value='".$pend['reward']."'>".$pend['reward']."</td>
				<td><input type=submit name=approve value=Approve></td>
				<td><input type=submit name=deny value=Deny></td>
			</tr>
			</form>";
		}
	}
	print "</table>";
} else {
	admin_wrong_file();
}
?>