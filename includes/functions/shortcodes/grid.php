<?php 

function uu_grid_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        // "columns" => '3',
        // "offsetbottom" => '500'
    ), $atts));
    return '<div class="uugrid row">'.$content.'</div>';
}

add_shortcode("uugrid", "uu_grid_shortcode");

function uu_grid_block_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "width" => '25%',
        "height" => '200px',
        "style" => 'flip',
        "title" => '',
        "text" => '',
        "url" => '',
        "color" => 'yellow'
    ), $atts));
        
        if($color == 'black') {
            $colorcode='#000000';
            $textcolor='#eeeeee';
        }
        elseif ($color == 'lightgrey') {
             $colorcode='#eeeeee';
             $textcolor='#333333';
        }
        elseif ($color == 'darkgrey') {
             $colorcode='#555555';
             $textcolor='#eeeeee';
        }
        else {
            $colorcode='#ffcd00';
            $textcolor='#000000';
        }
        $result = '';
       
        $result .= '<div class="uu-grid-block" style="width: '.$width.'; height: '.$height.'" ><div class="card effect__hover"><div class="card__front">';
        $result .= $content;
        $result .= '</div>';
        $result .= '<div class="card__back" style="background-color:'.$colorcode.';">';
        if(isset($url)) {
        $result .= '<a href="'.$url.'">';
        } 
        $result .= '<div class="card__text"><h2 style="color: '.$textcolor.';">'.$title.'</h2><p style="color: '.$textcolor.';">'.$text.'</p></div>';
        if(isset($url)) {
        $result .= '</a>';
        }
        $result .= '</div></div>';
        $result .= '</div>';
        
      
    return $result;     
}

add_shortcode("uublock", "uu_grid_block_shortcode");


?>