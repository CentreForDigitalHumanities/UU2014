<?php
/**
 * Example Widget Class
 */
class uu_upcoming_agenda_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function __construct() {
    parent::__construct(
      'uu_agenda_widget', // Base ID
      __('Upcoming Agenda items', 'uu2014'), // Name
      array( 'description' => __( 'display a list of upcoming items', 'uu2014' ), ) // Args
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

global $post;

$todaysDate = strtotime('now');

query_posts('showposts=' . $amount . '&post_type=agenda&meta_key=uu2014_agenda_startdate&meta_compare=>=&meta_value=' . $todaysDate . '&orderby=meta_value&order=ASC'); ?>

<ul class="agenda_widget">  
    <?php while (have_posts()) : the_post(); 
                    $dateformat = get_option('date_format');
                    $str = get_post_meta($post->ID, 'uu2014_agenda_startdate', true); 
                    $str2 = get_post_meta($post->ID, 'uu2014_agenda_enddate', true); 
                    $startdate = date( $dateformat , $str );
                    $enddate = date( $dateformat , $str2 );

    ?>
  <li>
    <div class="agenda-widget-date">
      
      <?php 

      // if( ! empty( $str2 ) ) : 
      //           echo $startdate . ' - ' . $enddate;  
      // else : 
      //           echo $startdate; 
      // endif; 

      echo $startdate;

      ?>


             
      </div>
      <div class="agenda-widget-title">
             <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a>
      </div>    
               
                    
               
    </li>                
  <?php endwhile; ?>
</ul>
<?php wp_reset_query(); ?>
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
          $title = __( 'Upcoming events', 'uu2014' );
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
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Amount of items to show'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" type="text" value="<?php echo $amount; ?>" />
        </p>
      
        <?php 
    }
 
 
} // end class uu_upcoming_agenda_widget
add_action('widgets_init', create_function('', 'return register_widget("uu_upcoming_agenda_widget");'));
?>