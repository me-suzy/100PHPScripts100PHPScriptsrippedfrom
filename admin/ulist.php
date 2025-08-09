<?php require_once('Connections/dbConnect.php'); ?>
<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_users = 10;
$pageNum_users = 0;
if (isset($HTTP_GET_VARS['pageNum_users'])) {
  $pageNum_users = $HTTP_GET_VARS['pageNum_users'];
}
$startRow_users = $pageNum_users * $maxRows_users;

mysql_select_db($database_dbConnect, $dbConnect);
$query_users = "SELECT * FROM `user`";
$query_limit_users = sprintf("%s LIMIT %d, %d", $query_users, $startRow_users, $maxRows_users);
$users = mysql_query($query_limit_users, $dbConnect) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

if (isset($HTTP_GET_VARS['totalRows_users'])) {
  $totalRows_users = $HTTP_GET_VARS['totalRows_users'];
} else {
  $all_users = mysql_query($query_users);
  $totalRows_users = mysql_num_rows($all_users);
}
$totalPages_users = ceil($totalRows_users/$maxRows_users = 10);
$pageNum_users = 0;
if (isset($HTTP_GET_VARS['pageNum_users'])) {
  $pageNum_users = $HTTP_GET_VARS['pageNum_users'];
}
$startRow_users = $pageNum_users * $maxRows_users;

mysql_select_db($database_dbConnect, $dbConnect);
$query_users = "SELECT * FROM `user`";
$query_limit_users = sprintf("%s LIMIT %d, %d", $query_users, $startRow_users, $maxRows_users);
$users = mysql_query($query_limit_users, $dbConnect) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

if (isset($HTTP_GET_VARS['totalRows_users'])) {
  $totalRows_users = $HTTP_GET_VARS['totalRows_users'];
} else {
  $all_users = mysql_query($query_users);
  $totalRows_users = mysql_num_rows($all_users);
}
$totalPages_users = ceil($totalRows_users/$maxRows_users)-1;

$queryString_users = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_users") == false && 
        stristr($param, "totalRows_users") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_users = "&" . implode("&", $newParams);
  }
}
$queryString_users = sprintf("&totalRows_users=%d%s", $totalRows_users, $queryString_users);
?>
<html>
<head>
<title>test users</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<span class="smalltext">Records <?php echo ($startRow_users + 1) ?> to <?php echo min($startRow_users + $maxRows_users, $totalRows_users) ?> of <?php echo $totalRows_users ?></span> 
<table width="100%" cellpadding="0" cellspacing="0" widtborder="0">
  <tr> 
    <td width="86" align="left" class="menuheader" ><strong>first name</strong></td>
    <td width="85" align="left" class="menuheader" ><strong>last name</strong></td>
    <td width="107" align="left" class="menuheader" ><strong>username</strong></td>
    <td width="109" align="left" class="menuheader" ><strong>password</strong></td>
    <td width="81" align="left" class="menuheader" ><strong>email</strong></td>
    <td width="105" align="center" class="menuheader" ><strong>point inc.</strong></td>
    <td width="94" align="center" class="menuheader" ><strong>active?</strong></td>
    <td width="126" align="center" class="menuheader" ><strong>receive email?</strong></td>
    <td width="96" align="center" class="menuheaderAction" ><strong>action</strong></td>
  </tr>
  <?php do { ?>
  <tr> 
    <td height="21" class="menuheaderCopy"  ><font><?php echo $row_users['fname']; ?></font></td>
    <td class="menuheaderCopy"  ><?php echo $row_users['lname']; ?></td>
    <td class="menuheaderCopy"  ><?php echo $row_users['username']; ?></td>
    <td class="menuheaderCopy"  ><?php echo $row_users['password']; ?></td>
    <td class="menuheaderCopy"  ><?php echo $row_users['email']; ?></td>
    <td align="center" class="menuheaderCopy"  ><?php echo $row_users['point_inc']; ?></td>
    <td align="center" class="menuheaderCopy"  ><?php echo $row_users['verified']; ?></td>
    <td align="center"  ><?php echo $row_users['receiveEmail']; ?></td>
    <td align="center" ><a href="adminedit.php" class="smalltext">edit</a>|<a href="adminedit.php" class="smalltext">delete</a></td>
  </tr>
  <tr> 
    <td height="21" colspan="9" class="menuheaderCopy"  >&nbsp;</td>
  </tr>
  <?php } while ($row_users = mysql_fetch_assoc($users)); ?>
  <TR> 
    <TD colspan="10"><table border="0" width="29%" align="center">
        <tr class="smalltext"> 
          <td width="23%" align="center"> <?php if ($pageNum_users > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_users=%d%s", $currentPage, 0, $queryString_users); ?>">First</a> 
            <?php } // Show if not first page ?> </td>
          <td width="31%" align="center"> <?php if ($pageNum_users > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_users=%d%s", $currentPage, max(0, $pageNum_users - 1), $queryString_users); ?>">Previous</a> 
            <?php } // Show if not first page ?> </td>
          <td width="23%" align="center"> <?php if ($pageNum_users < $totalPages_users) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_users=%d%s", $currentPage, min($totalPages_users, $pageNum_users + 1), $queryString_users); ?>">Next</a> 
            <?php } // Show if not last page ?> </td>
          <td width="23%" align="center"> <?php if ($pageNum_users < $totalPages_users) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_users=%d%s", $currentPage, $totalPages_users, $queryString_users); ?>">Last</a> 
            <?php } // Show if not last page ?> </td>
        </tr>
      </table></TD>
  </TR>
</table>


</body>
</html>
<?php
mysql_free_result($users);
?>

