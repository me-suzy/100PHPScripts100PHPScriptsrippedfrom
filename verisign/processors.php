<?php
# FILE: processors.php
# COPYRIGHT: PHPSelect.Com
# ----
# Description: This file contains the function used to post
# transactions to Verisign.

################################################################
# You MUST set the following variables before using the script #
################################################################

# $merchantvsuser is your merchant ID for Verisign. 

$merchantvsuser = "test";

# If you have a Verisign Partner ID, set $vpartner to that ID.
# If you don't (or are unsure), leave $vpartner blank.

$vpartner = "";

################################################################
# End of configuration - No need to edit below this line       #
################################################################

#Process a transaction via Verisign
#Returns: 1 on success, 0 on failure
#Check: check return value

function verisign($fname, $lname, $company, $address1, $address2, $city, $state, $zip, $country, $phone, $email, $cardnumber, $month, $year, $amount, $description=0, $invoice=0){

  global $_SERVER, $merchantvsuser, $vpartner;

  $target = "https://payflowlink.verisign.com/payflowlink.cfm";

  $address = "$address1 $address2";
  $country = substr($country, 0, 2);
  $year = str_replace("20", "", $year);
  $expiration = "$month$year";
  $amount = sprintf("%.02f", $amount);
  
  if(!$invoice)
    $invoice = sprintf("%06d", rand(111111, 999999));

  if(!$description)
    $description = "Online Services: $amount";
  
  $remoteaddr = $_SERVER[REMOTE_ADDR];

  $params="LOGIN=$merchantvsuser&PARTNER=$vpartner&AMOUNT=$amount&TYPE=S&DESCRIPTION=$description&NAME=$fname $lname&ADDRESS=$address&CITY=$city&STATE=$state&ZIP=$zip&COUNTRY=$country&PHONE=$phone&FAX=$phone&USER1=$invoice&METHOD=CC&CARDNUM=$cardnumber&EXPDATE=$expiration&ORDERFORM=False&SHOWCONFIRM=False";

  $params = str_replace(" ", "%20", $params);

  $sslsession = curl_init("$target?$params");
  curl_setopt($sslsession, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($sslsession);
  curl_close($sslsession);

  if(eregi("transaction was approved", $response)){
    #Success
    return 1;
  }
  else{
    #Failure
    return 0;
  }
}

?>