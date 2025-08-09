<?
function loginBlock(){
 ?>
<!-- start login block -->
<table width="100%" border="0">
  <tr> 
    <td colspan="2">MEMBER LOGIN</td>
  </tr>
  <tr> 
    <td width="21%" align="left">USER ID:</td>
    <td width="79%">USERNAMETEXTFIELD</td>
  </tr>
  <tr> 
    <td align="left">PASSWORD:</td>
    <td>PASSWORDTEXTFIELD</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>BUTTON</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>LOST PASSWORD LINK</td>
  </tr>
  <tr align="center"> 
    <td colspan="2">ERROR MESSAGE</td>
  </tr>
</table>
<!-- end login block -->
<? 
}

function surfMenu(){ ?>
<!-- start menu -->
<table width="100%" border="0">
  <tr>
    <td align="left">SURF MENU</td>
  </tr>
  <tr>
    <td align="left">menuItem1</td>
  </tr>
  <tr>
    <td align="left">menuItem2</td>
  </tr>
  <tr>
    <td align="left">menuItem3</td>
  </tr>
  <tr>
    <td align="left">menuItem4</td>
  </tr>
</table>
<!-- end menu -->
<?}

function mainMenu(){ ?>
<!-- start menu -->
<table width="100%" border="0">
  <tr>
    <td align="left">MENU</td>
  </tr>
  <tr>
    <td align="left">menuItem1</td>
  </tr>
  <tr>
    <td align="left">menuItem2</td>
  </tr>
  <tr>
    <td align="left">menuItem3</td>
  </tr>
  <tr>
    <td align="left">menuItem4</td>
  </tr>
</table>
<!-- end menu -->
<?}

function contentBlock(){ ?>
<!-- start block -->
<table width="100%" border="0">
  <tr>
    <td align="center">BLOCK HEADER</td>
  </tr>
  <tr>
    <td align="center" valign="middle">BLOCK BODY</td>
  </tr>
</table>
<!-- end block -->
<?}
function newsBlock(){ ?>
<!-- start center news block -->
<table width="100%" border="0">
  <tr>
    <td>CENTER NEWS BLOCK</td>
  </tr>
</table>
<!-- end center news block -->
<?}

function footer(){ ?>
<!-- start footer -->
<table width="100%" border="0">
  <tr>
    <td align="center">FOOTER HEADER</td>
  </tr>
  <tr>
    <td align="center">FOOTER DETAIL 1 | FOOTER DETAIL 2 | FOOTER DETAIL 3</td>
  </tr>
</table>
<!-- end footer -->
<?}

 function pageHeader() {
      ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
  <title>
   <? echo $title; ?>
  </title>
 </head>
 <body>
 <? }