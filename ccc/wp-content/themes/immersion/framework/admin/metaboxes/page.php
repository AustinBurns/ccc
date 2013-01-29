<?php

global $options_page;

$options_page = array();


						
$options_page[] = array( "name" => "Display Page title",
						"class" => "",
						"id" => "display_title",
						"std" => "on",
						"type" => "toggle"); 

$options_page[] = array( "name" => "Display Footer",
						"class" => "",
						"id" => "display_footer",
						"std" => "on",
						"type" => "toggle"); 							


$options_page[] = array( "name" => "Page Type",
					"id" => "theme_page_type",
					"class" => "theme_page_type_i",
					"std" => "normal page",
					"options" => array("normal page","blog page"),
					"type" => "select"); 
					
$options_page[] = array( "name" => "Post categories",
					"id" => "post_categories",
					"class" => "theme_page_type theme_page_type_2",
					"type" => "multiselect_post_categories"); 
					
								
$options_page[] = array( "name" => "Items per page",
						"class" => "theme_page_type theme_page_type_2 theme_page_type_3",
                        "desc" => "the number of items per page",
						"id" => "items_per_page",
						"std" => "10",
						"min" => "1",
						"max" => "100",
						"step" => "1",
						"unit" => 'items',
						"type" => "range"); 
											
$options_page[] = array( "name" => "Custom sidebar",
					"id" => "custom_sidebar",
					"class" => "display_sidebar display_sidebar_1 theme_page_type theme_page_type_1",
					"type" => "select_sidebar"); 
					
$options_page[] = array( "name" => "Footer select",
					"id" => "custom_footer",
					"class" => "theme_page_type theme_page_type_1",
					"type" => "select_footer"); 
					
$options_page[] = array( "name" => "Display fullscreen slideshow",
						"class" => "",
						"desc" => "select 'off' if you don't want a fullscreen slideshow on this page",
						"id" => "show_bg",
						"type" => "toggle"); 
					
$options_page[] = array( "name" => "Select the gallery that will be displayed as a fullscreen slideshow on this page",
						"class" => "",
                        "desc" => "select another image gallery to be displayed on this page instead of the default",
						"id" => "back_slideshow",
						"type" => "select_slideshow");

$options_page[] = array( "name" => "Show captions",
						"class" => "",
						"desc" => "select 'off' if you don't want captions on the fullscreen slideshow",
						"id" => "show_captions",
						"type" => "toggle"); 

$options_page[] = array( "name" => "Display the 'read more' link after the caption",
						"class" => "",
						"desc" => "when clicked this link will display the rest of the page.",
						"id" => "show_read_more",
						"type" => "toggle"); 
						
$options_page[] = array( "name" => "Initially hide the page content until the user click the 'read more' link",
						"class" => "",
						"id" => "hide_page",
						"std" => 'off',
						"type" => "toggle"); 

				

function create_meta_box_page() {
	global $theme_name;
	global $options_page;
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'aps', 'Page Settings', 'create_meta_options', 'page', 'advanced', 'high', array('var1' => $options_page) );
	}
}





function mytheme_save_data_page($post_id) {
    global $options_page;
	global $post;
	
	if(get_post_type( $post )!='page') return $post_id;
    
	
	
		// verify nonce
		if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], 'global_functions.php')) {
			return $post_id;
		}
	
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
	
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		
		foreach ($options_page as $option) {
			$old = get_post_meta($post_id, $option['id']."_value", true);
			$new = $_POST[$option['id']];
			
			if ($new !='' && $new != $old) {
				update_post_meta($post_id, $option['id']."_value", $new);
			} 
			
			if($new == '' && $option['type']=='toggle') 
				update_post_meta($post_id, $option['id']."_value", 'off'); 
			
		}
	
}



add_action('admin_menu', 'create_meta_box_page');
add_action('save_post', 'mytheme_save_data_page');






?>