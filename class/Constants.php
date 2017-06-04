<?php
class Constants{
	const LOCKPICK = 'lockpick';
	const SPLAYERDEFAULT = 'singleplayer.php?scenario=default_scenario.xml&&fp=scenarios/default_scenario.xml';
	const SECGEN_URL = '/var/www/html/SecGen/';
	/*------- ovirt -------*/
	const OVIRT_USERNAME = 'admin@internal'; //temp username
	const OVIRT_PASSWORD = 'oVirtEngine'; 	//temp password 
	const OVIRT_DEFAULT_TEMPLATE_SIZE = '1073741824';
	const OVIRT_API_URL = 'https://ctffrontend/ovirt-engine/api';
	const OVIRT_DEFAULT_BOX = 'vagrant-debian7';
	const OVIRT_DEFAULT_CLUSTER = 'ovirtcluster';
	const OVIRT_DEFAULT_NETWORK = 'ovirtmgmt';
	
	/*------- return functions --------*/
	public static function vmlink(){
		return self::OVIRT_API_URL."/vms";
	}
	
	
}

?>