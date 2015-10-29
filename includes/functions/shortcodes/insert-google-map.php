<?php
class GoogleMap_Shortcode {

	static $add_google_map_script;

	static function init() {
		add_shortcode('insert_map', array(__CLASS__, 'render_shortcode'));
		add_action('init', array(__CLASS__, 'register_google_map_script'));
		add_action('wp_footer', array(__CLASS__, 'print_google_map_script'));
	}

	static function render_shortcode($atts) {
		
		self::$add_google_map_script = true;

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

	static function register_google_map_script() {
		// wp_register_script('my-script', plugins_url('my-script.js', __FILE__), array('jquery'), '1.0', true);
		wp_register_script('googlemaps', ('http://maps.google.com/maps/api/js?sensor=false'), array('jquery'), '1.0', true);
	}

	static function print_google_map_script() {
		if ( ! self::$add_google_map_script )
			return;

		wp_print_scripts('googlemaps');
	}

}

GoogleMap_Shortcode::init();

?>