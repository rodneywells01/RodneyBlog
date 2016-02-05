<?php require("includes/connection.php"); ?>
<?php require_once("includes/basicfunctions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/sqlcommands.php"); ?>

<?php 
// Fetch blog posts.
$blogposts = sql_read("blogposts", "");

if(logged_in()) {
	echo "<form action=\"new_admin.php\" method=\"post\">";
}

foreach ($blogposts as $key => $post) {
	$bloghtml = "";
	$bloghtml .= "<div class=\"blogpost\"><div class=\"blogtitle\">";
	$bloghtml .= $post["title"];
	$bloghtml .= "</div><div class=\"blogcontent\">";
	$bloghtml .= $post["body"];
	$bloghtml .= "</div>";

	if (logged_in()) {
		$bloghtml .= "<a class=\"deletelinkwrap\" href=\"deletepost.php?postid={$post["id"]}\">
						<div class=\"deletewrap\"><div class=\"deletebox\">Delete this Post
					</div></div></a>";
	}

	$bloghtml .= "</div>";

	echo $bloghtml;
}

?>