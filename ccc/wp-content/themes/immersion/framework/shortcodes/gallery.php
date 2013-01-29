<?php

function add_shortcode_gallery($atts) {

	extract(shortcode_atts(array(
		'id' => ''
	), $atts));
	$output='';
	
	$id=explode(',',$id);
	$atts_array=array();

	foreach($id as $g):

		$atts= get_meta_option('gallery_items', $g);
		$atts=explode(',',$atts);
		$atts_array=array_merge($atts_array , $atts);

	endforeach;

	$output.="<ul class='gallery-list row'>";
		
	$args= array("posts_per_page" => -1,"post_status" => "any","post_type" => "attachment","post__in" => $atts_array);
	query_posts($args);
	while ( have_posts() ) : the_post(); 
				
		$output.="<li class='gallery-item'>";
						
			$image_wp=wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$output.="<a class='lightbox' href='".$image_wp[0]."' title='".get_the_title()."'>";
		
				$output.="<figure>";					
					$output.="<img class='scale-with-grid preload' src='".resize_image( get_post_thumbnail_id() ,123, 123 )."'/>";	
					$output.="<figcaption></figcaption>";
				$output.="</figure>";
						
			$output.="</a>";
	
		$output.="</li>";
				
	endwhile;
	wp_reset_query();  
	wp_reset_postdata(); 
				
		
	$output.="</ul>";

	
	return $output;

	
	
	
}
add_shortcode('gallery', 'add_shortcode_gallery');

