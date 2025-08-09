<?php
#########################################################
#                      DownCount                        #
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

#Set the following configuration variables

//# URL to the directory containing the scripts
$scripturl="http://box/downcount";

//# what is the server path to the database directory?
//# this directory must be created and chmod 777
$dbasedir="/home/www/public_html/downcount/dbase";

//# do we keep a count of files downloaded?
$use_count="yes";

//# if you chose "yes" above, specify where to keep count files.
$countdir=$dbasedir."/count";

//# do we make users register their name and email to download files?
$use_register="yes";

//#do we use full file info pages?
//# yes or no
$infopages="no";

//# if you chose "no" for the above infopages area.
//# do we use a redir URL or do we open a stock template for them?
//# "no" means we use a stock template, "yes" means we redir them to a URL.
$use_redir="no";

//# if you chose "yes" above what is the URL to redir them to?
$redir_url="http://domain.com/page.html";

?>
