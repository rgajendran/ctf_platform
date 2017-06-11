<?php
class Constants{
	const LOCKPICK = 'lockpick';
	const SPLAYERDEFAULT = 'singleplayer.php?scenario=Edge%20Hill';										#Platform singleplayer.php
	const SECGEN_URL = '/var/www/html/SecGen/';															#Platform SecGen unused
	const OVIRT_USERNAME = 'admin@internal'; //temp username											#Ovirt
	const OVIRT_PASSWORD = 'oVirtEngine'; 	//temp password 											#Ovirt
	const OVIRT_DEFAULT_TEMPLATE_SIZE = '1073741824';													#Ovirt
	const OVIRT_API_URL = 'https://ctffrontend/ovirt-engine/api';										#Ovirt
	const OVIRT_DEFAULT_BOX = 'vagrant-debian7';														#Ovirt
	const OVIRT_DEFAULT_CLUSTER = 'ovirtcluster';														#Ovirt
	const OVIRT_DEFAULT_NETWORK = 'ovirtmgmt';															#Ovirt
	const OVIRT_CURL_POST = 'POST';																		#Ovirt Curl
	const OVIRT_CURL_GET = 'GET';																		#Ovirt Curl
	const OVIRT_CURL_DELETE = 'DELETE';																	#Ovirt Curl
	const DB_SUCCESS = 'SUCCESS';																		#DB
	const DB_FAILURE = 'FAILURE';																		#DB
	const ERROR_EXESP_CHARACTERS_5TO40 = "VM name should be between 5 to 40 characters";				#Errors exesp.php 
	const ERROR_EXESP_LIMIT_VM_TO_FIVE = "You can only create 5 VM's, delete unused VM's";				#Errors exesp.php
	const ERROR_EXESP_INVALID_REQUEST = "Technical Error [2001]";										#Errors exesp.php
	const ERROR_EXESP_FAILED_TO_CREATE = "Failed to Create VM";											#Errors exesp.php
	const SUCCESS_EXESP_CREATED_VM = "VM Created";														#Success exesp.php
}

?>