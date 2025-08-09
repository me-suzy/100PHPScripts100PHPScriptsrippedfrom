<?php
#########################################################
#                     SuperPals                         #
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

require_once("configs.php");

main();

function main()
{
	$vars = array();
	if($_SERVER['REQUEST_METHOD'] == 'GET')
		$vars = $_GET;
	else
		$vars = $_POST;

      foreach($vars as $key => $value) 
            $vars[$key] = stripslashes($value);

	@$action = $vars['action'];
	switch($action)
	{
		case "process":
			return process($vars);
			break;
		case "view":
			return view($vars);
			break;
		case "view_record":
			return view_record($vars);
			break;
		case "admin":
			return admin($vars);
			break;
		case "admin_main":
			return admin_main($vars);
			break;
		case "delete":
			return del_entry($vars);
			break;
		case "mail_process":
			return mail_process($vars);
			break;
		case "":
		case "signup":
		default:
			return signup($vars);
			break;
	}
}

function signup($vars)
{
	global $scripturl;
	$file = implode('', file("templates/signup.html"));

	$file = preg_replace("/%scripturl%/", "$scripturl", $file);

	print $file;
}

function process($vars)
{
	global $admin_email, $mail_admin, $mail_user, $scripturl;
	$name=$vars['name'];
	$email=$vars['email'];
	$url=$vars['url'];
	$sex=$vars['sex'];
	$age=$vars['age'];
	$pref=$vars['pref'];
	$city=$vars['city'];
	$state=$vars['state'];
	$country=$vars['country'];
	$situation=$vars['situation'];
	$race=$vars['race'];
	$religion=$vars['religion'];
	$height=$vars['height'];
	$weight=$vars['weight'];
	$hair=$vars['hair'];
	$eyes=$vars['eyes'];
	$education=$vars['education'];
	$work=$vars['work'];
	$hobbies=$vars['hobbies'];
	$matchage=$vars['matchage'];
	$desc=$vars['desc'];
	$id=time();
	$ip_address=$_SERVER['REMOTE_ADDR'];

	$fp = fopen('users.db', 'a');
	fwrite($fp, "$id|$name|$email|$url|$sex|$age|$pref|$city|$state|$country|$situation|$race|$religion|$height|$weight|$hair|$eyes|$education|$work|$hobbies|$matchage|$desc\n");
	fclose($fp);
	if($mail_admin == "yes") {
		$mail_message = implode('', file("templates/adminmail.txt"));
		$mail_message = preg_replace("/%name%/", $name, $mail_message);
		$mail_message = preg_replace("/%email%/", $email, $mail_message);
		$mail_message = preg_replace("/%url%/", $url, $mail_message);
		$mail_message = preg_replace("/%sex%/", $sex, $mail_message);
		$mail_message = preg_replace("/%age%/", $age, $mail_message);
		$mail_message = preg_replace("/%pref%/", $pref, $mail_message);
		$mail_message = preg_replace("/%city%/", $city, $mail_message);
		$mail_message = preg_replace("/%state%/", $state, $mail_message);
		$mail_message = preg_replace("/%country%/", $country, $mail_message);
		$mail_message = preg_replace("/%situation%/", $situation, $mail_message);
		$mail_message = preg_replace("/%race%/", $race, $mail_message);
		$mail_message = preg_replace("/%religion%/", $religion, $mail_message);
		$mail_message = preg_replace("/%height%/", $height, $mail_message);
		$mail_message = preg_replace("/%weight%/", $weight, $mail_message);
		$mail_message = preg_replace("/%hair%/", $hair, $mail_message);
		$mail_message = preg_replace("/%eyes%/", $eyes, $mail_message);
		$mail_message = preg_replace("/%education%/", $education, $mail_message);
		$mail_message = preg_replace("/%work%/", $work, $mail_message);
		$mail_message = preg_replace("/%hobbies%/", $hobbies, $mail_message);
		$mail_message = preg_replace("/%matchage%/", $matchage, $mail_message);
		$mail_message = preg_replace("/%desc%/", $desc, $mail_message);
		$mail_message = preg_replace("/%admin_email%/", $admin_email, $mail_message);
		$mail_message = preg_replace("/%ip_address%/", $ip_address, $mail_message);

		mail($admin_email, "New signup to penpal list!", $mail_message, "From: PenPals <$email>");
	}
	if($mail_user == "yes") {		
		$mail_message = implode('', file("templates/usermail.txt"));
		$mail_message = preg_replace("/%name%/", $name, $mail_message);
		$mail_message = preg_replace("/%email%/", $email, $mail_message);
		$mail_message = preg_replace("/%url%/", $url, $mail_message);
		$mail_message = preg_replace("/%sex%/", $sex, $mail_message);
		$mail_message = preg_replace("/%age%/", $age, $mail_message);
		$mail_message = preg_replace("/%pref%/", $pref, $mail_message);
		$mail_message = preg_replace("/%city%/", $city, $mail_message);
		$mail_message = preg_replace("/%state%/", $state, $mail_message);
		$mail_message = preg_replace("/%country%/", $country, $mail_message);
		$mail_message = preg_replace("/%situation%/", $situation, $mail_message);
		$mail_message = preg_replace("/%race%/", $race, $mail_message);
		$mail_message = preg_replace("/%religion%/", $religion, $mail_message);
		$mail_message = preg_replace("/%height%/", $height, $mail_message);
		$mail_message = preg_replace("/%weight%/", $weight, $mail_message);
		$mail_message = preg_replace("/%hair%/", $hair, $mail_message);
		$mail_message = preg_replace("/%eyes%/", $eyes, $mail_message);
		$mail_message = preg_replace("/%education%/", $education, $mail_message);
		$mail_message = preg_replace("/%work%/", $work, $mail_message);
		$mail_message = preg_replace("/%hobbies%/", $hobbies, $mail_message);
		$mail_message = preg_replace("/%matchage%/", $matchage, $mail_message);
		$mail_message = preg_replace("/%desc%/", $desc, $mail_message);
		$mail_message = preg_replace("/%admin_email%/", $admin_email, $mail_message);
		$mail_message = preg_replace("/%ip_address%/", $ip_address, $mail_message);

		mail($email, "Welcome to our PenPals list!", $mail_message, "From: OurSite <$admin_email>");
	}	
	$page_html = implode('', file("templates/success.html"));
	$page_html = preg_replace("/%name%/", $name, $page_html);
	$page_html = preg_replace("/%email%/", $email, $page_html);
	$page_html = preg_replace("/%url%/", $url, $page_html);
	$page_html = preg_replace("/%sex%/", $sex, $page_html);
	$page_html = preg_replace("/%age%/", $age, $page_html);
	$page_html = preg_replace("/%pref%/", $pref, $page_html);
	$page_html = preg_replace("/%city%/", $city, $page_html);
	$page_html = preg_replace("/%state%/", $state, $page_html);
	$page_html = preg_replace("/%country%/", $country, $page_html);
	$page_html = preg_replace("/%situation%/", $situation, $page_html);
	$page_html = preg_replace("/%race%/", $race, $page_html);
	$page_html = preg_replace("/%religion%/", $religion, $page_html);
	$page_html = preg_replace("/%height%/", $height, $page_html);
	$page_html = preg_replace("/%weight%/", $weight, $page_html);
	$page_html = preg_replace("/%hair%/", $hair, $page_html);
	$page_html = preg_replace("/%eyes%/", $eyes, $page_html);
	$page_html = preg_replace("/%education%/", $education, $page_html);
	$page_html = preg_replace("/%work%/", $work, $page_html);
	$page_html = preg_replace("/%hobbies%/", $hobbies, $page_html);
	$page_html = preg_replace("/%matchage%/", $matchage, $page_html);
	$page_html = preg_replace("/%desc%/", $desc, $page_html);
	$page_html = preg_replace("/%scripturl%/", $scripturl, $page_html);
	$page_html = preg_replace("/%admin_email%/", $admin_email, $page_html);
	$page_html = preg_replace("/%ip_address%/", $ip_address, $page_html);
	print "$page_html\n";
	
}
function view($vars)
{
	global $scripturl;
	$listings = '';
	$listing_html = implode('', file('templates/listing_html.html'));
	foreach(file('users.db') as $line)
	{
		list($id, $name, $email, $url, $sex, $age, $pref, $city, $state, $country, $situation, $race, $religion, $height, $weight, $hair, $eyes, $education, $work, $hobbies, $matchage, $desc)=split("\|", $line);
		$page_html = $listing_html;
		$page_html = preg_replace("/%name%/", $name, $page_html);
		$page_html = preg_replace("/%email%/", $email, $page_html);
		$page_html = preg_replace("/%url%/", $url, $page_html);
		$page_html = preg_replace("/%sex%/", $sex, $page_html);
		$page_html = preg_replace("/%age%/", $age, $page_html);
		$page_html = preg_replace("/%pref%/", $pref, $page_html);
		$page_html = preg_replace("/%city%/", $city, $page_html);
		$page_html = preg_replace("/%state%/", $state, $page_html);
		$page_html = preg_replace("/%country%/", $country, $page_html);
		$page_html = preg_replace("/%situation%/", $situation, $page_html);
		$page_html = preg_replace("/%race%/", $race, $page_html);
		$page_html = preg_replace("/%religion%/", $religion, $page_html);
		$page_html = preg_replace("/%height%/", $height, $page_html);
		$page_html = preg_replace("/%weight%/", $weight, $page_html);
		$page_html = preg_replace("/%hair%/", $hair, $page_html);
		$page_html = preg_replace("/%eyes%/", $eyes, $page_html);
		$page_html = preg_replace("/%education%/", $education, $page_html);
		$page_html = preg_replace("/%work%/", $work, $page_html);
		$page_html = preg_replace("/%hobbies%/", $hobbies, $page_html);
		$page_html = preg_replace("/%matchage%/", $matchage, $page_html);
		$page_html = preg_replace("/%desc%/", $desc, $page_html);
		$page_html = preg_replace("/%scripturl%/", $scripturl, $page_html);
		$page_html = preg_replace("/%id%/", $id, $page_html);
		$page_html = preg_replace("/%ip_address%/", $ip_address, $page_html);

		$listings .= $page_html;

	}

	$listpage = implode('', file('templates/viewlist.html'));
	$listpage = str_replace("%scripturl%", $scripturl, $listpage );
	$listpage = str_replace("%listings%", $listings, $listpage );

	print $listpage ;
}

