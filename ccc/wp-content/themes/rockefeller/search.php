<?php
/**
 * The template for displaying Search Results pages.
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
                            <div id="searchresult">
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
                                /* Since we called the_post() above, we need to
                                 * rewind the loop back to the beginning that way
                                 * we can run the loop properly, in full.
                                 */
                                rewind_posts();
                            
                                /* Run the loop for the author archive page to output the authors posts
                                 * If you want to overload this in a child theme then include a file
                                 * called loop-author.php and that will be used instead.
                                 */
                                 get_template_part( 'loop', 'search' );
                                 
                            ?>
                            </div>
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