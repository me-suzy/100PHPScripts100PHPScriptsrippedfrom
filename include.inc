<?
require 'dconn.php';
// DO NOT EDIT BELOW THIS LINE

global $title, $styleSheet, $bgColor, $tableColor2, $contact_email, $user_string, $email, $website, $userid, $points, $id, $username, $clickBank;
	$connection = mysql_connect($db_server, $db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_name, $connection) or die(mysql_error());
 
$sql = "SELECT * from siteParams";
	$u_result = mysql_query( $sql );
	if ( $u_result != false )
	{
		while ( $data = mysql_fetch_assoc( $u_result ) )
		{
			
			$hpoints = $data['points'];
			$styleSheet = $data['styleSheet'];
			$title = $data['title'];
			$bgColor = $data['bgColor'];
			$headerColor = $data['headerColor'];
			$fontEmph = $data['fontEmph'];
			$tableColor = $data['tableColor'];
			$tableColor2= $data['tableColor2'];
			$alertColor = $data['alertColor'];
			$sellPoints = $data['sellPoints'];
			$signPoints = $data['signPoints'];
			$refPoints =$data['refPoints'];
			$pointInc = $data['pointInc'];
			$banner_img = $data['banner_img'];
			$banner_imgSmall = $data['banner_imgSmall'];
			$contact_email = $data['contact_email'];
			$paypal = $data['paypal'];
			$clickBank = $data['clickBank'];
			$siteUrl = $data['siteUrl'];
			$privacy = $data['privacy'];
			$spam = $data['spam'];
			$mainText = $data['mainText'];
			$pickType = $data['pickType'];
			$contact_name =$data['contact_name'];
			$emailFooter = $data['emailFooter'];
						
			}
		} else {
		echo mysql_error();
	}
 if ($_POST['edit_profile']){
	$option =$_POST['option'];

	$query = "UPDATE user SET email = '$_POST[email]' WHERE id = '$_POST[id]'";
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
	
	$query = "UPDATE user SET receiveEmail = '$_POST[receiveEmail]' WHERE id = '$_POST[id]'";
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

	} else {

	}
 
 if ($_POST['addURL']){
	$option =$_POST['option'];
$query = "INSERT INTO url_table (id, userid, website,active,datechanged) VALUES('', '$_POST[id]' , '$_POST[addWebsite]','n','')";
	$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
	
	} else {

	}
