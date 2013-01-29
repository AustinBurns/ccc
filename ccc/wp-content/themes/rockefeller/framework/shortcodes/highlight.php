<?php
	/* Highlight Shortcode */
	add_shortcode( 'highlight', 'if_highlight' );
	
	/* -----------------------------------------------------------------
		Highlight
	----------------------------------------------------------------- */
	function if_highlight($atts, $content = null) {
		extract(shortcode_atts(array(
					"color" => ''
		), $atts));
		
		if($color=="" || $color=="grey"){
			$output = '<span class="highlight1">'.$content.'</span>';
		}
		if($color=="black"){
			$output = '<span class="highlight2">'.$content.'</span>';
		}	
		return do_shortcode($output);
	}
?>