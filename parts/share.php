<?php if(function_exists('get_field') && get_field('uu_options_share_buttons_location', 'option')) { 

$items = get_field('uu_options_share_buttons_location', 'option');
foreach( $items as $item ) {
	//echo $item->term_id;

	$categories = get_the_category();
	$category_id = $categories[0]->cat_ID;
	echo $category_id;
}

}

?>