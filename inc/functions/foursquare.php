<?php

//A comma-separated list of venue ids to retrieve series data for. 
//The current user must be the manager of all venues specified.

// https://api.foursquare.com/v2/venues/search
//   ?client_id=CLIENT_ID
//   &client_secret=CLIENT_SECRET
//   &v=20130815
//   &ll=40.7,-74
//   &query=sushi
/*

See what venues you are manager off: 
https://api.foursquare.com/v2/venues/managed?client_id=5U3GZM2KEFWZVUE1XPTR0Z1ION0I0SLLPU5VD405BA2KUHAF&oauth_token=53HJTMQJV141PMS2GDLZDTKR0LNU24JSBUIXATKDTPODKZMN&v=20130815

*/
  function searchVenue($query) { // hier kan je totalvisits uit halen + here now
  	global $fsClientSecret;
  	global $fsClientId;
  	$url = 'https://api.foursquare.com/v2/venues/search?client_id=' . $fsClientId 
  	. '&client_secret=' . $fsClientSecret . '&v=20130815&intent=global&query=' . $query;
  	// print($url);
  	$object = json_decode(file_get_contents($url));
  	return $object;
  }

//doornhoek = 55788ab4498e1dcc6314a46b
//webdoos = 5576e64f498e907e749435d4

  function hereNow() { // Hier enkel here now (omwille van niet geauthenticeerd)
  	global $fsClientSecret;
  	global $fsClientId;
    global $fsAccessToken;
  	$url = 'https://api.foursquare.com/v2/venues/5576e64f498e907e749435d4/herenow?client_id=' . $fsClientId 
  	. '&oauth_token=' . $_SESSION['foursquareToken']->access_token . '&v=20130815';
  	// print($url);
  	$object = json_decode(file_get_contents($url));
  	return $object;
  }

  function venueStats() { // Hier enkel here now (omwille van niet geauthenticeerd)
    global $fsClientSecret;
    global $fsClientId;
    $url = 'https://api.foursquare.com/v2/venues/5576e64f498e907e749435d4/stats?client_id=' . $fsClientId 
    . '&oauth_token=' . $_SESSION['foursquareToken']->access_token . '&v=20130815';
    // print($url);
    $object = json_decode(file_get_contents($url));
    return $object;
  }

  function checkLoggedInFoursquare() {
  	if (!(isset($_SESSION['foursquareToken']) && $_SESSION['foursquareToken']!='')) {
  		global $fsClientId;
	  	global $fsRedirectUrl;
	  	$url = 'https://foursquare.com/oauth2/authenticate?client_id=' . $fsClientId 
	  	. '&response_type=code&redirect_uri=' . $fsRedirectUrl;
	    echo '<a href="' . $url . '">Log in via foursquare</a>';
		// https://foursquare.com/oauth2/authenticate?
		// client_id=5U3GZM2KEFWZVUE1XPTR0Z1ION0I0SLLPU5VD405BA2KUHAF&
		// response_type=code%20%20&redirect_uri=http://localhost/Webdoos-sociaal/index.php
  	} else {
  		// echo 'Main program';
  		// print($_SESSION['foursquareToken']->access_token);
  	}
  	
   }

   function handleFoursquareCode() {
   		
   		if (isset($_GET['code']) && $_GET['code'] != '') { //FOURSQUARE Code opvangen na inloggen en tokenaanvragen en informatie in sessie-variable steken
			$code = $_GET['code'];
			global $fsClientId;
  			global $fsRedirectUrl;
  			global $fsClientSecret;
			$url = 'https://foursquare.com/oauth2/access_token?client_id=' . $fsClientId . '&client_secret=' . $fsClientSecret 
			. '&grant_type=authorization_code&redirect_uri=' . $fsRedirectUrl . '&code=' . $code;
			// echo '<br><br> URL: ' . $url . '<br>';
			$oAuthToken = json_decode(file_get_contents($url));

			$_SESSION['foursquareToken'] = $oAuthToken;

			// echo '<br><br>token:';
			// print_r ($oAuthToken);
			// echo '<br><br>';
		}
   }

  function renderCheckins($checkins,$yeah='') {
    echo '<h2><img width="40px" src="assets/icon_foursquare.png">Mensen ingecheckt op Webdoos via Foursquare:</h2>
    <table class="table table-striped">
      <thead>
        <tr></tr>
      </thead>
      <tbody>';
          if (!empty($checkins)) {
            foreach($checkins as $item) {
              // $dt = DateTime::createFromFormat('Y M j H:i:s', $item->published);
              //2015-06-06T22:16:50.152Z
              // echo $item->published;
              // print ($dt);
              echo '
              <tr>
                <td>Naam:' . $item->name . '</td>
              </tr>';
            }
          }
        echo '
        </tr>
      </tbody>
    </table>';
        if ($yeah != '') {
            echo $yeah;
        }
    // }
}


 //   if (isset($_GET['CODE']) && $_GET['CODE'] != '') { //FOURSQUARE Code opvangen na inloggen en tokenaanvragen en informatie in sessie-variable steken
	// $urlAccesTokenEndpoint = 'https://api.instagram.com/oauth/access_token';

	// $fields = array(
	// 					'client_id' => $client_id,
	// 					'client_secret' => $client_secret,
	// 					'grant_type' => 'authorization_code',
	// 					'redirect_uri' => $redirect_uri,
	// 					'code' => $_GET['code']
	// 			);

	// print_r($fields);


	// echo 'in IF en code is: ' . $_GET['code'];


	// $oAuthToken = curl('POST',$urlAccesTokenEndpoint,$fields);
	// $_SESSION['accesToken'] = $oAuthToken;
	// print_r($oAuthToken);
	// //stdClass Object ( [code] => 400 [error_type] => OAuthException [error_message] => Redirect URI doesn't match original redirect URI ) 

	// if($oAuthToken->code == 400) {
	// 	echo 'error: ' . $oAuthToken->error_message;
	// }

	// if(isset($oAuthToken->user->id)) {
	// 	$_SESSION['userId'] = $oAuthToken->user->id;
	// 	$_SESSION['username'] = $oAuthToken->user->username;
	// 	$_SESSION['profilePicture'] = $oAuthToken->user->profile_picture;
	// 	echo 'user id: ' . $_SESSION['userId'];
	// }
