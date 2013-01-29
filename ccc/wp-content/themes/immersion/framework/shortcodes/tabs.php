<?php


function add_shortcode_tabgroup( $atts, $content ){

	$GLOBALS['tab_count'] = 0;
	$active=' class="active"';

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $tab ){
		
			$tabs[] = '<li><a '.$active.' href="#'.str_replace(' ','',$tab['title']).'">'.$tab['title'].'</a></li>';
			$panes[] = '<li '.$active.' id="'.str_replace(' ','',$tab['title']).'">'.$tab['content'].'</li>';
			
			$active='';
		}
		$output = '<ul class="tabs clearfix">'.implode( "\n", $tabs ).'</ul><ul class="tabs-content">'.do_shortcode(implode( "\n", $panes )).'</ul>';
		
	}
	
	
		
	return $output;
	//return do_shortcode('[raw]'.$output.'[/raw]');
	

	
}

add_shortcode( 'tabgroup', 'add_shortcode_tabgroup' );


function add_shortcode_tab( $atts, $content ){

	extract(shortcode_atts(array(
	'title' => 'Tab %d'
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

	$GLOBALS['tab_count']++;
	
}

add_shortcode( 'tab', 'add_shortcode_tab' );

?>
