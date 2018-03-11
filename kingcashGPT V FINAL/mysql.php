<?
//Connect to Database
$database = "kingcash_gpt"; //your database name
$db_user   = "kingcash_admin"; //your database username
$db_pass   = "jomiks"; // your database password
$link = mysql_connect('localhost', $dbuser, $dbpass);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
?>
