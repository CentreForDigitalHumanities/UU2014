<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 */
?>
		</div><?php //END #main ?>

	<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
		<div id="left-sidebar" class="sidebar col-sm-4 col-md-pull-8 clearfix" role="complementary">
			<?php dynamic_sidebar( 'left-sidebar' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
		<div id="right-sidebar" class="sidebar col-sm-4 clearfix" role="complementary">
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		</div>
	<?php endif; ?>

		</div><?php //END #inner-content ?>

	</div><?php //END #content ?>

<?php get_template_part( 'parts/widgetarea', 'footer' ); ?>  

<?php get_template_part( 'parts/colofon'); ?>  


	<p id="back-top">
        <a href="#top"><i class="fa fa-angle-up"></i></a>
    </p>

</div><?php //END #container ?>

<?php wp_footer(); ?>



</body>
</html>