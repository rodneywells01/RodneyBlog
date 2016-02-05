<?php require("includes/connection.php"); ?>
<?php require_once("includes/basicfunctions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/sqlcommands.php"); ?>
<?php $active_page = "about"; ?>
<link rel="stylesheet" type="text/css" href="stylesheets/about.css">
<?php $admin = logged_in(); ?> 
<?php global $connection; ?>
<?php $errors = errors(); ?>
<link rel="stylesheet" type="text/css" href="stylesheets/write.css">


<?php 

if(isset($_POST["submit"])) {
	// Confirm values 
	$required_fields = array("title", "body");
    validate_presences($required_fields);

    if(empty($errors)) {
    	// Post blog to DB 
    	$title = $_POST["title"];
    	$body = $_POST["body"];    	
		date_default_timezone_set('America/New_York');
		$timestamp = date('m/d/Y h:i:s a', time());

		$result = sql_insert("blogposts", ["body", "title", "date"], [$body, $title, $timestamp]);

		if($result) {
			redirect_to("index.php");
		} else {
			die("blog failed to be posted!");
		}
    } 
}
?>

<div id="writetitle">
	May your thoughts be true!
</div>

<form action="writenewpost.php" method="post">
	<div class="inputcontent">
		<div class="descriptor">Title:</div>
		<input type="text" name="title">
	</div>

	<div class="inputcontent">
		<div class="descriptor">Content:</div> 
		<textarea name="body"></textarea>

	</div>
	<input type="submit" name="submit" value="Post">
</form>

