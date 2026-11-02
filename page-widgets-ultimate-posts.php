<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 



<?php 

//echo get_widget_traverse_multisite();



// echo '<pre>';
// print_r($widgets);
// echo '</pre>';




the_content(); ?>


<?php 


function array_search_partial($arr, $keyword) {
    foreach($arr as $index => $string) {
        if (strpos($string, $keyword) !== FALSE)
            return $index;
    }
}

//if ( false === ( $sites_list = get_transient( 'sites_list_query_results' ) ) ) {

$args = array(
		"public" => 1,
		"number" => 2000,
		"orderby" => "registered",
		"order" => "DESC"	
	);

$sites_list = get_sites ($args); 

//set_transient( 'sites_list_query_results', $sites_list, 12 * HOUR_IN_SECONDS );
//}
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
	<?php switch_to_blog($site->blog_id); 

		$has_widget = false;
		$url = get_site_url($site->blog_id) . '/wp-admin/plugins.php';
		$sidebars_widgets = get_option( 'sidebars_widgets' );	
		
		foreach($sidebars_widgets as $sidebar_widget) {
		
			if ( array_search_partial($sidebar_widget, 'sticky-posts') )
			{
					
					$has_widget = true;
				
			}
		}
		
	
if($has_widget)	{	
	?>
<tr>
	<td>


	<a href="<?php echo $url; ?>">
	<?php echo $url; ?>
	</a>
	
	</td>
	<td>
	<?php
$sidebars_widgets = get_option( 'sidebars_widgets' );	

foreach($sidebars_widgets as $sidebar => $widgets) {
	$ignore = array('wp_inactive_widgets', 'array_version');
	if ( !in_array($sidebar,$ignore)  && count($widgets) > 0 ) {
		echo $sidebar .': ';
		echo implode( ', ', $widgets );
		echo '<br />';
		// echo '<pre>';
		// print_r($widget);
		// echo '</pre>';
	}
		
}

?>




	

	</td>
	<td>

	</td>	
</tr>
<?php
}
$has_widget = false;
restore_current_blog(); ?>	
<?php } ?>

</table>
<?php get_template_part( 'parts/page-footer-1col'); ?> 


<script type="text/javascript">
	// jQuery(document).ready(function($) {
	//     $('#sitelist').dataTable({
    //                     "aaSorting":[],
    //                     "bSortClasses":false,
    //                     "asStripeClasses":['even','odd'],
    //                     "bSort":true
    //                 }).yadcf([{
    //                 			filter_type: 'select',
	// 					        column_number: 1,
	// 					         filter_match_mode: 'exact',
	// 					         text_data_delimiter: " | ",
	// 					         filter_default_label:'All types',
	// 					         filter_reset_button_text: false,
	// 					    }, {
	// 					    	filter_type: 'select',
	// 					        column_number: 2,
	// 					         filter_match_mode: 'exact',
	// 					         text_data_delimiter: " | ",
	// 					         filter_default_label:'All Faculties',
	// 					         filter_reset_button_text: false,
	// 					    }
	// 				]);	    
	// } );
</script>

<?php get_footer();