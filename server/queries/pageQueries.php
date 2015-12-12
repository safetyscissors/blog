<?php
/* ************************************************************* *\
                    PAGE SERVICE FUNCTIONS
\* ************************************************************* */
function getPage($DB, $pageName){
  $stmt = $DB->prepare("SELECT staticPageId,staticPageMenuOrder,staticPageMenuName,staticPagePageTitle,staticPageDesc,staticPageHtml,staticPageFeature FROM staticPage WHERE staticPageMenuName = ?");
  
  if(!$stmt->bind_param('s', $pageName)){
    return errorHandler("getPage failed to bind parameter", 503);
  }
  return $stmt;
}

function getPageList($DB){
  $stmt = $DB->prepare("SELECT staticPageId,staticPageMenuOrder,staticPageMenuName,staticPagePageTitle,staticPageDesc FROM staticPage");
  return $stmt;
}

function getPageMenu($DB){
	$stmt = $DB->prepare("SELECT staticPageId,staticPageMenuName FROM staticPage ORDER BY staticPageMenuOrder");
	return $stmt;
}

function createPage($DB, $name, $desc, $title){
  $stmt = $DB->prepare("INSERT INTO staticPage (staticPageMenuName,staticPageDesc,staticPagePageTitle) VALUES (?,?,?)");

  if(!$stmt->bind_param('sss', $name, $desc, $title)){
    return errorHandler("createPage failed to bind parameter", 503);
  }
  return $stmt;
}

function updatePageFast($DB, $title, $desc, $menuName, $pid){
  $stmt = $DB->prepare("UPDATE staticPage SET staticPagePageTitle=?, staticPageDesc=?, staticPageMenuName=? WHERE staticPageId=?");

  if(!$stmt->bind_param('sssi', $title, $desc, $menuName, $pid)){
    return errorHandler("updatePage failed to bind parameter", 503);
  }
  return $stmt;
}

function updatePage($DB, $title, $desc, $menuName, $html, $feature $pid){
  $stmt = $DB->prepare("UPDATE staticPage SET staticPagePageTitle=?, staticPageDesc=?, staticPageMenuName=?, staticPageHtml=? staticPageFeature=? WHERE staticPageId=?");

  if(!$stmt->bind_param('sssssi', $title, $desc, $menuName, $html, $feature, $pid)){
    return errorHandler("updatePage failed to bind parameter", 503);
  }
  return $stmt;
}

function deletePage($DB, $pid){
  $stmt = $DB->prepare("DELETE FROM staticPage WHERE staticPageId=?");
  if(!$stmt->bind_param('i', $pid)){
    return errorHandler("deletePage failed to bind parameter", 503);
  }
  return $stmt;
}

?>