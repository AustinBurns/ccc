<?php

add_action( 'after_setup_theme', 'if_setup' );

if ( ! function_exists( 'if_setup' ) ):

function if_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-post-image', 600, 242, true ); // Blog Image
		add_image_size( 'post-thumb', 60, 60, true ); // Recent Post Widget Image
		add_image_size( 'portfolio-image-col1', 1140, 600, true ); // Portfolio Image Col 1
		add_image_size( 'portfolio-image-col2', 547, 340, true ); // Portfolio Image Col 2
		add_image_size( 'portfolio-image-col3', 349, 260, true ); // Portfolio Image Col 3
		add_image_size( 'portfolio-image-col4', 251, 191, true ); // Portfolio Image Col 4
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => __( 'Main Menu', THE_LANG )
	) );
	register_nav_menus( array(
		'footermenu' => __( 'Footer Menu', THE_LANG )
	) );
}
endif;

function exceptation(){
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
}

/* Slider */
function if_post_type_slider() {
	register_post_type( 'slider-view',
                array( 
				'label' => __('Slider', THE_LANG), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'rewrite' => true,
				'hierarchical' => true,
				'menu_position' => 5,
				'exclude_from_search' =>true,
				'supports' => array(
								 'title',
								 'editor',
								 'thumbnail',
								 'custom-fields'
							)
					) 
				);
				register_taxonomy('slidercat', __('slider-view', THE_LANG ),array('hierarchical' => true, 'label' =>  __('Slider Categories', THE_LANG), 'singular_name' => __('Category', THE_LANG))
	);
}

add_action('init', 'if_post_type_slider');