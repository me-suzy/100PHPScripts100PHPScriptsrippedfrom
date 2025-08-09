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
            <?php require_once('Connections/dbConnect.php'); ?>
<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_bannerClients = 10;
$pageNum_bannerClients = 0;
if (isset($HTTP_GET_VARS['pageNum_bannerClients'])) {
  $pageNum_bannerClients = $HTTP_GET_VARS['pageNum_bannerClients'];
}
$startRow_bannerClients = $pageNum_bannerClients * $maxRows_bannerClients;

mysql_select_db($database_dbConnect, $dbConnect);
$query_bannerClients = "select * from banner_clients";
$query_limit_bannerClients = sprintf("%s LIMIT %d, %d", $query_bannerClients, $startRow_bannerClients, $maxRows_bannerClients);
$bannerClients = mysql_query($query_limit_bannerClients, $dbConnect) or die(mysql_error());
$row_bannerClients = mysql_fetch_assoc($bannerClients);

if (isset($HTTP_GET_VARS['totalRows_bannerClients'])) {
  $totalRows_bannerClients = $HTTP_GET_VARS['totalRows_bannerClients'];
} else {
  $all_bannerClients = mysql_query($query_bannerClients);
  $totalRows_bannerClients = mysql_num_rows($all_bannerClients);
}
$totalPages_bannerClients = ceil($totalRows_bannerClients/$maxRows_bannerClients)-1;

$queryString_bannerClients = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_bannerClients") == false && 
        stristr($param, "totalRows_bannerClients") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_bannerClients = "&" . implode("&", $newParams);
  }
}
$queryString_bannerClients = sprintf("&totalRows_bannerClients=%d%s", $totalRows_bannerClients, $queryString_bannerClients);
?>
<span class="smallstatsText">Records <?php echo ($startRow_bannerClients + 1) ?> to <?php echo min($startRow_bannerClients + $maxRows_bannerClients, $totalRows_bannerClients) ?> of <?php echo $totalRows_bannerClients ?> </span><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="19%" class="menuheader">name</td>
    <td width="46%" class="menuheader">email</td>
    <td width="13%" class="menuheader">phone</td>
    <td width="16%" class="menuheader">join date</td>
    <td width="6%" class="menuheaderAction">action</td>
  </tr>
  <?php do { ?>
  <tr> 
    <td class="smallstatsText"><?php echo $row_bannerClients['client_name']; ?></td>
    <td class="smallstatsText"><?php echo $row_bannerClients['contact_email']; ?></td>
    <td class="smallstatsText"><?php echo $row_bannerClients['contact_phone']; ?></td>
    <td class="smallstatsText"><?php echo $row_bannerClients['date_joined']; ?></td>
    <td class="smalltext">ed</td>
  </tr>
  <?php } while ($row_bannerClients = mysql_fetch_assoc($bannerClients)); ?>
  
  <tr align="center"> 
    <td colspan="5" class="smalltext"><a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, 0, $queryString_bannerClients); ?>">first</a> 
      <a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, max(0, $pageNum_bannerClients - 1), $queryString_bannerClients); ?>">prev</a> 
      <a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, min($totalPages_bannerClients, $pageNum_bannerClients + 1), $queryString_bannerClients); ?>">next</a> 
      <a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, $totalPages_bannerClients, $queryString_bannerClients); ?>">last</a></td>
  </tr>
</table>
<?php
mysql_free_result($bannerClients);
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

