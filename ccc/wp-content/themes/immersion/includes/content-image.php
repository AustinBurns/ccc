<?php if(has_post_thumbnail()): ?>

<?php $image_wp=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

<a class="lightbox" href="<?php echo $image_wp[0]; ?>" title="<?php the_title(); ?>">

	<figure>
			
		<img class="scale-with-grid preload" src="<?php echo resize_image( get_post_thumbnail_id() ,700, 0 );?>">
		
		<figcaption class="overlay"></figcaption>
		
	</figure>

</a>

<?php endif; ?>

