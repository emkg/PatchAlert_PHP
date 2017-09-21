<?php require('top.php'); ?>
<?php echo($top); ?>

<!-- main content -->
<?php require('html_elements.php'); ?>
<div class='page-container'>


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

<br/>

<a href='admin-index.php' style='color: #0E5CC9; text-decoration: underline;'>
	Admin Entrance (restricted access)
</a>
</div>

<!--close the connection -->
<?php mysql_close($dbhandle); ?>
<!-- end main content -->


<?php require('bottom.php'); ?>