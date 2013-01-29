<?php
function add_shortcode_portfolio_list($atts) {

	extract(shortcode_atts(array(
		'cats' => ''
	), $atts));
	$output='';
	
	if($cats!='') $cats=explode(',',$cats);
	
	
	$output.="<ul class='portfolio-categories clearfix'>";
				
		$output.="<li><a class='current' data-cat='all'>All</a></li>";
		
		foreach($cats as $cat):
		
			$cat=get_term_by( 'id', $cat, 'portfolio_category');
		
			$output.="<li><a data-cat='".$cat->term_id."'>".$cat->name."</a></li>";
		
		endforeach;
								
	$output.="</ul>";
		
	$output.="<ul class='clearfix portfolio-list'>";
				
	$args=array("post_type" => "portfolio", "posts_per_page" => -1,"tax_query" => array(array("taxonomy" => "portfolio_category","field" => "id","terms" => $cats)));
	query_posts($args);			
	while ( have_posts() ) : the_post();
					
		$output.="<li class='".implode(get_post_class(),' ')."' data-id='".get_the_id()."'>";
		
			$output.="<a href='".get_permalink()."'>";
					
				$output.="<figure>";
									

					$output.="<img class='scale-with-grid preload' src='".resize_image( get_post_thumbnail_id() ,300, 280 )."'/>";					
					
					$output.="<figcaption>";
								
						$output.="<h5 class='portfolio-title'>".get_the_title()."</h5>";
						$output.="<div class='portfolio-excerpt'>".tf_the_excerpt_max_charlength(150)."</div>";
								
					$output.="</figcaption>";
							
				$output.="</figure>";
			
			$output.="</a>";
						
			$output.="<span></span>";
						
		$output.="</li>";
	
					
	endwhile;   
	wp_reset_query(); 
	wp_reset_postdata(); 
		
	$output.="</ul>";
				
				

	

	return $output;
	
}

add_shortcode('portfolio', 'add_shortcode_portfolio_list');
?>
