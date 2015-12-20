<?php
/* ************************************************************* *\
                    PAGE SERVICE FUNCTIONS
\* ************************************************************* */
function getBlog($DB, $bid){
  $stmt = $DB->prepare("SELECT blogId,blogDate,blogName,blogDesc,blogTitle,blogHtml,blogFeature FROM blog WHERE blogId = ?");
  
  if(!$stmt->bind_param('i', $bid)){
    return errorHandler("getBlog failed to bind parameter", 503);
  }
  return $stmt;
}

function getListing($DB){
  $stmt = $DB->prepare("SELECT blogId,blogDate,blogName,blogDesc,blogTitle,blogFeature FROM blog ORDER BY blogDate DESC LIMIT 10");
  return $stmt;
}

function setNames($DB){
  $stmt = $DB->prepare("SET NAMES utf8");
  return $stmt;
}

function createBlog($DB, $name, $desc, $title){
  $stmt = $DB->prepare("INSERT INTO blog (blogName,blogDesc,blogTitle) VALUES (?,?,?)");

  if(!$stmt->bind_param('sss', $name, $desc, $title)){
    return errorHandler("createBlog failed to bind parameter", 503);
  }
  return $stmt;
}

function updateBlogAdmin($DB, $name, $desc, $title, $bid){
  $stmt = $DB->prepare("UPDATE blog SET blogName=?, blogDesc=?, blogTitle=? WHERE blogId=?");

  if(!$stmt->bind_param('sssi', $name, $desc, $title, $bid)){
    return errorHandler("updateBlog failed to bind parameter", 503);
  }
  return $stmt;
}

function updateBlog($DB, $name, $desc, $title, $html, $feature, $bid){
  $stmt = $DB->prepare("UPDATE blog SET blogName=?, blogDesc=?, blogTitle=?, blogHtml=?, blogFeature=? WHERE blogId=?");

  if(!$stmt->bind_param('sssssi', $name, $desc, $title, $html, $feature, $bid)){
    return errorHandler("updateBlog failed to bind parameter", 503);
  }
  return $stmt;
}

function deleteBlog($DB, $bid){
  $stmt = $DB->prepare("DELETE FROM blog WHERE blogId=?");
  if(!$stmt->bind_param('i', $bid)){
    return errorHandler("deleteBlog failed to bind parameter", 503);
  }
  return $stmt;
}

?>