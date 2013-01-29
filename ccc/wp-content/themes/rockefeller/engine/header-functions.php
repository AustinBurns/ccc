<?php 
// get website title
if(!function_exists("if_document_title")){
	function if_document_title(){
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', THE_LANG ), max( $paged, $page ) );
	}// end if_document_title()
}

// head action hook
if(!function_exists("if_head")){
	function if_head(){
		do_action("if_head");
	}
	add_action('wp_head', 'if_head', 20);
}

if(!function_exists("if_metaviewport")){
	function if_metaviewport(){
		$dis_viewport = if_get_option(THE_SHORTNAME . '_disable_viewport');
		if(!$dis_viewport){
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
		}
	}
	add_action('if_head', 'if_metaviewport', 5);
}

if(!function_exists("if_print_headmiscellaneous")){
	function if_print_headmiscellaneous(){
	
		echo "<!--[if lt IE 9]>\n";
		echo "<script src='".THE_JSURI."html5shiv.js type='text/javascript'></script>\n";
		echo "<![endif]-->\n";

        $favicon = if_get_option( THE_SHORTNAME . '_favicon');
        if($favicon =="" ){
            $favicon = get_template_directory_uri() . '/images/favicon.ico';
        }
		echo '<link rel="shortcut icon" href="' . $favicon . '" />';
        
	}
	add_action('if_head', 'if_print_headmiscellaneous', 6);
}

// get style
if(!function_exists("if_print_stylesheet")){
	function if_print_stylesheet(){
	
		//Get Option Style
		$optBodyBG = if_get_option( THE_SHORTNAME . '_body_background');
		$optBodyBGColor = $optBodyBG['color'];
		$optBodyBGImage = $optBodyBG['image'];
		$optBodyBGPosition = $optBodyBG['position'];
		$optBodyBGStyle = $optBodyBG['repeat'];
		$optBodyBGattachment = $optBodyBG['attachment'];
		
		$optGeneralTextFont = if_get_option( THE_SHORTNAME . '_general_font');
		if($optGeneralTextFont!="0"){
			$GeneralTextFont = explode(":",$optGeneralTextFont);
			$GeneralTextOutput = "'". $GeneralTextFont[0] . "',";
		}
		
		$optBigTextFont = if_get_option( THE_SHORTNAME . '_bigtext_font');
		if($optBigTextFont!="0"){
			$BigTextFont = explode(":",$optBigTextFont);
			$BigTextOutput = "'". $BigTextFont[0] . "',";
		}
		
		$optHeadingFont = if_get_option( THE_SHORTNAME . '_heading_font');
		if($optHeadingFont!="0"){
			$HeadingFont = explode(":",$optHeadingFont);
			$HeadingOutput = "'". $HeadingFont[0] . "',";
		}
		
		$optMenuFont = if_get_option( THE_SHORTNAME . '_menunav_font');
		if($optMenuFont!="0"){
			$MenuFont = explode(":",$optMenuFont);
			$MenuOutput = "'". $MenuFont[0] . "',";
		}
		
		$txtContainerWidth = intval( if_get_option( THE_SHORTNAME . '_container_width') );
		$optionDefault = of_get_default_values();
		if($txtContainerWidth<940 || $txtContainerWidth >1140){
			$txtContainerWidth = $optionDefault[THE_SHORTNAME . '_container_width'];
		}
		
		$optHeaderPos = if_get_option( THE_SHORTNAME . '_header_position');
		
		//get background from metabox
		$prefix = 'if_';
		$custom = get_post_custom(get_the_ID());
		$cf_pagebgimg = (isset($custom[$prefix."page-bgimg"][0]))? $custom[$prefix."page-bgimg"][0] : "";
		$cf_pagebgposition = (isset($custom[$prefix."page-bgposition"][0]))? $custom[$prefix."page-bgposition"][0] : "";
		$cf_pagebgstyle = (isset($custom[$prefix."page-bgstyle"][0]))? $custom[$prefix."page-bgstyle"][0] : "";
		
		?>
		<style type="text/css" media="screen">
			body{
			<?php if($optGeneralTextFont!="0"){ ?>
				font-family: <?php echo $GeneralTextOutput; ?> sans-serif !important;
			<?php } ?>
			<?php if($cf_pagebgimg!=""){ ?>
				background-image:url(<?php echo $cf_pagebgimg ; ?>);
				background-repeat:<?php echo $cf_pagebgstyle ; ?>;
				background-position: <?php echo $cf_pagebgposition; ?>;
			
			<?php }else{ ?>
			
				<?php if($optBodyBGImage!="" || $optBodyBGColor!=""){?>
				background-color:<?php echo $optBodyBGColor ; ?>;
				background-image:url(<?php echo $optBodyBGImage ; ?>);
				background-repeat:<?php echo $optBodyBGStyle ; ?>;
				background-position: <?php echo $optBodyBGPosition; ?>;
				background-attachment: <?php echo $optBodyBGattachment ; ?>;
				<?php } ?>
				
			<?php } ?>
			}
			<?php if($optMenuFont!="0"){ ?>
			#topnav li a, #topnav li a:visited{font-family: <?php echo $MenuOutput; ?> sans-serif !important;}
			<?php } ?>
			<?php if($optHeadingFont!="0"){ ?>
			h1, h2, h3, h4, h5, h6{font-family: <?php echo $HeadingOutput; ?> sans-serif !important;}
			<?php } ?>
			<?php if($optBigTextFont!="0"){ ?>
			.bigtext{
				font-family: <?php echo $BigTextOutput; ?> sans-serif !important;
			}
			<?php } ?>
			#subbody .row{max-width:<?php echo $txtContainerWidth; ?>px;}
			#outerheader{position:<?php echo $optHeaderPos; ?>;}
        </style>
       <?php
		
	}// end function if_print_stylesheet
	add_action("if_head","if_print_stylesheet",7);
}

// print the logo html
if(!function_exists("if_logo")){
	function if_logo(){ 
	
		$logotype = if_get_option( THE_SHORTNAME . '_logo_type');
		$logoimage = if_get_option( THE_SHORTNAME . '_logo_image'); 
		$sitename =  if_get_option( THE_SHORTNAME . '_site_name');
		$tagline = if_get_option( THE_SHORTNAME . '_tagline');
		
		if($sitename=="") $sitename = get_bloginfo('name');
		if($tagline=="") $tagline = get_bloginfo('description'); 
		if($logoimage == "") $logoimage = get_stylesheet_directory_uri() . "/images/logo.png"; 
?>
		<?php if($logotype == 'textlogo'){ ?>
			
			<h1><a href="<?php echo home_url( '/'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', THE_LANG ) ); ?>"><?php echo $sitename; ?></a></h1><span class="desc"><?php echo $tagline; ?></span>
        
        <?php } else { ?>
        	
            <div id="logoimg">
            <a href="<?php echo home_url( '/' ) ; ?>" title="<?php echo $sitename; ?>" >
                <img src="<?php echo $logoimage ; ?>" alt="<?php echo $sitename; ?>" />
            </a>
            </div>
            
		<?php } ?>
        
<?php 
	}
}