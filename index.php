<?php require('top.php'); ?>
<?php echo($top); ?>

<!-- main content -->
<?php require('html_elements.php'); ?>
<div class='page-container'>

<div class='item'>
<?php
 $elements = getChangeElements(false);
 if ( $elements ) {

	foreach( $elements as $e ) {
		echo $e;
	}


  } else {
	echo($no_alerts_element);
  }
?>
</div>

<br/>

<a href='admin/admin-index.php' style='color: black; text-decoration: underline;'>
	Admin Entrance (restricted access)
</a>
</div>

<!-- end main content -->


<?php require('bottom.php'); ?>
