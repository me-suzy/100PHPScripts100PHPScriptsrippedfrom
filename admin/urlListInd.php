<?php require_once('Connections/dbConnect.php'); ?>
<?php
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($HTTP_GET_VARS['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $HTTP_GET_VARS['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "1";
if (isset($HTTP_GET_VARS['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['id'] : addslashes($HTTP_GET_VARS['id']);
}
mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = sprintf("SELECT * FROM url_table WHERE userid = %s", $colname_Recordset1);
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_urlList = mysql_num_rows($Recordset1);

if (isset($HTTP_GET_VARS['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $HTTP_GET_VARS['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
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
    <td width="800"> <table width="100%" border="0" align="center" cellpadding="2">
        <tr> 
          <td width="20%" align="center" valign="top"> <div align="center"> <br>
              <br>
            </div></td>
          <td width="61%" valign="top"> <font color="#CCCCCC">&nbsp; </font>
            <table width="100%" border="0" cellpadding="2" cellspacing="0" class="supermenuNoshadow">
              <tr> 
                <td width="11%" align="left" class="menuheader">url ID</td>
                <td width="65%" align="left" class="menuheader">url</td>
                <td width="12%" align="center" class="menuheader">active?</td>
                <td width="12%" align="center" class="menuheaderAction">action</td>
              </tr>
              <?php do { ?>
              <tr> 
              <?php if ($totalRows_urlList <1) { ?>
                 <td colspan="3" class="smallstatsText"><CENTER>NO URLS LISTED</a></td> 
                 <?php } else { ?>
                 
                 <td align="left" class="smallstatsText"><?php echo $row_Recordset1['id']; ?></td>
                <td align="left" class="smallstatsText"><?php echo $row_Recordset1['website']; ?></td>
                <td align="center" class="smallstatsText"><?php echo $row_Recordset1['active']; ?></td>
                <td align="center"><a href="editUrlind.php?id=<?php echo $row_Recordset1['id']; ?>&return=<?php print $_GET['id'] ?>"><img src="images/edit.gif" width="18" height="18" border="0"></a> 
                  | <a href="deleteUrlind.php?id=<?php echo $row_Recordset1['id']; ?>&return=<?php print $_GET['id'] ?>"><img src="images/delete.gif" width="17" height="16" border="0"></a></td>
             <?php  } ?>
              </tr>
              <?php 
			  $return=$row_Recordset1['userid'];
			  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
            </table>
            <br>
            <a href="editUser.php?id=<?php print $_GET['id']; ?>&return=" class="smallstatsText">&lt;&lt; 
            back to user EDIT</a></TD>
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
mysql_free_result($Recordset1);
?>