function view_record($vars)
{
	global $scripturl;
	$who=$vars['id'];
	foreach(file("users.db") as $line) 
	{
		list($id, $name, $email, $url, $sex, $age, $pref, $city, $state, $country, $situation, $race, $religion, $height, $weight, $hair, $eyes, $education, $work, $hobbies, $matchage, $desc)=split("\|", $line); 
		if($who == $id) 
		{
			$page_html = implode('', file('templates/view_record.html'));
			$page_html = preg_replace("/%name%/", $name, $page_html);
			$page_html = preg_replace("/%email%/", $email, $page_html);
			$page_html = preg_replace("/%url%/", $url, $page_html);
			$page_html = preg_replace("/%sex%/", $sex, $page_html);
			$page_html = preg_replace("/%age%/", $age, $page_html);
			$page_html = preg_replace("/%pref%/", $pref, $page_html);
			$page_html = preg_replace("/%city%/", $city, $page_html);
			$page_html = preg_replace("/%state%/", $state, $page_html);
			$page_html = preg_replace("/%country%/", $country, $page_html);
			$page_html = preg_replace("/%situation%/", $situation, $page_html);
			$page_html = preg_replace("/%race%/", $race, $page_html);
			$page_html = preg_replace("/%religion%/", $religion, $page_html);
			$page_html = preg_replace("/%height%/", $height, $page_html);
			$page_html = preg_replace("/%weight%/", $weight, $page_html);
			$page_html = preg_replace("/%hair%/", $hair, $page_html);
			$page_html = preg_replace("/%eyes%/", $eyes, $page_html);
			$page_html = preg_replace("/%education%/", $education, $page_html);
			$page_html = preg_replace("/%work%/", $work, $page_html);
			$page_html = preg_replace("/%hobbies%/", $hobbies, $page_html);
			$page_html = preg_replace("/%matchage%/", $matchage, $page_html);
			$page_html = preg_replace("/%desc%/", $desc, $page_html);
			$page_html = preg_replace("/%scripturl%/", $scripturl, $page_html);
			print "$page_html\n";
			exit;
		}
	}			
	$page_html = implode('', file('templates/user_not_found.html'));
	$page_html = preg_replace("/%scripturl%/", $scripturl, $page_html);
	print "$page_html\n";
}
function admin($vars)
{
	global $scripturl;
?>
<html>
<head><title>Administration</title></head>
<body><br><br>
<b>Admin login</b><br><br>
<form action=<?php echo $scripturl?> method=post>
<input type=hidden name=action value=admin_main>
Password: <input type=password name=pass><br><br>
<input type=submit value="Login to Admin">
</form>
</body>
</html>	
<?php
	exit;
}
function admin_main($vars)
{
	global $adminpass, $scripturl;
	$pass = $vars['pass'];
	$options = '';
	if($pass == $adminpass) 
	{
		foreach(file("users.db") as $line) 
		{
			list($id, $name, $email, $url, $sex, $age, $pref, $city, $state, $country, $situation, $race, $religion, $height, $weight, $hair, $eyes, $education, $work, $hobbies, $matchage, $desc)=split("\|", $line);
			$options.="<option value=$id>$name</option>\n";
		}
		$page_html=<<<EOP
<html>
<head><title>Administration</title></head>
<body>
<font size=+2><b>Admin Menu</b></font><br><br>
<b>User Deletion</b><br>
<form action=$scripturl method=POST>
<input type=hidden name=action value=delete>
<input type=hidden name=pass value=$pass>
<table>
<tr><td><select name=who> $options </select></td><td><input type=submit value="Delete User"></td></tr>
</table>
</form>
<br><br><br>
<b>Mail All Users</b><br>
<form action=$scripturl method=POST>
<input type=hidden name=action value=mail_process>
<input type=hidden name=pass value=$pass>
<table>
<tr><td>Subject:</td><td><input type=text name="subject" size="40"></td></tr>
<tr><td colspan="2">Message<br><textarea name=body rows="8" cols="40"></textarea></td></tr>
</table>
<br>
<input type=submit value="Mail Users">
</form>
<br><br><br>
</body>
</html>	


EOP;
	} else {
		$page_html=<<<EOP
<html>
<body>
<br><br>
Seems the admin password was incorrect, please use your back button to correct.
<br><br>
</body>
</html>	
EOP;
	}
	print "$page_html\n";
}

