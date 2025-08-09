<?php
#
#AutoMail common functions and variables
#
#########################################################
#                     AutoMail                          #
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

#Format output for console or web?
$nl = ((isset($_SERVER["REMOTE_ADDR"])) ? "<br>" : "\n"); 
$b = ((isset($_SERVER["REMOTE_ADDR"])) ? "<b>" : "*"); 
$eb = ((isset($_SERVER["REMOTE_ADDR"])) ? "</b>" : "*"); 

#AutoMail common functions

#sql_connect returns a connection to the appropriate database
function sql_connect(){
  if($GLOBALS["sqltype"] == "mysql")
    return mysql_connect($GLOBALS["sqlhost"], $GLOBALS["sqluser"], $GLOBALS["sqlpass"]);
}

#sql_select performs a database select and returns the reference
#params: $name (name of database to select), $link (connection to database)
function sql_select($name, $link){
  if($GLOBALS["sqltype"] == "mysql")
    return mysql_select_db($name, $link);
}

#sql_query sends a query to the database and returns the results
#params: $query (SQL query to be sent), $link (connection to database)
function sql_query($query, $link){
  if($GLOBALS["sqltype"] == "mysql")
    return mysql_query($query, $link);
}

#sql_fetch_array returns an array containing the values of the specified row 
#params: $row (the SQL row to be fetched)
function sql_fetch_array($row){
  if($GLOBALS["sqltype"] == "mysql")
    return mysql_fetch_array($row);
} 

#error displays an error message
#params: $type (the type of error), $error (the error message)
function error($type, $error){
  echo $GLOBALS["nl"] . $GLOBALS["b"] . "$type Error:" . $GLOBALS["eb"] . " $error" . $GLOBALS["nl"] . $GLOBALS["nl"];
}

#passcheck determines whether or not the access attempt is authorized
#params: $pass (unencrypted password), $db (link to database)
#returns: -1 for firstrun (no pass), 0 for pass mismatch, 1 if pass matches
function passcheck($pass, $db){
if($optresult = @sql_query("SELECT password FROM options", $db)){
  if($myrow = @sql_fetch_array($optresult)){
    if($myrow[password] == "q")
      return 1;
    if($myrow[password] == ""){
      echo <<<EOT
<p><font face="Verdana, Arial" size="2">This appears to be your first time running 
AutoMail. Before you can proceed, you must set an administrative password.</font></p><form name="password" method="post" action="options.php"><table width="50%" border="0" cellspacing="0" cellpadding="0"><tr><td width="50%"><font face="Verdana, Arial" size="2">Password:</font></td><td> <font face="Verdana, Arial" size="2"><input type="password" name="passwd1"></font></td></tr><tr><td><font face="Verdana, Arial" size="2">Verify:</font></td><td> <font face="Verdana, Arial" size="2"><input type="password" name="passwd2"></font></td></tr><tr><td>&nbsp;</td><td><input type="hidden" name="changepass"><input type="submit" name="Submit" value="Set Password"></td></tr></table><div align="left"></div></form>
EOT;
      return -1;
    }
    else{
      if(!(md5($pass) == $myrow[password])){
        return 0;
      }
      if(md5($pass) == $myrow[password]){
        return 1;
      }
    }
  }
}
else
  die(error("Fatal", "Could not query the database!"));
}

#getoptions retreives the options settings from the database
#returns: array of options settings
#params: $db (link to db)
function getoptions($db){
  $result = @sql_query("SELECT * FROM options", $db);
  $myrow = @sql_fetch_array($result);
  return $myrow;  
}

#sendmsg sends an email message
#params: $recipient (recipient info array), $msgnum (# of msg to send), $db (link to DB)
function sendmsg($recipient, $msgnum, $db){
  extract($GLOBALS);
  #Select the appropriate message
  $result = @sql_query("SELECT * FROM messages ORDER BY id LIMIT $msgnum", $db);
  while($i<$msgnum){
    $myrow = @sql_fetch_array($result);
    $i++;
  }
  $options = getoptions($db);
  #Determine the message subject
  $subject = $myrow[subject];
  #Determine the message body
  $body = $myrow[message];
  if($recipient[name]){
    $body = str_replace("%%NAME%%", $recipient[name], $body);
    $subject= str_replace("%%NAME%%", $recipient[name], $subject);
  }
  else{
    $body = str_replace("%%NAME%%", $recipient[email], $body);
    $subject= str_replace("%%NAME%%", $recipient[email], $subject);
  }

  #Tack the removal URL on to the end of the body
  $remove = "\n\n--\nYou are receiving this message as a subscriber to the "
          . "$options[listname] mailing list. To stop receiving mail from this "
          . "list, visit:\n\n$options[userscripturl]?e=$recipient[email]&i="
          . "$recipient[id]";
  $body .= $remove;
  #Determine the mail headers
  $headers = $options[headers];
  if($headers)
    $headers .= "\n";
  $headers .= "X-Mailer: AutoMail v $version (http://www.phpselect.com/)";
  $headers .= "\nX-Envelope-Recipient: $recipient[email]";
  $headers .= "\nFrom: $options[fromaddr]";
  $envelope = "-f$options[fromaddr]";
  mail($recipient[email], $subject, $body, $headers, $envelope);  
}


#sendmsgnow sends an email message immediately
#params: $recipient (recipient info array), $msgnum, $db (link to DB)
function sendmsgnow($recipient, $msgnum, $db){
  extract($GLOBALS);
  #Select the appropriate message
  $result = @sql_query("SELECT * FROM messages ORDER BY id LIMIT $msgnum", $db);
  while($i<$msgnum){
    $myrow = @sql_fetch_array($result);
    $i++;
  }
  $options = getoptions($db);
  #Determine the message subject
  $subject = $myrow[subject];
  #Determine the message body
  $body = $myrow[message];
  if($recipient[name]){
    $body = str_replace("%%NAME%%", $recipient[name], $body);
    $subject= str_replace("%%NAME%%", $recipient[name], $subject);
  }
  else{
    $body = str_replace("%%NAME%%", $recipient[email], $body);
    $subject= str_replace("%%NAME%%", $recipient[email], $subject);
  }

  #Tack the removal URL on to the end of the body
  $remove = "\n\n--\nYou are receiving this message as a subscriber to the "
          . "$options[listname] mailing list. To stop receiving mail from this "
          . "list, visit:\n\n$options[userscripturl]?e=$recipient[email]&i="
          . "$recipient[id]";
  $body .= $remove;
  #Determine the mail headers
  $headers = $options[headers];
  if($headers)
    $headers .= "\n";
  $headers .= "X-Mailer: AutoMail v $version (http://www.phpselect.com/)";
  $headers .= "\nX-Envelope-Recipient: $recipient[email]";
  $headers .= "\nFrom: $options[fromaddr]";
  $envelope = "-f$options[fromaddr]";
  mail($recipient[email], $subject, $body, $headers, $envelope);  
}


?>