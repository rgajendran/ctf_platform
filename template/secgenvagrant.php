<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
require '../class/Constants.php';
require '../class/SecGenOvirt.php';


if(isset($_POST['scenario'])){
	$file = $_POST['scenario'];
	if(file_exists(Constants::SECGEN_URL.$file)){
		echo exec(SecGenOvirt::spinup_secgen_ovirt_short($file, "VMNAME", "p"));
		//echo SecGenOvirt::spinup_secgen_ovirt_short($file, "VMNAME", "p");
	}else{
		echo "Invalid Scenario";
	}
}else{
	echo "Not Sent";
}


?>