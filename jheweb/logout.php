<?php 
	ob_start();
	session_start();
	unset($_SESSION["UserLogin"]);// depend on the value we use
	unset($_SESSION["AdminLogin"]);
	session_destroy();
	header("location: index.php");// find the login index
	ob_end_flush();
?>