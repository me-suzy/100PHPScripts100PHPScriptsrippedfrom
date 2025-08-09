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
  $updateSQL = sprintf("UPDATE faq SET answer=%s , question=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['answer'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['question'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['id'], "text"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "updateComplete.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE faq SET question=%s, answer=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['question'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['answer'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['id'], "text"));
  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "mainTemplate.php?option=9";
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
$query_Recordset1 = sprintf("SELECT * FROM faq WHERE id = %s", $colname_Recordset1);
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
                    FAQ</td>
                </tr>
                <tr> 
                  <td align="right" class="smallstatsText">QUESTION:</td>
                  <td class="smallstatsText"><input name="question" type="text" id="question" value="<?php echo $row_Recordset1['question']; ?>" size="40"></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="smallstatsText"><br>
                    Answer:</td>
                  <td class="smallstatsText"><p><br>
                      <br>
                      <textarea name="answer" cols="80" rows="10" id="answer"><?php echo $row_Recordset1['answer']; ?></textarea>
                    </p>
                    <p> 
                      <input type="submit" name="Submit" value="update">
                      <br>
                    </p></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form1">
              <input name="id" type="hidden" id="id" value="<?php echo $row_Recordset1['id']; ?>">
            </form>
<?php
mysql_free_result($Recordset1);
?>
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



