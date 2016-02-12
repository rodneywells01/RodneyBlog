<?php require("includes/connection.php"); ?>
<?php require_once("includes/basicfunctions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php $active_page = "login"; ?>

<?php $admin = logged_in(); ?> 
<?php global $connection; ?>

<?php if ($admin) {
	redirect_to("index.php");
} 
?>

<?php 
//   if (isset($_POST['submit'])) {
//     // User has submitted a form. 
//     $admins = find_all_admins();
//     $required_fields = array("username", "password");
//     validate_presences($required_fields);
//     if (empty($errors)) {
//       $username = mysql_prep($_POST["username"]);
//       $hashed_password = password_encrypt($_POST["password"]);

//       $query = "INSERT INTO admins (";
//       $query .= " username, hashed_password";
//       $query .= ") VALUES (";
//       $query .= " '{$username}', '{$hashed_password}'";
//       $query .= ")";

//       $result = mysqli_query($connection, $query);
//       if ($result) {
//         // Success
//         echo "Admin created. <br/>";
//       } else {
//         // Failure
//         echo "Admin failed to create. <br/>";
//       }
//     } else {
//       // Errors exist.
//       echo "ERRORS <br/>";
//     }
    
//   } 
?>

<?php 
	if (isset($_POST['submit'])) {
		$username = "";

		$required_fields = array("username", "password"); 
		validate_presences($required_fields);

		if(empty($errors)) {
			// Attempt a login. 
			$username = $_POST["username"]; 
			$password = $_POST["password"]; 
			$found_admin = attempt_login($username, $password);

			if ($found_admin) {
				// Success. User is logged in! 
				$_SESSION["admin_id"] = $found_admin["id"]; 
				$_SESSION["username"] = $found_admin["username"]; 
				redirect_to("index.php");
			} else {
				// Failure. Could not log in. 
				$_SESSION["message"] = "Username/password not found.";
				redirect_to("index.php");
			}
		} else {
			// Errors Exist. 
			$_SESSION["errors"] = $errors; 
			redirect_to("index.php");
		}
	}
?>

<?php 

?>

<form action="login.php" method="post">
	<div id="loginbox" class="horizontallycenter">
		<div class="loginrow">
			Username: <input type="text" name="username">	
		</div>
		<div class="loginrow">
			Password: <input type="password" name="password">
		</div>
		<div class="loginrow">
			<input type="submit" name="submit" value="Login">
		</div>				
	</div>
	
</form>