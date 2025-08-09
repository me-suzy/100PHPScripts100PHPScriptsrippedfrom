<?php require_once('Connections/dbConnect.php'); ?>
<?php
mysql_select_db($database_dbConnect, $dbConnect);
$query_Recordset1 = "SELECT fname, email FROM `user` WHERE verified = 'y'";
$Recordset1 = mysql_query($query_Recordset1, $dbConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p>Total number of active emails:<?php echo $totalRows_Recordset1 ?> <br>

  <?php do { echo $row_Recordset1['email']; ?><BR>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</p>
<!---
<p>Total number of active emails:<?php echo $totalRows_Recordset1 ?> <br>
  &quot;[firstname]&quot;,&quot;[email]&quot;<br>
  <?php do { ?>
  &quot;<?php echo $row_Recordset1['fname']; ?>&quot;,&quot;<?php echo $row_Recordset1['email']; ?>&quot;<br>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</p>
--->
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

