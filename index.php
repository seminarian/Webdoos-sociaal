<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/style.css" />
	<!-- This is how you would link your custom stylesheet -->
	
	<script src="js/vendor/modernizr.js"></script>
	<!--  <script src="js/vendor/jquery.js"></script> -->
	<script src="http://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="/js/vendor/fastclick.js"></script>
	<script src="js/foundation.min.js"></script>
	<script src="js/myapp.js"></script>
</head>
<body>
	<div class="row">
		<h1>Webdoos Sociaal</h1>
		<div id="spotlight">
			<p id="events"></p>
			<span id="name">test</span><span id="tweet"></span><span id="date"></span>
		</div>
		<button>Reload twitter-tabel</button>
		<p id="javascripttekst"></p>
		<?php
		session_start();
		require_once("inc/functions/config.php");
		require_once("inc/functions/curl.php");
		require_once("inc/functions/twitter.php");
		require_once("inc/functions/googleplus.php");
		require_once("inc/functions/instagram.php");
		require_once("inc/functions/foursquare.php");
		require_once('vendor/TwitterAPIExchange.php');
		require_once('inc/functions/db.php');
		require_once('inc/classes/tweet.class.php');
		require_once('inc/classes/instagram.class.php');
		require_once('inc/classes/foursquarecheckin.class.php');
		checkLoggedInFoursquare();
		handleFoursquareCode(); // na redirect $_GET['code'] opvangen en deze gebruikem om accestoken aan te maken.
		$venueObject = searchVenue('webdoos');
		// $venueStats = venueStats();
		// print_r($venueStats);
		// $eigenTweets = getTweetsFromUser();
	 //    $stringTwitter = getMentions();
		$tweets = getAllTweets();
	    $objectGoogleplus = googleZoekPublicPosts($key,"%23webdoos");
		$instagrams = getAllInstagrams();
		$objectHereNow = hereNow();
		$checkins = getAllCheckins();
		if (isset($_SESSION['foursquareToken'])) {
	    	// $objectHereNow = hereNow();
	    	// print_r($objectHereNow);
	    } else {
	    	//errormessage
	    }

	    // $ojbectLocation2Instagram = instagramGetPhotosByLocation('33247485');
	    echo '<div class="columns medium-7">';
	    	echo '<section id="foursquarecheckins">';
	    		renderCheckins($checkins);
	    	echo '</section>';
	    	require_once('modules/foursquare.php');
		    echo '<section id="twitter">';
		    	renderTweets($tweets);
				// if (!isset($stringTwitter['errors'])) {
				// 	require_once("modules/twitter-mentions.php");
				// } else {
				// 	echo '<h2><img style="height:45px;" src="assets/icon_twitter.png">#webdoos op Twitter:</h2>';
				// 	echo 'Error: ' . $stringTwitter['errors'][0]['message'];
				// }
				// require_once("modules/twitter-eigentweets.php");

				// if (!isset($eigenTweets['errors'])) {
				// 	require_once("modules/twitter-eigentweets.php");
				// } else {
				// 	echo '<h2><img style="height:45px;" src="assets/icon_twitter.png">Webdoos eigen tweets:</h2>';
				// 	echo 'Error: ' . $stringTwitter['errors'][0]['message'];
				// }
			echo '</section>';
		require_once("modules/googleplus.php");
		echo '</div>';
		echo '<div class="columns medium-5">
				<section id="instagram">';
				// require_once("modules/instagram.php");
				renderInstagrams($instagrams);

		echo	'</section>
				</div>';
		
		?>
	</div>
</body>
</html>

