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

if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO faq (question, answer) VALUES (%s, %s)",
                       GetSQLValueString($HTTP_POST_VARS['textfield'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['textarea'], "text"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($insertSQL, $dbConnect) or die(mysql_error());

  $insertGoTo = "mainTemplate.php?option=9";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
          <td width="61%" valign="top"> <font color="#CCCCCC"> 
            
            <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
              <table width="100%" border="0" cellpadding="4" cellspacing="0" class="supermenuNoshadow">
                <tr align="left" class="smallstatsText"> 
                  <td colspan="2" valign="top" class="menuheader">ADD 
                    FAQ</td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">QUESTION:</td>
                  <td valign="top"> <input name="textfield" type="text"></td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">ANSWER:</td>
                  <td valign="top"> <textarea name="textarea" cols="75" rows="10"></textarea> 
                  </td>
                </tr>
                <tr class="smallstatsText"> 
                  <td align="right" valign="top">&nbsp;</td>
                  <td valign="top"> <input type="submit" name="Submit" value="add"> 
                  </td>
                </tr>
              </table>
              <p> 
                <input type="hidden" name="MM_update" value="form1">
              </p>
              <input type="hidden" name="MM_insert" value="form1">
            </form>
           
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



