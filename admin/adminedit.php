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
  $updateSQL = sprintf("UPDATE user SET fname=%s, lname=%s, username=%s, password=%s, email=%s, acct_type=%s, point_inc=%s, referral=%s, joindate=%s, verified=%s, receiveEmail=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['fname'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['lname'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['username'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['password'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['email'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['acct_type'], "int"),
                       GetSQLValueString($HTTP_POST_VARS['point_inc'], "double"),
                       GetSQLValueString($HTTP_POST_VARS['referral'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['joindate'], "date"),
                       GetSQLValueString($HTTP_POST_VARS['verified'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['receiveEmail'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['id2'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "ulist.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = "select * from user where id=fart";
$Recordset1 = mysql_query($query_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_AdminEditRecordset = "1";
if (isset($HTTP_GET_VARS['AlbumID'])) {
  $colname_AdminEditRecordset = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['AlbumID'] : addslashes($HTTP_GET_VARS['AlbumID']);
}
mysql_select_db($database_dbConnect, $dbConnect);
$query_AdminEditRecordset = sprintf("SELECT * FROM user where id=%s", $colname_AdminEditRecordset);
$AdminEditRecordset = mysql_query($query_AdminEditRecordset, $dbConnect) or die(mysql_error());
$row_AdminEditRecordset = mysql_fetch_assoc($AdminEditRecordset);
$totalRows_AdminEditRecordset = mysql_num_rows($AdminEditRecordset);

mysql_select_db($database_dbConnect, $dbConnect);
$query_ArtistRecordset = "select * from user";
$ArtistRecordset = mysql_query($query_ArtistRecordset, $dbConnect) or die(mysql_error());
$row_ArtistRecordset = mysql_fetch_assoc($ArtistRecordset);
$totalRows_ArtistRecordset = mysql_num_rows($ArtistRecordset);
?>
<html>
<head>
<title>edit users</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline"> 
      <td nowrap align="right">Fname:</td>
      <td><input type="text" name="fname" value="<?php echo $row_AdminEditRecordset['fname']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Lname:</td>
      <td><input type="text" name="lname" value="<?php echo $row_AdminEditRecordset['lname']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Id:</td>
      <td> <select name="id2">
          <?php 
do {  
?>
          <option value="<?php echo $row_ArtistRecordset['id']?>" <?php if (!(strcmp($row_ArtistRecordset['id'], $row_AdminEditRecordset['id']))) {echo "SELECTED";} ?>><?php echo $row_ArtistRecordset['username']?></option>
          <?php
} while ($row_ArtistRecordset = mysql_fetch_assoc($ArtistRecordset));
?>
        </select> </td>
    <tr> 
    <tr valign="baseline"> 
      <td nowrap align="right">Username:</td>
      <td><input type="text" name="username" value="<?php echo $row_AdminEditRecordset['username']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo $row_AdminEditRecordset['password']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo $row_AdminEditRecordset['email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Acct_type:</td>
      <td><input type="text" name="acct_type" value="<?php echo $row_AdminEditRecordset['acct_type']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Point_inc:</td>
      <td><input type="text" name="point_inc" value="<?php echo $row_AdminEditRecordset['point_inc']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Referral:</td>
      <td><input type="text" name="referral" value="<?php echo $row_AdminEditRecordset['referral']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Joindate:</td>
      <td><input type="text" name="joindate" value="<?php echo $row_AdminEditRecordset['joindate']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Verified:</td>
      <td><input type="text" name="verified" value="<?php echo $row_AdminEditRecordset['verified']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">ReceiveEmail:</td>
      <td><input type="text" name="receiveEmail" value="<?php echo $row_AdminEditRecordset['receiveEmail']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update Record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_AdminEditRecordset['id']; ?>">
</form>
<p>&nbsp;</p>
  
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($AdminEditRecordset);

mysql_free_result($ArtistRecordset);
?>

