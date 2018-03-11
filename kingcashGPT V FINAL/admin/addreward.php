<?php
if ($_GET['do'] == "addreward") {
    if ($_POST['subm']) {       
        mysql_query("insert into rewards values('','{$_POST['rname']}', '{$_POST['amount']}')", 
$c);
        print "{$_POST['rname']} has been added.";
    } else {
        print "<table width=90%>
<tr><th colspan=2>Adding New Reward</th></tr>
<tr><td>
<form action=?do=addreward method=post><input type=hidden name=subm value=1>
Reward Name <br><input type=text name=rname><br>
Amount  : <br><input type=text name=amount><br>
</td>
<td>
<input type=submit class=button value=\"Add Reward\"></form>
</td>
</tr></table>
";
	}
} else {
	admin_wrong_file();
}
?>