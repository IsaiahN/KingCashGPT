<div class="lastadded"> 
 	<ul>
        <li>
	<h1>Last Added Offers</h1>
	<table>
	<?
		$getoffers = mysql_query("SELECT * FROM `offers` WHERE countries LIKE '%".$countries[country]."%' ORDER BY id DESC LIMIT 7");
		if (mysql_num_rows($getoffers)==0) {
			print "There are no offers on website";
		} else {
			while ($offer = mysql_fetch_array($getoffers)) {
				$url = str_replace("[USERNAME]", $userinfo['username'], $offer['id']);
				print "<tr><td><a href='offers.php?oid=".$offer['cid']."'  onclick=\"target='_self'\" >".htmlentities($offer['name'])."</a></td></tr>";
	
			}
		} 
	?>        
	</table>
	</li>
	</ul>                    
</div>  
        
<div class="chatroom"> 
<SCRIPT LANGUAGE="JavaScript">

function open_pop(){
window.open('emotes.htm','mywin','left=20,top=20,width=500,height=359,toolbar=1,resizable=1');
}

</SCRIPT>
			<h1>ShoutBox</h1>
<form method="post" id="form">  
        <table>  
            <tr>  
                <? if ($_SESSION['loggedin'] !== 1) { 
                echo '
                <td><input class="text" id="message" type="text" MAXLENGTH="255" disabled="disabled" value="User Not Logged In" /></td>';  
                 } else {
                 echo '
                <td><input class="text" id="message" type="text" onfocus="resetBox(this, \'Enter your message\')" MAXLENGTH="255" value="Enter your message" /></td>'; 
                }
                echo '
                <td><input id="nick" MAXLENGTH="55" type="hidden" value="'.$userinfo['username'].'" /></td>';
                ?>

            </tr>  
            <tr>  
            
            
                <td></td>  
                <td><input id="send" type="submit"  value=">>" /></td>  
            </tr>  
        </table>  
        
        
    </form>  
   <div id="shoutbox"> 
    <div id="container">  
        <ul class="menu">  
        </ul>  
        <span class="clear"></span>  
        <div class="content">  
            <div id="loading"></div>  
            <ul>  
            <ul>  
        </div>  
    </div>  
 
    </div> <? if ($_SESSION['loggedin'] == 1) { 
       echo '
       <a href="javascript:newwindow()" onClick="open_pop()" class="emoticon">Emoticons</a> ';
       }
        if (($userinfo['username'] == "admin" ) || ($userinfo['username'] == "Engetsu" ) || ($userinfo['username'] == "ArticMonkey" )) {
          echo '
       <a href="mod.php" target="_blank" style="padding-left: 45px;" class="emoticon">Moderation</a> ';
       } ?>
       <? if ($_SERVER['PHP_SELF'] !== "/index.php") {?>
    <script type="text/javascript" src="jquery.js"></script>  
    <? } ?>
    <script type="text/javascript" src="shoutbox.js"></script> 
			
		</div>
</div>
