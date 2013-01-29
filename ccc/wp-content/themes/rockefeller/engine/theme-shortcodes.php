<?php
/******PORTFOLIO CAROUSEL******/
if(!function_exists('if_portfoliocarousel')){
	function if_portfoliocarousel($atts, $content = null) {
		extract(shortcode_atts(array(
					"title" => '',
					"cat" => '',
					"showposts" => '-1'
		), $atts));
			
			if($content){
				$content = if_content_formatter($content);
			}
			$output  ='<div class="pcarousel">';
			if($title!=""){
			$output  .='<div class="titlecontainer"><h2 class="contenttitle"><span>'.$title.'</span></h2></div>';
			}
			if($content){
				$output .='<div class="pc-content">'.$content.'</div><div class="clearfix"></div>';
			}
	
			$i=1;
			$argquery = array(
				'post_type' => 'portofolio',
				'showposts' => $showposts
			);
			if($cat){
				$argquery['tax_query'] = array(
					array(
						'taxonomy' => 'portfoliocat',
						'field' => 'slug',
						'terms' => $cat
					)
				);
			}
			query_posts($argquery);
			global $post;
			
			$output  .='<div class="flexslider-carousel">';
				$output  .='<ul class="slides">';
				
				$havepost = false;
				while (have_posts()) : the_post();
				$havepost = true;
				$excerpt = get_the_excerpt(); 
				$custom = get_post_custom( get_the_ID() );
				$cthumb = (isset($custom["carousel_thumb"][0]))? $custom["carousel_thumb"][0] : "";
				$cf_externallink = (isset($custom["external_link"][0]))? $custom["external_link"][0] : "";
				if(isset($custom["lightbox_img"])){
					$checklightbox = $custom["lightbox_img"] ; 
					$cf_lightbox = array();
					for($i=0;$i<count($checklightbox);$i++){
						if($checklightbox[$i]){
							$cf_lightbox[] = $checklightbox[$i];
						}
					}
					if(!count($cf_lightbox)){
						$cf_lightbox = "";
					}
				}else{
					$cf_lightbox = "";
				}
				
				/*get recent-portfolio-post-thumbnail*/
				$qrychildren = array(
					'post_parent' => get_the_ID(),
					'post_status' => null,
					'post_type' => 'attachment',
					'order_by' => 'menu_order',
					'order' => 'ASC',
					'post_mime_type' => 'image'
				);

				$attachments = get_children( $qrychildren );
				
				$cf_thumb2 = array();
				$cf_full2 = "";
				$z = 1;
				foreach ( $attachments as $att_id => $attachment ) {
					$getimage = wp_get_attachment_image_src($att_id, 'portfolio-image-col4', true);
					$portfolioimage = $getimage[0];
					$alttext = get_post_meta( $attachment->ID , '_wp_attachment_image_alt', true);
					$image_title = $attachment->post_title;
					$caption = $attachment->post_excerpt;
					$description = $attachment->post_content;
					$cf_thumb2[] ='<img src="'.$portfolioimage.'" alt="'.$alttext.'" title="'. $image_title .'" class="scale-with-grid" />';
					
					$getfullimage = wp_get_attachment_image_src($att_id, 'full', true);
					$fullimage = $getfullimage[0];
					
					if($z==1){
						$fullimageurl = $fullimage;
						$fullimagetitle = $image_title;
						$fullimagealt = $alttext;
					}elseif($att_id == get_post_thumbnail_id( get_the_ID() ) ){
						$fullimageurl = $fullimage;
						$fullimagetitle = $image_title;
						$fullimagealt = $alttext;
					}else{
						$cf_full2 .='<a data-rel=prettyPhoto['.$post->post_name.'] href="'.$fullimage.'" title="'. $image_title .'" class="hidden"></a>';
					}
					$z++;
				}
				
				$thumbid = get_post_thumbnail_id( get_the_ID() );
				$alttext = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
				$imagesrc = wp_get_attachment_image_src( $thumbid, 'portfolio-image-col4' );
				
				if($cthumb!=""){
					$imagethumb = $cthumb;
					$alttext = get_the_title( get_the_ID() );
				}else{
					if($imagesrc!=false){
						$imagethumb = $imagesrc[0];
					}else{
						$imagethumb = get_template_directory_uri().'/images/noimage.png';
						$alttext = get_the_title( get_the_ID() );
					}
				}
				
				$bigimageurl = '';
				if( is_array($cf_lightbox) ){
					$bigimageurl = $cf_lightbox[0];
					$bigimagetitle = get_the_title();
					$rel = " data-rel=prettyPhoto[".$post->post_name."]";
					$cf_lightboxoutput = '';
					for($i=1;$i<count($cf_lightbox);$i++){
						$cf_lightboxoutput .='<a data-rel=prettyPhoto['.$post->post_name.'] href="'.$cf_lightbox[$i].'" title="'. get_the_title(get_the_ID()) .'" class="hidden"></a>';
					}
					$cf_full2 = $cf_lightboxoutput;
				}else{
					if( isset($fullimageurl)){
						$bigimageurl = $fullimageurl; 
						$bigimagetitle = $fullimagetitle;
						$rel = " data-rel=prettyPhoto[".$post->post_name."]";
					}
				}
				
				$output  .='<li class="threecol">';
					$output .= '<div class="cr-item-container">';
						$output  .='<div class="if-pf-img">';
							$output .='<div class="rollover"></div>';
							if($bigimageurl!=''){
								$output .='<a class="image zoom" href="'.$bigimageurl.'" '.$rel.' title="'.$bigimagetitle.'"></a>';
							}
						$output  .='<a class="image gotolink" href="'.get_permalink().'" title="'.get_the_title().'"></a>';
						$output  .='<img src="'.$imagethumb.'" alt="'.$alttext.'" />';
						$output  .=$cf_full2;
						$output  .='</div>';
						$output  .='<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
						$excerpt = if_string_limit_char( get_the_excerpt(),30 );
						$output  .='<div class="if-pf-text">'.$excerpt.'</div>';
					$output .= '</div>';
				$output  .='</li>';
				
				 $i++; $addclass=""; endwhile; wp_reset_query();
				 
				 $output .='</ul>';
			 $output .='</div>';
			 $output .='</div>';
			 if($havepost){
			 	return do_shortcode($output);
			}else{
				return false;
			}
	}
	
	add_shortcode( 'portfolio_carousel', 'if_portfoliocarousel' );
}

