<?php
if ($_GET['do'] == "editoffer") {
    if ($_POST['done']) {
        mysql_query("UPDATE offers SET `cid`='{$_POST['cid']}',`name`='{$_POST['name']}',`url`='{$_POST['url']}',`info`='{$_POST['info']}',`requirements`='{$_POST['requirements']}',`reward`='{$_POST['reward']}',`points`='{$_POST['points']}',`category`='{$_POST['category']}',`countries`='{$_POST['countries']}',`reward_type`='{$_POST['reward_type']}',`banner`='{$_POST['banner']}',`banner_width`='{$_POST['banner_width']}',`banner_height`='{$_POST['banner_height']}',`active`='{$_POST['active']}' WHERE id='{$_POST['offer']}'", $c);
        print "{$_POST['name']} has been edited.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=editoffer method=post><select name=offer>";
        $getoffers = mysql_query("select * from offers", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['id']}'>{$off['name']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Edit Offer'></form>";
    } else if ($_POST['next'] == 1) {
        print "<table width=90%>
<tr><th colspan=2>Editing Offer</th></tr>
<tr><td>
";
        $getoffer = mysql_query("select * from offers where id={$_POST['offer']}", $c);
        $off      = mysql_fetch_array($getoffer);
        if ($off['active'] == 1) {
            $yes = "selected";
            $no  = "";
        } else {
            $yes = "";
            $no  = "selected";
        }
        print "
<form action=?do=editoffer method=post><input type=hidden name=subm value=1>
<input type=hidden name=done value=1>
<input type=hidden name=offer value={$_POST['offer']}/>
<label>Campaign ID:</label> <input type=text name=cid value='{$off['cid']}'><br>
<label>Name:</label> <input type=text name=affid value='{$off['name']}'><br>
<label>URL:</label> <input type=text name=url value='{$off['url']}'> <font size=1 color=red>no trailing / 
!!!!!!</font><br>
<label>Requirements:</label> <input type=text name=requirements value='{$off['requirements']}'><br>
<label>Offer Information:</label><input type=text name=info value='{$off['info']}'><br>
<label>Cash Value:</label> <input type=text name=reward value='{$off['reward']}'><font size=1 color=red>example: 0.00</font><br>
<label>Point Value:</label> <input type=text name=points value='{$off['points']}'><font size=1 color=red>example: 0.00</font><br>
<label>Payment Type:</label> 
<select class=feature_admin_inputs name=reward_type>
<option value=0 >Cash</option>
<option value=1 >Points</option>
<option value=2 >Both</option></select><br><br>
<label>Category:</label> <select class=feature_admin_inputs name=category>";
$gettypes = "SELECT * FROM offer_types WHERE active=1";
$types = mysql_query($gettypes) or die(mysql_error());
if (mysql_num_rows($types)==0) {
	print "<option value=1 selected>Freebies</option>"; 
} else {
	while ($type = mysql_fetch_array($types)) {
		if ($type['id']==$off['type']) {
			print "<option value='".$type['id']."' selected>".$type['type']."</option>";
		} else {
			print "<option value='".$type['id']."'>".$type['type']."</option>";
		}
	}
}
print"</select><br><br>
<label>Countries:</label> <textarea class=feature_admin_inputs name=countries class=admin>{$off['countries']}</textarea><br>
<label>Banner IMG:</label> <input  type=text name=banner value='{$off['banner']}'><br> 
<label>Banner Width:</label> <input type=text name=banner_width value='{$off['banner_width']}'><br> 
<label>Banner Height:</label> <input type=text name=banner_height value='{$off['banner_height']}'><br> 
<label>Active:</label> <select class=feature_admin_inputs name=active><option value=1 $yes>Yes</option><option value=0 
$no>No</option></select><br>
<br>
<input type=submit class=button value=\"Edit Offer\"></form>
</td>
</tr></table>
";
    }
} else {
	admin_wrong_file();
}

?>