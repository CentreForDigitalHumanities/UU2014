<div id="brandbar" class="affix-top">
	<div class="container">
		<div class="row">

			<div class="col-sm-6 col-xs-8 logodiv">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu-collapse">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

<?php if(function_exists('get_field') && get_field('uu_options_custom_logo', 'options') )	{ 
	$image = get_field('uu_options_custom_logo', 'options');
	?>
	<a href="
	<?php if(get_field('uu_options_custom_logo_url', 'options')) {
		echo get_field('uu_options_custom_logo_url', 'options');
	} else {
		echo get_option('siteurl');
	} ?>

	">
		<img src="<?php echo $image['url']; ?>" class="alternative-logo" />
	</a>	
<?php } else { ?>

				<a href="
				<?php $mylocale = get_bloginfo('language');
										if($mylocale == 'en-US') {
										echo 'http://www.uu.nl/en';
										} else {
										echo 'http://www.uu.nl';
										} ?>
				"><img src="<?php echo get_template_directory_uri() ?>/images/uu-logo.svg" alt="<?php _e('Logo Utrecht University', 'uu2014'); ?>" /></a>
			
<?php } ?>
			</div>

<?php if ( function_exists('icl_object_id') ) :  //check if WPML is activated ?> 
			<div class="col-sm-3 col-xs-2">
				<div class="brandbar-search">
					
						<form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>" >
							<label class="screen-reader-text" for="s"><?php __('Search for:', 'uu2014'); ?>'</label>
							<input type="text" class= "searchfield" value="<?php get_search_query() ?>" name="s" id="s" placeholder="<?php _e('Search the Site...','uu2014'); ?>" />
							<input type="submit" id="searchsubmit" class="searchbutton" value="" />
						</form>
					
				</div>
			</div>
			<div class="col-sm-3 col-xs-2">
				<div class="language-switch"><?php icl_language_link(); ?></div>
			</div>
		<?php else : ?>
			<div class="col-sm-6 col-xs-4">
				
					<div class="pull-right">
						<form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>" >
							<div class="search-wrapper">
								<label class="screen-reader-text" for="s"><?php __('Search for:', 'uu2014'); ?>'</label>
								<input type="text" class= "searchfield" value="<?php get_search_query() ?>" name="s" id="s" placeholder="<?php _e('Search the Site...','uu2014'); ?>" />
								<input type="submit" id="searchsubmit" class="searchbutton" value="" />
							</div>
							
						</form>
					</div>
				
			</div>		
		<?php endif; ?>	
		</div>
	</div>
</div>