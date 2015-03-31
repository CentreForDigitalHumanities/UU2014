<?php 

function menu_ul_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "offsettop" => '350',
        "offsetbottom" => '500'
    ), $atts));
    return '<div id="sidebarnav"><ul class="nav list-group affix-top" data-spy="affix" data-offset-top="'.$offsettop.'" data-offset-bottom="'.$offsetbottom.'">'.do_shortcode($content).'</ul></div>';
}

add_shortcode("scroll_menu", "menu_ul_shortcode");

function menu_li_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "id" => ''
    ), $atts));
    return '<li class="list-group-item"><a href="#'.$id.'"> '.do_shortcode($content).'</a></li>';
}

add_shortcode("scroll_item", "menu_li_shortcode");

function menu_lisub_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "id" => ''
    ), $atts));
    return '<li class="list-group-item sub"><a href="#'.$id.'"> '.do_shortcode($content).'</a></li>';
}

add_shortcode("scroll_subitem", "menu_lisub_shortcode");

function menu_section_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "id" => ''
    ), $atts));
    return '<section id="'.$id.'"> '.$content.'</section>';
}

add_shortcode("scroll_titel", "menu_section_shortcode");

?>