function error($msg) {
?>
<script language="Javascript">
alert("<?=$msg?>");
</script>
<?
}
 function signupThankyou($email){
 pageHeader($title, $bgColor);
 ?>
  <DIV align=left>
<TABLE border="0" cellPadding="0" cellSpacing="0" style="topmargin: 0; leftmargin: 0" width="100%">
  <TBODY>
  <TR>
    <TD height="100%" width="33%">&nbsp;</TD>
    <TD bgColor="#ffffff" vAlign="top" width="800"><A name="#top"></A><!-- TOPTab --><!-- NaviTab -->
      <DIV align=left>
      <TABLE bgColor="#ffffff" border="5" cellPadding="0" cellSpacing="0" width="800"><!-- row1 -->
        <TBODY>
        <TR>
          <TD bgColor="#ffffff" width="75"></TD>
          <TD  width="650"><IMG border="0" height="72" src="images/<? echo $banner_img; ?>" width="650" alt="<? echo $title; ?>"></TD>
          <TD bgColor="#ffffff" width="75">&nbsp;</TD></TR>
        <!-- row3 -->
        <TR>
          <TD bgColor="#ffffff" width=75></TD>
          <TD class="font" align="CENTER" bgColor="#ffffff" height=20 vAlign="MIDDLE" width="650">
            <P align=left class="font">ffffff<? echo $title; ?>
               <IMG border=0 height=2 src="images/linie.gif" width="650" alt="--"></P></TD>
          <TD bgColor="#ffffff" width=75>&nbsp;</TD></TR>

<TR><TD>
<table border=4 cellpadding=1 cellspacing=4 width=400>
  <tbody> 
  <tr> 
    <td align="CENTER" bgcolor="#660000" colspan="2"><font
                        color="#ffffff" face="Arial,Helvetica,Geneva,sans-serif"
                        size="4"><b></b></font></td>
  </tr>
  <tr> 
    <td bgcolor="#ffffff" colspan=2 valign="TOP"><font color="#333333"> Validation 
      email has been sent to 
      <? echo $email;?>
      . You may now complete the login process by opening your email and clicking 
      on the link provided. You will be prompted for a login name to use on the 
      system. Once you provide your desired login name, you will be directed to 
      the main login screen. Re-type your password, and that's it. Your site is 
      immediately activated and other members will start seeing it immediately. 
      </font></td>
  </tr>
  <tr> 
    <td align="CENTER" colspan=2 height=20 valign="MIDDLE" > <img border=0 height=2 src="images/linie.gif" width="380" alt="--"></td>
  </tr>
</table>
</td></tr>
</table>
  
 <? footer("$contact_email"); ?>
                </TD>
                <TD align="CENTER" vAlign="top" width=150>&nbsp;</TD></TR>
                </TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></DIV></TD>
    <TD height="100%"
width="34%">&nbsp;</TD></TR></TBODY></TABLE></DIV>
</BODY></HTML>

 <? }
    
 function footer($contact_email) {
 ?>
 <CENTER>
 <table>

                  <td class="font"><a href="mailto: <? echo $contact_email; ?>">-contact us-</a>&nbsp;&nbsp;<a href="privacy.htm" target="_NEW">-privacy policy-</a>&nbsp;&nbsp;<a href="spam.htm" target="_NEW">-spam policy-</a></td></tr><TR><TD class="font">&copy;2003 <a href="http://www.mishies.com" target="new">Mishies.com</a>
                   All Rights Reserved.<BR><STRONG><a href="http://www.mishies.com/codemachine.asp" target="_blank">POWERED BY HIT JAMMER 1.0!</a></strong></td></tr>
 </table>
 </CENTER>
 <?}
 
 function footerAdmin($contact_email) {
 ?><table>
<TR>
                  <td>&copy;2002 <a href="http://www.mishies.com" target="new">Mishies.com</a></td>
</tr>
 </table>
 <?}                 

function mainStats($id) {
$sql = "SELECT url_points.pointdate, url_points.points as u_points from url_points where url_points.pointdate = ".date("Ymd")." and url_points.urlid=".$id;
	$u_result = mysql_query( $sql );
	if ( $u_result != false )
	{
		while ( $data = mysql_fetch_assoc( $u_result ) )
		{
			$u_points = $data['u_points'];
			$fname = $data['fname'];
			$lname = $data['lname'];
 
			}
		} else {
		echo mysql_error();
	}
 $sql = "SELECT points from points where userid=".$id;
	$u_result = mysql_query( $sql );
	if ( $u_result != false )
	{
		while ( $data = mysql_fetch_assoc( $u_result ) )
		{
			
			$hpoints = $data['points'];
			
			
			}
		} else {
		echo mysql_error();
	}
 $sql = "SELECT * from user where id=".$id;
	$u_result = mysql_query( $sql );
	if ( $u_result != false )
	{
		while ( $data = mysql_fetch_assoc( $u_result ) )
		{
			
			$point_inc = $data['point_inc'];
			$verified = $data['verified'];
			
			
			}
		} else {
		echo mysql_error();
	}

?> 
	<table class="supermenuNoShadow
cellpadding="2" cellspacing="0" border=0 width="100%";>
	<tr><Td class="menuheader">Account Status</td><td
class="menuheader"><? if ($verified == 'y') {
	print "ACTIVE";
	} else {
	print "NOT ACTIVE";
	} ?></td></tr>
	<tr><Td>Number of Hits (last 24hrs)</td><td><? print $u_points; ?></td></tr>
	<!-- <tr><Td>Hits Earned</td><td>ACTIVE</td></tr> --->
	<tr><Td class="menuheader">Hit Ballance</td><td
class="menuheader"><? print
$hpoints; ?></td></tr>
	<tr><Td>Point Increment</td><td><? print $point_inc; ?></td></tr>
	<TR><TD class="menuheader" colspan=2>Your Referals:</td></tr>
	<TR><TD colspan=2><? referals($id); ?></td></tr>
	</table>
	<?

}



