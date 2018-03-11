<?php

if ($_GET['do'] == "bulkremoveoffers") {
    if ($_POST['done']) {
        mysql_query("delete from offers where id={$_POST['offer']}", $c);
        print "Offer has been removed.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=bulkremoveoffers method=post><select name=offer>";
        $getoffers = mysql_query("select * from offers", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['id']}'>{$off['name']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Remove Offer'></form>";
    } else if ($_POST['next'] == 1) {
        $getoffer = mysql_query("select * from offers where id={$_POST['offer']}", $c);
        $off      = mysql_fetch_array($getoffer);
        print "<table width=90%>
<tr><th colspan=2>Deleting Offer: {$off['name']}</th></tr>
<tr><td align=center>
Are you sure you wish to delete the following offer?<br><b>{$off['name']}</b>
</td>
<td>
<form action=?do=bulkremoveoffers method=post>
<input type=hidden name=done value=1>

<span> Offers to delete (Separate by a comma)
<textarea rows="2" name=offers cols="20">

</textarea> 
<input type=submit class=button value=\"Bulk Delete Offers\">
</form>
</td>
</tr></table>
";
    }
} else {
	admin_wrong_file();
}

?>