<?php
  require('authCheck.php');
  if(!isset($USER->id)) return;
  require('queries/pageQueries.php');
  $PAGE->id='pageCreate';

  $fields=array('name','desc','title');
  $inputs=array();

  //check POST object for variables from front end
  foreach($fields as $postKey){
    if(isset($_POST[$postKey]) && !empty($_POST[$postKey])){
      $inputs[$postKey]=$_POST[$postKey];
    }else{
		  return errorHandler("missing $postKey", 503);
    }
  }

  //print debug statement
  if($SERVERDEBUG){
    echo "\r\n inputs:";
    echo json_encode($inputs);
  }

  //setup for query
  $stmt = createPage($DB, $inputs['name'], $inputs['desc'], $inputs['title']);
  if(!$stmt) return; // createNewList already send error.
  if(!$stmt->execute()) return errorHandler("failed to create this user $stmt->errno: $stmt->error");
  echo '{"id":"'.$stmt->insert_id.'"}';
  
?>