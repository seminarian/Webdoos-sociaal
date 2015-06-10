<?php
	require_once(__DIR__ . "/db.php");
	require_once("googleplus.php");
	require_once("curl.php");
	require_once("config.php");
	require_once("../classes/googleplus.class.php");
	$objectGooglePluses = googleZoekPublicPosts($key,"%23webdoos");
	$googlePluses = makeGooglePluses($objectGooglePluses);
	$nieuweGooglePluses = array();
	foreach($googlePluses as $googlePlus) {
		if(isNewgooglePlus($googlePlus)) {
			insertgooglePlus($googlePlus);
			array_push($nieuweGooglePluses,$googlePlus);
		}
	}
	echo json_encode($nieuweGooglePluses);
?>