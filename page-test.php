<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 


<?php 

global $wpdb;
global $table_prefix;
$output = '';

//get blog list

			$blogs = $wpdb->get_col( "SELECT blog_id FROM `" . $wpdb->blogs . "` WHERE public = '1' AND archived = '0' AND mature = '0' AND spam = '0' ORDER BY blog_id DESC" );

if ( $blogs ) { ?>
	<table id="sitelist" class="display table table-striped">
		<thead>
			<tr>
				<th><?php _e('Site', 'uu2014'); ?></th>
				<th><?php _e('Type', 'uu2014'); ?></th>
				<th><?php _e('Owner', 'uu2014'); ?></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ( $blogs as $blog ) { ?>

		<?php switch_to_blog($blog); ?>
		<?php if($blog!='1') { ?>
		<tr>
			<td>
				<strong><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></strong>
				<p><?php the_field('uu_siteoptions_description', 'option'); ?></p>
			</td>
			<td><?php the_field('uu_siteoptions_type', 'option'); ?></td>
			<td><?php the_field('uu_siteoptions_owner', 'option'); ?></td>
		</tr>
<?php	} } ?>
		</tbody>
	</table>
<?php	} ?>


			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	


					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<section class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'uu2014' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) ); ?>
						</section>

						<footer class="article-footer">

							<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>

						</footer>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						?>

					</article>

				<?php endwhile; ?>

			<?php else : ?>

			<?php get_template_part('includes/template','error'); // WordPress template error message ?>

			<?php endif; ?>


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