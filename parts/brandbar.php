<div id="brandbar" class="affix-top">
	<div class="container">
		<div class="row">

			<div class="col-sm-4 col-xs-8 logodiv">
				<button type="button" class="navbar-toggle hidden-print" data-toggle="collapse" data-target="#main-menu-collapse">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

<?php 

	$mylocale = get_bloginfo('language');
	if(function_exists('get_field') && get_field('uu_options_custom_logo', 'options') )	{ 
	$image = get_field('uu_options_custom_logo', 'options'); ?>

	<?php if(get_field('uu_options_custom_logo_url', 'options')) { ?>	
		<a href="<?php get_field('uu_options_custom_logo_url', 'options'); ?>"> 
	<?php } else { ?>
		<a href="<?php echo get_option('siteurl'); ?>">
	<?php  } ?>
			<img src="<?php echo $image['url']; ?>" class="alternative-logo" alt="logo" />
		</a>			
<?php 

} else { 
		if($mylocale == 'en-US' || $mylocale == 'en-GB') {
		echo '<a href="https://www.uu.nl/en"><img src="' . get_template_directory_uri() . '/images/uu-logo-en.svg" alt="Logo Utrecht University" /></a>';
		} else {
		echo '<a href="https://www.uu.nl"><img src="' . get_template_directory_uri() . '/images/uu-logo.svg" alt="Logo Universiteit Utrecht" /></a>';
		} 
	 } ?>

		<div class="visible-print-block">	
			<h1><?php bloginfo('name'); ?></h1>
		</div>	
			</div>

<?php if ( function_exists('icl_object_id') ) :  //check if WPML is activated ?> 
			<div class="col-md-3 col-sm-5 col-xs-2 hidden-print" role="search">
				<div class="brandbar-search">
					
						<form method="get" id="searchform" action="<?php bloginfo('url'); ?>" >
							<label class="screen-reader-text" for="s"><?php __('Search for:', 'uu2014'); ?>'</label>
							<input type="text" class= "searchfield" value="<?php get_search_query() ?>" name="s" id="s" placeholder="<?php _e('Search the Site...','uu2014'); ?>" />
							<input type="submit" id="searchsubmit" class="searchbutton" value="" />
						</form>
					
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-2 hidden-print">
				<div class="language-switch"><?php icl_language_link(); ?></div>
			</div>
		<?php else : ?>
			<div class="col-sm-6 col-xs-4 hidden-print" role="search" >
				
					<div class="pull-right">
						<form method="get" id="searchform" action="<?php bloginfo('url'); ?>" >
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