function referals($id){
			$query = "SELECT username, joindate from user where referral=".$id;
				$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
// if records present
?> 
<center>
<table class="supermenu" width = 100%
border=0><TR><TD class="menuheader"><B>user</b></td><td
class="menuheader"><center><b>Date
Joined</center></b></td></tr><TR>
<?
	if (mysql_num_rows($result) > 0)
				{

					while($row = mysql_fetch_object($result))
						{
							?>
								<TD
class="smalltext"><font size="-1"><? echo $row->username; ?></font></td>
								<TD><center><font size="-1"><? echo $row->joindate; ?></font></center></td>

								</tr>
							<?
						}

				}

else {
?><TD class="smalltext" colspan=2>NONE</td></tr>
<?
}
?></table><?
}
function purchasePoints($headerColor, $tableColor2){
 ?>
    <TABLE bgcolor="<?php echo $tableColor2; ?>" border=0 cellPadding=2 cellSpacing=0 class="supermenuNoshadow" width=150>
     
     <TR>
       <TD class="menuheader" bgColor="<? echo $headerColor; ?>" valign="MIDDLE" ><FONT color="<? echo $tableColor; ?>" size="2">&nbsp;Purchase Points</font></TD></TR>
     <TR>
       <TD  colSpan="2">
       
            
        &nbsp;&nbsp;&nbsp;<A class=normal href="<? echo $PHP_SELF;?>?option=purchase points">Purchase Points</a><br>
        &nbsp;&nbsp;&nbsp;<A class=normal href="<? echo $PHP_SELF;?>?option=purchase banner ads">Banner Ads (NEW)</a><br>
       <BR>
       </TD></TR>
     <TR>
      </TABLE>
      
   <?
   }
 
function contactMe($contact_email) {


?>
<table class="supermenuNoshadow" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td class="menuheader">Contact Information</td>
  </tr>
  <tr>
    <td>If you have a question, comment, or just want to blab, simply send me 
      an email. I'll try to have a response within 24 hours.<br>
    </td>
  </tr>
  <tr>
    <td><a href="mailto:<? echo $contact_email; ?>"><? echo $contact_email; ?></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table><BR>
<?   
	}
	
function rightBlock($headerColor, $tableColor, $tableColor2) {
$sql = "SELECT * from rightBlock where active='y' and position='r'";
	$result = mysql_query( $sql );
	if ( $result != false )
	{
		while ( $data = mysql_fetch_assoc( $result ) )
		{
		$title=$data['title'];
		$bodyText=$data['body'];
		
		?>
		<TABLE class="supermenu" cellPadding=2 cellSpacing=0  width=100%>
              <TR> 
                <TD class="menuheader" bgColor="<? echo $headerColor; ?>" vAlign="MIDDLE"> <FONT color="<? echo $tableColor; ?>" size="2"><? echo $title; ?></FONT> 
                </TD>
              </TR>
              <TR> 
                <TD colSpan="2" valign="top" bgColor="<? echo $tableColor2; ?>"> 
                  <table border=0>
                    <tr> 
                      <td width="139"><? echo $bodyText; ?>

                      </td>
                    </tr>
                  </table></TD>
              </TR>
            </TABLE><BR>
		
	<?	
	
		}
	} else {
		echo mysql_error();
	}

}
function leftBlock($headerColor, $tableColor, $tableColor2) {
$sql = "SELECT * from rightBlock where active='y' and position='l'";
	$result = mysql_query( $sql );
	if ( $result != false )
	{
		while ( $data = mysql_fetch_assoc( $result ) )
		{
		$title=$data['title'];
		$bodyText=$data['body'];
		
		?>
		<TABLE class="supermenu" cellPadding=4 cellSpacing=0  width=100%>
              <TR> 
                <TD class="menuheader" bgColor="<? echo $headerColor; ?>" vAlign="MIDDLE"> <FONT color="<? echo $tableColor; ?>" size="2"><? echo $title; ?></FONT> 
                </TD>
              </TR>
              <TR> 
                <TD colSpan="2" valign="top" bgColor="<? echo $tableColor2; ?>"> 
                  <table border=0>
                    <tr> 
                      <td width="139"><? echo $bodyText; ?>

                      </td>
                    </tr>
                  </table></TD>
              </TR>
            </TABLE><BR>
		
	<?	
	
		}
	} else {
		echo mysql_error();
	}

}
function faq() {
$sql = "SELECT question, answer FROM faq";
?>
<table cellpadding="2" cellspacing="1" class="supermenu">
         <TR><td>
      
<?
	$result = mysql_query( $sql );
	if ( $result != false )
	{
		while ( $data = mysql_fetch_assoc( $result ) )
		{
		$question=$data['question'];
		$answer=$data['answer'];
	echo "<TR><TD><B>$question</B><BR>$answer</td></tr>";

		}
	} else {
		echo mysql_error();
	}
?>
  </table><BR>
  <?
}
function thankyoupoints() {
?>

<center>
You account should automatically be credited with the points you have purchased.  Just click on the personal stats
link to see your account point balance.
</center>
<?
}

