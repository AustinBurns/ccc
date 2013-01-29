<?php
/**
 * Template Name: No sidebar
 *
 * A custom page template without sidebar.
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
			$custom = get_post_custom($post->ID);
		?>
        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="row">
                	<div class="twelvecol">
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
                    </div>
                    <div class="clearfix"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
   
<?php get_footer(); ?>