<?php require('top.php'); ?>
<?php require('html_elements.php'); ?>
<!-- main content -->
<div class='page-container'>
  <div class='item' style='padding: 20px'>

<?php

$elements = getChangeElements(true);

foreach( $elements as $e ) {
	echo $e;
}

?>


<br/>


<a class='img-link' href='changeRequest.php'>
  <img id='new-alert' src='img/ic_fiber_new_black_48px.svg' alt="Request Change"/>
  <span><br/>Request a Change</span>
</a>
</div>
</div>

<!-- end main content -->

<?php require('bottom.php'); ?>
