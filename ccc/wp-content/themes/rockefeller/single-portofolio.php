<?php
/**
 * The Template for displaying single portfolio posts.
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
                	<div class="twelvecol">
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                        
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', THE_LANG ), 'after' => '</div>' ) ); ?>
                                <?php edit_post_link( __( 'Edit', THE_LANG ), '<span class="edit-link">', '</span>' ); ?>
                            </div><!-- .entry-content -->
                            
                        </div><!-- #post -->
                        
                        <?php endwhile; ?>
                    </div>
                    <div class="clearfix"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
	
<?php get_footer(); ?>