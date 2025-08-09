<?
session_start();
require 'include.inc';
if (!isset($_SESSION['letmein'])){
	header ("Location: index.php?invalid=PLEASE LOGIN");
				  }


?>
<SCRIPT language=JavaScript type=text/javascript>
  <!--
  if(window != window.top)
  {
  	top.location.href=location.href;
  }
  // -->
  </SCRIPT>
<?php 

$option=$_GET['option']; 
//$userid=$_GET['userid'];
//$id=$_GET['id'];
?>

<? pageHeader($title, $bgColor, $styleSheet); ?>
<body>
<table bgcolor="<? echo $tableColor; ?>" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="800"> 
      <!---  top menu --->
      <TABLE bgColor="<? echo $tableColor; ?>" border="0" cellPadding="0" cellSpacing="0" width="800">
        <TBODY>
          <TR> 
            <TD bgColor="<? echo $tableColor; ?>" width="75"></TD>
            <TD  width="650"><IMG border="0" height="72" src="images/<? echo $banner_img; ?>" width="650" alt="<? echo $title; ?>"></TD>
            <TD bgColor="<? echo $tableColor; ?>" width="75">&nbsp;</TD>
          </TR>
          <TR> 
            <TD bgColor="<? echo $tableColor; ?>" width=75></TD>
            <TD align="CENTER" bgColor="<? echo $tableColor; ?>" height=20 vAlign="MIDDLE" width="650"> 
              <P align=left class=pfad><? echo $title; ?> <IMG border=0 height=2 src="images/linie.gif" width="650" alt="--"></P></TD>
            <TD bgColor="<? echo $tableColor; ?>" width=75>&nbsp;</TD>
          </TR>
        </TBODY>
      </TABLE>
      <!---  top menu end --->
    </td>
  </tr>
  <tr> 
    <td width="800"> <table width="100%" border="0" align="center" cellpadding="4">
        <tr> 
          <td width="20%" align="center" valign="top"> 
            <? navigation($id, $headerColor, $tableColor2); ?>
            <br>
            <br>
            <div align="center">
              <? startSurfing($id, $username, $headerColor, $tableColor2); ?>
              <BR>
              <BR>
              <? if ($sellPoints == 'true') { 
              		                 purchasePoints($headerColor, $tableColor2);}
                  ;?>
              <br>
              <a href="http://hop.clickbank.net/?lovinlife/smass" target="_blank"><img src="images/125x125.gif" border="0"></a> 
              <br>
              <br>
            </div></td>
          <td width="61%" valign="top"> 
            <table class="supermenuNoShadow" border=0 cellpadding="2" cellspacing="0" bgcolor="<? echo $tableColor; ?>">
              <TR> 
                <TD valign="top" bgcolor="<? echo
$tableColor2; ?>" width="645"> 
                  <B>Welcome, <? echo $username; ?></B><BR> <font color="<? echo $alertColor; ?>"><B><? print $option; ?>:</b></font> 
                  <BR> <BR> 
                  <? 
switch ($option) {

		case 'Url Deleted':
	urlDelete($id, $webid);
	personalStats($id, $username);
	break;
		case 'personal stats':
	personalStats($id, $username);
	break;
		case 'personal link':
	personalLink($id, $title, $siteUrl);
	break;
		case "Top25":
	top25();
	break;
	case "purchase banner ads":
	include("ba.php");
	break;
		case "purchase points":
	include("pp.php");
	break;
		case "frequently asked questions":
	faq();
	break;
		case "thank you for purchasing points":
	$bodyFile = "ty.php";
	break;
		
		default:
	mainStats($id,$username);		
	}
 ?>
                  <center>
                  </center></td>
              </tr>
            </table>
          </TD>
          <td width="19%" valign="top"> 

            <? rightBlock($headerColor, $tableColor, $tableColor2); ?>
  
            
          </TD>
        </TR>
      </TABLE>
     
  </tr>
  <tr> 
    <td width="800" align="center"> 
      <? footer("$contact_email"); ?>
    </td>
  </tr>
</table>
</body>
</html>
