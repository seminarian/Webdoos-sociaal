<?php
function curl($method,$url,$fields=null) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	if ($method == 'GET') {
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
	} elseif ($method =='POST') {
		curl_setopt($ch, CURLOPT_POST, 1); // voor wat staat die 1, true toch?
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	}
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$object = json_decode(curl_exec($ch));
	return $object;
}
?>