<?php

function add_video_vimeo($atts) {

	extract(shortcode_atts(array(
		'id' 	=> ''
	), $atts));
	$output='';
	
	$output.='<div class="video-wrap"><iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0" width="900" height="600" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
	
	return $output;
	
}
add_shortcode('vimeo', 'add_video_vimeo');

function add_video_youtube($atts) {

	extract(shortcode_atts(array(
		'id' 	=> ''
	), $atts));
	$output='';
	

	$output.='<div class="video-wrap"><iframe src="http://www.youtube.com/embed/'.$id.'" width="900" height="600" frameborder="0"></iframe></div>';
		
	return $output;
	
	
}
add_shortcode('youtube', 'add_video_youtube');



?>