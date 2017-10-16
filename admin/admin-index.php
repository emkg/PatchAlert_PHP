<?php require('../top.php'); ?>
<?php require('../html_elements.php'); ?>
<!-- main content -->
<div class='page-container'>
  <div class='item' style='padding: 20px'>


<?php

$elements = getChangeElements(true);
if($elements) { echo("<p style='padding: 1px;'><span style='font-weight: bold;'>New</span> Changes to Approve</p>"); }
else { echo("<div class='admin-item'> <span class='nothing-to-see'>There are no changes pending.</span></div>"); }
foreach( $elements as $e ) {
	echo $e;
}

?>


<br/>


<div style='text-align: center; margin: 0 auto;'><a class='img-link' href='changeRequest.php'>
  <img id='new-alert' src='../img/ic_fiber_new_black_48px.svg' alt="Request Change"/>
  <span><br/>Request a Change</span>
    </a></div>
</div>
</div>

<!-- end main content -->

<?php require('../bottom.php'); ?>
