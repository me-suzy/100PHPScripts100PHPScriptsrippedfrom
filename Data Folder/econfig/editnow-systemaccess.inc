if ($new_opsystem ne "") { $dopsys = "$new_opsystem"; }
else { $dopsys = "$opsystem"; }
open (UPDTCONFIG, ">$data_dir/iConfig.pm");
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

\$site_name = "$site_name";
\$safelist_type = "$safelist_type";
\$message_type = "$message_type";
\$adv_links = "$adv_links";
\$alink_time = $alink_time;
\$admin_password = "$admin_password";
\$admin_id = "$admin_id";
\$admin_name = "$admin_name";
\$admin_email = '$admin_email';
\$bounced_email = '$bounced_email';
\$notify_paid = "$notify_paid";
\$notify_email = '$notify_email';
\$accept_paypal = "$accept_paypal";
\$payby_paypal = "$payby_paypal";
\$paypal_email = '$paypal_email';
\$accept_egold = "$accept_egold";
\$payby_egold = "$payby_egold";
\$egold_acct = "$egold_acct";
\$prefix = "$prefix";

\$cgi_bin = "$new_cgibin";
\$admin_cgi = "$new_admincgi";
\$logout_url = "$new_logouturl";
\$login_url = "$new_loginurl";
\$clickthru_url = "$new_clickthruurl";
\$data_dir = "$new_datadir";
\$mailprog = "$new_mailprog";
\$opsystem = "$new_opsystem";
\$mysql_dbname = "$new_mysqldbname";
\$mysql_username = "$new_mysqlusername";
\$mysql_password = "$new_mysqlpassword";
\$mysql_host = "$new_mysqlhost";

\$points_joinfree = $points_joinfree;
\$points_joinpro = $points_joinpro;
\$points_joinplat = $points_joinplat;
\$points_referfree = $points_referfree;
\$points_referpro = $points_referpro;
\$points_referplat = $points_referplat;
\$points_readfree = $points_readfree;
\$points_readpro = $points_readpro;
\$points_readplat = $points_readplat;
\$points_alinkfree = $points_alinkfree;
\$points_alinkpro = $points_alinkpro;
\$points_alinkplat = $points_alinkplat;
\$points_emailfree = $points_emailfree;
\$points_emailpro = $points_emailpro;
\$points_emailplat = $points_emailplat;
\$sell_points = "$sell_points";
\$points_perdollarfree = $points_perdollarfree;
\$points_perdollarpro = $points_perdollarpro;
\$points_perdollarplat = $points_perdollarplat;
\$points_minbuyfree = $points_minbuyfree;
\$points_minbuypro = $points_minbuypro;
\$points_minbuyplat = $points_minbuyplat;

\$normal_referfree = $normal_referfree;
\$normal_referpro = $normal_referpro;
\$normal_referplat = $normal_referplat;
\$normal_freedays = $normal_freedays;
\$normal_prodays = $normal_prodays;
\$normal_platinumdays = $normal_platinumdays;
\$normal_alinkfree = $normal_alinkfree;
\$normal_alinkpro = $normal_alinkpro;
\$normal_alinkplat = $normal_alinkplat;
\$normal_readfree = $normal_readfree;
\$normal_readpro = $normal_readpro;
\$normal_readplat = $normal_readplat;

\$prices_freetopro = "$prices_freetopro";
\$prices_freetoplat = "$prices_freetoplat";
\$prices_protoplat = "$prices_protoplat";
\$cycles_pro = "$cycles_pro";
\$cycles_platinum = "$cycles_platinum";
\$dfont_name = "$dfont_name";
\$dfont_size = "$dfont_size";
\$dfont_color = "$dfont_color";
\$hover_color = "$hover_color";
\$page_color = "$page_color";
\$background_img = "$background_img";
\$base_color = "$base_color";
\$contrast_color = "$contrast_color";
\$name_font = "$name_font";
\$name_size = "$name_size";
\$name_color = "$name_color";
\$listnamelogo_img = "$listnamelogo_img";
\@results = ('#EEEEEE','#CCCCCC');
\$max_buttons = $max_buttons;

1;
NEWCONFIG_END
if ($dopsys eq "UNIX") { flock (UPDTCONFIG, 2); }
close (UPDTCONFIG);

1;
