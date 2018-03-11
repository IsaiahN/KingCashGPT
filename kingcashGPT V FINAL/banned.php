<?php
session_start();
include "header.php";
echo '<div id="left">';
		include("includes/left.php");		
echo '</div>
	<div id="middle" class="feature" >';
		if ( isset($_SERVER["REMOTE_ADDR"]) )    {
			$ip =  $_SERVER["REMOTE_ADDR"];
		} else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
			$ip =  $_SERVER["HTTP_CLIENT_IP"];
		} 
		$chkban  = mysql_query("SELECT * FROM `banned` WHERE ip_address = '".$ip."'");
		while($reason = mysql_fetch_array($chkban))
		
		if (mysql_num_rows($chkban) >= 1) {
		echo "<h1>Dear, Visitor your IP : ".$ip." has been banned for the following: <br />".$reason['reason']."</h1> <br /> <span>If you think this was done in error, contact the admin: support@kingcashgpt.com</span>";
		}
echo "
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
?>