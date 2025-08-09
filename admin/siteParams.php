<?php require_once('Connections/dbConnect.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE siteParams SET title=%s, styleSheet=%s, bgColor=%s, headerColor=%s, fontEmph=%s, tableColor=%s, tableColor2=%s, alertColor=%s, sellPoints=%s, signPoints=%s, refPoints=%s, pointInc=%s, banner_img=%s, banner_imgSmall=%s, contact_email=%s, paypal=%s, clickBank=%s, siteUrl=%s, privacy=%s, spam=%s, contact_name=%s, pickType=%s, mainText=%s, emailFooter=%s",
                       GetSQLValueString($HTTP_POST_VARS['title'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['styleSheet'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['bgcolor'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['headerColor'], "text"),
		       GetSQLValueString($HTTP_POST_VARS['fontEmph'], "text"),
		       GetSQLValueString($HTTP_POST_VARS['tableColor'], "text"),
		       GetSQLValueString($HTTP_POST_VARS['tableColor2'], "text"),
		       GetSQLValueString($HTTP_POST_VARS['alertColor'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['sellPoints'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['signpoints'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['refpoints'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['pointinc'], "double"),
                       GetSQLValueString($HTTP_POST_VARS['banner'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['smbanner'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['contactemail'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['paypal'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['clickbank'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['siteurl'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['privacy'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['spam'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['contactname'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['pickType'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['mainhtml'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['emailfooter'], "text"));

  mysql_select_db($database_dbConnect, $dbConnect);
  $Result1 = mysql_query($updateSQL, $dbConnect) or die(mysql_error());

  $updateGoTo = "updateComplete.php";

  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
//  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_dbConnect, $dbConnect);
$query_siteParams = "SELECT * FROM siteParams";
$siteParams = mysql_query($query_siteParams, $dbConnect) or die(mysql_error());
$row_siteParams = mysql_fetch_assoc($siteParams);
$totalRows_siteParams = mysql_num_rows($siteParams);
?>
 
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" class="supermenuNoshadow">
    <tr> 
      <td colspan="2" class="menuheader">change the values of your site parameters</td>
    </tr>
    <tr> 
      <td class="smallstatsText">title of website</td>
      <td class="smallstatsText"> <input name="title" type="text" id="title" value="<?php echo $row_siteParams['title']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">style sheet</td>
      <td class="smallstatsText"><input name="styleSheet" type="text" id="styleSheet" value="<?php echo $row_siteParams['styleSheet']; ?>"></td>
    </tr>
    <tr>
      <td class="smallstatsText">header color</td>
      <td class="smallstatsText"><input name="headerColor" type="text" id="headerColor" value="<?php echo $row_siteParams['headerColor']; ?>"></td>
    </tr>
    <tr> 
      <td class="smallstatsText">emphasized font color</td>
      <td class="smallstatsText"><input name="fontEmph" type="text" id="fontEmph" value="<?php echo $row_siteParams['fontEmph']; ?>"></td>
    </tr>
    <tr> 
      <td class="smallstatsText">default table color</td>
      <td class="smallstatsText"><input name="tableColor" type="text" id="tableColor" value="<?php echo $row_siteParams['tableColor']; ?>"></td>
    </tr>
    <tr> 
      <td class="smallstatsText">table color 2</td>
      <td class="smallstatsText"><input name="tableColor2" type="text" id="tableColor2" value="<?php echo $row_siteParams['tableColor2']; ?>"></td>
    </tr>
    <tr> 
      <td class="smallstatsText">font alert color</td>
      <td class="smallstatsText"><input name="alertColor" type="text" id="alertColor" value="<?php echo $row_siteParams['alertColor']; ?>"></td>
    </tr>
    <tr> 
      <td class="smallstatsText">background color</td>
      <td class="smallstatsText"> <input name="bgcolor" type="text" id="bgcolor" value="<?php echo $row_siteParams['bgColor']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">sell points?</td>
      <td class="smallstatsText"> <select name="sellPoints" id="sellPoints">
          <option value="true" <?php if (!(strcmp("true", $row_siteParams['sellPoints']))) {echo "SELECTED";} ?>>Yes</option>
          <option value="false" <?php if (!(strcmp("false", $row_siteParams['sellPoints']))) {echo "SELECTED";} ?>>No</option>
        </select> </td>
    </tr>
    <tr> 
      <td class="smallstatsText">signup points</td>
      <td class="smallstatsText"><input name="signpoints" type="text" id="signpoints" value="<?php echo $row_siteParams['signPoints']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">points per referal</td>
      <td class="smallstatsText"><input name="refpoints" type="text" id="refpoints" value="<?php echo $row_siteParams['refPoints']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">point increment</td>
      <td class="smallstatsText"><input name="pointinc" type="text" id="pointinc" value="<?php echo $row_siteParams['pointInc']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">standard top banner image</td>
      <td class="smallstatsText"><input name="banner" type="text" id="banner" value="<?php echo $row_siteParams['banner_img']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">PayPal banner image</td>
      <td class="smallstatsText"><input name="smbanner" type="text" id="smbanner" value="<?php echo $row_siteParams['banner_imgSmall']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">contact email</td>
      <td class="smallstatsText"><input name="contactemail" type="text" id="contactemail" value="<?php echo $row_siteParams['contact_email']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">Clickbank account</td>
      <td class="smallstatsText"><input name="clickbank" type="text" id="clickbank" value="<?php echo $row_siteParams['clickBank']; ?>"></td>
    </tr>
    <tr> 
      <td class="smallstatsText">PayPal account</td>
      <td class="smallstatsText"><input name="paypal" type="text" id="paypal" value="<?php echo $row_siteParams['paypal']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">site url</td>
      <td class="smallstatsText"><input name="siteurl" type="text" id="siteurl" value="<?php echo $row_siteParams['siteUrl']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">privacy document</td>
      <td class="smallstatsText"><input name="privacy" type="text" id="privacy" value="<?php echo $row_siteParams['privacy']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">spam document</td>
      <td class="smallstatsText"><input name="spam" type="text" id="spam" value="<?php echo $row_siteParams['spam']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">contact name</td>
      <td class="smallstatsText"><input name="contactname" type="text" id="contactname" value="<?php echo $row_siteParams['contact_name']; ?>"> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">URL display type</td>
      <td class="smallstatsText"> <select name="pickType" id="pickType">
          <option value="randm" <?php if (!(strcmp("randm", $row_siteParams['pickType']))) {echo "SELECTED";} ?>>Random</option>
          <option value="weigh" <?php if (!(strcmp("weigh", $row_siteParams['pickType']))) {echo "SELECTED";} ?>>Weighted</option>
        </select> </td>
    </tr>
    <tr> 
      <td class="smallstatsText">main page html</td>
      <td class="smallstatsText"><textarea name="mainhtml" cols="40" rows="20" id="mainhtml"><?php echo $row_siteParams['mainText']; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td class="smallstatsText">email footer</td>
      <td class="smallstatsText"> <textarea name="emailfooter" cols="40" rows="5" id="emailfooter"><?php echo $row_siteParams['emailFooter']; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td colspan="2" align="center" class="smalltext"><input type="submit" name="Submit" value="update"> 
      </td>
    </tr>
  </table>
  <?php
mysql_free_result($siteParams);
?>
  <input type="hidden" name="MM_update" value="form1">
</form>
