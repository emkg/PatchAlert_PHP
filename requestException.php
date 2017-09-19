
<?php require('top.php'); ?>
<?php require('db_ops.php'); ?>
<!-- main content -->
<div class="page-container" >
  <form method='POST' name='exception' action='requestException_submit.php' enctype='multipart/form-data'>
	<h2>Request an Exception to the Patch.</h2>

	<br/>
	<br/>

	Please let us know who you are:
	<br/>

	<input type='text' name='user' />
	<br/>


	<label for="servers">What server do you need withheld from the scheduled update?</label>
    <select id="servers" name="server-select">
    <?php
        $id =$_GET['id'];
        $servers = getChangeServers($id);
        foreach($servers as $s) {
           echo ("<option value='$s[servers]'>$s[servers]</option>");
        }
    ?>
    </select>

	<br/>

	Please provide a reason why you need this exception: <br/>
	<textarea type='text' name='reason' rows='4'></textarea>

	<br/>
	<br/>

	What would be an acceptible date and time to reschedule this update?
	<input type='text' id='datepicker' name='altDate' placeholder=""/>

	<br/>

	<input type='time' name='altTime' placeholder=""/>

	<br/>

	<div class='item' style='border: none;'>
	  <input style='color: white;' class='button' type='submit' value="submit"/>
	</div>
  </form>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>

<!-- end main content -->


<?php require('bottom.php'); ?>
  				
