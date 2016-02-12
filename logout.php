<?php require_once("includes/session.php"); ?>
<?php require_once("includes/basicfunctions.php"); ?>

<?php 
echo logged_in();
print_r($_SESSION);
$_SESSION['admin_id'] = null;
$_SESSION['username'] = null; 
print_r($_SESSION);
echo logged_in();

redirect_to("index.php");
?>