<?php
function if_sidebar_init() {
	register_sidebar( array(
		'name' 					=> __( 'Sidebar', THE_LANG ),
		'id' 						=> THE_SHORTNAME . '-sidebar',
		'description' 		=> __( 'Located at the left/right side of all pages and post.', THE_LANG ),
		'before_widget' 	=> '<ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 		=> '</li></ul>',
		'before_title' 		=> '<h2 class="widget-title"><span>',
		'after_title' 			=> '</span></h2>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer1 Sidebar', THE_LANG ),
		'id'         	=> 'footer1',
		'description'   => __( 'Located at the footer column 1.', THE_LANG ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div>',
		'before_title' 	=> '<h4 class="widget-title"><span>',
		'after_title' 	=> '</span></h4>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer2 Sidebar', THE_LANG ),
		'id'         	=> 'footer2',
		'description'   => __( 'Located at the footer column 2.', THE_LANG ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div>',
		'before_title' 	=> '<h4 class="widget-title"><span>',
		'after_title' 	=> '</span></h4>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer3 Sidebar', THE_LANG ),
		'id'         	=> 'footer3',
		'description'   => __( 'Located at the footer column 3.', THE_LANG ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div>',
		'before_title' 	=> '<h4 class="widget-title"><span>',
		'after_title' 	=> '</span></h4>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer4 Sidebar', THE_LANG ),
		'id'         	=> 'footer4',
		'description'   => __( 'Located at the footer column 4.', THE_LANG ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div>',
		'before_title' 	=> '<h4 class="widget-title"><span>',
		'after_title' 	=> '</span></h4>',
	));
	
	//Register dynamic sidebar
	$textarrayval = get_option( THE_SHORTNAME . '_sidebar');
	if(is_array($textarrayval)){
		
		foreach($textarrayval as $ids => $val){
			if ( function_exists('register_sidebar') )
			register_sidebar(array(
				'name'          		=> $val,
				'id'					=> $ids,
				'description'   		=> __( 'A Custom sidebar created from Sidebar Manager. It\'s called', THE_LANG )." ".$ids,
				'before_widget' 	=> '<ul><li id="%1$s" class="widget-container %2$s">',
				'after_widget' 		=> '</li></ul>',
				'before_title' 		=> '<h2 class="widget-title"><span>',
				'after_title' 			=> '</span></h2>'
			));
		}
		
	}
				
}
/** Register sidebars by running if_sidebar_init() on the widgets_init hook. */
add_action( 'widgets_init', 'if_sidebar_init' );