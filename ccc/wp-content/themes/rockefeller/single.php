<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */

get_header(); ?>


	<?php 
			$sidebarposition = if_get_option( THE_SHORTNAME . '_sidebar_position' ,'right'); 
			$custom = get_post_custom($post->ID);
			if(isset($custom["sidebar_position"][0])){
				if($custom["sidebar_position"][0]=="left" || $custom["sidebar_position"][0]=="right"){
					$sidebarposition = $custom["sidebar_position"][0];
				}
			}
		?>
    
    <!-- MAIN CONTENT -->
    <div id="outermain">
        <div class="container">
            <section id="maincontent" class="row">
                <section id="content" class="eightcol <?php if($sidebarposition=="left"){echo "positionright last";}else{echo "positionleft";}?>">
                	<div class="main">
                        <div id="singlepost">
                        
                             <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                             <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                             
                                <?php
                                    
                                $custom = get_post_custom($post->ID);
                                $cf_thumb = (isset($custom["image_url"][0]))? $custom["image_url"][0] : "";
                                
                                if($cf_thumb!=""){
                                    $thumb = '<div class="frameimg"><img src='. $cf_thumb .' alt="" width="" height="" class="scale-with-grid"/></div>';
                                }elseif(has_post_thumbnail($post->ID) ){
                                    $thumb = '<div class="frameimg">'.get_the_post_thumbnail($post->ID, 'blog-post-image', array('alt' => '', 'class' => '')).'</div>';
                                }else{
                                    $thumb ="";
                                }

                                echo  $thumb;
                                ?>
                                
                                 <div class="entry-content">
                                    <?php the_content();?>
                                    
                                    <div class="entry-utility">
                                        <span class="meta-author"><?php _e('By :', THE_LANG ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a></span> 
                                        /<span class="meta-date"><?php the_time('F d, Y') ?></span>
                                        /<span class="meta-cat"><?php the_category(', '); ?></span>
                                        /<span class="meta-comment"><?php comments_popup_link(__('0 Comment', THE_LANG), __('1 Comment', THE_LANG), __('% Comments', THE_LANG)); ?></span>
                                        <span class="nav-next"><?php next_post_link( '%link', __( 'Next', THE_LANG ) ); ?></span>
                                        <span class="nav-previous"><?php previous_post_link( '%link', __( 'Previous', THE_LANG ) ); ?></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                
                             </article>
                            <?php
                            
                            // If a user has filled out their description, show a bio on their entries.
                            if ( get_the_author_meta( 'description' ) ) : ?>
                            <div id="entry-author-info">
                                <div id="author-avatar">
                                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'interfeis_author_bio_avatar_size', 60 ) ); ?>
                                </div><!-- author-avatar -->
                                <div id="author-description">
                                    <h2><span class="author"><?php printf( __( 'About %s', THE_LANG ), get_the_author() ); ?></span></h2>
                                    <?php the_author_meta( 'description' ); ?>
                                </div><!-- author-description	-->
                            </div><!-- entry-author-info -->
                            <?php endif; ?>
        
                            <?php comments_template( '', true ); ?>
                            
                            <?php endwhile; ?>
                        
                        </div><!-- singlepost --> 
                    </div><!-- main -->
                    <div class="clearfix"></div><!-- clear float --> 
                </section><!-- content -->
                
                <aside id="sidebar" class="fourcol <?php if($sidebarposition=="left"){echo "positionleft";}else{echo "positionright last";}?>">
                    <?php get_sidebar();?>  
                </aside><!-- sidebar -->
                <div class="clearfix"></div>
            </section><!-- maincontent -->
        </div>
    </div>
    <!-- END MAIN CONTENT -->
     
<?php get_footer(); ?>