<?php
if ($_GET['do'] == "blockip") {
    if ($_POST['subm']) {
	$ipadd = $_POST['ip'];
	$reason = $_POST['reason'];
        $sql = mysql_query("INSERT INTO banned (ip_addr, reason) VALUES ('" . $ipadd . "', '" . 
$reason . "')");
        print "{$_POST['ip']} has been been blocked, with the reason {$_POST['reason']}";
    } else {
        print "<table width=90%>
<tr><th colspan=2>Ban an IP Address</th></tr>
<tr><td>
<form action=?do=blockip method=post><input type=hidden name=subm value=1>
IP Address:<input type=text name=ip><br>
Reason:<input type=text name=reason><br>
</td>
<td>
<input type=submit class=button value=\"Ban IP\"></form>
</td>
</tr></table>
";
    }
} else {
	admin_wrong_file();
}
?>