<?php
if ($_GET['do'] == "report") {
    if($_POST['delete'] == 1){
     mysql_query("DELETE FROM report WHERE `username`='".$_POST['username']."' AND `offer_id`='".$_POST['id']."'", $c);
        print "Reported offer removed.";
        }else{
    print "<table width=90%>
    <tr>
    <th>Offer Name</th>
    <th>Username</th>
    <th>Reason</th>
    </tr>";
    $getreport = mysql_query("select * from report", $c);
    if (mysql_num_rows($getreport) == 0) {
        print "<tr><td><center>There are no offers reported.</center></td><td></td><td></td></tr></table>";
    } else {
        while ($report = mysql_fetch_array($getreport)) {
            $getinfo = mysql_query("select * from report", $c);
            $getport          = mysql_fetch_array($getinfo);
            $offer = mysql_query("select * from offers where `id`='".$report['offer_id']."'",$c);
            $getname = mysql_fetch_row($offer);
            print "<tr>
            <td>{$getname['1']}</td>
            <td>{$report['username']}</td>
            <td>{$report['reason']}<br>
            <form action=?do=report method=post>
<input type=hidden name=delete value=1>
<input type=hidden name=id value={$report['offer_id']}>
<input type=hidden name=username value={$report['username']}>
<input type=submit class=button value=\"Remove\"></form></td>
            </tr>
            </table>
            ";
        }
    }
}
} else {
	admin_wrong_file();
}
?>