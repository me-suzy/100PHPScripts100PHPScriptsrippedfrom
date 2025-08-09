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

if ((isset($HTTP_GET_VARS['id'])) && ($HTTP_GET_VARS['id'] != "") && (isset($HTTP_POST_VARS['submit']))) {

  $deleteSQL = sprintf("DELETE FROM faq WHERE id=%s",
                       GetSQLValueString($HTTP_GET_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($deleteSQL, $dbConnect) or die(mysql_error());

  $deleteGoTo = "mainTemplate.php?option=9";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rsDelete = "1";
if (isset($HTTP_GET_VARS['id'])) {
  $colname_rsDelete = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['id'] : addslashes($HTTP_GET_VARS['id']);
}
mysql_select_db($database_dbConnect, $dbConnect);
$query_rsDelete = sprintf("SELECT * FROM faq WHERE id = %s", $colname_rsDelete);
$rsDelete = mysql_query($query_rsDelete, $dbConnect) or die(mysql_error());
$row_rsDelete = mysql_fetch_assoc($rsDelete);
$totalRows_rsDelete = mysql_num_rows($rsDelete);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
  <tr> 
    <td colspan="2">About to delete - are you sure??</td>
  </tr>
  <tr> 
    <td width="24%">&nbsp;</td>
    <td width="76%"><?php echo $row_rsDelete['question']; ?></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td><?php echo $row_rsDelete['answer']; ?></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td><p> </p>
      <form name="form1" method="post" action="">
        <input name="submit" type="hidden" value="true">
        <input name="submit2" type="submit" id="submit" value="delete">
      </form>
      <p></p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p><br>
</p>
</body>
</html>
<?php
mysql_free_result($rsDelete);
?>

