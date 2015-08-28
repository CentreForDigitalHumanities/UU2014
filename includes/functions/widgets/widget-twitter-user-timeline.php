<?php
/**
 * Example Widget Class
 */
class uu_twitter_user_timeline_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function __construct() {
    parent::__construct(
      'uu_twitter_user_timeline_widget', // Base ID
      __('Latest tweets', 'uu2014'), // Name
      array( 'description' => __( 'display latest tweets', 'uu2014' ), ) // Args
    );
  }

 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) { 
        extract( $args );
        $title    = apply_filters('widget_title', $instance['title']);
        $amount   = $instance['amount'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
<?php 

// Widget html
ini_set('display_errors', 1);
require_once(SCAFFOLDING_INCLUDE_PATH.'twitter-api-php/TwitterAPIExchange.php');

/** Set cache file **/
$tweet_file = 'TweetCache.json';

/** Set cache time in minutes **/
$cache_time = 2;

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/

// if(function_exists('get_field') && get_field('uu_options_twitter_username', 'option')) {
//   $username = get_field('uu_options_twitter_username', 'option');
// }
// if(function_exists('get_field') && get_field('uu_options_twitter_consumer_key', 'option')) {
//   $comsumer_key = get_field('uu_options_twitter_consumer_key', 'option');
// }
// if(function_exists('get_field') && get_field('uu_options_twitter_consumer_secret', 'option')) {
//   $comsumer_secret = get_field('uu_options_twitter_consumer_secret', 'option');
// }
// if(function_exists('get_field') && get_field('uu_options_twitter_access_token', 'option')) {
//   $access_token = get_field('uu_options_twitter_access_token', 'option');
// }
// if(function_exists('get_field') && get_field('uu_options_twitter_access_token_secret', 'option')) {
//   $access_token_secret = get_field('uu_options_twitter_access_token_secret', 'option');
// }



// if(!(isset($username)) || !(isset($comsumer_key)) || !(isset($comsumer_secret)) || !(isset($access_token)) || !(isset($access_token_secret)) ) { ?>
  <p>Twitter timeline kan niet geladen worden omdat er gegevens ontbreken. Vul de ontbrekende gegevens in bij Twitter timeline op de <a href="<?php echo get_option('siteurl');?>/wp-admin/admin.php?page=uu-site-options">UU Options pagina</a>.</p>

<?php // } else {
  //global $username, $consumer_key, $consumer_secret, $access_token, $access_token_secret;
  // $settings = array(
  //     'oauth_access_token' => $access_token,
  //     'oauth_access_token_secret' => $access_token_secret,
  //     'consumer_key' => $comsumer_key,
  //     'consumer_secret' => $comsumer_secret
  // );
  $username = 'jahooris';
  $access_token = '1570191775-alRvnT9D0AtvOetDsGi1l2RCz2Hcy9a7x5VKWTO';
  $access_token_secret = 'wTTwU8XxEBvu7GRb0WZfT49vOaBEqjZJa0aRFmoJI3JLv';
  $consumer_key = 'dCAm2NrWFBwGW3Fb0ze9M7TX6';
  $consumer_secret = 'Knb2WxfR3VIh8gPxUYbj7sSMyMknGtL51ytIyuaj2FngSjBPEv';
  $settings = array(
      'oauth_access_token' => '1570191775-alRvnT9D0AtvOetDsGi1l2RCz2Hcy9a7x5VKWTO',
      'oauth_access_token_secret' => 'wTTwU8XxEBvu7GRb0WZfT49vOaBEqjZJa0aRFmoJI3JLv',
      'consumer_key' => 'dCAm2NrWFBwGW3Fb0ze9M7TX6',
      'consumer_secret' => 'Knb2WxfR3VIh8gPxUYbj7sSMyMknGtL51ytIyuaj2FngSjBPEv'
  );
         
 function ReadLatestUpdate(){
    global $tweet_file;
    global $cache_time;
    
    if(!file_exists($tweet_file)){
      UpdateTimeline();
      return;
    }
    $handle = fopen($tweet_file,'r');
    $strUpdateDate = fgets($handle);
    fclose($handle);
    if(empty($strUpdateDate)){
      //file is empty
      UpdateTimeline();
    }
    else{
      $updateDate = new DateTime($strUpdateDate);
      $now = new DateTime("now");
      $since = $updateDate->diff($now);
      
      $minutes = $since->i;
      
      if($minutes > $cache_time){
        //reload feed
        UpdateTimeline();
      }
      else{
        //read cache
        ReadFromCache();
      }
      
    }
   }
   
   function ReadFromCache(){
    global $tweet_file;
    $handle = fopen($tweet_file,'r');
    $data = fgets($handle); //skip first line
    $data = '';
    while(!feof($handle)){
      $data.= fgets($handle);
    }
    fclose($handle);
    echo $data;
   }
   
   function UpdateCache($timeline){
    $tweet_file = 'TweetCache.json';
    $handle = fopen($tweet_file,'w') or die ('Cannot open cache file');
    $data = date('m/d/Y h:i:s a', time())."\r\n".$timeline;
    fwrite($handle,$data);
    fclose($handle);
   }

  
  function UpdateTimeline(){
    global $settings, $amount, $username, $user;
    $username = 'jahooris';
    $access_token = '1570191775-alRvnT9D0AtvOetDsGi1l2RCz2Hcy9a7x5VKWTO';
    $access_token_secret = 'wTTwU8XxEBvu7GRb0WZfT49vOaBEqjZJa0aRFmoJI3JLv';
    $consumer_key = 'dCAm2NrWFBwGW3Fb0ze9M7TX6';
    $consumer_secret = 'Knb2WxfR3VIh8gPxUYbj7sSMyMknGtL51ytIyuaj2FngSjBPEv';
    $settings = array(
        'oauth_access_token' => '1570191775-alRvnT9D0AtvOetDsGi1l2RCz2Hcy9a7x5VKWTO',
        'oauth_access_token_secret' => 'wTTwU8XxEBvu7GRb0WZfT49vOaBEqjZJa0aRFmoJI3JLv',
        'consumer_key' => 'dCAm2NrWFBwGW3Fb0ze9M7TX6',
        'consumer_secret' => 'Knb2WxfR3VIh8gPxUYbj7sSMyMknGtL51ytIyuaj2FngSjBPEv'
    );
     /** Perform a GET request and echo the response **/
    $url = "https://api.twitter.com/1.1/statuses/home_timeline.json";
    $requestMethod = "GET";
    if (isset($_GET['user'])) {
        $user = $_GET['user'];
    }  elseif (isset($username)) {
        $user  = $username;
    }
    if (isset($_GET['count'])) {
        $count = $_GET['count'];
    } else {
        $count = $amount;
    }
    $user = 'jahooris';
    $getfield = "?screen_name=jahooris&count=$count";
    //print_r($settings);
    // echo $username;

    $twitter = new TwitterAPIExchange($settings);
    
    $timeline = json_decode($twitter->setGetfield($getfield)
          ->buildOauth($url, $requestMethod)
          ->performRequest(),$assoc = TRUE);
           
           //save to cache
           UpdateCache($timeline);
           
           //echo results;
           // print_r($timeline);
     }
  
  ReadLatestUpdate();

  // echo "<pre>";
  // print_r($string);
  // echo "</pre>";
  foreach($timeline as $items)
      {
          echo "<img src='" . $items['user']['profile_image_url'] . "' />";
          echo $items['created_at']."<br />";
          echo "Tweet: ". $items['text']."<br />";
          echo "Tweeted by: ". $items['user']['name']."<br /><br />";
      }
// }
?>
<?php echo $after_widget; ?>
<?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['amount'] = strip_tags($new_instance['amount']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {  
 
        if(isset($instance['title'])) {
           $title = esc_attr($instance['title']);
        } else {
          $title = __( 'Latest tweets', 'uu2014' );
        }
        if(isset($instance['amount'])) {
           $amount = esc_attr($instance['amount']);
        } else {
          $amount = 3;
        }
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Amount of tweets to show'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" type="text" value="<?php echo $amount; ?>" />
        </p>
      
        <?php 
    }
 
 
} // end class uu_twitter_user_timeline_widget
add_action('widgets_init', create_function('', 'return register_widget("uu_twitter_user_timeline_widget");'));
?>