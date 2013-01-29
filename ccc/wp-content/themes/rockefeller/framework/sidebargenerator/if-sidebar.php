<?php
if( ! function_exists("if_sidebar_admin")){
	function if_sidebar_admin(){
		$submenu_slug = 'if-themesidebar';
		$shortname = THE_SHORTNAME;
		
		$optionstheme = array();
		
		$optionstheme['sidebar'] = array (
			
			array ( "name" => __("Sidebar Manager",THE_LANG), 
					"type" => "open"),
			
			array(	"name" => __('Sidebar', THE_LANG),
										"type" => "heading",
										"desc" => __('', THE_LANG)),
			
			array( 	"name" => __('Sidebar Generator', THE_LANG),
										"desc" => __('Please enter name of new sidebar', THE_LANG),
										"id" => $shortname."_sidebar",
										"std" => "fade",
										"type" => "textarray"),
			
			array(	"type" 	=> "close"),
		);
	
		if_form_admin($optionstheme['sidebar'], $submenu_slug);
	}
}

if ( ! function_exists( 'if_sidebargen_menu' ) ) {
	function if_sidebargen_menu(){
		
		$submenu_slug = "if-themesidebar";
		$submenu_function = "if_sidebar_admin";
		add_theme_page( __('Sidebar Manager',THE_LANG), __('Sidebar Manager',THE_LANG), 'edit_themes', $submenu_slug, $submenu_function);
		
	}
	add_action('admin_menu', 'if_sidebargen_menu');
}