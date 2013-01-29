<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
                    <section id="content" class="eightcol <?php if($sidebarposition=="left"){echo "positionright last";}else{echo "positionleft";}?>">
                        <div class="main">
							<?php
							global $post, $more;
							$more = 0;
                            /* Run the loop to output the posts.
                            * If you want to overload this in a child theme then include a file
                            * called loop-index.php and that will be used instead.
                            */
                            get_template_part( 'loop', 'index' );
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