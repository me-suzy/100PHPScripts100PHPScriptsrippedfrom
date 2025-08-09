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
  $deleteSQL = sprintf("DELETE FROM rightBlock WHERE id=%s",
                       GetSQLValueString($HTTP_GET_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($deleteSQL, $dbConnect) or die(mysql_error());

  $deleteGoTo = "mainTemplate.php?option=8";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p>Are you sure you want to delete this block?</p>
<form name="form1" method="post" action=""><input name="submit" type="hidden" value="true">
  <input type="submit" name="Submit" value="yes, delete">
</form>
<p>&nbsp; </p>
</body>
</html>
