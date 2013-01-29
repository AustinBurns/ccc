<?php
$sliderarrange = if_get_option( THE_SHORTNAME . '_slider_arrange');
$sliderDisableText = if_get_option( THE_SHORTNAME . '_slider_disable_text');

$headerText = stripslashes(if_get_option( THE_SHORTNAME . '_header_text',''));
$disable_topsearch = if_get_option(THE_SHORTNAME . '_disable_topsearch');
$socialiconoutput = if_socialicon();
if($headerText=="" && $disable_topsearch==true && $socialiconoutput==""){
	$emptyclass = "empty";
}else{
	$emptyclass = "";
}
/*?>
<!-- SLIDER -->
<div id="outerslider" class="<?php echo $emptyclass; ?>">
	
    <div id="slidercontainer">
        <section id="slider">
            <div id="slideritems" class="flexslider preloader">
                <ul class="slides">
                    <?php
                    $prefix = 'if_';
                    $custom = get_post_custom(get_the_ID());
                    $cf_sliderCategory = (isset($custom["slider_category"][0]))? $custom["slider_category"][0] : "";

                    $catSlider = get_term_by('slug', $cf_sliderCategory, "slidercat");
                    if($cf_sliderCategory!=""){
                        $catSliderInclude = '&slidercat='. $catSlider->slug ;
                    }
                    
                    query_posts('post_type=slider-view'.$catSliderInclude.'&post_status=publish&showposts=-1&order=' . $sliderarrange);
                    while ( have_posts() ) : the_post();
                    
                    $prefix = 'if_';
                    $custom = get_post_custom( get_the_ID() );
                    $thumbid = get_post_thumbnail_id( get_the_ID() );
                    $slidersrc = wp_get_attachment_image_src( $thumbid, 'full' );

                    $cf_slideurl = (isset($custom["external_link"][0]))?$custom["external_link"][0] : "";
                    $cf_thumb = (isset($custom["image_url"][0]))? $custom["image_url"][0] : "";
					$cf_talign = (isset($custom["text_align"][0]))? $custom["text_align"][0] : "";
                    $cf_bgSlideImg = (isset($custom["bgslide_img"][0]))? $custom["bgslide_img"][0] : "";
					$cf_bgSlideRepeat = (isset($custom["bgslide_repeat"][0]) && trim($custom["bgslide_repeat"][0])!="")? $custom["bgslide_repeat"][0] : "";
					$cf_bgSlidePos = (isset($custom["bgslide_pos"][0]) && trim($custom["bgslide_pos"][0])!="")? $custom["bgslide_pos"][0] : "";
					$cf_bgSlideAttch = (isset($custom["bgslide_attch"][0]) && trim($custom["bgslide_attch"][0])!="")? $custom["bgslide_attch"][0] : "";
                    $cf_bgSlideColor = (isset($custom["bgslide_color"][0]))? $custom["bgslide_color"][0] : "";
                    
                    $output = $style ="";
					if($cf_bgSlideImg!=""){
						$style .= 'background-image:url(' . $cf_bgSlideImg . ');';
					}
					if($cf_bgSlideRepeat!=""){
						$style .= 'background-repeat:' . $cf_bgSlideRepeat . ';';
					}
					if($cf_bgSlidePos!=""){
						$style .= 'background-position:' . $cf_bgSlidePos . ';';
					}
					if($cf_bgSlideAttch!=""){
						$style .= 'background-attachment:' . $cf_bgSlideAttch . ';';
					}
					if($cf_bgSlideColor!=""){
						$style .= 'background-color:' . $cf_bgSlideColor . ';';
					}
                    $output .='<li style="'.$style.'">';
                        if($cf_slideurl!=""){
                            $output .= '<a href="'.$cf_slideurl.'">';
                        }
                       
                        //slider images
                        if(has_post_thumbnail( get_the_ID()) || $cf_thumb!=""){
                            if($cf_thumb!=""){
                                $output .= '<img src="'.$cf_thumb.'" alt="" />';
                            }else{
                                $output .= get_the_post_thumbnail(get_the_ID(),'full');
                            }
                        }
                            
                        if($cf_slideurl!=""){
                            $output .= '</a>';
                        }
                        
                       //slider text
                       if($sliderDisableText!=true){
					   		if($cf_talign=="left"){
								$talign = "left";
							}elseif($cf_talign=="right"){
								$talign = "right";
							}else{
								$talign = "top";
							}
                           $output .='<div class="flex-caption">';
						   	$output .='<div class="text-caption row '.$talign.'">';
						   		$output .='<div class="caption-content">';
						   if($cf_slideurl!=""){
                               $output .='<h2><a href="'.$cf_slideurl.'">'.get_the_title().'</a></h2>';
                           }else{
                               $output .='<h2>'.get_the_title().'</h2>';
                           }
						   
                           if($cf_slideurl!=""){
                               $output .='<div><a href="'.$cf_slideurl.'">'.get_the_excerpt().'</a></div>';
							   $output .='<a class="sliderbutton" href="'.$cf_slideurl.'"><span>'.__( 'For Details', THE_LANG ).'</span></a>';
                           }else{
                               $output .='<div>'.get_the_excerpt().'</div>';
                           }
						   
						   		$output .='</div>';
								$output .='<div class="clearfix"></div>';
							$output .='</div>';
                           $output .='</div>';
                       }
                        
                    $output .='</li>';
                    
                    echo $output;
                    
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </section>
        <div class="clearfix"></div>
    </div>
</div>
<!-- END SLIDER -->*/

