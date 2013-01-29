<?php

function add_shortcode_blockquote($atts, $content = null) {

	extract(shortcode_atts(array(

	), $atts));
	
	return "<blockquote>".$content."<span></span></blockquote>";
}
add_shortcode('blockquote', 'add_shortcode_blockquote');

function add_shortcode_dropcap($atts) {

	extract(shortcode_atts(array(
		'text' => 'A',
	), $atts));
	
	return '<div class="dropcap">'.$text.'</div>';
}
add_shortcode('dropcap', 'add_shortcode_dropcap');

function add_shortcode_highlight($atts, $content = null) {

	extract(shortcode_atts(array(
		'color' => ''
	), $atts));

	return '<span class="highlight '.$color.'">'.do_shortcode($content).'</span>';
}
add_shortcode('highlight', 'add_shortcode_highlight');


