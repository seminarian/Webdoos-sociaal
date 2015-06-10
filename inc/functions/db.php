<?php
	require_once("config.php");
	
	function runQuery($sql,$arraywaarden) {
		$dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME,DBConfig::$DB_PASSWORD);
		$sth = $dbh->prepare($sql);
		$sth->execute($arraywaarden);
		$dbh=null;
	}

	function getQuery($sql) {
		$dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME,DBConfig::$DB_PASSWORD);
		$resultSet=$dbh->query($sql);
		return $resultSet;
	}

	function insertTweet($tweet) {
		$sql = "insert into tweets (name,tweet,date) Values (?,?,?)";
		$waarden = array($tweet->name,$tweet->tweet,$tweet->date);
		runQuery($sql,$waarden);
	}

	function insertInstagram($instagram) {
		$sql = "insert into instagrams (name,photo,text,profilepic,tags,date) Values (?,?,?,?,?,?)";
		$waarden = array($instagram->name,$instagram->photo,$instagram->text,$instagram->profilePic,$instagram->tags,$instagram->date);
		runQuery($sql,$waarden);
	}

	function insertGooglePlus($googlePlus) {
		$sql = "insert into googlepluses (name,message,userlink,postlink,date) Values (?,?,?,?,?)";
		$waarden = array($googlePlus->name,$googlePlus->message,$googlePlus->userLink,$googlePlus->postLink,$googlePlus->date);
		runQuery($sql,$waarden);
	}

	function insertCheckin($checkin) {
		$sql = "insert into foursquarecheckins (name) Values (?)";
		$waarden = array($checkin->name);
		runQuery($sql,$waarden);
	}

	function makeTweets($object) {
		$tweets = array();
		foreach($object as $items) {
			$dt = DateTime::createFromFormat('D M j H:i:s P Y', $items['created_at']);
			$tweet = New Tweet($items['user']['name'],$items['text'],$dt->format('Y-m-d H:i:s'));
			array_push($tweets, $tweet);
		}
		return $tweets;
	}

	function makeInstagrams($object) {
		$instagrams = array();
		foreach($object->data as $items) {
			$tags = '';
			foreach($items->tags as $tag) {
				$tags = $tags . ' ' .$tag;
			}
			$dt = date('Y-m-j h:m:s', $items->caption->created_time);
			$instagram = New Instagram($items->caption->from->username,$items->images->low_resolution->url,$items->caption->text,$items->caption->from->profile_picture,$tags,$dt);
			array_push($instagrams, $instagram);
		}
		return $instagrams;
	}

	function makeGooglePluses($object) {
		$googlePluses = array();
		foreach($object->items as $items) {
			// $dt = DateTime::createFromFormat('D M j H:i:s P Y', $items['created_at']);
			// echo $items->published . ' ';
			// $dt = date('Y-m-j h:m:s', $items->published);
			// print ($dt);
			$googlePlus = New GooglePlus($items->actor->displayName,$items->title,$items->actor->url,$items->url,$items->published);
			array_push($googlePluses, $googlePlus);
		}
		return $googlePluses;
	}

	function makeCheckins($object) {
		$checkins = array();
		// print_r($object);
		foreach($object->response->hereNow->items as $items) {
			// $dt = DateTime::createFromFormat('D M j H:i:s P Y', $items['created_at']);
			$checkin = New FoursquareCheckin($items->user->firstName . ' ' . $items->user->lastName);
			array_push($checkins, $checkin);
		}
		return $checkins;
	}

	function getAllTweets() {
		$sql = 'select name, tweet, date from tweets order by date DESC';
		$resultSet = getQuery($sql);
		$tweets = array();
		if ($resultSet->rowCount() > 0) {
			foreach($resultSet as $rij) {
				$tweet = New Tweet($rij['name'],$rij['tweet'],$rij['date']);
				array_push($tweets,$tweet);
			}
		}
		return $tweets;
	}

	function getAllInstagrams() {
		$sql = 'select name, photo, text, profilepic, tags, date from instagrams order by date DESC';
		$resultSet = getQuery($sql);
		$instagrams = array();
		if ($resultSet->rowCount() > 0) {
			foreach($resultSet as $rij) {
				$instagram = New Instagram($rij['name'],$rij['photo'],$rij['text'],$rij['profilepic'],$rij['tags'],$rij['date']);
				array_push($instagrams,$instagram);
			}
		}
		return $instagrams;
	}

	function getAllGooglePluses() {
		$sql = 'select name, message, userlink, postlink, date from googlepluses order by date DESC';
		$resultSet = getQuery($sql);
		$googlePluses = array();
		if ($resultSet->rowCount() > 0) {
			foreach($resultSet as $rij) {
				$googlePlus = New GooglePlus($rij['name'],$rij['message'],$rij['userlink'],$rij['postlink'],$rij['date']);
				array_push($googlePluses,$googlePlus);
			}
		}
		return $googlePluses;
	}

	function getAllCheckins() {
		$sql = 'select name from foursquarecheckins';
		$resultSet = getQuery($sql);
		$checkins = array();
		if ($resultSet->rowCount() > 0) {
			foreach($resultSet as $rij) {
				$checkin = New FoursquareCheckin($rij['name']);
				array_push($checkins,$checkin);
			}
		}
		return $checkins;
	}

	function isNewTweet($tweet) {
		$sql = 'select name from tweets where name = "' . $tweet->name . '" and date = "' . $tweet->date . '"';
		$resultSet=getQuery($sql);
		if($resultSet->rowCount() > 0) {
			return false;	
		} else {
			return true;
		}
	}

	function isNewInstagram($instagram) {
		$sql = 'select name from instagrams where name = "' . $instagram->name . '" and date = "' . $instagram->date . '"';
		$resultSet=getQuery($sql);
		if($resultSet->rowCount() > 0) { //geeft false als tab'el niet bestaat -> resultset is boolean
			return false;	
		} else {
			return true;
		}
	}

	function isNewGooglePlus($googlePlus) {
		$sql = 'select name from googlepluses where name = "' . $googlePlus->name . '" and postlink = "' . $googlePlus->postLink . '"';
		$resultSet=getQuery($sql);
		if($resultSet->rowCount() > 0) {
			return false;	
		} else {
			return true;
		}
	}

	function isNewCheckin($checkin) {
		$sql = 'select name from foursquarecheckins where name = "' . $checkin->name . '"';
		$resultSet=getQuery($sql);
		// print($sql);
		if($resultSet->rowCount() > 0) {
			return false;	
		} else {
			return true;
		}
	}

	function deleteAllCheckins() {
		$sql = 'delete from foursquarecheckins where 1';
		$resultSet = getQuery($sql);
	}

?>
