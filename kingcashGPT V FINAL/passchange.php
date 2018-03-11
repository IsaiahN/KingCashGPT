<?
session_start();
include "header.php";
echo "
<div id=\"left\">";
include("includes/left.php");	
echo" </div>
<div id=\"middle\" class=\"feature\" >";
?>

<h1>Changing your password</h1>
<p>
<?
switch ($_GET['do']) {
    case 'passchange2':
        do_pass_change();
        break;
    default:
        pass_change();
        break;
}
function pass_change()
{
    global $userinfo, $userid, $h;
    echo "<center><h3>To change your password, please fill out the information below.<br /></h3><form action='passchange.php?do=passchange2' method='post'>
<table><tr><td>
Current Password:</td><td><input type='password' name='oldpassword' /></td></tr>
<tr><td>New Password:</td><td><input type='password' name='newpassword' /></td></tr>
<tr><td>Confirm:</td><td><input type='password' name='newpassword2' /></td></tr>
<tr><td colspan='2' align='center'>
<input type='submit' class='button' value='Change Your Password' /></form></td></tr></table></center>";
}
function do_pass_change()
{
    global $userinfo, $userid, $h;
    if (md5($_POST['oldpassword']) != $userinfo['userpass']) {
        echo "The current password you entered was incorrect.<br />
<a href='passchange.php?do=passchange'>&gt;&gt; Go Back</a>";
    } else if ($_POST['newpassword'] !== $_POST['newpassword2']) {
        echo "The new passwords you entered did not match!<br />
<a href='passchange.php?do=passchange'>&gt;&gt; Go Back</a>";
    } else {
        $_POST['oldpassword'] = strip_tags($_POST['oldpassword']);
        $_POST['newpassword'] = strip_tags($_POST['newpassword']);
        mysql_query("UPDATE users SET userpass=md5('".$_POST['newpassword']."') WHERE id='".$_SESSION['userid']."'");
        echo "Password changed!<br />The next time you log in you will need to use your new password.";
    }
}

echo "
</p></div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
?>