function marketingResources($clickBank, $title){
?>
 		<table class="supermenu" width="100%" border="0" cellpadding="2" cellspacing="0">

  <tr>
    <td><strong>Here are some other cool things in the digital marketplace that 
      you can check out. Each link opens a new browser so you won't get lost from 
      <? echo $title; ?></strong></td>
  </tr>
  <tr> 
    <td> 
      <table width="100%" border="0" align="center" >
        <tr> 
          <td width="40%"><a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=fun&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img id="Picture15"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=fun&s=0&i=10&t=ClickBank_Marketplace" target="_new">Fun 
            &amp; Entertainment</a> <a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=health&s=0&i=10&t=ClickBank_Marketplace" target="_new"><br>
            <img id="Picture16"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=health&s=0&i=10&t=ClickBank_Marketplace" target="_new">Health 
            &amp; Fitness</a> <br> <a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=family&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img id="Picture17"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=family&s=0&i=10&t=ClickBank_Marketplace" target="_new">Home 
            &amp; Family</a><br> <a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=culture&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img id="Picture18"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=culture&s=0&i=10&t=ClickBank_Marketplace" target="_new">Society 
            &amp; Culture</a> <br> </td>
          <td width="60%"><div align="left"><a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=b2b&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img id="Picture11"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=b2b&s=0&i=10&t=ClickBank_Marketplace" target="_new"> 
              Business to Business<br>
              </a> <a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=marketing&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img
                                                             id="Picture12" height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=marketing&s=0&i=10&t=ClickBank_Marketplace" target="_new">Marketing 
              &amp; Advertising<br>
              </a> <a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=web&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img id="Picture13"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=web&s=0&i=10&t=ClickBank_Marketplace" target="_new">Computing 
              &amp; Internet</a><br>
              <a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=money&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img id="Picture14"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=money&s=0&i=10&t=ClickBank_Marketplace" target="_new">Money 
              &amp; Employment</a><br>
              <a href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=sports&s=0&i=10&t=ClickBank_Marketplace" target="_new"><img id="Picture19"
                                                             height=17 width=17 src="images/arrow.gif" vspace=0 hspace=0 align="TOP" border=0></a>&nbsp;<a
                                                             href="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=sports&s=0&i=10&t=ClickBank_Marketplace" target="_new">Sports 
              &amp; Recreation</a> <br>
            </div></td>
        </tr>
      </table>
      <br>
    </td>
  </tr>
</table>
<P><A HREF="http://clickbank.com/marketplace/?r=<? echo $clickBank; ?>&c=b2b&s=0&i=10&t=ClickBank_Marketplace" target="_new"><br>
  
  </A> 
<?
}
function top25() {
$query = "SELECT DISTINCT user.id, user.username, points.points FROM user INNER JOIN points ON user.id = points.userid INNER JOIN url_table ON user.id=url_table.userid where verified='y' ORDER BY points DESC LIMIT 25";
$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());

