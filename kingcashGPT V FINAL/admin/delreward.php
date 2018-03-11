<?php
if ($_GET['do'] == "delreward") {
    if ($_POST['done']) {
        mysql_query("DELETE FROM rewards WHERE `id`='".$_POST['offer']."'", $c);
        print "{$name} has been removed.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=removereward method=post><select name=offer>";
        $getoffers = mysql_query("select * from rewards", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['id']}'>{$off['name']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Remove Reward'></form>";
    } else if ($_POST['next'] == 1) {
        $getoffer = mysql_query("select * from rewards where `id`='".$_POST['offer']."'", $c);
        $off      = mysql_fetch_array($getoffer);
        print "<table width=90%>
<tr><th colspan=2>Deleting Reward: {$off['name']}</th></tr>
<tr><td align=center>
Are you sure you wish to delete the following Reward?<br><b>{$off['name']}</b>
</td>
<td>
<form action=?do=removereward method=post>
<input type=hidden name=done value=1>
<input type=hidden name=subm value=1>
<input type=hidden name=next value=1>
<input type=hidden name=offer value={$off['id']}>
<input type=submit class=button value=\"Delete Reward\"></form>
</td>
</tr></table>
";
    }
} else  {
	admin_wrong_file();
}

?>