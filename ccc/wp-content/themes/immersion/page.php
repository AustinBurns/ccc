<?php

$theme_page_type=get_meta_option('theme_page_type');
if($theme_page_type=='2') return require(THEME_DIR . "/template-blog.php");

?>


<?php get_header(); ?>

<?php tf_supersized(); ?>

<section id="main-wrap">

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="container">
		
			<?php if(get_meta_option('display_title')!='off'): ?>
			
			<div class="sixteen columns">

				<h1 id="post-title"><?php the_title(); ?></h1>

			</div>
			
			<?php endif; ?>
			
			<?php  $layoutType=get_post_meta(get_the_id(), 'layout-type', true); ?>
			
			<?php if($layoutType==16 || $layoutType==''): ?>
			
				<div class="sixteen columns">
					
					<?php the_content(''); ?>
				
				</div>
			
			<?php else: ?>

				<div class="twelve columns">
				
					<?php the_content(''); ?>
				
				</div>
				
				<aside class="four columns">
				
					<?php get_sidebar(); ?>
				
				</aside>
				<br class="clear">
			
			<?php endif; ?>	

			</div>	
			
		</div>	
	
	<?php endwhile; ?>		
				


<?php get_footer(); ?>
			
		
		

		



	
