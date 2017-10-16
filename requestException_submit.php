<?php


		$username = "admin";
		$password = "local";
		$hostname = "localhost";

  	//connection to the database
  	$db = new mysqli($hostname, $username, $password, "patchA");

    $servers = "";
    foreach( $_POST['server-select'] as $s ) {
        $servers .= $s;
    }
    $servers .= "";

    $email = $_POST['email'];
    $user = $_POST['user'];
    $reason = $_POST['reason'];
    $os = $_POST['os'];

		$sql  = "INSERT into EXCEPTIONS SET";
		$sql .= " User='" . $_POST['user'] . "',";
		$sql .= " Reason='" . $_POST['reason'] . "',";
    $sql .= " change_id =" . $_POST['id'] . ",";
		$sql .= " time_requested=CURRENT_TIMESTAMP()";

    $message = "<html><body>";
    $message .= "name: $user <br/>";
    $message .= "email: $email <br/>";
    $message .= "system name: $servers <br/>";
    $message .= "system type: $os <br/>";
    $message .= "help type: rescedule maintenance/updates <br/>";
    $message .= "reason: $reason <br/>";
    $message .= "</body></html>";

    $to = $email;
    //$to = "ticketsystem@email.com"

    $headers = "From: $user <'$email'>\r\n";
    $headers .= "CC: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html\r\n";
    //$headers .= "Content-Transfer-Encoding: QUOTED-PRINTABLE\r\n";
    //$headers .= "Content-Type: text/html\r\n";

    $subject = "reschedule maintenance";

	if ($db->query($sql)) {
        header('Location: https://intranet.nssl.noaa.gov/its/server-news/');
        mail($to, $subject, $message, $headers);
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
