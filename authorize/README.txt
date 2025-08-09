#########################################################
#          CC Processor Gateway Interface               #
#########################################################
#                                                       #
# This script was created by:                           #
#                                                       #
# PHPSelect Web Development Division.                   #
# http://www.phpselect.com/                             #
#                                                       #
# This script and all included modules, lists or        #
# images, documentation are copyright 2002              #
# PHPSelect (http://www.phpselect.com/) unless          #
# otherwise stated in the script.                       #
#                                                       #
# Purchasers are granted rights to use this script      #
# on any site they own. There is no individual site     #
# license needed per site.                              #
#                                                       #
# Any copying, distribution, modification with          #
# intent to distribute as new code will result          #
# in immediate loss of your rights to use this          #
# program as well as possible legal action.             #
#                                                       #
# This and many other fine scripts are available at     #
# the above website or by emailing the authors at       #
# admin@phpselect.com or info@phpselect.com             #
#                                                       #
#########################################################

Installation and Usage
========================================

In order to use the CC Processor Gateway Interface, you
must have an account with 

  authorize.net              http://www.authorize.net/

Open the processors.php script and set the variables as
indicated at the top of the script. NOTE: Beginning
sometime in April or May of 2003, the $merchantankey
variable will likely become required. See authorize.net's
website for more information on determining your unique
Transaction Key.

HOW TO USE - AUTHORIZE.NET
========================================

Using the authorize.net functionality is simple. Place 
the command

  require_once("processors.php");

at the top of your existing script (for example, the script
that your order form posts to). Call the authorize() function
from your script like so:

$results = authorize($fname, $lname, $company, $address1,
           $address2, $city, $state, $zip, $country, $phone,
           $email, $cardnumber, $month, $year, $amount 
           [,$description, $invoice]);

You must pass at least the first 15 paramaters to the 
authorize() function. If you do not collect certain 
information from the customer - for example, a phone 
number or a 2nd line for the address - you must pass 
empty strings ("") in their place. However, it is suggested
that you build your payment form around these 15 fields. 
Passing a description and invoice number are optional; if
you don't pass them, they will be generated for you. You
should not include the square-brackets in your code, these
are only being used to indicate that those two fields are
optional.

The authorize() function will return an associative array 
which contains the following element names:

     x_response_code
     x_response_subcode
     x_response_reason_code
     x_response_reason_text
     x_auth_code
     x_avs_code
     x_trans_id
     x_invoice_num
     x_description
     x_amount
     x_method
     x_type
     x_cust_id
     x_first_name
     x_last_name
     x_company
     x_address
     x_city
     x_state
     x_zip
     x_country
     x_phone
     x_md5_hash
     x_cvv2_resp_code

You can then use this array and its elements to determine
whether or not the transaction was successful, and do 
whatever needs to be done upon success or failure. To see
if the transaction was a success, check the value of the
$results[x_response_code] array element. If the transaction
succeeded, this variable will contain (but not necessarily
equal) "1", otherwise you can assume that the transaction 
failed and you didn't get paid.

Here is an example of how to use the function to generate
a successful test transaction:

<?php
$results = authorize("John", "Doe", "Widgets Inc", "123 Cherry",
           "Suite 3", "Anytown", "TN", "38018", "US", "901-555-1212",
           "john@example.com", "4007000000027", "05", "2006", "9.95", 
           "One widget", "123-456");

if(eregi("1", $results[x_response_code])){
  echo "Success!";
}
else{
  echo "Failure!";
}
?>

See the included sample.php file for an example of how to
collect the data from an HTML form and process a real
transaction.


#########################################################

[Support]

You can reach technical support at support@phpselect.com.
You can also visit us at http://www.phpselect.com/ for more
information regarding this and other scripts.

Thanks!