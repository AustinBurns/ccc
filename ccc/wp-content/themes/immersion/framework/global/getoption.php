<?php


function get_theme_option($var) {

    $value=get_option(THEME_SLUG.$var);

	if($value) return $value;
	else return false;


}

function get_meta_option($var, $post_id=NULL) {

	if($post_id) return get_post_meta($post_id, $var.'_value', true);
    global $post;
    return get_post_meta($post->ID, $var.'_value', true);

}

function get_image_url($post_id=NULL){
	
	if($post_id) $image_wp = wp_get_attachment_image_src($post_id,'full', true);	
	else $image_wp = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true); 
	return $image_wp[0];
	
}

function resize_image($id, $width, $height){

	return theme_resize( wp_get_attachment_url( $id,'full' ), $width, $height, true );

}



?>
