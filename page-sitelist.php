<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 



<?php the_content(); ?>


<?php 

if ( false === ( $sites_list = get_transient( 'sites_list_query_results' ) ) ) {

$args = array(
		"public" => 1,
		"number" => 800,
		"orderby" => 'domain'		
	);

$sites_list = get_sites ($args); 

set_transient( 'sites_list_query_results', $sites_list, 12 * HOUR_IN_SECONDS );
}
$current_blog = get_current_blog_id(); ?>
<table id="sitelist">
<thead>
<tr>
	<th><?php echo __('Title', 'uu2014'); ?></th>
	<th><?php //echo __('Type', 'uu2014'); ?></th>
	<th><?php //echo __('Faculty', 'uu2014'); ?></th>

</tr>
</thead>
<?php foreach ($sites_list as $site) {
	//$blog_details = get_blog_details( $site ); ?>
	<?php switch_to_blog($site->blog_id); ?>
<tr>
	<td>
	<a href="https://<?php echo $site->domain; ?>">
	<div class="col-sm-3">
		<?php 
		$image_id = '';
		if(isset(get_custom_header()->attachment_id)) {
		$image_id = get_custom_header()->attachment_id; 
			if($image_id) {
				$thumb_url = wp_get_attachment_image_src($image_id,'thumbnail', false); ?>
		
			<img class="site_thumb img-responsive" src="<?php echo $thumb_url[0]; ?>" />
		<?php }	} else { ?>

		
		<?php } ?>
	</div>
	<div class="col-sm-9">
		<h2><?php echo $site->blogname; ?></h2>
		<p>
			<?php echo get_field('uu_siteoptions_description', 'option');  ?>
		</p>
		<small>
		<?php
		$wpmu = wpmu_get_mapped_domain_link($site->blog_id);
		if($wpmu !== false) {
			echo $wpmu;
		} else {
			echo get_site_url($site->blog_id);
		}
		 ?>
		</small>
		
	</div>
	</a>
	
	</td>
	<td>
	<?php $field = get_field_object('uu_siteoptions_type', 'option');
	$value = $field['value'];
	$choices = $field['choices'];
	if($value) { 
		
			$i=0;
			$len = count($value);
			
			 foreach( $value as $v ): 
			 	
			 	echo $choices[ $v ]; 
				if ($i == ($len - 1) ) {
       				
    			} else {
    				echo ' | ';
    			}
    			$i++;
			endforeach; ?>
		
	<?php }  ?>		
	</td>
	<td>
	<?php $field2 = get_field_object('uu_siteoptions_owner', 'option');
	$value2 = $field2['value'];
	$choices2 = $field2['choices'];
	if($value2) { 
			$i=0;
			$len = count($value2);
			
			 foreach( $value2 as $v2 ): 
			 	
			 	echo $choices2[ $v2 ]; 
				if ($i == ($len - 1) ) {
       				
    			} else {
    				echo ' | ';
    			}
    			$i++;
			endforeach; ?>
		
	<?php } ?>	
	</td>	
</tr>
<?php restore_current_blog(); ?>	
<?php } ?>

</table>
<?php get_template_part( 'parts/page-footer-1col'); ?> 


<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $('#sitelist').dataTable({
                        "aaSorting":[],
                        "bSortClasses":false,
                        "asStripeClasses":['even','odd'],
                        "bSort":true
                    }).yadcf([{
                    			filter_type: 'select',
						        column_number: 1,
						         filter_match_mode: 'exact',
						         text_data_delimiter: " | ",
						         filter_default_label:'All types',
						         filter_reset_button_text: false,
						    }, {
						    	filter_type: 'select',
						        column_number: 2,
						         filter_match_mode: 'exact',
						         text_data_delimiter: " | ",
						         filter_default_label:'All Faculties',
						         filter_reset_button_text: false,
						    }
					]);	    
	} );
</script>

<?php get_footer();