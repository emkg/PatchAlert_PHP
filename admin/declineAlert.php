<?php require('../top.php'); ?>

<!-- main content -->
<div class='page-container'>
  <form method='POST' name='decline' enctype='multipart/form-data' action='declineAlert_submit.php'>
	  <h2>Deny a change request</h2>
	  <br/>
	  <p>Why is this change being denied?</p>
	  <textarea type='text' name='decline-reason' rows='5'></textarea>
      <input type='text' name='user' placeholder='Your name:'/> 
      <input hidden=true name='id' value=<?php echo($_GET['id']) ?> />
      <div class='button'> <a class="button-text" onClick="document.decline.submit();">SUBMIT<a/></div>
  </form>
</div>
<!-- end main content -->

<?php require('../bottom.php'); ?>