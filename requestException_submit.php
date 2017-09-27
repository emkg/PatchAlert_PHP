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

    $servers = "'";
    foreach( $_POST['server-select'] as $s ) {
        $servers .= "$s ";
    }
    $servers .= "'";

	$sql  = "INSERT into EXCEPTIONS SET";
	$sql .= " User='" . $_POST['user'] . "',";
	$sql .= " Server=" . $servers . ",";
	$sql .= " Reason='" . $_POST['reason'] . "',";
	$sql .= " Date='" . $_POST['altDate'] . "',";
	$sql .= " Time='" . $_POST['altTime'] . "',";
	$sql .= " isApproved=0,";
    $sql .= " change_id =" . $_POST['id'] . ",";
	$sql .= " time_requested=CURRENT_TIMESTAMP()";

	if ($db->query($sql)) {
        header('Location: https://intranet.nssl.noaa.gov/its/server-news/');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
