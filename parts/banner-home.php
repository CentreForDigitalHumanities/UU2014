<?php // Interior Header Image ?>
        <div class="banner-wrap">
            <div id="banner">
                
                	
					<?php 
       	if(is_active_sidebar( 'banner-area-1' ) && is_active_sidebar( 'banner-area-2' ) && is_active_sidebar( 'banner-area-3' )) { ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-area-1' ); ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-area-2' ); ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'banner-area-3' ); ?>
						</div>
					</div>	
				</div>	
			</div>	
		<?php	}
		 elseif(is_active_sidebar( 'banner-area-1' ) && is_active_sidebar( 'banner-area-2' )) {  ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<?php dynamic_sidebar( 'banner-area-1' ); ?>
						</div>
						<div class="col-md-6 col-sm-6">
							<?php dynamic_sidebar( 'banner-area-2' ); ?>
						</div>
					</div>
				</div>	
			</div>		
		<?php } 		 
       	elseif(is_active_sidebar( 'banner-area-1' )) {  ?>
			<div class="banner-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-12">
							<?php dynamic_sidebar( 'banner-area-1' ); ?>
						</div>
					</div>
				</div>	
			</div>	

       <?php } 
       else { ?>
		<div class="spacer"></div>
       <?php }	?>



                
            </div>
        </div>