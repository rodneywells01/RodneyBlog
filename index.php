<!DOCTYPE html>
<html>
<head>
	<title>Rodney's Blog</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/index.css">
	<link rel="stylesheet" type="text/css" href="otherSources/Hover-master/css/hover.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/blogposts.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/login.css">

	<script type="text/javascript" src="scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="scripts/ajaxCalls.js"></script>

	<?php require("includes/connection.php"); ?>
	<?php require_once("includes/basicfunctions.php"); ?>
	<?php require_once("includes/validation_functions.php"); ?>
	<?php require_once("includes/session.php"); ?>
	<?php require_once("includes/sqlcommands.php"); ?>
	<?php $admin = logged_in(); ?> 
</head>

<body>

	<div id="header">
		<div id="title">Rodney's Blog</div>
		<div id="tagline">Stocks, Programming, and Life, with a pinch of Swag</div>
		<div id="headerlinks">
			<div class="hvr-fade linkwrapper" onclick="load_content('blogposts')"><div class="verticallycenter">Posts</div></div>
			<div class="hvr-fade linkwrapper" onclick="load_content('about')"><div class="verticallycenter">About</div></div>
			<?php if ($admin == false) { ?>
			<div class="hvr-fade linkwrapper" onclick="load_content('login')"><div class="verticallycenter">Log In</div></div>
			<?php } else { ?>
			<div class="hvr-fade linkwrapper" onclick="window.location.href='logout.php'"><div class="verticallycenter">Log Out</div></div>
			<div class="hvr-fade linkwrapper" onclick="load_content('writenewpost')"><div class="verticallycenter">Write</div></div>
			<?php } ?>
		</div>
	</div>

	<div id="mainarea"></div>

	<div id="footer">
		<div class="verticallycenter">
			<div>Can't believe i'm making some ridiculous blog.</div>
			<div><a href="http://www.rodneywells.com">www.rodneywells.com</div>
		</div>		
	</div>
</body>
</html>

<script type="text/javascript">load_content('blogposts');</script>	