// if records present
?> 
<center>
<table class="supermenuNoshadow" cellpadding="2" cellspacing="0" width =
100% border=0><TR><td
class="menuheader"><center><b>username</center></b></td><td
class="menuheader"><b>points</b></td></tr><TR> <?
if (mysql_num_rows($result) > 0)
{

	while($row = mysql_fetch_object($result))
		{
		?>
		
		<TD><center><font size="-1"><? echo $row->username; ?></font></center></td>
		<TD><font size="-1"><? echo $row->points; ?></font></td>
</tr>
		<?
		}

}
else
{
?>
	<font size="-1">No Users in List</font><p>
<?
}

?>
</table>
</center>
<? } 
function personalLink($id, $title, $site_url) {
?>
	<table class="supermenu" cellpadding="2" cellspacing="0" border=0
width="100%";>
	<tr><Td class="menuheader">Include the following code in one of
your web pages to 
	refer users and earn points when they sign up and Surf at <B><? print $title;?></b>.<BR> </td></tr>
	<tr><Td><CENTER><font color="blue">
	&lt!-- <? print $title;?> Link Follows --&gt<BR>
&lta href="<? print $site_url; ?>index.php?referral=<? echo $id; ?>"&gt
 &ltimg src="<? print $site_url; ?>images/banner.gif">
&lt/a&gt
<BR>&lt!-- End <? print $title;?> Link --&gt</center></td></tr>	
	</table>

<? }
	
function personalStats($id, $username) {
$sql = "SELECT user.username, user.email, user.receiveEmail,  points.points FROM user INNER JOIN points ON user.id = points.userid where user.id=".$id;

	$u_result = mysql_query( $sql );
	if ( $u_result != false )
	{
		while ( $data = mysql_fetch_assoc( $u_result ) )
		{

			$_SESSION['inc'] = $data['point_inc'];
			$_SESSION['u_points'] = $data['u_points'];
			//$username = $data['loginname'];
			$p = $data['points'];
			$email = $data['email'];
			$website = $data['website'];
			$receiveEmail = $data['receiveEmail'];
			$_SESSION['fname'] = $data['fname'];
			$_SESSION['lname'] = $data['lname'];
			$_SESSION['active_user'] = $data['verified'];

			}		
		} else {
		echo mysql_error();
	}

$sql = "SELECT id, website from url_table where userid=".$id;
	$u_result = mysql_query( $sql );
	if ( $u_result != false )
	{
		while ( $data = mysql_fetch_assoc( $u_result ) )
		{

			$website = $data['website'];
			$websiteId = $data['userid'];

			}		
		} else {
		echo mysql_error();
	}

?>
<form action="<? echo $PHP_SELF; ?>" method="POST">
<input type="hidden" name="id"  value="<? echo $id; ?>">
<input type="hidden" name="edit_profile"  value="yes">
<input type="hidden" name="option"  value="<font color=blue>profile updated</font>">

	<table
class="supermenuNoshadow" cellpadding="2" cellspacing="0" width="100%">
	<tr><Td>Username</td><td><? print $username;?></td></tr>
	<tr><Td>Points</td><td><? print  $p; ?></td></tr>
	<tr><Td>Email Address</td><td><input type="text" size=30 name="email" value="<? echo $email; ?>"></td></tr>
	<tr><Td>Receive Emails?(y/n)</td><td><input type="text" maxlength=1 size=2 name="receiveEmail" value="<? echo $receiveEmail; ?>"></td></tr>
	<TR><TD colspan = 2><input type="Submit" name="submit" value="Update"></td></tr>
	<TR><TD colspan = 2><HR></td></tr>
</form>

<form action="<? echo $PHP_SELF; ?>" method="POST">
<input type="hidden" name="id"  value="<? echo $id; ?>">
<input type="hidden" name="addURL"  value="yes">
<input type="hidden" name="option"  value="<font color=blue>url added</font>">
<tr><Td>Add another URL</td><td><input type="text" size=30 name="addWebsite" value="http://"></td></tr>
	<TR><TD colspan = 2><input type="Submit" name="submit" value="add"></td></tr>
<TR><TD colspan=2><HR></td></tr>

</form>
<TR><TD colspan=2>

<?			
$query = "SELECT id as delurl, website, active FROM url_table where userid=".$id;
$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());
?>
<CEnter>
<table
class="supermenuNoShadow" width="100%" cellpadding="2" cellspacing="0">
<TR><TD class="menuheader" colspan=3
bgcolor="#999999"><CENTER><strong>Your
Listed Websites.</strong></CENTER></td></tr>
<TR><TD><b>URL</td><td>active</td><td><b>action</td></tr><TR >
<?
if (mysql_num_rows($result) > 0)
{
	// iterate through resultset
	// print title with links to edit and delete scripts
	while($row = mysql_fetch_object($result))
		{
		?>
		<TD><font size="-1"><? echo
$row->website; ?></font></td>
		<TD><font size="-1"><? echo $row->active; ?></font></td>		

		<TD>
<font size="-2"><a onmouseover="javascript:window.status='Click here to delete this row.'; return true;" onmouseout="javascript:window.status=''; return true;" href="javascript:if (window.confirm('Are you sure?')) { location.href='<? echo $PHP_SELF; ?>?option=Url Deleted&id=<? echo $id; ?>&webid=<? echo $row->delurl; ?>'; }">delete</a></font></td></tr>

		<?
		}

}

