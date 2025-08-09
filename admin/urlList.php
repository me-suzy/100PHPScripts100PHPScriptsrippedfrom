<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_urlList = 10;
$pageNum_urlList = 0;
if (isset($HTTP_GET_VARS['pageNum_urlList'])) {
  $pageNum_urlList = $HTTP_GET_VARS['pageNum_urlList'];
}
$startRow_urlList = $pageNum_urlList * $maxRows_urlList;

mysql_select_db($database_dbConnect, $dbConnect);
$query_urlList = "SELECT user.username, url_table.id,url_table.userid, url_table.website, url_table.active FROM user INNER JOIN url_table ON user.id = url_table.userid ORDER BY id";
$query_limit_urlList = sprintf("%s LIMIT %d, %d", $query_urlList, $startRow_urlList, $maxRows_urlList);
$urlList = mysql_query($query_limit_urlList, $dbConnect) or die(mysql_error());
$row_urlList = mysql_fetch_assoc($urlList);

if (isset($HTTP_GET_VARS['totalRows_urlList'])) {
  $totalRows_urlList = $HTTP_GET_VARS['totalRows_urlList'];
} else {
  $all_urlList = mysql_query($query_urlList);
  $totalRows_urlList = mysql_num_rows($all_urlList);
}
$totalPages_urlList = ceil($totalRows_urlList/$maxRows_urlList)-1;

$queryString_urlList = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_urlList") == false && 
        stristr($param, "totalRows_urlList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_urlList = "&" . implode("&", $newParams);
  }
}
$queryString_urlList = sprintf("&totalRows_urlList=%d%s", $totalRows_urlList, $queryString_urlList);
?>
<span class="smallstatsText">Records <?php echo ($startRow_urlList + 1) ?> to <?php echo min($startRow_urlList + $maxRows_urlList, $totalRows_urlList) ?> of <?php echo $totalRows_urlList ?> </span><br>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
  <tr>
    <td width="7%" class="menuheader">url number</td>
    <td width="16%" class="menuheader">username</td>
    <td width="40%" align="left" class="menuheader">website</td>
    <td width="15%" align="center" class="menuheader">active?</td>
    <td width="22%" align="center" class="menuheaderAction">action</td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="smallstatsText"><?php echo $row_urlList['id']; ?></td>
    <td class="smallstatsText"><?php echo $row_urlList['username']; ?></td>
    <td align="left" class="smallstatsText"><?php echo substr($row_urlList['website'],0,30); ?>...</td>
    <td align="center" class="smallstatsText"><?php echo $row_urlList['active']; ?></td>
    <td align="center" class="smalltext">
	<a href="editUrl.php?id=<?php echo $row_urlList['id']; ?>&option=<?php echo $option; ?>&<?php printf("pageNum_urlList=%d%s", min($totalPages_urlList, $pageNum_urlList), $queryString_urlList); ?>"><img src="images/edit.gif" width="18" height="18" border="0"></a>| 
    <a href="deleteUrl.php?id=<?php echo $row_urlList['id']; ?>&option=<?php echo $option; ?>&<?php printf("pageNum_urlList=%d%s", min($totalPages_urlList, $pageNum_urlList), $queryString_urlList); ?>"><img src="images/delete.gif" width="17" height="16" border="0"></a> 
    </td>
  </tr>
  <?php } while ($row_urlList = mysql_fetch_assoc($urlList)); ?>
  <tr> 
    <td colspan="5" align="center" ><a href="<?php printf("%s?pageNum_urlList=%d%s", $currentPage, 0, $queryString_urlList); ?>"><img src="images/first.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_urlList=%d%s", $currentPage, max(0, $pageNum_urlList - 1), $queryString_urlList); ?>"><img src="images/prev.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_urlList=%d%s", $currentPage, min($totalPages_urlList, $pageNum_urlList + 1), $queryString_urlList); ?>"><img src="images/next.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_urlList=%d%s", $currentPage, $totalPages_urlList, $queryString_urlList); ?>"><img src="images/last.gif" width="30" height="11" border="0"></a></td>
  </tr>
</table>
<?php
mysql_free_result($urlList);
?>

