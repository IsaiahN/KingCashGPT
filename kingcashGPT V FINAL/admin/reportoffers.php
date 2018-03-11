<?php
if ($_GET['do'] == "reportoffers") {
	if ($_POST['remove']) {
		
		$getuser = mysql_query("SELECT * FROM users WHERE username='".$_POST['username']."'");
		$user = mysql_fetch_array($getuser) or die(mysql_error());
		mysql_query("DELETE FROM offers WHERE cid='".$_POST['cid']."'") or die(mysql_error());
		mysql_query("DELETE FROM reported_offers WHERE offer_id='".$_POST['cid']."'") or die(mysql_error());
		print "<b>Reported Offer Removed From Offer list.</b>";
		}
	if ($_POST['keep']) {
		mysql_query("DELETE FROM reported_offers WHERE offer_id='".$_POST['cid']."'") or die(mysql_error());
		print "Reported Offer Has Been Kept</b>";
	}
	

	
	print "<table cellpadding=\"4\" cellspacing=\"4\">
	<tr><th>Pending Reported Offers</th></tr>
	<tr>
		<td>Reporter</td>
		<td>Offer Name</td>
		<td>Offer ID</td>
		<td>Date Reported</td>
		<td>Action</td>
		<td></td>
	</tr>";
	$getreport = mysql_query("SELECT * FROM reported_offers") or die(mysql_error());
	if (mysql_num_rows($getreport)==0) {
		print "<tr><th><b>No Pending Reported Offers</b></th></tr>";
	} else {
		while ($report = mysql_fetch_array($getreport)) {
		$getinfo = mysql_query("SELECT * FROM offers WHERE cid = '".$report['offer_id']."'") or die(mysql_error());
		while ($info = mysql_fetch_array($getinfo)){
			print "<form method=POST>
			<tr>
				<td><input type=hidden name=username value='".$report['user']."'>".$report['user']."</td>
				<td><input type=hidden name=name value='".$info['name']."'>".$info['name']."</td>
				<td><input type=hidden name=cid  value='".$report['offer_id']."'>".$report['offer_id']."</td>
				<td><input type=hidden name=date value='".$report['date']."'>".$report['date']."</td>
				<td><input type=submit name=remove value=Remove></td>
				<td><input type=submit name=keep value=Keep></td>
			</tr>
			
			</form>";
		}
			
		}
	}
	print "</table>";
} else {
	admin_wrong_file();
}
?>