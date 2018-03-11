<?php
if($_GET['do']=="createcoupon")


if($_POST['subm'])
{
mysql_query("insert into coupons 
values('','{$_POST['couponcode']}','{$_POST['couponvalue']}','{$_POST['limit']}','1')",$c);
print"Coupon Code: {$_POST['couponcode']} has been added and is worth {$_POST['couponvalue']} US 
Dollars. Has only {$_POST['limit']} uses.";
}
else
{
print"
Adding a Coupon Code<br><br>

<form action=?do=createcoupon method=post><input type=hidden name=subm value=1>

Coupon Code:<br> <input type=text name=couponcode><br>
US Dollars Value:<br> <input type=text name=couponvalue><br><br>
Code Limit:<br> <input type=text name=limit><br><br>

<input type=submit class=button style='font-family: verdana' value=\"Add Coupon Code\"></form>
";

} else {
	admin_wrong_file();
}
?>