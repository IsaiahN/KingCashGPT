<?
session_start();
include "header.php";
if ($_SESSION['login'] == 'YES') {
    echo '
   
<script> window.location="offers.php"; </script>
//<META HTTP-EQUIV="refresh" CONTENT="0;URL=offers.php">';
} 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
?>


	<div id ="left">
		<?php include("includes/left.php");?>		
	</div>
	<div id ="middle" class ="feature">
		<center>
			<h1>Members Login</h1>
			<form action ="authenticate.php?" method ="POST">
			<div id ="logintbl">
				<table width ="75%">
					<tr>
					<td>Username:</td>
					<td><input type ="text" name ="username"></td></tr>
					<tr><td>Password:</td>
					<td><input type ="password" name ="password"></td>
					</tr>
				</table>
				</form>
				<br />
				<a href ='pwr.php'>Forgot Your Password?</a><br />
		
				<br />
				<input type ="submit" class ="button" value ="Login Now">
			</div>
		</center>
			
	</div>
	<div id="right">
		<?php include("includes/right.php");?>
	</div>

<?
include "footer.php";
?>