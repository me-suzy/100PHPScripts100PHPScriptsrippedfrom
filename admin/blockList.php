<?php

$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_blockList = 10;
$pageNum_blockList = 0;
if (isset($HTTP_GET_VARS['pageNum_blockList'])) {
  $pageNum_blockList = $HTTP_GET_VARS['pageNum_blockList'];
}
$startRow_blockList = $pageNum_blockList * $maxRows_blockList;

mysql_select_db($database_dbConnect, $dbConnect);
$query_blockList = "select * from rightBlock";
$query_limit_blockList = sprintf("%s LIMIT %d, %d", $query_blockList, $startRow_blockList, $maxRows_blockList);
$blockList = mysql_query($query_limit_blockList, $dbConnect) or die(mysql_error());
$row_blockList = mysql_fetch_assoc($blockList);

if (isset($HTTP_GET_VARS['totalRows_blockList'])) {
  $totalRows_blockList = $HTTP_GET_VARS['totalRows_blockList'];
} else {
  $all_blockList = mysql_query($query_blockList);
  $totalRows_blockList = mysql_num_rows($all_blockList);
}
$totalPages_blockList = ceil($totalRows_blockList/$maxRows_blockList)-1;

$queryString_blockList = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_blockList") == false && 
        stristr($param, "totalRows_blockList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_blockList = "&" . implode("&", $newParams);
  }
}
$queryString_blockList = sprintf("&totalRows_blockList=%d%s", $totalRows_blockList, $queryString_blockList);
?>
<span class="smallstatsText">Records <?php echo ($startRow_blockList + 1) ?> to <?php echo min($startRow_blockList + $maxRows_blockList, $totalRows_blockList) ?> of <?php echo $totalRows_blockList ?> </span><br>
<table class="supermenuNoshadow" width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td width="21%" class="menuheader">title</td>
    <td width="5%" class="menuheader">position</td>
    <td width="5%" class="menuheader">active?</td>
    <td width="5%" align="center" class="menuheaderAction">action</td>
  </tr>
  <?php do { ?>
  <tr class="tdunderline"> 
    <td class="smallstatsText"><?php echo $row_blockList['title']; ?></td>
    <td align="center" class="smallstatsText"><?php echo $row_blockList['position']; ?></td>
    <td align="center" class="smallstatsText"><?php echo $row_blockList['active']; ?></td>
    <td align="center" valign="middle" class="smalltext"><a href="editBlock.php?id=<?php echo $row_blockList['id']; ?>"><img src="images/edit.gif" alt="edit entry" width="18" height="18" border="0"></a> 
      | <a href="deleteBlock.php?id=<?php echo $row_blockList['id']; ?>"><img src="images/delete.gif" alt="delete entry" width="17" height="16" border="0"></a></td>
  </tr>
  <?php } while ($row_blockList = mysql_fetch_assoc($blockList)); ?>
  <tr align="right"> 
    <td colspan="4" class="smallstatsText"><a href="addBlock.php">add new</a> 
    </td>
  </tr>
  <tr align="center"> 
    <td colspan="4" class="smallstatsText"><a href="<?php printf("%s?pageNum_blockList=%d%s", $currentPage, 0, $queryString_blockList); ?>"><img src="images/first.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_blockList=%d%s", $currentPage, max(0, $pageNum_blockList - 1), $queryString_blockList); ?>"><img src="images/prev.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_blockList=%d%s", $currentPage, min($totalPages_blockList, $pageNum_blockList + 1), $queryString_blockList); ?>"><img src="images/next.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_blockList=%d%s", $currentPage, $totalPages_blockList, $queryString_blockList); ?>"><img src="images/last.gif" width="30" height="11" border="0"></a></td>
  </tr>
</table>
<?php
mysql_free_result($blockList);
?>

