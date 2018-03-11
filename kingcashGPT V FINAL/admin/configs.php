<?php

if  ($_GET['do'] == 'configs') {
	if  ($_POST['submit']) {
		foreach ($_POST as $config => $value) {
			if ($config == 'submit') {
				continue;
			} else {
				mysql_query("UPDATE config SET `value`='".mysql_real_escape_string($value)."' WHERE `config`='".mysql_real_escape_string($config)."'") or die(mysql_error());
			}
		}
		print "Configs Updated<br><br>";
	}
	$query = "SELECT * FROM config";
	$result = mysql_query($query) or die(mysql_error());
	print "<table width=90%>
<tr><th colspan=2>Website Configs</th></tr>
<form method=POST>";	
	while ($configs = mysql_fetch_array($result)) {
		print"<tr><td>".htmlentities($configs['name'])."</td><td><input type=text name='".$configs['config']."' value='".$configs['value']."'></td>";
	}
	
	print"<tr><td><input type=submit name=submit value=Submit></form></td><td></td></table>";

} else {
	admin_wrong_file();
}

?>