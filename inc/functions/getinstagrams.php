<?php
	require_once(__DIR__ . "/db.php");
	require_once("instagram.php");
	require_once("curl.php");
	require_once("config.php");
	require_once("../classes/instagram.class.php");
	$objectTagInstagrams = instagramGetPhotosByTag($instagramTag);
	$objectLocationInstagrams = instagramGetPhotosByLocation($locationId);
	$tagInstagrams = makeInstagrams($objectTagInstagrams);
	$locationInstagrams = makeInstagrams($objectLocationInstagrams);
	$instagrams = array_merge($tagInstagrams, $locationInstagrams);
	$nieuweInstagrams = array();
	foreach($instagrams as $instagram) {
		if(isNewInstagram($instagram)) {
			insertInstagram($instagram);
			array_push($nieuweInstagrams,$instagram);
		}
	}
	echo json_encode($nieuweInstagrams);
?>