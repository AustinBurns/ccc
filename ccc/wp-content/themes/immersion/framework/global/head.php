<?php 
function tf_add_scripts() {
	
	if(is_admin()) return false;
			
	wp_enqueue_script('jquery');

		
}
add_action('wp_enqueue_scripts', 'tf_add_scripts');


function tf_print_scripts() {

	if(is_admin()) return false;
	
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('jquery.flexslider-min', THEME_JS . '/jquery.flexslider-min.js', array('jquery'));
	wp_enqueue_script('supersized', THEME_JS . '/supersized.3.2.7.min.js', array('jquery'));
	wp_enqueue_script('supersized.shutter', THEME_JS . '/supersized.shutter.js', array('jquery'));
	wp_enqueue_script('jquery-easing', THEME_JS . '/jquery.easing.1.3.js', array('jquery'));
	wp_enqueue_script('jquery.mobilemenu.js', THEME_JS . '/jquery.mobilemenu.js', array('jquery'));
	wp_enqueue_script('jquery.jplayer.min', THEME_JS . '/jquery.jplayer.min.js', array('jquery'));
	wp_enqueue_script('jquery.scrollTo-1.4.2-min', THEME_JS . '/jquery.scrollTo-1.4.2-min.js', array('jquery'));
	wp_enqueue_script('tabs.js', THEME_JS . '/tabs.js' , array('jquery'));
	wp_enqueue_script('jquery.colorbox-min', THEME_JS . '/jquery.colorbox-min.js' , array('jquery'));
	wp_enqueue_script('jquery.preloader.js', THEME_JS . '/jquery.preloader.js' , array('jquery'));
	wp_enqueue_script('jquery.tipTip.minified', THEME_JS . '/jquery.tipTip.minified.js' , array('jquery'));
	wp_enqueue_script('ios-orientationchange-fix.js', THEME_JS . '/ios-orientationchange-fix.js' );
	wp_enqueue_script('selectivizr-min.js', THEME_JS . '/selectivizr-min.js' );
	wp_enqueue_script('superfish.js', THEME_JS . '/superfish.js' , array('jquery'));
	wp_enqueue_script('css3-mediaqueries.js', THEME_JS . '/css3-mediaqueries.js');
	wp_enqueue_script('jquery.touchwipe.min.js', THEME_JS . '/jquery.touchwipe.min.js', array('jquery'));
	

	global $add_googlemap_script;
	if ( $add_googlemap_script ) 	{
		wp_enqueue_script('gmap.api', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'));
		wp_enqueue_script('jquery.gmap.min', THEME_JS . '/jquery.gmap.min.js', array('jquery'));
	}

	global $add_tweet_script;
	if ( $add_tweet_script ) wp_enqueue_script('jquery.tweet.js', THEME_JS . '/jquery.tweet.js' , array('jquery'));
	
	global $add_contact_script;
	if ( $add_contact_script ) wp_enqueue_script('jquery-validate', THEME_JS . '/jquery.validate.min.js', array('jquery'));
	
	if(is_single())  wp_enqueue_script('comment-reply', array('jquery'));
	wp_enqueue_script('custom', THEME_JS . '/custom.js', array('jquery'));
	
	
}
add_action('wp_footer', 'tf_print_scripts');


function tf_add_styles(){

	if(is_admin()) return false;
			
	wp_enqueue_style('base', THEME_CSS.'/base.css');
	wp_enqueue_style('skeleton', THEME_CSS . '/skeleton.css' );
	wp_enqueue_style('layout', THEME_CSS . '/layout.css' );
	wp_enqueue_style('colorbox', THEME_CSS . '/colorbox.css' );
	
	
}
add_action('wp_print_styles', 'tf_add_styles');






?>
