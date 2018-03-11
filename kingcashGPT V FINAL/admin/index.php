<?php
session_start();
include("../header.php");
echo "
	
	<center>
	<div  class=\"feature_admin\"  >";
global $ui;
if ($ui['admin'] != 1) {
    print("This page is not for you.");
    include("../side.php");
	include("../footer.php");
    exit;
}
print "<table width=100% >
	<tr>
		<td valign=top>
		<table>
			<tr><td><a href='?do=configs'>Website Configs</a></td></tr>
			<tr><td><hr></tr></td>
			<tr><td><a href='?do=addoffer'>Add Offer</a></td></tr>
			<tr><td><a href='?do=editoffer'>Edit Offer</a></td></tr>
			<tr><td><a href='?do=bulkremoveoffers'>Bulk Remove Offers</a></td></tr>
			<tr><td><a href='?do=reportoffers'>View Reported Offers</a></td></tr>
			<tr><td><a href='?do=deloffer'>Delete Offer</a></td></tr>
			<tr><td><hr></tr></td>
			<tr><td><a href='?do=addoffercat'>Add Offer Category</a></td></tr>
			<tr><td><a href='?do=editoffercat'>Edit Offer Category</a></td></tr>
			<tr><td><a href='?do=deloffercat'>Remove Offer Category</a></td></tr>
			<tr><td><hr></tr></td>
			<tr><td><a href='?do=pendingcashouts'>Pending Cashouts</a></td></tr>
			<tr><td><hr></tr></td>
			<tr><td><a href='?do=finduser'>Find User</a></td></tr>
			<tr><td><a href='?do=addcredits'>Add Balance</a></td></tr>
			<tr><td><a href='?do=delcredits'>Retract Balance</a></td></tr>
			<tr><td><a href='?do=addpoints'>Add Points</a></td></tr>
			<tr><td><a href='?do=delpoints'>Retract Points</a></td></tr>
			<tr><td><a href='?do=deluser'>Delete User</a></td></tr>
			<tr><td><a href='?do=edituser'>Edit User</a></td></tr>
			<tr><td><hr></tr></td>
			<tr><td><a href='?do=delreward'>Delete Reward</a></td></tr>
			<tr><td><a href='?do=editreward'>Edit Reward</a></td></tr>
			<tr><td><a href='?do=addreward'>Add Reward</a></td></tr>
			<tr><td><hr></tr></td>
			<tr><td><a href='?do=createcoupon'>Create Coupon Code</a></td></tr>
			<tr><td><a href='?do=deletecoupon'>Delete Coupon Code</a></td></tr>
			<tr><td><a href='?do=unblockip'>Remove IP Block</a></td></tr>
			<tr><td><a href='?do=blockip'>Block IP</a></td></tr>
			<tr><td><a href='?do=report'>Reported Offers</a></td></tr>
			<tr><td><hr></td></tr>
			<tr><td><a href='?do=banuser'>Ban User</a></td></tr>
			<tr><td><a href='?do=unbanuser'>UnBan User</a></td></tr>
			<tr><td><a href='?do=emailuser'>Mass E-Mail</a></td></tr>
			<tr><td><hr></tr></td>
			<tr><td><a href='?do=addnews'>Add News</a></td></tr>
		</table>
		</td>
		<td align=center valign=top>";
			if ($_GET['do']=='') { 
				print "Welcome to admin panel.";
			} else {
				if (!file_exists($_GET['do'].'.php')) { 
					print "Welcome to admin panel."; 
				} else {
				include($_GET['do'].'.php');
				} 
			} 
		print"</td>
	</tr>
</table>
";

print "
	</div>
	</center>
";	
	include "../footer.php";
?>