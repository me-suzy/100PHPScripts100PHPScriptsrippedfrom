<?php
# FILE: paypal_ipn.php
# Description: This script handles postback notifications from
# PayPal IPN.

################################################################
# After someone makes a PayPal payment through your site,      #
# PayPal will access this script to instantly notify you about #
# the status of the transaction.                               #
#                                                              #
# By default, this script will send a "thank you" email to the #
# payer when a PayPal transaction is successfully completed.   #
# Assuming you want to perform some automatic functions when a #
# payment is completed (like creating a new user's account),   #
# you MUST insert your own code into the four areas marked in  #
# the body of this script. Each block corresponds to one of 4  #
# potential outcomes of a PayPal payment: immediate success,   #
# success pending your manual approval, declined, or error.    #
#                                                              #
# For example, if you're selling a software package on your    #
# site, you would want to put code in the "success" block that #
# emails the payer a copy of the software. PayPal will post    #
# a number of variables to this script, which you may find     #
# useful. Some of these variables are:                         #
#                                                              #
# $_POST[payer_email]      Payer's email address               #
# $_POST[txn_gross]        Total amount of the payment         #
# $_POST[txn_id]           PayPal Transaction ID number        #
# $_POST[item_name]        Item name/description that you      #
# $_POST[payment_status]   Status of the payment               #
# $_POST[first_name]       Payer's first name                  #
# $_POST[last_name]        Payer's last name                   #
# $_POST[address_street]   Payer's street address              #
# $_POST[address_city]     Payer's city                        #
# $_POST[address_state]    Payer's state                       #
# $_POST[address_zip]      Payer's ZIP code                    #
#                                                              #
# See https://www.paypal.com/cgi-bin/webscr?cmd=p/acc/ipn-info #
# for more variables.                                          #
################################################################

# Get the posted data
$params = "cmd=_notify-validate";

while(list($key, $val) = each($_POST)){
  $val = urlencode(stripslashes($val));
  $params .= "&$key=$val";
}

#Post the data back to PayPal
$sslsession = curl_init("https://www.paypal.com/cgi-bin/webscr");
curl_setopt($sslsession, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($sslsession, CURLOPT_POST, 1);
curl_setopt($sslsession, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($sslsession);
curl_close($sslsession);

if((eregi("VERIFIED", $response)) && (eregi("Completed", $_POST[payment_status]))){
  #payment was successful

  ############################################################
  # INSERT YOUR OWN CODE HERE TO BE PERFORMED WHEN A PAYMENT #
  # WAS SUCCESSFULLY RECEIVED                                #
  ############################################################

  #### Placeholder code to send "thank you" email
  $to = $_POST[payer_email];
  $from = $_POST[receiver_email];
  $message = "Thanks for your PayPal payment of $$_POST[txn_gross]!";
  mail($to, "Thank you!", $message, "From: $from");
  #### End placeholder code

}

else if((eregi("VERIFIED", $response)) && (eregi("Pending", $_POST[payment_status]))){
  #payment was accepted, but pending recipient approval

  ############################################################
  # INSERT YOUR OWN CODE HERE TO BE PERFORMED WHEN A PAYMENT #
  # WAS SUCCESSFUL BUT STILL NEEDS YOUR APPROVAL VIA PAYPAL  #
  ############################################################

}

else if((eregi("INVALID", $response)) || (eregi("Failed", $_POST[payment_status]))){
  #transaction was declined

  ############################################################
  # INSERT YOUR OWN CODE HERE TO BE PERFORMED WHEN A PAYMENT #
  # WAS DECLINED                                             #
  ############################################################
}

else{
  #error 

  ############################################################
  # INSERT YOUR OWN CODE HERE TO BE PERFORMED WHEN A PAYMENT #
  # FAILED DUE TO SOME SORT OF ERROR                         #
  ############################################################
}

?>