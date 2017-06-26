<?php

if (isset($_POST['uname']) && isset($_POST['psw'])) {
	session_start();
	$username = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['uname']), FILTER_SANITIZE_STRING))));
	$password = stripslashes(htmlspecialchars(htmlentities(trim(filter_var(($_POST['psw']), FILTER_SANITIZE_STRING)))));

	include '../plattemplate/connection.php';
	if (strlen($username) >= 3 && strlen($username) <= 20) {
		if (strlen($password) >= 3 && strlen($password) <= 20) {
			$hash = md5($password . "CTF");
			$result = mysqli_query($connection, "SELECT USERNAME,PASSWORD,TYPE,USERID FROM loginusers WHERE USERNAME='$username' AND PASSWORD='$hash'");
			if ($result) {
				$num = mysqli_num_rows($result);
				if ($num === 1) {
					while ($row = mysqli_fetch_assoc($result)) {

						$_SESSION['USERNAME'] = $username;
						$_SESSION['TYPE'] = $row['TYPE'];
						$_SESSION['USERID'] = $row['USERID'];
						echo "<h3 style='color:green;'>Login Success</h3>";
					}

				} else {
					echo "<h3 style='color:orange;'>Login Fail</h3>";
				}
			}else{
				echo "<h3 style='color:orange;'>Login Fail</h3>";
			}
		} else {
			echo "<h3 style='color:orange;'>Login Fail</h3>";
		}
	} else {
		echo "<h3 style='color:orange;'>Login Fail</h3>";
	}
}
?>