function tf_get_gallery_images(){

	$prefix = 'if_';
    $custom = get_post_custom(get_the_ID());
    $cf_sliderCategory = (isset($custom["slider_category"][0]))? $custom["slider_category"][0] : "";

    $catSlider = get_term_by('slug', $cf_sliderCategory, "slidercat");
    if($cf_sliderCategory!=""){
        $catSliderInclude = '&slidercat='. $catSlider->slug ;
    }
    
    query_posts('post_type=slider-view'.$catSliderInclude.'&post_status=publish&showposts=-1&order=' . $sliderarrange);
    while ( have_posts() ) : the_post();
    
    $prefix = 'if_';
    $custom = get_post_custom( get_the_ID() );
    $thumbid = get_post_thumbnail_id( get_the_ID() );
    $slidersrc = wp_get_attachment_image_src( $thumbid, 'full' );

    $cf_slideurl = (isset($custom["external_link"][0]))?$custom["external_link"][0] : "";
    $cf_thumb = (isset($custom["image_url"][0]))? $custom["image_url"][0] : "";
    
    //slider images
    if(has_post_thumbnail( get_the_ID()) || $cf_thumb!=""){
        if($cf_thumb!=""){
            $src = $cf_thumb;
        }else{
            $src = $slidersrc[0];
        }
    }
	
	$images[] = array(
		'title' => get_the_title(),
		'src' => $src,
		'description' => get_the_content(),
		'url'  => $cf_slideurl,
		);
	
	endwhile;

	return $images;

}

function tf_supersized(){

	$images=tf_get_gallery_images();
	
	if(count($images)>1): ?>
	
	<div id="left_arrow"></div>
	<div id="right_arrow"></div>
		
	<?php endif; ?>
	
	<div id="slidecaption">
	
		<h3></h3>
		
		<p></p>
		
			<div id="down_arrow"><?php _e('read more...', THEME_SLUG); ?></div>
		
	</div>
	
	<ul id="slide-list"></ul>
	
	<script>
		
		jQuery(document).ready(function($) {
		
			jQuery(function($){
				
				$.supersized({
				
					// Functionality	
					autoplay:1,
					slide_interval          :   500,		// Length between transitions
					transition              :   3, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	800,		// Speed of transition
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)				
										   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'number', 'name', 'blank')
		
					slides 					:  	[			// Slideshow Images											
												<?php $i=0; foreach( $images as $image ):  ?>
													{image : '<?php echo $image['src']; ?>', title : '<?php echo $image['title']; ?>', desc: '<?php echo $image['description']; ?>', url:'<?php echo $image['url']; ?>' }
												<?php 
													$i++;
													if($i!=count($images)) echo ',';
													endforeach;  ?>
												],				
				});
			});
		});
		
	</script>
	
	<?php

}

tf_supersized();