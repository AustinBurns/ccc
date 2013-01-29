<?php get_header(); ?>


	

<section id="main-wrap">
		
		<div class="container">
		
			<div class="sixteen columns">

				<h1 id="post-title"><?php tf_get_title(); ?></h1>

			</div>
		
			<div class="twelve columns">
			
				<?php get_template_part('loop'); ?>
				
				<?php echo tf_pagination(); ?>
			
			</div>
			
			<aside class="four columns">
			
				<?php get_sidebar(); ?>
			
			</aside>
			<br class="clear">
			
		</div>	
	

				

<?php get_footer(); ?>
			
		
		

		



	
