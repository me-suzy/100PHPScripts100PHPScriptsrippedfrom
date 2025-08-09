<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php if (!$HTTP_POST_VARS['submit']) { ?>
<form action="this.php" method="post">
<table width="75%" border="0">
  <tr>
    <td>Name</td>
    <td><input name="name" type="text"></td>
  </tr>
  <tr>
    <td>Comment</td>
    <td><textarea name="comment" cols="" rows=""></textarea></td>
  </tr>
  <tr>
    <td><input name="submit" type="submit" value="Submit"></td>
    <td><input name="Reset" type="reset" value="Reset"></td>
  </tr>
</table>
</form>
<?php } else { ?>
<table width="75%" border="1" cellspacing="5" cellpadding="5">
  <tr> 
    <td width="39%">Name</td>
    <td width="61%"><?php echo $HTTP_POST_VARS['name']; ?></td>
  </tr>
  <tr> 
    <td>Comments</td>
    <td><?php echo $HTTP_POST_VARS['comment']; ?></td>
  </tr>
</table>
<?php } ?>
</body>
</html>