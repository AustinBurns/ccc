<?php if(get_meta_option('pf_video_type')==1) :?>

	<div class="video-wrap"><iframe src="http://player.vimeo.com/video/<?php echo get_meta_option('pf_video_id'); ?>?title=0&amp;byline=0&amp;portrait=0"  frameborder="0" width="711" height="400" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

<?php elseif(get_meta_option('pf_video_type')==2): ?>	

	<div class="video-wrap"><iframe class="video" src="http://www.youtube.com/embed/<?php echo get_meta_option('pf_video_id'); ?>?wmode=transparent" frameborder="0" width="711" height="400" allowfullscreen></iframe></div>

<?php else: ?>

<div id="jp_container_<?php the_ID(); ?>" class="jp-video">

    <div class="jp-type-single">

		<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>

		<div class="jp-gui">

			<div class="jp-interface">

				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>

				<div class="jp-controls-holder">
				
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
						<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
					</ul>
					
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>

					<ul class="jp-toggles">
						<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
						<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
					</ul>

				</div>

			</div>
		
		</div>

    </div>
</div>
  
<?php 

$m4v = get_meta_option('pf_m4v_source');
$webm = get_meta_option('pf_webm_source');
$ogv = get_meta_option('pf_ogv_source');
$poster=wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 

?>

<script>

jQuery(document).ready(function($){

 	$("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				<?php if($m4v != '') : ?>
				m4v: "<?php echo $m4v; ?>",
				<?php endif; ?>
				<?php if($webm = '') : ?>
				m4v: "<?php echo $webm; ?>",
				<?php endif; ?>
				<?php if($ogv != '') : ?>
				ogv: "<?php echo $ogv; ?>",
				<?php endif; ?>
				<?php if ($poster != '') : ?>
				poster: "<?php echo resize_image( get_post_thumbnail_id() ,700, 393 ); ?>"
				<?php endif; ?>
			});
		},
		play: function() { // To avoid both jPlayers playing together.
			$(this).jPlayer("pauseOthers");
		},
		swfPath: "<?php echo THEME_JS; ?>",
		supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($webm != '') : ?>webm, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all",
		cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
		size: {width: "100%",height: "100%"}
	});
	
	$(".jp-video img").css({width:'100%', height:'56.25%', display:'block'});
	
});

</script>


<?php endif; ?>


