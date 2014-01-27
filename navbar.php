<?php
	session_start();
	
	//check session
	if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
	
	// To Page Login
	
	
	require_once('functions.php');
	require_once('admin/enter.php');
	
	}else{
		#redirect to admin page
		header('location:admin/dashboard.php');
	}
?>