
<?php require('top.php'); ?>
<?php require('db_ops.php'); ?>
<!-- main content -->
<div class="page-container" >
  <form method='POST' name='exception' action='requestException_submit.php' enctype='multipart/form-data'>
	<h2>Request to reschedule this update on a particular system.</h2>

	<label for="server-select[]">What server do you need withheld from the scheduled update?</label>
    <select multiple id="server-exceptions" name="server-select[]">
    <?php
        $id =$_GET['id'];
        $servers = getChangeServers($id);
        // I don't know why this is the only way that works right now
        foreach($servers as $s) {
           $list = explode(" ", $s[servers]);
            foreach($list as $item) { echo ("<option value='$item'>$item</option>"); }
        }
    ?>
    </select>    
    <label for="os">What's the OS of the server?</label>
    <select multiple id="server-exceptions" name="os">
         <option value='Windows'>Windows</option>
         <option value='Mac'>Mac</option>
         <option value='Linux'>Linux</option>
    </select>    
	<label>Please provide a reason why you need this exception: </label>
	<textarea type='text' name='reason' rows='4'></textarea>
	<input type='text' name='user' placeholder='Your name:'/>
	<input type='text' name='email' placeholder='Your email:'/>
    <input hidden=true name='id' value=<?php echo($_GET['id'])?> />
    <div class='button'> <a class="button-text" onClick="document.exception.submit();">SUBMIT<a/></div>
  </form>
</div>
<!-- end main content -->


<?php require('bottom.php'); ?>
  				