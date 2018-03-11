<?php
if ($_GET['do'] == "edituser") {
    if ($_POST['done']) {
        $type = $_POST['type'];
        mysql_query("UPDATE users SET `name`='{$_POST['firstname']}', `city`='{$_POST['city']}', 
`zip`='{$_POST['zip']}', `lastname`='{$_POST['lastname']}', `sw`='{$_POST['sw']}', 
`paypal`='{$_POST['paypal']}' WHERE username='{$_POST['username']}'", $c);
        print "{$_POST['username']} has been edited.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=edituser method=post><select name=edituser>";
        $getoffers = mysql_query("select * from users", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['username']}'>{$off['username']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Edit User'></form>";
    } elseif ($_POST['next'] == 1) {
        print "<table width=90%>
<tr><th colspan=2>Editing Users</th></tr>
<tr><td>
";
        $geto = mysql_query("select * from users WHERE username='{$_POST['edituser']}' ", $c);
        $o    = mysql_fetch_array($geto);
        print "
<form action=?do=edituser method=post><input type=hidden name=subm value=1><input 
type=hidden name=done value=1><input type=hidden name=type value={$_POST['username']}>
<center>user ID<br>{$o['id']}<br>
Username<br><input type=text name=username value='{$o['username']}'><br>
Paypal<br><input type=text name=paypal value='{$o['paypal']}'><br>
Name<br><input type=text name=firstname value='{$o['name']}'><br>
LastName<br><input type=text name=lastname value='{$o['lastname']}'><br>
City<br><input type=text name=city value='{$o['city']}'><br>
Zip<br><input type=text name=zip value='{$o['zip']}'><br>
SecretWord<br><input type=text name=sw value='{$o['sw']}'><br>
<input type=submit class=button value=\"Edit User\"></form>
</td>
</tr></table>
</center>
";
    }
} else {
	admin_wrong_file();
}

?>