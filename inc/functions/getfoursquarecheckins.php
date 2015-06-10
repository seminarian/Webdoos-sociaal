<?php
	require_once(__DIR__ . "/db.php");
	require_once("foursquare.php");
	require_once("curl.php");
	require_once("config.php");
	require_once("../classes/foursquarecheckin.class.php");
	session_start();
	$objectCheckins = hereNow();
	// print_r($objectCheckins);
	$checkins = makeCheckins($objectCheckins);
	$nieuweCheckins = array();
	//ERROR handling invoegen?
	foreach($checkins as $checkin) {
		if(isNewCheckin($checkin)) {
			array_push($nieuweCheckins,$checkin);
		}
	}
	deleteAllCheckins();
	foreach($checkins as $checkin) {
		insertCheckin($checkin);
	}
	echo json_encode($nieuweCheckins);
?>