<?php
require 'Constants.php';
require 'OLink.php';

class Ovirt{
	
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
	
	public static function ovirt_create_vm_data($vm_name, $desc, $cluster, $template, $memory){

		$xml = "<vm>
					<name>$vm_name</name>
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
				
		return Ovirt::curl_postdata_and_getresponse(OLink::vmlink(), $xml);
								
	}
	
	public static function ovirt_graphicconsole_ticket($link){
		$xml = "<action>
					<ticket>
						<expiry>120</expiry>
					</ticket>
				</action>";
		return Ovirt::curl_postdata_and_getresponse($link, $xml);
	}
	
	public static function curl_postdata_and_getresponse($link, $xml){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, Constants::OVIRT_USERNAME . ":" . Constants::OVIRT_PASSWORD);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Ovirt::postheader());
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    return 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		return $result;
	}
	
	public static function curl_delete_and_getresponse($link){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, Constants::OVIRT_CURL_DELETE);
		curl_setopt($ch, CURLOPT_USERPWD, Constants::OVIRT_USERNAME . ":" . Constants::OVIRT_PASSWORD);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Ovirt::postheader());
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    return 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		return $result;
	}
	
	public static function curl_get_and_getresponse($link){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, Constants::OVIRT_CURL_GET);
		curl_setopt($ch, CURLOPT_USERPWD, Constants::OVIRT_USERNAME . ":" . Constants::OVIRT_PASSWORD);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Ovirt::getheader());
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    return 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		return $result;
	}	
		
}

?>
