<?php
	/* Dropcap Shortcode */
	add_shortcode( 'dropcap', 'if_dropcap' );
	
	/* -----------------------------------------------------------------
		Dropcaps
	----------------------------------------------------------------- */
	function if_dropcap($atts, $content = null) {
		extract(shortcode_atts(array(
					"type" => ''
		), $atts));
		
		if($type=="circle"){
			$output = '<span class="dropcap2">'.$content.'</span>';
		}elseif($type=="square"){
			$output = '<span class="dropcap3">'.$content.'</span>';
		}else{
			$output = '<span class="dropcap1">'.$content.'</span>';
		}		
		return do_shortcode($output);
	}

?>