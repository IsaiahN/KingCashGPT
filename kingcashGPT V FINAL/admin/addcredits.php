<?php
if($_GET['do']=="addcredits")
{
print"<table width=90%><tr><th>Adding Credits</th></tr><tr><td>";
if($_GET['user'] !=""){
if($_POST['value'] ==""){
print"Please Enter Amount of Credits you want to Add<br><a 
href='?do=addcredits'>Back</a>";
print"</td></tr></table>";
include"side.php";
include"footer.php";
exit;
} else {
$username=$_POST['username'];
$checkvalue=mysql_query("select `current_balance`,`id` from users where 
`username`='{$_GET['user']}'");
$array = mysql_fetch_array($checkvalue);
$newvalue =$array['current_balance']+$_POST['value'];
mysql_query("update users set 
current_balance=$newvalue,total_earned=total_earned+{$_POST['value']} where id={$array['id']}") 
or die(mysql_error());
print"Credits Updated";
}
}
if($_POST['username']=="")
{
print"<form action=?do=addcredits method=post>Search For Username: <input type=text 
name=username><br><br><input type=submit class=button value=\"Search User\"></form>";
} else {
$checkuser=mysql_query("select * from users where `username`='{$_POST['username']}'");
$cu=mysql_fetch_array($checkuser);
if(mysql_num_rows($checkuser)==0)
{
print"User not found.";
} else {
print"<form action=?do=addcredits&user=".$_POST['username']." method=post><br>How much 
do you want to add to ".$_POST['username']."?<br><input type=text name=value><br><input 
type=submit class=button value=\"Add Points\"></form>";
}
}
print"</td></tr></table>";
} else {
	admin_wrong_file();
}

?>