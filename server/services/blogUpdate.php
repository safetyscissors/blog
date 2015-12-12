<?php
  require('authCheck.php');
  if(!isset($USER->id)) return;
  require('queries/blogQueries.php');
  $PAGE->id='blogUpdate';

  $fields=array('blogid','name', 'title','desc','html','feature');
  $requiredFields=array('blogid');
  $inputs=array();
  parse_str(file_get_contents("php://input"),$_PUT);

  //check POST object for variables from front end
  foreach($fields as $postKey){
    if(isset($_PUT[$postKey])){
      $inputs[$postKey]=$_PUT[$postKey];
    }
  }

  //check inputs for all required fields 
  foreach($requiredFields as $postKey){
    if(!isset($inputs[$postKey]) || empty($inputs[$postKey])){
      return errorHandler("missing $postKey", 503);
    }
  }

  //print debug statement
  if($SERVERDEBUG){
    echo "\r\n inputs:";
    echo json_encode($inputs);
  }

  //setup for query
  if(!isset($inputs['html'])){
    $stmt = updateBlogAdmin($DB, $inputs['name'], $inputs['desc'], $inputs['title'], $inputs['blogid']);
  }else{
    $stmt = updateBlog($DB, $inputs['name'], $inputs['desc'], $inputs['title'], $inputs['html'], $inputs['feature'], $inputs['blogid']);
  }
  if(!$stmt) return; // createNewList already send error.
  if(!$stmt->execute()) return errorHandler("failed to create this list $stmt->errno: $stmt->error");

  if($stmt->affected_rows != 1){
    return errorHandler("Updated $stmt->affected_rows rows", 503);
  }
?>  