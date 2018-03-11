<?php
if ($_GET['do'] == "deluser") {
    if ($_POST['done']) {
        mysql_query("delete from users where id={$_POST['offer']}", $c);
        print "{$off['username']} has been removed.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=deleteuser method=post><select name=offer>";
        $getoffers = mysql_query("select * from users", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['id']}'>{$off['username']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Remove user'></form>";
    } else if ($_POST['next'] == 1) {
        $getoffer = mysql_query("select * from users where id={$_POST['offer']}", $c);
        $off      = mysql_fetch_array($getoffer);
        print "<table width=90%>
<tr><th colspan=2>Deleting Offer: {$off['username']}</th></tr>
<tr><td align=center>
Are you sure you wish to delete the following user?<br><b>{$off['username']}</b>
</td>
<td>
<form action=?do=deleteuser method=post>
<input type=hidden name=done value=1>
<input type=hidden name=subm value=1>
<input type=hidden name=next value=1>
<input type=hidden name=offer value={$off['id']}>
<input type=submit class=button value=\"Delete User\"></form>
</td>
</tr></table>
";
    }
} else  {
	admin_wrong_file();
}

?>