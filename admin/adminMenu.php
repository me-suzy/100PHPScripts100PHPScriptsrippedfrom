<?php
$maxRows_adminMenu = 20;
$pageNum_adminMenu = 0;
if (isset($HTTP_GET_VARS['pageNum_adminMenu'])) {
  $pageNum_adminMenu = $HTTP_GET_VARS['pageNum_adminMenu'];
}
$startRow_adminMenu = $pageNum_adminMenu * $maxRows_adminMenu;

mysql_select_db($database_dbConnect, $dbConnect);
$query_adminMenu = "SELECT * from adminMenu where active='y'";
$query_limit_adminMenu = sprintf("%s LIMIT %d, %d", $query_adminMenu, $startRow_adminMenu, $maxRows_adminMenu);
$adminMenu = mysql_query($query_limit_adminMenu, $dbConnect) or die(mysql_error());
$row_adminMenu = mysql_fetch_assoc($adminMenu);

if (isset($HTTP_GET_VARS['totalRows_adminMenu'])) {
  $totalRows_adminMenu = $HTTP_GET_VARS['totalRows_adminMenu'];
} else {
  $all_adminMenu = mysql_query($query_adminMenu);
  $totalRows_adminMenu = mysql_num_rows($all_adminMenu);
}
$totalPages_adminMenu = ceil($totalRows_adminMenu/$maxRows_adminMenu)-1;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow" >
  <tr align="left"> 
    <td colspan="2" class="menuheader">administration menu</td>
  </tr>
  <?php do { ?>
  <tr> 
    <td width="39%" align="center" class="smallstatsText">&nbsp;</td>
    <td width="61%" align="left" class="smallstatsText"><a href="mainTemplate.php?option=<?php echo $row_adminMenu['id']; ?>"><?php echo $row_adminMenu['text']; ?></a></td>
  </tr>
  <?php } while ($row_adminMenu = mysql_fetch_assoc($adminMenu)); ?>
  <TR><TD width="39%" align="center" class="smallstatsText">&nbsp;</TD>
   <td width="61%" align="left" class="smallstatsText"><a href="logout.php">LOGOUT</a></td>
 </TR>
</table>
<?php
mysql_free_result($adminMenu);
?>

