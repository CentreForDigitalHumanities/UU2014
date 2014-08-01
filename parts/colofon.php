<?php if(is_active_sidebar( 'colofon' )) : ?>

			<footer id="colophon" class="footer" role="contentinfo">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<?php dynamic_sidebar( 'colofon' ); ?>
						</div>
					</div>	
				</div>	
			</footer>

		<?php else : ?>
			
			<footer id="colophon" class="footer" role="contentinfo">

				<div id="inner-footer" class="container clearfix">
					<div class="row">
						<div class="col-md-8">
							<nav role="navigation">
								<?php uu2014dev_footer_nav(); ?>
							</nav>
						</div>
						<div class="col-md-4">
							<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <a href="http://www.uu.nl/NL/siteinfo/Pages/disclaimer.aspx">disclaimer</a></p>
						</div>
					</div>
					

					

				</div>

			

		<?php endif; ?>	

