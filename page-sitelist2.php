<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

test

<?php the_content(); ?>


<?php 

$args = array(
		"public" => 1	
	);

$sites_list = get_sites ($args); 
$current_blog = get_current_blog_id(); ?>
<table id="sitelist">
<thead>
<tr>
	<th><?php echo __('Title', 'uu2014'); ?></th>
	<th><?php echo __('Type', 'uu2014'); ?></th>
	<th><?php echo __('Faculty', 'uu2014'); ?></th>
<th><?php echo __('Users', 'uu2014'); ?></th>

</tr>
</thead>
<?php foreach ($sites_list as $site) {
	//$blog_details = get_blog_details( $site ); ?>
	<?php switch_to_blog($site->blog_id); ?>
<tr>
	<td>
	<a href="https://<?php echo $site->domain; ?>">
	<div class="col-sm-2">
		<?php 
		$image_id = '';
		if(isset(get_custom_header()->attachment_id)) {
		$image_id = get_custom_header()->attachment_id; 
			if($image_id) {
				$thumb_url = wp_get_attachment_image_src($image_id,'thumbnail', false); ?>
		
			<img class="site_thumb" width="80px" height="80px" src="<?php echo $thumb_url[0]; ?>" />
		<?php }	} else { ?>

		
		<?php } ?>
	</div>
	<div class="col-sm-10">
		<h2><?php echo $site->blogname; ?></h2>
		<p>
		<?php echo get_field('uu_siteoptions_description', 'option'); ?>
		</p>
	</div>
	</a>
	
	</td>
	<td>
	<?php $field = get_field_object('uu_siteoptions_type', 'option');
	$value = $field['value'];
	$choices = $field['choices'];
	if($value) { ?>
		
			<?php foreach( $value as $v ): ?>
			<div class="sitelist-type">
				<?php echo $choices[ $v ]; ?>
			</div>
			<?php endforeach; ?>
		
	<?php }  ?>		
	</td>
	<td>
	<?php $field2 = get_field_object('uu_siteoptions_owner', 'option');
	$value2 = $field2['value'];
	$choices2 = $field2['choices'];
	if($value2) { ?>
		
			<?php foreach( $value2 as $v2 ): ?>
			<div class="sitelist-fac">
				<?php echo $choices2[ $v2 ]; ?>
			</div>
			<?php endforeach; ?>
		
	<?php } ?>	
	</td>	
	<td>
		<?php $args = array(
	'blog_id'      => $site->blog_id,
	'role'         => 'administrator',
	'role__in'     => array(),
	'role__not_in' => array(),
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'date_query'   => array(),        
	'include'      => array(),
	'exclude'      => array(1),
	'orderby'      => 'login',
	'order'        => 'ASC',
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => ''
 ); 
$blogusers = get_users( $args ); 
// Array of stdClass objects.
foreach ( $blogusers as $user ) {
	echo esc_html( $user->display_name ) . ', ';
}
?>
	</td>
</tr>
	
<?php } ?>
<?php restore_current_blog(); ?>
</table>
<?php get_template_part( 'parts/page-footer-1col'); ?> 
<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $('#sitelist').dataTable({
                        "aaSorting":[],
                        "bSortClasses":false,
                        "asStripeClasses":['even','odd'],
                        "bSort":true
                    });
	} );
</script>
<?php get_footer();