<?php
  $DB = new mysqli("127.0.0.1", "root", "Iamai#13", "blog");

  /* check connection */
  if ($DB->connect_errno) {
      printf("Connect failed: %s\n", $DB->connect_error);
      exit();
  }

  return $DB;
?>
