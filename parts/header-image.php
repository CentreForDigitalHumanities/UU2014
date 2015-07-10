<header class="article-header hidden-print">

	<div class="header-image">
		
    <?php if(function_exists('bcn_display')) { ?>
       <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
       	  <div class="container">	 
          	<?php bcn_display(); ?>
          </div>	
   		</div>  
   <?php  } ?>
		 
		<?php if ( is_home() && term_exists('slider', 'category') || is_front_page() && term_exists('slider', 'category')) { 
				get_template_part( 'parts/carousel', '' ); ?>

		<?php	} else { 
				uu2014_header_image();
			}
		?>
		<?php  if (is_home() || is_front_page() ) { ?>
		<div class="banner-widget-area">
    			<?php get_template_part( 'parts/widgetarea', 'banner' ); ?>
    	</div>
		<?php } ?>

    	<div class="page-header-placeholder"></div>	

	</div>

	<?php  if (is_home() || is_front_page() ) {
	 		get_template_part( 'parts/widgetarea', 'home' );
	 	}
	?>

</header>