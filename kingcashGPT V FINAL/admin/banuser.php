<?php

if ($_GET['do'] == "banuser") {
    print "<table width=90%><tr><th>Banning User</th></tr><tr><td>";
    if ($_POST['username'] != "") {
        $checkuser = mysql_query("select * from users where `username`='{$_POST['username']}'", 
$c);
        if (mysql_num_rows($checkuser) == 0) {
            print "User not found.";
        } else {
            $reason = $_POST['reason'];
            $reason = addslashes($reason);
            mysql_query("update users set `banned`='$reason' where 
`username`='{$_POST['username']}'", $c);
            print "User <b>{$_POST['username']}</b> banned.";
        }
    } else {
        print "<form action=?do=banuser method=post>Username: <input type=text 
name=username><br>Reason: <input type=text name=reason><br><br><input type=submit class=button 
value=\"Ban User\"></form>";
    }
    print "</td></tr></table>";
} else {
	admin_wrong_file();
}

?>