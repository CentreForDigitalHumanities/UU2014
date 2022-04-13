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
							<?php 

							$mylocale = 'en-US';
							$mylocale = get_bloginfo('language');

              if ($mylocale == 'en-US' || $mylocale == 'en-GB') {
                  echo '<img class="uu-footer-logo" alt="A Logo Utrecht University" src="' . get_theme_file_uri( '/images/uu-logo-footer-en.png' ) . '">';
              } else {
                  echo '<img class="uu-footer-logo" alt="Logo Universiteit Utrecht" src="' . get_theme_file_uri( '/images/uu-logo-footer.png' ) . '">';
              }
							?>
							
							<!-- <nav role="navigation">
								<?php uu2014_footer_nav(); ?>
							</nav> -->
						</div>
						<div class="col-sm-6">
							<p class="source-org copyright pull-right">&copy; <?php echo date('Y'); ?> <?php _e('Utrecht University', 'uu2014'); ?>, <a href="
								<?php 
								if($mylocale == 'en-US' || $mylocale == 'en-GB') {
								echo 'https://www.uu.nl/en/organisation/privacy-statement-utrecht-university';
								} else {
								echo 'https://www.uu.nl/organisatie/privacyverklaring-universiteit-utrecht';
								} ?>"><?php _e('Privacy statement', 'uu2014'); ?></a>
							</p>
						</div>
					</div>
					

					

				</div>
			</footer>
			

		<?php endif; ?>	

