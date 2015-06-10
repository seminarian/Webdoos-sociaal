<?php
/*
 *
 *
    User Timeline: https://api.twitter.com/1.1/statuses/user_timeline.json
    All your tweets or the tweets of the user you specify.

    Mentions: https://api.twitter.com/1.1/statuses/mentions_timeline.json
    All the tweets in which another Twitter user mentions you.

    Home Timeline: https://api.twitter.com/1.1/statuses/home_timeline.json
    All the tweets from the people you follow

    Twitter Search: https://api.twitter.com/1.1/search/tweets.json
    A Twitter search with the query you specify.

 */

/*
 *
 Twitter accepts both the GET and POST methods, but generally asks for read only data (such as getting tweets) to be requested by the GET method and for writing data (such as sending a tweet) be done by the POST method.
There is one exception in that, if your request string is going to be very long, you might want to use POST even though you are requesting read only data. This is because the URL could end up being too long.

 *
 */



/** Set access tokens here - see: https://dev.twitter.com/apps/ **/

function getTweetsFromUser($user="MackDoms",$count = 200) {
    global $settings;

    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
//https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=iagdotme&count=50

    $requestMethod = "GET";
//    $getfield = "?screen_name=" . $user . "&count='" . $count . "'";
//$getfield = '?count=2&since_id=14927799';

    $twitter = new TwitterAPIExchange($settings);

    $string = json_decode($twitter/*->setGetfield($getfield)*/
        ->buildOauth($url, $requestMethod)
        ->performRequest(), $assoc = TRUE);
    return $string;
}

function getMentions() {
    global $settings;
    $url = "https://api.twitter.com/1.1/statuses/mentions_timeline.json";
    $requestMethod = "GET";
//    $getfield = "?screen_name=" . $user . "&count='" . $count . "'";

    $twitter = new TwitterAPIExchange($settings);
    $string = json_decode(
//        $twitter->setGetfield($getfield)
        $twitter->buildOauth($url, $requestMethod)
        ->performRequest(), $assoc = TRUE);
    return $string;
}
function renderTweets($tweets,$yeah='') {
    echo '<h2><img style="height:45px;" src="assets/icon_twitter.png">Webdoos on twitter:</h2>';
    // if (count($tweets) == 0) {
        // echo 'er zitten geen tweets in de db';
    // } else {

    
        echo '

        <table class="table table-striped">
        <thead>
            <tr></tr>
        </thead>
            <tbody>';
                    // print_r($eigenTweets);
                    foreach($tweets as $tweet) {
                        //Sat Jun 06 14:34:01 +0000 2015
                        echo '
                        <tr>
                            <td><img width="35px" src="assets/icon_twitter.png"></td>
                            <td>' . $tweet->name . ' Tweeted ' . $tweet->tweet . '</td>
                            <td>' . $tweet->date . '</td>
                        </tr>';
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

?>