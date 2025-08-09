<?
// BANNER AD MODULE

?>
<table class="supermenuNoshadow" cellpadding="2" cellspacing="0" width="443">
  <TR>
    <td class="menuheader" colspan="3">Banner Ads at <B><? echo $title; ?></b> are a great way to 
      get a LOT of exposure for your site in a very short time. </td>
  </tr>
  <tr>
    <td colspan="3">Purchase your banner space and email the link to the banner 
      and the link you want followed when the user clicks on your banner: <a href="mailto: <? echo $contact_email; ?>"><? echo $contact_email; ?></a> 
    </td>
  </tr>
  <tr>
    <td width="270">50,000+ Banner Views (one month)</td>
    <td width="72">$25.95</td>
    <td width="102"> <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="<? echo $paypal; ?>">
        <input type="hidden" name="item_name" value="Banner (50,000) for <? echo $username; ?>">
        <input type="hidden" name="item_number" value="xchange<? echo $username ?>">
        <input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
        <input type="hidden" name="cs" value="1">
        <input type="hidden" name="amount" value="25.95">
        <input type="image" src="http://images.paypal.com/images/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
      </form></td>
  </tr>
  <tr>
    <td>100,000+ Banner Displays (3 months)</td>
    <td>$49.95</td>
    <td> <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="<? echo $paypal; ?>">
        <input type="hidden" name="item_name" value="Banner (100,000) for <? echo $username; ?>">
        <input type="hidden" name="item_number" value="xchange<? echo $username ?>">
        <input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
        <input type="hidden" name="cs" value="1">
        <input type="hidden" name="amount" value="49.95">
        <input type="image" src="http://images.paypal.com/images/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
      </form></td>
  </tr>
</table>