/******BIGTEXT******/
if(!function_exists('if_bigtext')){
	function if_bigtext($atts, $content = null) {
		extract(shortcode_atts(array(
		), $atts));
		$output = '<h2 class="bigtext"><span>'.$content.'</span></h2>';
		return do_shortcode($output);
	}
	add_shortcode( 'bigtext', 'if_bigtext' );
}
/******SECONDARYTEXT******/
if(!function_exists('if_secondarytext')){
	function if_secondarytext($atts, $content = null) {
		extract(shortcode_atts(array(
		), $atts));
		$output = '<span class="secondarytext">'.$content.'</span>';
		return do_shortcode($output);
	}
	add_shortcode( 'secondarytext', 'if_secondarytext' );
}

/******HEADING******/
if(!function_exists('if_heading')){
	function if_heading($atts, $content = null) {
		extract(shortcode_atts(array(
			'level' => '3'
		), $atts));
		
		$arrH = array('1','2','3','4','5','6');
		if(!in_array($level,$arrH)){
			$level = 3;
		}
		$output = '<div class="if-heading"><h'.$level.'><span>'.$content.'</span></h'.$level.'></div>';
		return do_shortcode($output);
	}
	add_shortcode( 'heading', 'if_heading' );
}

/******SLIDER******/
if(!function_exists('if_sliders')){
	function if_sliders($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' => '',
			'title' => '',
		), $atts));
		if($id!=""){
			$ids = 'id="'.$id.'" ';
		}else{
			$ids = '';
		}
		$output  = '<div '.$ids.' class="minisliders flexslider">';
		
		if($title!=""){
			$output  .='<div class="titlecontainer"><h2 class="contenttitle"><span>'.$title.'</span></h2></div>';
		}
		
		$output	.= '<ul class="slides">';
		$output	.= $content;
		$output	.= '</ul>';
		$output	.= '<div class="clearfix"></div>';
		$output .= '</div>';
		return do_shortcode($output);
	}
	add_shortcode( 'sliders', 'if_sliders' );
}
if(!function_exists('if_slide')){
	function if_slide($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' 	=> '',
			'class'	=> ''
		), $atts));
		if($id!=""){
			$ids = 'id="'.$id.'" ';
		}else{
			$ids = '';
		}
		$classes = 'class="slide '.$class.'" ';
		
		$output  = '<li '.$ids.$classes.'>';
		$output	.= $content;
		$output	.= '</li>';
		return do_shortcode($output);
	}
	add_shortcode( 'slide', 'if_slide' );
}

