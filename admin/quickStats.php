<?php
mysql_select_db($database_dbConnect, $dbConnect);
$query_totalUsers = "SELECT * FROM user";
$totalUsers = mysql_query($query_totalUsers, $dbConnect) or die(mysql_error());
$row_totalUsers = mysql_fetch_assoc($totalUsers);
$totalRows_totalUsers = mysql_num_rows($totalUsers);

mysql_select_db($database_dbConnect, $dbConnect);
$query_totalactiveUsers = "SELECT * FROM user where verified='y'";
$totalactiveUsers = mysql_query($query_totalactiveUsers, $dbConnect) or die(mysql_error());
$row_totalactiveUsers = mysql_fetch_assoc($totalactiveUsers);
$totalRows_totalactiveUsers = mysql_num_rows($totalactiveUsers);
?>
<table class="supermenuNoshadow" width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr align="left"> 
    <td colspan="2" class="menuheader">quick stats</td>
  </tr>
  <tr> 
    <td width="50%" align="right" class="smallstatsText">total number of users:</td>
    <td width="54%" class="smallstatsText"><?php echo $totalRows_totalUsers ?> </td>
  </tr>
  <tr> 
    <td align="right" class="smallstatsText">total number of active users:</td>
    <td class="smallstatsText"><?php echo $totalRows_totalactiveUsers ?> </td>
  </tr>
</table>
<?php
mysql_free_result($totalUsers);
mysql_free_result($totalactiveUsers);
?>

