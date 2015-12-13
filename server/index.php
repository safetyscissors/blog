<?php

/* ********************************************************************* *\
        MAIN SERVER
\* ********************************************************************* */
  //setup session 
  session_start();

  //setup database connection
  require('dbConfig.php');

  //setup global object
  $USER = new stdClass();
  $PAGE = new stdClass();

  //get path to a service
  $service = getRoute(getUri());

  //set the debug flag
  $SERVERDEBUG = setDebug();

  //exit with msg if path doesnt exist
  if($service==false) return errorHandler('Invalid Path', 501);

  //if path was valid, load service
  require($service);

  //if debug, dump server response
  if($SERVERDEBUG){
    echo "\r\n page:";
    echo json_encode($PAGE); return;
  }

  //at the end of it all, close db
  $DB->close();


/* ********************************************************************* *\
          HELPER FUNCTIONS
\* ********************************************************************* */
  function setDebug(){
    if($_GET['debug']=="true"){
      return true;
    }
    return false;
  }

  /*
    Reads a method:path string and returns a path to a service OR false
    param $path string
    returns string || false
  */
  function getRoute($path){
    $serviceDir = "services";
    $path=strToLower($path);
    switch($path){
      case "get:":
      case "get:index.php": return "$serviceDir/main.php";
      case "get:healthcheck": return "$serviceDir/healthCheck.php";

      case "get:page": return "$serviceDir/pageGet.php"; //auth not needed.
      case "get:pagelist": return "$serviceDir/pagelistGet.php"; //auth not needed.
      case "get:menu": return "$serviceDir/pageMenuGet.php"; //auth not needed.
      case "post:page": return "$serviceDir/pageCreate.php";
      case "put:page": return "$serviceDir/pageUpdate.php";
      case "delete:page": return "$serviceDir/pageDelete.php";

      case "get:comment": return "$serviceDir/commentGet.php"; //auth not needed.
      case "post:comment": return "$serviceDir/commentCreate.php"; //auth not needed.
      case "delete:comment": return "$serviceDir/commentDelete.php";

      case "get:blog": return "$serviceDir/blogGet.php"; //auth not needed.
      case "get:list": return "$serviceDir/blogListGet.php"; //auth not needed.
      case "post:blog": return "$serviceDir/blogCreate.php";
      case "put:blog": return "$serviceDir/blogUpdate.php";
      case "delete:blog": return "$serviceDir/blogDelete.php";

      case "post:user": return "$serviceDir/userCreate.php";
      case "get:user": return "$serviceDir/userGet.php";
      case "get:userlist": return "$serviceDir/userlistGet.php";
      case "put:user": return "$serviceDir/userUpdate.php";
      case "delete:user": return "$serviceDir/userDelete.php";

      case "get:auth": return "$serviceDir/authCheckResponse.php";
      case "post:auth": return "$serviceDir/authLogin.php"; //auth not needed
      case "put:auth": return "$serviceDir/authNewPassword.php";
      case "delete:auth": return "$serviceDir/authLogout.php"; 
    }
    return false;
  }

  /*
    Reads SERVER var requestUri and requestMethod and returns a route string
    returns string [method:path]
  */
  function getUri(){
    $uri=explode("/",$_SERVER[REQUEST_URI]);

    //get rid of extra directory depth
    array_shift($uri);
    array_shift($uri);
    $uri=join("/",$uri);

    //get rid of param string
    $uri=explode("?",$uri);
    $params=$uri[1];
    $uri=$uri[0];

    //get GET params
    $params=split("&",$params);
    foreach($params as $param){
      $param=split("=",$param);
      $_GET[$param[0]]=$param[1];
    }

    $method=$_SERVER['REQUEST_METHOD'];
    return "$method:$uri";
  }

  /*
    Prints a message, sets the response error code
  */
  function errorHandler($message, $code){
    echo '{"errors":"'.$message.'"}';
    http_response_code($code);
    return false;
  }

?>
