<?php
	require_once('../../vendor/TwitterAPIExchange.php');
	require_once(__DIR__ . "/db.php");
	require_once("twitter.php");
	require_once("curl.php");
	require_once("config.php");
	require_once("../classes/tweet.class.php");
	$eigenTweets = getTweetsFromUser();
	$mentionTweets = getMentions();
	$eigenTweets = makeTweets($eigenTweets);
	$mentionTweets = makeTweets($mentionTweets);
	$tweets = array_merge($eigenTweets, $mentionTweets);
	$nieuweTweets = array();
	foreach($tweets as $tweet) {
		if(isNewTweet($tweet)) {
			insertTweet($tweet);
			array_push($nieuweTweets,$tweet);
		}
	}
	echo json_encode($nieuweTweets);
?>