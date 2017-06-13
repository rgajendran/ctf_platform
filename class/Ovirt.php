<?php
require 'Curl.php';
require 'OLink.php';

class Ovirt{
	
	public static function randomToken() {
	    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $password = array(); 
	    $letterLength = strlen($letters) - 1; 
	    for ($i = 0; $i < 10; $i++) {
	        $n = rand(0, $letterLength);
	        $password[] = $letters[$n];
	    }
	    return implode($password); 
	}
	
	public static function GraphicsAllowedVMOptions(){
			$new = array(Constants::OVIRT_VM_STATUS_POWERING_UP,Constants::OVIRT_VM_STATUS_UP);
			return $new;
	}
	
	public static function getheader(){
		$headers = array();
		$headers[] = "Version: 4";
		$headers[] = "Accept: application/xml";
		return $headers;
	}

	public static function postheader(){
		$headers = array();
		$headers[] = "Version: 4";
		$headers[] = "Accept: application/xml";
		$headers[] = "Content-type: application/xml";
		return $headers;
	}
	
	public static function ovirt_create_vm($vm_name, $desc, $cluster, $template, $memory){

		$xml = "<vm>
					<name>".$vm_name."</name>
						<description>$desc</description>
						<cluster>
							<name>$cluster</name>
						</cluster>
						<template>
							<name>$template</name>
						</template>
						<memory>$memory</memory>
						<os>
							<boot>
								<devices>
									<device>hd</device>
								</devices>
							</boot>
						</os>
					</vm>";
				
		return Curl::curl_postdata_and_getresponse(OLink::get_vmpath_link(), $xml);
								
	}
	
	public static function ovirt_graphicconsole_ticket($link){
		$xml = "<action>
					<ticket>
						<expiry>120</expiry>
					</ticket>
				</action>";
		$respond = simplexml_load_string(Curl::curl_postdata_and_getresponse($link, $xml));
		return $respond->remote_viewer_connection_file;
	}
	
	public static function ovirt_start_vm($link){
		$xml = "<action>
					<vm>
						<os>
							<boot>
								<devices>
									<device>hd</device>
								</devices>
							</boot>
						</os>
					</vm>
				</action>";
		return Curl::curl_postdata_and_getresponse($link, $xml);	
	}
	
	public static function ovirt_shutdown_vm($link){
		$xml = "<action/>";
		return Curl::curl_postdata_and_getresponse($link, $xml);
	}
	
	public static function ovirt_delete_vm($link){
		return Curl::curl_delete_and_getresponse($link);
	}
	
	public static function ovirt_vm_status($link){
		$xml = simplexml_load_string(Curl::curl_get_and_getresponse($link));
		return $xml->status;
	}
	
	public static function ovirt_getgraphicsconsoleId_vm($link){
		$xml = simplexml_load_string(Curl::curl_get_and_getresponse($link));
		$attr = $xml->graphics_console->attributes();
		return $attr['id'];
	}
		
}

?>
