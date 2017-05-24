<?php
if(isset($_POST['usr']) && isset($_POST['ps1']) && isset($_POST['ps2'])){
	
	$usr = urldecode(stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['usr'],FILTER_SANITIZE_STRING))))));
	$ps1 = urldecode(stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['ps1'],FILTER_SANITIZE_STRING))))));
	$ps2 = urldecode(stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['ps2'],FILTER_SANITIZE_STRING))))));
	
	//$string));
	
	include 'connection.php';
	$error = "ERROR";
	$success = "SUCCESS";

	if(!empty($usr) && !empty($ps1) && !empty($ps2)){
		if(strlen($usr) >= 3 && strlen($usr) <= 20){
			if(ctype_alpha($usr)){
				if($ps1 == $ps2){
					if(strlen($ps2) >= 3 && strlen($ps2) <=20){
						if(mysqli_num_rows(mysqli_query($connection, "SELECT USERNAME FROM loginusers WHERE USERNAME='$usr'")) == 0){
							$pass = md5($ps2."CTF");
							$sql = mysqli_query($connection, "INSERT INTO loginusers (USERNAME, PASSWORD) VALUES ('$usr', '$pass')");
							
							if($sql){
									$success = "Successfully Registered";															
							}else{
								$error = "Registration Error, Contact Admin [1001]";
							}		
	
						}else{
							$error = "Username already exists, Try someother name";
						}
	
					}else{
						$error = "Password should be between 3-20 characters";
					}
				}else{
					$error = "Your password doesn't match";
				}
			}else{
				$error = "Username should only include alphabets";	
			}	
		}else{
			$error = "Username should be between 3-20 characters";
		}
	}else{
		$error = "Please fill all the above fields";
	}
	
	if($error == "ERROR"){
		echo "<span style='color:green'>$success</span>";	
	}else if($success == "SUCCESS"){
		echo "<span style='color:orange'>$error</span>";
	}
}

?>