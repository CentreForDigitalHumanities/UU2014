<?php 

function uu_slider_shortcode($atts) {
	global $post;
	$content='';
    extract(shortcode_atts(array(
        "id" => ''
    ), $atts));
    $content .= '<div id="'.$id.'" class="carousel slide">';
    the_field('uu_content_slider', $post->ID);
     if( have_rows('uu_content_slider') ) {
     	while( have_rows('uu_content_slider') ): the_row();

				echo get_sub_field('slider_id');
				  if(get_sub_field('slider_id') == $id) {  
				    if( have_rows('slide') ):
				    	$content .= '<div class="carousel-inner" role="listbox">';
				    	while( have_rows('slide') ): the_row();
				    	$content .= uu_single_slide();
				    	endwhile;
				    	$content .= '</div>'; 
				    endif;

   
					}
	 endwhile;				
  }  
    $content .= '</div>';

    return $content;
    
}

add_shortcode("slider", "uu_slider_shortcode");


function uu_single_slide() {
	$titel = get_sub_field('slide_titel');
	$content = get_sub_field('slide_content');
	$image_id = get_sub_field('slide_afbeelding');
	$large = wp_get_attachment_image_src(get_sub_field('uu_people_image'), 'large');
	?>

<div class="item">
      <img class="img-responsive" src="<?php echo $medium[0]; ?>" alt="<?php echo get_the_title(get_field('uu_people_image')) ?>" />
      <div class="carousel-caption">
        	<h3><?php echo $titel; ?></h3>
        	<p><?php echo $content; ?></p>
      </div>
</div>

<?php 
}

?>
