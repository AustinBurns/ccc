<?php get_header(); ?>

<section id="main-wrap">
		
	<?php
	
	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} 

	$search_query['post_type']=array('post');
	query_posts($search_query);		

	?>

		<div class="container">
		
			<div class="sixteen columns">

				<h1 id="post-title"><?php tf_get_title(); ?></h1>

			</div>
		
			<div class="twelve columns">
			
				<?php if(!have_posts()): ?>
				
				<p>Sorry. No posts were found matching your string.</p>
				
				<?php endif; ?>
			
				<?php get_template_part('loop'); ?>
				
				<?php echo tf_pagination(); ?>
			
			</div>
			
			<aside class="four columns">
			
				<?php get_sidebar(); ?>
			
			</aside>
			<br class="clear">
			
		</div>	
	

				

<?php get_footer(); ?>
			
		
		

		



	
