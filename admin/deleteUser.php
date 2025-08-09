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

if ((isset($HTTP_POST_VARS['delete']))){
  $deleteSQL = sprintf("DELETE FROM user WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($deleteSQL, $dbConnect) or die(mysql_error());
}

if ((isset($HTTP_POST_VARS['delete']))){
  $deleteSQL = sprintf("DELETE FROM points WHERE userid=%s",
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($deleteSQL, $dbConnect) or die(mysql_error());
}

if ((isset($HTTP_POST_VARS['delete']))) {
  $deleteSQL = sprintf("DELETE FROM url_table WHERE userid=%s",
                       GetSQLValueString($HTTP_GET_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($deleteSQL, $dbConnect) or die(mysql_error());
}

if ((isset($HTTP_POST_VARS['delete']))){
  $deleteSQL = sprintf("DELETE FROM url_points WHERE urlid=%s",
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($deleteSQL, $dbConnect) or die(mysql_error());
}

  $deleteGoTo = "mainTemplate.php?option=3&pageNum_userList=". $pageNum_userList. "&totalRows_userList=".$totalRows_userList;
 if ((isset($HTTP_POST_VARS['delete']))){
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "1";
if (isset($HTTP_GET_VARS['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['id'] : addslashes($HTTP_GET_VARS['id']);
}
mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = sprintf("SELECT * FROM `user` WHERE id = %s", $colname_Recordset1);
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
          <td width="61%" valign="top"> <font color="#CCCCCC">&nbsp; </font>
            <table width="100%" border="0" cellpadding="2" cellspacing="0" class="supermenuNoshadow">
              <tr> 
                <td colspan="2" class="menuheader">Are you sure you want to delete 
                  this user: ?</td>
              </tr>
              <tr class="smallstatsText"> 
                <td width="47%">User name:</td>
                <td width="53%"><?php echo $row_Recordset1['username']; ?></td>
              </tr>
              <tr class="smallstatsText"> 
                <td>First Name:</td>
                <td><?php echo $row_Recordset1['fname']; ?></td>
              </tr>
              <tr class="smallstatsText"> 
                <td>Last Name:</td>
                <td><?php echo $row_Recordset1['lname']; ?></td>
              </tr>
              <tr> 
                <td> <a href="mainTemplate.php?id=<?php echo $row_Recordset1['id']; ?>&option=3&pageNum_userList=<?php echo $pageNum_userList; ?>&totalRows_userList=<?php echo $totalRows_userList; ?>" class="smallstatsText">&lt;&lt;NO! 
                  Go back</a> </td>
                <td><form name="form1" method="post" action="">                
                      <input name="delete" type="hidden" value="true"> 
					  <input name="id" type="hidden" value="<?php echo $row_Recordset1['id']; ?>">
					  
                    <input name="submit2" type="submit" id="submit" value="yes, delete">
                     </form></td>
              </tr>
            </table> 
           
            <p>&nbsp;</p>
</TD>
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



