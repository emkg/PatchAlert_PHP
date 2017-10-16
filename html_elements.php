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
                    <h4> WHAT and WHY:        <span style='font-weight: normal;'>$a[whatwhy]</span></h4>
                    <h4> SUGGESTED PLAN:    <span style='font-weight: normal;'>$a[how]</span></h4>
                    <h4> AFFECTED SYSTEMS:    <span style='font-weight: normal;'>$a[software_systems]</span></h4>
                    <h4> EXPECTED DURATION:    <span style='font-weight: normal;'>$a[duration]</span></h4>
                    <h4> REQUESTED BY: <span style='font-weight: normal;'>$a[requestedBy]</span></h4>
                    <h4> SPECIFIC AFFECTED SYSTEMS: </h4>
                    <div class='scrolly-list'>";
                    foreach($servers as $s) { 
                        $change_element .= "<div class='scrolly-list-item'> <div style='padding: 8px;'> $s </div></div>"; 
                    }

                    $change_element .= "</div><br/><div>
                        <a class='img-link' href='declineAlert.php?id=$a[id]'>
                            <img id='thumb-down' src='../img/ic_thumb_down_black_24px.svg' alt='Deny'/>
                        </a>
                        <a href='createAlert.php?id=$a[id]' class='img-link'>
                            <img id='thumb-up' src='../img/ic_thumb_up_black_24px.svg' alt='Approve'/>
                        </a> 
                      
                   </div>
                    </div>";

                    array_push($changeElements, $change_element);
                }
			}
			
		} else {
			foreach($changes as $c) {
				if($c[isApproved] > 0) { // if not presented to admins, we only want "alerts", or approved changes
					// get the list of servers
                    $servers = explode(" ", $c[servers]);  
                    
					$change_element = "<div class='admin-item'> 
                            <h3> Maintenence has been scheduled </h3>";
                    $change_element .= "<h4> on <span style='font-weight: normal;'>$c[time]</span> </h4> 
                                        <h4> at <span style='font-weight: normal;'>$c[date]</span> </h4>";
					$change_element .= "<div class='scrolly-list'> ";
                    
                    foreach($servers as $s) { 
                        $change_element .= "<div class='scrolly-list-item'> 
                                            <div style='padding: 8px;'> $s </div>
                                            </div>"; 
                    }
					
					$change_element .= "</div>
                                <div class='buttons' > 
                                        <br/> 
                                        <div class='button'> 
                                            <a href='./requestException.php?id=$c[id]' >
											     <div class='button-text'>REQUEST EXCEPTION</div>
                                            </a>
                                        </div>
                                </div>
                                
                                <br/>
                                </div>";

					array_push($changeElements, $change_element);
				}
			}
		}

	return $changeElements;
}



$no_alerts_element = "<div class='admin-item'>
  <span class='nothing-to-see'>There are no service alerts right now.</span>
</div>";





?>
