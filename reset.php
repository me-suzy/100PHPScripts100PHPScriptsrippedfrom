<?php ob_start(); ?>
	<SCRIPT language=JavaScript type=text/javascript>
  <!--
  if(window != window.top)
  {
  	top.location.href=location.href;
  }
  // -->
  </SCRIPT>
<?php
require 'include.inc';   

 if ($send) {
   
           	
      	  // Grab User Information and Send Email
            
       
       		$sql = "Select username, password from user where email = '$send[email]'";

		$result = mysql_query( $sql );
			if ( $result != false )
				{
			while ( $data = mysql_fetch_assoc( $result ) )
			{
				$username = $data['username'];
				$password = $data['password'];		
				}
			
		//send email
			$myname = $contact_name; 
			$myemail = $contact_email; 


			$message="Here is your login info:<BR><BR>".
			"<B>username: ".$username."</b><BR>".
			"<b>password: ".$password."</b><BR><BR>";
			$subject = $title; 
			$headers .= "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			$headers .= "From: ".$myname." <".$myemail.">\r\n"; 
			$headers .= "To: ".$send[email]." <".$send[email].">\r\n"; 
			$headers .= "Reply-To: ".$myname." <$myreplyemail>\r\n"; 
			$headers .= "X-Priority: 1\r\n"; 
			$headers .= "X-MSMail-Priority: High\r\n"; 
			$headers .= "X-Mailer: Just My Server"; 
	
			mail($contactemail, $subject, $message, $headers);
			
			} else {
				echo mysql_error();
			}	
							
	//$updateGoTo="reg.php?sent";
	$updateGoTo="resetFollow.php";		
	//include("reg.php?sent");
	header(sprintf("Location: %s", $updateGoTo));
        }
   	
    	
pageHeader($title, $bgColor, $styleSheet);
?><DIV align=left>
<TABLE border="0" cellPadding="0" cellSpacing="0" style="topmargin: 0; leftmargin: 0" width="100%">
  <TBODY>
  <TR>
    <TD height="100%" width="33%">&nbsp;</TD>
    <TD bgColor="#ffffff" vAlign="top" width="800"><A name="#top"></A><!-- TOPTab -->
      <DIV align=left>
      <TABLE bgColor="#ffffff" border="0" cellPadding="0" cellSpacing="0" width="800">
        <TBODY>
        <TR>
          <TD bgColor="#ffffff" width="75"></TD>
          <TD bgColor="#ffffff" width="650"><IMG border="0" height="72" src="images/<? echo $banner_img; ?>" width="650" alt="<? echo $title; ?>"></TD>
          <TD bgColor="#ffffff" width="75">&nbsp;</TD></TR>

        <TR>
          <TD bgColor="#ffffff" width=75></TD>
          <TD align="CENTER" bgColor="#ffffff" height=20 vAlign="MIDDLE" width="650">
            <P align=left class=pfad><? echo $title; ?>
               <IMG border=0 height=2 src="images/linie.gif" width="650" alt="--"></P></TD>
          <TD bgColor="#ffffff" width=75>&nbsp;</TD></TR>

         </TBODY></TABLE></DIV></TD>

    <TD height="100%" width="34%">&nbsp;</TD></TR></TBODY></TABLE></DIV>

<DIV align="left">
<TABLE border="0" cellPadding="0" cellSpacing="0" style="topmargin: 0; leftmargin: 0" width="100%">
  <TBODY>
  <TR>
    <TD height="100%" width="33%">&nbsp;</TD>
    <TD bgColor="#ffffff" vAlign="TOP" width="800">
      <DIV align=left>
      <TABLE bgColor="#ffffff" border=0 cellPadding=0 cellSpacing=1 width=800>
        <TBODY>
        <TR>
          <TD bgColor="#ffffff" colSpan=3 width="800"><!-- enter it -->
            <DIV align=center>
            <TABLE border=0 cellPadding=0 cellSpacing=0 width="750">
              <TBODY>
              <TR>
                <TD align="CENTER" vAlign="top" width="150">
                  
                  
  <DIV align=left>

</DIV><BR>&nbsp;<BR><BR>

                  
                  
                </td>

                <TD align="CENTER" vAlign="TOP" width=500>
                  <DIV align=center>
                  		<table border=0 cellpadding=1 cellspacing=4 width=400>
  		<tbody> 
  <tr> 
    <td align="CENTER" bgcolor="#660000" colspan="2"><font
                        color="#ffffff" face="Arial,Helvetica,Geneva,sans-serif"
                        size="4"><b></b></font></td>
  </tr>

  <tr> 
      <td bgcolor="#ffffff" colspan=2 valign="TOP"><font color="#333333"> You've forgotten your login information? Not a  problem! 
      </font></td>
  </tr>
  <tr> 
    <td bgcolor="#ffffff" colspan=2 valign="TOP"><font color="#333333"> 
 <?
 if (!$send){?>   
    <table><form action="<? echo $PHP_SELF; ?>" method="post">
     <? if ($err_msg) echo "<font color=red size=2>$err_msg</font><br>"; ?>
     <b>Please enter your email address so that we can send you your login information:</b></td><TR>
     <TD><blockquote>email:</blockquote></td><td><blockquote><input type="text" name="send[email]" size="25" value="<? echo ($send[email])?$send[email]:""; ?>"></blockquote>
     </blockquote></td></tr> 
     <TR><td colspan=2>
     <input type="submit" value="send">
     </form>
     </td></tr>
     </table><?
     } else {?>
     <B>Your login information has been sent! Check your email.</B>
     <?}?>
      </font></td>
  </tr>
  <tr> 
    <td align="CENTER" colspan=2 height=20 valign="MIDDLE" > <img border=0 height=2 src="images/linie.gif" width="380" alt="--"></td>
  </tr>
</table>  
                        </DIV>

                       </TD>

                  <TD align="CENTER" vAlign="TOP">
                    
   <DIV align=left>

      </DIV>
      
      <BR>&nbsp;<BR><BR>

		    <p>
		    
  <DIV align=left>

  </DIV><BR>&nbsp;<BR><BR>


                  </TD></TR>
              <!-- row2 -->
              <TR>
                <TD align="CENTER" vAlign="TOP" width=150>&nbsp;</TD>
                <TD align="CENTER" vAlign="TOP" width=500>&nbsp;</TD>
                <TD align="CENTER" vAlign="TOP" width=150>&nbsp;</TD></TR>
              <TR>
                <TD align="CENTER" vAlign="TOP" width=150>&nbsp;</TD>
                <TD align="CENTER" vAlign="TOP" width=500>
                <table width="100%"><tr>
 <? footer("$contact_email"); ?>
                </TD></tr>
                <TD align="CENTER" vAlign="top" width=150>&nbsp;</TD></TR>
                </TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></DIV></TD>
    <TD height="100%"
width="34%">&nbsp;</TD></TR></TBODY></TABLE></DIV>
  
</BODY></HTML>
<?

$signup[username] = "";
?>