<?
require_once("processors.php");

#The following variable is set here to ensure we are in TEST MODE
$merchanttest = "true";

if($_POST[process]){
  #The form was submitted. We need to attempt the transaction.

  #Send the transaction to Authorize.net
  $results = authorize($_POST[fname], $_POST[lname], $_POST[company], $_POST[address1],
     $_POST[address2], $_POST[city], $_POST[state], $_POST[zip], $_POST[country], 
     $_POST[phone], $_POST[email], $_POST[cardnumber], $_POST[month], $_POST[year], 
     19.95, "One Foo Widget");

  #Determine whether or not the transaction was processed
  if(eregi("1", $results[x_response_code])){
    echo "The transaction was processed successfully! Here, you would do whatever needs done when an order is successful, for example, emailing yourself the details of the order. Here is the array of data returned by Authorize.net regarding this transaction:<br><br>"; var_dump($results);
  }
  else{
    echo "The transaction was NOT successful! Here, you would do whatever needs done when an order fails, for example, displaying a 'We're Sorry' page to the user. Here is the array of data returned by Authorize.net regarding this transaction:<br><br>"; var_dump($results);
  }

  exit;
}


else{
  #The form was not submitted. Display the order form.
echo <<<EOT
<html>
<head>
<title>AuthorizeIt Sample</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<h3><font face="Verdana, Arial">PHP Labs AuthorizeIt Sample Form</font></h3>
<form name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr> 
<td colspan="2">
<p><font face="Verdana, Arial" size="2">Place your order today for a Foo Widget 
for only $19.95! </font></p>
<p><font face="Verdana, Arial" size="2">(Note, this is a test form, you will not 
be billed as long as you have $merchanttest = &quot;true&quot; in processors.php. 
Enter 4007000000027
as your credit card number, and some date in the future 
as the expiration date.)</font></p>
</td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">Your name:</font></td>
<td><font face="Verdana, Arial" size="2">First: 
<input type="text" name="fname" value="Test">
Last: 
<input type="text" name="lname" value="Test">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">Street address 1:</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="address1" size="50" value="Test">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">Street address 2:</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="address2" size="50" value="Test">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">City, State, ZIP</font></td>
<td> <font face="Verdana, Arial" size="2">C 
<input type="text" name="city" value="Test">
S 
<input type="text" name="state" size="5" maxlength="2" value="DC">
Z 
<input type="text" name="zip" size="15" maxlength="11" value="20050">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">Country</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="country" value="US">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">Phone Number</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="phone" value="202-555-1212">
</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">Credit Card Number</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<input type="text" name="cardnumber" size="50" value="4007000000027">
(Use default)</font></td>
</tr>
<tr> 
<td><font face="Verdana, Arial" size="2">Expiration Date</font></td>
<td> <font face="Verdana, Arial" size="2"> 
<select name="month">
<option value="01">01</option>
<option value="02" selected>02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
/ 
<select name="year">
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005" selected>2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
</select>
(Use default)</font></td>
</tr>
<tr> 
<td><font size="2"></font></td>
<td><font size="2"></font></td>
</tr>
<tr> 
<td colspan="2"> 
<center>
<font face="Verdana, Arial"> <font size="1">Click &quot;Process Order&quot; one 
time only</font><br>
<input type="hidden" name="process" value="1">
<input type="submit" name="Submit" value="Process Order">
</font> 
</center>
</td>
</tr>
</table>
</form>
<p>&nbsp; </p>
</body>
</html>
EOT;
}