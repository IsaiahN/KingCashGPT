<?php
if ($_GET['do'] == "addoffercat") {
    if ($_POST['subm']) {
        mysql_query("INSERT INTO offer_types VALUES('','".$_POST['type']."','".$_POST['active']."')") or die(mysql_error());
        print "{$_POST['type']} has been added.";
    } else {
        print "<table width=90%>
<tr><th colspan=2>Adding New Offer Category</th></tr>
<tr><td>
<form action=?do=addoffercat method=post><input type=hidden name=subm value=1>
Name: <br><input type=text name=type><br>
Active: <select name=active><option value=1 selected>Yes</option><option 
value=0>No</option></select><br>
</td>
<td>
<input type=submit class=button value=\"Add Offer Category\"></form>
</td>
</tr></table>
";
	}
} else {
	admin_wrong_file();
}
?>