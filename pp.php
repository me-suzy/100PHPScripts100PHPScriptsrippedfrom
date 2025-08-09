<?
// PURCHASE POINTS MODULE
session_start();
if (!isset($_SESSION['letmein'])){
	header ("Location: index.php?invalid=PLEASE LOGIN");
	}
$preSale=$siteUrl;
$preSale .="buypoints.php?userid=$id";
$preSale .="&";

?>

<Center>
<table class="supermenuNoshadow" width="387">
  <tr><td colspan=3> 
This is where you can purchase your points.  Why would you want to do that?  Well, maybe you just don't 
have the time to surf to increase your points. <BR><BR> Our prices are very cheap.  When you purchase your points,
your account will be credited as soon as the payment is received.
</td></tr>


		<tr><td>1000 Visitors</td><td>$ 8.00</td><td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal ?>">
<input type="hidden" name="item_name" value="1000 points for <? echo $username; ?>">
<input type="hidden" name="item_number" value="1000">
<input type="hidden" name="amount" value="0.00">
<input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
<input type="hidden" name="return" value="<? echo $siteUrl; ?>buypoints.php?userid=<?php print $id; ?>&amp;points=1000">
<input type="hidden" name="cs" value="1">
<input type="image" src="https://www.paypal.com/images/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form></td></tr>
		
		<tr><td>5000 Visitors</td><td>$ 14.95</td><td>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal ?>">
<input type="hidden" name="item_name" value="5000 points for <? echo $username; ?>">
<input type="hidden" name="item_number" value="5000">
<input type="hidden" name="amount" value="14.95">
<input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
<input type="hidden" name="return" value="<? echo $siteUrl; ?>buypoints.php?userid=<? echo $id; ?>&amp;points=5000">
<input type="hidden" name="cs" value="1">
<input type="image" src="https://www.paypal.com/images/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
</td></tr>
		
		<tr><td>10000 Visitors</td><td>$ 24.95</td><td>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal ?>">
<input type="hidden" name="item_name" value="1000 points for <? echo $username; ?>">
<input type="hidden" name="item_number" value="10000">
<input type="hidden" name="amount" value="24.95">
<input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
<input type="hidden" name="return" value="<? echo $siteUrl; ?>buypoints.php?userid=<? echo $id; ?>&amp;points=10000">
<input type="hidden" name="cs" value="1">
<input type="image" src="https://www.paypal.com/images/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>

</td></tr>
		
		<tr><td>25000 Visitors</td><td>$ 45.00</td><td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal ?>">
<input type="hidden" name="item_name" value="25000 points for <? echo $username; ?>">
<input type="hidden" name="item_number" value="25000">
<input type="hidden" name="amount" value="45.00">
<input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
<input type="hidden" name="return" value="<? echo $siteUrl; ?>buypoints.php?userid=<? echo $id; ?>&amp;points=25000">
<input type="hidden" name="cs" value="1">
<input type="image" src="https://www.paypal.com/images/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
</td></tr>
		
		<tr><td>50000 Visitors</td><td>$ 60.00</td><td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal ?>">
<input type="hidden" name="item_name" value="50000 points for <? echo $username; ?>">
<input type="hidden" name="item_number" value="50000">
<input type="hidden" name="amount" value="60.00">
<input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
<input type="hidden" name="return" value="<? echo $siteUrl; ?>buypoints.php?userid=<? echo $id; ?>&amp;points=50000">
<input type="hidden" name="cs" value="1">
<input type="image" src="https://www.paypal.com/images/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
</td></tr>
		
		<tr><td>75000 Visitors</td><td>$ 80.00</td><td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal ?>">
<input type="hidden" name="item_name" value="75000 points for <? echo $username; ?>">
<input type="hidden" name="item_number" value="75000">
<input type="hidden" name="amount" value="80.00">
<input type="hidden" name="image_url" value="<? echo $siteUrl; ?>images/<? echo $banner_imgSmall; ?>">
<input type="hidden" name="return" value="<? echo $siteUrl; ?>buypoints.php?userid=<? echo $id; ?>&amp;points=75000">
<input type="hidden" name="cs" value="1">
<input type="image" src="https://www.paypal.com/images/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
</td></tr>
		
		</table>
</center>
<BR><center>
Not a paypal member? Click on the banner below and then click the link that says <B>Sign up for 
your FREE PayPal Account</b><BR>	
<!-- Begin PayPal Logo -->
<A HREF="https://www.paypal.com/affil/pal=goargos_2000%40yahoo.com" target="_blank"><IMG SRC="http://images.paypal.com/images/lgo/logo1.gif" BORDER="0" ALT="I accept payment through PayPal!, the #1 online payment service!"></A>
<!-- End PayPal Logo -->
</center>

                        <BR>
                        Because of variations in traffic patterns, the rate that your hits are delivered will vary. We will make every effort to deliver your hits in a reasonable time. 