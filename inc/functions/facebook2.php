<?php

// include required files form Facebook SDK
require_once( 'Facebook/autoload.php' );
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;

// start session
session_start();
$api_key = '482647121892909';
$api_secret = 'd230393d13ee6b78c35aa2f2c452e04f';
$secret = $api_secret;
$redirect_login_url = 'http://localhost/Webdoos-sociaal/inc/functions/facebook2.php';
$logout_url = 'http://localhost/Webdoos-sociaal/inc/functions/facebook2.php';

FacebookSession::setDefaultApplication($api_key, $api_secret);
// init app with app id and secret

// $user_profile = (new FacebookRequest(
//         $session, 'GET', '/oauth/access_token', array('client_id' => $api_key,'client_secret' => $api_secret, 'grant_type' => 'client_credentials')
//       ))->execute();

// print_r($user_profile);
// GET /oauth/access_token?
//      client_id={app-id}
//     &client_secret={app-secret}
//     &grant_type=client_credential


$ch = curl_init();

// set URL and other appropriate options


// $str= "?client_id=".$api_key."&client_secret=".$api_secret."&grant_type=client_credential";
$str = "?access_token=" . $api_key . "|" . $api_secret;
curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me".$str);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
// grab URL and pass it to the browser
$json=json_decode(curl_exec($ch));
var_dump($json);





// $appToken = $api_key . "|" . $api_secret;
// print("apptoken: " . $appToken . "<br>");
// print("referentie: access_token=482647121892909|Bjh3idJi9CjrwiWz-8QJZTGRpXo <br>");

// $session = new FacebookSession($appToken);
// print_r($session);

//     //GET USER PROFILE
//     try {
//       $user_profile = (new FacebookRequest(
//         $session, 'GET', '/me'
//       ))->execute()->getGraphObject(GraphUser::className())->asArray();
//       echo "Name: " . $user_profile["first_name"];
//       echo '<br>';
//       print_r($user_profile);
//     } catch(FacebookRequestException $e) {
//       echo "Exception occured, code: " . $e->getCode();
//       echo " with message: " . $e->getMessage();
//     }


/*
?client_id={app-id}
    &client_secret={app-secret}
    &grant_type=client_credentials
*/
// login helper with redirect_uri
// $helper = new FacebookRedirectLoginHelper( $redirect_login_url );

// // see if an existing session exists
// if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
//     // create new session from saved access_token
//     $session = new FacebookSession( $_SESSION['fb_token'] );

//     // validate the access_token to make sure it's still valid
//     try {
//         if ( !$session->validate() ) {
//             $session = null;
//         }
//     } catch ( Exception $e ) {
//         // catch any exceptions
//         $session = null;
//     }
// }

// if ( !isset( $session ) || $session === null ) {
//     // no session exists

//     try {
//         $session = $helper->getSessionFromRedirect();
//     } catch( FacebookRequestException $ex ) {
//         // When Facebook returns an error
//         // handle this better in production code
//         print_r( $ex );
//     } catch( Exception $ex ) {
//         // When validation fails or other local issues
//         // handle this better in production code
//         print_r( $ex );
//     }

// }

// // see if we have a session
// if ( isset( $session ) ) {

//     // save the session
//     $_SESSION['fb_token'] = $session->getToken();
//     // create a session using saved token or the new one we generated at login
//     $session = new FacebookSession( $session->getToken() );

//     // graph api request for user data
//     $request = new FacebookRequest( $session, 'GET', '/me' );
//     $response = $request->execute();
//     // get response
//     $graphObject = $response->getGraphObject()->asArray();

//     // print profile data
//     echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';

//     // print logout url using session and redirect_uri (logout.php page should destroy the session)
//     echo '<a href="' . $helper->getLogoutUrl( $session, $logout_url ) . '">Logout</a>';

// } else {
//     // show login url
//     echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends' ) ) . '">Login</a>';
// }

?>