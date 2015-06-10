<?php

//Van de eerste 2 posts mss ook de content tonen meer spacey.. deronder tabel-striped met andere erbij. En mss aftellen in dagen en seconden wanneer gepost.
// en mss ipv met curl.. ook eens de library gebruiken.
// social plugins bekijken voor bvb drupal.. of andere sites.

//url_encode implementeren

// Muziekje + transition effects bij nieuwe incomming social.! Misschien eens wat GSAP?

//Kleuren en/of Logo hergebruiken. Mss content in vorm van het logo steken? stukken van content of geheel van content!


//*****TWITTER*****
function printTweets($string) {
    if (isset($string['errors'][0]['message']) && string['errors'][0]['message'] != "") {
        echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>" . $string['errors'][0]["message"] . "</em></p>";
        print_r($string);
        exit();
    }

    foreach ($string as $items) {
        echo "Time and Date of Tweet: " . $items['created_at'] . "<br />";
        echo "Tweet: " . $items['text'] . "<br />";
        echo "Tweeted by: " . $items['user']['name'] . "<br />";
        echo "Screen name: " . $items['user']['screen_name'] . "<br />";
        echo "Followers: " . $items['user']['followers_count'] . "<br />";
        echo "Friends: " . $items['user']['friends_count'] . "<br />";
        echo "Listed: " . $items['user']['listed_count'] . "<br /><hr />";
        echo 'Created at: ' . $items['created_at'];
    }

}

function searchTweets($zoekString) { //raar result
    global $settings;
    $requestMethod = "GET";
    //https://api.twitter.com/1.1/search/tweets.json parameter q = required
    $url = 'https://api.twitter.com/1.1/search/tweets.json'; 
    $getfield = "?q=" . $zoekString;
    $twitter = new TwitterAPIExchange($settings);
    $string = json_decode(
        $twitter->setGetfield($getfield)
       ->buildOauth($url, $requestMethod)
        ->performRequest(), $assoc = TRUE);
    return $string;

}



// https://www.googleapis.com/plus/v1/people/{userId}/activities/public

// https://www.googleapis.com/plus/v1/people/115885880690934956740/activities/public

// https://plus.google.com/u/0/113384192950187076820 anja wessels
//GOOGLEPLUS


$zoekstring = "jan%20doms";

function nextResults($ch,$token) {
	$zoekstring = "jan%20doms";
	curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/plus/v1/people?query=%27" . $zoekstring . "%27&key=AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug&pageToken=" . $token);
	$json1 = json_decode(curl_exec($ch));

	print("<br><br>");
	// print_r($json1);

	foreach ($json1 as $rijtitel => $rijwaarde) {
		// print("rijtitel: " . $rijtitel . " rijwaarde: ");
		// print_r($rijwaarde);
		print("<br><br><br>");
		if($rijtitel == "items") {
			$items = $rijwaarde;
		}
	}
	// print_r($items);
	if (!empty($items)) {
		foreach ($items as $item) {
		print("<br>");
			if($item->displayName) {
					// print_r($item);
					echo 'Image: <img src="' . $item->image->url . '">';
					echo 'ID: ' . $item->id;
			}
			print("<br>");
		}
		// print("<br><br>gebruikte token:" . $token . "<br><br>");
		// print("nextpagetoken:" . $json1->nextPageToken);
		$nexttoken = $json1->nextPageToken;
		// if ($token == $nexttoken) {
		// 	return null;
		// }
		return $nexttoken;
	} else {
		return null;
	}
	
}

// API key 
$key = 'AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug';


$str = "&key=" . $key;
//https://www.googleapis.com/plus/v1/people?query=%27jan%20doms%27&key=AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/plus/v1/people?query=" . $zoekstring . "&key=AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug");
// curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/plus/v1/people?query='jan doms'".$str);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// grab URL and pass it to the browser
// $json=json_decode(curl_exec($ch),true);
$json = json_decode(curl_exec($ch));
// print_r($json);

foreach ($json as $rijtitel => $rijwaarde) {
	print("rijtitel: " . $rijtitel . " rijwaarde: ");
	print_r($rijwaarde);
	print("<br><br><br>");
	if($rijtitel == "items") {
		$items = $rijwaarde;
	}
}

foreach ($items as $item) {
	print("<br>");
	if($item->displayName) {
			// print_r($item);
			echo '<img src="' . $item->image->url . '">';
			echo 'id: ' . $item->id;
	}

	print("<br>");
}


