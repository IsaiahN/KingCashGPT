<?php
if ($_GET['do'] == "unbanuser") {
    print "<table width=90%><tr><th>Unbanning User</th></tr><tr><td>";
    if ($_POST['username'] != "") {
        $checkuser = mysql_query("select * from users where `username`='{$_POST['username']}'", 
$c);
        $cu        = mysql_fetch_array($checkuser);
        if (mysql_num_rows($checkuser) == 0 || $cu['banned'] == "") {
            print "User not found or isn't banned..";
        } else {
            mysql_query("update users set `banned`='' where `username`='{$_POST['username']}'", 
$c);
            print "User <b>{$_POST['username']}</b> unbanned.";
        }
    } else {
        print "<form action=?do=unbanuser method=post>Username: <input type=text 
name=username><br><br><input type=submit class=button value=\"Unban User\"></form>";
    }
    print "</td></tr></table>";
} else {
	admin_wrong_file();
}

?>