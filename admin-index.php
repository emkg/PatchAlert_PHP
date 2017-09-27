<?php require('top.php'); ?>
<?php require('html_elements.php'); ?>
<!-- main content -->
<div class='page-container'>
  <div class='item' style='padding: 20px'>
  
     
<?php 

$changeElements = getChangeElements(true);
if($changeElements) { echo("<p style='padding: 1px;'><span style='font-weight: bold;'>New</span> Changes to Approve:</p>"); } 
else { echo("<div class='admin-item'> <p style='padding: 1px;'>No changes to approve</p></div>"); }
foreach( $changeElements as $e ) {
	echo $e;
}

$requestData;
	
?>
  

<br/>


<div style='text-align: center; margin: 0 auto;'><a class='img-link' href='changeRequest.php'>
  <img id='new-alert' src='img/ic_fiber_new_black_48px.svg' alt="Request Change"/>
  <span><br/>Request a Change</span>
    </a></div>
</div>
</div>
	
<!-- end main content -->

<?php require('bottom.php'); ?>