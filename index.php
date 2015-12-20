<?php header( 'Content-Type: text/html; charset=utf-8' ); ?>
<html>
<head>
  <title>blog</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php include('client/headIncludes.php') ?>
</head>
<body>
<div class="container-fluid">
  <?php include('client/menu.php') ?>
	<?php include('client/templates/page.php') ?>
	<?php include('client/templates/entry.php') ?>
	<?php include('client/templates/admin.php') ?>
</div>
</body>
</html>
