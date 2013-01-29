<?php

function portfolio_register(){

	$args = array(
		'labels' => array(
			'name' => 'Portfolio Projects',
			'singular_name' => 'Portfolio',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Portfolio Project',
			'edit_item' => 'Edit Portfolio Project',
			'new_item' => 'New Portfolio Project',
			'view_item' => 'View Portfolio Project',
			'search_items' => 'Search Portfolio Projects',
			'not_found' =>  'No portfolios projects found',
			'not_found_in_trash' => 'No portfolio projects found in Trash', 
			'parent_item_colon' => '',
		),
		'singular_label' => 'portfolio',
		'public' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'with_front' => false ),
		'query_var' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments','custom-fields')
	);

	register_post_type( 'portfolio' , $args );

	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => 'Portfolio Categories', 
			'singular_name' => 'Portfolio Category',
			'search_items' =>  'Search Categories', 
			'popular_items' => 'Popular Categories', 
			'all_items' => 'All Categories', 
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => 'Edit Portfolio Category', 
			'update_item' => 'Update Portfolio Category', 
			'add_new_item' => 'Add New Portfolio Category', 
			'new_item_name' => 'New Portfolio Category Name', 
			'separate_items_with_commas' => 'Separate Portfolio category with commas',
			'add_or_remove_items' => 'Add or remove portfolio category',
			'choose_from_most_used' => 'Choose from the most used portfolio category', 
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => false,
	));
}

add_action('init','portfolio_register');

