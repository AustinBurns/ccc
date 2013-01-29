<?php


 
global $options_gallery;

$options_gallery = array();




					
				
$options_gallery[] = array( "name" => "Gallery Images",
						"desc" => "click the upload button to upload images or change image order then click the 'Add Gallery Images' button. You can also add images that are already uploaded bu clicking the 'upload' button and then the 'Add Image to gallery' button from the media library tab",
						"id" => "gallery_items",
						"type" => "gallery_items"); 
					

					


function create_meta_box_gallery() {
	global $theme_name;
	global $options_gallery;
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'gallery', 'Gallery Settings', 'create_meta_options', 'gallery', 'advanced', 'high', array('var1' => $options_gallery) );
	}
}

function mytheme_save_data_gallery($post_id) {
    global $options_gallery;
	global $post;
	
	if(get_post_type( $post )=='gallery'){
    
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
		
		foreach ($options_gallery as $option) {
			$old = get_post_meta($post_id, $option['id']."_value", true);
			$new = $_POST[$option['id']];
			
			if ($new!='' && $new != $old) {
				update_post_meta($post_id, $option['id']."_value", $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $option['id']."_value", $old);
			}
		}
	}
}


add_action('admin_menu', 'create_meta_box_gallery');
add_action('save_post', 'mytheme_save_data_gallery');





?>