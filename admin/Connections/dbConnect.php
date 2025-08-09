<?php
require '../dconn.php';
$hostname_dbConnect = $db_server;
$database_dbConnect = $db_name;
$username_dbConnect = $db_user;
$password_dbConnect = $db_pass;

$dbConnect = mysql_pconnect($hostname_dbConnect, $username_dbConnect, $password_dbConnect) or die(mysql_error());
?>
