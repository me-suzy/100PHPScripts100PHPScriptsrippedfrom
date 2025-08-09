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
require_once("configs.php");

main();

function main()
{
	$vars = array();
	if($_SERVER['REQUEST_METHOD'] == 'GET')
		$vars = $_GET;
	else
		$vars = $_POST;
	
	switch($vars['action'])
	{
		case "process":
			process($vars);
			break;
		case "default":
		case "":
		default:
			_default($vars);
			break;
	}
}

function _default($vars)
{
?>
<html>
<head><title>Add Files</title></head>
<body bgcolor=white><h2>Add Files</h2><br>
<form method=POST>
<input type=hidden name=action value=process>
File Identifier: <input type=text size="40" name="fname"><br>
File Descriptive Name: <input type=text size="40" name="frname"><br>
URL to File: <input type=text size="40" name="furl"><br>
InfoPage Path, if any: <input type=text size="40" name="infopath"><br>
<br>
<input type=submit value="Add File">
</form><br><br>
</body>
</html>
<?php
}

function process($vars)
{
	global $dbasedir, $scripturl;

	$fname = $vars['fname'];
	$frname = $vars['frname'];
	$fpath = $vars['furl'];
	$infopath = $vars['infopath'];
	$db = @file("$dbasedir/dbase.txt");
	$setbad = 0;
      if(sizeof($db) >= 2){
           echo "sizeof db is " . sizeof($db) . "<br>";
	     foreach($db as $line)
	     {
		list($f2name, $f2rname, $f2path, $in2fopath) = preg_split("/\|/", $line);
		if($fname == $f2name)
			$setbad=1;
	     }
      }
	if($setbad == 1)
	{
        echo <<<EOT
<html>
<head><title>Add Files</title></head>
<body bgcolor=white><h2>Add Files</h2><br>
<br>
Filename is already in use.<br><br>
Please press your back button to change filename, or click
<a href=$scripturl/addfiles.php>here</a> to start fresh.
<br><br>
<br><br>
</body>
</html>
EOT;
        exit;
	}
	else
	{
		$fp = @fopen("$dbasedir/dbase.txt", "a");
		fwrite($fp, "$fname|$frname|$fpath|$infopath\n");
		fclose($fp);
            echo <<<EOT
<html>
<head><title>Add Files</title></head>	
<body bgcolor=white><h2>Add Files</h2><br>								
File has successfully been added to the database! To link to this file, use:<br><br>
&lt;a href="$scripturl/download.php?file=$vars[fname]"&gt;	
<br><br>	
Please click 
<a href="$scripturl/addfiles.php">here</a> to add another file	
<br><br>	
</body>	
</html>
EOT;
      }
}
?>
