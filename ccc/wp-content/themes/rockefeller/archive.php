<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
                                /* Since we called the_post() above, we need to
                                 * rewind the loop back to the beginning that way
                                 * we can run the loop properly, in full.
                                 */
                                rewind_posts();
                                
                                /* Run the loop for the archives page to output the posts.
                                 * If you want to overload this in a child theme then include a file
                                 * called loop-archives.php and that will be used instead.
                                 */
                                get_template_part( 'loop', 'archive' );
                            ?>
                    	<div class="clearfix"></div><!-- clear float --> 
                        </div><!-- main -->
                    </section><!-- content -->
                    
                    <aside id="sidebar" class="fourcol <?php if($sidebarposition=="left"){echo "positionleft";}else{echo "positionright last";}?>">
                        <?php get_sidebar();?>  
                        <div class="clearfix"></div>
                    </aside><!-- sidebar -->
                    <div class="clearfix"></div>
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    
<?php get_footer(); ?>