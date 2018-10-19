<div id="content" class="two-col">
	
<?php get_template_part( 'parts/header-image' ); ?>

<div id="content-wrapper" class="container">
	<div class="row-offcanvas row-offcanvas-left">

		 <?php get_sidebar(); ?> 
			<div class="page-content clearfix">

				
					<?php if (!is_home()) { ?>
					<div class="page-title"> 
	    			
	    				<h1>
							<?php
									if ( is_page() ) :
										the_title(); 	
									
									elseif ( is_singular() ) :
										//the_title(); 
											global $post;
											$categories = get_the_category($post->ID);
											if ($categories) :
												echo $categories[0]->name;
											elseif (is_custom_post_type()) :
												//Get post type  
											   $post_type_obj = get_post_type_object( get_post_type() );
											   $title = apply_filters('post_type_archive_title', $post_type_obj->labels->name );        
											   echo $title;
											   
										endif;
									elseif ( is_category() ) :
										single_cat_title();

									elseif ( is_tag() ) :
										single_tag_title();

									elseif ( is_author() ) :
										printf( __( 'Author Archive: %s', 'uu2014' ), '<span class="vcard">' . get_the_author() . '</span>' );

									elseif ( is_day() ) :
										printf( __( 'Daily Archives: %s', 'uu2014' ), '<span>' . get_the_date() . '</span>' );

									elseif ( is_month() ) :
										printf( __( 'Monthly Archives: %s', 'uu2014' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'uu2014' ) ) . '</span>' );

									elseif ( is_year() ) :
										printf( __( 'Yearly Archives: %s', 'uu2014' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'uu2014' ) ) . '</span>' );

									elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
										_e( 'Asides', 'uu2014' );

									elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
										_e( 'Galleries', 'uu2014');

									elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
										_e( 'Images', 'uu2014');

									elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
										_e( 'Videos', 'uu2014' );

									elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
										_e( 'Quotes', 'uu2014' );

									elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
										_e( 'Links', 'uu2014' );

									elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
										_e( 'Statuses', 'uu2014' );

									elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
										_e( 'Audios', 'uu2014' );

									elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
										_e( 'Chats', 'uu2014' );

									elseif ( is_custom_post_type() && ! is_tax() ) :
										post_type_archive_title();

									elseif ( is_tax() ) :
										 single_term_title();

									elseif ( is_search() ) : 
										echo _x( 'Search', 'label' ); 
										//printf( __( 'Search Results for: %s', 'uu2014' ), esc_attr(get_search_query()) );

									elseif ( is_404() ) :
										_e( '404 Not found', 'uu2014' );

									else :
										the_title(); 

									endif;
								?>
	    				</h1>  

	    			<?php if ( is_search() ) { ?>

										<form role="search" method="get" class="search-form-large search-wrapper visible-xs" action="<?php echo home_url( '/' ); ?>">
												<input type="search" class="searchfield" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
												<input type="submit" class="searchbutton" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
										</form>    
					<?php   }  ?>
	    			
	    			</div> 
	    			<?php } ?>
	    			<?php if ( is_active_sidebar( 'left-sidebar' ) ) { ?>
	    			<div class="toggle-btn-div visible-xs clearfix">
	    			 	<button type="button" class="toggle-btn white button icon left arrow-right" data-toggle="offcanvas"><?php _e('Show sidebar', 'uu2014'); ?></button>
					</div>
					<?php } ?>
			<div class="page-content-inner facetwp-template">	
	    			
	    			<?php
							// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>	

	    			