<?php 
session_start();
 if (!isset($_SESSION['letmein'])){
	header ("Location: index.php?invalid=PLEASE LOGIN");
				  }
require_once('Connections/dbConnect.php'); ?>
<?php
if ((isset($HTTP_POST_VARS["send"]))) {
$from=$HTTP_POST_VARS["textfield"];
$subject=$HTTP_POST_VARS["textfield2"];
$body=$HTTP_POST_VARS["textarea"];
$sendType=$HTTP_POST_VARS["select"];
$format=$HTTP_POST_VARS["format"];

switch ($sendType) {
case "allactive":
$mailQuery = "SELECT fname, email from user where verified='y' and receiveEmail='y'";
break;
case "allinactive":
$mailQuery = "SELECT fname, email from user where verified='n' and receiveEmail='y'";
break;
case "test":
$sendTest=true;
break;
default:
$mailQuery = "SELECT fname, email from user where receiveEmail='y'";
}
//$query="SELECT fname, email from user where username='tony'";
if ($sendTest){
}else{
$result = mysql_query($mailQuery) or die ("Error in query: $mailQuery. " .
mysql_error());
}

$headers  = "MIME-Version: 1.0\r\n";
if ($format="HTML") {
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
} else {
}

//$headers .= "bcc: schiffba@aii.edu, tschiffbauer@crossoft.com\r\n";
$headers .= "From: " ."$from"."<"."$from" .">\n"; 

if ($sendTest){
$message = $body;
$message = stripslashes($message);


mail($contact_email, $subject, $message, $headers);
} else {

$headers  .= "bcc:";
if (mysql_num_rows($result) > 0)
{
	// iterate through resultset
	// print title with links to edit and delete scripts
	while($row = mysql_fetch_object($result))
		{
	$message= $body; 
	$message=stripslashes($message);

$headers  .= "$row->email,";
		}
$headers  .= "$contact_email\r\n";
mail($contact_email, $subject, $message, $headers); 
	}
}
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>

<table class="supermenuNoshadow" width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="menuheader">Success!</td>
  </tr>
  <tr>
    <td class="smallstatsText">Your emails have been sent.</td>
  </tr>
</table>
<?php
} else {

mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = "SELECT * FROM siteParams";
$Recordset1 = mysql_query($query_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
    <tr> 
     	 <td colspan="2" align="left" class="menuheader">enter your email message 
        and then hit send.</td>
    </tr>
    <tr> 
      <td align="right" class="smallstatsText">Send To:</td>
      <td class="smallstatsText"><select name="select">
          <option value="all">All Users</option>
          <option value="allactive">All Active Users</option>
          <option value="allinactive">All Inactive Users</option>
          <option value="test" SELECTED>TEST SEND</option>
        </select></td>
    </tr>
    <tr> 
      <td align="right" class="smallstatsText">From Address:</td>
      <td class="smallstatsText"><input name="textfield" type="text" value="<?php echo $row_Recordset1['contact_email']; ?>" size="40"></td>
    </tr>
    <tr>
      <td align="right" class="smallstatsText">Subject:</td>
      <td class="smallstatsText"><input name="textfield2" type="text" value="<?php echo $row_Recordset1['title']; ?> Message" size="40"></td>
    </tr>
    <tr> 
      <td align="right" class="smallstatsText">Format:</td>
      <td class="smallstatsText"><select name="format">
          <option value="html">HTML</option>
          <option value="text">TEXT</option>
        </select></td>
    </tr>
    <tr> 
      <td class="smallstatsText"><br> </td>
      <td class="smallstatsText"><p><br>
          type or paste your message bellow:<br>
          <textarea name="textarea" cols="80" rows="10"><BR><?php echo $row_Recordset1['emailFooter']; ?></textarea>
        </p>
        <p> 
          <input type="submit" name="send" value="send" onclick="javascript:void(0);changeVisibility(1,document.getElementById('fart',visible));">
        </p>
        <table width="40%" border="0" cellspacing="0" cellpadding="2" class="superMenu">
          <tr> 
            <td class="menuheader">mail sub menu</td>
          </tr>
          <tr> 
            <td class="smallstatsText"><a href="activeemailDump.php" target="_blank">show 
              me all active emails</a></td>
          </tr>
          <tr> 
            <td class="smallstatsText"><a href="allemailDump.php" target="_blank">show 
              me all emails</a></td>
          </tr>
        </table> <br> </td>
    </tr>
  </table>
</form>
<div id="fart" style="visibility=hidden;position:absolute; width:419px; height:231px; z-index:1; left: 262px; top: 163px;"> 
  <table class="supermenu" width="100%" height="138" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
    <tr>
      <td height="23" class="menuheader"><strong>Please Wait</strong></td>
    </tr>
    <tr>
      <td><p><strong><font color="#FF0000" size="+1">Your emails are being sent. This may take 
          a while depending on how many users you have in the database.</font></strong></p>
        <p>&nbsp;</p></td>
    </tr>
  </table>
  
</div>
</div>
<?php

mysql_free_result($Recordset1);
}?>
<script language="JavaScript">
//constants
isIE = (navigator.appName.indexOf('Netscape') == -1)?true:false;
var hidden = (document.layers)?"hide":"hidden";
var visible = (document.layers)?"show":"visible";
var toggle = "toggle";

function changeVisibility(resetType,theDiv,tempState) {
	var daObj = theDiv;
	var daVisibility=tempState?tempState:toggle;
	if (resetType && resetType == 1) {
		window.document.value='';
		showSubMenus2('hide','fart',false);
		resetType = 2;
	}
	
	if(daObj.style) daObj=daObj.style;
	if(daVisibility == hidden||daVisibility == visible) daObj.visibility = daVisibility;
	else if(daVisibility == toggle) daObj.visibility = (daObj.visibility == hidden)?visible:hidden;
}

function showSubMenus2(theState,menu,cascade) {
	
	var tempState = (theState == 'hide')?(document.layers)?"hide":"hidden":(document.layers)?"show":"visible";
	var daObj = document.getElementById(menu,visible);
	if (cascade) showSubMenus1(theState);
	if(daObj.style) daObj=daObj.style;
	daObj.visibility = tempState;
}
</script>

