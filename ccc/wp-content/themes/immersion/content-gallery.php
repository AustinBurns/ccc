<?php 

$gallery=get_meta_option('pf_gallery'); 
$height=get_meta_option('pf_gallery_height'); 
$atts=explode (',', get_meta_option('gallery_items', $gallery));

?>

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

