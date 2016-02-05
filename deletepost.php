<?php 
	require("includes/connection.php");
	require_once("includes/basicfunctions.php");
	require_once("includes/validation_functions.php");
	require_once("includes/session.php");
	require_once("includes/sqlcommands.php");
	$active_page = "about";
	$admin = logged_in(); 
	global $connection;
	$errors = errors();

	if(!$admin) { redirect_to("index.php"); } 


	if (isset($_GET["postid"])) {    	
		// Delete blog 
		$result = sql_delete("blogposts", $_GET["postid"]);
	}

	redirect_to("index.php");


?>