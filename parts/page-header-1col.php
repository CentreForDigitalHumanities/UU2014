<div id="content" class="one-col">

<?php get_template_part( 'parts/header-image' ); ?>

<div id="content-wrapper" class="full-width">
	

				
				<?php if (!is_home()) { ?>
					<div class="page-title"> 
	    			
	    				<h1>
	    					<div class="container">
							<?php
									if ( is_page() ) :
										the_title(); 
											
									elseif ( is_singular() ) :
										//the_title(); 
										global $post;
										$categories = get_the_category($post->ID);
										echo $categories[0]->name;	

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
										printf( __( 'Search Results for: %s', 'uu2014' ), esc_attr(get_search_query()) );

									else :
										the_title(); 

									endif;
								?>
							</div>
	    				</h1>     
	    			
	    			</div> 
					<?php } ?>


		<div class="container">			
					<div class="page-content-inner">
	    			<?php
							// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>	

	    			