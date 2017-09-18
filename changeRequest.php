<?php require('top.php'); ?>

<!-- main content -->
<div class='page-container'>
  <form method='POST' id='change' action='db_ops.php' enctype='multipart/form-data'>
	  <h2>Request a change:</h2>
	  <br/><br/>
	  Today's Date: <br/>
	  <input type='date' name='date' placeholder="date"/>
	  <br/>
	  What is the justification for why the request is being made, <br/>
	  including any alternative approaches that were considered, <br/>
	  and the implications of not making the change?
	  <br/>
	  <input type='text' maxlength='2000' style='width:95%;'/> <br/>
	  What servers will be affected?<br/>
	  <input type='text' name='servers' id='servers' placeholder="Servers" maxlength='2000' style='width:95%;'/>
		<button id='add' onclick='addServers()' type='button'><a href=''></a></button>
	  <br/>
	  <br/>
	  What additional resources and/or costs qill be required, if any?
	  <br/>
	  <input type='text' maxlength='2000' style='width:95%;'/> <br/>
	  Your name:
	  <br/>
	  <input type='text' name='user' />
	  <br/>
	<div class='item' style='border: none;'>
	  <input style='color: white;' class='button' type='submit' value="submit"/>
	</div>
  </form>
</div>
<script>
  function addServers() {
	var servers = document.getElementById('servers').value;
	regex = /((,\s)|(\s\s)|(;\s)|(\t\s)|[,\s;\t\n])/g;
	servers = servers.replace(regex, ",")
	servers = servers.split(",");
	document.getElementById('servers').value = servers
  }
</script>

<!-- end main content -->
<?php require('bottom.php'); ?>