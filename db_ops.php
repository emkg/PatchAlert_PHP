<?php


/*
 * Connect to the database and retrieve all changes
 *
 *//*************************************************/
$username = "patchA";
$password = "L879JLdduLjPQKw3";
$hostname = "localhost";

//connection to the database
$db = new mysqli($hostname, $username, $password, "patchA");

if ($db->connect_errno) {
	printf("Connect failed: %s\n", $db->connect_error);
	exit();
}

// only approved changes are alerts
//$alert_result = $db->query("SELECT * FROM CHANGES WHERE isApproved = 1");

// admins need to see all changes
$change_result = $db->query("SELECT * FROM CHANGES");
$server_result = $db->query("SELECT name FROM SERVERS");


/* 
 * make changes accessible for admin views of changes 
 */
$changes = array();

if($change_result->num_rows > 0) {
	while($row = $change_result->fetch_assoc()) {
		array_push($changes, $row);
	}
}
//*************************************************/

/* 
 * make names of the servers available accessible 
 */
$server_list = array();

if($server_result->num_rows > 0) {
	while($row = $server_result->fetch_assoc()) {
		array_push($server_list, $row);
	}
}
//*************************************************/


/* 
 * get the servers for this particular change 
 */
function getChangeServers($changeID) {
    global $db;
    $change_servers = $db->query("SELECT servers from CHANGES where id=$changeID");
    $servers = array();
    
    if($change_servers->num_rows > 0) {
        while($row = $change_servers->fetch_assoc()) {
            array_push($servers, $row);
        }
    }
    
    //$servers = explode(" ", $servers);
    
    return $servers;
}
//*************************************************/
?>


