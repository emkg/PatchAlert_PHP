<?php

require('db_ops.php');

function getChangeElements($isAdminOptics) {

	$changeElements = array();
	global $changes;

		if ($isAdminOptics) { // admins need to see all changes
            foreach($changes as $a) {
                if(!$a[isApproved]) {
                    // get the list of servers
                    $servers = explode(" ", $a[servers]);    

                    $change_element = "<div class='admin-item'>
                    REASON: <span class='data'>$a[reason]</span>
                    <br/>
                    RESOURCES: <span class='data'>$a[resources] </span>
                    <br/>
                    REQUESTED BY: <span class='data'>$a[createdBy] </span> <br/>
                    AFFECTED SYSTEMS:
                    <br/>
                    <div class='scrolly-list'> ";
                    foreach($servers as $s) { 
                        $change_element .= "<div class='scrolly-list-item'> <div style='padding: 8px;'> $s </div></div>"; 
                    }

                    $change_element .= "</div><br/><div>
                        <a class='img-link' href='createAlert.php?id=$a[id]'>
                            <img id='thumb-down' src='img/ic_thumb_down_black_24px.svg' alt='Deny'/>
                        </a>
                        <a href='createAlert.php?id=$a[id]' class='img-link'>
                            <img id='thumb-up' src='img/ic_thumb_up_black_24px.svg' alt='Approve'/>
                        </a> 
                      
                   </div>
                    </div>";

                    array_push($changeElements, $change_element);
                }
			}
			
		} else {
			foreach($changes as $c) {
				if($c[isApproved]) { // if not presented to admins, we only want "alerts", or approved changes
					// get the list of servers
                    $servers = explode(" ", $c[servers]);  
                    
					$change_element = "<div class='item'> <br/> <span id='announcement'> Maintenence has been scheduled for</span>";
					$change_element .= "<br/> <br/> <div class='scrolly-list'> ";
                    foreach($servers as $s) { 
                        $change_element .= "<div class='scrolly-list-item'> <div style='padding: 8px;'> $s </div></div>"; 
                    }
					$change_element .= "</div><div style='display: flex; flex-direction: row;'><div style='width: 50%;'><br/> on <span class='data'> $c[date_created] </span> <br/> at <span class='data'> $c[date_created] </span></div>";
					$change_element .= "<div class='buttons' > <br/> <div class='button'> <a href='./requestException.php?id=$c[id]' >
											<span span class='button-text'>REQUEST EXCEPTION</span></a></div></div><br/></div></div>";

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
