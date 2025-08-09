<?
require_once("config.php");

if($_GET[action] == "viewtext"){
  $result = mysql_query("SELECT respondents FROM surveys WHERE id=$_GET[survey]", $db);
  $myrow = mysql_fetch_array($result);
  $respondents = $myrow[0];

  $result = mysql_query("SELECT responses.response, count(responses.id) num_votes FROM responses WHERE question=$_GET[question] GROUP BY responses.response ORDER BY num_votes DESC", $db);
  if(mysql_num_rows($result) > 0){
    echo <<<EOT
<table border="0" width="100%" cellpadding="1" bgcolor="#CCCCCC"><tr><td>
EOT;
    while($myrow = mysql_fetch_array($result)){
      $tick++;
      $bgcolor = ($tick % 2) ? "#FFFFFF" : "#F0F0F0";
      $query = mysql_query("SELECT COUNT(*) FROM responses WHERE question=$_GET[question] AND response='$myrow[response]'", $db);
      $row = mysql_fetch_array($query);
      $percent = sprintf("%.02f", ($row[0] / $respondents) * 100);
      echo <<<EOT
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="$bgcolor">
<tr> 
<td colspan="2"><b><font face="Verdana, Arial" size="2">$myrow[response]</font></b></td>
</tr>
<tr> 
<td width="30%" align="center"><font face="Verdana, Arial" size="2">$row[0] ($percent%)</font></td>
<td><img src="$barurl" height="12" width="$percent%" alt="$percent% of respondents answered '$myrow[response]'"></td>
</tr>
</table>
EOT;
    }
  echo "</tr></td></table>";
  }
  else
    echo "There are no textual responses to this question.";
  exit;
}

if(!$_REQUEST[Submit]){

  #Do we have existing surveys?

  $result = mysql_query("SELECT id,name FROM surveys ORDER BY id ASC", $db);
  if(mysql_num_rows($result) > 0){
    $viewresults = '<SELECT name="viewresults">';
    while($myrow = mysql_fetch_array($result)){
      $viewresults .= "<OPTION value='$myrow[id]'>[$myrow[id]]: $myrow[name]</OPTION>";
    }
    $viewresults .= '</SELECT> <INPUT TYPE="submit" name="Submit" value="View Results">';
  }
  else{
    $viewresults = "[No Surveys to View Results]";
  }

  $result = mysql_query("SELECT id,name FROM surveys WHERE active=1 ORDER BY id ASC", $db);
  if(mysql_num_rows($result) > 0){
    $endsurvey = '<SELECT name="endsurvey">';
    while($myrow = mysql_fetch_array($result)){
      $endsurvey .= "<OPTION VALUE='$myrow[id]'>[$myrow[id]]: $myrow[name]</OPTION>";
    }
    $endsurvey .= '</SELECT> <INPUT TYPE="submit" name="Submit" value="End Survey">';
  }
  else{
    $endsurvey = "[No Active Surveys to End]";
  }

  $template = implode("", file("templates/admin.html"));
  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);
  $template = str_replace("%viewresults%", $viewresults, $template);
  $template = str_replace("%endsurvey%", $endsurvey, $template);
  echo $template;
  exit;
}

if($_POST[Submit] == "Create New Survey"){
  $template = implode("", file("templates/create.html"));
  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);
  echo $template;
  exit;
}

if($_POST[Submit] == "Start Adding Questions"){
  #Put this survey into the database and start adding questions
  $result = mysql_query("INSERT INTO surveys SET name='$_POST[name]'", $db);
  $result = mysql_query("SELECT LAST_INSERT_ID()", $db);
  $myrow = mysql_fetch_array($result);
  $survey = $myrow[0];

  $template = implode("", file("templates/addquestion.html"));
  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);
  $template = str_replace("%survey%", $survey, $template);

  echo $template;
  exit;
}

if($_POST[Submit] == "Save and Add Another Question"){
  #Drop the posted question into the database 
  $result = mysql_query("INSERT INTO questions SET survey=$_POST[survey], question='$_POST[question]', answermethod='$_POST[answermethod]'", $db);
  $result = mysql_query("SELECT LAST_INSERT_ID()", $db);
  $myrow = mysql_fetch_array($result);
  $question = $myrow[0];

  #Drop all related answers into the database
  if($_POST[answermethod] != "text"){ #No predefines if using user-input
    foreach($_POST[answers] as $var){
      if($var != ""){
        $result = mysql_query("INSERT INTO answers SET survey='$_POST[survey]', question=$question, answer='$var'", $db);
      }
    }
  }

  $template = implode("", file("templates/addquestion.html"));
  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);
  $template = str_replace("%survey%", $_POST[survey], $template);

  echo $template;
  exit;
}

