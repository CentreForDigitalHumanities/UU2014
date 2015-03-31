<?php 

function lecturenet_shortcode($atts) {
    extract(shortcode_atts(array(
        "url" => '',
        "width" => '100%',
        "height" => '400'
    ), $atts));
    return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="auto" marginheight="0" marginwidth="0" src="'.$url.'"></iframe>';
}

add_shortcode("lecturenet", "lecturenet_shortcode");

?>