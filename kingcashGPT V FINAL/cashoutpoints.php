<?
session_start();
include "header.php";

echo "

<div id=\"left\">";
include("includes/left.php");	
echo" </div>
<div id=\"middle\" class=\"feature\" >";
global $userinfo;

if ($_SESSION['login'] !== 'YES') {
    echo "<span class=\"red\"><h1>You must be logged into the site in order to use this page.</span> <br />  <br /> <a href=\"login.php?ref=$ref\">Click here to log in, </a> <br />  <br /> <a href=\"index.php?ref=$ref\">or click here to sign up</a></h1>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}

if ($userinfo['email_verified'] != 1) {
    echo "<h1>You need to verify your email before you can cashout. <br />Please check the email you received when you signed up.</h1>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}

    

if ($_POST['amount']!='') {
	if (!is_numeric($_POST['amount'])) {
		$error .= "<span class=\"red\">Amount should contain only numbers.</span>";
	}
	
	if ($_POST['amount'] > $userinfo['current_points_balance']) {
	        $amount2 = $amount / 100;
		$error .= "<span class=\"red\"><h1>You have less then ".$amount2." in your balance. <br /> Please return to <a href='cashout.php'>cashout</a> page and enter ".$userinfo['current_points_balance']." points or less.</span></h1>";
	}
}

if ($configs['mincashoutpoints'] > $userinfo['current_points_balance']) {
	echo "<h1>You don't have enough points in your balance.  <br /> Minimal point redemption value is ".$configs['mincashoutpoints']." Points. <br /> Please  complete more <a href='offers.php'>offers</a> and try to reedeem your points later.</h1>";
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}

if (($error=='') && ($_POST['amount'])) {
		
		
		function check_input($data)
	{
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}
	
	// MySQL Injection protection
	
	$amount = check_input($_POST['amount']);
	$email = check_input($_POST['email']);
	$reward = check_input($_POST['type']);
	$username = $_POST['username'];
	$box = check_input($_POST['box']);
	
	
	if(isset($_POST['submit2'])) {
	
	$email = htmlspecialchars($_POST['email']);
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
	{
	echo
	
"<h1 style='text-align:center;'>E-mail address not valid</h1> <br /> 
[<a href=\"javascript: history.go(-1)\">Back</a>]</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
	   
	       

	}
	
	if ($reward==0) {

	"<h1 style='text-align:center;'>You Must Select A Reward Option!</h1> <br /> 
	[<a href=\"javascript: history.go(-1)\">Back</a>]</div>
	<div id=\"right\">";
	include("includes/right.php");
	echo "</div>";
	include "footer.php";
	exit;
	}
	elseif ($reward==1) {
	$reward= "Amazon";
	$messagejoin = " <br /> <b style=\"color:green;\">".$userinfo['username']." just redeemed an Amazon Gift Card!</b>";
	}
	elseif ($reward==2) {
	$reward= "Ebay";
	$messagejoin = " <br /> <b style=\"color:green;\">".$userinfo['username']." just redeemed an Ebay Gift Card!</b>";
	}
	elseif ($reward==3) {
	$reward= "Visa";
	$messagejoin = " <br /> <b style=\"color:green;\">".$userinfo['username']." just redeemed a Visa Gift Card!</b>";
	}
	elseif ($reward==4) {
	$reward= $box;
	$messagejoin = " <br /> <b style=\"color:green;\">".$userinfo['username']." just redeemed a Custom Prize worth ".$amount." Points!</b>";
	}
	else {
	die("Either there has been an error or you haven't selected a value.");
	}
	$email2 = $_POST['email'];
		// Test to see if these three post variables have data and only then update.
		if (!empty($reward) && !empty($username) && !empty($email) && !empty($amount)) {
			$query = "INSERT INTO cashouts VALUES('','".$userinfo['id']."', '".$reward."', '0.00', '0','".$amount."', '".$email2."')";
		mysql_query($query) or die(mysql_error());
		$query2 = "UPDATE users SET current_points_balance=current_points_balance-'".$amount."' WHERE id='".$userinfo['id']."'";
		mysql_query($query2) or die(mysql_error());
		echo "<h1>Your cashout has been recorded! please allow up to 48 hours to proccess it.</h1>";
		

			
		    $usernamebot = "<img src=\"images/bot.png\" alt=\"\" /><span class=\"botchat\">KingCashGPT Bot</span>";
		    $querychat =" INSERT INTO `shoutbox` VALUES('', NOW(), '".mysql_real_escape_string($usernamebot)."', '".mysql_real_escape_string($messagejoin)."')";
		    mysql_query($querychat) or die(mysql_error());	

			echo
			"</div>
			<div id=\"right\">";
			include("includes/right.php");
			echo "</div>";
			include "footer.php";
			echo '	   <script type="text/javascript">
			<!--
			window.location.reload() = "stats.php"
			-->
			</script>';
			exit;

		}
		else {
		die("You have left a value empty.");
		}
	
	}
	else {
	echo "Please Submit all information.";
	}
}



echo "<h1>Congratulations, On Earning ".$userinfo['current_points_balance']." Points!</h1>";
echo $error."
<div id=\"cashpoints\"><h1 class=\"header\">Reedem Your Points</h1>";
					echo'	
				<form id="form2" method="POST" action="#">
				<span id=\"gallery\" > </span>
								 <br />                    
						<label>Email:</label>
						<input id="input1" class="form" name="email" value="E-mail Address" type="text"  onFocus="this.value=\'\'">
						 <br />  <br /> <label>Amount:</label>
						<input id="input2" class="form" name="amount" value="'.$userinfo['current_points_balance'].'" type="text"  onFocus="this.value=\'\'">
						 <br />  <br /> <label for="input3">Reward Choice:</label>
						<select id="rewardselect" class="form" name="type" onchange="if (this.selectedIndex==4){this.form[\'box\'].style.visibility=\'visible\'}else {this.form[\'box\'].style.visibility=\'hidden\'};">
						<option value="0">Choose One</option>
						<option value="1">Amazon Gift Card</option>
						<option value="2">Ebay Gift Card</option>
						<option value="3">Visa Gift Card</option>
						<option value="4">Custom</option></span></select>  <br />  <br /> 
						</select>
						<input class="form" type="hidden" name="username" value="'.$userinfo['username'].'">
						<textarea id="input4" name="box" cols="43" rows="3" style="visibility:hidden;" onFocus="this.value=\'\'">Enter your custom reward here!</textarea>
						 <br /> 
						<div id="submitbutton"> <br /> 
						<input type="image" SRC="images/submit.png" HEIGHT="38" WIDTH="114" BORDER="0" name="submit2" value="Cash Out" />
						</div>
						<input type="hidden" name="submit2" value="submit2">
						</form>

						 ';
echo"
</div></div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
?>