<?php
session_start();

error_reporting (E_ALL ^ E_NOTICE);

header('X-Frame-Options: SAMEORIGIN');

// print "S:".$_SESSION['SESS_UID'];
if(empty($_SESSION['SESS_UID'])){	
	include 'signin.php';
} else {
	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	// print $actual_link;
	$act_links = $actual_link;
	include 'connection/common.php';
	include 'index_head.php';
	include 'index_menu.php';
	include 'index_header.php';
	include 'index_pages.php';
	include 'index_footer.php';
}



?>