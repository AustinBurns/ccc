<?php
	/* Pullquote &amp; Blockquote */
	add_shortcode( 'pullquote', 'if_pullquote' );
	add_shortcode( 'blockquote', 'if_blockquote' );
	
	/* -----------------------------------------------------------------
		Pullquote
	----------------------------------------------------------------- */
	function if_pullquote($atts, $content = null) {
		extract(shortcode_atts(array(
					"position" => 'left'
		), $atts));
		
		$output = '<span class="pullquote-'.$position.'">'.$content.'</span>';
			
		return do_shortcode($output);
	}
	
	
 	/* -----------------------------------------------------------------
		Blockquote
	----------------------------------------------------------------- */
	function if_blockquote($atts, $content = null) {
		
		$output = '<blockquote>'.$content.'</blockquote>';
		return do_shortcode($output);
	}

?>