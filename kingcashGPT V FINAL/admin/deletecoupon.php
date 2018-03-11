<?php
if($_GET['do']=="deletecoupon")
{
print"<center><table width=50% class=center><td>";
if($_POST['done'])
{
mysql_query("delete from coupons where id={$_POST['code']}",$c);
print"Coupon Code has been removed.</table>";
}
else if($_POST['subm']!=1)
{
//get the next variable
print"<form action=?do=deletecoupon method=post><select name=code>";
$getcoupon=mysql_query("select * from coupons",$c);
while($cc=mysql_fetch_array($getcoupon))
{
print"<option name=code value='{$cc['id']}'>{$cc['code']}</option>";
}
print"</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><br><br><input type=submit class=button value='Delete Coupon'></form></td></table>";
}
else if($_POST['next']==1)
{
$getcoupon=mysql_query("select * from coupons where id={$_POST['code']}",$c);
$cc=mysql_fetch_array($getcoupon);
print"
<tr><th colspan=2>Deleting Coupon Code: {$cc['code']} Value: {$cc['value']}</th></tr>
<tr><td align=center>
Are you sure you wish to delete the following coupon code?<br><b>{$cc['code']}</b>
</td>
<td>
<form action=?do=deletecoupon method=post>
<input type=hidden name=done value=1>
<input type=hidden name=subm value=1>
<input type=hidden name=next value=1>
<input type=hidden name=code value={$cc['id']}>
<input type=submit class=button value=\"Delete Coupon\"></form>
</td>
</tr></table>/center>
";
}

} else {
	admin_wrong_file();
}
?>