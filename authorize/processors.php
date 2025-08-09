<?php
# FILE: processors.php
# Description: This file contains the functions used to post
# transactions to authorize.net.

################################################################
# You MUST set the following variables before using the script #
################################################################

# $merchantanuser is your merchant ID for authorize.net. 

$merchantanuser = "testdriver";

# $merchantanpass is your authorize.net password, if you
# are required to supply one with transactions

$merchantanpass = "";

# $merchantankey is the transaction key obtained from the
# Merchant Interface at authorize.net, if you are required
# to supply one with transactions.

$merchantankey = "";

# $merchanttest turns test mode on or off for authorize.net.
# You should set this to "TRUE" when testing authorize.net
# transactions, and "FALSE" to actually process the cards 
# through authorize.net. 

$merchanttest = "TRUE";

################################################################
# End of configuration - No need to edit below this line       #
################################################################

#Process a transaction via authorize.net
#Returns: array containing response values
#Check: check $returnvalue[x_response_code], the value will be 1 if
#       the transaction succeeded, 2 if it was declined, or 3 if
#       there was some sort of data error.

function authorize($fname, $lname, $company, $address1, $address2, $city, $state, $zip, $country, $phone, $email, $cardnumber, $month, $year, $amount, $description=0, $invoice=0){

  global $_SERVER, $merchantanuser, $merchanttest, $merchantanpass, $merchantankey;

  $target = "https://secure.authorize.net/gateway/transact.dll";

  $address = "$address1 $address2";
  $expiration = "$month$year";
  $amount = sprintf("%.02f", $amount);
  
  if(!$invoice)
    $invoice = sprintf("%06d", rand(111111, 999999));

  if(!$description)
    $description = "Online Services: $amount";
  
  $remoteaddr = $_SERVER[REMOTE_ADDR];

  $params = "x_delim_char=,&x_Encap_Char=&x_delim_data=TRUE&x_adc_url=FALSE&x_first_name=$fname&x_last_name=$lname&x_address=$address&x_city=$city&x_state=$state&x_country=$country&x_zip=$zip&x_phone=$phone&x_email=$email&x_amount=$amount&x_card_num=$cardnumber&x_description=$description&x_invoice_num=$invoice&x_customer_ip=$remoteaddr&x_exp_date=$expiration&x_type=AUTH_CAPTURE&x_method=CC&x_test_request=$merchanttest&x_login=$merchantanuser&x_version=3.0&x_email_customer=FALSE";

  if($merchantanpass){
    $params .= "&x_password=$merchantanpass";
  }

  if($merchantankey){
    $params .= "&x_tran_key=$merchantankey";
  }

  $params = str_replace(" ", "+", $params);

  $sslsession = curl_init("$target?$params");
  curl_setopt($sslsession, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($sslsession);
  curl_close($sslsession);

  $response = explode(",", $response);

  $results = array("x_response_code"=>"$response[0]", "x_response_subcode"=>"$response[1]", "x_response_reason_code"=>"$response[2]", "x_response_reason_text"=>"$response[3]", "x_auth_code"=>"$response[4]", "x_avs_code"=>"$response[5]", "x_trans_id"=>"$response[6]", "x_invoice_num"=>"$response[7]", "x_description"=>"$response[8]", "x_amount"=>"$response[9]", "x_method"=>"$response[10]", "x_type"=>"$response[11]", "x_cust_id"=>"$response[12]", "x_first_name"=>"$response[13]", "x_last_name"=>"$response[14]", "x_company"=>"$response[15]", "x_address"=>"$response[16]", "x_city"=>"$response[17]", "x_state"=>"$response[18]", "x_zip"=>"$response[19]", "x_country"=>"$response[20]", "x_phone"=>"$response[21]", "x_email"=>"$response[23]", "x_md5_hash"=>"$response[37]", "x_cvv2_resp_code"=>"$response[38]");

  return $results;
}

?>