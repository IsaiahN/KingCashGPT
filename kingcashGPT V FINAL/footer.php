</div>	
<div id="footer">
		<div class="footerlinks">
			<h2>Links</h2>
			  <ul>
			    <li><a href="#" onclick="target='_blank'">Link Here</a></li>
			    <li><a href="#" onclick="target='_blank'">Link Here</a></li>
			    <li><a href="#" onclick="target='_blank'">Link Here</a></li>
			    <li><a href="http://www.gptboycott.com/index.php?id=624">GPTBoycott</a></li>
			  </ul>
		</div>
		<div class="footerlinks">
			<h2>Sister Sites</h2>
			  <ul>
			    <li><a href="#" onclick="target='_blank'">GPT Link Here</a></li>
			    <li><a href="#" onclick="target='_blank'">GPT Link Here</a></li>
			    <li><a href="#" onclick="target='_blank'">GPT Link Here</a></li>
			    <li><a href="#" onclick="target='_blank'">GPT Link Here</a></li>
			  </ul>
		</div>
		<div class="footerlinks">
			<h2>Social</h2>
			<table class="footertbl" border="1">
			  <tr>
			    <td><a href="http://www.facebook.com/people/Kingcashgpt-Getpaidforsurveys/100001765492992" onclick="target='_blank'"><img src="images/fb.png" alt="facebook"/></a></td>
			    <td><a href="http://twitter.com/#!/KingCashGpt" onclick="target='_blank'"><img src="images/tw.png" alt="twitter"/></a></td>
			    <td><a href="http://digg.com/story/r/kingcashgpt_point_click_earn" onclick="target='_blank'"><img src="images/digg.png" alt="digg"/></a></td>
			    <td><a href="http://www.stumbleupon.com/su/2kvpLv/www.kingcashgpt.com" onclick="target='_blank'"><img src="images/stmbupn.png" alt="stumbleupon"/></a></td>
			  </tr>
			</table>
		</div>
		<div class="footerlinks contact">
			<h2>Contact Us</h2>
			  <ul>
			    <li>Email: Support@kingcashgpt.com</li>
			    <li>Skype: KingCashGPT</li>
			    <li>Aim: KingCashGPT</li>
			  </ul>
		</div>
		<!-- put this in a new bar below footer (black bar) -->
		<p> 
			&copy; 
<script type="text/javascript">
var theDate=new Date()
document.write(theDate.getFullYear())
</script>
 <strong><?= $configs['sitename']; ?></strong> | <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/rules.php">Rules</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/tos.php">Terms of Service</a>
			<?

			if ($userinfo['admin'] == 1) {
				echo "| <a class=\"red\" href=\"http://".$_SERVER['SERVER_NAME']."/admin\">Admin Panel</a>";
			}

			?>		
		</p>
</div>

<? if ($_SERVER['PHP_SELF'] == "/index.php") {?>
<script type="text/javascript" src="slider/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="slider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
$(window).load(function() {
$('#slider').nivoSlider();
});
<? } else {?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">

<? } ?>

Cufon.now();
<!--
<? if ($_SERVER['PHP_SELF'] == "/offers.php") {?>
function open_pop2(){window.open('rewardtool.php?&SubId=<?= $userinfo['username']; ?>','win','left=20,top=20,width=640,height=485,toolbar=0,menubar=0,resizable=0,scrollbars=1')}function open_report(id){window.open('report.php?&SubId=<?= $userinfo['username']; ?>&offerid='+id+' ','win2','left=20,top=20,width=550,height=105,toolbar=0,menubar=0,resizable=0,scrollbars=1')}
<? } ?>
function open_pop(){window.open('emotes.htm','mywin','left=20,top=20,width=540,height=360,toolbar=0,menubar=0,resizable=0,scrollbars=1')}function open_pop3(){window.open('mod.php','mywin2','left=20,top=20,width=640,height=485,toolbar=0,menubar=0,resizable=0,scrollbars=1')}function namegame(name){namecontent=opener.document.getElementById("message").value;opener.document.getElementById("message").value="@"+name+"- "}function resetBox(box,defaultvalue){if(box.value==defaultvalue){box.value=""}}
-->
</script>

</body>
</html>