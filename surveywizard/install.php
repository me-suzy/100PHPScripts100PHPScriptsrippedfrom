<?
require_once("config.php");

echo "<b>Beginning Survey Wizard Installation...</b><br><br>";

if(!$result = mysql_query("create table surveys(id integer auto_increment not null, name varchar(255) not null, respondents integer unsigned default 0, active tinyint(1), primary key(id, name))", $db))
  die("Error creating a table named 'surveys' on $dbname. Check your MySQL permissions.");
else
  echo "Successfully created a table named 'surveys' on $dbname!<br>";

if(!$result = mysql_query("create table questions(id integer auto_increment not null, survey integer not null, question text, answermethod varchar(255), primary key(id, survey))", $db))
  die("Error creating a table named 'questions' on $dbname. Check your MySQL permissions.");
else
  echo "Successfully created a table named 'questions' on $dbname!<br>";

if(!$result = mysql_query("create table answers(id integer auto_increment not null, survey integer not null, question integer not null, answer text, primary key(id, survey, question))", $db))
  die("Error creating a table named 'answers' on $dbname. Check your MySQL permissions.");
else
  echo "Successfully created a table named 'answers' on $dbname!<br>";

if(!$result = mysql_query("create table responses(id integer auto_increment not null, question integer not null, answer integer not null default 0, response text, email varchar(255), primary key(id))", $db))
  die("Error creating a table named 'responses' on $dbname. Check your MySQL permissions.");
else
  echo "Successfully created a table named 'responses' on $dbname!<br>";

echo "<br><b>Survey Wizard has been installed successfully!</b>";
?>