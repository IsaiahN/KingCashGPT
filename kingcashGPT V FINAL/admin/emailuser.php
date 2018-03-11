<?php
if ($_GET['do'] == "emailuser") {
    if ($_POST['subm']) {
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        
        $query="SELECT email FROM users";  //Change users_test to users
        $result=mysql_query($query);
        $num=mysql_num_rows($result);


        $i=0;
        while ($i < $num) 
        {
        
                $email=mysql_result($result,$i,"email");
                        
                mail($email, $subject, $message, "From: ".$configs['sitename']."<".$configs['siteadmin'].">");
        
                echo "Email sent to: " . $email . "<br />";
        
                $i++;
                                
        }
} else {
        print "<table width=90%>
<tr><th colspan=2>Mass E-Mail</th></tr>
<tr><td>
<form action=?do=emailuser method=post><input type=hidden name=subm value=1>
Subject
<br />
<input name=\"subject\" type=\"text\" size=\"30\" id=\"subject\"><br /><br />
Message
<br />
<textarea name=\"message\" cols=\"30\" rows=\"10\" id=\"message\"></textarea>
<br /><br />
</td>
<td>
<input type=submit class=button value=\"Send Email\"></form>
</td>
</tr></table>
";
	}
} else {
	admin_wrong_file();
}

?>