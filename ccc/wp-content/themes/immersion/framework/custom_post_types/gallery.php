<?php

function gallery_register(){
	
	$args = array(
		'labels' => array(
			'name' => 'Galleries', 
			'singular_name' => 'Gallery',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Gallery',
			'edit_item' => 'Edit Gallery',
			'new_item' => 'New Gallery',
			'view_item' => 'View Gallery', 
			'search_items' => 'Search Gallery', 
			'not_found' =>  'No gallery found', 
			'not_found_in_trash' => 'No gallery found in Trash', 
			'parent_item_colon' => ''
		),
		'singular_label' => 'gallery',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'query_var' => false,
		'supports' => array('title', 'thumbnail')
	);
		
	register_post_type( 'gallery' , $args );
		
	
}
add_action('init', 'gallery_register');




?>