<?php
/**
 * Default widget template.
 *
 * Copy this template to /simple-image-widget/widget.php in your theme or
 * child theme to make edits.
 *
 * @package   SimpleImageWidget
 * @copyright Copyright (c) 2014, Blazer Six, Inc.
 * @license   GPL-2.0+
 * @since     4.0.0
 */
?>



<?php if ( ! empty( $image_id ) ) { ?>

	<div class="uu-image-blok">
		<?php
		echo wp_get_attachment_image( $image_id, $image_size );
		
		?>
		<div class="uu-image-blok-content">	
			<?php if ( ! empty( $title ) ) { ?>
				<div class="uu-image-blok-titel">	
					<?php echo $before_title . $title . $after_title; ?>
				</div>
			<?php } ?>
			
			<?php //if ( ! empty( $link_url ) ) { ?>
				<div class="uu-image-blok-url pull-right">
					<?php
						echo $text_link_open; ?>
						<div class="button icon"><?php if ( ! empty( $link_text ) ) { ?><?php echo $link_text; ?><?php } else { _e('Read more'); } ?></div>
						<?php echo $text_link_close; ?>
				</div>
			<?php //} ?>
		</div>

	</div>

	

<?php 

} ?>

<?php
if ( ! empty( $text ) ) :
	echo wpautop( $text );
endif;
?>
