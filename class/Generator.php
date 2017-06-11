<?php

class Generator{
	
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

}
?>