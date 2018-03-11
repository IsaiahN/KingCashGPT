<?
session_start();
ini_set('zlib.output_compression', 'On');  
ini_set('zlib.output_compression_level', '1');
include "mysql.php";
$getuser = mysql_query("select * from users where id={$_SESSION['userid']}");
    $userinfo      = mysql_fetch_array($getuser);
    $ip      = ($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    mysql_query("update users set `userIP`='$ip' where id={$_SESSION['userid']}");
    
    
$SubId = $_GET['SubId'];
$offerid = $_GET['offerid'];
$SubId =  addslashes($SubId);
$offerid =  addslashes($offerid);

$query = mysql_query("INSERT INTO `reported_offers`(`id`, `offer_id`, `user`, `date`) VALUES ('','".$offerid."','".$SubId."',NOW())");
$query2 = mysql_query("SELECT name FROM offers where cid = '".$offerid."' ");
$fetch2 = mysql_fetch_assoc($query2);
echo '
<style type="text/css">
*{margin: 0px; padding: 0px;}
body { /* fallback */ background-color: #f3f3f3; }
.link { width: 550px; background-color: #3f3f3f;  }
.link a {padding-left: 10px; line-height: 30px;text-decoration: none;color: #f2f2f2; font-family: Helvetica;}
.more {padding-left: 10px; line-height: 30px;font-weight: bold;text-decoration: none; color: #232323; font-family: Helvetica;}
.link span {position:relative; left: 150px;}
.box {font-size: 18px; font-family: Helvetica; width: 524; text-align:center; padding: 10px;  }


</style>
<div class="link">
<a  href="#" value = "Close" onClick="window.close()">Close This Window<a/><span>KingCashGPT - Report An Offer</span></div>';


echo' <b class="box">Offer Reported: '.$fetch2['name'].'<br> <i>Thank you for reporting this offer.</i></b>'; 
exit;
?>