// if no records present
// display message

else
{
?>
</table><BR>
	<font size="-1">No URLS Listed</font>
<?
}
?>
			

</td>
</tr>

            </TABLE>
            </tr></td></table><BR>
<?

} // open database connection

function urlDelete($id, $webid){
$query = "DELETE FROM url_table WHERE userid = $id and id = $webid";
$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());
echo "<font size=-1>Deletion successful!</font>";
}

function navigation($id, $headerColor, $tableColor2) { ?>
    <TABLE bgcolor="<?php echo $tableColor2; ?>" border=0 cellPadding=2 cellSpacing=0 class="supermenuNoshadow" width=150>
     <TBODY>
     <TR>
       <TD class="menuheader" bgColor="<? echo $headerColor; ?>"  vAlign="MIDDLE" >&nbsp;Main Menu</TD></TR>
     <TR>
       <TD colSpan="2">

        &nbsp;&nbsp;&nbsp;<A class=normal href="<? echo $PHP_SELF;?>?option=Home">Home</a><br>
        &nbsp;&nbsp;&nbsp;<A class=normal href="<? echo $PHP_SELF; ?>?userid=<? print $id; ?>&option=personal stats">personal stats</a><br>
        &nbsp;&nbsp;&nbsp;<A class=normal href="<? echo $PHP_SELF; ?>?option=personal link">personal link</a><br>
        &nbsp;&nbsp;&nbsp;<A class=normal href="<? echo $PHP_SELF; ?>?option=Top25">Top 25 Points Leaders</a><br>
        &nbsp;&nbsp;&nbsp;<A class=normal href="<? echo $PHP_SELF; ?>?option=frequently asked questions">FAQ</a><br>
        &nbsp;&nbsp;&nbsp;<A class=normal href="index.php">Log Out</a><br>
      
       
<BR>
       </TD></TR>
     <TR>
      </TBODY></TABLE>
<? } 

function siteStats(){
$query="SELECT * FROM user";
$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());
$num_rows = mysql_num_rows($result);
$query2= "SELECT * FROM user where verified='y'";
$result = mysql_query($query2) or die ("Error in query: $query2. " .
mysql_error());
$num_rows2 = mysql_num_rows($result); 
$query3 = "Select FOUND_ROWS()";
$count_result = mysql_query($query3);
?>
<center>
<table cellpadding="4" style="border:solid black 1px;">
<TR><TD colspan=2 bgcolor="#999999"><CENTER><strong>Quick Stats.</strong></CENTER></td></tr>
<TR><TD><b>Total Number of Users</td><td><b><? echo "$num_rows"; ?></td></tr>
<TR><TD><b>Total Number of Active Users</td><td><b><? echo "$num_rows2"; ?></td></tr>
</table>
<?
}

