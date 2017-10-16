<?php

$username = "admin";
$password = "local";
$hostname = "localhost";

    //connection to the database
  	$db = new mysqli($hostname, $username, $password, "patchA");

	// check connection
	if ($db->connect_error) {
		if ($debug == 1) {
			trigger_error('Database connection failed: ' . $db->connect_error, E_USER_ERROR);
		}
		else {
			trigger_error('Database connection failed.');
		}
	}

    $id = $_POST['id'];
    $result = $db->query("SELECT * from CHANGES where id=$id")->fetch_assoc();

    $user = $_POST['user'];
    $reason_insert = $db->real_escape_string($_POST['decline-reason']);
    $reason = $_POST['decline-reason'];

    $whatwhy = $result['whatwhy'];
    $how = $result['how'];
    $software = $result['software'];
    $duration = $result['duration'];

    // create an insert to update this change -- it is approved so it must become an alert now
	$sql  = "UPDATE CHANGES SET";
	$sql .= " isApproved=-1,";
    $sql .= " approvedBy='$user',";
    $sql .= " decline_reason='$reason_insert'";
    $sql .= " WHERE id =$id";

    $gifLink = "http://www.nssl.noaa.gov/easter_eggs/1.gif";
    $link = '';

    // quoted printable format with custom linebreaks
    $message = "<html><body>=";
    $message .= "<span style=3D'font-weight:bold;'>The following change request was not approved.</span>=
                <br/>=";
    $message .= "<table rules=3D'all' style=3D'border-color: #666;' cellpadding=3D'10'>=";
    $message .= "<tr style=3D'background: #eee;'><td>=<strong>Name:</strong> </td><td> $user </td></tr>=";
    $message .= "<tr><td><strong>Change Description:</strong>= </td><td> $whatwhy</td></tr>=";
    $message .= "<tr><td><strong>Plan:</strong>= </td><td> $how </td></tr>=";
    $message .= "<tr><td><strong>Duration:</strong>= </td><td> $duration </td></tr>=";
    $message .= "<tr><td><strong>Affected software systems:</strong>= </td><td> $software </td></tr>=";
    $message .= "<tr><td><strong>Specific affected systems:</strong>= </td><td> $servers </td></tr>=";
    $message .= "</table>=";
    $message .= "<br/>=";
    $message .= "<div style=3D'font-size: 14px;'>=";
    $message .= "<span style=3D'font-weight:bold;'>Your feedback:</span><br/><br/>=
                    $reason=
                    <br/>
                    -$user=
                <br/><br/>=
                <img src=3D'$gifLink'/> =
                <br/><br/>
                Request another change <a href=3D'$link'>here</a>.=
                </div>=
                <br/>
                </body></html>";

    $to = $result['requester_email'];

    $header = "From: Server News App <'email@email.com'>\r\n";
    $header .= "Reply-To: $to\r\n";
    $header .= "CC: $to\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: text/html\r\n";
    $header .= "Content-Transfer-Encoding: QUOTED-PRINTABLE\r\n";
    //$headers .= "Content-Type: text/html\r\n";

    $subject = "Your change request was not approved";

    // insert updated data to the change, send the lab-wide email, and redirect back home
	if ($db->query($sql)) {
        mail($to, $subject, $message, $header);
		header('Location: https://intranet.nssl.noaa.gov/its/server-news/admin/admin-index.php');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
