<?php

function new_excerpt_more($more) {

	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


function mysite_body_class( $classes ) {
		
	
	if(get_meta_option('show_bg')=='off') $classes[]="no-slideshow";
	
	if(is_search()) $classes[]="no-slideshow";
	
	if(get_meta_option('hide_page')=='on' && get_meta_option('show_bg')=='on') $classes[]="page-hidden";
	
	return $classes;
}

add_filter( 'body_class', 'mysite_body_class', 10 );


function mysite_post_class( $classes ) {
	
	if(get_post_type()=='portfolio') {
	
		$terms = get_the_terms( get_the_id(), 'portfolio_category' );
		if($terms) foreach ($terms as $term) $classes[] ="cat-".$term->term_id;
		
	
	}
	
	return $classes;
	
}

add_filter( 'post_class', 'mysite_post_class', 10 );


function my_image_sizes($sizes) {

        $newsizes = array_merge($sizes, $addsizes);
        return $newsizes;
}
//add_filter('image_size_names_choose', 'my_image_sizes');


    


?>