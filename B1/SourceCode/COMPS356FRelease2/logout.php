<?php
    session_start();
	require_once("mysql_connection.php");
	unset($_SESSION);
	session_destroy();
	header("location:index.php");
?>