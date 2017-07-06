<?php 
       	
       	if(is_active_sidebar( 'banner-widget-area' )) {  ?>
			<div class="banner-widget-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php dynamic_sidebar( 'banner-widget-area' ); ?>
						</div>
					</div>
				</div>	
			</div>	
		<?php } 	
		

