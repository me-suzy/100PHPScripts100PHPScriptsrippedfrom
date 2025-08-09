<?php 
ob_start();
require_once('Connections/dbConnect.php'); ?>
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
  $updateSQL = sprintf("UPDATE rightBlock SET position=%s, active=%s, title=%s, body=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['select'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['select2'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['textfield'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['textarea'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['hiddenField'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "mainTemplate.php?option=8";
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
$query_Recordset1 = sprintf("SELECT * FROM rightBlock WHERE id = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <?php $HTTP_POST_VARS[id]; ?>
  <p> 
    <input name="hiddenField" type="hidden" value="<?php echo $row_Recordset1['id']; ?>">
  </p>
             
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="supermenuNoshadow">
                <tr align="left" class="smallstatsText"> 
                  <td colspan="2" valign="top" class="menuheader">Edit Current 
                    block</td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">Block Position: </td>
                  <td valign="top"> <select name="select">
                      <option value="l" <?php if (!(strcmp("l", $row_Recordset1['position']))) {echo "SELECTED";} ?>>left</option>
                      <option value="r" <?php if (!(strcmp("r", $row_Recordset1['position']))) {echo "SELECTED";} ?>>right</option>
                      <?php
do {  
?>
                      <!--    <option value="<?php echo $row_Recordset1['position']?>"<?php if (!(strcmp($row_Recordset1['position'], $row_Recordset1['position']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['position']?></option>-->
                      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                    </select> </td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">Block Title: </td>
                  <td valign="top"> <input name="textfield" type="text" value="<?php echo $row_Recordset1['title']; ?>"> 
                  </td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">Block Text:</td>
                  <td valign="top"> <textarea name="textarea" cols="75" rows="10"><?php echo $row_Recordset1['body']; ?></textarea> 
                  </td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">Active?</td>
                  <td valign="top"> <select name="select2">
                      <option value="y" <?php if (!(strcmp("y", $row_Recordset1['active']))) {echo "SELECTED";} ?>>Yes</option>
                      <option value="n" <?php if (!(strcmp("n", $row_Recordset1['active']))) {echo "SELECTED";} ?>>No</option>
                      <?php
do {  
?>
                      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                    </select> </td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">&nbsp;</td>
                  <td valign="top"> <input type="submit" name="Submit" value="update"> 
                  </td>
                </tr>
              </table>
              <p> 
                <input type="hidden" name="MM_update" value="form1">
              </p>
  </form>
<?php
mysql_free_result($Recordset1);
?>
           
            <span class="smallstatsText"><a href="mainTemplate.php?option=XXXX">&lt;&lt;back 
            to main menu</a></span><br>
            </font></TD>
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
mysql_free_result($menuItems);
?>


