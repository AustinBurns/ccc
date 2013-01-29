<?php

function add_admin_scripts() {


	wp_enqueue_script('jquery');
	
	wp_enqueue_style( 'admin-style', THEME_ADMIN_CSS.'/admin-style.css');
	
	//echo '<pre>' . print_r(get_current_screen()->id, true) . '</pre>';  

	if( get_current_screen()->id=='post' || get_current_screen()->id=='page' || get_current_screen()->id=='portfolio' ){

		wp_enqueue_script('global', THEME_ADMIN_JS.'/global.js', array('jquery'));
		wp_enqueue_script('metabox', THEME_ADMIN_JS.'/metabox.js', array('jquery'));
		wp_enqueue_script('shortcodes', THEME_ADMIN_JS.'/shortcodes.js', array('jquery'));
		wp_enqueue_script('cc', THEME_ADMIN_JS.'/cc.js', array('jquery'));
		wp_enqueue_script('farbtastic', array('jquery'));
		wp_enqueue_script('jquery-ui-sortable', array('jquery'));
		wp_enqueue_script('jqueryrange',THEME_ADMIN_JS.'/jquery.tools.min.js', array('jquery'));
		wp_enqueue_script('jquery.ibutton.min.js', THEME_ADMIN_JS.'/jquery.ibutton.min.js', array('jquery'));
		
		wp_enqueue_style( 'cc.css', THEME_ADMIN_CSS.'/cc.css');
		wp_enqueue_style( 'farbtastic-css', THEME_ADMIN_CSS.'/farbtastic.css');
		wp_enqueue_style( 'jquery.ibutton.css', THEME_ADMIN_CSS.'/jquery.ibutton.css');

	}
	
	if( get_current_screen()->id=='gallery'){
	
		wp_enqueue_script('gallery', THEME_ADMIN_JS.'/gallery.js', array('jquery'));
		wp_enqueue_script('jquery-ui-sortable', array('jquery'));
		

	
	}
	
	if( get_current_screen()->id=='toplevel_page_optionsframework'){

		//wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('global', THEME_ADMIN_JS.'/global.js', array('jquery'));
		wp_enqueue_script('ajaxupload', THEME_ADMIN_JS.'/ajaxupload.js', array('jquery'));
		wp_enqueue_script('admin_js', THEME_ADMIN_JS.'/admin.js', array('jquery'));
		wp_enqueue_script('farbtastic', array('jquery'));
		wp_enqueue_script('jqueryrange',THEME_ADMIN_JS.'/jquery.tools.min.js', array('jquery'));
		wp_enqueue_script('jquery.ibutton.min.js', THEME_ADMIN_JS.'/jquery.ibutton.min.js', array('jquery'));
		
		
		wp_enqueue_style( 'farbtastic-css', THEME_ADMIN_CSS.'/farbtastic.css');
		wp_enqueue_style( 'jquery.ibutton.css', THEME_ADMIN_CSS.'/jquery.ibutton.css');
		

	}
		
}

add_action('admin_enqueue_scripts', 'add_admin_scripts');

?>