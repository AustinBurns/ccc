<?php
	/* Shortcode */
	add_shortcode('pre', 'if_pre');
	
	/* -----------------------------------------------------------------
		Pre
	----------------------------------------------------------------- */
	function if_pre($atts, $content) {
	
		$return_html = '<pre>'.strip_tags($content).'</pre>';
		
		return $return_html;
	}

?>