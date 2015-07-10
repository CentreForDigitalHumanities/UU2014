<?php
/**
 * Example Widget Class
 */
class uu_social_media_buttons_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function __construct() {
    parent::__construct(
      'uu_social_media_buttons_widget', // Base ID
      __('Social media follow buttons', 'uu2014'), // Name
      array( 'description' => __( 'Display the social media follow buttons as setup in UU Options', 'uu2014' ), ) // Args
    );
  }

 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) { 
        extract( $args );
          $title ='';
          $title = apply_filters('widget_title', $instance['title']);
        // $amount   = $instance['amount'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
<?php 

// Widget html


?>

<ul class="uu_socialmedia_widget">  

 
      <?php 
       if(function_exists('get_field') && get_field('uu_options_facebook_url', 'option')) { ?>
        <li><a alt="Facebook" href="<?php echo get_field('uu_options_facebook_url', 'option'); ?>" class="button icononly facebook"></a></li>       
      <?php }

        if(function_exists('get_field') && get_field('uu_options_twitter_url', 'option')) { ?>
        <li><a alt="Twitter" href="<?php echo get_field('uu_options_twitter_url', 'option'); ?>" class="button icononly twitter"></a></li>       
      <?php }

      if(function_exists('get_field') && get_field('uu_options_youtube_url', 'option')) { ?>
        <li><a alt="Youtube" href="<?php echo get_field('uu_options_youtube_url', 'option'); ?>" class="button icononly youtube"></a></li>       
      <?php }

      if(function_exists('get_field') && get_field('uu_options_linkedin_url', 'option')) { ?>
        <li><a alt="LinkedIn" href="<?php echo get_field('uu_options_linkedin_url', 'option'); ?>" class="button icononly linkedin"></a></li>       
      <?php }

      if(function_exists('get_field') && get_field('uu_options_pinterest_url', 'option')) { ?>
        <li><a alt="Pinterest" href="<?php echo get_field('uu_options_pinterest_url', 'option'); ?>" class="button icononly pinterest"></a></li>       
      <?php }

      if(function_exists('get_field') && get_field('uu_options_instagram_url', 'option')) { ?>
        <li><a alt="Instagram" href="<?php echo get_field('uu_options_instagram_url', 'option'); ?>" class="button icononly instagram"></a></li>       
      <?php }

      ?>
               
 
</ul>

<?php echo $after_widget; ?>
<?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    // $instance['amount'] = strip_tags($new_instance['amount']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {  
        $title = '';
        if(isset($instance['title'])) {
           $title = esc_attr($instance['title']);
        }
        // $amount  = esc_attr($instance['amount']);
        ?>
      
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
  
      
        <?php 
    }
 
 
} // end class uu_social_media_buttons_widget
add_action('widgets_init', create_function('', 'return register_widget("uu_social_media_buttons_widget");'));
?>