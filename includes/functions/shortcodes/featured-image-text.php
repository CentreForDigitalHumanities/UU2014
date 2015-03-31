<?php 

function featured_image_text_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "content" => '',
        "url" => '',
        "align" => 'right',
        "urllabel" => _x('read more', 'uu2014')
    ), $atts));
    return '<div class="featured-image-wrapper '.$align.'"><div class="featured-image-text ">'.$content.'</div><a class="button icon pull-right" href="'.$url.'">'.$urllabel.'</a></div>';
}

add_shortcode("featured", "featured_image_text_shortcode");

?>