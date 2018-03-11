<?php
function validate_email($email) {
  	$result = TRUE;
  	if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,4}$/i", $email)) {
    $result = FALSE;
  	}
  	return $result;
}

function admin_wrong_file() {
echo "
<h1>401: File Not Found <br /> <a href=\"#\" ONCLICK=\"history.go(-1)\">[Go Back]</a></h1>
</div>
<div id=\"right\">";
include("includes/right.php");
echo "</div>";
include "footer.php";
exit;
}
function InputCheck ($input) {
	$html = htmlentities($input);
    if ( !preg_match("/^[A-Za-z0-9@.-_]+$/i", $html) ) {
        return false;
    }
    return true;
}

?>