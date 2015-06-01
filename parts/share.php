<?php if(function_exists('get_field') && get_field('uu_options_share_buttons_location', 'option')) { 


$terms = get_field('uu_options_share_buttons_location', 'option');
	// Get current page URL
		$shortURL = get_permalink();
		
		// Get current page title
		$shortTitle = get_the_title();
		

		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$shortTitle.'&amp;url='.$shortURL.'&amp;via=Crunchify';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shortURL;
		$googleURL = 'https://plus.google.com/share?url='.$shortURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$shortURL.'&amp;text='.$shortTitle;
	
		$content = '';
		// Add sharing button at the end of page/page content
		$content .= '<div class="">';
		$content .= '<h5>SHARE ON</h5> <a class="button icononly sharebutton twitter" href="'. $twitterURL .'" target="_blank" title="Twitter"></a>';
		$content .= '<a class="button icononly sharebutton facebook" href="'.$facebookURL.'" target="_blank" title="Facebook"></a>';
		$content .= '<a class="button icononly sharebutton googleplus" href="'.$googleURL.'" target="_blank" title="Google+"></a>';
		//$content .= '<a class="crunchify-link crunchify-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
		$content .= '</div>';
		//return $content;
		echo $content;
}

?>