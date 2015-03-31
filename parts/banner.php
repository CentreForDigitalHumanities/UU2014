<?php if ( is_home() || is_front_page() ) :

	if (term_exists('slider', 'category') ) {
		get_template_part( 'parts/carousel', '' );
	}
	get_template_part( 'parts/widgetarea', 'home' );
 	
 	else : ?>
 		<div class="header-image">
			<?php uu2014_header_image(); ?>
    

    	  
    		<h1 class="entry-title page-title"><?php the_title(); ?></h1>       
		</div>       

<?php 
 	endif;	
?>