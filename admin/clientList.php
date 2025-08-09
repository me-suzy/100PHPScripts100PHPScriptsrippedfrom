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
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
  <tr> 
    <td width="29%" class="menuheader">name</td>
    <td width="52%" class="menuheader">email</td>
    <td width="19%" align="center" class="menuheaderAction">action</td>
  </tr>
  <?php do { ?>
  <tr> 
    <td class="smallstatsText"><?php echo $row_bannerClients['client_name']; ?></td>
    <td class="smallstatsText"><?php echo $row_bannerClients['contact_email']; ?></td>
    <td align="center" class="smalltext"><a href="editClient.php?id=<?php echo $row_bannerClients['id']; ?>"><img src="images/edit.gif" width="18" height="18" border="0"></a>| 
      <a href="deleteClient.php?id=<?php echo $row_bannerClients['id']; ?>"><img src="images/delete.gif" width="17" height="16" border="0"></a> 
    </td>
  </tr>
  <?php } while ($row_bannerClients = mysql_fetch_assoc($bannerClients)); ?>
  <tr align="right"> 
    <td colspan="3" ><a href="addClient.php">add new</a></td>
  </tr>
  <tr align="center"> 
    <td colspan="3" ><a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, 0, $queryString_bannerClients); ?>"><img src="images/first.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, max(0, $pageNum_bannerClients - 1), $queryString_bannerClients); ?>"><img src="images/prev.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, min($totalPages_bannerClients, $pageNum_bannerClients + 1), $queryString_bannerClients); ?>"><img src="images/next.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_bannerClients=%d%s", $currentPage, $totalPages_bannerClients, $queryString_bannerClients); ?>"><img src="images/last.gif" width="30" height="11" border="0"></a></td>
  </tr>
</table>
<?php
mysql_free_result($bannerClients);
?>

