<?php
# FILE: 2checkout_ipn.php
# COPYRIGHT: PHPSelect.Com
# ----
# Description: This script handles postback notifications from
# 2Checkout's gateway.

################################################################
# After someone makes a 2Checkout payment through your site,   #
# 2Checkout will access this script to instantly notify you    #
# about the status of the transaction.                         #
#                                                              #
# By default, this script will send a "thank you" email to the #
# payer when a 2Checkout transaction is successfully completed.#
# Assuming you want to perform some automatic functions when a #
# payment is completed (like creating a new user's account),   #
# you MUST insert your own code into the areas marked below in #
# the body of this script. Each block corresponds to one of the#
# potential outcomes of a new payment: transaction approved    #
# or transaction declined.                                     #
#                                                              #
# For example, if you're selling a software package on your    #
# site, you would want to put code in the "success" block that #
# emails the payer a copy of the software. 2Checkout will post #
# a number of variables to this script, which you may find     #
# useful. Some of these variables are:                         #
#                                                              #
#   $_POST[order_number]                                       #
#   $_POST[card_holder_name]                                   #
#   $_POST[street_address]                                     #
#   $_POST[city]                                               #
#   $_POST[state]                                              # 
#   $_POST[zip]                                                #
#   $_POST[country]                                            #
#   $_POST[email]                                              #
#   $_POST[phone]                                              #
#   $_POST[cart_order_id]                                      #
#   $_POST[cart_id]                                            #
#   $_POST[credit_card_processed]                              #
#   $_POST[total]                                              #
#   $_POST[ship_name]                                          #
#   $_POST[ship_street_address]                                #
#   $_POST[ship_city]                                          #
#   $_POST[ship_state]                                         #
#   $_POST[ship_zip]                                           #
#   $_POST[ship_country]                                       #
#                                                              #
# See the 2Checkout admin area for more information.           #
################################################################

# Get the posted data
$params = "cmd=_notify-validate";

while(list($key, $val) = each($_POST)){
  $val = urlencode(stripslashes($val));
  $params .= "&$key=$val";
}

if($_POST[credit_card_processed] == "Y"){
  #payment was successful

  ############################################################
  # INSERT YOUR OWN CODE HERE TO BE PERFORMED WHEN A PAYMENT #
  # WAS SUCCESSFULLY RECEIVED                                #
  ############################################################

  #### Placeholder code to send "thank you" email
  $to = $_POST[email];
  $from = "test@example.com";
  $message = "Thanks for your 2Checkout payment of $$_POST[total]!";
  mail($to, "Thank you!", $message, "From: $from");
  #### End placeholder code

}

else{
  #transaction was declined or did not go through

  ############################################################
  # INSERT YOUR OWN CODE HERE TO BE PERFORMED WHEN A PAYMENT #
  # WAS DECLINED OR DID NOT GO THROUGH                       #
  ############################################################
}


?>