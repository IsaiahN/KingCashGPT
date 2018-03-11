<?
session_start();
global $userinfo,$count;
$page = "offers";
include "header.php";
include "pagination.inc";


echo "

	<div id=\"left\">";
		include("includes/left.php");	
	echo" </div>
	<div id=\"middle\" class=\"feature\">";
	
if ($_SESSION['loggedin']!='1') {
	echo "<center>Please <a href='login.php'>Login</a> or <a href='register.php'>Register</a> to view this page.<br></center>";
	
} else {

if (isset($_GET['browse'])) {
echo "
<script type=\"text/javascript\">
Cufon.replace('a.browsefont');
</script>";


	 $browse = (int) $_GET['browse'];
	 $browse =  mysql_real_escape_string($browse);
	 
	 if ($browse == 1 ) {
	 	$query = "SELECT * FROM `completed` WHERE user_id='".$userinfo['id']."'";
		$result = mysql_query($query) or die(mysql_error());
		$firstnum = mysql_num_rows($result);
		$i=1;
		if ( $firstnum > 0) {
			echo '<center><a href="#" class="browsefont">Completed Offers</a></center><br><table border="1">
			<tr><th></th><th>Offer Name</th><th>Points/Cash</th><th>Date Submitted</th></tr>';
			while ($num = mysql_fetch_array($result) or die(mysql_error())) {
				$query2 = "SELECT * FROM `offers` WHERE cid='".$num['offer_id']."'";
				$result2 = mysql_query($query2) or die(mysql_error());
				while ($offercomp = mysql_fetch_array($result2)) {
			      //echo "<br><center>Name: ".$offercomp[name]." - Reward:"; if ($offercomp[reward] > 0) { echo " $".$offercomp[reward]." ";} if (($offercomp[reward] > 0) && ($offercomp[points] > 0)) {echo "and ";} if ($offercomp[points] > 0) { echo"".$offercomp[points]." Points"; } echo "</center>";		
			        echo "<tr><td></td><td>".$offercomp[name]."</td><td>"; if ($offercomp[reward] > 0) { echo " \$".$offercomp[reward]." ";} if (($offercomp[reward] > 0) && ($offercomp[points] > 0)) {echo "and ";} if ($offercomp[points] > 0) { echo"".$offercomp[points]." Points"; }echo "</td><td>$num[date_submitted]</td></tr></center><br>";
				
			        }
			     	if ( $firstnum == $i )
			        	break;

				$i = $i + 1;   
			}
		echo "
		</table><br><br><center>[<a href='offers.php'>Back To Offers Page</a>]</center>
		</div>		
		<div id=\"right\">";
		include("includes/right.php");
		echo "</div>";		
		include "footer.php";
		exit;	
			
			
		} else {
		echo '<center><a href="#" class="browsefont">Completed Offers</a></center><br>';
		echo"<center>You don't have any completed offers, Please go to Offers Central to submit <br>any offer by your choice and get rewarded for it.</center>";
		echo "<br><br>
		<center>[<a href='offers.php'>Back To Offers Page</a>]</center>
		</div>		
		<div id=\"right\">";
		include("includes/right.php");
		echo "</div>";		
		include "footer.php";
		exit;
		}		
		
	 } else if ($browse == 2 ) {
	 	$query = "SELECT * FROM `pending` WHERE user_id='".$userinfo['id']."'  AND status=2";
		$result = mysql_query($query) or die(mysql_error());
		$firstnum = mysql_num_rows($result);
		$i=1;
		if ( $firstnum > 0) {
			echo '<center><a href="#" class="browsefont">Denied Offers</a></center><br><table border="1">
			<tr><th></th><th>Offer Name</th><th>Points/Cash</th><th>Date Submitted</th></tr>';
			while ($num = mysql_fetch_array($result) or die(mysql_error())) {
				$query2 = "SELECT * FROM `offers` WHERE cid='".$num['offer_id']."'";
				$result2 = mysql_query($query2) or die(mysql_error());
				while ($offerdeny = mysql_fetch_array($result2)) {
				//echo "<br><center>Name: ".$offerdeny[name]." - Reward:"; if ($offerdeny[reward] > 0) { echo " $".$offerdeny[reward]." ";} if (($offerdeny[reward] > 0) && ($offerdeny[points] > 0)) {echo "and ";} if ($offerdeny[points] > 0) { echo"".$offerdeny[points]." Points"; } echo "</center>";		
			        echo "<tr><td></td><td>".$offerdeny[name]."</td><td>"; if ($offerdeny[reward] > 0) { echo " \$".$offerdeny[reward]." ";} if (($offerdeny[reward] > 0) && ($offerdeny[points] > 0)) {echo "and ";} if ($offerdeny[points] > 0) { echo"".$offerdeny[points]." Points"; }echo "</td><td>$num[date_submitted]</td></tr></center><br>";
			        }
			       	 if ( $firstnum == $i )
			        	break;

				$i = $i + 1;
			}
		echo "
		</table><br><br><center>[<a href='offers.php'>Back To Offers Page</a>]</center>
		</div>		
		<div id=\"right\">";
		include("includes/right.php");
		echo "</div>";		
		include "footer.php";
		exit;		
		} else {
 
		echo '<center><a href="#" class="browsefont">Denied Offers</a></center><br>';
		echo"<center>You don't have any denied offers, Please go to Offers Central to submit <br>any offer by your choice and get rewarded for it.</center>";
		echo "<br><br>
		<center>[<a href='offers.php'>Back To Offers Page</a>]</center>
		</div>		
		<div id=\"right\">";
		include("includes/right.php");
		echo "</div>";		
		include "footer.php";
		exit;	
		}
		
	 } else if ($browse == 3 ) {
	 if(isset($_GET['delpend'])) {
		$delid=mysql_real_escape_string($_GET['delpend']);
		$resultdel=mysql_query("DELETE FROM pending WHERE id='".$delid."'") or die(mysql_error());
		}
	 	$query = "SELECT * FROM `pending` WHERE user_id='".$userinfo['id']."'  AND status=1";
		$result = mysql_query($query) or die(mysql_error());
		$firstnum = mysql_num_rows($result);
		$i=1;
		if ( $firstnum > 0) {
			echo '<center><a href="#" class="browsefont">Pending Offers</a></center><br><table border="1">
			<tr><th></th><th>Offer Name</th><th>Points/Cash</th><th>Date Submitted</th></tr>';
			        while ($num = mysql_fetch_array($result) or die(mysql_error())) {
				$query2 = "SELECT * FROM `offers` WHERE cid='".$num['offer_id']."'";
				$result2 = mysql_query($query2) or die(mysql_error());
				while ($offerpend = mysql_fetch_assoc($result2)) {
				echo "<tr><td><a href='offers.php?&browse=3&delpend=".$num[id]."'>[X]</a></td><td>".$offerpend[name]."</td><td>"; if ($offerpend[reward] > 0) { echo " \$".$offerpend[reward]." ";} if (($offerpend[reward] > 0) && ($offerpend[points] > 0)) {echo "and ";} if ($offerpend[points] > 0) { echo"".$offerpend[points]." Points"; }echo "</td><td>$num[date_submitted]</td></tr></center><br>";
				  } 
			        
				
			        if ( $firstnum == $i )
			        	break;

				$i = $i + 1;

			 }
		
		} else {
		echo '<center><a href="#" class="browsefont">Pending Offers</a></center><br>';
		echo"<center>You don't have any pending offers, Please go to Offers Central to submit <br>any offer by your choice and get rewarded for it.</center>";	
		}
	  	echo "</table><br><br>
	  	<center>[<a href='offers.php'>Back To Offers Page</a>]</center>
		</div>		
		<div id=\"right\">";
		include("includes/right.php");
		echo "</div>";		
		include "footer.php";
		exit;
		
	 } else {
		echo "<center>An Error Has Occured. Please copy the url and contact the admin.</center>";
		echo "
		<center>[<a href='offers.php'>Back To Offers Page</a>]</center>
		</div>		
		<div id=\"right\">";
		include("includes/right.php");
		echo "</div>";
		include "footer.php";
		exit;
	 }

} else {
if (isset($_GET['offersnum'])) { // if offer is submitted
	 $offersnum = (int) $_GET['offersnum'];
	 $offersnum =  mysql_real_escape_string($offersnum);

$query = "SELECT * FROM `pending` WHERE offer_id='".$offersnum."' AND user_id='".$userinfo['id']."'";
		$result = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($result)>0) {
			echo "<center>You already submited this offer.<br>Please return to <a href='offers.php'>Offers</a> page and submit another offer.</center>
			</div>		
			<div id=\"right\">";
			include("includes/right.php");
			echo "</div>";
			include "footer.php";
			exit;
		} else {
			$date = date("F j, Y, g:i a");
			$getoffer = "SELECT * FROM `offers` WHERE cid='".$offersnum."'";
			$result = mysql_query($getoffer) or die(mysql_error());
			$offer = mysql_fetch_array($result);
			$query = "INSERT INTO `pending` VALUES('','".$offer['cid']."','".$userinfo['id']."','".$date."','".$offer['reward']."','1')";
			mysql_query($query) or die(mysql_error());
			echo "<center>Your offer submission has been recieved.<br>Please return to <a href='offers.php'>Offers</a> page and submit another offer.</center>
			</div>		
			<div id=\"right\">";
			include("includes/right.php");
			echo "</div>";
			include "footer.php";
			exit;
			}
}else { //if offernum empty
	
$query3 = "SELECT type, id FROM `offer_types` ORDER BY id ASC";
$result3 = mysql_query ($query3);
echo "<select name='type' value='' class='offerselect' onChange=\"if(this.value) location.href='offers.php?&type='+this.value;\">";
// echoing the list box select command
echo "<option value='0'>Offer Categories</option>";
while($nt=mysql_fetch_array($result3)){//Array or records stored in $nt
$query7 = "SELECT category FROM `offers` WHERE category = ".$nt[id]."";
if  ($nt[id] == '12') {
$query7 = "SELECT category FROM `offers` WHERE active = '1'";
}
$result7 = mysql_query ($query7);
$num = mysql_num_rows($result7);
echo "<option value=$nt[id]>[$nt[type]] [$num]</option>";
}
echo "</select>";

   $self = $_SERVER["PHP_SELF"]; 
  if($_SERVER["QUERY_STRING"]) {
    $finalurl = $self . "?" . $_SERVER["QUERY_STRING"];   
  } else {
    $finalurl = $self . "?";  
  } 
if (isset($_GET['page'])) {
$piece = explode("&page=", $finalurl);
} else {
$piece = explode("&sort=", $finalurl);
}
$oid = explode("oid=", $_SERVER["QUERY_STRING"]);

echo "<select  name='sort' value='' class='offerselect' onChange=\"if(this.value) location.href='".$piece[0]."&sort='+this.value;\">
<option value=''>Sort By</option>
<optgroup label=\"Ascending Offers &uarr;\">
<option value='Cash'>Cash</option>
<option value='ID'>ID</option>
<option value='Name'>Name</option>
<option value='Points'>Points</option>
</optgroup>
<optgroup label=\" &darr; Descending Offers\">
<option value='Cash,high'>Cash</option>
<option value='ID,high'>ID</option>
<option value='Name,high'>Name</option>
<option value='Points,high'>Points</option>
</optgroup>
</select>"; // Closing of list box 
$query8 = "SELECT id FROM `completed` WHERE user_id = ".$userinfo[id]."";
$result8 = mysql_query ($query8);
$num2 = mysql_num_rows($result8);
$query9 = "SELECT id FROM `pending` WHERE user_id = ".$userinfo[id]." AND status ='1'";
$result9 = mysql_query ($query9);
$num3 = mysql_num_rows($result9);
$query10 = "SELECT id FROM `pending` WHERE user_id = ".$userinfo[id]." AND status ='2'";
$result10 = mysql_query ($query10);
$num4 = mysql_num_rows($result10);
echo "<select  name='skip' value='' class='offerselect' onChange=\"if(this.value) location.href='offers.php?&browse='+this.value;\">
        <option value=\"\">Browse Folders</option>
        <option value=\"1\">Completed [".$num2."]</option>
        <option value=\"2\">Denied [".$num4."]</option>
        <option value=\"3\">Pending [".$num3."]</option>
</select>


";

if (isset($oid[1])) { //if from last added/completed offers

	//$queryoid = "SELECT * FROM `offers` WHERE active='1' AND cid='".$oid[1]."' AND countries LIKE '%".$userinfo['country']."%' LIMIT 1 ";  bottom filters out completed offers 
	$queryoid =   "SELECT * FROM `offers` WHERE active='1' AND cid='".$oid[1]."' AND countries LIKE '%".$userinfo['country']."%' AND cid NOT IN (SELECT offer_id FROM completed WHERE user_id='".$userinfo['id']."' ) AND cid NOT IN (SELECT offer_id FROM pending WHERE user_id='".$userinfo['id']."' AND status=1 ) AND cid NOT IN (SELECT offer_id FROM pending WHERE user_id='".$userinfo['id']."' AND status=2 ) LIMIT 1";			
	$resultoid = mysql_query($queryoid)  or trigger_error(mysql_error().$sql);
	$offeroid = mysql_fetch_array($resultoid);
	echo "
	<form method=\"POST\"action=\"".$_SERVER['PHP_SELF']."?&offersnum=".$offeroid['cid']."\">
	<div class=\"offerstable\">";

	
		
		if ($offeroid[reward_type] == "Both") {
		$amountr = $offeroid[reward] * .60;
		$amountp = $offeroid[points] * .60;
		$amountr = money_format('$%i', $amountr);
		$amountp = $amountp * 100;
		$ofrtype = "both";
		}
		else if ($offeroid[reward_type] == "Cash"){
		$amountr = $offeroid[reward] * .60;
		$amountr = money_format('$%i', $amountr);
		$ofrtype = "reward";
		$otype2 = "c";
		}
		else if ($offeroid[reward_type] == "Points"){
		$amountp = $offeroid[points] * .60;
		$amountp = $amountp * 100;
		$ofrtype = "points";
		$otype2 = "p";
		}
		
		

$urltest = substr($offeroid[url], 7);  // test if url is adscend
$urltest = explode("/click.php?", $urltest);
				if (isset($ofrtype)) {
			
			if ($urltest[0] == "adscendmedia.com") {
			echo "<a href=\"".$offeroid[url]."".$userinfo['username']."\" target=\"_blank\" onclick=\"offerClick".$oid[1]."=true\"><b>".$offeroid[name]."</b></a>";
			} else {
			echo "<a href=\"".$offeroid[url]."".$userinfo['username']."/".$otype2."\" target=\"_blank\" onclick=\"offerClick".$oid[1]."=true\"><b>".$offeroid[name]."</b></a>";
			}
			echo "<br/><span class=\"info\">".$offeroid[info]."</span>
			<br/><span class=\"requirements\">".$offeroid[requirements]."</span>
			<br/><span class=\"amount\">Amount: ";
			
			if ($ofrtype == "both") {
			echo "".$amountr." and ".$amountp." Points</span>";
			}
			else if ($ofrtype == "reward") {
			echo "".$amountr."</span>";
			}
			else if ($ofrtype == "points") {
			echo "".$amountp." Points</span>";
			}
			else {
			echo "There is no amount for this offer. Report this to an admin</span>";
			
			}
		}else {
		echo "<h1>Offer not available</h1><span style=\"text-align:center;\"><b><strong style=\"color:red;\">The offer that you have selected is not available: <br>This may have occured for a number of reasons:</strong><br> This offer may have previously been completed.<br> This offer may currently currently pending.<br> Check \"Browse Folders\" for details.</b></span>";
		}         if (isset($ofrtype)) {
	                   echo '
	                        <input type="hidden" id="offernum" name="offernum" value="'.$oid[1].'" />
			        <br/><input class="offerbutton" type="submit" value="Submit">
			        <input class="offerbutton" type="button" value="Report" onClick="if(confirm(\'Are you sure this offer is not working correctly and you wish to report it?\')){open_report(\''.$oid[cid].'\');}else{return false;}" />
				
		</div>
	</form>'; } else {
	echo '<br><a href="offers.php" ><- Back To Offers</a></div></form>';
	}
	

} // if oid end
 if (!isset($oid[1])) {
 // offer manifestation
 if (isset($_GET['type'])){
	 $type = (int) $_GET['type'];
	 $type =  mysql_real_escape_string($type);
 }
 else {
 	$type = 11; //featured offers
 }
// gets offer name
$main2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `offer_types` WHERE id ='".$type."'"));
echo '<h1><br>'.$main2['type'].'<a href="javascript:newwindow()" onClick="open_pop2()" style="font-size: 18px; color: #2f2f2f; position:relative; top: 16px;float: right;">Click Here For The Reward Tool!</a></h1> ';
 
  if (isset($_GET['sort'])){
	 $sort = mysql_real_escape_string($_GET['sort']);
	 $sortby2 = explode(",", $sort);
	$sortby = mysql_real_escape_string($sortby2[0]);
       
	 // convert sortby into category high
	 if ($sortby2[1] == "high"){ //order by high

		 if ($sortby == "Cash" ) {
			 $category = "reward";
			 $reward_type = " AND reward_type='Cash'";
		 } else if ($sortby == "ID" ) {
			 $category = "cid";
		 } else if ($sortby == "Name" ) {
			 $category = "name";
		 } else if ($sortby == "Points" ) {
			 $category = "points";
			 $reward_type = " AND reward_type='Points'";
		 }
	 $updown = "DESC";
	 }
	 else { // order by low

	 	 if ($sort == "Cash" ) {
			 $category = "reward";
			 $reward_type = " AND reward_type='Cash'";
		 } else if ($sort == "ID" ) {
			 $category = "cid";
		 } else if ($sort == "Name" ) {
			 $category = "name";
		 } else if ($sort == "Points" ) {
			 $category = "points";
			 $reward_type = " AND reward_type='Points'";
		 }
	 $updown = "ASC";
	 }
 }
 else {
	 $category = "id"; //featured offers
	 $updown = "DESC";
 }

 //pagination
$page = 1;
 
// how many records per page
$size = 10;
 
// we get the current page from $_GET
if (isset($_GET['page'])){
 $page = (int) $_GET['page'];
 $pagelink = explode("page=", $finalurl);
 }
 else {
 $pagelink = $finalurl;
 }
 
// create the pagination class
$pagination = new Pagination();
$pagination->setLink("".$pagelink."".$pagelink[0]."page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);

if ($type == 12 ) { // all offers
					
//$offersql = "SELECT * FROM `offers` WHERE active='1' ".$reward_type."  AND countries LIKE '%".$userinfo['country']."%' ORDER BY ".$category." ".$updown." " . $pagination->getLimitSql();
$offersql =   "SELECT * FROM `offers` WHERE active='1' ".$reward_type."  AND countries LIKE '%".$userinfo['country']."%' AND cid NOT IN (SELECT offer_id FROM completed WHERE user_id='".$userinfo['id']."' ) AND cid NOT IN (SELECT offer_id FROM pending WHERE user_id='".$userinfo['id']."' AND status='1' ) AND cid NOT IN (SELECT offer_id FROM pending WHERE user_id='".$userinfo['id']."' AND status='2' ) ORDER BY ".$category." ".$updown." " . $pagination->getLimitSql();
	
}
else {

// now use this SQL statement to get records from your table
$offersql = "SELECT * FROM `offers` WHERE active='1' ".$reward_type."  AND countries LIKE '%".$userinfo['country']."%'  AND category='".$type."' ORDER BY ".$category." ".$updown." " . $pagination->getLimitSql();
}
$resultoffersql = mysql_query($offersql)  or trigger_error(mysql_error().$sql);

while ($main = mysql_fetch_array($resultoffersql)) {

	echo "
	<form method=\"POST\"action=\"".$_SERVER['PHP_SELF']."?&offersnum=".$main['cid']."\">
	<div class=\"offerstable\">";
	
		// sets up pay ratio 50%
		
		if ($main[reward_type] == "Both") {
		$amountr = $main[reward] * .60;
		$amountp = $main[points] * .60;
		$amountr = money_format('$%i', $amountr);
		$amountp = $amountp * 100;
		$ofrtype = "both";
		}
		else if ($main[reward_type] == "Cash"){
		$amountr = $main[reward] * .60;
		$amountr = money_format('$%i', $amountr);
		$ofrtype = "reward";
		$otype2 = "c";
		}
		else if ($main[reward_type] == "Points"){
		$amountp = $main[points] * .60;
		$amountp = $amountp * 100;
		$ofrtype = "points";
		$otype2 = "p";
		}
		

		$urltest = substr($main[url], 7);  // test if url is adscend
		$urltest = explode("/click.php?", $urltest);
              
			
			if ($urltest[0] == "adscendmedia.com") {
			//if (isset($main[banner])) {
			//echo "<a href=\"".$main[url]."".$userinfo['username']."\" target=\"_blank\" onclick=\"offerClick".$main[cid]."=true\"><img src=\"".$main[banner]."\"  width=\"".$main[banner_width]."\" height=\"".$main[banner_height]."\" border=\"0\"></a><br>";
			//}
			echo "<a href=\"".$main[url]."".$userinfo['username']."\" target=\"_blank\" onclick=\"offerClick".$main[cid]."=true\"><b>".$main[name]."</b></a>";
			} else {
			//if (isset($main[banner])) {
			//echo "<a href=\"".$main[url]."".$userinfo['username']."/".$otype2."\" target=\"_blank\" onclick=\"offerClick".$main[cid]."=true\"><img src=\"".$main[banner]."\"  width=\"".$main[banner_width]."\" height=\"".$main[banner_height]."\" border=\"0\"></a><br>";
			//}
			echo "<a href=\"".$main[url]."".$userinfo['username']."/".$otype2."\" target=\"_blank\" onclick=\"offerClick".$main[cid]."=true\"><b>".$main[name]."</b></a>";
			
			}

			echo "
			<br/><span class=\"info\">".$main[info]."</span>
			<br/><span class=\"requirements\">".$main[requirements]."</span>
			<br/><span class=\"amount\">Amount: ";
			
			if ($ofrtype == "both") {
			echo "".$amountr." and ".$amountp." Points</span>";
			}
			else if ($ofrtype == "reward") {
			echo "".$amountr."</span>";
			}
			else if ($ofrtype == "points") {
			echo "".$amountp." Points</span>";
			}
			else {
			echo "There is no amount for this offer. Report this to an admin</span>";
			}
	                echo '  
	                        <input type="hidden" id="offernum" name="offernum" value="'.$main[cid].'" />
			        <br/>
			        <input class="offerbutton" type="submit" value="Submit">
			        <input class="offerbutton" type="button" value="Report" onClick="if(confirm(\'Are you sure this offer is not working correctly and you wish to report it?\')){open_report(\''.$main[cid].'\');}else{return false;}" />
				</div></form>';




}
if (isset($_GET['sort'])){
$sort = mysql_real_escape_string($_GET['sort']);
		if ($sort == "Cash" ) {
		$reward_type = " AND reward_type='Cash'";
		} else if ($sort == "Points" ) {
		$reward_type = " AND reward_type='Points'";
	 }
}
if ( $type == 12) { // all offers section
	if (isset($_GET['sort'])){ // pagination now filter if points or cash
		$sqlnum = "SELECT * FROM offers WHERE active='1' AND countries LIKE '%".$userinfo['country']."%' ".$reward_type." ";
	} else { // sort not set , but still all offers
		$sqlnum = "SELECT * FROM offers WHERE active='1' AND countries LIKE '%".$userinfo['country']."%' ";
	}
} else { //not all offers
	if (isset($_GET['sort'])){ //if sort selected
		$sqlnum = "SELECT * FROM offers WHERE active='1' AND countries LIKE '%".$userinfo['country']."%' AND category='".$type."' ".$reward_type." ";
	} else { //sort not selected
		$sqlnum = "SELECT * FROM offers WHERE active='1' AND countries LIKE '%".$userinfo['country']."%' AND category='".$type."'";
	}
}
$resultnum = mysql_query($sqlnum)  or trigger_error(mysql_error().$sql);
$numrows = mysql_num_rows($resultnum);

$totalpages2 = ceil($numrows / 10);

$pagelink2 = explode("&page=", $_SERVER["QUERY_STRING"]);

echo "<center><br><h1 style=\"font-size: 18px;\"> Displaying Page ".$page." of ".$totalpages2."</h1>";
$x = 7;
for ($i = $page - $x; $i < $page; $i++){
    if ($i >= 1) { /* show link */}
    else { /* show ellipsis and fix counter */ $i = 1; }
}
if ($page >= 2){ 
    $z = $i;
    $z = $z - 1;
    echo "<a class=\"pagenum\" href='offers.php?".$pagelink2[0]."&page=".$z."'><< Prev</a>";
    } else if ($page == 1) {
   // break;
    }
    else {
    $i = $i - 1; 
    echo "<a class=\"pagenum\" href='offers.php?".$pagelink2[0]."&page=".$i."'><< Prev</a>";
    }
    if ($page == 1) {
    echo "<a class=\"pagenum\" href='offers.php?".$pagelink2[0]."&page=1'>1</a>";
    } else {
    echo "<a class=\"pagenum\" href='offers.php?".$pagelink2[0]."&page=".$i."'>".$i."</a>";
    }
 for ($i = $page  + 1; $i < $page  + $x; $i++)
{  

    if ($i <= $totalpages2) { 
    echo "<a class=\"pagenum\" href='offers.php?".$pagelink2[0]."&page=".$i."'>".$i."</a>";
    }
    else {
    
     break; }
}
if ( $page == $totalpages2 ) {
  //  break;
} else {
echo "<a class=\"pagenum\" href='offers.php?".$pagelink2[0]."&page=".$i."'>Next >> </a>";    
}
echo "</center>";
} //if oid not set
} //if offernum empty
} //if set browse
} //if loggedin bracket end

	echo "
	</div>
	<div id=\"right\">";
	include("includes/right.php");
	echo "</div>";
	include "footer.php";
?>