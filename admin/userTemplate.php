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
          <td width="61%" valign="top"> <font color="#CCCCCC"><?php require_once('Connections/dbConnect.php'); ?>
<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_userList = 10;
$pageNum_userList = 0;
if (isset($HTTP_GET_VARS['pageNum_userList'])) {
  $pageNum_userList = $HTTP_GET_VARS['pageNum_userList'];
}
$startRow_userList = $pageNum_userList * $maxRows_userList;

mysql_select_db($database_dbConnect, $dbConnect);
$query_userList = "select * from user";
$query_limit_userList = sprintf("%s LIMIT %d, %d", $query_userList, $startRow_userList, $maxRows_userList);
$userList = mysql_query($query_limit_userList, $dbConnect) or die(mysql_error());
$row_userList = mysql_fetch_assoc($userList);

if (isset($HTTP_GET_VARS['totalRows_userList'])) {
  $totalRows_userList = $HTTP_GET_VARS['totalRows_userList'];
} else {
  $all_userList = mysql_query($query_userList);
  $totalRows_userList = mysql_num_rows($all_userList);
}
$totalPages_userList = ceil($totalRows_userList/$maxRows_userList)-1;

$queryString_userList = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_userList") == false && 
        stristr($param, "totalRows_userList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_userList = "&" . implode("&", $newParams);
  }
}
$queryString_userList = sprintf("&totalRows_userList=%d%s", $totalRows_userList, $queryString_userList);
?>
<span class="smallstatsText">Records <?php echo ($startRow_userList + 1) ?> to <?php echo min($startRow_userList + $maxRows_userList, $totalRows_userList) ?> of <?php echo $totalRows_userList ?> </span><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td class="menuheader"><font color="#CCCCCC">fname</font></td>
                <td class="menuheader"><font color="#CCCCCC">lname</font></td>
                <td class="menuheader">username</td>
                <td class="menuheader">password</td>
                <td align="center" class="menuheader">email</td>
                <td align="center" class="menuheader">email?</td>
                <td align="center" class="menuheader">active?</td>
                <td width="5%" class="menuheaderAction">action</td>
              </tr>
              <?php do { ?>
              <tr> 
                <td class="smallstatsText"><?php echo $row_userList['fname']; ?></td>
                <td class="smallstatsText"><?php echo $row_userList['lname']; ?></td>
                <td class="smallstatsText"><?php echo $row_userList['username']; ?></td>
                <td class="smallstatsText"><?php echo $row_userList['password']; ?></td>
                <td class="smallstatsText"><?php echo $row_userList['email']; ?></td>
                <td align="center" class="smallstatsText"><?php echo $row_userList['receiveEmail']; ?></td>
                <td align="center" class="smallstatsText"><?php echo $row_userList['verified']; ?></td>
                <td class="smalltext">edit 
                  | delete</td>
              </tr>
              <?php } while ($row_userList = mysql_fetch_assoc($userList)); ?>
              <tr> 
                <td colspan="8" align="center" class="smalltext"><a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, 0, $queryString_userList); ?>">first</a> 
                  <a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, max(0, $pageNum_userList - 1), $queryString_userList); ?>">prev</a> 
                  <a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, min($totalPages_userList, $pageNum_userList + 1), $queryString_userList); ?>">next</a> 
                  <a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, $totalPages_userList, $queryString_userList); ?>">last</a></td>
              </tr>
            </table>
<?php
mysql_free_result($userList);
?></font></TD>
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

