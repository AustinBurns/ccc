<?php
function add_shortcode_button($atts) {

	extract(shortcode_atts(array(
		'color' => '',
		'fullwidth'=> '',
		'text' => __('Press Me',THEME_SLUG),
		'link'=> ''
	), $atts));
	$output='';
	
	
	if($fullwidth=='true') $fullwidth=' full-width';
	else $fullwidth='';
	
	$output.="<a class='button ".$color.$fullwidth."' href='".$link."'>".$text."</a>";

	return $output;
	
}

add_shortcode('button', 'add_shortcode_button');
?>