/*
https://api.foursquare.com/v2/venues/4cd2ab1083e0721e893e5897/listed?client_id=5U3GZM2KEFWZVUE1XPTR0Z1ION0I0SLLPU5VD405BA2KUHAF&client_secret=1FKF2E32CCI1IX0CKDDJSJYUGECACVDIPKCRQC5RHUTHBXRV&v=20130815
=> The lists that this venue appears on
 /herenow => {"meta":{"code":200},"response":{"hereNow":{"count":1,"items":[]}}}
/photos
/*
Direct users to
https://foursquare.com/oauth2/authenticate
    ?client_id=YOUR_CLIENT_ID
    &response_type=code
    &redirect_uri=YOUR_REGISTERED_REDIRECT_URI
                  
(generally done through a link or button)
If the user accepts, they will be redirected back to
    https://YOUR_REGISTERED_REDIRECT_URI/?code=CODE
                  
Your server should exchange the code it got in step 2 for an access token. Make a request for
https://foursquare.com/oauth2/access_token
    ?client_id=YOUR_CLIENT_ID
    &client_secret=YOUR_CLIENT_SECRET
    &grant_type=authorization_code
    &redirect_uri=YOUR_REGISTERED_REDIRECT_URI
    &code=CODE
                  
The response will be JSON
{ access_token: ACCESS_TOKEN }
                  
Save this access token for this user in your database.
*/

/*


{
  "meta":  {
    "code": 200
  },
  "notifications":  [
     {
      "type": "notificationTray",
      "item":  {
        "unreadCount": 0
      }
    }
  ],
  "response":  {
    "hereNow":  {
      "count": 1,
      "items":  [
         {
          "id": "55788ba1498e4655f1c3d00b",
          "createdAt": 1433963425,
          "type": "checkin",
          "timeZoneOffset": 120,
          "user":  {
            "id": "130975329",
            "firstName": "Pieter",
            "lastName": "Doms",
            "gender": "male",
            "relationship": "self",
            "photo":  {
              "prefix": "https://irs0.4sqi.net/img/user/",
              "suffix": "/blank_boy.png",
              "default": true
            }
          },
          "likes":  {
            "count": 0,
            "groups":  []
          },
          "like": false
        }
      ]
    }
  }
}

*/

?>