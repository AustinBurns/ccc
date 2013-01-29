<?php get_header(); ?>

<?php tf_supersized(); ?>

<section id="main-wrap">

				
	<?php
	
	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if(is_front_page())  $page = (get_query_var('page')) ? get_query_var('page') : 1;
	$posts_per_page=get_meta_option('items_per_page'); 
	$cat=get_meta_option('post_categories'); 	
	if(!empty($cat)) $cat=implode(',',$cat);
	else $cat='';
	
	
	$args= array("post_type" => "post", "paged" => $page, "posts_per_page" => $posts_per_page, "cat" => $cat);
	query_posts($args);
	
	?>

		<div class="container">
		
			<?php if(get_meta_option('display_title')!='off'): ?>
			
			<div class="sixteen columns">

				<h1 id="post-title"><?php the_title(); ?></h1>

			</div>
			
			<?php endif; ?>
		
			<div class="twelve columns row">
			
				<?php get_template_part('loop'); ?>
				
				<?php echo tf_pagination(); ?>
			
			</div>
			
			<aside class="four columns row">
			
				<?php get_sidebar(); ?>
			
			</aside>
			<br class="clear">
			
		</div>	
	

				

<?php get_footer(); ?>
			
		
		

		



	
