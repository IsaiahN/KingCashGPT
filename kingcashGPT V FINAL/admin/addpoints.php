<?php
if($_GET['do']=="addpoints")
{
print"<table width=90%><tr><th>Adding Points</th></tr><tr><td>";
if($_GET['user'] !=""){
if($_POST['value'] ==""){
print"Please Enter Amount Of Points That You Wish To Add<br><a href='?do=addpoints'>Back</a>";
print"</td></tr></table>";
include"side.php";
include"footer.php";
exit;
} else {
$username=$_POST['username'];
$checkvalue=mysql_query("select `current_points_balance`,`id` from users where 
`username`='{$_GET['user']}'");
$array = mysql_fetch_array($checkvalue);
$newvalue =$array['current_points_balance']+$_POST['value'];
mysql_query("update users set 
current_points_balance=$newvalue,total_points_earned=total_points_earned+{$_POST['value']} where id={$array['id']}") 
or die(mysql_error());
print"Points Updated";
}
}
if($_POST['username']=="")
{
print"<form action=?do=addpoints method=post>Search For Username: <input type=text 
name=username><br><br><input type=submit class=button value=\"Search User\"></form>";
} else {
$checkuser=mysql_query("select * from users where `username`='{$_POST['username']}'");
$cu=mysql_fetch_array($checkuser);
if(mysql_num_rows($checkuser)==0)
{
print"User not found.";
} else {
print"<form action=?do=addpoints&user=".$_POST['username']." method=post><br>How many points
do you want to add to ".$_POST['username']."?<br><input type=text name=value><br><input 
type=submit class=button value=\"Add Credits\"></form>";
}
}
print"</td></tr></table>";
} else {
	admin_wrong_file();
}

?>