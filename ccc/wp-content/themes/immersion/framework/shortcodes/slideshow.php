<?php
function add_shortcode_slideshow($atts) {

	extract(shortcode_atts(array(
		'gallery' => '',
		'height'=> '0'
	), $atts));
	$output='';
		
	$rid=rand(1,1000);
	
	$atts=explode (',', get_meta_option('gallery_items', $gallery));

	$output.="<div class='row'>";

	$output.="<div id='flex-slider-".$rid."' class='flexslider-container'>";
		$output.="<div class='flexslider'>";
			$output.="<ul class='slides'>";
						
			foreach($atts as $att):   
				
				$att=get_post($att);
				
				$output.="<li>";
				
					$output.="<img class='scale-with-grid' src='".resize_image( $att->ID ,960, $height )."'/>";	
										
				$output.="</li>";
	
			endforeach; 
	
			$output.="</ul>";
		$output.="</div>";
	$output.="</div>";
	
	
	$output.="</div>";
	$output.="<br class='clear'>";
	
	$output.="
	
		<script>

			jQuery(document).ready(function($){

			$('#flex-slider-".$rid."').flexslider({
				animation: 'slide',
				controlsContainer: '.flexslider-container'
			});

			});

		</script>";
	
	return $output;
	
}

add_shortcode('slideshow', 'add_shortcode_slideshow');
?>
