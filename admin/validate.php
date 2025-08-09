<?php require_once('Connections/dbConnect.php'); ?>
<?php
session_start();
 

	$username = $_POST['username'];
	$password = $_POST['password'];

	//set up the query
	$query = "SELECT * FROM admin 
			WHERE username='$username' AND password='$password'";
			
	//run the query and get the number of affected rows
mysql_select_db($database_dbConnect, $dbConnect);

	$result = mysql_query($query, $dbConnect) or die('error making query');
	$affected_rows = mysql_num_rows($result);

	//if there's exactly one result, the user is validated. Otherwise, he's invalid
	if($affected_rows == 1) {
	
		$_SESSION['letmein'] = true;
		header("Location: mainTemplate.php?option=XXXX"); 
		}  else {
		echo mysql_error();
		header ("Location: index.php?invalid=invalid username/password");
	}
?>

