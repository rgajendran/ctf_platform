<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['jteam']) && isset($_POST['gid'])) {
	require '../class/Validator.php';
	require '../class/PlatformDB.php';
	$c = new Creditional();
	$team = Validator::PregAlphaNumericUnderScoreSpace($_POST['jteam']);
	$gameid = Validator::PregAlphaNumericUnderScoreSpace($_POST['gid']);
	include 'connection.php';
	$teamno = 0;
	$q1 = mysqli_query($connection, "SELECT GAME_ID FROM game WHERE GAME_ID='$gameid' AND TYPE='openforall'");
	if (mysqli_num_rows($q1) == 1) {
		$teamno = PlatformDB::getTeamRowCount($team, $gameid);
		if ($teamno != 0) {
			if (PlatformDB::get_Team_Count_With_GameId_And_TeamNO($gameid, $teamno)) {
				$q7 = mysqli_query($connection, "SELECT TEAMNO FROM game_players WHERE GAME_ID='$gameid' AND PLAYER='" . $c -> getUserId() . "'");
				if (mysqli_num_rows($q7) == 0) {
					$q4 = mysqli_query($connection, "SELECT TEMPLATE, SCENARIO FROM game WHERE GAME_ID='$gameid'");
					if (mysqli_num_rows($q4) == 1) {
						$temp = mysqli_fetch_assoc($q4);
						$template = $temp['TEMPLATE'];
						$scenario = $temp['SCENARIO'];
						$q5 = mysqli_query($connection, "INSERT INTO game_players (GAME_ID, TEAMNO, TEAM, PLAYER, P_STATUS) VALUES ('$gameid','$teamno','$team','" . $c -> getUserId() . "','1')");
						if ($q5) {
							$q6 = mysqli_query($connection, "INSERT INTO scenariologger (GAME_ID, SCENARIO, TEMPLATE, USERID) VALUES ('$gameid','$scenario','$template','" . $c -> getUserId() . "')");
							if ($q6) {
								outputsuccess("Successfully Joined");
							} else {
								outputerror("Technical Error 4");
							}
						} else {
							outputerror("Technical Error 3" . mysqli_error($connection));
						}
					} else {
						outputerror("Invalid Data 2");
					}
				} else if (mysqli_num_rows($q7) == 1) {
					outputwarn("Already Joined the Game");
				} else {
					outputerror("Techincal Error");
				}
			} else {
				outputerror("Team can only have 5 players");
			}
		}
	} else {
		outputerror("Invalid Data 1");
	}
}

function outputsuccess($msg) {
	echo "success##" . $msg;
}

function outputerror($msg) {
	echo "error##" . $msg;
}

function outputwarn($msg) {
	echo "warn##" . $msg;
}
?>