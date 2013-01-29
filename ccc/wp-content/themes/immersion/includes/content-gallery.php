<?php 

$gallery=get_meta_option('pf_gallery'); 
$height=get_meta_option('pf_gallery_height'); 
$type=get_meta_option('pf_gallery_type'); 
$atts=explode (',', get_meta_option('gallery_items', $gallery));



?>

<?php if($type=='stacked'): ?>

	<?php foreach($atts as $att): ?>  
			
		<?php  $att=get_post($att);   ?>
		
		<?php $image_wp=wp_get_attachment_image_src( $att->ID, 'full' ); ?>
								
		<a class="lightbox" href="<?php echo $image_wp[0]; ?>" title="<?php the_title(); ?>">

			<figure class="row">

				<img class="scale-with-grid preload" src="<?php echo resize_image( $att->ID ,700, 0 );?>">

				<figcaption class="overlay"></figcaption>

			</figure>

		</a>
	
	<?php endforeach;  ?>


<?php else: ?>


<div id="flex-slider-<?php echo get_the_id(); ?>" class="flexslider-container">
	
	<div class="flexslider">
	
		<ul class="slides">
						
		<?php foreach($atts as $att): ?>  
				
			<?php  $att=get_post($att);   ?>
									
			<li>
				<img class="scale-with-grid" src="<?php echo resize_image( $att->ID ,700, $height ); ?>">
			</li>
				
		<?php endforeach;  ?>
						
		</ul>
		
		</div>
		
</div>	



<script>

jQuery(document).ready(function($) {

	$('#flex-slider-<?php echo get_the_id(); ?>').flexslider({
		animation: "slide",
		controlsContainer: ".flexslider-container"
	});

});

</script>

<?php endif; ?>


