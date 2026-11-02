<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

<?php 

$urls = [
    'www.example.org',
    'www.google.com',
    'https://www.google.com',
];
//var_dump(validate_urls($urls, 1000, 1, true, true));

?>

<table id="sitelist">

	<thead>
		<tr>
			<th>Status</th>
			<th>Name</th>
			<th>ID</th>
			<th>Public</th>
			<th>Date registered</th>
			<th>Last update</th>
			<th>Organisation</th>
			<th>Admins</th>
		</tr>
	</thead>
	<?php 

	$args = array(
		
		"number" => 5000,
		"orderby" => "registered",
		"order" => "DESC"	
	);


	$subsites = get_sites($args);
	foreach( $subsites as $subsite ) {
		echo '<tr>';
			//print_r($subsite);
			$subsite_id = $subsite->blog_id;
			$subsite_name = get_blog_details($subsite_id)->blogname;
			$subsite_object = get_site();

			$organisation = get_site_meta($subsite_id, 'uu_site_meta_organisation', true);

			//$meta_array = get_site_meta($subsite_id);

			// echo '<pre>';
			// echo $organisation;
			//  echo '</pre>';

			// if ( array_key_exists('uu_site_meta_organisation', $meta_array) ) {
			// 	$organisation =  "org";
			// 	//$organisation = join($meta_array['uu_site_meta_organisation'], '|' );
			// } else {
			// 	$organisation = '';
			// }

			$args = array(
				'role'    => 'Administrator',
				'orderby' => 'user_registered',
				'order'   => 'DESC',
				'blog_id' => $subsite->blog_id,
				'fields' => array('ID','display_name', 'user_email', 'user_login')
			);
			$user_query = new WP_User_Query( $args );

			$admins = '';
			if ( ! empty( $user_query->get_results() ) ) {
				foreach ( $user_query->get_results() as $user ) {
					//print_r($user);
					if(is_super_admin($user->ID)) {

					} else {
						if(!empty($user->display_name)) {
							$username = $user->display_name;
						} else {
							$username = $user->user_login;
						}
						//$admins .= '<a href="mailto:' . $user->user_email . '">' . $user->display_name . '</a>, ';
						$admins .= $user->user_email . ', ';
					}
					
				}
			} 
			//$admins_object = get_users( 'blog_id=' . $subsite->blog_id . '&orderby=user_registered&role=administrator' );

			$admins_object = get_users($args);
			//print_r($admins_object);
			//$admins = join($admins_object, ', ');

			$status = '';
			// echo '<pre>';
			// print_r($admins_object);
			// echo '</pre>';
			echo '<td>' . $status . '</td>';
			echo '<td><a href="https://' . $subsite->domain . '">' . $subsite_name . '</a></td>';
			echo '<td>' . $subsite_id . '</td>';
			echo '<td>' . $subsite->public . '</td>';
			echo '<td>' . $subsite->registered . '</td>';
			echo '<td>' . $subsite->last_updated . '</td>';
			echo '<td>' . $organisation . '</td>';
			echo '<td>' . $admins . '</td>';
		echo '</tr>';
	} ?>

</table>
<?php the_content(); ?>


<?php 



get_template_part( 'parts/page-footer-1col'); ?> 


<script type="text/javascript">
	// jQuery(document).ready(function($) {
	//     $('#sitelist').dataTable({
    //                     "aaSorting":[],
    //                     "bSortClasses":false,
    //                     "asStripeClasses":['even','odd'],
    //                     "bSort":true
    //                 }).yadcf([{
	// 					filter_type: 'select',
	// 					column_number: 5,
	// 					filter_match_mode: 'exact',
	// 					text_data_delimiter: " | ",
	// 					filter_default_label:'All Faculties',
	// 					filter_reset_button_text: false,
	// 					}
	// 				]);	    
	// } );
</script>

<?php get_footer();