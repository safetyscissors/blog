<?php
/* ************************************************************* *\
                    COMMENT SERVICE FUNCTIONS
\* ************************************************************* */
function getCommentList($DB, $bid){
  $stmt = $DB->prepare("SELECT commentId,commentDate,commentName,commentHtml FROM comment WHERE commentFkId = ? ORDER BY commentDate DESC");
  
  if(!$stmt->bind_param('i', $bid)){
    return errorHandler("getComment failed to bind parameter", 503);
  }
  return $stmt;
}

function createComment($DB, $bid, $name, $html){
  $stmt = $DB->prepare("INSERT INTO comment (commentFkId,commentName,commentHtml) VALUES (?,?,?)");

  if(!$stmt->bind_param('iss', $bid, $name, $html)){
    return errorHandler("createComment failed to bind parameter", 503);
  }
  return $stmt;
}

function deleteComment($DB, $cid){
  $stmt = $DB->prepare("DELETE FROM comment WHERE commentId=?");
  if(!$stmt->bind_param('i', $cid)){
    return errorHandler("deleteComment failed to bind parameter", 503);
  }
  return $stmt;
}

?>