function  blockList($id){
$query = "SELECT * from rightBlock";

$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());
?> 
<center>
<table cellpadding="3" style="border:solid black 1px;">
<TR><TD colspan=4 bgcolor="#999999"><CENTER><strong>select edit/add or delete</strong></CENTER></td></tr>
<TR><!--- <td><b>question</td> ---><td><b>Title</td><!--- <td><b>answer</td> ---><TD><b>action</td></tr><TR >
<?
if (mysql_num_rows($result) > 0)
{
	// iterate through resultset
	// print title with links to edit and delete scripts
	while($row = mysql_fetch_object($result))
		{
		?>

		<TD><font size="-1"><? echo $row->title; ?></font></td>
		<TD>
		<font size="-2"><a href="admin.php?option=blockedit&id=<? echo $row->id; ?>">edit</a> | <a onmouseover="javascript:window.status='Click here to delete this row.'; return true;" onmouseout="javascript:window.status=''; return true;" href="javascript:if (window.confirm('Are you sure?')) { location.href='admin.php?option=blockdelete&id=<? echo $row->id; ?>'; }">delete</a></font></td></tr>
		<?
		}

}

else
{
?>
	<font size="-1">No Blocks in List</font><p>
<?
}

?>
<TR><TD colspan=7><a href="admin.php?option=blockadd"><font color=red>add a new block</font></a></td></tr>
<TR><TD colspan=7 bgcolor="#999999"><a href="admin.php"><center>back to main menu</center></a></td></tr>
</table>
</center>
<?
}


function urlList() {
$query = "SELECT * FROM url_table order by userid, active";
$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());
?> 
<center>
<table cellpadding="4" style="border:solid black 1px;">
<TR><TD colspan=7 bgcolor="#999999"><CENTER><strong>Select Edit to edit a URL.</strong></CENTER></td></tr>
<TR><TD><b>ID</td><td><b>username</td><td><b>URL</td><td><b>active</td><td><b>action</td></tr><TR >
<?
if (mysql_num_rows($result) > 0)
{
	// iterate through resultset
	// print title with links to edit and delete scripts
	while($row = mysql_fetch_object($result))
		{
		?>
		<TD><font size="-1"><? echo $row->id; ?></font></td>
		<TD><font size="-1"><? echo $row->userid; ?></font></td>
<TD><font size="-1"><a href="<? echo $row->website; ?>" target="_blank"><? echo $row->website; ?></a></font></td> 
		<TD><font size="-1"><? echo $row->active; ?></font></td>

		<TD>
		<font size="-2"><a href="admin.php?option=editURL&id=<? echo $row->id; ?>">edit</a> | <a onmouseover="javascript:window.status='Click here to delete this row.'; return true;" onmouseout="javascript:window.status=''; return true;" href="javascript:if (window.confirm('Are you sure?')) { location.href='admin.php?option=deleteURL&id=<? echo $row->id; ?>'; }">delete</a></font></td></tr>
		<?
		}

}
else
{
?>
	<font size="-1">No URL's Listed</font><p>
<?
}


?>
<TR><TD colspan=7 bgcolor="#999999"><a href="admin.php"><center>back to main menu</center></a></td></tr>
</table>
</center>
<?
}

