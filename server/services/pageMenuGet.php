<?php
  require('queries/pageQueries.php');
  $PAGE->id='pageMenuGet';

  //setup for query
  $stmt = getPageMenu($DB);
  if(!$stmt->execute()) return errorHandler("failed to get this list $stmt->errno: $stmt->error");
  //format results
  $data = array();
  $stmt->bind_result($data['pageId'],$data['menuName']);

  /* fetch values */
  $listResults = array();
  while ($stmt->fetch()) {
    $row = arrayCopy($data);
    array_push($listResults, $row);
  }
  echo json_encode($listResults);

  function arrayCopy( array $array ) {
    $result = array();
    foreach( $array as $key => $val ) {
        if( is_array( $val ) ) {
            $result[$key] = arrayCopy( $val );
        } elseif ( is_object( $val ) ) {
            $result[$key] = clone $val;
        } else {
            $result[$key] = $val;
        }
    }
    return $result;
  }
?>