<?
session_start();
$SubId = $_GET['SubId'];
$SubId =  addslashes($SubId);
echo '
<style type="text/css">
*{margin: 0px; padding: 0px;}
body { /* fallback */ background-color: #fff; background: url(images/linear_bg_2.png); background-repeat: repeat-x; /* Safari 4-5, Chrome 1-9 */ background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fff), to(#ddd)); /* Safari 5.1, Chrome 10+ */ background: -webkit-linear-gradient(top, #ddd, #fff); /* Firefox 3.6+ */ background: -moz-linear-gradient(top, #ddd, #fff); /* IE 10 */ background: -ms-linear-gradient(top, #ddd, #fff); /* Opera 11.10+ */ background: -o-linear-gradient(top, #ddd, #fff);  }
.link { width: 640px; background-color: #3f3f3f;  }
.link a {padding-left: 10px; line-height: 30px;text-decoration: none;color: #f2f2f2; font-family: Helvetica;}
.more {padding-left: 10px; line-height: 30px;font-weight: bold;text-decoration: none; color: #232323; font-family: Helvetica;}
.link span {position:relative; left: 150px;}
</style>
<div class="link">
<a  href="#" value = "Close" onClick="window.close()">Close This Window<a/><span>KingCashGPT - RewardTool</span></div>
<IFRAME SRC = "http://www.blvd-media.com/SweepOne.html?pubid=1020&subid='; echo $SubId; echo'" 
WIDTH="640px" HEIGHT="450px" FRAMEBORDER="0" MARGINWIDTH ="0px" MARGINHEIGHT="0px" SCROLLING="no"> Your browser does not support IFRAME </IFRAME> 
'; 
exit;
?>