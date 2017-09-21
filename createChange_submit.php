<?php 

	$username = "patchA";
	$password = "L879JLdduLjPQKw3";
	$hostname = "localhost";

  	//connection to the database
  	$db = new mysqli($hostname, $username, $password, "patchA");

	// check connection
	if ($db->connect_error) {
		if ($debug == 1) { 
			trigger_error('Database connection failed: '  . $db->connect_error, E_USER_ERROR); 
		}
		else { 
			trigger_error('Database connection failed.'); 
		}
	}

	$sql  = "INSERT into CHANGES SET";
	
	$sql .= " date_created=CURRENT_TIMESTAMP(),";
	$sql .= " isApproved=0,";
	$sql .= " isExpired=0,";
	$sql .= " createdBy='$_POST['user']',";
	$sql .= " servers='".$_POST['servers'])."',";
	

	
	
	if ($db->query($sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}
	
  mysql_close($db);

?>