function emailUsers($emailFooter, $title, $contact_email,$submit, $sendit, $From, $Subject, $Body, $option){
if (!$sendit){
?>
<form ENCTYPE="MULTIPART/FORM-DATA" method=post action="<? echo $PHP_SELF."?option=email"; ?>">
  <input type="hidden" name="sendit"  value="yes">
  <TR> 
    <TD bgcolor="#999999"><strong>Enter your email message and then hit send.</strong></td>
  </tr>
  <TR> 
    <TD bgcolor=> <table width="453" align="center">
        <tr> 
          <td><b>From Address:</b></td>
          <td> <input type=text name="From" size="40" value="<? echo $contact_email; ?>"> </td>
        </tr>
        <tr> 
          <td><b>Subject:</b> </td>
          <td> <br> <input type=text name="Subject" size="40" value="<? echo $title; ?>"></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>Type or paste your message below: <br> <textarea cols=50 rows=10 name="Body"><? echo $emailFooter; ?></textarea> 
          </td>
        </tr>
        <tr> 
          <td width="108">&nbsp;</td>
          <td width="638"><input type="submit" name="Submit" value="Send Mail"> 
          </td>
        </tr>
      </table>
      <div align="center"><br>
        <br>
      </div>
</form>
<?
		}
else
{
// generate and execute query
//$query="SELECT fname, email from user where verified='y' and receiveEmail='y'";
$query="SELECT fname, email from user where username='tony'";
$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "Bcc: goargos_2000@yahoo.com\n";
$headers .= "From: " ."$From"."<"."$From" .">\n"; 

if (mysql_num_rows($result) > 0)
{
	// iterate through resultset
	// print title with links to edit and delete scripts
	while($row = mysql_fetch_object($result))
		{


	$intro="Hi ".$row->fname.",\r\n";
	$message= $intro.$Body; 
	$message=stripslashes($message);
mail($row->email, $Subject, $message, $headers); 

		}

}

?>
<TR>
  <TD colspan=2><center>
      <font>Mail Sent!</font></center></td>
</tr>
<?
}


?>
<TR> 
  <TD colspan=2 bgcolor="#999999"><a href="admin.php"> 
    <center>
      back to main menu 
    </center>
    </a></td>
</tr>
<? 
}


function faqList(){
// generate and execute query
$query = "SELECT * from faq";

$result = mysql_query($query) or die ("Error in query: $query. " .
mysql_error());
?> 
<center>
<table cellpadding="3" style="border:solid black 1px;">
<TR><TD colspan=4 bgcolor="#999999"><CENTER><strong>select edit/add or delete</strong></CENTER></td></tr>
<TR><!--- <td><b>question</td> ---><td><b>question</td><!--- <td><b>answer</td> ---><TD><b>action</td></tr><TR >
<?
if (mysql_num_rows($result) > 0)
{

	while($row = mysql_fetch_object($result))
		{
		?>

		<TD><font size="-1"><? echo $row->question; ?></font></td>

		<TD>
		<font size="-2"><a href="admin.php?option=faqedit&id=<? echo $row->id; ?>">edit</a> | <a onmouseover="javascript:window.status='Click here to delete this row.'; return true;" onmouseout="javascript:window.status=''; return true;" href="javascript:if (window.confirm('Are you sure?')) { location.href='admin.php?option=faqdelete&id=<? echo $row->id; ?>'; }">delete</a></font></td></tr>
		<?
		}

}
else
{
?>
	<font size="-1">No Users in List</font><p>
<?
}
?>
<TR><TD colspan=7><a href="admin.php?option=faqadd"><font color=red>add a new faq</font></a></td></tr>
<TR><TD colspan=7 bgcolor="#999999"><a href="admin.php"><center>back to main menu</center></a></td></tr>
</table>
</center>
<?
}


function startSurfing($id, $username, $headerColor, $tableColor2) {
?>
<TABLE bgcolor="<?php echo $tableColor2; ?>" border=0 cellPadding=2 cellSpacing=0 class="supermenuNoshadow" width=150>
     
     <TR>
       <TD class="menuheader" bgColor="<? echo $headerColor; ?>" vAlign="MIDDLE" >&nbsp;Start Surfing</TD></TR>
     <TR>
       <TD  colSpan="2">

<a href=surf.php?userid=<? echo $id;?>&username=<? echo $username;  ?> ><img src="images/arrow.gif " border=0>start surfing to earn points!</a><br></TD></TR>
     <TR>
     </TABLE>
      <? }


 function pageHeader($title, $bgColor, $styleSheet) {
      ?>
<html>
 <head>
 <SCRIPT LANGUAGE="JavaScript">

function viewform (name) {

window.open(name,"Form","scrollbars=yes,resizable,height=275,width=100");



	}



</SCRIPT>
  <title>
   <? echo $title; ?>
  </title>
  <link href="<?php echo $styleSheet; ?>" rel="stylesheet" type="text/css">
 </head>
 
<META content="text/html; charset=windows-1252" http-equiv=Content-Type>
<BODY aLink="#333333" bgColor="<? echo $bgColor; ?>" link="#333333" text="#000000" vLink="#333333">

 <? }
    
 
