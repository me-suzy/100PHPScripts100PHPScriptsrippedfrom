<?php

require 'include.inc';
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

#$db_user = 'tony';
#$db_pass = 'spleen72';
#$db_name = 'mishies';

$hostname_dbConnect = $db_server;
$database_dbConnect = $db_name;
$username_dbConnect = $db_user;
$password_dbConnect = $db_pass;

#$hostname_dbConnect = "localhost";
#$database_dbConnect = "mishies";
#$username_dbConnect = "molebrain";
#$password_dbConnect = "spleen72";
$dbConnect = mysql_pconnect($hostname_dbConnect, $username_dbConnect, $password_dbConnect) or die(mysql_error());
?>
