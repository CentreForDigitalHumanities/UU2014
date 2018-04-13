<?php if(is_active_sidebar( 'colofon' )) : ?>

			<footer id="colophon" class="footer hidden-print">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<?php dynamic_sidebar( 'colofon' ); ?>
						</div>
					</div>	
				</div>	
			</footer>

		<?php else : ?>
			
			<footer id="colophon" class="footer hidden-print">

				<div id="inner-footer" class="container clearfix">
					<div class="row">
						<div class="col-sm-6">
							<img alt="<?php _e('Logo Utrecht University', 'uu2014'); ?>" src="<?php echo get_template_directory_uri() ?>/images/uu-logo-footer.svg">
							<!-- <nav role="navigation">
								<?php uu2014_footer_nav(); ?>
							</nav> -->
						</div>
						<div class="col-sm-6">
							<p class="source-org copyright pull-right">&copy; <?php echo date('Y'); ?> <?php _e('Utrecht University', 'uu2014'); ?>, <a href="
								<?php 
								$mylocale = 'en-US';
								$mylocale = get_bloginfo('language');
										if($mylocale == 'en-US') {
										echo 'https://www.uu.nl/en/organisation/contact/disclaimer';
										} else {
										echo 'https://www.uu.nl/organisatie/contact/disclaimer';
										} ?>"><?php _e('disclaimer', 'uu2014'); ?></a></p>
						</div>
					</div>
					

					

				</div>
			</footer>
			

		<?php endif; ?>	