if(!function_exists('if_testimonial')){
	function if_testimonial($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' 	=> '',
			'class'	=> '',
			'col' => '1',
			'cat' => '',
			'showposts' => 5,
			'showtitle' => 'yes',
			'showinfo' => 'yes',
			'showthumb' => 'yes'
		), $atts));
		
		$catname = get_term_by('slug', $cat, 'testimonialcat');
		$showtitle = ($showtitle=='yes')? true : false;
		$showinfo = ($showinfo=='yes')? true : false;
		$showthumb = ($showthumb=='yes')? true : false;
		$showposts = (is_numeric($showposts))? $showposts : 5;
		
		if($col!='1' && $col!='2' && $col!='3'){
			$col = '1';
		}
		
		if($col=='3'){
			$col = 3;
		}elseif($col=='2'){
			$col = 2;
		}else{
			$col = 1;
		}
		
		$qryargs = array(
			'post_type' => 'testimonialpost',
			'showposts' => $showposts
		);
		if($catname!=false){
			$qryargs['tax_query'] = array(
				array(
					'taxonomy' => 'testimonialcat',
					'field' => 'slug',
					'terms' => $catname->slug
				)
			);
		}
		
		query_posts( $qryargs ); 
		global $post;
		
		$output = "";
		if( have_posts() ){
			$output .= '<div class="if-testimonial '.$class.'">';
			$output .= '<ul>';
			$i = 1;
			while ( have_posts() ) : the_post(); 
				
				if($col==3){
					$liclass = 'fourcol';
				}elseif($col==2){
					$liclass = 'sixcol';
				}else{
					$liclass = '';
				}
				
				$custom = get_post_custom($post->ID);
				$testiinfo 	= (isset($custom["testi_info"][0]))? $custom["testi_info"][0] : "";
				$testithumb = (isset($custom["testi_thumb"][0]))? $custom["testi_thumb"][0] : "";
				
				if($i%$col==0 && $col>1){
					$liclass .= ' last';
				}
				
				$output .= '<li class="'.$liclass.'">';
				
				if($showthumb){
					$output .='<div class="testiimg">';
					$output .='<img src="'.$testithumb.'" width="70" height="70" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
					$output .='<span class="insetshadow"></span>';
					$output .='</div>';
					
					$bqclass="";
				}else{
					$bqclass="nomargin";
				}
				
				$output .= '<blockquote class="'.$bqclass.'">'.get_the_content();
				
				if($showtitle || $showinfo){
					$output .= '<span class="testiinfo">';
					if($showtitle){
						$output .= get_the_title( $post->ID );
					}
					if($testiinfo){
						$output .= ' - '.$testiinfo;
					}
					$output .= '</span>';
				}
				$output .= '</blockquote>';
				$output .= '<div class="clearfix"></div>';
				$output .= '</li>';
				
				if($i%$col==0 && $col>1){
					$output .= '<li class="clearfix"></li></ul><ul>';
				}
				
				$i++;
			endwhile;
			$output .= '</ul>';
			$output .= '<div class="clearfix"></div>';
			$output .= "</div>";
		}else{
			$output .= '<!-- no testimonial post -->';
		}
		wp_reset_query();
		
		return do_shortcode($output);
	}
	add_shortcode( 'testimonial', 'if_testimonial' );
}

