<?php
require '../class/Validator.php';
require '../class/Ovirt.php';
#require '../class/Generator.php';
require '../class/PlatformDB.php';

Validator::DetectErrors();

$credit = new Creditional();

if(isset($_POST['scenario']) && isset($_POST['vmn'])){
	$scenario = $_POST['scenario'];
	$vmname = $_POST['vmn'];
	if(strlen($vmname) >=5 && strlen($vmname) <=40)
	{
		if(PlatformDB::checkVMNumberCount($credit->getUsername())){
		$template = PlatformDB::getTemplateWithScenarioName($scenario);
		foreach($template as $temp => $size){
			$genVMname = $credit->getUsername()."_".$vmname."_".Ovirt::randomToken();
			$xml = simplexml_load_string(Ovirt::ovirt_create_vm($genVMname, "SinglePlayer", Constants::OVIRT_DEFAULT_CLUSTER, $temp, $size));
			$vmid = $xml->attributes();
			if(PlatformDB::insertVMDetails($credit->getUsername(), $genVMname, $vmid['id']) == Constants::DB_SUCCESS){
				echo Constants::SUCCESS_EXESP_CREATED_VM;
			}else{
				echo Constants::ERROR_EXESP_FAILED_TO_CREATE;
			}
		}
		}else{
			echo Constants::ERROR_EXESP_LIMIT_VM_TO_FIVE;
		}
	}else{
		echo Constants::ERROR_EXESP_CHARACTERS_5TO40;
	}	

}else{
	echo Constants::ERROR_EXESP_INVALID_REQUEST;
}


?>