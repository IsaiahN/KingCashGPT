<?php
if ($_GET['do'] == "unblockip") {
    if ($_POST['done']) {
        mysql_query("DELETE FROM banned WHERE `ip_addr`='".$_POST['offer']."'", $c);
        print "IP has been removed.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=unblockip method=post><select name=offer>";
        $getoffers = mysql_query("select * from banned", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['ip_addr']}'>{$off['ip_addr']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Remove IP Block'></form>";
    } else if ($_POST['next'] == 1) {
        $getoffer = mysql_query("select * from banned where `ip_addr`='".$_POST['offer']."'", 
$c);
        $off      = mysql_fetch_array($getoffer);
        print "<table width=90%>
<tr><th colspan=2>Deleting IP Block: {$off['ip_addr']}</th></tr>
<tr><td align=center>
Are you sure you wish to delete the following IP Ban?
</td>
<td>
<form action=?do=unblockip method=post>
<input type=hidden name=done value=1>
<input type=hidden name=subm value=1>
<input type=hidden name=next value=1>
<input type=hidden name=offer value={$off['ip_addr']}>
<input type=submit class=button value=\"Delete IP BAN\"></form>
</td>
</tr></table>
";
    }
} else {
	admin_wrong_file();
}
?>