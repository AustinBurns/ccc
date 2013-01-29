<?php
function if_post_type_testimonial() {
	register_post_type( 'testimonialpost',
                array( 
				'label' => __('Testimonials', THE_LANG ), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => true,
				'menu_position' => 5,
				'exclude_from_search' =>true,
				'supports' => array(
				                     'title',
									 'editor',
                                     'revisions',
									 'custom-fields',
									 'comments')
					) 
				);
				
	register_taxonomy('testimonialcat', __('testimonialpost', THE_LANG ),array('hierarchical' => true, 'label' =>  __('Testimonial Categories', THE_LANG ), 'singular_name' => __('Category', THE_LANG ))
	);
}
add_action('init', 'if_post_type_testimonial');