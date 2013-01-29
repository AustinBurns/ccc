<?php

function add_shortcode_pricing_plan($atts, $content) {

	extract(shortcode_atts(array(
		'featured' => '',
		'name' => 'Free Edition',
		'price' => '100 $',
		'per'=> 'month',
		'description'=> '',
		'link'=> '',
		'linkname'=> 'Sign Up',
		'color'=> '#444'
	), $atts));
	$output='';
	
	if($featured=='true') $featured="featured";
	else  $featured="";
	
	$output.='<li class="'.$featured.'">';
						
		$output.='<div class="plan_header" style="background-color:'.$color.'">';
		
			$output.='<h3>'.$name.'</h3>';
			$output.='<div class="plan_price">'.$price.' <span>/ '.$per.'</span></div>';
			if($description!='') $output.='<h4>'.$description.'</h4>';
			
		$output.='</div>';
		$output.='<ul class="features clearfix">';

			$output.=$content;
		
		$output.='</ul>';
		$output.='<div class="plan_footer">';
			$output.='<a class="button white" href="'.$link.'">'.$linkname.'</a>';
		$output.='</div>';
		
	$output.='</li>';
	
				

	return $output;
	
}

add_shortcode('plan', 'add_shortcode_pricing_plan');


function add_shortcode_pricing_table($atts, $content) {

	extract(shortcode_atts(array(
		'cols' => '4'
	), $atts));
	$output='';
	
	
	$output.='<ul class="pricing_table col'.$cols.' clearfix">';	

	$output.=do_shortcode($content);
	
	$output.='</ul>';

	return $output;
	
}

add_shortcode('pricing-table', 'add_shortcode_pricing_table');
?>
