<div class="stats">
<ul>
<li>
<?
	if ($_SESSION['loggedin'] == 1) {
		print "
		<div align=\"center\">
		<br />
		<h1>Your Stats</h1>
		<table width=\"55%\" border=\"0\">
		<tr><td align=\"left\">Your Balance:</td>
		<td align=\"left\">$".$userinfo['current_balance']."</td></tr>
		<tr><td align=\"left\">Point Balance:</td>
		<td align=\"left\">".$userinfo['current_points_balance']."</td></tr>			
		";
		$getcomplete    = mysql_query("select * from completed where user_id={$_SESSION['userid']}");
		$totalcompleted = mysql_num_rows($getcomplete);
		print "
		<tr>";
		if ( $totalcompleted > 0) {
		print "<td align=\"left\">Offers Done:</td><td align=\"left\"> ".$totalcompleted." Offers</td>";
		} else {
		print "<td align=\"left\">Offers Completed:</td><td align=\"left\"> None</td>";
		} 
		echo"
		</tr>
		</table>
		</div>
		</div>
		";
	} else {
		print "
		<div align=\"center\">
		<br />
		<h1>Site Stats</h1> 
		<table width=\"55%\" border=\"0\">
		<tr>
		<td align=\"left\">Total Offers:</td> 
		<td align=\"right\">".$total_offers."</td> 
		</tr><tr>
		<td align=\"left\">Total Members:</td>
		<td align=\"right\">".$total_users."</td>
		</tr><tr>
		<td align=\"left\">Total Earned:</td>
		<td align=\"right\">$".$total_money."</td>
		</tr><tr>
		<td align=\"left\">Total Points:</td>
		<td align=\"right\">".$total_points."</td>
		</tr>
		</table>
		</div>
		</div>
		";
	}
?>

<div class="lastten">
	<h1>Lastest Credited</h1>
	<table width="100%">
		<?
		$countries    = mysql_fetch_assoc(mysql_query("select * from users where user_id={$_SESSION['userid']}"));
		
		//$getlast = mysql_query("SELECT * FROM `completed` ORDER BY id DESC LIMIT 7");
		$getlast = mysql_query("SELECT *
		FROM completed m
		WHERE EXISTS (
		SELECT cid
		FROM offers
		WHERE countries LIKE '%".$countries[country]."%'
		)
		 ORDER BY m.id DESC LIMIT 8");

		
		if (mysql_num_rows($getlast)==0) {
			print "<td>There are no completed offers</td>";
		} else {
			
			while ($last = mysql_fetch_array($getlast)) {

				$getoffer = mysql_query("SELECT * FROM `offers` WHERE cid ='".$last['offer_id']."'");
				$offer = mysql_fetch_array($getoffer);
			
				print "<tr align=center><td><a href='offers.php?oid=".$last['offer_id']."' onclick=\"target='_self'\">".htmlentities($offer['name'])."</a></td></tr>";
		
			}
			
			}
		?>
	
	</table>
	
</div>
</li>
</ul>

<div class="testimonials">
	<h1>Payment Proofs</h1>
<a href="http://kingcashgpt.com/forums/viewforum.php?f=4"><img src="images/proof2.jpg" alt="video" /></a>	

</div>