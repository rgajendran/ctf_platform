<?php

/* ------- Test Document ------------ */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require '/var/www/html/platform/class/Validator.php';
require '/var/www/html/platform/class/Constants.php';
include '/var/www/html/platform/plattemplate/connection.php';

$sql = mysqli_query($connection, "SELECT * FROM backend");
if(mysqli_num_rows($sql) > 0){
	$pro = mysqli_query($connection, "SELECT * FROM backend WHERE PROCESSING='1'");
	if(mysqli_num_rows($pro) <= 3){
		$getScenario = mysqli_query($connection, "SELECT * FROM backend WHERE PROCESSING='0' LIMIT 1");
		while($row = mysqli_fetch_assoc($getScenario)){
			$scenario =  $row['SCENARIO'];
			$id = $row['ID'];
			$secgendir = Constants::SECGEN_URL;
			$ovuser = Constants::OVIRT_USERNAME;
			$ovpass = Constants::OVIRT_PASSWORD;
			$ovtemp = Constants::OVIRT_DEFAULT_BOX;
			$ovurl = Constants::OVIRT_API_URL;
			$logdir = Constants::LOC_LOG_DIR;
			$vmname = randomToken();
			echo '/usr/bin/nohup ruby '.$secgendir.'/secgen.rb --scenario '.$secgendir.'/'.$scenario.' --ovirtuser '.$ovuser.' --ovirtpass '.$ovpass.' --ovirt-template '.$ovtemp.' --ovirt-url '.$ovurl.
			' --ovirt-vmname '.$vmname.' p > '.Constants::LOC_LOG_DIR.'/sc_backend.txt &';
			$insert = mysqli_query($connection, "UPDATE backend SET PROCESSING='1' WHERE ID='$id'");
			if($insert){
				$fu = mysqli_query($connection, "UPDATE backend SET FOLDER='$vmname' WHERE ID='$id'");
				if($fu){
					echo "Execution Successful (Scenario : $scenario & FName : $vmname )";
				}else{
					echo "Unable to update folder (Name : $vmname )";
				}
			}else{
				echo "Unable to update processing (Scenario : $scenario )";
			}
		}
	}else{
		echo "Command Execution in Progress";
	}
}else{
	echo "No Commands Found";
}

function randomToken() {
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $letterLength = strlen($letters) - 1; 
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $letterLength);
        $password[] = $letters[$n];
    }
    return implode($password); 
}

?>