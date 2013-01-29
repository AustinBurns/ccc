<?php
	/* Toggle Shortcode */
	add_shortcode('toggles', 'if_toggles');
	add_shortcode('toggle', 'if_toggle');
	
	/* -----------------------------------------------------------------
		Toggle
	----------------------------------------------------------------- */
	function if_toggle($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'title' => 'Unnamed'
		), $atts));
		
		$output = '
				<h2 class="trigger"><span>'.$title.'</span></h2>
				<div class="toggle_container">
					<div class="block">'.$content.'</div>
				</div>';
			
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
		Toggles container
	----------------------------------------------------------------- */
	function if_toggles($atts, $content = null) {
		$output = '<div id="toggle">'.$content.'</div>';
		return do_shortcode($output);
		
	}
?>