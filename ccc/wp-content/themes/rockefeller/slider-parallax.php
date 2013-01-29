<?php
$sliderarrange = if_get_option( THE_SHORTNAME . '_slider_arrange');
$sliderDisableText = if_get_option( THE_SHORTNAME . '_slider_disable_text');

$opt_bgHeader 		= if_get_option(THE_SHORTNAME. '_header_background');

$cf_bgHeader 		= "";
$cf_bgRepeat 		= "repeat";
$cf_bgPos	 		= "center";
$cf_bgAttch	 		= "";
$cf_bgColor	 		= "transparent";
		
if( $opt_bgHeader){
	if($opt_bgHeader["image"]!=""){
		$cf_bgHeader 	= $opt_bgHeader["image"];
	}
	$cf_bgRepeat 		= $opt_bgHeader["repeat"];
	$cf_bgPos	 		= $opt_bgHeader["position"];
	$cf_bgAttch	 		= $opt_bgHeader["attachment"];
	$cf_bgColor	 		= ($opt_bgHeader["color"]!="")? $opt_bgHeader["color"] : "transparent";
}

$prefix = 'if_';
$custom = get_post_custom(get_the_ID());
$cf_sliderID 		= (isset($custom["slider_id"][0]))? $custom["slider_id"][0] : "";
$cf_bgHeader 		= (isset($custom["bg_header"][0]))? $custom["bg_header"][0] : $cf_bgHeader;
$cf_bgRepeat 		= (isset($custom["bg_repeat"][0]) && trim($custom["bg_repeat"][0])!="")? $custom["bg_repeat"][0] : $cf_bgRepeat;
$cf_bgPos	 		= (isset($custom["bg_pos"][0]) && trim($custom["bg_pos"][0])!="")? $custom["bg_pos"][0] : $cf_bgPos;
$cf_bgAttch	 		= (isset($custom["bg_attch"][0]) && trim($custom["bg_attch"][0])!="")? $custom["bg_attch"][0] : $cf_bgAttch;
$cf_bgColor	 		= (isset($custom["bg_color"][0]) && trim($custom["bg_color"][0])!="")? $custom["bg_color"][0] : $cf_bgColor;

if($cf_sliderID!=""){
	$SliderIDInclude = '&p='. $cf_sliderID ;
}else{
	$SliderIDInclude = "";
}


$style = 'style="';
if($cf_bgHeader){
	$style .='background-image:url(' . $cf_bgHeader . ');';
}
$style .= 'background-repeat:' . $cf_bgRepeat . '; background-position:' . $cf_bgPos . '; background-color:' . $cf_bgColor . ';';
$style .= '"';
?>
<!-- SLIDER -->
<div id="outerslider" class="parallax" <?php echo $style; ?>>
    <div id="slidercontainer">
        <section id="slider">
			<?php
			query_posts('post_type=slider-view'.$SliderIDInclude.'&post_status=publish');
			while ( have_posts() ) : the_post();
            
            echo the_content();
            
            endwhile;
            wp_reset_query();
            ?>
            <div class="clearfix"></div>
        </section>
        <div class="clearfix"></div>
    </div>
</div>
<!-- END SLIDER -->