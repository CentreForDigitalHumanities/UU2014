<?php 
       	if(is_active_sidebar( 'banner-widget-area-1' ) && is_active_sidebar( 'banner-widget-area-2' ) && is_active_sidebar( 'banner-widget-area-3' )) { ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-widget-area-1' ); ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-widget-area-2' ); ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-widget-area-3' ); ?>
						</div>
					</div>	
				</div>	
			</div>	
		<?php	}
		 elseif(is_active_sidebar( 'banner-widget-area-1' ) && is_active_sidebar( 'banner-widget-area-2' )) {  ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-widget-area-1' ); ?>
						</div>
						<div class="col-md-8 col-sm-8">
							<?php dynamic_sidebar( 'banner-widget-area-2' ); ?>
						</div>
					</div>
				</div>	
			</div>		
		<?php }
		elseif(is_active_sidebar( 'banner-widget-area-1' ) && is_active_sidebar( 'banner-widget-area-3' )) {  ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-8 col-sm-8">
							<?php dynamic_sidebar( 'banner-widget-area-1' ); ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-widget-area-3' ); ?>
						</div>
					</div>
				</div>	
			</div>		
		<?php } 
       	elseif(is_active_sidebar( 'banner-widget-area-1' )) {  ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-12">
							<?php dynamic_sidebar( 'banner-widget-area-1' ); ?>
						</div>
					</div>
				</div>	
			</div>
		<?php } 	
		elseif(is_active_sidebar( 'banner-widget-area-3' )) {  ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-4 col-md-push-8">
							<?php dynamic_sidebar( 'banner-widget-area-3' ); ?>
						</div>
					</div>
				</div>	
			</div>	



<?php } ?>