$nextPageToken = $json->nextPageToken;

while ($nextPageToken != null) {
	$nextPageToken= nextResults($ch,$nextPageToken);
}

function googlePrintPersonen($object){
	// foreach ($object as $rijtitel => $rijwaarde) {
	// 	// print("rijtitel: " . $rijtitel . " rijwaarde: ");
	// 	// print_r($rijwaarde);
	// 	// print("<br><br><br>");
	// 	if($rijtitel == "items") {
	// 		$items = $rijwaarde;
	// 	}
	// }
	$items = $object->items;

	foreach ($items as $item) {
		print("<br>");
		if($item->displayName) {
			// print_r($item);
			echo '<img src="' . $item->image->url . '">';
			echo 'id: ' . $item->id;
		}
	print("<br>");
	}
}

function googlePrintPublicPosts($object) {
	foreach ($object as $rijtitel => $rijwaarde) {
	// print("rijtitel: " . $rijtitel . " rijwaarde: ");
	// // print_r($rijwaarde);
	// print("<br><br><br>");
		if($rijtitel == "items") {
			$items = $rijwaarde;
		}
	}

	// echo '<br><br>aantal items: ' . count($items) . '<br>';
	if (!empty($items)) {
		foreach ($items as $item) {
				print("<br><br>");
	// 	if($item->displayName) {
				// print_r($item);
				// echo '<br><br> test: ' . $item->title ."<br><br>";

				// if (strpos($item->title,'#webdoos') !== false) {
	  			// echo '<br><br>true<br>';
	  			// print_r($item);
	  			echo '<br>' . $item->published;
	  			echo ' Auteur: <a href="' . $item->actor->url . '">' . $item->actor->displayName;
	  			echo '<img src="' . $item->actor->image->url . '"></a>';
	  			echo 'Titel: <a href="' . $item->object->url . '">' . $item->title . '</a> content: ' . $item->object->content;
				// }
	// 			echo '<img src="' . $item->image->url . '">';
	 	}
	 } else {
	 	echo 'Er zijn geen posts gevonden.';
	 }
}
//
//https://www.googleapis.com/plus/v1/people?query=%27jan%20doms%27&key=AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug

// $posts_anja = "https://www.googleapis.com/plus/v1/people/113384192950187076820/activities/public?key=AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug";

// $activities_search = "https://www.googleapis.com/plus/v1/activities?query=%23webdoos&key=AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug";

// GET https://www.googleapis.com/plus/v1/activities?query=%23webdoos&key={YOUR_API_KEY}

	// $object = googleZoekPublicPosts($key,"%23webdoos");
	// googlePrintPublicPosts($object);
	// $object = googleZoekPersoon($key,"webdoos");
	// googlePrintPersonen($object);
	// $object = googleGetPublicPosts($key,"113384192950187076820");
	// googlePrintPublicPosts($object);




// 	print("<br>");
// }
function googleZoekPersoon($key,$zoekstring,$getAllPages='false',$nextPageToken=null) {
	$persoon_search = "https://www.googleapis.com/plus/v1/people?query=" . $zoekstring . "&key=" . $key;
	// $object = curl("GET",$persoon_search);
	$object = json_decode(file_get_contents($persoon_search));
	return $object;


	// if($getAllPages) {
	// 	while (!empty($items)) {
	// 	$nextPageToken= nextResults($ch,$nextPageToken);
	// }

		// 	function nextResults($ch,$token) {
		// 	curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/plus/v1/people?query=%27" . $zoekstring . "%27&key=AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug&pageToken=" . $token);
		// 	$json1 = json_decode(curl_exec($ch));

		// 	print("<br><br>");
		// 	// print_r($json1);

		// 	foreach ($json1 as $rijtitel => $rijwaarde) {
		// 		// print("rijtitel: " . $rijtitel . " rijwaarde: ");
		// 		// print_r($rijwaarde);
		// 		print("<br><br><br>");
		// 		if($rijtitel == "items") {
		// 			$items = $rijwaarde;
		// 		}
		// 	}
		// 	// print_r($items);
		// 	if (!empty($items)) {
		// 		foreach ($items as $item) {
		// 		print("<br>");
		// 			if($item->displayName) {
		// 					// print_r($item);
		// 					echo 'Image: <img src="' . $item->image->url . '">';
		// 					echo 'ID: ' . $item->id;
		// 			}
		// 			print("<br>");
		// 		}
		// 		// print("<br><br>gebruikte token:" . $token . "<br><br>");
		// 		// print("nextpagetoken:" . $json1->nextPageToken);
		// 		$nexttoken = $json1->nextPageToken;
		// 		// if ($token == $nexttoken) {
		// 		// 	return null;
		// 		// }
		// 		return $nexttoken;
		// 	} else {
		// 		return null;
		// 	}
			
		// }
	
}


