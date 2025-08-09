if ($new_opsystem ne "") { $dopsys = "$new_opsystem"; }
else { $dopsys = "$opsystem"; }
open (UPDTCONFIG, ">$data_dir/iConfigAdver.pm");
if ($dopsys eq "UNIX") { flock (UPDTCONFIG, 8); }
print UPDTCONFIG<<NEWCONFIG_END;
#
################################################################################
# Program   : iSafeList v3              Written by  : Ivan Santiago            #
# Plataforms: Unix or Windows           Writtan Date: March 27th, 2002         #
################################################################################
#              Iphat.net / IphatScripts.com Copyright © 2002                   #
################################################################################
# Read the following notice carefully before using this software.              #
#                                                                              #
# The following are terms and conditions you must agree with in order to       # 
# use/run this software.                                                       #
#                                                                              #
# If you DO NOT agree to the following you may not use this script, in whole   #
# or any part of it.                                                           #
#                                                                              #
# By using this code you agree to indemnify it's creator and all members,      #
# employees and affiliates of Iphat.net including but not limited to, it's     #
# creator Ivan (from Iphat.net). You may modify this script as you find        #
# necessary as long as this entire header remains intact.                      #
#                                                                              #
# Anyone using this script without paying any and all necessary fees is in     #
# violation of United States and International copyright laws. Selling or      #
# redistributing any of this code without prior written consent is expressly   #
# forbidden.                                                                   #
#                                                                              #
# This program should be tested with non-real data before it is publicly used. #
# The user of this scripts assumes the entire risk of using this program.      #
# This agreement shall be governed by the laws of the State of Florida.        # 
################################################################################
# THIS SOFTWARE INCLUDING FILES THAT ACCOMPANY IT ARE SOLD AND DISTRIBUTED     #
# "AS IS" AND WITHOUT ANY WARRANTIES EXPRESSED OR IMPLIED, INCLUDING, BUT NOT  #
# LIMITED TO, PERFORMANCE AND MERCHANTABILITY. NO WARRANTY OF FITNESS FOR ANY  #
# PARTICULAR REASON OR PURPOSE IS OFFERED. ANY AND ALL LIABILITY OF THE SELLER #
# IS LIMITED EXCLUSIVELY TO PRODUCT REPLACEMENT OR REPAIR - NO REFUNDS ARE     #
# GIVEN OR OFFERED FOR ANY OF OUR CURRENT OR FUTURE SCRIPTS                    #
################################################################################
#   -=:DO NOT EDIT BELOW THIS LINE - TO DO CHANGES USE THE ADMIN SECTION :=-   #
################################################################################

\$advertiser_cgi = "$n_advertisercgi";
\$advertiser_logouturl = "$n_advertiserlogouturl";
\$advertiser_loginurl = "$n_advertiserloginurl";
\$verify_aemails = $n_vaemails;

1;
NEWCONFIG_END
if ($dopsys eq "UNIX") { flock (UPDTCONFIG, 2); }
close (UPDTCONFIG);

1;
