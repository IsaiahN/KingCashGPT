<?
session_start();
include"header.php";
echo "
<div id=\"left\">";
include("includes/left.php");	
echo" </div>
<div id=\"middle\" class=\"feature\">";
if (isset($_POST['go'])) {
	if(isset($_SESSION['userid']))
	{
		echo "<h1>You are already logged in and have no need to access this area.</h1><br /> <a href=\"#\" ONCLICK=\"history.go(-1)\">[Go Back]</a>";
		echo '
		</div>
		<div id="right">';
		include("includes/right.php");
		echo '</div>';
		include "footer.php";
		exit;
	}


	if(!isset($_POST['email']))
	{
		echo "you must put your email in the field to continue.";
		echo '
		</div>
		<div id="right">';
		include("includes/right.php");
		echo '</div>';
		include "footer.php";
		exit;
	}
	   $num = mysql_num_rows(mysql_query("SELECT `email` FROM users WHERE email='".$_POST['email']."'"));
	   
	   if($num < 1)
	   {
		echo "<p>The Email that you provided does not match any account on this website. <a href=\"#\" ONCLICK=\"history.go(-1)\">[Go Back]</a></p>";
		echo '
		</div>
		<div id="right">';
		include("includes/right.php");
		echo '</div>';
		include "footer.php";
		exit;
	   }
	   else
	   {
		
				include_once "password_functions.php";
				$npass=str_rand(7, 'alphanum');
				$email=$_POST['email'];
				mail( $email, "Password Reset on $sitename",
				"Hello,

				Your email has just been used to register to reset your password on $sitename

				Your new password is: $npass

				Login Here: $siteurl/login.php

				Thanks,
				The $sitename Staff", "From: $adminemail");

				$nhpass=md5($npass);
				mysql_query("UPDATE users SET password='$nhpass' WHERE email='$mail'");

				echo "<p>Your Password has been sent to your email.</p>";

				exit;

	   }
}
else
{
   echo "<h3>Forgot Your Password</h3>
   <p>A New password will be emailed to the e-mail address used in your account.<br/>
   <form action='pwr.php' method='POST'>
   <input type='text' name='email' value='' />
   <input type='hidden' name='go'>
   <input type='submit' value='Reset My Password'>
   </form></p>";
}
echo "
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
?>