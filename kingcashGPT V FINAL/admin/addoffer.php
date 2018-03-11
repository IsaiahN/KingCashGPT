<?php
if ($_GET['do'] == "addoffer") {
    if ($_POST['subm']) {
       
        mysql_query("insert into offers values('','{$_POST['cid']},'{$_POST['name']},{$_POST['url']}', '{$_POST['info']}', '{$_POST['requirements']}', '{$_POST['reward']}', '{$_POST['points']}', '{$_POST['category']}','{$_POST['countries']}','{$_POST['reward_type']}','{$_POST['banner']}','{$_POST['banner_width']},','{$_POST['banner_height']}','{$_POST['active']}')") or die(mysql_error());
        print "<center><b>{$_POST['name']} has been added.</b></center>";
    } else {
        print "<table width=90%>
<tr><th colspan=2 class='font'>Adding New Offer</th></tr>
<tr><td>  
<form action=?do=editoffer method=post><input type=hidden name=subm value=1>
<input type=hidden name=done value=1>
<input type=hidden name=offer value=>
<label>Name:</label> <input type=text name=name value=''><br>
<label>Campaign ID:</label> <input type=text name=cid value=''><br>
<label>Name:</label> <input type=text name=affid value=''><br>
<label>URL:</label> <input type=text name=url value=''> <font size=1 color=red>no trailing / 
!!!!!!</font><br>
<label>Requirements:</label> <input type=text name=requirements value=''><br>
<label>Offer Information:</label><input type=text name=info value=''><br>
<label>Cash Value:</label> <input type=text name=reward value=''><font size=1 color=red>example: 0.00</font><br>
<label>Point Value:</label> <input type=text name=points value=''><font size=1 color=red>example: 0.00</font><br>
<label>Payment Type:</label> 
<select class='feature_admin_inputs' name=reward_type>
<option value=0 >Cash</option>
<option value=1 >Points</option>
<option value=2 >Both</option></select><br><br>
<label>Category:</label> <select class='feature_admin_inputs' name=category>";
$gettypes = "SELECT * FROM offer_types WHERE active=1";
$types = mysql_query($gettypes) or die(mysql_error()); 
if (mysql_num_rows($types)==0) {
	print "<option value=1 selected>Freebies</option>";
} else {
	while ($type = mysql_fetch_array($types)) {
		print "<option value='".$type['id']."'>".$type['type']."</option>";
	}
}
print"</select><br><br>
<label>Countries:</label> <textarea class='feature_admin_inputs' name=countries class=admin></textarea><br>
<label>Banner IMG:</label> <input type=text name=banner value=''><br> 
<label>Banner Width:</label> <input type=text name=banner_width value=''><br> 
<label>Banner Height:</label> <input type=text name=banner_height value=''><br> 
<label>Active:</label> <select class='feature_admin_inputs' name=active><option value=1 $yes>Yes</option><option value=0 
$no>No</option></select><br>
<br>
<input type=submit class=button value=\"Edit Offer\"></form>
</td>
</tr></table><br><br>
Hint: To Add Username in the link please use [USERNAME]. For example http://www.google.com/[USERNAME] will look like http://www.google.com/Admin if you are logged in as Admin.
";
	}
} else {
	admin_wrong_file();
}

?>