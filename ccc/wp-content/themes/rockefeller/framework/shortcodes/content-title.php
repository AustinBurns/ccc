<?php
	/* Shortcode */
	add_shortcode('content_title', 'if_content_title');
	
	/* -----------------------------------------------------------------
		Content Title
	----------------------------------------------------------------- */
	function if_content_title($atts, $content = null) {
		extract(shortcode_atts(array(
		), $atts));

		$output = '<h2 class="contenttitle"><span>'.$content.'</span></h2>';
		return do_shortcode($output);
	}
?>