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
	
		<div class="four columns portfolio-description">
		
			<?php the_excerpt(); ?>
		
		</div>
		
		<div class="twelve columns">
		
			<div class="post-format-wrap">
			
				<?php get_template_part( 'includes/content-'.get_post_format() ); ?>
			
			</div>
			
			<?php the_content(); ?>
			
			<h5><?php _e('Related projects',THEME_SLUG); ?></h5>
			
			<?php 
			
			$terms = wp_get_post_terms( get_the_id(), 'portfolio_category'); 
			$terms_ids=array();
			
			foreach($terms as $term):
				
				array_push($terms_ids, $term->term_id);
			
			endforeach;
			
			
			?> 
			
			
			
			<div class='blog-posts'>
			
				<?php $i=0; ?>
				<?php $args=array("post_type" => "portfolio", "tax_query" => array(array("taxonomy" => "portfolio_category","field" => "id","terms" => $terms_ids))); ?>
				<?php query_posts($args); ?>			
				<?php while ( have_posts() ) : the_post(); ?>
			
					<?php 
					
					if($i%3==0) $pos='alpha';
					elseif($i%3==2) $pos='omega';
					else $pos='';
					
					?>
					<div class='four columns row <?php echo $pos; ?>'>

						<a href='<?php the_permalink(); ?>'>
							<figure>			
								<img class="scale-with-grid preload" src="<?php echo resize_image( get_post_thumbnail_id() ,300, 280 ); ?> "/>
								
								<figcaption></figcaption>	
							</figure>	
						</a>
						<h5><?php the_title(); ?></h5>
						<p class='post-excerpt'><?php echo tf_the_excerpt_max_charlength(150); ?></p>		
						<p><a class='more' href='<?php the_permalink(); ?>'><?php _e('Continue reading',THEME_SLUG); ?></a></p>	

					</div>
					
					<?php if($i%3==2): ?>
						<br class="clear">
					<?php endif; ?>
					
					<?php $i++; ?>
					
				<?php endwhile; ?>   
				<?php wp_reset_query(); ?>
				<?php wp_reset_postdata(); ?>
					
							
	
			
			</div>
	
		</div>
			
		
	
	</div>
	
<?php endwhile; ?>	
		
		

<?php get_footer(); ?>
			