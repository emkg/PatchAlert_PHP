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

    $whatwhy = $_POST['whatwhy'];
    $how = $_POST['how'];
    $software = $_POST['software'];
    $duration = $_POST['duration'];
    $requesterEmail = $_POST['email'];

		$sql  = "INSERT into CHANGES SET";
		$sql .= " date_created=CURRENT_TIMESTAMP(),";
		$sql .= " requestedBy='$user',";
		$sql .= " servers=$servers,";
		$sql .= " whatwhy='{$whatwhy}',";
    $sql .= " how='{$how}',";
    $sql .= " software_systems='$software',";
    $sql .= " duration='$duration',";
    $sql .= " requester_email='{$requesterEmail}'";


    $message = "<html><body>";
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $user . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . $requesterEmail . "</td></tr>";
    $message .= "<tr><td><strong>Change Description:</strong> </td><td>" . $whatwhy . "</td></tr>";
    $message .= "<tr><td><strong>Plan:</strong> </td><td>" . $how . "</td></tr>";
    $message .= "<tr><td><strong>Duration:</strong> </td><td>" . $duration . "</td></tr>";
    $message .= "<tr><td><strong>Affected software systems:</strong> </td><td>" . $software . "</td></tr>";
    $message .= "<tr><td><strong>Specific affected systems:</strong> </td><td>" . $servers . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    $to = "email@email.com";

    $header = "From: Server News App <'$requesterEmail'>\r\n";
    //$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $header .= "MIME-Version: 1.0\r\n";
    //$headers .= "Content-Transfer-Encoding: QUOTED-PRINTABLE\r\n";
    $header .= "Content-Type: text/html\r\n";
    $header .= "CC: $requesterEmail\r\n";
    $header .= "From: nssl.webmaster@noaa.gov\r\n";

    $subject = "A change has been requested";


	if ($db->query($sql)) {
		mail($to, $subject, $message, $header);
        header('Location: ' );
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