function del_entry($vars)
{
	global $adminpass;
	$pass=$vars['pass'];
	$who=$vars['who'];

	$new = array();

	if($pass == $adminpass) 
	{
		foreach(file("users.db") as $line) 
		{
			$line = rtrim($line);
			list($id, $name, $email, $url, $sex, $age, $pref, $city, $state, $country, $situation, $race, $religion, $height, $weight, $hair, $eyes, $education, $work, $hobbies, $matchage, $desc)=split("\|", $line);
			if($who != $id) 
			{
				array_push($new, $line);
			}
		}
		$fp = fopen('users.db', "w");
		foreach($new as $thing) 
		{
			fwrite($fp, "$thing\n");
		}
		fclose($fp);
		$page_html=<<<EOP
<html>
<head><title>Administration</title></head>
<body>
<br><br><br>
Operation completed.
</body>
</html>	
EOP;
	} 
	else
	{
		$page_html=<<<EOP
<html>
<body>
<br><br>
Seems the admin password was incorrect, please use your back button to correct.
<br><br>
</body>
</html>	
EOP;
	}
	print "$page_html\n";
}
function mail_process($vars)
{
	global $adminpass, $admin_email;
	$pass=$vars['pass'];
	$body=$vars['body'];
	$subject=$vars['subject'];
	if($pass == $adminpass) 
	{
		foreach(file("users.db") as $line) 
		{
			$line = rtrim($line);
			list($id, $name, $email, $url, $sex, $age, $pref, $city, $state, $country, $situation, $race, $religion, $height, $weight, $hair, $eyes, $education, $work, $hobbies, $matchage, $desc)=split("\|", $line);
			mail($email, $subject, $body, "To:$email\nFrom: PenPals <$admin_email>\n");
		}
		$page_html=<<<EOP
<html>
<head><title>Administration</title></head>
<body>
<br><br><br>
Operation completed.
</body>
</html>	
EOP;
	} else {
		$page_html=<<<EOP
<html>
<body>
<br><br>
Seems the admin password was incorrect, please use your back button to correct.
<br><br>
</body>
</html>	
EOP;
	}
	print "$page_html\n";
}
?>


