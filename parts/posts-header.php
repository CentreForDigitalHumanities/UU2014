<header class="article-header">
<?php if(is_active_sidebar( 'banner-widget-area' )) {  ?>
	<div class="banner-widget-area">
				<?php dynamic_sidebar( 'banner-widget-area' ); ?>
			</div>	
<?php } ?>			
	<?php if ( is_home() || is_front_page() ) :

			if (term_exists('slider', 'category') ) :
				get_template_part( 'parts/carousel', '' );
			else : ?>
				<div class="header-image">        
	    			<img src="<?php header_image(); ?>" /> 
				</div>
	 		<?php 
	 		endif;
	 		
	 	else : ?>
	 		<div class="header-image">        
	    		<img src="<?php header_image(); ?>" alt="" /> 
	    		
			</div>       

	<?php 
	 	endif;	
	?>

</header>