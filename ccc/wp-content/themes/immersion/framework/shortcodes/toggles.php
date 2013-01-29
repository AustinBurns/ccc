<?php

function add_shortcode_toggle( $atts, $content ){

	extract(shortcode_atts(array(
		'title' => 'Toggle',
		'hidden' => 'yes'
	), $atts));
	$output='';
	
	if($hidden=='yes') { $hidden='hidden'; $title_class=''; }
	else { $hidden=''; $title_class='toggle-visible'; }

	$output.='<div class="toggle-wrap">';
		$output.='<h3 class="toggle-title '.$title_class.'">'.$title.'</h3>';

		$output.='<div class="toggle-box '.$hidden.'">';
			//$output.='<div class="content">';
				$output.=$content;
			//$output.='</div>';
		$output.='</div>';
	
	$output.='</div>';
	
	

	return $output;
	
}

add_shortcode( 'toggle', 'add_shortcode_toggle' );

?>
