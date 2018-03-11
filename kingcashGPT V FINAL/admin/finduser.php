<?php
if ($_GET['do'] == "finduser") {
    print "<table width=90%><tr><th>Finding User</th></tr><tr><td>";
    if ($_GET['user'] != "") {
        $checkuser = mysql_query("select * from users where `username`='{$_GET['user']}'", $c);
        $r         = mysql_fetch_array($checkuser);
        if (mysql_num_rows($checkuser) == 0) {
            print "User not found.";
        } else {
            if ($r['paypal'] == "") {
                $r['paypal'] = "Not Set";
            }
            if ($r['email_verified'] == 1) {
                $verified = "Yes";
            } else {
                $verified = "No";
            }
            print "
<div style=\"text-align: left;line-height: 20px;color: #2f2f2f;\">
<form action=?do=finduser&user={$r['username']} method=post><input type=hidden name=subm 
value=1>
Username: {$r['username']}<br>
Current Balance: \${$r['current_balance']}<br>
Current Points Balance: {$r['current_points_balance']} Points<br>
Total Earned: \${$r['total_earned']}<br>
Total Points Earned: \${$r['total_points_earned']}<br>
Email: {$r['email']}<br>
Verified: $verified<br>
Paypal : {$r['paypal']}<br>
</div>";
}
    } else {
        print "<form method=get><input type=hidden name=do 
value=finduser>Username: <input type=text name=user><br><br><input type=submit class=button 
value=\"Find User\"></form>";
    }
    print "</td></tr></table>";
} else {
	admin_wrong_file();
}
?>