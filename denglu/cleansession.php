<?php
	session_start();
	$_SESSION=array();
	session_destroy();
	session_unset();
	header("Location: login.php");
?>