<?php
	//if its not admin, dont load a page.
	if($_GET['path']!='admin') return;

	include('client/templates/auth.php');
	include('client/templates/user.php');
	include('client/templates/pages.php'); 
	include('client/templates/blog.php');
?>
