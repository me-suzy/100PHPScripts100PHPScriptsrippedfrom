<?
require_once("config.php");

if(!$_REQUEST[sid]){
  #Show the list of surveys
  $result = mysql_query("SELECT * FROM surveys WHERE active=1", $db);
  if(mysql_num_rows($result) > 0){
    while($myrow = mysql_fetch_array($result)){
      $numsurveys++;
      $list .= "<a href='$_SERVER[PHP_SELF]?sid=$myrow[id]'>$myrow[name]</a><br><br>";
    }
    if($numsurveys == 1)
      $numsurveys = "There is $numsurveys active survey. To take this survey, click its name below.";
    else
      $numsurveys = "There are $numsurveys active surveys. To take a survey, click its name in the list below.";
  }
  else{
    $numsurveys = "We're sorry, but there are no active surveys.";
  }

  $template = implode("", file("templates/listall.html"));
  $template = str_replace("%numsurveys%", $numsurveys, $template);
  $template = str_replace("%surveylist%", $list, $template);
  echo $template;
  exit;
}

if($_POST[action] == "COMPLETED"){
  #Increment the number of respondents for this survey
  $result = mysql_query("SELECT respondents FROM surveys WHERE id=$_POST[sid]", $db);
  $myrow = mysql_fetch_array($result);
  $respondents = $myrow[respondents] + 1;
  $result = mysql_query("UPDATE surveys SET respondents = $respondents WHERE id=$_POST[sid]", $db);

  #Loop through the question IDs recording the answers as appropriate

  foreach($_POST[qids] as $var){
    #Determine this question's answermethod
    $result = mysql_query("SELECT answermethod FROM questions WHERE id=$var", $db);
    $myrow = mysql_fetch_array($result);

    switch($myrow[answermethod]){
      #Select list or radio button will always generate ONE answer which
      #corresponds to an answer ID number
      case "list":
      case "radio":
        #We have ONE answer corresponding to a numeric answer ID
        $response = $_POST["answer$var"]; 
        if($response != ""){
          $query = mysql_query("INSERT INTO responses SET question=$var, answer=$response", $db);
        }
        break;

      #Check box may have zero or multiple answers, so we have to insert
      #each one into the database
      case "check":
        if(count($_POST["answer$var"]) > 0){
          foreach($_POST["answer$var"] as $checkbox){
           $query = mysql_query("INSERT INTO responses SET question=$var, answer=$checkbox", $db);
          }
        }
        break;

      #Text must be inserted into the response text field
      case "text":
        $response = $_POST["answer$var"];
        if($response != ""){
          $query = mysql_query("INSERT INTO responses SET question=$var, answer=0, response='$response'", $db);
        }
        break;
    }
  }

  $template = implode("", file("templates/thankyou.html"));
  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);
  $template = str_replace("%sid%", $_POST[sid], $template);
  echo $template;

  exit;
}




if($_GET[view] == "results"){
  #Display the results for a survey

  if($publicresults == 0){ 
    die("Sorry, the administrator has specified that survey results may not be viewed by the public.");
  }

  $result = mysql_query("SELECT name FROM surveys WHERE id=$_GET[sid]", $db);
  $surveyrow = mysql_fetch_array($result);

  $result = mysql_query("SELECT COUNT(*) FROM questions WHERE survey=$_GET[sid]", $db);
  $myrow = mysql_fetch_array($result);
  $numquestions = $myrow[0];

  $result = mysql_query("SELECT respondents FROM surveys WHERE id=$_GET[sid]", $db);
  $myrow = mysql_fetch_array($result);
  $respondents = $myrow[0];

  #Loop through the questions to build the list
  $questions = "";
  $qnum = 0;
  $qids = array();
  $result = mysql_query("SELECT * FROM questions WHERE survey=$_GET[sid] ORDER BY id ASC", $db);
  while($qrow = mysql_fetch_array($result)){
    #Determine the answers for this question
    $answers = "";
    $q = $qnum + 1;
    if($qrow[answermethod] == "text"){
      #This is a user-input answer
      $query = mysql_query("SELECT COUNT(DISTINCT response) FROM responses WHERE question=$qrow[id]", $db);
      $row = mysql_fetch_array($query);
      $answers = "$row[0] unique textual responses. Only the administrator may view them.";
    }
    else{
      #Build the answers
      $answerquery = mysql_query("SELECT * FROM answers WHERE survey='$_GET[sid]' AND question='$qrow[id]'", $db);
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




if(!$_POST[action]){
  #Display this survey

  $result = mysql_query("SELECT name FROM surveys WHERE id=$_GET[sid] AND active=1", $db);
  if(mysql_num_rows($result) <= 0){
    die("The survey ID you specified is invalid, or reflects a survey which has been closed by the administrator.");
  }
  $surveyrow = mysql_fetch_array($result);

  $result = mysql_query("SELECT COUNT(*) FROM questions WHERE survey=$_GET[sid]", $db);
  $myrow = mysql_fetch_array($result);
  $numquestions = $myrow[0];

  #Loop through the questions to build the list
  $questions = "";
  $qnum = 0;
  $qids = array();
  $result = mysql_query("SELECT * FROM questions WHERE survey=$_GET[sid] ORDER BY id ASC", $db);
  while($qrow = mysql_fetch_array($result)){
    #Determine the answers for this question
    $answers = "";
    $q = $qnum + 1;
    if($qrow[answermethod] == "text"){
      #This is a user-input answer
      $answers = "<input type='text' name='answer$qrow[id]' size='50'>";
    }
    else{
      #Build the answers
      $answerquery = mysql_query("SELECT * FROM answers WHERE survey='$_GET[sid]' AND question='$qrow[id]'", $db);
      if($qrow[answermethod] == "list"){
        $answers = "<SELECT NAME='answer$qrow[id]'>";
      }
      while($answerrow = mysql_fetch_array($answerquery)){
        switch($qrow[answermethod]){
          case "list":
            $answers .= "<OPTION value='$answerrow[id]'>$answerrow[answer]</OPTION>";
            break;
          case "check":
            $answers .= "<INPUT type='checkbox' name='answer$qrow[id]" . "[]' value='$answerrow[id]'>$answerrow[answer] ";
            break;
          case "radio":
            $answers .= "<INPUT type='radio' name='answer$qrow[id]' value='$answerrow[id]'>$answerrow[answer] ";
            break;
        }
      }
      if($qrow[answermethod] == "list"){
        $answers .= "</SELECT>";
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

  $template = implode("", file("templates/view-main.html"));
  $template = str_replace("%surveyname%", $surveyrow[name], $template);
  $template = str_replace("%numquestions%", $numquestions, $template);
  $template = str_replace("%questions%", $questions, $template);
  $template = str_replace("%sid%", $_GET[sid], $template);
  $template = str_replace("%qids%", $questionids, $template);
  $template = str_replace("%phpself%", $_SERVER[PHP_SELF], $template);

  echo $template;
  exit;
}


?>