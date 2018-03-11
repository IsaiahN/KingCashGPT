<?php
if ($_GET['do'] == "editreward") {
    if ($_POST['done']) {
        mysql_query("UPDATE rewards SET `name`='{$_POST['name']}', `amount`='{$_POST['amount']}' 
WHERE `id`='".$_POST['id']."'", $c);
        print "{$_POST['name']} has been edited.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=editreward method=post><select name=edituser>";
        $getoffers = mysql_query("select * from rewards", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['id']}'>{$off['name']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Edit Reward'></form>";
    } elseif ($_POST['next'] == 1) {
        print "<table width=90%>
<tr><th colspan=2>Editing Rewards</th></tr>
<tr><td>
";
        $geto = mysql_query("select * from rewards WHERE id='{$_POST['edituser']}' ", $c);
        $o    = mysql_fetch_array($geto);
        print "
<form action=?do=editreward method=post><input type=hidden name=subm value=1><input 
type=hidden name=done value=1><input type=hidden name=id value={$o['id']}>
Name<br><input type=text name=name value='{$o['name']}'><br>
Amount<br><input type=text name=amount value='{$o['amount']}'><br>
<input type=submit class=button value=\"Edit Reward\"></form>
</td>
</tr></table>
</center>
";
    }
} else {
	admin_wrong_file();
}

?>