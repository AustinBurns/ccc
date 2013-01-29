<!-- jplayer -->
<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>

<div id="jp_container_<?php the_ID(); ?>" class="jp-audio">

	<div class="jp-type-single">
	
		<div class="jp-gui jp-interface">

			<ul class="jp-controls">
				<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
				<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
				<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
				<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
			</ul>
			
			<div class="jp-progress">
				<div class="jp-seek-bar">
					<div class="jp-play-bar"></div>
				</div>
			</div>
			
			<div class="jp-volume-bar">
				<div class="jp-volume-bar-value"></div>
			</div>

		</div>

	</div>
</div><!-- end jplayer -->
  
<?php 

$mp3 = get_meta_option('pf_mp3_source');
$ogg = get_meta_option('pf_ogg_source');

?>
  
<script>
//<![CDATA[
jQuery(document).ready(function($){

 	$("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
			
				<?php if($mp3 != '') : ?>
				mp3: "<?php echo $mp3; ?>",
				<?php endif; ?>
				
				<?php if($ogg != '') : ?>
				oga: "<?php echo $ogg; ?>",
				<?php endif; ?>
			
				end: ""
			});
		},
		play: function() { // To avoid both jPlayers playing together.
			$(this).jPlayer("pauseOthers");
		},
		swfPath: "<?php echo THEME_JS; ?>/js",
		supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all",
		cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
		wmode: "window"
	});
});
//]]>
</script>
  