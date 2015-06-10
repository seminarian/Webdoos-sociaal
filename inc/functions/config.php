<?php
/**
 *
 *
 * add in php.ini: curl.cainfo = "[pathtothisfile]\cacert.pem"
 * bij SSL error, bestand downloaden, niet editten in windows notepad.. maakt het kapot
 */
/****** Database ******/
class DBconfig {
	public static $DB_CONNSTRING = "mysql:host=localhost;dbname=webdoos-sociaal";
	public static $DB_USERNAME = "root";
	public static $DB_PASSWORD = "";
}


/****** FACEBOOK API credentials ********/
$api_key = '482647121892909';
$api_secret = 'd230393d13ee6b78c35aa2f2c452e04f';
$secret = $api_secret;
$redirect_login_url = 'http://localhost/Webdoos-sociaal/inc/functions/facebook.php';
$logout_url = 'http://localhost/Webdoos-sociaal/inc/functions/facebook.php';



// ****** FOURSQUARE Api credentials *******
/*
Owner
Pieter Doms
Client id
5U3GZM2KEFWZVUE1XPTR0Z1ION0I0SLLPU5VD405BA2KUHAF
Client secret
1FKF2E32CCI1IX0CKDDJSJYUGECACVDIPKCRQC5RHUTHBXRV
Push secret
1TP3VADTQJIE3GDZT5G4M33FLFOFJEMFCEO3VL5A2UKAOKGL
*/
$fsClientId = '5U3GZM2KEFWZVUE1XPTR0Z1ION0I0SLLPU5VD405BA2KUHAF';
$fsClientSecret = '1FKF2E32CCI1IX0CKDDJSJYUGECACVDIPKCRQC5RHUTHBXRV';
$fsPushSecret = '1TP3VADTQJIE3GDZT5G4M33FLFOFJEMFCEO3VL5A2UKAOKGL';
$fsRedirectUrl = 'http://localhost/Webdoos-sociaal/index.php';




// ******* Twitter Api credentials *******
    $settings = array(
    'oauth_access_token' => "1151358900-PGT9R1M8NZAmzRBapSsE37DglqETlGsineIMkm7", //vind je op https://apps.twitter.com/app/8401371/keys
    'oauth_access_token_secret' => "ezNwOazPbd9kJjSdprVo8BQE9zl5Qs5PN4507luXoIokC", //idem
    'consumer_key' => "oDiMUeehGla3P92wDqEKycPOq", //idem
    'consumer_secret' => "zgEe7vT1dROavVg9zmYMwIrKWT20yO1Ir3untn2t4WmQRiM6gC" //idem
);

// *******GOOGLE PLUS API credentials ***********
// API key 
$key = 'AIzaSyCC5C4rX8SxKYCuEZtGPnXRRdLkkSrDgug'; //deze vind je op https://console.developers.google.com/project/webdoos-project/apiui/credential#
// echo 'config geladen';

//********Instagram API credentials *********
$client_id = '3d1a38ab4c89442e9356ddf82d7eb94c'; //Enkel deze is nodig voor InstagramGetPhotosByTag()
// vind je op https://instagram.com/developer/clients/manage/?edited=Webdoos%20sociaal
$client_secret = '05736c642d9e4516b1adb6cf3f576d7e'; //nodig als je gebruiker wilt laten inloggen via instagram
$redirect_uri = 'http://localhost/Webdoos-sociaal/index.php';//idem
$locationId = '11487578';
$location2Id = '33247485';
$instagramTag = "webdoos";
/*
Op instagram config page:

Client Info
Client ID 	3d1a38ab4c89442e9356ddf82d7eb94c
Client Secret 	05736c642d9e4516b1adb6cf3f576d7e
Website URL 	http://localhost/Webdoos-sociaal/
Redirect URI 	http://localhost/Webdoos-sociaal/inc/functions/instagram.php
Support Email 	d0ms_007@hotmail.com

*/

/*
foursquare: welkom + geburikersnaam (30sec)
instagram: 30 seconden -> nieuwe foto in beeld.
location: webdoos.
facebook: eigen posts.
https://api.instagram.com/v1/locations/search?lat=48.858844&lng=2.294351
https://api.instagram.com/v1/locations/11487578/media/recent?access_token=3d1a38ab4c89442e9356ddf82d7eb94c

//If you have lat and lng you can search for locations by geographic coordinate using this endpoint. 
https://api.instagram.com/v1/locations/search?lat=1&lng=2&access_token=3d1a38ab4c89442e9356ddf82d7eb94c 
You'll get list of places inside the geo cordinate. 
Also you can search place by facebook place id and foursquare id.

https://api.instagram.com/v1/locations/search?lat=51.2363277&lng=3.2148676&access_token=3d1a38ab4c89442e9356ddf82d7eb94c

51.2363277,3.2148676

51° 14' 11.07'' N,3° 12' 53.79'' E

https://api.instagram.com/v1/locations/search?lat=59.9129486&lng=30.2961197&distance=100

https://api.instagram.com/v1/locations/search?lat=51.2361867&lng=3.2143956&distance=100&count=10000&access_token=1943750130.3d1a38a.c5dc674568b44e44a5f644c0a6fe6708

51.2361867,3.2143956
*/
?>