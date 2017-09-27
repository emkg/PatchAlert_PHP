<?php require('top.php'); ?>

<!-- main content -->
<div class='page-container'>
  <form method='POST' name='change' enctype='multipart/form-data' action='createAlert_submit.php'>
	  <h2>Set up an alert</h2>
	  <br/>
	  On what day will the change take place? <br/>
	  <input type='text' id='datepicker' name='date' placeholder=""/>
	  <br/> At what time:<br/>
	  <input type='time' name='time' placeholder=""/>
      <br/>
	  <br/>
	  <input type='text' name='user' placeholder='Your name:' />
	  <br/>
      <input hidden=true name='id' value=<?php echo($_GET['id']) ?> />
      <div class='item' style='border: none;'>
	      <input style='color: white;' class='button' type='submit' value="APPROVE"/>
	  </div>
  </form>
</div>
<!-- end main content -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>

<?php require('bottom.php'); ?>