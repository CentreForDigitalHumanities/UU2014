<?php
/**
 * Get Twitter User Timeline using Twitter's REST API
 * 
 * @package UU2014
 */

/**
 * Include class file TwitterAPIExchange.php
 * https://github.com/J7mbo/twitter-api-php
 *
 * ToDo: implement caching: https://github.com/mombrea/twitter-api-php-cached
 */
require_once('twitter-api-php/TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "1570191775-alRvnT9D0AtvOetDsGi1l2RCz2Hcy9a7x5VKWTO",
    'oauth_access_token_secret' => "wTTwU8XxEBvu7GRb0WZfT49vOaBEqjZJa0aRFmoJI3JLv",
    'consumer_key' => "dCAm2NrWFBwGW3Fb0ze9M7TX6",
    'consumer_secret' => "Knb2WxfR3VIh8gPxUYbj7sSMyMknGtL51ytIyuaj2FngSjBPEv"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
if (isset($_GET['user']))  {$user = $_GET['user'];}  else {$user  = "UniUtrecht";}
if (isset($_GET['count'])) {$count = $_GET['count'];} else {$count = 1;}
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if (array_key_exists('errors', $string)) {echo "<h3>Er is een fout opgetreden.</h3><p>Twitter geeft de volgende foutmelding:</p><p><em>".$string["errors"][0]["message"]."</em></p>";exit();}
echo "<pre>";
print_r($string);
echo "</pre>";
foreach($string as $items)
    {
        echo "<img src='" . $items['user']['profile_image_url'] . "' />";
        echo $items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br /><br />";
    }
?>