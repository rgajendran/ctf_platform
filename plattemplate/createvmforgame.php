<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['vals']) && isset($_POST['opt'])){
	$val = $_POST['vals'];    //vmnames
	$option = $_POST['opt'];  //options start, stop, run
	session_start();
	if(in_array($val, $_SESSION['SYSTEMS'])){
		
		require '../class/PlatformDB.php';
		require '../class/Validator.php';
		require '../class/Ovirt.php';
		require '../class/Constants.php';
		$c = new Creditional();
		switch($option){
			case "create":
				if(PlatformDB::check_vm_has_created_foruser($c->getUserId(), $c->getGameId(), $val)){
					$temp = PlatformDB::get_template_withGameID($c->getGameId());
					$genVMname = $c->getUsername()."_".$c->getGameId()."_".Ovirt::randomToken();
					$xml = simplexml_load_string(Ovirt::ovirt_create_vm($genVMname, "SinglePlayer", Constants::OVIRT_DEFAULT_CLUSTER, $temp.$int, Constants::OVIRT_DEFAULT_TEMPLATE_SIZE));
					$vmid = $xml->attributes();
					if(!empty($vmid['id'])){
						if(PlatformDB::insertVMDetails("T",$c->getUserId(), $c->getGameId(), $val, $genVMname, $vmid['id']) == Constants::DB_SUCCESS){
							echo "Success";
						}else{
							echo "Technical Error : 1001";
						}				
					}else{
						echo "VM Creation Failed, Try again";
					}						
				}else{
					echo "VM Already Created";
				}
				break;
				
			case "stop":
				
				break;
				
			case "run":
				
				break;		
		}
	}
}else if(isset($_POST['chooser'])){
	session_start();
	if(in_array($_POST['chooser'], $_SESSION['STARTED'])){
		output(
		'<img src="images/icon/run.png" width="50" height="50" onclick="Vm.vmoption(\'run\');"/>', 
		'<img src="images/icon/start.png" width="50" height="50" style="opacity:0.1;"/>',
		'<img src="images/icon/stop.png" width="50" height="50" onclick="Vm.vmoption(\'stop\');"/>');		
	}else{
		output(
		'<img src="images/icon/run.png" width="50" height="50" style="opacity:0.1;"/>', 
		'<img src="images/icon/start.png" width="50" height="50" onclick="Vm.vmoption(\'create\');"/>',
		'<img src="images/icon/stop.png" width="50" height="50" style="opacity:0.1;"/>');
	}
	
}




function output($run, $start, $stop){
	$arr = array($run, $start, $stop);
	echo implode("##", $arr);
}







if(isset($_POST['HELLOWORLD'])){
	$credit = new Creditional();
	$temp = PlatformDB::get_template_withGameID($_SESSION['GAMEID']);
	for($int = 0; $int < PlatformDB::getVMNo_using_scenario_and_gameid($_SESSION['GAMEID']); $i++){
			$genVMname = $credit->getUsername()."_".$credit->getGameId()."_".Ovirt::randomToken();
			$xml = simplexml_load_string(Ovirt::ovirt_create_vm($genVMname, "SinglePlayer", Constants::OVIRT_DEFAULT_CLUSTER, $temp.$i, Constants::OVIRT_DEFAULT_TEMPLATE_SIZE));
			$vmid = $xml->attributes();
			if(!empty($vmid['id'])){
				if(PlatformDB::insertVMDetailsMainFile("T",$credit->getUserId(), $credit->getGameId(), $genVMname, $vmid['id']) == Constants::DB_SUCCESS){
					echo Constants::SUCCESS_EXESP_CREATED_VM;
				}else{
					echo Constants::ERROR_EXESP_FAILED_TO_CREATE;
				}				
			}else{
				echo Constants::ERROR_EXESP_INVALID_REQUEST.Constants::ERROR_CODE_3002;
			}		
	}
}


?>