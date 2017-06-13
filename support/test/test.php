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
         <form action="test.php" method="post">
			To file: <input type="text" name="tofile" />
			<input type="submit" />
		</form>         
         	<?php
         			
			$xml = simplexml_load_file("graphicsconsoleticket.xml");
			$attr = $xml->remote_viewer_connection_file;
			//echo $attr;
			
			if(isset($_POST['tofile'])){
				$filename = 'test-download.html';
				$htmlcode1 = "<HTML> \n <BODY>";
				$htmlcode2 = "</BODY> \n <HTML>";
				$somecontent = $htmlcode1.$_POST["tofile"].$htmlcode2;
				!$handle = fopen($filename, 'w');
				fwrite($handle, $somecontent);
				fclose($handle);
				
				
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
				header("Content-Length: ". filesize("$filename")-ob_get_length().";");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/octet-stream; "); 
				header("Content-Transfer-Encoding: binary");
				
				readfile($filename);

			}
					
			?> 
	</div>
</div>

</body>
</html>