if(!function_exists('if_rotatingtestimonial')){
	function if_rotatingtestimonial($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' 	=> '',
			'class'	=> '',
			'cat' => '',
			'title' => 'Our Testimonial',
			'showposts' => 5,
			'showtitle' => 'yes',
			'showinfo' => 'yes',
			'showthumb' => 'yes'
		), $atts));
		
		$catname = get_term_by('slug', $cat, 'testimonialcat');
		$showtitle = ($showtitle=='yes')? true : false;
		$showinfo = ($showinfo=='yes')? true : false;
		$showthumb = ($showthumb=='yes')? true : false;
		$showposts = (is_numeric($showposts))? $showposts : 5;
		
		$qryargs = array(
			'post_type' => 'testimonialpost',
			'showposts' => $showposts
		);
		if($catname!=false){
			$qryargs['tax_query'] = array(
				array(
					'taxonomy' => 'testimonialcat',
					'field' => 'slug',
					'terms' => $catname->slug
				)
			);
		}
		
		query_posts( $qryargs ); 
		global $post;
		
		$output = '';
		if( have_posts() ){
			$output .= '<div class="if-trotating flexslider '.$class.'">';
			$output .= '<div class="if-trotating-title"><h3><span>'.$title.'</span></h3></div>';
				$output .= '<ul class="slides">';
					while ( have_posts() ) : the_post(); 
						$custom = get_post_custom($post->ID);
						$testiinfo 	= (isset($custom["testi_info"][0]))? $custom["testi_info"][0] : "";
						$testithumb = (isset($custom["testi_thumb"][0]))? $custom["testi_thumb"][0] : "";
						
						$output .= '<li>';
							$output .= '<blockquote>'.get_the_content().'<span class="arrowbubble"></span></blockquote>';
							$output .= '<div class="clearfix"></div>';
							
							if($showthumb){
								$output .='<span class="testiimg">';
								$output .='<img src="'.$testithumb.'" width="70" height="70" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
								$output .='<span class="insetshadow"></span>';
								$output .='</span>';
							}
							if($showtitle || $showinfo){
								$output .= '<span class="testiinfo">';
								if($showtitle){
									$output .= '<strong>'.get_the_title( $post->ID ).'</strong>';
								}
								if($testiinfo){
									$output .= '<br/>'.$testiinfo;
								}
								$output .= '</span>';
							}
							$output .= '<div class="clearfix"></div>';
						$output .= '</li>';
						
					endwhile;
				$output .= '</ul>';
				$output .= '<div class="clearfix"></div>';
			$output .= "</div>";
		}else{
			$output .= '<!-- no testimonial post -->';
		}
		wp_reset_query();
		
		return do_shortcode($output);
	}
	add_shortcode( 'testimonial360', 'if_rotatingtestimonial' );
}