if($_POST[Submit] == "Save and Finalize Survey"){
  #Drop the posted question into the database 
  $result = mysql_query("INSERT INTO questions SET survey=$_POST[survey], question='$_POST[question]', answermethod='$_POST[answermethod]'", $db);
  $result = mysql_query("SELECT LAST_INSERT_ID()", $db);
  $myrow = mysql_fetch_array($result);
  $question = $myrow[0];

  #Drop all related answers into the database
  if($_POST[answermethod] != "text"){ #No predefines if using user-input
    foreach($_POST[answers] as $var){
      if($var != ""){
        $result = mysql_query("INSERT INTO answers SET survey='$_POST[survey]', question=$question, answer='$var'", $db);
      }
    }
  }

  #Activate the survey
  $result = mysql_query("UPDATE surveys SET active=1 WHERE id=$_POST[survey]", $db);

  $template = implode("", file("templates/completed.html"));
  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);
  $template = str_replace("%survey%", $_POST[survey], $template);

  echo $template;
  exit;
}

if($_POST[Submit] == "End Survey"){
  #Disable a survey
  $result = mysql_query("UPDATE surveys SET active=0 WHERE id=$_POST[endsurvey]", $db);
  die("Survey ended, no new responses will be accepted.");
}

if($_POST[Submit] == "View Results"){
  #Display the results for a survey

  $result = mysql_query("SELECT name FROM surveys WHERE id=$_POST[viewresults]", $db);
  $surveyrow = mysql_fetch_array($result);

  $result = mysql_query("SELECT COUNT(*) FROM questions WHERE survey=$_POST[viewresults]", $db);
  $myrow = mysql_fetch_array($result);
  $numquestions = $myrow[0];

  $result = mysql_query("SELECT respondents FROM surveys WHERE id=$_POST[viewresults]", $db);
  $myrow = mysql_fetch_array($result);
  $respondents = $myrow[0];

  #Loop through the questions to build the list
  $questions = "";
  $qnum = 0;
  $qids = array();
  $result = mysql_query("SELECT * FROM questions WHERE survey=$_POST[viewresults] ORDER BY id ASC", $db);
  while($qrow = mysql_fetch_array($result)){
    #Determine the answers for this question
    $answers = "";
    $q = $qnum + 1;
    if($qrow[answermethod] == "text"){
      #This is a user-input answer
      $query = mysql_query("SELECT COUNT(DISTINCT response) FROM responses WHERE question=$qrow[id]", $db);
      $row = mysql_fetch_array($query);
      $answers = "$row[0] unique textual responses. <a href='$_SERVER[PHP_SELF]?action=viewtext&survey=$_POST[viewresults]&question=$qrow[id]' target='_blank'>Click here</a> to view them all in a new window.";
    }
    else{
      #Build the answers
      $answerquery = mysql_query("SELECT * FROM answers WHERE survey='$_POST[viewresults]' AND question='$qrow[id]'", $db);
   #   if($qrow[answermethod] == "list"){
   #     $answers = "<SELECT NAME='answer$qrow[id]'>";
   #   }
      while($answerrow = mysql_fetch_array($answerquery)){
        $query = mysql_query("SELECT COUNT(*) FROM responses WHERE question=$qrow[id] AND answer=$answerrow[id]", $db);
        $row = mysql_fetch_array($query);
        $number = $row[0];
        $percent = sprintf("%.02f", ($number / $respondents) * 100);
        $tick++;
        $bgcolor = ($tick % 2) ? "#FFFFFF" : "#F0F0F0";
        $answers .= <<<EOT
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="$bgcolor">
<tr> 
<td colspan="2"><b>$answerrow[answer]</b></td>
</tr>
<tr> 
<td width="30%" align="center">$number ($percent%)</td>
<td><img src="$barurl" height="12" width="$percent%" alt="$percent% of respondents answered '$answerrow[answer]'"></td>
</tr>
</table>
EOT;
      }
    }

    $template = implode("", file("templates/view-question.html"));
    $template = str_replace("%qnum%", $q, $template);
    $template = str_replace("%numquestions%", $numquestions, $template);
    $template = str_replace("%question%", $qrow[question], $template);
    $template = str_replace("%answers%", $answers, $template);
    $questions .= $template;
    $qnum++;
    array_push($qids, $qrow[id]);
  }

  #Build the list of question IDs to place in the form as a hidden field
  foreach($qids as $var){
    $questionids .= "<INPUT type='HIDDEN' name='qids[]' value='$var'>";
  }

  $template = implode("", file("templates/view-results.html"));
  $template = str_replace("%surveyname%", $surveyrow[name], $template);
  $template = str_replace("%respondents%", $respondents, $template);
  $template = str_replace("%questions%", $questions, $template);

  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);

  echo $template;
  exit;
}

?>