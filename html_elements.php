<?php

require('db_ops.php');

function getChangeElements($isAdminOptics) {

	$changeElements = array();
	global $changes;

		if ($isAdminOptics) { // admins need to see all changes
			foreach($changes as $a) {
                // get the list of servers
                $servers = explode(" ", $a[servers]);    
				
                $change_element = "<div class='admin-item'><div class='scrolly-list'> <div class='scrolly-list-item'>";
                foreach($servers as $s) { 
                    $change_element .= "<div style='padding: 8px 16px; font-size: 16px;'> $s </div>"; 
                }
				$change_element .= "</div></div><br/><div style='width: 50%; flex-grow: 2;'> DATE: <span class='data'> $a[date_created] </span> <br/> TIME: <span class='data'> $a[date_created] </span><br/> REQUESTED BY: $a[createdBy] </div>";
				$change_element .= "<div style='width: 50%; margin: 0 auto; padding: 15% 0 0 25%;'><a href='createAlert.php' class='img-link'><img id='new-alert' src='img/ic_thumb_up_black_24px.svg' alt='Approve'/></a> <br/><br/><br/>";
				$change_element .= "<a class='img-link'><img id='new-alert' src='img/ic_thumb_down_black_24px.svg' alt='Reject'/></a></div></div>";

				array_push($changeElements, $change_element);
			}
			
		} else {
			foreach($changes as $c) {
				if($c[isApproved]) { // if not presented to admins, we only want "alerts", or approved changes
					// get the list of servers
                    $servers = explode(" ", $c[servers]);  
                    
					$change_element = "<div class='item'> <br/> <span style='font-size: 0.75em;'> Maintenence has been scheduled for</span>";
					$change_element .= "<br/> <br/> <div class='scrolly-list'> ";
                    foreach($servers as $s) { 
                        $change_element .= "<div class='scrolly-list-item'><img src='./img/ic_system_update_black_18px.svg'> <div style='padding: 16px 50px;'> $s </div></div>"; 
                    }
					$change_element .= "</div><br/> on <span class='data'> $c[date_created] </span> <br/> at <span class='data'> $c[date_created] </span>";
					$change_element .= "<div class='buttons' > <br/> <div class='button'> <a href='./requestException.php?id=$c[id]' >
											<span span class='button-text'>REQUEST EXCEPTION</span></a></div></div><br/></div>";

					array_push($changeElements, $change_element);
				}
			}
		}

	return $changeElements;
}



$no_alerts_element = "<div class='item'>
  <span style='font-size: 0.5em; font-style: italic;'>There are no service alerts right now.</span>
</div>";





?>
