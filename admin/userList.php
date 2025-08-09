<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_userList = 15;
$pageNum_userList = 0;
if (isset($HTTP_GET_VARS['pageNum_userList'])) {
  $pageNum_userList = $HTTP_GET_VARS['pageNum_userList'];
}
$startRow_userList = $pageNum_userList * $maxRows_userList;

mysql_select_db($database_dbConnect, $dbConnect);
$query_userList = "select * from user order by username";
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
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
  <tr>
    <td width="20%" class="menuheader">user id</td>
    <td width="20%" class="menuheader">username</td>
    <td width="24%" class="menuheader">password</td>
    <td width="29%" align="left" class="menuheader">email</td>
    <td width="14%" align="center" class="menuheader">active?</td>
    <td width="13%" align="center" class="menuheaderAction">action</td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="smallstatsText"><?php echo $row_userList['id']; ?></td>
    <td class="smallstatsText"><?php echo $row_userList['username']; ?></td>
    <td class="smallstatsText"><?php echo $row_userList['password']; ?></td>
    <td class="smallstatsText"><?php echo $row_userList['email']; ?></td>
    <td align="center" class="smallstatsText"><?php echo $row_userList['verified']; ?></td>
    <td align="center"><a href="editUser.php?id=<?php echo $row_userList['id']; ?>&pageNum_userList=<? echo $pageNum_userList; ?>&totalRows_userList=<? echo $totalRows_userList; ?>"><img src="images/edit.gif" width="18" height="18" border="0"></a> 
      | <a href="deleteUser.php?id=<?php echo $row_userList['id']; ?>&pageNum_userList=<? echo $pageNum_userList; ?>&totalRows_userList=<? echo $totalRows_userList; ?>"><img src="images/delete.gif" width="17" height="16" border="0"></a></td>
  </tr>
  <?php } while ($row_userList = mysql_fetch_assoc($userList)); ?>
  <tr> 
    <td height="15" colspan="6" align="center" ><a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, 0, $queryString_userList); ?>"><img src="images/first.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, max(0, $pageNum_userList - 1), $queryString_userList); ?>"><img src="images/prev.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, min($totalPages_userList, $pageNum_userList + 1), $queryString_userList); ?>"><img src="images/next.gif" width="30" height="11" border="0"></a> 
      <a href="<?php printf("%s?pageNum_userList=%d%s", $currentPage, $totalPages_userList, $queryString_userList); ?>"><img src="images/last.gif" width="30" height="11" border="0"></a></td>
  </tr>
</table>
<?php
mysql_free_result($userList);
?>

