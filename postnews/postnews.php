<?
#########################################################
#                       PostNews                        #
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

#Set newsserver to your news server's hostname or IP
$newsserver = "news-server";

#Set newsuser to your news server username, if required
$newsuser = "";

#Set newspass to your news server password, if required
$newspass = "";

#######################################################################
#Editing below is not required
#######################################################################

function post_it(){
  global $newsuser,$newspass,$newsserver;

  $subject = stripslashes($_POST[subject]);
  $body = wordwrap(stripslashes($_POST[body]));

  #Build the headers
  $senddate = date("d M y h:i:s -0600");
  srand((double)microtime() * 1000000);
  $headers = "From: $_POST[fromaddr] ($_POST[fromnick])\r\nNewsgroups: $_POST[newsgroups]\r\nDate: $senddate\r\nSubject: $subject\r\nX-No-Confirm: Yes\r\nX-Posting-Agent: PostNews (http://phpselect.com/scripts.php?script=PostNews)\r\n";

  #Generate Message-ID
  $headers .= "Message-ID: <" . uniqid("news") . '.' . time() . "@example.com>\r\n";

  #Send the post

  if(!$sock = fsockopen($newsserver, 119, &$err, &$errno, 10))
    die("Error connecting to server: $err ($errno)\n\n");

  $reply = fgets($sock, 1024);

  if($newsuser){
    fputs($sock, "authinfo user $newsuser\r\n");
    $reply = fgets($sock, 1024);
    fputs($sock, "authinfo pass $newspass\r\n");
    $reply = fgets($sock, 1024);
  }

  fputs($sock, "post\r\n");
  $reply = fgets($sock, 1024);

  fputs($sock, "$headers\r\n");
  fputs($sock, "$body\r\n.\r\n\r\n");
  $reply = fgets($sock, 1024);

  if(!ereg("240", $reply))
    echo "Your post was not made, server said $reply.<hr>";
  else{ 
    echo "Your post should appear in Usenet shortly.<hr>";
  }
}

echo <<<EOT
<html>
<head>
<title>PostNews from PHP Labs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<h3><font face="Verdana, Arial">PostNews from PHP Labs</font></h3><font face="Verdana, Arial" size="2">
EOT;

if($_POST[submit])
  post_it();

dopage();

function dopage(){
  echo <<<EOT
<form name="form1" method="post" action="">
<table width="95%" border="0" cellspacing="0" cellpadding="1" align="center">
<tr> 
<td width="20%"><font face="Verdana, Arial" size="2"><b>From Address</b>:</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="fromaddr" size="50" value="user@example.com">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2"><b>From Nickname</b>:</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="fromnick" size="50" value="PostNews User">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2"><b>Newsgroups</b>:</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="newsgroups" size="50" value="alt.test,alt.alt.test">
(separate with commas)</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2"><b>Subject</b>:</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="subject" size="50" value="Test Posting"></font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">&nbsp;</font></td>
<td><font face="Verdana, Arial" size="2">&nbsp;</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2"><b>Message</b>:</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<textarea name="body" cols="65" rows="8"></textarea>
</font></td>
</tr>
<tr> 
<td colspan="2">
<center>
<input type="submit" name="submit" value="Post Message">
</center>
</td>
</tr>
</table>
</form>
<p align="center"><font face="Verdana, Arial" size="1">PostNews, Copyright &copy; 
2003 <a href="http://www.phpselect.com/"> <b>PHP Labs</b></a></font></p>
</body>
</html>
EOT;
}
?>
