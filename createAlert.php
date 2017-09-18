<?php require('top.php'); ?>

<!-- main content -->
<div class='page-container'>
  <form method='POST' name='change' enctype='multipart/form-data' action='createAlert_submit.php'>
	  <h2>Set a date for the service:</h2>
	  <br/>
	  When will the service take place? <br/>
	  <input type='date' name='date' placeholder="date"/>
	  From what time:<br/>
	  <input type='time' name='startTime' placeholder="Start Time"/>
      <br/>
	   Sign your name:
	  <br/>
	  <input type='text' name='user' />
	  <br/>
	<div class='item' style='border: none;'>
	  <input style='color: white;' class='button' type='submit' value="APPROVE"/>
	</div>
  </form>
</div>
<!-- end main content -->


<?php require('bottom.php'); ?>