<?php if ( have_posts() ) while ( have_posts() ) : the_post();   ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-format-wrap">

		<?php get_template_part( 'content', get_post_format() ); ?>

	</div>


	<div class="post-content">
	

		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span><?php echo get_the_date('d M'); ?></span><br><?php the_title(); ?></a></h2>



	

			<?php the_excerpt(); ?>

			<ul class="meta_wrap clearfix">

				<li class="read-more"><a href="<?php the_permalink(); ?>"><?php _e('Continue reading &rarr;',THEME_SLUG); ?></a></li>
				<li class="entry_comments"><?php comments_popup_link(__( '0 comments', THEME_SLUG ), __( '1 comment', THEME_SLUG ), __( '% comments', THEME_SLUG )); ?><span>/</span></li>
				<li class="entry_categories"><?php $categories_list = get_the_category_list( __( ', ', THEME_SLUG ) );printf($categories_list);?></li>

			</ul>



	</div>


</article>



<?php endwhile; ?>





