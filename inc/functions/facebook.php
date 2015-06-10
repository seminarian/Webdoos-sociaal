<?php
define('FACEBOOK_SDK_V4_SRC_DIR', '../../facebook-php-sdk/src/Facebook/');
require __DIR__ . '/../../facebook-php-sdk/autoload.php';

require_once '../../facebook-php-sdk/autoload.php';
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
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
session_start();

$api_key = '482647121892909';
$api_secret = 'd230393d13ee6b78c35aa2f2c452e04f';
$secret = $api_secret;
$redirect_login_url = 'http://localhost/Webdoos-sociaal/inc/functions/facebook.php';
$logout_url = 'http://localhost/Webdoos-sociaal/inc/functions/facebook.php';


function logoutFacebook() {
    if(isset($_GET['action']) && $_GET['action'] === 'logout'){
        unset($_SESSION['fb_token']);
    }
}




FacebookSession::setDefaultApplication($api_key, $api_secret);
// init app with app id and secret


// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( $redirect_login_url );

// see if an existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
    // create new session from saved access_token
    $session = new FacebookSession( $_SESSION['fb_token'] );

    // validate the access_token to make sure it's still valid
    try {
        if ( !$session->validate() ) {
            $session = null;
        }
    } catch ( Exception $e ) {
        // catch any exceptions
        $session = null;
    }
}

if ( !isset( $session ) || $session === null ) {
    // no session exists

    try {
        $session = $helper->getSessionFromRedirect();
    } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
        // handle this better in production code
        print_r( $ex );
    } catch( Exception $ex ) {
        // When validation fails or other local issues
        // handle this better in production code
        print_r( $ex );
    }

}

// see if we have a session
if ( isset( $session ) && $session != null ) {

    // save the session
    $_SESSION['fb_token'] = $session->getToken();
    // create a session using saved token or the new one we generated at login
    $session = new FacebookSession( $session->getToken() );

    //GET USER PROFILE
    // try {
    //   $user_profile = (new FacebookRequest(
    //     $session, 'GET', '/me'
    //   ))->execute()->getGraphObject(GraphUser::className())->asArray();
    //   echo "Name: " . $user_profile["first_name"];
    //   echo '<br>';
    //   print_r($user_profile);
    // } catch(FacebookRequestException $e) {
    //   echo "Exception occured, code: " . $e->getCode();
    //   echo " with message: " . $e->getMessage();
    // }

    // //GET SEARCH
    //     try {
    //   $search = (new FacebookRequest(
    //     $session, 'GET', '/search?q=coffee&type=place&center=37.76,-122.427&distance=1000'
    //   ))->execute()->getGraphObject()->asArray();
    //   // $search = json_decode($search);
    //   print("search: ");
    //   print_r($search);

    // } catch(FacebookRequestException $e) {
    //   echo "Exception occured, code: " . $e->getCode();
    //   echo " with message: " . $e->getMessage();
    // }


    $access_token=$session->getToken();
    $ch = curl_init();
    $str = "&access_token=" . $access_token;
    curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v1.0/search?q=webdoos&type=page&center=37.76,-122.427&distance=1000".$str);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    // grab URL and pass it to the browser
    $json=json_decode(curl_exec($ch),true);
    print($json);

// type=post&q=%23the_hash_tag


    // ID get permissions
    // try {
    //   $permissions = (new FacebookRequest(
    //     $session, 'GET', '/me/permissions'
    //   ))->execute()->getGraphObject()->asArray();
    //   echo "ID: " . $user_profile['id'];
    //   echo '<br>';
    //   print_r($permissions);
    // } catch(FacebookRequestException $e) {
    //   echo "Exception occured, code: " . $e->getCode();
    //   echo " with message: " . $e->getMessage();
    // }


    //POST LINK ON FB dat gaat maar als je toestemming gekregen hebt van fb (na app review (7dagen))
    // try {
    // $response = (new FacebookRequest(
    //   $session, 'POST', '/me/feed', array(
    //     'link' => 'www.google.be',
    //     'message' => 'Php project posted Message'
    //   )
    // ))->execute()->getGraphObject();
    // echo "Posted with id: " . $response->getProperty('id');
    // echo '<br>';
    // print_r($response);
    // } catch(FacebookRequestException $e) {
    // echo "Exception occured, code: " . $e->getCode();
    // echo " with message: " . $e->getMessage();
    // }   


    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject()->asArray();

    // print profile data
    echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';

    // print logout url using session and redirect_uri (logout.php page should destroy the session)
    echo '<a href="facebook.php?action=logout">Logout</a>';
//    echo '<a href="' . $helper->getLogoutUrl( $session, $logout_url ) . '">Logout</a>';

} else {
    // show login url
    echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends', 'public_profile' ) ) . '">Login</a>';
//      echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends', 'public_profile' ) ) . '">Login</a>';
    
}
?>