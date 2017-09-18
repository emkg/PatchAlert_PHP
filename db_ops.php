<?php


/*
 * Connect to the database and retrieve all changes
 *
 *//*************************************************/
$username = "patchA";
$password = "";
$hostname = "localhost";

//connection to the database
/*$db = new mysqli($hostname, $username, $password, "patchA");

if ($db->connect_errno) {
	printf("Connect failed: %s\n", $db->connect_error);
	exit();
}

// only approved changes are alerts
//$alert_result = $db->query("SELECT * FROM CHANGES WHERE isApproved = 1");

// admins need to see all changes
$change_result = $db->query("SELECT * FROM CHANGES");
*/

/*
 * make alerts accessible for alert elements
 */
/*$alerts = array();
if($alert_result->num_rows > 0) {
	while($row = $alert_result->fetch_assoc()) {
		array_push($alerts, $row);
	}
}*/
/*
 * make changes accessible for admin views of changes
 */
/*$changes = array();

if($change_result->num_rows > 0) {
	while($row = $change_result->fetch_assoc()) {
		array_push($changes, $row);
	}
}*/
//*************************************************/
?>
