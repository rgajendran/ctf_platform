<?php
class Curl{
		
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