<?php
	session_start();
	unset($_SESSION['user_name']);
	unset($_SESSION['logged_in']);
	echo 'You have been logged out.';
	header('location:login.php');
?>