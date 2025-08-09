<?php ob_start(); ?>
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
  $updateSQL = sprintf("UPDATE admin SET password=%s WHERE username=%s",
                       GetSQLValueString($HTTP_POST_VARS['textfield2'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['textfield'], "text"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "updateComplete.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = "SELECT * FROM `admin`";
$Recordset1 = mysql_query($query_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
    <tr> 
      <td colspan="2" align="left" class="menuheader">change administration information</td>
    </tr>
    <tr> 
      <td align="right" class="smallstatsText">&nbsp;</td>
      <td class="smallstatsText">&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" class="smallstatsText">username:</td>
      <td class="smallstatsText"><input name="textfield" type="text" value="<?php echo $row_Recordset1['username']; ?>" size="40"></td>
    </tr>
    <tr> 
      <td align="right" class="smallstatsText">password:</td>
      <td class="smallstatsText"><input name="textfield2" type="text" value="<?php echo $row_Recordset1['password']; ?>" size="40"></td>
    </tr>
    <tr> 
      <td class="smallstatsText">&nbsp;</td>
      <td class="smallstatsText"><p> 
          <input type="submit" name="Submit" value="update">
          <br>
        </p></td>
    </tr>
  </table>
  <?php
mysql_free_result($Recordset1);
?>
  <input type="hidden" name="MM_update" value="form1">
</form>
