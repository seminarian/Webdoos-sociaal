<?php
/**
 * Created by PhpStorm.
 * User: Pieter
 * Date: 5/06/2015
 * Time: 15:03
 */

/*//
// A very simple PHP example that sends a HTTP POST to a remote site
//

The current preferred structure for passing data from API -> client is JSON. PHP makes it trivial to work with JSON.
Within your API use json_encode to convert a PHP variable into it's JSON equivalent string. Inside your client, convert the JSON response from your API into a PHP object using the inverse function: json_decode

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.mysite.com/tester.phtml");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    "postvar1=value1&postvar2=value2&postvar3=value3");

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1'))); // YES IMPORTANT =) VAN array

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
if ($server_output == "OK") { ... } else { ... }

*/


//<?php
//  $ch = curl_init();
//  $skipper = "luxury assault recreational vehicle";
//  $fields = array( 'penguins'=>$skipper, 'bestpony'=>'rainbowdash');
//  $postvars = '';
//  foreach($fields as $key=>$value) {
//      $postvars .= $key . "=" . $value . "&";
//  }
//  $url = "http://www.google.com";
//  curl_setopt($ch,CURLOPT_URL,$url);
//  curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
//  curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
//  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
//  curl_setopt($ch,CURLOPT_TIMEOUT, 20);
//  $response = curl_exec($ch);
//  print "curl response is:" . $response;
//  curl_close ($ch);
//

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.google.be/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$result=curl_exec ($ch);
curl_close ($ch);

print_r($result);

if ($result == "OK") {
    echo 'ok';
} else {
    echo 'not OK';
}



?>