// ***INSTAGRAM****
//code hieronder is om gebruiker te laten inloggen met z'n instagram account zodat z'n gegevens kunnen
// gefetched worden.

// if (isset($_GET['code']) && $_GET['code'] != '') { //Code opvangen na inloggen en tokenaanvragen en informatie in sessie-variable steken
// 	$urlAccesTokenEndpoint = 'https://api.instagram.com/oauth/access_token';

// 	$fields = array(
// 						'client_id' => $client_id,
// 						'client_secret' => $client_secret,
// 						'grant_type' => 'authorization_code',
// 						'redirect_uri' => $redirect_uri,
// 						'code' => $_GET['code']
// 				);

// 	print_r($fields);


// 	echo 'in IF en code is: ' . $_GET['code'];


// 	$oAuthToken = curl('POST',$urlAccesTokenEndpoint,$fields);
// 	$_SESSION['accesToken'] = $oAuthToken;
// 	print_r($oAuthToken);
// 	//stdClass Object ( [code] => 400 [error_type] => OAuthException [error_message] => Redirect URI doesn't match original redirect URI ) 

// 	if($oAuthToken->code == 400) {
// 		echo 'error: ' . $oAuthToken->error_message;
// 	}

// 	if(isset($oAuthToken->user->id)) {
// 		$_SESSION['userId'] = $oAuthToken->user->id;
// 		$_SESSION['username'] = $oAuthToken->user->username;
// 		$_SESSION['profilePicture'] = $oAuthToken->user->profile_picture;
// 		echo 'user id: ' . $_SESSION['userId'];
// 	}
// 	/*If your request for approval is denied by the user, then we will redirect the user to your redirect_uri with the following parameters:

//     error: access_denied

//     error_reason: user_denied

//     error_description: The user denied your request

//     http://your-redirect-uri?error=access_denied&error_reason=user_denied&error_description=The+user+denied+your+request

// It is your responsibility to fail gracefully in this situation and display a corresponding error message to your user

// Even though the access token does not specify an expiration time, 
// your app should handle the case that either the user revokes access, 
// or Instagram expires the token after some period of time. In this case, 
// your meta of your responses will contain an “error_type=OAuthAccessTokenError”.
//  In other words: do not assume your access_token is valid forever.

// */
// }
		if (isset($_GET['code']) && $_GET['code'] != '') { //Code opvangen na inloggen en tokenaanvragen en informatie in sessie-variable steken
			$urlAccesTokenEndpoint = 'https://api.instagram.com/oauth/access_token';

			$fields = array(
								'client_id' => $client_id,
								'client_secret' => $client_secret,
								'grant_type' => 'authorization_code',
								'redirect_uri' => $redirect_uri,
								'code' => $_GET['code']
						);

			print_r($fields);


			echo 'in IF en code is: ' . $_GET['code'];
			echo '<br><br>' . $urlAccesTokenEndpoint . '<br><br>';

			$oAuthToken = curl('POST',$urlAccesTokenEndpoint,$fields);
			$_SESSION['accesToken'] = $oAuthToken;
			print_r($oAuthToken);
			//stdClass Object ( [code] => 400 [error_type] => OAuthException [error_message] => Redirect URI doesn't match original redirect URI ) 

			if(isset($oAuthToken->code) && $oAuthToken->code == 400) {
				echo 'error: ' . $oAuthToken->error_message;
			}

			if(isset($oAuthToken->user->id)) {
				$_SESSION['userId'] = $oAuthToken->user->id;
				$_SESSION['username'] = $oAuthToken->user->username;
				$_SESSION['profilePicture'] = $oAuthToken->user->profile_picture;
				echo 'user id: ' . $_SESSION['userId'];
			}
			/*If your request for approval is denied by the user, then we will redirect the user to your redirect_uri with the following parameters:

		    error: access_denied

		    error_reason: user_denied

		    error_description: The user denied your request

		    http://your-redirect-uri?error=access_denied&error_reason=user_denied&error_description=The+user+denied+your+request

		It is your responsibility to fail gracefully in this situation and display a corresponding error message to your user

		Even though the access token does not specify an expiration time, 
		your app should handle the case that either the user revokes access, 
		or Instagram expires the token after some period of time. In this case, 
		your meta of your responses will contain an “error_type=OAuthAccessTokenError”.
		 In other words: do not assume your access_token is valid forever.

		*/
		}

		
