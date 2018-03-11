<?
session_start();
ini_set('zlib.output_compression', 'On');  
ini_set('zlib.output_compression_level', '1');
include "mysql.php";
$getuser = mysql_query("select * from users where id=".$_SESSION['userid']."");
    $userinfo  = mysql_fetch_array($getuser);
    $ip = $_SERVER['REMOTE_ADDR'];
    mysql_query("update users set `userIP`='".$ip."' where id=".$_SESSION['userid']."");
    
    if (($userinfo['username'] == "admin" ) || ($userinfo['username'] == "Engetsu" ) || ($userinfo['username'] == "ArticMonkey" )) {
    
    	//Check for operation requests
	if(isset($_GET['delpost'])) {

	$delid=mysql_real_escape_string($_GET['delpost']);

	$result=mysql_query("SELECT * FROM shoutbox WHERE id='".$delid."'") or die(mysql_error());
	$info = mysql_fetch_assoc($result);
	if(mysql_num_rows($result)!=0) {
	echo" <center><span id='deleted' style='color:#C00000'>[ ".$info['user']."'s post has been deleted! ]</span><center>"; 
	   mysql_query("DELETE from shoutbox WHERE id='".$delid."'") or die(mysql_error());
		echo '<script type="text/JavaScript">
		<!--
		window.location = "mod.php";
		</script>';
 }
	   else
	   {
	   echo" <span id='deleted' style='color:#C00000'>[ Could not find this post in the database. ]</span>";
	   }
	}

global $userinfo;
$res = mysql_query("SELECT DATE_FORMAT( `date` , '%c/%e/%y %l:%i %p' ) as date2, id, user, message FROM shoutbox ORDER BY id DESC LIMIT 25");
    if(!$res)
        die("Error: ".mysql_error());
echo '
<script src="cufon-yui.js" type="text/javascript"></script>
<script src="Pristina_400.font.js" type="text/javascript"></script>
<script type="text/javascript">
Cufon.replace("h1");
Cufon.replace("h2");
Cufon.replace("#deleted");
</script>
<style type="text/css">

cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media echo{cufon{padding:0!important;}cufon canvas{display:none!important;}}
body {
	 /* fallback */ background-color: #417ebc;
	 /* IE 10 */ background: -ms-linear-gradient(top, #bbb, #f1f1f1); 
	 /* Opera 11.10+ */ background: -o-linear-gradient(top, #bbb, #f1f1f1); 
         background:-moz-linear-gradient(90deg, #bbb, #f1f1f1); /* Firefox */
	background:-webkit-gradient(linear, left top, left bottom, from(#f1f1f1), to(#bbb)); /* Webkit */
}
#shoutbox {
border : 1px solid #ccc;
margin : 30px;
position: relative;
color : #000107;
background: #FFFFFF ;
}
	#shoutbox ul{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 11px;
	color : #000107;
	}
	#shoutbox li {color:#393939;padding-top:15px;}
	#shoutbox TABLE, #shoutbox TR, #shoutbox TD { font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 10px; color: #000; }
        .text , td label {
        position: relative;
        top: 490px;
        }
        input#send {
        position: relative;
        top: 430px;
        }
	.content li {
	padding: 0px 5px 15px 5px;
        min-height: 25px;
	
	}
	.content li:nth-child(odd) {
	background-color: #fff;
	}
	.content li:nth-child(even){
	background-color: #f2f2f2;
	}
	.shoutboxuser {
	font-weight: bold;
	position: relative;
	top: 5px;
	}
	.shoutboxuser a {
	font-weight: bold;
	position: relative;
	top: 5px;
	}
	#useradmin {
	font-weight: bold;
	position: relative;
	top: 5px;
	}
	.shoutboxmessage {
	position: relative;
	top: 5px;
	padding: 4px;
	margin-top: 15px;
	line-height: 15px;
	}
	.shoutboxmessage img {
	position: relative;
	top: 7px;
	width: 32px;
	height: 32px;
	}
	.date {
	margin-top:-10px;
	padding-right: 5px;
	position: absolute;
	font-weight:bold;
	right: 0px;
	}
	.botchat {
	color: red;
	font-weight: bold;
	}
#modchatuser, #modchatuser2, #aidchatuser, .adminchatuser {
color: white;
font-weight:bold;
}
li.adminchatuser  {
color: white;
/* fallback */ background-color: #851114; background-repeat: repeat-x; /* Safari 4-5, Chrome 1-9 */ background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#851114), to(#a11e22)); /* Safari 5.1, Chrome 10+ */ background: -webkit-linear-gradient(top, #a11e22, #851114); /* Firefox 3.6+ */ background: -moz-linear-gradient(top, #a11e22, #851114); /* IE 10 */ background: -ms-linear-gradient(top, #a11e22, #851114); /* Opera 11.10+ */ background: -o-linear-gradient(top, #a11e22, #851114); 
}
li#aidchatuser {
color: white;
/* fallback */ background-color: #851114; background-repeat: repeat-x; /* Safari 4-5, Chrome 1-9 */ background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#851114), to(#a11e22)); /* Safari 5.1, Chrome 10+ */ background: -webkit-linear-gradient(top, #a11e22, #851114); /* Firefox 3.6+ */ background: -moz-linear-gradient(top, #a11e22, #851114); /* IE 10 */ background: -ms-linear-gradient(top, #a11e22, #851114); /* Opera 11.10+ */ background: -o-linear-gradient(top, #a11e22, #851114); 
}
li#modchatuser {
color: white;
 /* fallback */ background-color: #397609; background-repeat: repeat-x; /* Safari 4-5, Chrome 1-9 */ background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#397609), to(#659e33)); /* Safari 5.1, Chrome 10+ */ background: -webkit-linear-gradient(top, #659e33, #397609); /* Firefox 3.6+ */ background: -moz-linear-gradient(top, #659e33, #397609); /* IE 10 */ background: -ms-linear-gradient(top, #659e33, #397609); /* Opera 11.10+ */ background: -o-linear-gradient(top, #659e33, #397609); 
}
li#modchatuser2 {
color: white;
/* fallback */ background-color: #234db7; background-repeat: repeat-x; /* Safari 4-5, Chrome 1-9 */ background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#234db7), to(#y)); /* Safari 5.1, Chrome 10+ */ background: -webkit-linear-gradient(top, #2549a4, #234db7); /* Firefox 3.6+ */ background: -moz-linear-gradient(top, #2549a4, #234db7); /* IE 10 */ background: -ms-linear-gradient(top, #2549a4, #234db7); /* Opera 11.10+ */ background: -o-linear-gradient(top, #2549a4, #234db7); 
}
ul {
list-style: none;
}

