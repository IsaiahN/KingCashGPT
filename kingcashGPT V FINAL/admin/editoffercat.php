<?php
if ($_GET['do'] == "editoffercat") {
    if ($_POST['done']) {
        mysql_query("UPDATE offer_types SET `type`='{$_POST['type']}',`active`='{$_POST['active']}' WHERE id={$_POST['offer']}", $c);
        print "{$_POST['type']} has been edited.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=editoffercat method=post><select name=offer>";
        $getoffers = mysql_query("select * from offer_types", $c) or ide(mysql_error());
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['id']}'>{$off['type']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Edit Offer Category'></form>";
    } else if ($_POST['next'] == 1) {
        print "<table width=90%>
<tr><th colspan=2>Editing Offer Category</th></tr>
<tr><td>
";
        $getoffer = mysql_query("select * from offer_types where id={$_POST['offer']}", $c);
        $off      = mysql_fetch_array($getoffer);
        if ($off['active'] == 1) {
            $yes = "selected";
            $no  = "";
        } else {
            $yes = "";
            $no  = "selected";
        }
        print "
<form action=?do=editoffercat method=post><input type=hidden name=subm value=1><input 
type=hidden name=done value=1><input type=hidden name=offer value={$_POST['offer']}>
Name: <input type=text name=type value='{$off['type']}'><br>
Active: <select name=active><option value=1 $yes>Yes</option><option value=0 
$no>No</option></select><br>
</td>
<td>
<input type=submit class=button value=\"Edit Offer Category\"></form>
</td>
</tr></table>
";
    }
} else {
	admin_wrong_file();
}
?>