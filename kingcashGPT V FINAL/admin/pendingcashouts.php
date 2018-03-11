<?php
if ($_GET['do'] == "pendingcashouts") {
	if ($_POST['deny']) {
		if (isset($_POST['amount'])){
		$getuser = mysql_query("SELECT * FROM users WHERE username='".$_POST['username']."'");
		$user = mysql_fetch_array($getuser) or die(mysql_error());
		mysql_query("UPDATE cashouts SET status=2 WHERE id='".$_POST['cid']."'") or die(mysql_error());
		mysql_query("UPDATE users SET current_balance=current_balance+'".$_POST['amount']."' WHERE id='".$user['id']."'") or die(mysql_error());
		print "<b>Cashout Denied</b>";
		} else {
				$getuser = mysql_query("SELECT * FROM users WHERE username='".$_POST['username']."'");
		$user = mysql_fetch_array($getuser) or die(mysql_error());
		mysql_query("UPDATE cashouts SET status=2 WHERE id='".$_POST['cid']."'") or die(mysql_error());
		mysql_query("UPDATE users SET current_balance=current_points_balance+'".$_POST['points']."' WHERE id='".$user['id']."'") or die(mysql_error());
		print "<b>Cashout Denied</b>";
		}
	}
	if ($_POST['approve']) {
		$getuser = mysql_query("SELECT * FROM users WHERE username='".$_POST['username']."'");
		$user = mysql_fetch_array($getuser) or die(mysql_error());
		mysql_query("UPDATE cashouts SET status=1 WHERE id='".$_POST['cid']."'") or die(mysql_error());
		print "<b>Cashout Approved</b>";
	}
	print "<table cellpadding=\"4\" cellspacing=\"4\">
	<tr><th>Pending Cashouts</th></tr>
	<tr>
		<td>Username</td>
		<td>Type</td>
		<td>E-Mail</td>
		<td>Amount</td>
		<td>Action</td>
		<td></td>
	</tr>";
	$getcashouts = "SELECT * FROM cashouts WHERE status=0";
	$cashouts = mysql_query($getcashouts) or die(mysql_error());
	if (mysql_num_rows($cashouts)==0) {
		print "<tr><th><b>No Pending Cashouts</b></th></tr>";
	} else {
		while ($cashout = mysql_fetch_array($cashouts)) {
			$getuser = mysql_query("SELECT * FROM users WHERE id='".$cashout['user_id']."'");
			$user = mysql_fetch_array($getuser);
				$type = $cashout['type'];
			if ($cashout['amount'] != '0.00'){
			print "<form method=POST>
			<tr>
				<td><input type=hidden name=username value='".$user['username']."'>".$user['username']."</td>
				<td><input type=hidden name=type value='".$type."'>".$type."</td>
				<td><input type=hidden name=email  value='".$cashout['email']."'>".$cashout['email']."</td>
				<td><input type=hidden name=amount value='".$cashout['amount']."'>".$cashout['amount']."</td>
				<td><input type=submit name=approve value=Approve></td>
				<td><input type=submit name=deny value=Deny></td>
			</tr>
			<input type=hidden name=cid value='".$cashout['id']."'>
			</form>";
			} else {
						print "<form method=POST>
			<tr>
				<td><input type=hidden name=username value='".$user['username']."'>".$user['username']."</td>
				<td><input type=hidden name=type value='".$type."'>".$type."</td>
				<td><input type=hidden name=email value='".$cashout['email']."'>".$cashout['email']."</td>
				<td><input type=hidden name=points value='".$cashout['points']."'>".$cashout['points']." Points</td>
				<td><input type=submit name=approve value=Approve></td>
				<td><input type=submit name=deny value=Deny></td>
			</tr>
			<input type=hidden name=cid value='".$cashout['id']."'>
			</form>";
			}
		}
	}
	print "</table>";
} else {
	admin_wrong_file();
}
?>