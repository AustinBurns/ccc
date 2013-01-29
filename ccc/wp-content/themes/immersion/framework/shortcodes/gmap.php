<?php
function add_shortcode_gmap($atts) {

	extract(shortcode_atts(array(
		'height' => '400',
		'latitude'=> '0',
		'longitude'=> '0',
		'zoom'=> '15',
		'content'=> __('We are here',THEME_SLUG)
	), $atts));
	$output='';
	
	
	global $add_googlemap_script;$add_googlemap_script = true;
	
	$rid=rand(1,1000);
	
		
	$output.="<div id='gmap_".$rid."' class='google-map row' style='height:".$height."px;'></div>";
		
	
	$output.="
	<script>
	jQuery(document).ready(function($) {
	
		$('#gmap_".$rid."').gMap({
		
		latitude: ".$latitude.",
		longitude: ".$longitude.",
		zoom: ".$zoom.",
		}).gMap('addMarker', {
			latitude: ".$latitude.",
			longitude: ".$longitude.",
			content: '".$content."',
			popup: true
		});
	
	});
	
	</script>";
	
	return $output;

	
	
}

add_shortcode('gmap', 'add_shortcode_gmap');
?>
