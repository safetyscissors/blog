<?php
  //setup login. if it has no time, or time is older than 1 day, logout
  if(!isset($_SESSION['time'])){ //|| $_SESSION['time'] > (time() + (24*60*60)){
    return errorHandler('unauthorized',401);
  }else{
	  $USER->id=$_SESSION['userId'];
	  $USER->name=$_SESSION['userName'];

	  $result = array();
	  $result['userid'] = $USER->id;
	  echo json_encode($result);
	}
?>
