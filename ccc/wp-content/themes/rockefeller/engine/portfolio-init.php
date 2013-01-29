<?php
function if_post_type_portfolio() {
	register_post_type( 'portofolio',
                array( 
				'label' => __('Portfolio', THE_LANG ), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => true,
				'menu_position' => 5,
				'has_archive' => true,
				'exclude_from_search' =>true,
				'supports' => array(
				                     'title',
									 'editor',
                                     'thumbnail',
                                     'excerpt',
                                     'revisions',
									 'custom-fields',
									 'comments',
									 'page-attributes')
					) 
				);
	
	$taxonomyargs = array(
		'query_var' => true,
		'hierarchical' => true, 
		'label' =>  __('Portfolio Categories', THE_LANG ), 
		'singular_name' => __('Category', THE_LANG )
	);
	register_taxonomy('portfoliocat', 'portofolio', $taxonomyargs );
}

add_action('init', 'if_post_type_portfolio');