function fetchInstagramUserGegevens() {
	global $client_id;
	global $redirect_uri;
	if (isset($_SESSION['accesToken']) && $_SESSION['accesToken']->access_token != '') {
		//hier main program
		// echo 'acces_token: ' . $_SESSION['accesToken']->access_token;

		$urlUserEndpoint = 'https://api.instagram.com/v1/users/' . $_SESSION['userId'] 
		. '/?access_token=' . $_SESSION['accesToken']->access_token;
		// $object = curl('GET',$urlUserEndpoint);
		// $oject = file_get_contents('http://www.google.be');
		// print($object);
		// echo "url: " . $urlUserEndpoint;
		$object = json_decode(file_get_contents($urlUserEndpoint));
		// print_r($object);

		// echo $object->data->username;
		// echo $object->data->bio;
		// echo $object->data->website;
		// echo $object->data->profile_picture;
		// echo $object->data->full_name;
		// echo $object->data->counts->media;
		// echo $object->data->counts->followed_by;
		// echo $object->data->counts->follows;
		// echo $object->data->id;


		$gegevens = array(
		'username' => $object->data->username,
		'bio' =>  $object->data->bio,
		'website' => $object->data->website,
		'profilePicture' => $object->data->profile_picture,
		'fullName' => $object->data->full_name,
		'media' =>  $object->data->counts->media,
		'followedBy' => $object->data->counts->followed_by,
		'follows' => $object->data->counts->follows,
		'id' => $object->data->id
		);

		return $gegevens;

	} else {
		echo '<a href="https://api.instagram.com/oauth/authorize/?client_id='
		. $client_id . '&redirect_uri=' . $redirect_uri . '&response_type=code">Log in</a>';
		return null;
	}

/*** Dit toevoegen op index.php ***/
		if (isset($_GET['code']) && $_GET['code'] != '') { //Code opvangen na inloggen en tokenaanvragen en informatie in sessie-variable steken
			$urlAccesTokenEndpoint = 'https://api.instagram.com/oauth/access_token';

			$fields = array(
								'client_id' => $client_id,
								'client_secret' => $client_secret,
								'grant_type' => 'authorization_code',
								'redirect_uri' => $redirect_uri,
								'code' => $_GET['code']
						);

			print_r($fields);


			echo 'in IF en code is: ' . $_GET['code'];


			$oAuthToken = curl('POST',$urlAccesTokenEndpoint,$fields);
			$_SESSION['accesToken'] = $oAuthToken;
			print_r($oAuthToken);
			//stdClass Object ( [code] => 400 [error_type] => OAuthException [error_message] => Redirect URI doesn't match original redirect URI ) 

			if($oAuthToken->code == 400) {
				echo 'error: ' . $oAuthToken->error_message;
			}

			if(isset($oAuthToken->user->id)) {
				$_SESSION['userId'] = $oAuthToken->user->id;
				$_SESSION['username'] = $oAuthToken->user->username;
				$_SESSION['profilePicture'] = $oAuthToken->user->profile_picture;
				echo 'user id: ' . $_SESSION['userId'];
			}
			/*If your request for approval is denied by the user, then we will redirect the user to your redirect_uri with the following parameters:

		    error: access_denied

		    error_reason: user_denied

		    error_description: The user denied your request

		    http://your-redirect-uri?error=access_denied&error_reason=user_denied&error_description=The+user+denied+your+request

		It is your responsibility to fail gracefully in this situation and display a corresponding error message to your user

		Even though the access token does not specify an expiration time, 
		your app should handle the case that either the user revokes access, 
		or Instagram expires the token after some period of time. In this case, 
		your meta of your responses will contain an “error_type=OAuthAccessTokenError”.
		 In other words: do not assume your access_token is valid forever.

		*/
		}


?>