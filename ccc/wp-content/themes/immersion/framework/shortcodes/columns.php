<?php

function add_shortcode_column($atts, $content = null, $code) {

	extract(shortcode_atts(array(
		'size' => '',
		'pos' => ''
	), $atts));
	$output='';
	
	switch ($size):
	
		case '1/16':
			$size='one columns';
		break;
		case '2/16':
			$size='two columns';
		break;
		case '3/16':
			$size='three columns';
		break;
		case '4/16':
			$size='four columns';
		break;
		case '5/16':
			$size='five columns';
		break;
		case '6/16':
			$size='six columns';
		break;
		case '7/16':
			$size='seven columns';
		break;
		case '8/16':
			$size='eight columns';
		break;
		case '9/16':
			$size='nine columns';
		break;
		case '10/16':
			$size='ten columns';
		break;
		case '11/16':
			$size='eleven columns';
		break;
		case '12/16':
			$size='twelve columns';
		break;
		case '13/16':
			$size='thirteen columns';
		break;
		case '14/16':
			$size='fourteen columns';
		break;
		case '15/16':
			$size='fifteen columns';
		break;
		case '1/3':
			$size='one-third column';
		break;
		case '2/3':
			$size='two-thirds column';
		break;
		default:
			$size='four columns';
		break;
	endswitch;
	
	$output="";
	
	if($pos=='first') $p=' alpha';
	elseif($pos=='last') $p=' omega';
	else $p='';
	
	$output.='<div class="row '.$size.$p.' ">' . do_shortcode(trim($content)) . '</div>';
	
	if($pos=='last') $output.='<br class="clear">';

	
	
	return $output;
	//return do_shortcode('[raw]'.$output.'[/raw]');
}


add_shortcode('col', 'add_shortcode_column'); 
