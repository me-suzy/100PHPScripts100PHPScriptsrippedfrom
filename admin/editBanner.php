<?php require_once('Connections/dbConnect.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE banners SET banner=%s, alttext=%s, link=%s, points=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['banner'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['alttext'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['link'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['points'], "int"),
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "mainTemplate.php?option=6";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "1";
if (isset($HTTP_GET_VARS['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['id'] : addslashes($HTTP_GET_VARS['id']);
}
mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = sprintf("SELECT * FROM banners WHERE id = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset2 =  sprintf("SELECT banner_clients.client_name FROM banner_clients where  banner_clients.id = %s", $colname_Recordset1);
$Recordset2 = mysql_query($query_Recordset2, $dbConnect) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
          <td width="61%" valign="top"> <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
              <table width="100%" border="0" cellpadding="2" cellspacing="0" class="supermenuNoshadow">
                <tr> 
                  <td colspan="2" align="left" class="menuheader">edit your selected 
                    banner </td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">client:</td>
                  <td class="smallstatsText"><?php echo $row_Recordset2['client_name']?> <input name="client_id" type="hidden" id="client_id" value="<?php echo $row_Recordset1['client_id']; ?>"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">banner http://</td>
                  <td class="smallstatsText"> <input name="banner" type="text" id="banner" value="<?php echo $row_Recordset1['banner']; ?>" maxlength="254"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">alttext:</td>
                  <td class="smallstatsText"> <input
name="alttext" type="text" id="alttext" value="<?php echo
$row_Recordset1['alttext']; ?>" maxlength="200"></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="smallstatsText">link http://</td>
                  <td class="smallstatsText"><input
name="link" type="text" id="link" value="<?php echo
$row_Recordset1['link']; ?>" maxlength="200"></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="smallstatsText">points:</td>
                  <td class="smallstatsText"> <p> 
                      <input name="points" type="text" id="points" value="<?php echo $row_Recordset1['points']; ?>" maxlength="6">
                      <br>
                    </p></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="smallstatsText">&nbsp;</td>
                  <td class="smallstatsText"><input type="submit" name="Submit" value="update"></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form1">
              <input name="id" type="hidden" value="<?php echo $row_Recordset1['id']; ?>">
            </form>

            <p><font color="#CCCCCC"><span class="smallstatsText"><a href="mainTemplate.php?option=XXXX">&lt;&lt;back 
              to main menu</a></span><br>
              </font></p></TD>
          <td width="19%" valign="top">&nbsp;</TD>
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

mysql_free_result($Recordset2);
?>