.mod {
color: #111;
font-weight: bold;
font-size: 14px;
text-decoration : none;
float: right;
position: relative;
top:31px;
padding-right: 20px;
margin-left: 20px;
}
#deleted {
text-align: right;
color: red;
font-size: 19px;
}
.deleted {
color: red;
font-size: 19px;
}



</style>
<h2 id="deleted">Welcome, '.$userinfo['username'].'</h2>
<center><h1>KingCashGPT Chat Moderation<h1></center>
<div id="shoutbox"> 
    <div id="container">  
        <ul class="menu">  
        </ul>  
        <span class="clear"></span>  
        <div class="content">   
            <ul> '; 
  

$shouts = array();


while($row = mysql_fetch_assoc($res))
  $shouts[] = $row;
$shouts = array_reverse($shouts);

foreach($shouts as $shout) {
  $message = $shout['message'];
  $message = stripslashes($message);
$patterns = array();

                
	            $date2 = $shout['date2'];
		
		                  if ($shout['user'] == "admin"){
		                  $result .= "<a href=\"mod.php?&delpost=".$shout['id']."\" class=\"mod\">Delete ".$shout['user']."'s post [X]</a><li id=\"adminchatuser\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"adminchatuser\"><img src=\"images/bot.png\" alt=\"\" />KCGPT Admin:</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		
		                  }else  if ($shout['user'] == "ArticMonkey"){
		                  $result .= "<a href=\"mod.php?&delpost=".$shout['id']."\" class=\"mod\">Delete ".$shout['user']."'s post [X]</a><li id=\"modchatuser\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"modchatuser\">[MOD] ".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		
		                  }else  if ($shout['user'] == "Engetsu"){
		                  $result .= "<a href=\"mod.php?&delpost=".$shout['id']."\" class=\"mod\">Delete ".$shout['user']."'s post [X]</a><li id=\"modchatuser2\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"modchatuser2\">[MOD] ".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		
		                  }else  if ($shout['user'] == "cooperxx22"){
		                  $result .= "<a href=\"mod.php?&delpost=".$shout['id']."\" class=\"mod\">Delete ".$shout['user']."'s post [X]</a><li id=\"aidchatuser\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"aidchatuser\">[Duke] ".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		                  } else{
		                  $result .= "<a href=\"mod.php?&delpost=".$shout['id']."\" class=\"mod\">Delete ".$shout['user']."'s post [X]</a><li><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\">".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";   
	            
	         }
          
            }
            echo $result;

echo "
            <ul>  
        </div>  
    </div>  
 
    </div>";
}
else {
echo '<script> window.location="login.php"; </script>';
}













?>