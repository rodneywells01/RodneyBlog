<?php
	function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;
	}

	function mysql_prep($string) {
		global $connection;
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
		    $output .= htmlentities($error);
		    $output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}


	function password_encrypt($password) {
		$hash_format = "$2y$10$";
		$salt_length = 22; 
		$salt = generate_salt($salt_length); 
		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

	function generate_salt($length) {
		$unique_random_string = md5(uniqid(mt_rand(), true));

		// Valid Characters for salt are [a-zA-Z0-9./]
		$base64_string = base64_encode($unique_random_string);

		// But not "+", which is valid in base 64 encoding. 
		$modified_base64_string = str_replace('+', '.', $base64_string);

		// Truncate string to correct length. 
		$salt = substr($modified_base64_string, 0, $length);

		return $salt;
	}

	function password_check($password, $existing_hash) {
		$hash = crypt($password, $existing_hash); 
		if ($hash === $existing_hash) {
			return true;
		} else {
			return false;
		}
	}
	
	function find_all_admins() {
		// Query database for list of admins. 
		global $connection;

		$query = "SELECT * FROM admins ORDER BY username ASC";
		$admin_list = mysqli_query($connection, $query);
		confirm_query($admin_list);
		return $admin_list;
	}

	function find_admin_by_id($admin_id)  {
		global $connection;

		$safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
		$query = "SELECT * FROM admins ";
		$query .= "WHERE id={$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query); 
		confirm_query($admin_set);

		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;		
		} else {
			return null;
		}

	}

	function find_admin_by_username($username) {
		global $connection;

		$safe_username = mysqli_real_escape_string($connection, $username);
		$query = "SELECT * FROM admins ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query); 
		confirm_query($admin_set);

		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;	
		} else {
			return null;
		}
	}
	function attempt_login($username, $password) {
		$admin = find_admin_by_username($username); 
		if ($admin) {
			// found admin, now check password. 
			if (password_check($password, $admin['hashed_password'])) {
				// Password matches. 
				return $admin;
			} else {
				// Password does not match. 
				return false;
			}
		} else {
			// admin not found. 
			return false;
		}
	}

	function logged_in() {
		return isset($_SESSION['admin_id']);
	}

	function confirm_logged_in() {
		if(!logged_in()) {
		    // Admin is not logged in.
		    redirect_to("logon.php");
		}
	}

	function compress_table($tablename) {
		// Asssumes id will not be less than optimal (IDS can't auto shrink). 
		global $connection;
		$query = "SELECT * FROM ";
		$query .= $tablename; 
		$subject_set = mysqli_query($connection, $query); 
		confirm_query($subject_set); 

		$optimalid = 1;
		while($row = mysqli_fetch_assoc($subject_set)) {
			if ($row['id'] != $optimalid) {
				// Update row ID. 
				$query = "UPDATE ";
				$query .= $tablename; 
				$query .= " SET "; 
				$query .= "id = {$optimalid} "; 
				$query .= "WHERE id = {$row['id']} "; 
				$query .= "LIMIT 1"; 
				mysqli_query($connection, $query); 
			}

			$optimalid += 1;
		}
	}

	
?>

	