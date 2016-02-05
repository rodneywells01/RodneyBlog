<?php global $connection; 
?>

<?php 

function sql_read($table, $where) {
	$query = "SELECT * FROM " . $table; 
	if ($where != "") {
		$query .= " WHERE " . $where;
	}
	// return $query;
	return execute_and_confirm($query);
}

function sql_update($table, $columnvalues, $newvalues, $id) {
	$query = "UPDATE " . $table . " SET ";
	foreach ($columnvalues as $key => $colval) {
		$query .= $colval . " = '" . $newvalues[$key] . "'";

		if (sizeof($columnvalues) != $key + 1) {
			$query .= ", ";
		}
	}
	$query .= " WHERE id = " . $id;	
	// return $query;
	return execute_and_confirm($query);
}

function sql_insert($table, $columnvalues, $newvalues) {
	$query = "INSERT INTO " . $table . "(";
	foreach ($columnvalues as $key => $colval) {
		$query .= $colval;
		if (sizeof($columnvalues) != $key + 1) {
			$query .= ", ";
		}
	}
	$query .= ") VALUES (";
	foreach ($newvalues as $key => $newval) {
		$query .= "'" . $newval . "'";

		if (sizeof($newvalues) != $key + 1) {
			$query .= ", ";
		}
	}
	$query .= ")";
	// return $query;
	return execute_and_confirm($query);
}

function sql_delete($table, $id) {
	$query = "DELETE FROM " . $table . " WHERE id = " . $id;
	return execute_and_confirm($query);
}

function execute_and_confirm($statement) {
	global $connection;
	$result = mysqli_query($connection, $statement);
	confirm_query($result);	
	return $result;
}

?>