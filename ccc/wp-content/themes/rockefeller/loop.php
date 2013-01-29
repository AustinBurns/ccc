<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */
?>
	
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<h1 class="posttitle"><?php _e( 'Not Found', THE_LANG ); ?></h1>
		<div class="entry">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', THE_LANG ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>
<?php endif; ?>


<?php while ( have_posts() ) : the_post(); ?>

	<?php /* How to display all posts. */ ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    		<h2 class="posttitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', THE_LANG ), the_title_attribute( 'echo=0' ) ); ?>" data-rel="bookmark"><?php the_title(); ?></a></h2>
            <?php
			if(!is_search()){
				$custom = get_post_custom($post->ID);
				$cf_imgurl = (isset($custom["image_url"][0]))? $custom["image_url"][0] : "";
				$imgurl = "";
				/* temporary not used */
				if($cf_imgurl!=""){
					$imgurl = '<div class="frameimg"><img src='. $cf_imgurl .' alt="'. get_the_title( $post->ID ).'" class="scale-with-grid"/></div>';
				}elseif(has_post_thumbnail($post->ID) ){
					$imgurl = '<div class="frameimg">'.get_the_post_thumbnail($post->ID, 'blog-post-image', array('class' => 'scale-with-grid')).'</div>';
				}else{
					$imgurl ="";
				}
				echo $imgurl;
			}
			?>
             <div class="entry-content">
                <?php 
				if(is_search()){
					the_excerpt();
				}else{
					the_content(); 
				}
				?>
                <div class="entry-utility">
                	<span class="meta-author"><?php _e('By :', THE_LANG ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a></span> 
					/<span class="meta-date"><?php the_time('F d, Y') ?></span>
                    /<span class="meta-cat"><?php the_category(', '); ?></span>
                	/<span class="meta-comment"><?php comments_popup_link(__('0 Comment', THE_LANG), __('1 Comment', THE_LANG), __('% Comments', THE_LANG)); ?></span>
                    <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read More', THE_LANG); ?></a>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>
            
            
             
		<div class="clearfix"></div>
        
	</article><!-- end post -->
	
	<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>


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
<?php endif; ?>
