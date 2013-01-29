<?php if(has_post_thumbnail()): ?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

	<figure>
	
		<img class="scale-with-grid preload" src="<?php echo resize_image( get_post_thumbnail_id() ,700, 0 );?>">
		
		<figcaption class="overlay"></figcaption>
		
	</figure>

</a>

<?php endif; ?>

