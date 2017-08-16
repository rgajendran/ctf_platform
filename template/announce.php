<h1>Timer</h1>
<h1 id="timer"></h1>
<?php 
	include 'plattemplate/connection.php';
	$tRs = mysqli_query($connection, "SELECT END_TIME FROM game WHERE GAME_ID='".$_SESSION['GAMEID']."'");
	while($tRs_row = mysqli_fetch_assoc($tRs)){
		$_SESSION['ENDTIME'] = $tRs_row['END_TIME'];
	
	}
?>
<div class="status">
	<marquee><p><?php
	$ann_res = mysqli_query($connection,"SELECT ANNOUNCE FROM game WHERE GAME_ID='".$_SESSION['GAMEID']."'");
	while($ann_row = mysqli_fetch_assoc($ann_res)){
	echo $ann_row['ANNOUNCE'];
	}
	
	?></p></marquee>
	<script>var endtime = '<?php echo $_SESSION['ENDTIME'];?>';</script>
	<script src="js/timer.js"></script>
</div>