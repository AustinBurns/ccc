<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
                        
							<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-content">
                                    <?php the_content( __( 'Read More', THE_LANG ) ); ?>
                                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', THE_LANG ), 'after' => '</div>' ) ); ?>
                                    <?php edit_post_link( __( 'Edit', THE_LANG ), '<span class="edit-link">', '</span>' ); ?>
                                </div><!-- .entry-content -->
                            </div><!-- #post -->
                    
                            <?php comments_template( '', true ); ?>
                    
                            <?php endwhile; ?>
                            
                            <div class="clearfix"></div><!-- clear float --> 
                        </div><!-- main -->
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