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
    $reason = $_POST['reason'];
    $resources = $_POST['resources'];

	$sql  = "INSERT into CHANGES SET";
	$sql .= " date_created=CURRENT_TIMESTAMP(),";
	$sql .= " createdBy='$user',";
	$sql .= " servers=$servers,";
	$sql .= " reason='$reason',";
    $sql .= " resources='$resources'";

	if ($db->query($sql)) {
		header('Location: https://intranet.nssl.noaa.gov/its/server-news/admin-index.php' );
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
