<?php require('top.php'); ?>
<?php require('db_ops.php'); ?>
<!-- main content -->
<div class='page-container'>
  <form method='POST' id='change' action='db_ops.php' enctype='multipart/form-data'>
	  <h2>Request a change:</h2>
	  <br/><br/>
	  <input type='text' id='datepicker' name='date' placeholder="Today's Date:"/>
	  <br/>
	  What is the justification for why the request is being made, <br/>
	  including any alternative approaches that were considered, <br/>
	  and the implications of not making the change?
	  <br/><br/>
	  <textarea type='text' rows='4' name='justification'></textarea> <br/>
	  What servers will be affected? <br/>
      <select id="servers" name="server-select">

        <?php
          foreach($server_list as $s) {
               echo ("<option value='$s[name]'>$s[name]</option>");
            }
        ?>
      </select>
	  <br/>
	  <br/>
	  What additional resources and/or costs will be required, if any?
	  <br/><br/>
	  <textarea type='text' name='resources' rows='4'></textarea> <br/>
	  <input type='text' name='user' placeholder='Your name:'/>
	  <br/>
	<div class='item' style='border: none;'>
	  <input style='color: white;' class='button' type='submit' value="submit"/>
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
