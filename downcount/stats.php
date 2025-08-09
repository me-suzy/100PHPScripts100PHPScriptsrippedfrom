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

require_once "configs.php";

$db = @file("$dbasedir/dbase.txt");

echo <<<EOT
<html>
<head><title>Download Stats</title></head>
<body bgcolor=white><h2>Download Stats</h2><br><a href="dbase/emails.txt">Click here</a> to view downloaders' email addresses<br><br>
<table>
<tr><td><b>Filename</b></td><td><b>Number of Downloads</b></td></tr>

EOT;

foreach($db as $line)
{
	list($fname, $frname, $furl, $infopath) = preg_split("/\|/", $line);
	$cnt = @file("$countdir/$fname");
	$ctr = rtrim($cnt[0]);
	print "<tr><td>$fname</td><td>$ctr</td></tr>\n";

}

?>
</table><br><br>
</body>
</html>

