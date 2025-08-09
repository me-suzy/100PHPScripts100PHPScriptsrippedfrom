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

  2Checkout                  http://www.2checkout.com/

Open the processors.php script and set the variable as
indicated at the top of the script. Upload the script to
your server and then follow the instructions below.


HOW TO USE - 2CHECKOUT
========================================

Using the 2Checkout functionality takes a bit of work, at
least if you want to be truly automated. For a basic 2Checkout 
transaction, place the command

  require_once("processors.php");

at the top of your existing script (for example, the script
that your order form posts to). Call the twocheckout() function
from your script like so:

twocheckout($amount [,$invoice]);

The only parameter you must pass to the twocheckout function is
the dollar amount of the transaction. The customer will 
be redirected to a payment form at 2Checkout's site which
lets them make their payment. If you do not supply an invoice
number, one will be randomly generated for you.

Using the twocheckout() function in this basic manner, you will
receive the standard email notification from 2Checkout when
a customer makes a payment, and then you'll have to proceed
manually to provide the customer with his service or product.
This is recommended for non-advanced users.

Now comes the tricky part. If you want to _automate_ the 
process of validating 2Checkout transactions and performing
actions based upon the transaction status, you will need
to do two things:

1. Login to 2Checkout and edit your preferences so that 
   2Checkout's postback URL is set to your installed copy
   of 2checkout_ipn.php.

2. Edit 2checkout_ipn.php. You will need to insert your own 
   PHP code for each of the possible outcomes of a 2Checkout 
   transaction. 2checkout_ipn.php contains more detailed
   instructions.

Note that step 2 requires writing your own PHP code. (If 
you don't know PHP, contact PHPSelect.com for a quote on
custom coding.)

#########################################################

[Support]

You can reach technical support at support@phpselect.com.
You can also visit us at http://www.phpselect.com/ for more
information regarding this and other scripts.

Thanks!