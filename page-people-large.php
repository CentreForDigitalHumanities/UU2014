<?php get_header(); 
/**
 * Template Name: People page single column
 * Description: A template for displaying people in a single row (large photo's)
 *
 */ ?>
<?php get_template_part( 'parts/page-header-2col'); ?> 

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<section class="entry-content">
							<div>
							<?php the_content(); ?>
							
							<?php if( have_rows('persoon') ): ?>

							

									<?php



									while( have_rows('persoon') ): the_row(); 

									// vars
									$type = get_sub_field('uu_people_type');
									$thumb = wp_get_attachment_image_src(get_sub_field('uu_people_image'), 'thumbnail');
									$large = wp_get_attachment_image_src(get_sub_field('uu_people_image'), 'large');
									$naam = get_sub_field('uu_people_name');
									$omschrijving = get_sub_field('uu_people_desc');
									$rol = get_sub_field('uu_people_title');
									$email = get_sub_field('uu_people_email');
									$url = get_sub_field('uu_people_website');
									$titel = get_sub_field('uu_people_title_heading');	

								
									if($type == 'Kop') {
										?>
									

									
									<h2 class="people-heading"><?php echo $titel; ?></h2>
									
									<?php 

									}  else {

										?>
										<?php //if($thumb) { ?>

											<div class="people-item people-item-large row">

												<div class="people-item-image col-sm-3">
												
													<img class="img-responsive" src="<?php echo $large[0]; ?>" alt="" />
												
												</div>

												<div class="people-item-content col-sm-9">	

												    	<div class="people-item-content-naam"><?php echo $naam; ?></div>
												    <?php if( $rol ): ?>	
												    	<div class="people-item-content-rol"><?php echo $rol; ?> </div>
												    <?php endif; ?>		
												    <?php if( $omschrijving ): ?>
														<div class="people-item-content-omschrijving">
																<?php
																if( get_field('uu_options_people_page_trim_description', 'option') ) { 
																	$trim = wp_trim_words( $omschrijving, 40, '...');  
																	
																	echo $trim;
																} else {
																echo $omschrijving;
																}
																?>

																<?php if( $url ): ?>
														
																<a href="<?php echo $url; ?>"><?php _e('Read more','uu2014'); ?></a>
														
													
													<?php endif; ?>
														</div>	
													<?php endif; ?>	
													
												    <?php if( $email ): ?>
														<div class="people-item-content-mail">
																<a href="mailto:<?php echo $email; ?>"><?php _e('Mail','uu2014'); ?></a>
														</div>	
													<?php endif; ?>
											

														
												</div>

											</div>

											<?php //} else { ?>
												<!-- <div class="people-item-content-naam-geen-foto">
												<?php if( $url ) { ?><a href="<?php echo $url; ?>"><?php } ?>			
														<?php echo $naam; ?>
												<?php if( $url ) { ?></a><?php } ?>			
												</div> -->

											<?php //} ?>	
								

										<?php 
									}
									
								?>
								<?php
									endwhile;

								?>

							

				<?php endif; ?>
							</div>		
						</section>

						<footer class="article-footer">

							<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>

						</footer>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						?>

					</article>

				

				

			<?php endwhile; ?>				

			<?php else : ?>

			<?php get_template_part('includes/template','error'); // WordPress template error message ?>

			<?php endif; ?>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();