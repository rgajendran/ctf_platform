<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['vals']) && isset($_POST['opt'])){
	$val = $_POST['vals'];    //vmnames
	$option = $_POST['opt'];  //options start, stop, run
	require '../class/Constants.php';
	session_start();
	if(in_array($val, $_SESSION[Constants::SESSION_SYSTEMS])){
		require '../class/PlatformDB.php';
		require '../class/Validator.php';
		require '../class/Ovirt.php';
		$c = new Creditional();
		switch($option){
			case "create":
				if(PlatformDB::check_vm_has_created_foruser($c->getUserId(), $c->getGameId(), $val)){
					$temp = PlatformDB::get_template_withGameID($c->getGameId());
					$genVMname = $c->getUsername()."_".$c->getGameId()."_".Ovirt::randomToken();
					$num = array_search($val, $_SESSION[Constants::SESSION_SYSTEMS])+1;
					$xml = simplexml_load_string(Ovirt::ovirt_create_vm($genVMname, $val."_".$c->getGameId(), Constants::OVIRT_DEFAULT_CLUSTER, $temp.$num, Constants::OVIRT_DEFAULT_TEMPLATE_SIZE));
					$vmid = $xml->attributes();
					if(!empty($vmid['id'])){
						if(PlatformDB::insertVMDetails("T",$c->getUserId(), $c->getGameId(), $val, $genVMname, $vmid['id']) == Constants::DB_SUCCESS){
							echo execOutput("create","success", $val);
						}else{
							echo execOutput("create","error","Technical Error : 1001");
						}				
					}else{
						echo execOutput("create","error","VM Creation Failed, Try again");
					}						
				}else{
					echo execOutput("create","error","VM Already Created");
				}
				break;
				
			case "start":
					$vmid = PlatformDB::get_vmid_by_userid_gameId_vmname($c->getUserId(), $c->getGameId(), $val);
					if($vmid != "NULL"){
						if(!in_array(Ovirt::ovirt_vm_status(OLink::get_vmstatus_link($vmid)), Ovirt::GraphicsAllowedVMOptions())){
							$xml =  simplexml_load_string(Ovirt::ovirt_start_vm(OLink::get_vmstart_link($vmid)));
							if(!empty($xml)){
								if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
									sleep(3);
									execOutput("start","success","Please wait, VM Starting");
								}else{
									execOutput("start","error",Constants::ERROR_VMSTART.Constants::ERROR_CODE_3005);
								}
							}else{
								execOutput("start","error",Constants::ERROR_VM_UNABLE_TO_DELETE.Constants::ERROR_CODE_3010);
							}	
						}else{
							execOutput("start","success","Please wait, Opening Viewer");
						}					
					}else{
						execOutput("start", "error", "VM not found, Technical Error");
					}	
				break;
				
			case "run":
					$vmid = PlatformDB::get_vmid_by_userid_gameId_vmname($c->getUserId(), $c->getGameId(), $val);
					if($vmid != "NULL"){
						if(in_array(Ovirt::ovirt_vm_status(OLink::get_vmstatus_link($vmid)), Ovirt::GraphicsAllowedVMOptions())){
							$gid= Ovirt::ovirt_getgraphicsconsoleId_vm(OLink::get_vmconsoleid_link($vmid));
							$remotefile = Ovirt::ovirt_graphicconsole_ticket(OLink::get_vmremote_connectionfile_link($vmid, $gid));
							execOutput("run","running",$remotefile);
						}else{
							execOutput("run","error",Constants::ERROR_VM_NOTUP_OR_POWERINGUP.Constants::ERROR_CODE_3011);
						}								
					}else{
						execOutput("run", "error", "VM not found, Technical Error");
					}
						
				break;	
				
			case "stop":
					$vmid = PlatformDB::get_vmid_by_userid_gameId_vmname($c->getUserId(), $c->getGameId(), $val);
					if($vmid != "NULL"){
						if(in_array(Ovirt::ovirt_vm_status(OLink::get_vmstatus_link($vmid)), Ovirt::GraphicsAllowedVMOptions())){
							$xml = simplexml_load_string(Ovirt::ovirt_shutdown_vm(OLink::get_vmshutdown_link($vmid)));
							if(!empty($xml)){
								if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
									Output("stop","success","Shutdown Complete");
								}else{
									Output("stop","error",Constants::ERROR_VMSHUTDOWN.Constants::ERROR_CODE_3006);
								}
							}else{
								Output("stop","error",Constants::ERROR_VM_UNABLE_TO_DELETE.Constants::ERROR_CODE_3010);
							}
						}else{
							Output("stop","error",Constants::ERROR_VM_NOTUP_OR_POWERINGUP.Constants::ERROR_CODE_3011);
						}
					}				
				break;		
		}
	}
}else if(isset($_POST['chooser'])){
	session_start();
	require '../class/Validator.php';
	require '../class/PlatformDB.php';
	require '../class/Ovirt.php';
	require '../class/Constants.php';	
	$c = new Creditional();
	$vmid = PlatformDB::get_vmid_by_userid_gameId_vmname($c->getUserId(), $c->getGameId(), $_POST['chooser']);
	if($vmid != "NULL"){
		if(in_array(Ovirt::ovirt_vm_status(OLink::get_vmstatus_link($vmid)), Ovirt::GraphicsAllowedVMOptions())){
			output(
			'<img src="images/icon/run.png" width="50" height="50" onclick="Vm.vmoption(\'start\');"/>', 
			'<img src="images/icon/start.png" width="50" height="50" style="opacity:0.1;"/>',
			'<img src="images/icon/stop.png" width="50" height="50" onclick="Vm.vmoption(\'stop\');"/>');				
		}else{
			output(
			'<img src="images/icon/run.png" width="50" height="50" onclick="Vm.vmoption(\'start\');"/>', 
			'<img src="images/icon/start.png" width="50" height="50" style="opacity:0.1;"/>',
			'<img src="images/icon/stop.png" width="50" height="50" style="opacity:0.1;"/>');				
		}		
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

function execOutput($switch, $status, $msg){
	echo $switch."##".$status."##".$msg;
}


?>