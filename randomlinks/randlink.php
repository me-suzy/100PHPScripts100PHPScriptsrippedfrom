<?php

#########################################################
#                     RandomLinks                       #
#########################################################
#                                                       #
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
#randlink.php                                           #
#                                                       #
#RandLink allows you to set up a database of interesting#
#web URLs, then send your visitors to one of these URLs #
#randomly when they click the link to the script.       #
#########################################################

#########################################################
#Editing below is not required.                         #
#########################################################

$linkdb = "linkdb.txt";

$links = file("linkdb.txt");

srand((double)microtime() * 1000000); 
$selection = $links[rand(0, sizeof($links)-1)];

header("Location: $selection");

?>