<?php require_once('Connections/dbConnect.php'); ?>
<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_bannerList = 10;
$pageNum_bannerList = 0;
if (isset($HTTP_GET_VARS['pageNum_bannerList'])) {
  $pageNum_bannerList = $HTTP_GET_VARS['pageNum_bannerList'];
}
$startRow_bannerList = $pageNum_bannerList * $maxRows_bannerList;

mysql_select_db($database_dbConnect, $dbConnect);
$query_bannerList = "SELECT banners.*,  banner_clients.client_name FROM banner_clients INNER JOIN banners on banner_clients.id = banners.client_id";
$query_limit_bannerList = sprintf("%s LIMIT %d, %d", $query_bannerList, $startRow_bannerList, $maxRows_bannerList);
$bannerList = mysql_query($query_limit_bannerList, $dbConnect) or die(mysql_error());
$row_bannerList = mysql_fetch_assoc($bannerList);

if (isset($HTTP_GET_VARS['totalRows_bannerList'])) {
  $totalRows_bannerList = $HTTP_GET_VARS['totalRows_bannerList'];
} else {
  $all_bannerList = mysql_query($query_bannerList);
  $totalRows_bannerList = mysql_num_rows($all_bannerList);
}
$totalPages_bannerList = ceil($totalRows_bannerList/$maxRows_bannerList)-1;

$queryString_bannerList = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_bannerList") == false && 
        stristr($param, "totalRows_bannerList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_bannerList = "&" . implode("&", $newParams);
  }
}
$queryString_bannerList = sprintf("&totalRows_bannerList=%d%s", $totalRows_bannerList, $queryString_bannerList);
?>
<span class="smallstatsText">Records <?php echo ($startRow_bannerList + 1) ?> to <?php echo min($startRow_bannerList + $maxRows_bannerList, $totalRows_bannerList) ?> of <?php echo $totalRows_bannerList ?> </span><br>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
  <tr> 
    <td width="23%" class="menuheader">client</td>
    <td width="19%" class="menuheader">banner</td>
    <td width="11%" align="center" class="menuheader">points</td>
    <td width="13%" align="center" class="menuheaderAction">action</td>
  </tr>
  <?php do { ?>
  <tr> 
    <td class="smallstatsText"><?php echo $row_bannerList['client_name']; ?></td>
    <td class="smallstatsText"><?php echo $row_bannerList['banner']; ?></td>
    <td align="center" class="smallstatsText"><?php echo $row_bannerList['points']; ?></td>
    <td align="center" class="smalltext"><a href="editBanner.php?id=<?php echo $row_bannerList['id']; ?>"><img src="images/edit.gif" width="18" height="18" border="0"></a>| 
      <a href="deleteBanner.php?id=<?php echo $row_bannerList['id']; ?>"><img src="images/delete.gif" width="17" height="16" border="0"></a> 
    </td>
  </tr>
  <?php } while ($row_bannerList = mysql_fetch_assoc($bannerList)); ?>
  <tr align="right"> 
    <td colspan="4" ><a href="addBanner.php?id=<?php echo $row_bannerList['client_id']; ?>">add 
      new</a></td>
  </tr>
  <tr align="center"> 
    <td colspan="4" ><a href="<?php printf("%s?pageNum_bannerList=%d%s", $currentPage, 0, $queryString_bannerList); ?>"><img src="images/first.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_bannerList=%d%s", $currentPage, max(0, $pageNum_bannerList - 1), $queryString_bannerList); ?>"><img src="images/prev.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_bannerList=%d%s", $currentPage, min($totalPages_bannerList, $pageNum_bannerList + 1), $queryString_bannerList); ?>"><img src="images/next.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_bannerList=%d%s", $currentPage, $totalPages_bannerList, $queryString_bannerList); ?>"><img src="images/last.gif" width="30" height="11" border="0"></a></td>
  </tr>
</table>
<?php
mysql_free_result($bannerList);
?>
