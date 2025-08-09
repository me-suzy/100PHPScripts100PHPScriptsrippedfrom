<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_faqList = 10;
$pageNum_faqList = 0;
if (isset($HTTP_GET_VARS['pageNum_faqList'])) {
  $pageNum_faqList = $HTTP_GET_VARS['pageNum_faqList'];
}
$startRow_faqList = $pageNum_faqList * $maxRows_faqList;

mysql_select_db($database_dbConnect, $dbConnect);
$query_faqList = "select * from faq";
$query_limit_faqList = sprintf("%s LIMIT %d, %d", $query_faqList, $startRow_faqList, $maxRows_faqList);
$faqList = mysql_query($query_limit_faqList, $dbConnect) or die(mysql_error());
$row_faqList = mysql_fetch_assoc($faqList);

if (isset($HTTP_GET_VARS['totalRows_faqList'])) {
  $totalRows_faqList = $HTTP_GET_VARS['totalRows_faqList'];
} else {
  $all_faqList = mysql_query($query_faqList);
  $totalRows_faqList = mysql_num_rows($all_faqList);
}
$totalPages_faqList = ceil($totalRows_faqList/$maxRows_faqList)-1;

$queryString_faqList = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_faqList") == false && 
        stristr($param, "totalRows_faqList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_faqList = "&" . implode("&", $newParams);
  }
}
$queryString_faqList = sprintf("&totalRows_faqList=%d%s", $totalRows_faqList, $queryString_faqList);
?>
<span class="smallstatsText">Records <?php echo ($startRow_faqList + 1) ?> to <?php echo min($startRow_faqList + $maxRows_faqList, $totalRows_faqList) ?> of <?php echo $totalRows_faqList ?></span> <br>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
  <tr> 
    <td width="45%" class="menuheader">question</td>
    <td width="38%" class="menuheader">answer</td>
    <td width="17%" align="center" class="menuheaderAction">action</td>
  </tr>
  <?php do { ?>
  <tr> 
    <td class="smallstatsText"><?php echo $row_faqList['question']; ?></td>
    <td class="smallstatsText">click 
      edit to view &gt;&gt;</td>
    <td align="center" class="smalltext"> 
      <a href="editFaq.php?id=<?php echo $row_faqList['id']; ?>"><img src="images/edit.gif" width="18" height="18" border="0"></a>| 
      <a href="deleteFaq.php?id=<?php echo $row_faqList['id']; ?>"><img src="images/delete.gif" width="17" height="16" border="0"></a> 
    </td>
  </tr>
  <?php } while ($row_faqList = mysql_fetch_assoc($faqList)); ?>
  <tr align="right"> 
    <td colspan="3" class="smalltext" ><a href="addFaq.php">add new faq</a></td>
  </tr>
  <tr> 
    <td colspan="3" align="center" ><a href="<?php printf("%s?pageNum_faqList=%d%s", $currentPage, 0, $queryString_faqList); ?>"><img src="images/first.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_faqList=%d%s", $currentPage, max(0, $pageNum_faqList - 1), $queryString_faqList); ?>"><img src="images/prev.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_faqList=%d%s", $currentPage, min($totalPages_faqList, $pageNum_faqList + 1), $queryString_faqList); ?>"><img src="images/next.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_faqList=%d%s", $currentPage, $totalPages_faqList, $queryString_faqList); ?>"><img src="images/last.gif" width="30" height="11" border="0"></a></td>
  </tr>
</table>
<?php
mysql_free_result($faqList);
?>

