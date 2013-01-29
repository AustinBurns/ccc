<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */

get_header(); ?>

        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="row">
                	<div class="twelvecol">
                        <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', THE_LANG ); ?></p>
                        <?php get_template_part('searchform'); ?>
                        
                        <div class="clearfix"></div><!-- clear float --> 
                    </div>
                    <div class="clearfix"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    
<?php get_footer(); ?>