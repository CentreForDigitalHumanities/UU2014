<?php
class GoogleMap_Shortcode {

	static function init() {
		add_shortcode('insert_map', array(__CLASS__, 'render_shortcode'));
		add_action('wp_footer', array(__CLASS__, 'enqueue_map_javascript'));
	}

	static function render_shortcode($atts) {
		extract( shortcode_atts( array(
			'id' => 'map-canvas-1',
			'class' => '',
			'zoom' => '18',
			'coords' => '53.339381, -6.260405',
			'type' => 'roadmap',
			'width' => '100%',
			'height' => '400px'
		), $atts ) );
		
		$return = "";
		
		$map_type_id = "google.maps.MapTypeId.ROADMAP";
		
		switch ($type) {
			case "roadmap":
				$map_type_id = "google.maps.MapTypeId.ROADMAP";
				break;
			case "satellite":
				$map_type_id = "google.maps.MapTypeId.SATELLITE";
				break;
			case "hybrid":
				$map_type_id = "google.maps.MapTypeId.HYBRID";
				break;
			case "terrain":
				$map_type_id = "google.maps.MapTypeId.TERRAIN";
				break;
		}
		
		
		$return = '<div id="'.$id.'" class="map-canvas '.$class.'" style="width:'.$width.';height:'.$height.';" ></div>';
		$return .= '<script type="text/javascript">';
		$return .= 'jQuery(document).on("ready", function(){ ';
		$return .= 'var options = { center: new google.maps.LatLng('.$coords.'),';
		$return .= 'zoom: ' . $zoom . ', mapTypeId: ' . $map_type_id . ' };';
		$return .= 'var map = new google.maps.Map(document.getElementById("'.$id.'"), options);';
		$return .= 'var marker = new google.maps.Marker({ position: new google.maps.LatLng('.$coords.'), map: map });';
		$return .= '});</script>';
		
		return $return;	

	}

	static function enqueue_map_javascript() {
		wp_register_script('googlemaps', ('http://maps.google.com/maps/api/js?sensor=false'), false, null, true);
    	wp_enqueue_script('googlemaps');
		// wp_enqueue_script( 'map-js', 
		// 	"https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false",
		// 	"jquery"
		// );
	}
}

GoogleMap_Shortcode::init();

?>