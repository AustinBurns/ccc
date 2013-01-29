<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php if_document_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
/* We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 */
if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */

wp_head(); /* the interfeis' custom content for wp_head is in includes/header-functions.php */
?>
</head><?php $bodyclass = "";  ?>
<body <?php body_class($bodyclass); ?>>


<div id="subbody">
	<div id="outercontainer">
    
        <!-- HEADER -->
        <div id="outerheader">
        	<?php
				$headerText = stripslashes(if_get_option( THE_SHORTNAME . '_header_text',''));
				$disable_topsearch = if_get_option(THE_SHORTNAME . '_disable_topsearch');
				$socialiconoutput = if_socialicon();
				if($headerText=="" && $disable_topsearch==true && $socialiconoutput==""){
					$emptyclass = "empty";
				}else{
					$emptyclass = "";
				}
			?>
        	<div id="headertext" class="container <?php echo $emptyclass; ?>">
            	<div class="row">
				<?php
				if($headerText) echo '<div class="alignleft">' . $headerText . '</div>'; 
				
				/*=====TOPSEARCH======*/
				if($disable_topsearch!=true){
				?>
                <form method="get" id="topsearchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="searcharea">
                        <input type="text" name="s" id="s" placeholder="<?php _e('Enter the keyword...', THE_LANG );?>" value="" />
                        <input type="submit" class="submit" name="submit" id="searchsubmit" value="" />
                    </div>
                </form>
                <?php 
				}
				
				/*=====SOCIALICON======*/
				$optdisableSocialIcon = if_get_option(THE_SHORTNAME . '_disable_socialicon');	
				if($optdisableSocialIcon!=true){				
					// get the social network icon
					$socialiconoutput = if_socialicon(); 
					echo $socialiconoutput;
				}
				?>
                <div class="clearfix"></div>
            	</div>
            </div>
        	<div id="top" class="container">
                <header class="row">
                    <div id="logo"><?php if_logo(); // print the logo html ?></div>
                    <section id="navigation">
                        <nav>
                        <?php wp_nav_menu( array(
                          'container'       => 'ul', 
                          'menu_class'      => 'sf-menu',
                          'menu_id'         => 'topnav', 
                          'depth'           => 0,
                          'sort_column'    => 'menu_order',
                          'fallback_cb'     => 'nav_page_fallback',
                          'theme_location' => 'mainmenu' 
                          )); 
                        ?>
                        </nav><!-- nav -->	
                        <div class="clearfix"></div>
                    </section>
                    <div class="clearfix"></div>
                </header>
            </div>
        </div>
        <!-- END HEADER -->

		<?php 
		$shortname = THE_SHORTNAME;

		$opt_bgHeader 		= if_get_option($shortname. '_header_background');
		
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
		
		if( is_home() ){
			$pid = get_option('page_for_posts');
		}else{
			$pid = get_the_ID();
		}

        $custom = get_post_custom($pid);
		if(isset($custom["show_breadcrumb"][0])){
			if($custom["show_breadcrumb"][0]=="true"){
				$showbc = true;
			}else{
				$showbc = false;
			}
		}
        $cf_enableSlider 	= (isset($custom["enable_slider"][0]))? $custom["enable_slider"][0] : "";
		$cf_sliderType 		= (isset($custom["slider_type"][0]))? $custom["slider_type"][0] : "";
		$cf_bgHeader 		= (isset($custom["bg_header"][0]))? $custom["bg_header"][0] : $cf_bgHeader;
		$cf_bgRepeat 		= (isset($custom["bg_repeat"][0]) && trim($custom["bg_repeat"][0])!="")? $custom["bg_repeat"][0] : $cf_bgRepeat;
		$cf_bgPos	 		= (isset($custom["bg_pos"][0]) && trim($custom["bg_pos"][0])!="")? $custom["bg_pos"][0] : $cf_bgPos;
		$cf_bgAttch	 		= (isset($custom["bg_attch"][0]) && trim($custom["bg_attch"][0])!="")? $custom["bg_attch"][0] : $cf_bgAttch;
		$cf_bgColor	 		= (isset($custom["bg_color"][0]) && trim($custom["bg_color"][0])!="")? $custom["bg_color"][0] : $cf_bgColor;
        
        if($cf_enableSlider=="true"&& !is_search()){
			
			if($cf_sliderType=="slider-parallax"){
				get_template_part( 'slider-parallax');
			}else{
				get_template_part( 'slider');
			}
			$issliderdisplayed = true;
			
        }else{
		
			$issliderdisplayed = false;
			
		}

		if( !$issliderdisplayed ){ 
			$style = 'style="';
			if($cf_bgHeader){
				$style .='background-image:url(' . $cf_bgHeader . ');';
			}
			$style .= 'background-repeat:' . $cf_bgRepeat . '; background-position:' . $cf_bgPos . '; background-color:' . $cf_bgColor . ';';
			$style .= '"';
		?>
        <!-- AFTER HEADER -->
        <div id="outerafterheader" class="<?php echo $emptyclass; ?>" <?php echo $style; ?>>
            <div class="container">
                <div id="afterheader" class="row">
                    <section id="aftertheheader">
						<?php
						if(function_exists('yoast_breadcrumb')){
						yoast_breadcrumb('<div class="breadcrumb twelvecol">','</div><div class="clearfix"></div>');
						}
						?>
						<?php  get_template_part( 'title');  ?>
                    </section>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- END AFTER HEADER -->
        <?php 
		}/* end if( !$issliderdisplayed ) */ 
		?>