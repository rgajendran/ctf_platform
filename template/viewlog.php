<?php
	$connection = mysqli_connect('localhost', 'root', '', 'ctff');
	//include './template/connection.php'; 
	if(isset($_COOKIE['TEAMCOOK'])){
		$viewlog_team = $_COOKIE['TEAMCOOK'];	
		$viewlog_sql = "SELECT LOG FROM `logger` WHERE TEAM=$viewlog_team ORDER BY DATE ASC";
		$viewlog_result = mysqli_query($connection, $viewlog_sql);
		while($viewlog_row = mysqli_fetch_assoc($viewlog_result)){
			$viewlog_log = $viewlog_row['LOG'];
			echo "<p>=> $viewlog_log</p>";
		}
	}else{
		header('location:../main.php');
	}
?>