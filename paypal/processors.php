<?php
# FILE: processors.php
# Description: This file contains the functions used to post
# transactions to PayPal.

################################################################
# You MUST set the following variables before using the script #
################################################################

# $merchantppuser is your merchant ID for PayPal. You should 
# set this to the email address corresponding to your PayPal
# account. 

$merchantppuser = "paypal@example.com";

# Here you should set $merchantppyes to the URL you
# want users to return to on your site after they make a payment.
# PayPal will forward them back to this URL on your site. 

$merchantppyes = "http://example.com/thankyou.html";

# Here you should set $merchantppno to the URL you
# want users to return to on your site if they cancel a payment.
# PayPal will forward them back to this URL on your site. 

$merchantppno = "http://example.com/sorry.html";


################################################################
# End of configuration - No need to edit below this line       #
################################################################

#Process a transaction via PayPal
#Returns: None. Transaction status will be posted to 
#paypal_ipn.php by PayPal.

function paypal($amount, $description=0, $invoice=0){

  global $_SERVER, $merchantppuser, $merchantppyes, $merchantppno;

  $target = "https://www.paypal.com/xclick";
  $amount = sprintf("%.02f", $amount);

  if(!$description)
    $description = "Online Services: $amount";

  if(!$invoice)
    $invoice = sprintf("%06d", rand(111111, 999999));

  $params="business=$merchantppuser&item_name=$description&item_number=$invoice&amount=$amount&return=$merchantppyes&cancel_return=$merchantppno";

  $params = str_replace(" ", "%20", $params);

  header("Location: $target/$params");

}

?>
