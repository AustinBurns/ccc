<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */

$footcol_scheme = array(
	'1;twelvecol',
	'2;threecol-ninecol last',
	'2;sixcol-sixcol last',
	'2;ninecol-threecol last',
	'3;threecol-sixcol-threecol last',
	'3;threecol-threecol-sixcol last',
	'3;sixcol-threecol-threecol last',
	'3;fourcol-fourcol-fourcol last',
	'4;threecol-threecol-threecol-threecol last'
);

$shortname = THE_SHORTNAME;

$opt_footerLayout = intval(if_get_option($shortname. '_footer_sidebar_layout',8));

$disablefootersidebar = if_get_option($shortname. '_disable_footer_sidebar');

$opt_bgFooter 		= if_get_option($shortname. '_footer_background');

$cf_bgFooter 		= "";
$cf_bgRepeatFooter	= "repeat";
$cf_bgPosFooter		= "center";
$cf_bgColorFooter	= "transparent";

if( $opt_bgFooter ){
	if($opt_bgFooter["image"]!=""){
		$cf_bgFooter 	= $opt_bgFooter["image"];
	}
	$cf_bgRepeatFooter	= $opt_bgFooter["repeat"];
	$cf_bgPosFooter		= $opt_bgFooter["position"];
	$cf_bgAttchFooter	= $opt_bgFooter["attachment"];
	$cf_bgColorFooter	= ($opt_bgFooter["color"]!="")? $opt_bgFooter["color"] : "#333333";
}

$custom = get_post_custom(get_the_ID());
$cf_footerLayout	= (isset($custom["layout_footer"][0]) && (intval($custom["layout_footer"][0])>=0 && intval($custom["layout_footer"][0])<=8) )? intval($custom["layout_footer"][0]) : $opt_footerLayout; 
$cf_bgFooter 		= (isset($custom["bg_footer"][0]))? $custom["bg_footer"][0] : $cf_bgFooter;
$cf_bgRepeatFooter	= (isset($custom["bg_repeat_footer"][0]) && trim($custom["bg_repeat_footer"][0])!="")? $custom["bg_repeat_footer"][0] : $cf_bgRepeatFooter;
$cf_bgPosFooter		= (isset($custom["bg_pos_footer"][0]) && trim($custom["bg_pos_footer"][0])!="")? $custom["bg_pos_footer"][0] : $cf_bgPosFooter	;
$cf_bgColorFooter	= (isset($custom["bg_color_footer"][0]) && trim($custom["bg_color_footer"][0])!="")? $custom["bg_color_footer"][0] : $cf_bgColorFooter;

$footcol = explode(';',$footcol_scheme[$cf_footerLayout]);
$footclass = explode('-',$footcol[1]);

$style = 'style="';
if($cf_bgFooter){
	$style .='background-image:url(' . $cf_bgFooter . ');';
}
$style .= 'background-repeat:' . $cf_bgRepeatFooter . '; background-position:' . $cf_bgPosFooter . '; background-color:' . $cf_bgColorFooter . ';';
$style .= '"';
?>
	<div id="footerwrapper" <?php echo $style; ?>>
<?php
if(!$disablefootersidebar){
?>			
        <!-- FOOTER SIDEBAR -->
        <div id="outerfootersidebar">
        	<div class="container">
                <div id="footersidebarcontainer" class="row"> 
                    <footer id="footersidebar">
                    <?php for($i=0;$i<$footcol[0];$i++){ $numfootcol = $i+1; ?>
                    
                    <div id="footcol<?php echo $numfootcol; ?>"  class="<?php echo $footclass[$i]; ?>">
                        <div class="widget-area">
                            <?php if ( ! dynamic_sidebar( 'footer'.$numfootcol ) ) : ?><?php endif; // end general widget area ?>
                        </div>
                    </div>
                    
                    <?php } ?>
                        <div class="clearfix"></div>
                    </footer>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- END FOOTER SIDEBAR -->
<?php
}
?>
        <!-- FOOTER -->
        <div id="outerfooter">
        	<div class="container">
                <div id="footercontainer" class="row">
                    <footer id="footer">
                        <div class="copyright"><?php if_footer_text(); ?></div>
                        <nav id="footermenu">
                        <?php wp_nav_menu( array(
                          'container'       => 'ul', 
                          'menu_class'      => 'footermenu',
                          'menu_id'         => 'footernav', 
                          'depth'           => 1,
                          'sort_column'    => 'menu_order',
                          'theme_location' => 'footermenu' 
                          )); 
                        ?>
                        </nav><!-- nav -->	
                        <div class="clearfix"></div>
                    </footer>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- END FOOTER -->
	</div>
        
	</div><!-- end bodychild -->
</div><!-- end outercontainer -->
<?php 
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
	
	$trackingcode = stripslashes(if_get_option( THE_SHORTNAME . '_trackingcode'));
	if($trackingcode!=""){
		echo '<script type="text/javascript">';
		echo $trackingcode;
		echo '</script>';
	}
?>
</body>
</html>
