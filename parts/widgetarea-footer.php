<?php 
       	if(is_active_sidebar( 'footer-widget-area-1' ) && is_active_sidebar( 'footer-widget-area-2' ) && is_active_sidebar( 'footer-widget-area-3' )) { ?>
			<div id="footer-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'footer-widget-area-2' ); ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php dynamic_sidebar( 'footer-widget-area-3' ); ?>
						</div>
					</div>	
				</div>	
			</div>	
		<?php	}
		 elseif(is_active_sidebar( 'footer-widget-area-1' ) && is_active_sidebar( 'footer-widget-area-2' )) {  ?>
			<div id="footer-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
						</div>
						<div class="col-md-6 col-sm-6">
							<?php dynamic_sidebar( 'footer-widget-area-2' ); ?>
						</div>
					</div>
				</div>	
			</div>		
		<?php } 		 
       	elseif(is_active_sidebar( 'footer-widget-area-1' )) {  ?>
			<div id="footer-widget-area">
				<div class="wrap">
					<div class="row">
						<div class="col-md-12">
							<?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
						</div>
					</div>
				</div>	
			</div>	

<?php } ?>