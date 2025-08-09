<?php
session_start();
 if (!isset($_SESSION['letmein'])){
	header ("Location: index.php?invalid=PLEASE LOGIN");
				  }
require_once('Connections/dbConnect.php'); 
require_once('../include.inc');
mysql_select_db($database_dbConnect, $dbConnect);
$query_menuItems = "select * from adminMenu where active='y'";
$menuItems = mysql_query($query_menuItems, $dbConnect) or die(mysql_error());
$row_menuItems = mysql_fetch_assoc($menuItems);
$totalRows_menuItems = mysql_num_rows($menuItems);
?>

<html>
 <head>
  <title>
   Hitjammer 1.0  </title>
 
<link href="default.css" rel="stylesheet" type="text/css">
</head>

<META content="text/html; charset=windows-1252" http-equiv=Content-Type>

 
<body bgcolor="#000000">
<table bgcolor="WHITE" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="800"> 
      <!---  top menu --->
      <TABLE bgColor="WHITE" border="0" cellPadding="0" cellSpacing="0" width="800">
        <TBODY>
          <TR> 
            <TD bgColor="WHITE" width="75"></TD>
            <TD  width="650"><IMG border="0" height="72" src="images/logo.gif" width="650" alt="Hitjammer 1.0"></TD>
            <TD bgColor="WHITE" width="75">&nbsp;</TD>
          </TR>
          <TR> 
            <TD bgColor="WHITE" width=75></TD>
            <TD align="CENTER" bgColor="WHITE" height=20 vAlign="MIDDLE" width="650"> 
              <P align=left ><span class="smallstatsText">Hitjammer 1.0 </span><IMG border=0 height=2 src="images/linie.gif" width="650" alt="--"></P></TD>
            <TD bgColor="WHITE" width=75>&nbsp;</TD>
          </TR>
        </TBODY>
      </TABLE>
      <!---  top menu end --->
    </td>
  </tr>
  <tr> 
    <td width="800"> <table width="100%" border="0" align="center" cellpadding="4">
        <tr> 
          <td width="20%" align="center" valign="top"> <div align="center"> <br>
              <br>
            </div></td>
          <td width="61%" valign="top"> <font color="#CCCCCC"> 
            <?php do { 
			$Zoption=$row_menuItems['id'];
			$Zfile = $row_menuItems['adminFile'];
			
			switch ($option){
			case $Zoption:
			require_once($Zfile);
			break;
			//default:
		     //require_once('adminMenu.php');
			case XXXX:
		     require_once('adminMenu.php');
			 break;
			}
} while ($row_menuItems = mysql_fetch_assoc($menuItems)); ?> 
           
            <span class="smallstatsText"><a href="mainTemplate.php?option=XXXX">&lt;&lt;back 
            to main menu</a></span><br>
            </font></TD>
          <td width="19%" valign="top">&nbsp; </TD>
        </TR>
      </TABLE>
      <!-- END body area --->
  </tr>
  <tr> 
    <td width="800" align="center"> 
      <table>
<TR>
                  
          <td class="smallstatsText">&copy;2002 <a href="http://www.mishies.com" target="new">Mishies.com</a></td>
</tr>
 </table>
     </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($menuItems);
?>


