<?php get_header(); ?>

<?php tf_supersized(); ?>


<section id="main-wrap">


	<div class="container">
	
		<?php if(get_meta_option('display_title')!='off'): ?>
		
		<div class="sixteen columns">

			<h1 id="post-title"><?php the_title(); ?></h1>

		</div>
		
		<br class="clear">
		
		<?php endif; ?>
	
		<div id="primary" class="twelve columns row">
		
		<?php while ( have_posts() ) : the_post(); ?>
		

		<div class="post-format-wrap">
		
			<?php get_template_part( 'includes/content-'.get_post_format() ); ?>
		
		</div>
				
		<div id="post-content">
			<?php the_content(''); ?>
		</div>
		
		<?php comments_template( '', false ); ?>
		
		<?php endwhile; ?>	
		
		</div>
			
		<aside class="four columns row">
						
			<?php get_sidebar(); ?>
		
		</aside><!-- four columns -->
			
		
	
	</div>
		

<?php get_footer(); ?>
			