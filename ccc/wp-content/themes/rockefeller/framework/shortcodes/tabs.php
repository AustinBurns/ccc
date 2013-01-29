<?php

	/* Tab */
	add_shortcode('tabs', 'if_tab');
	
	/* -----------------------------------------------------------------
		Tab
	----------------------------------------------------------------- */
	function if_tab($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'style' => false
		), $atts));
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $count)) {
			return do_shortcode($content);
		} else {
			for($i = 0; $i < count($count[0]); $i++) {
				$count[3][$i] = shortcode_parse_atts($count[3][$i]);
			}
			$output = '<ul class="tabs">';
			
			for($i = 0; $i < count($count[0]); $i++) {
				$output .= '<li><a href="#tab'.$i.'">' . $count[3][$i]['title'] . '</a></li>';
			}
			$output .= '</ul>';
			$output .= '<div id="tab-body">';
			for($i = 0; $i < count($count[0]); $i++) {
				$output .= '<div id="tab'.$i.'" class="tab-content">' . do_shortcode(trim($count[5][$i])) . '</div>';
			}
			$output .= '</div>';
			
			return '<div class="tabcontainer">' . $output . '</div>';
		}
	}

?>