<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	  <div class="dropdown">
         <h1>hello</h1>
         <form method="post" action="test.php">
         	<input type="submit" value="Create" name="vmcreate" />
         </form>
         <form method="post" action="test.php">         
            <input type="submit" value="Delete" name="vmdelete" />
         </form>
         <form method="post" action="test.php">         
            <input type="submit" value="Post" name="vmpost" />
         </form>         
         	<?php
			/*require 'class/Validator.php';
         	require 'class/Ovirt.php';
         	
			Validator::DetectErrors();
			#7370696365

			if(isset($_POST['vmcreate'])){
				echo "<pre>".htmlentities(Ovirt::ovirt_create_vm_data("vmname", "desc", "ovirtcluster", "vagrant-debian7", "1073741824"))."</pre>";	
			}
			
			if(isset($_POST['vmdelete'])){
				echo "<pre>".htmlentities(Ovirt::ovirt_graphicconsole_ticket(OLink::get_vmremote_connectionfile("2b2c1ce4-b2a2-4d9d-bb94-476fe25b98de","7370696365")))."</pre>";
			}

			if(isset($_POST['vmpost'])){
				//echo "<pre>".htmlentities(Ovirt::)."</pre>";
			}		*/
			
			
			$xml = simplexml_load_file("support/test/createvm.xml");
			$attr = $xml->status;
			echo $attr;
			
			

					
			?> 
	</div>
</div>

</body>
</html>
