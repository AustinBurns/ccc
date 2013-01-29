<?php 
/* print javascript in the footer */
if(!function_exists("if_print_javascript")){
	function if_print_javascript(){

		wp_reset_query();
		
		$sliderEffect = if_get_option( THE_SHORTNAME . '_slider_effect' ,'fade'); 
		$sliderInterval = if_get_option( THE_SHORTNAME . '_slider_interval' ,600);
		$sliderDisableNav = if_get_option( THE_SHORTNAME . '_slider_disable_nav');
		$sliderDisablePrevNext = if_get_option( THE_SHORTNAME . '_slider_disable_prevnext');
?>
<!-- Hook Flexslider -->
<script type="text/javascript">
jQuery(document).ready(function(){
    var slidereffect 			= '<?php echo $sliderEffect; ?>';
    var slider_interval 		= '<?php echo $sliderInterval; ?>';
    var slider_disable_nav 		= '<?php echo $sliderDisableNav; ?>';
    var slider_disable_prevnext	= '<?php echo $sliderDisablePrevNext; ?>';
    
    if(slider_disable_prevnext=="0"){
        var direction_nav = true;
    }else{
        var direction_nav = false;
    }
    
    if(slider_disable_nav=="0"){
        var control_nav = true;
    }else{
        var control_nav = false;
    }
        
    jQuery('.flexslider').flexslider({
        animation: slidereffect,
        animationDuration: slider_interval,
        directionNav: direction_nav,
        controlNav: control_nav,
        smoothHeight: true
    });
});

function isotopeinit(){
	var pffilter = jQuery('#if-pf-filter');
    pffilter.isotope({
        itemSelector : '.element'
    });
    
    jQuery('#filters li').click(function(){
        jQuery('#filters li').removeClass('selected');
        jQuery(this).addClass('selected');
        var selector = jQuery(this).find('a').attr('data-option-value');
        pffilter.isotope({ filter: selector });
        return false;
    });
}

jQuery(window).load(function(){
	isotopeinit();
});
</script>
<?php 
	}/* end if_print_javascript() */
	add_action("wp_footer","if_print_javascript",19);
}

	
/* get website title */
if(!function_exists("if_footer_text")){
	function if_footer_text(){
	
		$foot= stripslashes(if_get_option( THE_SHORTNAME . '_footer'));
		if($foot==""){
		
			_e('Copyright', THE_LANG ); echo ' &copy;';
			global $wpdb;
			$post_datetimes = $wpdb->get_results("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970");
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes[0]->firstyear;
				$lastpost_year = $post_datetimes[0]->lastyear;
	
				$copyright = $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';
	
				echo $copyright;
				echo '<a href="'.home_url( '/').'">'.get_bloginfo('name') .'.</a>';
			}
			?> 
        <?php 
		}else{
        	echo $foot;
        }
		
	}/* end if_footer_text() */
}