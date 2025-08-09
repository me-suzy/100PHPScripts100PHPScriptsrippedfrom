<?
// ADD BOUGHT POINTS
require 'include.inc';
$myname = $contact_name; 
$myemail = $contact_email; 
$siterep = $zz;

$u = $username;
$i = $userid;
// send admin a message
$message = "Hello <BR>Somebody has complained about a website on your hit xchange.  The ID number is:".$siterep."<BR><BR>You should investigate";
$subject = $title." REPORT MESSAGE"; 
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: ".$myname." <".$myemail.">\r\n"; 
$headers .= "To: ".$myname." <".$myemail.">\r\n"; 
$headers .= "Reply-To: ".$myname." <$myreplyemail>\r\n"; 
$headers .= "X-Priority: 1\r\n"; 
$headers .= "X-MSMail-Priority: High\r\n"; 
$headers .= "X-Mailer: Just My Server"; 

mail($myemail, $subject, $message, $headers);
		
		// redirect to main page
		header("Location: surf.php?&userid=".$i."&username=".$u); 
?>
