<?php

		$username = "admin";
		$password = "local";
		$hostname = "localhost";

    $daysOfWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

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

    $result = $db->query("SELECT servers from CHANGES where id=".$_POST['id'])->fetch_assoc();
    $serverStr = $result['servers'];
    $servers = explode(" ", $serverStr);

    // need to limit characters
    $n = $_POST['id'];

    // create an insert to update this change -- it is approved so it must become an alert now
		$sql  = "UPDATE CHANGES SET";
		$sql .= " date='" . $_POST['date'] . "',";
		$sql .= " isApproved=1,";
    $sql .= " approvedBy='" . $_POST['user'] . "',";
    $sql .= " time='" . $_POST['time'] . "'";
    $sql .= " WHERE id = " . $_POST['id'];

    // all variables below are relevant to the email itself

    // creating a human readable date for the lab-wide email
		$date_array = date_parse($_POST['date']);
    $month = $months[$date_array['month']-1];
    $day = $date_array['day'];
    $dayOfWeek = $daysOfWeek[date('w', $_POST['date'])];
    $time = $_POST['time']; // figure out how to get an AM/PM on here

    // making the months themed bc why not
    $color = "";
    switch ($month) {
        case "January":
            $color = "#8041f4";
            break;
        case "February":
            $color = "pink";
            break;
        case "March":
            $color = "#a4f442";
            break;
        case "April":
            $color = "#a4f442";
            break;
        case "October":
            $color = "orange";
            break;
        case "November":
            $color = "orange";
            break;
        case "December":
            $color = "#f44141";
            break;
        default:
            $color = "green";
    }

    // pulling the link out as a variable seems to prevent it from breaking in the body of the email
    $linkToExceptionForm = "https://intranet.nssl.noaa.gov/its/server-news/requestException.php?id=3D$n";

    // quoted printable format with custom linebreaks
    $message =  "<div style=3D'text-align: center; margin: 0 auto; font-family: =
                Helvetica Neue, Helvetica, Arial, sans-serif;'>=
                <span style=3D'font-size: 24px; font-family: Impact; color: black'>=
                SYSTEMS ARE BEING UPDATED SOON</span><br/><br/>=
                <span style=3D'font-size: 18px; font-style: italic;'>=
                If you are running processes on any of the servers below, prepare for =
                the processes to be disrupted. <br/>In certain circumstances, you may=
                request an exception to rescedule these updates.</span><br/><br/>=
                <div style=3D'border: solid black 1px; border-radius: 5px 5px 0 0;=
                margin: 0 auto; width: 180px;'><div style=3D'font-weight: bold; =
                text-align: center; width: 100%; background: $color; color: #fff; =
                font-size: 30px; max-height: 50px; border-radius: 5px 5px 0 0;'>=
                $month</div><br/><div style=3D'font-weight: bold; text-align: center;=
                font-size: 30px;'>$day</div><br/><div style=3D'font-weight: bold; =
                text-align: center; font-size: 18px;'>$dayOfWeek at $time</div>=
                </div><br/><span style=3D'text-align: center; font-style:italic;'>=
                Add to calendar: $dayOfWeek $month $day, $time</span><br/><br/>
                <a style=3D'text-decoration: none;=
                font-family: IMPACT; font-size: 24px;'=
                href=3D'$linkToExceptionForm'=
                >REQUEST EXCEPTION</a><br/><br/>=
                <span style=3D'font-size: 15px; text-align: center;'>=
                You can always check for pending updates on the =
                <a style=3D'text-decoration: none;' href=3D'=
                https://intranet.nssl.noaa.gov/its/server-news'>Server News </a>=
                page of the NSSL Intranet.</span><br/><br/>=
                <span style=3D'font-size:24px;'><strong>affected systems:</strong>=
                </span><br/><div style=3D'font-size: 18px; margin: 0 auto;=
                border: 2px solid black; overflow: scroll; =
                width: 50%; padding: 0; height: 180px;'>=";

                foreach($servers as $s) {
                    $message .="<div style=3D'position: relative; text-align: left;'>=
                                $s</div> =";
                }

    $message .= "</div></div>";

    $to = "email@email.com";

    // get a timestamp for the email subject header
    $now = new DateTime();
    $now = $now->getTimestamp();

    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Transfer-Encoding: QUOTED-PRINTABLE\r\n";
    $headers .= "Content-Type: text/html\r\n";
    //$headers .= "charset='UTF-8'\r\n";
    //$headers .= "To: $to\r\n";
    $headers .= "From: Server News App <email@email.com>\r\n";
    // creates a unique subject line for each alert
    $subject = "ITS Alert: upcoming updates may affect your work $now";


    // insert updated data to the change, send the lab-wide email, and redirect back home
	if ($db->query($sql)) {
        mail($to, $subject, $message, $headers);
		header('Location: https://intranet.nssl.noaa.gov/its/server-news/admin/admin-index.php');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

  mysql_close($db);

?>
