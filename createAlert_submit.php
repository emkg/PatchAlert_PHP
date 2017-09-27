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

	$sql  = "UPDATE CHANGES SET";

	$sql .= " date='" . $_POST['date'] . "',";
	$sql .= " isApproved=1,";
    $sql .= " approvedBy='" . $_POST['user'] . "',";
    $sql .= " time='" . $_POST['time'] . "'";
    $sql .= " WHERE id = " . $_POST['id'];





	if ($db->query($sql)) {
		header('Location: https://intranet.nssl.noaa.gov/its/server-news/admin-index.php');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
