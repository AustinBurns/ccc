<?php
	/* Shortcode */
	add_shortcode('separator', 'if_separator');
	add_shortcode('clearfix', 'if_clearfixfloat');
	
	/* -----------------------------------------------------------------
		Separator
	----------------------------------------------------------------- */
	function if_separator($atts, $content = null) {
		extract(shortcode_atts(array(
					"line" => ''
		), $atts));

		if($line==""){
		$output = '<div class="separator"><div></div></div>';
		}else{
		$output = '<div class="clearfix"></div><div class="separator line"><div></div></div>';
		}
		
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
		Clearfix
	----------------------------------------------------------------- */
	function if_clearfixfloat($atts, $content = null) {
		$output = '<div class="clearfix"></div>';
		return do_shortcode($output);
		
	}
?>