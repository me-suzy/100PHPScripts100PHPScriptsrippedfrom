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
$returnUrl="pageNum_userList=".$_GET['pageNum_userList']."&totalRows_userList=".$_GET['totalRows_userList']."&option=3";
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}


if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE user SET fname=%s, lname=%s, username=%s, password=%s, email=%s, point_inc=%s, referral=%s, joindate=%s, verified=%s, receiveEmail=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['fname'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['lname'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['username'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['password'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['email'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['point_inc'], "double"),
                       GetSQLValueString($HTTP_POST_VARS['referral'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['joindate'], "date"),
                       GetSQLValueString($HTTP_POST_VARS['verified'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['receiveEmail'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "mainTemplate.php?".$returnUrl;
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE points SET  points=%s WHERE userid=%s",
                       GetSQLValueString($HTTP_POST_VARS['points'], "double"),
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());
}

// $colname_Recordset1 = "1";
if (isset($HTTP_GET_VARS['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['id'] : addslashes($HTTP_GET_VARS['id']);
}
mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = sprintf("SELECT user.*, points.userid, points.points  FROM user INNER JOIN points ON user.id = points.userid where user.id = %s ", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

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
                    user profile</td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">first Name:</td>
                  <td class="smallstatsText"><input name="fname" type="text" id="fname" value="<?php echo $row_Recordset1['fname']; ?>"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">last name:</td>
                  <td class="smallstatsText"> <input name="lname" type="text" id="lname" value="<?php echo $row_Recordset1['lname']; ?>"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">username:</td>
                  <td class="smallstatsText"> <input name="username" type="text" id="username" value="<?php echo $row_Recordset1['username']; ?>"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">password:</td>
                  <td class="smallstatsText"><input name="password" type="text" id="question2" value="<?php echo $row_Recordset1['password']; ?>" size="0" maxlength="24"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">point inc:</td>
                  <td class="smallstatsText"><input name="point_inc" type="text" id="point_inc" value="<?php echo $row_Recordset1['point_inc']; ?>" maxlength="4"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">referred by:</td>
                  <td class="smallstatsText"> <input name="referral" type="text" id="referral" value="<?php echo $row_Recordset1['referral']; ?>"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">date joined:</td>
                  <td class="smallstatsText"> <input name="joindate" type="text" id="joindate" value="<?php echo $row_Recordset1['joindate']; ?>" maxlength="14"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText"> email:</td>
                  <td class="smallstatsText"> <input name="email" type="text" id="email" value="<?php echo $row_Recordset1['email']; ?>" maxlength="255"></td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">active?:</td>
                  <td class="smallstatsText"> <select name="verified" id="verified">
                      <option value="y" <?php if (!(strcmp("y", $row_Recordset1['verified']))) {echo "SELECTED";} ?>>Yes</option>
                      <option value="n" <?php if (!(strcmp("n", $row_Recordset1['verified']))) {echo "SELECTED";} ?>>No</option>
                    </select></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="smallstatsText">receive 
                    emails?</td>
                  <td class="smallstatsText"><select name="receiveEmail" id="receiveEmail">
                      <option value="y" <?php if (!(strcmp("y", $row_Recordset1['receiveEmail']))) {echo "SELECTED";} ?>>Yes</option>
                      <option value="n" <?php if (!(strcmp("n", $row_Recordset1['receiveEmail']))) {echo "SELECTED";} ?>>No</option>
                    </select></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="smallstatsText">points:</td>
                  <td class="smallstatsText"><input name="points" type="text" id="points" value="<?php echo $row_Recordset1['points']; ?>" maxlength="9"></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="smallstatsText">&nbsp;</td>
                  <td class="smallstatsText"> <p> 
                      <input type="submit" name="Submit" value="update">
                      <font color="#CCCCCC"><span class="smallstatsText"><a href="urlListInd.php?id=<?php print 
$_GET['id']; ?>&return=<?php print $_GET['id']?>"><img src="images/edit.gif" width="18" height="18" border="0">edit 
                      this user's URLS</a></span></font> <br>
                    </p></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form1">
              <input name="id" type="hidden" value="<?php echo $row_Recordset1['id']; ?>">
            </form>

            <p><font color="#CCCCCC"><span class="smallstatsText"><a href="mainTemplate.php?<?php echo  $returnUrl; ?>">&lt;&lt;back 
              to main user list</a><br>
              <a href="mainTemplate.php?option=XXXX">&lt;&lt;back to main menu</a></span><br>
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
?>




