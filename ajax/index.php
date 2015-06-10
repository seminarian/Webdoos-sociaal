<?php
		require_once("../inc/functions/config.php");
		require_once("../inc/functions/curl.php");
		require_once("../inc/functions/twitter.php");
		require_once("../inc/functions/googleplus.php");
		require_once("../inc/functions/instagram.php");
		require_once("../inc/functions/foursquare.php");
		require_once('../vendor/TwitterAPIExchange.php');
		require_once('../inc/functions/db.php');
		require_once('../inc/classes/tweet.class.php');
		require_once('../inc/classes/instagram.class.php');
		require_once('../inc/classes/googleplus.class.php');
		require_once('../inc/classes/foursquarecheckin.class.php');


if(isset($_GET['select']) && $_GET['select'] == 'getTweets') {
	$tweets = getAllTweets();
	renderTweets($tweets,'Ajaxcall!!!' . date("h:m:s"));
}
if(isset($_GET['select']) && $_GET['select'] == 'getInstagrams') {
	$instagrams = getAllInstagrams();
	renderInstagrams($instagrams,'Ajaxcall!!!' . date("h:m:s"));
}
if(isset($_GET['select']) && $_GET['select'] == 'getGooglePluses') {
	$googlePluses = getAllGooglePluses();
	renderGooglePluses($googlePluses,'Ajaxcall!!!' . date("h:m:s"));
}
if(isset($_GET['select']) && $_GET['select'] == 'getFoursquareCheckins') {
	$checkins = getAllCheckins();
	renderCheckins($checkins,'Ajaxcall!!!' . date("h:m:s"));
}



?>