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

if(function_exists('get_field') && get_field('uu_options_twitter_username', 'option')) {
  $username = get_field('uu_options_twitter_username', 'option');
}
if(function_exists('get_field') && get_field('uu_options_twitter_consumer_key', 'option')) {
  $comsumer_key = get_field('uu_options_twitter_consumer_key', 'option');
}
if(function_exists('get_field') && get_field('uu_options_twitter_consumer_secret', 'option')) {
  $comsumer_secret = get_field('uu_options_twitter_consumer_secret', 'option');
}
if(function_exists('get_field') && get_field('uu_options_twitter_access_token', 'option')) {
  $access_token = get_field('uu_options_twitter_access_token', 'option');
}
if(function_exists('get_field') && get_field('uu_options_twitter_access_token_secret', 'option')) {
  $access_token_secret = get_field('uu_options_twitter_access_token_secret', 'option');
}

if(!(isset($username)) || !(isset($comsumer_key)) || !(isset($comsumer_secret)) || !(isset($access_token)) || !(isset($access_token_secret)) ) { ?>
  <p>Twitter timeline kan niet geladen worden omdat er gegevens ontbreken. Vul de ontbrekende gegevens in bij Twitter timeline op de <a href="<?php echo get_option('siteurl');?>/wp-admin/admin.php?page=uu-site-options">UU Options pagina</a>.</p>

<?php } else {
  /** Set access tokens - https://dev.twitter.com/apps/ **/
  $settings = array(
      'oauth_access_token' => $access_token,
      'oauth_access_token_secret' => $access_token_secret,
      'consumer_key' => $comsumer_key,
      'consumer_secret' => $comsumer_secret
  );

  function UU_Twitter_API_request($settings, $amount, $username){

     /** Perform a GET request and echo the response **/
    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    $requestMethod = "GET";
  
    $getfield = "?screen_name=$username&count=$amount";

    $twitter = new TwitterAPIExchange($settings);
    
    $api_results = json_decode($twitter->setGetfield($getfield)
          ->buildOauth($url, $requestMethod)
          ->performRequest(),$assoc = TRUE);

    return $api_results;

  } // end function UU_Twitter_API_request()

  function JSON_cached_API_results( $settings, $amount, $username, $cache_file = NULL, $expires = NULL ) {
      global $request_type, $purge_cache, $limit_reached, $request_limit;

      if( !$cache_file ) $cache_file = dirname(__FILE__) . '/api-cache-' .$username. '.json';
      if( !$expires) $expires = time() - 1*60;
      // $request_limit = 10;

      // file_put_contents($cache_file, $json_results);

      if( !file_exists($cache_file) ) {
          fopen("$cache_file", "w");
      }

      // Check that the file is older than the expire time and that it's not empty
      // if ( filectime($cache_file) < $expires || file_get_contents($cache_file)  == '' || $purge_cache && intval($_SESSION['views']) <= $request_limit ) {
      if ( filectime($cache_file) < $expires || file_get_contents($cache_file)  == '' ) {

          // File is too old, refresh cache
          $api_results = UU_Twitter_API_request($settings, $amount, $username);
          $json_results = json_encode($api_results);
          
          // Remove cache file on error to avoid writing wrong xml
          if ( $api_results && $json_results ) {
              file_put_contents($cache_file, $json_results);
          } else {
              unlink($cache_file);
          }
      } else {
          // Check for the number of purge cache requests to avoid abuse
          // if( intval($_SESSION['views']) >= $request_limit ) 
          //     $limit_reached = " <span class='error'>Request limit reached ($request_limit). Please try purging the cache later.</span>";
          // Fetch cache
          $json_results = file_get_contents($cache_file);
          $request_type = 'JSON';
      }
      
      // return json_decode($json_results);
      $timeline = json_decode($json_results);

      foreach($timeline as $tweet) {
          echo '<div style="display:block;margin:1em 0;">';
          echo '<img src="' . $tweet->user->profile_image_url . '" />';
          echo '<span style="margin-left: 1em;"><small>' . $tweet->created_at . '</small></span>';
          echo '<p style="margin: 0.5em 0 0 0;">' . $tweet->text . '</p>';
          echo '<span style=""><small>Tweeted by: '. $tweet->user->name . '</small></span>';
          echo '</div>';
      }
  }

  // UU_Twitter_API_request($settings, $amount, $username);  
  JSON_cached_API_results($settings, $amount, $username);
}
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