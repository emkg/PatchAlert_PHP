<?php

$username = "admin";
$password = "local";
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

    $user = $_POST['user'];

    $servers = "'";
    foreach( $_POST['server'] as $s ) {
        $servers .= "$s ";
    }
    $servers .= "'";

	$sql  = "INSERT into CHANGES SET";
	$sql .= " date_created=CURRENT_TIMESTAMP(),";
	$sql .= " createdBy='$user',";
	$sql .= " servers=$servers";


	if ($db->query($sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
