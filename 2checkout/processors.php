<?php
# FILE: processors.php
# COPYRIGHT: PHPSelect.Com
# ----
# Description: This file contains the function used to post
# transactions 2Checkout.

################################################################
# You MUST set the following variable before using the script  #
################################################################

# $merchant2cuser is your merchant ID for 2Checkout. 

$merchant2cuser = "test";

################################################################
# End of configuration - No need to edit below this line       #
################################################################

#Process a transaction via 2Checkout
#Returns: None. Transaction status will be posted to 
#2checkout_ipn.php by 2Checkout.

function twocheckout($amount, $invoice=0){

  global $_SERVER, $merchant2cuser;

  $target = "https://www.2checkout.com/cgi-bin/sbuyers/cartpurchase.2c?";
  $amount = sprintf("%.02f", $amount);

  if(!$invoice)
    $invoice = sprintf("%06d", rand(111111, 999999));

  $params = "sid=$merchant2cuser&total=$amount&cart_order_id=$invoice";

  $params = str_replace(" ", "%20", $params);

  header("Location: $target$params");

}

?>