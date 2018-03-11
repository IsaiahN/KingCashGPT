<?
session_start();
include "header.php";
echo '<div id="left">';
		include("includes/left.php");		
echo '</div>
	<div id="middle" class="feature" >

<h1 class="pagetitle">KingCashGpt | How it Works</h1>
<p>
<ul>
<li>Step 1 - Sign up</li>
<p>Sign up for an account on <?= $sitename; ?>. Be sure to read over the <a href="rules.php">rules</a> and <a href="tos.php">terms of service</a>. You will receive an email with your login info and a link in which to validate your email address. You must validate your email address before you can request cashout. This is to protect against fraud.<br /></p>
<li>Step 2 - Check out the offers</li>
<p>Click "Offers" at the top of the page to view a list of offers. <br /></p>
<li>Step 3 - Complete as many offers as you wish</li>
<p>Look through our offers in the offers central, seeing if you find anything that you like. When you do, click on the offer and complete the requirements. The offer should credit instantly depending on how the advertiser approves them.<br /></p>
<li>Step 4 - Wait</li>
<p>Wait for a little while, It sometimes takes a few hours to credit an offer. We do not really have control over whether or not our affiliates will confirm your offer completion. <br /></p>
<li>Step 5 - Get Rewarded</li>
<p>Once your offers have been confirmed, your account should be credited with the rewards earned from the offers. When you reach the cashout threshold, and you are free to request cashout via <a href="http://www.paypal.com">PayPal</a> or via Points Redemption.</p><br /> 
</ul>
</div>
<div id="right">';
		include("includes/right.php");
echo '</div>';
		include "footer.php";
?>
