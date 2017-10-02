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

    $servers = explode(" ", getChangeServers($_POST['id']));

    $message = "<html><body>";
    $message .= "<table rules='all' style='border-color: #009BD9;' cellpadding='10'>";
    $message .= "<tr><td><strong>What's Happening:</strong> </td><td>" . $reason . "</td></tr>";
    $message .= "<tr><td><strong>When:</strong> </td><td>" . $_POST['date'] . " " . $_POST['time'] . "</td></tr>";
    $message .= "<tr><td><strong>Affected systems:</strong> </td><td>" . $servers . "</td></tr>";
    $message .= "</table>";
    $message .= "<div style='height: 45px; text-align: center; border-radius: 2px;
                            background: #009BD9; margin: 0 auto; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
                            cursor: pointer; padding: 13.5px;'>
                            <a href='./requestException.php?id=$c[id]' >
                                 <div style='text-decoration: none; margin: 0 auto; padding: 0; font-size: 18px;
                                 vertical-align: middle; color: white;'>REQUEST EXCEPTION</div>
                            </a></div>
                </div>";
    $message .= "</body></html>";

    $to = "emily.grimes@noaa.gov";

    $header = "From: " . "vicki.farmer@noaa.gov" . "\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $subject = "Servers are being updated soon";



	if ($db->query($sql)) {
        mail($to, $subject, $message, $header);
		header('Location: https://intranet.nssl.noaa.gov/its/server-news/admin-index.php');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
