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

    $message = "<html><body>";
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($user) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
    $message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . $reason . "</td></tr>";
    $message .= "<tr><td><strong>Resources:</strong> </td><td>" . $resources . "</td></tr>";
    $message .= "<tr><td><strong>Affected systems:</strong> </td><td>" . $servers . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    $to = "emily.grimes@noaa.gov";

    $header = "From: " . $_POST['email'] . "\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $subject = "A change has been requested";


	if ($db->query($sql)) {
		mail($to, $subject, $message, $header);
        header('Location: https://intranet.nssl.noaa.gov/its/server-news/admin-index.php' );
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
