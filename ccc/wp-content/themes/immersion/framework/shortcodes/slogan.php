<?php
function add_shortcode_slogan($atts, $content = null) {

	$output='';
	
	
	$output.='<div class="slogan">'.$content.'</div>';
		
	$output.='<script>
	
		jQuery(document).ready(function($) {
		
			var str = $(".slogan").html();
			$(".slogan").html(""); 
			var spans = "<span>" + str.split(" ").join(" </span><span>") + "</span>";
			
			$(spans).hide().css({opacity:0}).appendTo(".slogan").each(function(index){
			
				$(this).css({display:"inline"}).delay(Math.random()*2000).animate({opacity:1},400,"easeOutCubic");

			});
			
			 
		});
		
		</script>';
		
	
	return $output;

	
	
}

add_shortcode('slogan', 'add_shortcode_slogan');
?>
