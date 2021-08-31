<header class="article-header article-header-main">

	<div class="header-image hidden-print">
		
    <?php if(function_exists('bcn_display')) { ?>
       <div class="breadcrumbs" xmlns:v="https://rdf.data-vocabulary.org/#">
       	  <div class="container">	 
          	<?php bcn_display(); ?>
          </div>	
   		</div>  
   <?php  } ?>
		 
		<?php if ( is_home() && term_exists('slider', 'category') || is_front_page() && term_exists('slider', 'category')) { 
				get_template_part( 'parts/carousel', '' ); ?>

		<?php	} else { 
				
					uu2014_header_image(); 
			
					if( function_exists('get_field') && get_field('uu_options_banner_widget_on_all_pages', 'options') || is_front_page() )	{ 
						?>

							
			    				<?php get_template_part( 'parts/widgetarea', 'banner' ); ?>
			    		

			<?php 
						} 
					} ?>

			
		
    	<div class="page-header-placeholder"></div>	

	</div>

	<?php  if (is_home() || is_front_page() ) {
	 		get_template_part( 'parts/widgetarea', 'home' );
	 	}
	?>

</header>