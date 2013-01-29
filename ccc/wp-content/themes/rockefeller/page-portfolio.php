<?php
/**
 * Template Name: Portfolio
 *
 * A custom page template for portfolio page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */

get_header(); ?>
       <?php
			$sidebarposition = if_get_option( THE_SHORTNAME . '_sidebar_position' ,'right'); 
		?>
        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="row">
                	<?php
					
                    $custom = get_post_custom($post->ID);
                    $column = (isset($custom["p_column"][0]))? intval($custom["p_column"][0]) : "";
                    $cats = (isset($custom["p_category"][0]))? $custom["p_category"][0] : "";
                    $showpost = (isset($custom["p_showpost"][0]))? $custom["p_showpost"][0] : "";
					$orderby = (isset($custom["p_orderby"][0]))? $custom["p_orderby"][0] : "date";
					$ordersort = (isset($custom["p_sort"][0]))? $custom["p_sort"][0] : "DESC";
                    $categories = $cats;

                    if(is_front_page()){
						$paged = (get_query_var('page'))? get_query_var('page') : 1;
					}else{
						$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
					}
					
					$idnum = 0;
		
					if($column!= 2 && $column!= 3 && $column!= 4 ){
						$column = 3;
					}
					$typecol = "if-pf-col-".$column;
					$imgsize = "portfolio-image-col".$column;
					
					if($showpost==""){$showpost="-1";}
					
					$argquery = array(
						'post_type' => 'portofolio',
						'showposts' => $showpost,
						'orderby' => $orderby,
						'order' => $ordersort,
						'paged' => $paged
					);
					
					$catname = get_term_by('slug',$categories,"portfoliocat");
					
					if($catname){
						$argquery['tax_query'] = array(
							array(
								'taxonomy' => 'portfoliocat',
								'field' => 'slug',
								'terms' => $catname->slug
							)
						);
					}
			
					query_posts($argquery); 
					global $post, $wp_query;
					
					?>
					
					<div class="if-pf-container">
						<ul class="<?php echo $typecol; ?>">
					
                    <?php
					while ( have_posts() ) : the_post(); 
							$prefix = 'if_';
							$custom = get_post_custom( get_the_ID() );
							$cf_thumb = (isset($custom["custom_thumb"][0]))? $custom["custom_thumb"][0] : "";
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
								$getimage = wp_get_attachment_image_src($att_id, $imgsize, true);
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
									$cf_full2 ='<a data-rel=prettyPhoto['.$post->post_name.'] href="'.$fullimageurl.'" title="'. $fullimagetitle .'" class="hidden"></a>'.$cf_full2;
									$fullimageurl = $fullimage;
									$fullimagetitle = $image_title;
									$fullimagealt = $alttext;
								}else{
									$cf_full2 .='<a data-rel=prettyPhoto['.$post->post_name.'] href="'.$fullimage.'" title="'. $image_title .'" class="hidden"></a>';
								}
								$z++;
							}
							
							if($cf_thumb!=""){
								$cf_thumb = '<img src="' . $cf_thumb . '" alt="'. get_the_title(get_the_ID()) .'"  class="scale-with-grid" />';
							}elseif( has_post_thumbnail( get_the_ID() ) ){
								$cf_thumb = get_the_post_thumbnail(get_the_ID(), $imgsize, array('class' => 'scale-with-grid'));
							}elseif( isset( $cf_thumb2[0] ) ){
								$cf_thumb = $cf_thumb2[0];
							}else{
								$cf_thumb = '<span class="if-noimage"></span>';
							}
							
							
							if($cf_externallink!=""){
								$golink = $cf_externallink;
								$rollover = "gotolink";
								$cf_full2 = '';
							}else{
								$golink = get_permalink();
								$rollover = "gotopost";
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
							
							if(($idnum%$column) == 0 && $idnum>0 ){ 
								echo '<li class="pf-clear"></li></ul><ul class="'.$typecol.'">';
							}
							
							if($column=="2"){
								$classpf = 'sixcol ';
							}elseif($column=="4"){
								$classpf = 'threecol ';
							}else{
								$classpf = 'fourcol ';
							}

							if((($idnum+1)%$column) == 0 && $idnum>0){$classpf .= "last";}else{$classpf .= "";}
							
							echo '<li class="'.$classpf.'">';
							echo '<div class="if-pf-img">';
								echo '<div class="rollover"></div>';
								
								echo '<a class="image '.$rollover.'" href="'.$golink.'" title="'.get_the_title().'"></a>';
								if($bigimageurl!=''){
									echo '<a class="image zoom" href="'.$bigimageurl.'" '.$rel.' title="'.$bigimagetitle.'"></a>';
								}
								
								echo $cf_thumb;
								echo $cf_full2;
							echo '</div>';
							
							echo '<div class="if-pf-text">';
								echo '<h2><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
								echo '<div>'.get_the_excerpt().'</div>';
							echo '</div>';
							
							echo '<div class="if-pf-clear"></div>';
							echo '</li>';
								
							$idnum++; $classpf=""; 
								
					endwhile; // End the loop. Whew.
					?>
						<li class="pf-clear"></li>
                        </ul>
                        <div class="clearfix"></div>
					</div><!-- end #if-portfolio -->
                              
                    <?php /* Display navigation to next/previous pages when applicable */ ?>
                    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                     <?php if(function_exists('wp_pagenavi')) { ?>
                         <?php wp_pagenavi(); ?>
                     <?php }else{ ?>
                        <div id="nav-below" class="navigation">
                                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', THE_LANG ) ); ?></div>
                                <div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', THE_LANG ) ); ?></div>
                        </div><!-- #nav-below -->
                    <?php }?>
                    <?php endif;  wp_reset_query();?>
                            
                	<div class="clearfix"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->

<?php get_footer(); ?>