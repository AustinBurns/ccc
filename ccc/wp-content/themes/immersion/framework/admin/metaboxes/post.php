<?php

global $options_post;

$options_post = array();

$options_post[] = array( "name" => "Display Page title",
						"class" => "",
						"id" => "display_title",
						"std" => "on",
						"type" => "toggle"); 

$options_post[] = array( "name" => "Display Footer",
						"class" => "",
						"id" => "display_footer",
						"std" => "on",
						"type" => "toggle"); 	

$options_post[] = array( "name" => "Select gallery",
						"class" => "pf pf_gallery",
                        "desc" => "the gallery that will be used for this post format",
						"id" => "pf_gallery",
						"type" => "select_slideshow");

$options_post[] = array( "name" => "Slideshow height",
						"class" => "pf pf_gallery",
						"id" => "pf_gallery_height",
						"std" => "300",
						"min" => "100",
						"max" => "800",
						"step" => "10",
						"type" => "range"); 							

$options_post[] = array( "name" => "Gallery Type",
						"class" => "pf pf_gallery",
                        "options" => array("slideshow","stacked"),
						"id" => "pf_gallery_type",
						"type" => "select_letters"); 							
						

$options_post[] = array( "name" => "Quote text",
						"class" => "pf pf_quote",
                        "desc" => "type here the quotes text",
						"id" => "quotes_text",
						"type" => "textarea"); 	
						
						
$options_post[] = array( "name" => "Mp3 source url",
						"class" => "pf pf_audio",
                        "desc" => "type the url of the mp3 file or click browse",
						"id" => "pf_mp3_source",
						"type" => "upload"); 
						
$options_post[] = array( "name" => "Ogg source url",
						"class" => "pf pf_audio",
                        "desc" => "type the url of the ogg file or click browse",
						"id" => "pf_ogg_source",
						"type" => "upload");
						
					
$options_post[] = array( "name" => "Video Type",
						"class" => "pf pf_video",
                        "desc" => "select the type of the video",
						"id" => "pf_video_type",
						"options" => array("vimeo","youtube","html5"),
						"type" => "select"); 

	
$options_post[] = array( "name" => "Video ID",
						"class" => "pf pf_video",
						"desc" => "for youtube or vimeo videos",
						"id" => "pf_video_id",
						"type" => "text"); 		
	
$options_post[] = array( "name" => "M4v source url",
						"class" => "pf pf_video",
                        "desc" => "type the url of the mpv file or click browse",
						"id" => "pf_m4v_source",
						"type" => "text"); 
						
$options_post[] = array( "name" => "Webm source url",
						"class" => "pf pf_video",
                        "desc" => "type the url of the webm file or click browse",
						"id" => "pf_webm_source",
						"type" => "text"); 
						
$options_post[] = array( "name" => "Ogv source url",
						"class" => "pf pf_video",
                        "desc" => "type the url of the ogv file or click browse",
						"id" => "pf_ogv_source",
						"type" => "text"); 
						
	
					
						
$options_post[] = array( "name" => "Custom sidebar",
					"id" => "custom_sidebar",
					"class" => "display_sidebar display_sidebar_1",
					"type" => "select_sidebar"); 
					
$options_post[] = array( "name" => "Footer select",
					"id" => "custom_footer",
					"type" => "select_footer"); 
					

$options_post[] = array( "name" => "Display fullscreen slideshow",
						"class" => "",
						"desc" => "select 'off' if you don't want a fullscreen slideshow on this page",
						"id" => "show_bg",
						"type" => "toggle"); 
					
$options_post[] = array( "name" => "Select the gallery that will be displayed as a fullscreen slideshow on this page",
						"class" => "",
                        "desc" => "select another image gallery to be displayed on this page instead of the default",
						"id" => "back_slideshow",
						"type" => "select_slideshow");

$options_post[] = array( "name" => "Show captions",
						"class" => "",
						"desc" => "select 'off' if you don't want captions on the fullscreen slideshow",
						"id" => "show_captions",
						"type" => "toggle"); 

$options_post[] = array( "name" => "Display the 'read more' link after the caption",
						"class" => "",
						"desc" => "when clicked this link will display the rest of the page.",
						"id" => "show_read_more",
						"type" => "toggle"); 
						
$options_post[] = array( "name" => "Initially hide the page content until the user click the 'read more' link",
						"class" => "",
						"id" => "hide_page",
						"std" => 'off',
						"type" => "toggle"); 

					


function create_meta_box_post() {
	global $theme_name;
	global $options_post;
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'aps', 'Post Settings', 'create_meta_options', 'post', 'advanced', 'high', array('var1' => $options_post) );
	}
}

function mytheme_save_data_post($post_id) {
    global $options_post;
	global $post;
	
	if(get_post_type( $post )!='post') return $post_id;
    
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
		
		foreach ($options_post as $option) {
		
		
			$old = get_post_meta($post_id, $option['id']."_value", true);
			$new = $_POST[$option['id']];
			
			if ($new != '' && $new != $old) {
				update_post_meta($post_id, $option['id']."_value", $new);
			} 
			
			if($new == '' && $option['type']=='toggle') 
				update_post_meta($post_id, $option['id']."_value", 'off'); 
			
			
		}
	
}


add_action('admin_menu', 'create_meta_box_post');
add_action('save_post', 'mytheme_save_data_post');





?>