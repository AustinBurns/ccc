<?php

function add_shortcode_image($atts) {

	extract(shortcode_atts(array(
		'id' => '88',
		'width' => '600',
		'height' => '0',
		'align' => 'none',
		'lightbox' => 'yes',
		'link' => ''
	), $atts));
	$output='';
	
	$image_wp=wp_get_attachment_image_src( $id, 'full' );

	if($width=='full') { $width='';  $image_size='full'; }
	elseif($width<=300) $image_size='medium';
	else $image_size='full';
	
	if($lightbox=='yes') $lightbox='lightbox';
	
	if($align=='none') $figure_width='style="max-width:'.$width.'px"';
	else $figure_width='';
	

	if($link!='') $output .= '<a class="'.$lightbox.'" href="'.$link.'">';
	
		$output .= '<figure class="row align'.$align.'" '.$figure_width.'>';

			$output .='<img class="scale-with-grid preload" src="'.resize_image( $id ,$width, $height ).'">';

			if($link!='') $output .= '<figcaption class="overlay"></figcaption>';
		
			$output .='</figure>';		

	if($link!='') $output .= '</a>';
	 


	return $output;
	
}

add_shortcode('img', 'add_shortcode_image');

