<? 
require 'include.php'; 
pageHeader();
?>
<!-- start main template -->
<table width="800" border="0">
  <tr align="center" valign="top"> 
    <td colspan="3">LOGO</td>
  </tr>
  <tr> 
    <td width="20%" align="left" valign="top"><? loginBlock(); mainMenu(); ?>LEFT BLOCK</td>
    <td width="67%" align="default" valign="top"><?php require_once('ulist.php'); ?>
</td>
    <td width="20%" align="right" valign="top"><? contentBlock(); ?>RIGHT BLOCK</td>
  </tr>
  <tr align="center" valign="bottom"> 
    <td colspan="3"><? footer(); ?>FOOTER</td>
  </tr>
</table>
<!-- end main template -->
</body>
</html>