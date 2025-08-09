<?php require_once('Connections/dbConnect.php'); ?>
<?php
mysql_select_db($database_dbConnect, $dbConnect);
$query_menuMember = "SELECT * FROM surfMenu WHERE `section` = 'm'";
$menuMember = mysql_query($query_menuMember, $dbConnect) or die(mysql_error());
$row_menuMember = mysql_fetch_assoc($menuMember);
$totalRows_menuMember = mysql_num_rows($menuMember);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td>menu</td>
  </tr>
  <tr> 
    <td><?php do { ?>
      <a href="<?php echo $row_menuMember['link']; ?>"><?php echo $row_menuMember['text']; ?></a><BR> 
      <?php } while ($row_menuMember = mysql_fetch_assoc($menuMember)); ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($menuMember);
?>

