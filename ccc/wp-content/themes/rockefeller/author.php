<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */

get_header(); ?>


		<?php $sidebarposition = if_get_option( THE_SHORTNAME . '_sidebar_position' ,'right'); ?>
        
        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="row">
                	
                    <section id="content" class="eightcol <?php if($sidebarposition=="left"){echo "positionright last";}else{echo "positionleft";}?>">
                        <div class="main">
							<?php
                                /* Queue the first post, that way we know who
                                 * the author is when we try to get their name,
                                 * URL, description, avatar, etc.
                                 *
                                 * We reset this later so we can run the loop
                                 * properly with a call to rewind_posts().
                                 */
                                if ( have_posts() )
                                    the_post();
                            ?>
                
                
                
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
                
                            <?php
                            /* Since we called the_post() above, we need to
                             * rewind the loop back to the beginning that way
                             * we can run the loop properly, in full.
                             */
                            rewind_posts();
                        
                            /* Run the loop for the author archive page to output the authors posts
                             * If you want to overload this in a child theme then include a file
                             * called loop-author.php and that will be used instead.
                             */
                             get_template_part( 'loop', 'author' );
                            ?>
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