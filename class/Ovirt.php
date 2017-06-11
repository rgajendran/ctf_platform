<?php
require 'Constants.php';
require 'OLink.php';
require 'Curl.php';

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
		return Ovirt::curl_postdata_and_getresponse($link, $xml);
	}
	
	public static function ovirt_start_vm($link){
		$xml = "<action>
					<vm>
						<os>
							<boot>
								<devices>
									<device>cdrom</device>
								</devices>
							</boot>
						</os>
					</vm>
				</action>";
		return Ovirt::ovirt_start_vm($link, $xml);		
	}
	

		
}

?>
