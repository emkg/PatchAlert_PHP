
<?php require('top.php'); ?>

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

	What server do you need withheld from the scheduled update?
	<br/>

	<br/>

	<input id='serverselect' type='text' autocomplete='on' list='serverlist' style='width:95%;' />
	  <button id='add' onclick='addListItem()' type='button'><a href=''></a></button>
	  <datalist id='serverlist'>
		  <option value="{{s}}">{{s}}</option>
	  </datalist>

	<!-- This will be hidden? -->
	<input id='server' name='server' readonly>

	<br/>

	Please provide a reason why you need this exception: <br/>
	<textarea type='text' name='reason' rows='4'></textarea>

	<br/>
	<br/>

	What would be an acceptible date and time to reschedule this update? <br/>
	<input type='date' name='altDate' placeholder="alt date"/>

	<br/>

	<input type='time' name='altTime' placeholder="alt time"/>

	<br/>

	<div class='item' style='border: none;'>
	  <input style='color: white;' class='button' type='submit' value="submit"/>
	</div>
  </form>
</div>

<!-- end main content -->


<?php require('bottom.php'); ?>
  				