<?php
/* ************************************************************* *\
                    USER SERVICE FUNCTIONS
\* ************************************************************* */

	function getUser($DB, $uid){
    $stmt = $DB->prepare("SELECT userId,userName,userEmail,userHash FROM user WHERE userId = ?");
    if(!$stmt->bind_param('i', $uid)){
      return errorHandler("getUsers failed to bind parameter", 503);
    }
    return $stmt;
	}

  function getUserList($DB){
    $stmt = $DB->prepare("SELECT userId,userName,userEmail FROM user");
    return $stmt;
  }

  function createUser($DB, $email, $name, $passwordHash){
    $stmt = $DB->prepare("INSERT INTO user (userName,userEmail,userHash) VALUES (?,?,?)");

    if(!$stmt->bind_param('sss', $name, $email, $passwordHash)){
      return errorHandler("createUser failed to bind parameter", 503);
    }
    return $stmt;
  }

  function updateUser($DB, $uid, $email, $name){
    $stmt = $DB->prepare("UPDATE user SET userEmail=?, userName=? WHERE userId=?");

    if(!$stmt->bind_param('ssi', $email, $name, $uid)){
      return errorHandler("updateUser failed to bind parameter", 503);
    }
    return $stmt;
  }

  function deleteUser($DB, $uid){
    $stmt = $DB->prepare("DELETE FROM user WHERE userId=?");
    if(!$stmt->bind_param('i', $uid)){
      return errorHandler("deleteItem failed to bind parameter", 503);
    }
    return $stmt;
  }

/* ************************************************************* *\
                    AUTH SERVICE FUNCTIONS
\* ************************************************************* */

  function getUserByEmail($DB, $email){
    $stmt = $DB->prepare("SELECT userId,userName,userHash FROM user WHERE userEmail = ?");
    if(!$stmt->bind_param('s', $email)){
      return errorHandler("getUsers failed to bind parameter", 503);
    }
    return $stmt;
  }

  function updateUserPassword($DB, $uid, $passwordHash){
    $stmt = $DB->prepare("UPDATE user SET userHash=? WHERE userId=?");
    
    if(!$stmt->bind_param('si', $passwordHash, $uid)){
      return errorHandler("updateList failed to bind parameter", 503);
    }
    return $stmt;
  }
?>