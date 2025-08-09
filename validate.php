<?php
session_start();
    	require 'include.inc';
	$uname = $_POST['uname'];
	$password = $_POST['password'];

	//set up the query
	$query = "SELECT * FROM user
			WHERE username='$uname' AND password='$password' and verified='y'";
			
	//run the query and get the number of affected rows


	$result = mysql_query($query, $connection) or die('error making query');
	$affected_rows = mysql_num_rows($result);

	//if there's exactly one result, the user is validated. Otherwise, he's invalid
	if($affected_rows == 1) {
	
				$_SESSION['letmein'] = true;
				$result = mysql_query("SELECT id, username AS uuname FROM user where username='$uname'",$connection);
				if ($myrow = mysql_fetch_array($result)) {

    						$_SESSION["id"]=$myrow['id'];
    						$_SESSION["username"]=$myrow['uuname'];

  			header("Location: start.php?option=main"); 
					} else {

						echo "Sorry, no records were found!";	

					}
		
		
		}  else {
		echo mysql_error();
		header ("Location: index.php?invalid=invalid username/password");
	}
?>
