<?php
function add_shortcode_blog($atts) {

	extract(shortcode_atts(array(
		'cats' => '',
	), $atts));
	$output='';
	
	$i=1;
	


	$output.="<div class='blog-posts clearfix'>";
	
	$args= array("post_type" => "post","posts_per_page" => 4, "cat" => $cats);
	query_posts($args);
	while ( have_posts() ) : the_post();
	
		if($i==1) $pos='alpha';
		elseif($i==4) $pos='omega';
		else $pos='';
		$i++;
		
		$output.="<div class='four columns row ".$pos."'>";
	
			$output.="<a href='".get_permalink()."'>";
				$output.="<figure>";			
					
					$output.="<img class='scale-with-grid preload' src='".resize_image( get_post_thumbnail_id() ,420, 340 )."'/>";
					
					$output.="<figcaption></figcaption>";	
				$output.="</figure>";	
			$output.="</a>";	
			$output.="<h5>".get_the_title()."</h5>";
			$output.="<div class='post-meta'>".get_the_date('d M')." - ".get_comments_number()." ".__('comments',THEME_SLUG)."</div>";
			$output.="<p class='post-excerpt'>".tf_the_excerpt_max_charlength(150)."</p>";		
			$output.="<p><a class='more' href='".get_permalink()."'>".__('Continue Reading',THEME_SLUG)."</a></p>";	
		
		$output.="</div>";
	
	
	endwhile; 
	wp_reset_query();  
	wp_reset_postdata(); 
	
	$output.="<br class='clear'>";
	
	$output.="</div>";
	

	return $output;
	
}

add_shortcode('blog-posts', 'add_shortcode_blog');
?>
