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

$vars = array();
if($_SERVER['REQUEST_METHOD'] == 'GET')
	$vars = $_GET;
else
	$vars = $_POST;

$file = $vars['file'];
$email = $vars['email'];
$name = $vars['name'];
$ip = $_SERVER['REMOTE_ADDR'];
$action = $vars['action'];

if($use_register == 'yes')
{
	if($action == 'process')
		process($vars);
	else if($action == 'info')
		info($vars);
	else
		info($vars);
}
else
{
	process($vars);
}


function info($vars)
{
	global $page_html, $scripturl;
	$page_html = implode('', file("templates/register.html"));

	$page_html = preg_replace("/%scripturl%/", $scripturl, $page_html);
	$page_html = preg_replace("/%file%/", $vars['file'], $page_html);
	$page_html = preg_replace("/%ip%/", $_SERVER['REMOTE_ADDR'], $page_html);

	print $page_html;
}

function process($vars)
{
	global $dbasedir, $infopagesi, $use_redir, $redir_url;
	$db = @file("$dbasedir/dbase.txt");
	foreach($db as $line)
	{
		list($fname, $frname, $furl, $infopath) = preg_split("/\|/", $line);
		if($fname == $vars['file'])
		{
			counter($fname);
                  logger($vars[name], $vars[email]);
			if($infopages == 'yes')
			{
				$fileinfo = implode('', @file("$infopath"));

				$page_html = implode('', @file("templates/infopage.html"));
				$page_html = preg_replace("/%longname%/", $frname, $page_html);
				$page_html = preg_replace("/%filename%/", $fname, $page_html);
				$page_html = preg_replace("/%fileurl%/", $furl, $page_html);
				$page_html = preg_replace("/%infopath%/", $infopath, $page_html);
				$page_html = preg_replace("/%fileinfo%/", $fileinfo, $page_html);
				$page_html = preg_replace("/%name%/", $vars['name'], $page_html);
				$page_html = preg_replace("/%email%/", $vars['email'], $page_html);
				$page_html = preg_replace("/%ip%/", $_SERVER['REMOTE_ADDR'], $page_html);
				print $page_html;
				exit;
			}
			else
			{
				if($use_redir == 'yes')
				{
					header("Location: $redir_url");
					exit;
				}
				else
				{
					$page_html = implode('', @file("templates/standard.html"));
					$page_html = preg_replace("/%longname%/", $frname, $page_html);
					$page_html = preg_replace("/%filename%/", $fname, $page_html);
					$page_html = preg_replace("/%fileurl%/", $furl, $page_html);
					$page_html = preg_replace("/%infopath%/", $infopath, $page_html);
					$page_html = preg_replace("/%name%/", $vars['name'], $page_html);
					$page_html = preg_replace("/%email%/", $vars['email'], $page_html);
					$page_html = preg_replace("/%ip%/", $_SERVER['REMOTE_ADDR'], $page_html);
					print $page_html;
					exit;
					
				}
			}
		}
		
	}
	$page_html = implode('', @file("templates/notfound.html"));
	$page_html = preg_replace("/%longname%/", $frname, $page_html);
	$page_html = preg_replace("/%filename%/", $fname, $page_html);
	$page_html = preg_replace("/%fileurl%/", $furl, $page_html);
	$page_html = preg_replace("/%infopath%/", $infopath, $page_html);
	$page_html = preg_replace("/%fileinfo%/", $fileinfo, $page_html);
	$page_html = preg_replace("/%name%/", $vars['name'], $page_html);
	$page_html = preg_replace("/%email%/", $vars['email'], $page_html);
	$page_html = preg_replace("/%ip%/", $_SERVER['REMOTE_ADDR'], $page_html);
	print $page_html;

}
function counter($fname)
{
	global $use_count, $countdir, $dbasedir;
	if($use_count == 'yes')
	{
		$cnt = @file("$countdir/$fname");
		$ctr = rtrim($cnt[0]);
		$ctr++;
		
		$fp = @fopen("$dbasedir/count/$fname", "w");
		fwrite($fp, "$ctr\n");
		fclose($fp);
		
		
	}
}

function logger($name, $email){
  global $dbasedir;
  $fp = @fopen("$dbasedir/emails.txt", "a");
  fputs($fp, "$name:$email\n");
  fclose($fp);
}
?>