if(!function_exists('if_featuredslider')){
	function if_featuredslider($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' => '',
			'class' => 'minisliders',
			'moreproperties' => ''
		), $atts));
		
		global $post;
		
		if($id!=""){
			$ids = 'id="'.$id.'" ';
			$theid = $id;
		}else{
			$ids = 'id="'.$post->ID.'" ';
			$theid = $post->ID;
		}
		
		$qrychildren = array(
			'post_parent' => $theid,
			'post_status' => null,
			'post_type' => 'attachment',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_mime_type' => 'image'
		);

		$attachments = get_children( $qrychildren );
		$imgsize = "portfolio-image-col2";
		$cf_thumb2 = array(); $cf_full2 = "";
		
		foreach ( $attachments as $att_id => $attachment ) {
			$getimage = wp_get_attachment_image_src($att_id, $imgsize, true);
			$portfolioimage = $getimage[0];
			$alttext = get_post_meta( $attachment->ID , '_wp_attachment_image_alt', true);
			$image_title = $attachment->post_title;
			$caption = $attachment->post_excerpt;
			$description = $attachment->post_content;
			$cf_thumb2[] ='<img src="'.$portfolioimage.'" alt="'.$alttext.'" title="'. $image_title .'" class="scale-with-grid" />';
			
			$getfullimage = wp_get_attachment_image_src($att_id, 'full', true);
			$fullimage = $getfullimage[0];
			
			$cf_full2 .='<li class="slide" id="'.$att_id.'"><img src="'.$fullimage.'" alt="'.$alttext.'" title="'. $image_title .'" /></li>';
		}
		
		$output  = '<div '.$ids.' class="'.$class.' flexslider" '.$moreproperties.'>';
		$output	.= '<ul class="slides">';
		$output	.= $cf_full2;
		$output	.= '</ul>';
		$output	.= '</div>';
		return $output;
	}
	add_shortcode( 'featuredslider', 'if_featuredslider' );
}

// Actual processing of the shortcode happens here
function if_pre_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
 
    add_shortcode('one_half', 'if_one_half');
	add_shortcode('one_third', 'if_one_third');
	add_shortcode('one_fourth', 'if_one_fourth');
	add_shortcode('one_fifth', 'if_one_fifth');
	add_shortcode('one_sixth', 'if_one_sixth');
	
	add_shortcode('two_third', 'if_two_third');
	add_shortcode('two_fourth', 'if_two_fourth');
	add_shortcode('two_fifth', 'if_two_fifth');
	add_shortcode('two_sixth', 'if_two_sixth');
	
	add_shortcode('three_fourth', 'if_three_fourth');
	add_shortcode('three_fifth', 'if_three_fifth');
	add_shortcode('three_sixth', 'if_three_sixth');
	
	add_shortcode('four_fifth', 'if_four_fifth');
	add_shortcode('four_sixth', 'if_four_sixth');
	
	add_shortcode('five_sixth', 'if_five_sixth');
	
	add_shortcode('content_title', 'if_content_title');
	
	add_shortcode( 'dropcap', 'if_dropcap' );
	
	add_shortcode( 'highlight', 'if_highlight' );
	
	add_shortcode( 'portfolio', 'if_portfolio_shortcode' );
	
	add_shortcode('pre', 'if_pre');
	
	add_shortcode( 'pullquote', 'if_pullquote' );
	add_shortcode( 'blockquote', 'if_blockquote' );
	
	add_shortcode( 'recent_posts', 'if_recentposts' );
	
	add_shortcode('separator', 'if_separator');
	add_shortcode('clearfix', 'if_clearfixfloat');
	
	add_shortcode('tabs', 'if_tab');
	
	add_shortcode('toggle', 'if_toggle');
	add_shortcode('toggles', 'if_toggles');
	
	/* Custom Shortcode */
	add_shortcode( 'portfolio_carousel', 'if_portfoliocarousel' );
	add_shortcode( 'bigtext', 'if_bigtext' );
	add_shortcode( 'secondarytext', 'if_secondarytext' );
	add_shortcode( 'heading', 'if_heading' );
	add_shortcode( 'sliders', 'if_sliders' );
	add_shortcode( 'slide', 'if_slide' );
	add_shortcode( 'testimonial', 'if_testimonial' );
	add_shortcode( 'testimonial360', 'if_rotatingtestimonial' );
	add_shortcode( 'featuredslider', 'if_featuredslider' );
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'if_pre_shortcode', 7 );