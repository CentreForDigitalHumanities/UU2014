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


            $today = date('Ymd');
            $agenda_amount = get_field('uu_options_agenda_amount', 'option');
            $todaydate = date('Ymd');
            $todaytime = date('H:i');
            //add_filter( 'get_meta_sql', 'get_meta_sql_date' );
            $args = array(
              'post_type'   => 'post',
              'category_name' => 'agenda',
              'posts_per_page'  => $agenda_amount,
              'meta_key'    => 'uu_agenda_start_date',
              'orderby'             => 'meta_value',
              'order'               => 'ASC',
              'meta_query' => array(
                    'eventdate' => array(
                      'relation' => 'OR',
                      array(
                        'key' => 'uu_agenda_start_date',
                          'value' => $todaydate,
                          'compare' => '>=',  
                      ),
                      array(
                        'relation' => 'AND',
                        array(
                          'key' => 'uu_agenda_start_date',
                            'value' => $todaydate,
                            'compare' => '<',
                        ),
                        array(
                          'key' => 'uu_agenda_end_date',
                            'value' => $todaydate,
                            'compare' => '>=',
                        ),
                          
                      ),
                        
                    ),
                    'eventtime' => array(
                      'relation' => 'OR',
                      array(
                        'key' => 'uu_agenda_start_time',  
                        ),
                        array(
                        'key' => 'uu_agenda_start_time',
                        'value' => date('H:i'),
                        'compare' => 'NOT EXISTS',  
                        ),
                    ),
                ),
            );


            $agenda_query = new WP_Query( $args );

//query_posts('showposts=' . $amount . '&post_type=post&category_name=agenda,&meta_key=uu_agenda_start_date&meta_compare=>=&meta_value=' . $today . '&orderby=meta_value_num&order=ASC'); ?>

<ul class="agenda_widget">  
    <?php 
      if ( $agenda_query->have_posts() ) :
          while ($agenda_query->have_posts()) : $agenda_query->the_post(); ?>
          <li class="clearfix">
                    
              <?php  if( get_field('uu_agenda_start_date') ) {

                        $start_date_timestamp = strtotime(get_field('uu_agenda_start_date')); 
                        $end_date_timestamp = strtotime(get_field('uu_agenda_end_date'));
                        $startday = date_i18n('j', $start_date_timestamp);
                        $endday = date_i18n('j', $end_date_timestamp);
                        $startmonth = date_i18n('m', $start_date_timestamp);
                        $endmonth = date_i18n('m', $end_date_timestamp);
                        $startyear = date_i18n('Y', $start_date_timestamp);
                        $endyear = date_i18n('Y', $end_date_timestamp);
                        $sameday = false;
                        $samemonth = false;
                        $sameyear = false;
                        if ($startday == $endday) {$sameday=true;} 
                        if ($startmonth == $endmonth) {$samemonth=true;}
                        if ($startyear == $endyear) {$sameyear=true;}

      
      // $date_format = get_option('date_format'); 
      ?>
      <div class="widget-date">
        <span class="home-agenda-date-day"><?php echo date_i18n('j', $start_date_timestamp); ?></span>
        <span class="home-agenda-date-month"><?php echo date_i18n('M', $start_date_timestamp); ?></span>
      </div>
      <div class="agenda-widget-title">
             <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a>
      </div>    
                             
    </li>   

     <?php } ?>             
  <?php endwhile; endif; ?>
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