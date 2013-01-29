<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	$shortname = THE_SHORTNAME;
	
	$optLogotype 	= array(
		'imagelogo' 	=> __('Image logo', THE_LANG),
		'textlogo' 		=> __('Text-based logo', THE_LANG)
		 );
	
	$optHeaderPos 	= array(
		'fixed' 	=> __('Fixed', THE_LANG),
		'absolute' 	=> __('Absolute', THE_LANG)
		 );
	
	$google_api_output = if_googlefontjson();
	$google_font_array = json_decode ($google_api_output,true) ;
	//print_r( json_decode ($google_api_output) );
	
	$items = $google_font_array['items'];
	
	$optGoogleFonts = array();
	array_push($optGoogleFonts, "Default Font");
	$fontID = 0;
	foreach ($items as $item) {
		$fontID++;
		$variants='';
		$variantCount=0;
		foreach ($item['variants'] as $variant) {
			$variantCount++;
			if ($variantCount>1) { $variants .= '|'; }
			$variants .= $variant;
		}
		$variantText = ' (' . $variantCount . ' Variants' . ')';
		if ($variantCount <= 1) $variantText = '';
		$optGoogleFonts[ $item['family'] . ':' . $variants ] = $item['family']. $variantText;
	}
	
	$optArrSlider 	= array(
		'ASC' => 'Ascending',
		'DESC' => 'Descending'
		 );
	
	$optSliderEffect 	= array(
			'fade'=>'Fade',
			'slide'=>'Slide'
   			 );

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll'
	);
	             
	$optBackgroundStyle = array(
		'repeat' => "Repeat",
		'repeat-x' => "Repeat Horizontal",
		'repeat-y' => "Repeat Vertical",
		'no-repeat' => "No Repeat",
		'fixed' => "Fixed"
		);
		
	$optBackgroundPosition = array(
	'left' => "Left",
	'center' => "Center",
	'right' => "Right",
	'top left' => "Top",
	'top center' => "Top Center",
	'top right' => "Top Right",
	'bottom left' => "Bottom",
	'bottom center' => "Bottom Center",
	'bottom right' => "Bottom Right"
	);
	
	$selectTextDefault = array(
		'text' => '',
		'select' => ''
	);
	
	$optSocialIcons = array();
	
	if(function_exists('if_readsocialicon')){
		$optSocialIcons = if_readsocialicon();
	}
	

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array( 'name' => __('General Settings', THE_LANG),
		'type' => 'heading');
	
	$options[] = array( 'name' => __('Layout Settings', THE_LANG),
		'type' => 'headingchild');
	
	$options[] = array( 'name' => __('Sidebar Position', THE_LANG),
		'desc' => __('Select sidebar position. Default sidebar is right.', THE_LANG),
		'id' => $shortname."_sidebar_position",
		'std' => 'right',
		'type' => 'images',
		'options' => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png')
	);
	
	$options[] = array( 'name' => __('Footer Sidebar Layout', THE_LANG),
		'desc' => __('Select footer sidebar layout. Default sidebar is four column.', THE_LANG),
		'id' => $shortname."_footer_sidebar_layout",
		'std' => '8',
		'type' => 'images',
		'options' => array(
			'0' => $imagepath . 'footer-0.gif',
			'1' => $imagepath . 'footer-1.gif',
			'2' => $imagepath . 'footer-2.gif',
			'3' => $imagepath . 'footer-3.gif',
			'4' => $imagepath . 'footer-4.gif',
			'5' => $imagepath . 'footer-5.gif',
			'6' => $imagepath . 'footer-6.gif',
			'7' => $imagepath . 'footer-7.gif',
			'8' => $imagepath . 'footer-8.gif'
		)
	);
	
	$options[] = array( 'name' => __(' ', THE_LANG),
		'type' => 'separator');
	
	$options[] = array( 'name' => __('Header Settings', THE_LANG),
		'type' => 'headingchild');
	
	$options[] = array( 'name' => __('Disable Responsive Feature?', THE_LANG),
		'desc' => __('Select this checkbox to disable the responsive website feature.', THE_LANG),
		'id' => $shortname."_disable_viewport",
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array( 'name' => __('Disable Top Search Form Feature?', THE_LANG),
		'desc' => __('Select this checkbox to disable the top search form feature.', THE_LANG),
		'id' => $shortname."_disable_topsearch",
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array( 'name' => __('Logo Type', THE_LANG),
		'desc' => __('If text-based logo is activated, enter the logo name and logo tagline in the fields below.', THE_LANG),
		'id' => $shortname."_logo_type",
		'std' => 'imagelogo',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $optLogotype);
	
	$options[] = array( 'name' => __('Logo Name', THE_LANG),
		'desc' => __('Put your logo name in here.', THE_LANG),
		'id' => $shortname."_site_name",
		'std' => '',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Logo Tagline', THE_LANG),
		'desc' => __('Put your tagline in here.', THE_LANG),
		'id' => $shortname."_tagline",
		'std' => '',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Logo Image', THE_LANG),
		'desc' => __('If image logo is activated, upload the logo image.', THE_LANG),
		'id' => $shortname."_logo_image",
		'type' => 'upload');
	
	$options[] = array( 'name' => __('Favicon', THE_LANG),
		'desc' => __('Upload the favicon image.', THE_LANG),
		'id' => $shortname."_favicon",
		'type' => 'upload');
	
	$options[] = array( 'name' => __('Footer Settings', THE_LANG),
		'type' => 'headingchild');
	
	$options[] = array( 'name' => __('Disable Footer Sidebar?', THE_LANG),
		'desc' => __('Select this checkbox to disable footer sidebar feature.', THE_LANG),
		'id' => $shortname."_disable_footer_sidebar",
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array( 'name' => __('Footer Text', THE_LANG),
		'desc' => __('You can use html tag in here.', THE_LANG),
		'id' => $shortname."_footer",
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array( 'name' => __('Tracking Code', THE_LANG),
		'desc' => __('Enter your tracking code here.', THE_LANG),
		'id' => $shortname."_trackingcode",
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array( 'name' => __('Style Settings', THE_LANG),
		'type' => 'heading');
	
	$options[] = array( 'name' => __('Container\'s Width', THE_LANG),
		'desc' => __('Set the length of your container\'s width between 940px - 1140px', THE_LANG),
		'id' => $shortname."_container_width",
		'std' => '940',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Header\'s Position', THE_LANG),
		'desc' => __('Set the position of your header', THE_LANG),
		'id' => $shortname."_header_position",
		'std' => 'fixed',
		'class' => 'mini',
		'type' => 'select',
		'options' => $optHeaderPos);
	
	$options[] = array( 'name' => __('General Fonts', THE_LANG),
		'desc' => __('Choose the font for general purpose.', THE_LANG),
		'id' => $shortname."_general_font",
		'std' => 'Open Sans:300|300italic|regular|italic|600|600italic|700|700italic|800|800italic',
		'type' => 'select',
		'options' => $optGoogleFonts);
		
	$options[] = array( 'name' => __('Bigtext Shortcode Fonts', THE_LANG),
		'desc' => __('Choose the font for [bigtext] shortcode.', THE_LANG),
		'id' => $shortname."_bigtext_font",
		'std' => '',
		'type' => 'select',
		'options' => $optGoogleFonts);
	
	$options[] = array( 'name' => __('Heading Fonts', THE_LANG),
		'desc' => __('Choose the font for h1, h2, h3, h4, h5, h6.', THE_LANG),
		'id' => $shortname."_heading_font",
		'std' => '',
		'type' => 'select',
		'options' => $optGoogleFonts);
	
	$options[] = array( 'name' => __('Menu Navigation Fonts', THE_LANG),
		'desc' => __('Choose the font for main menu.', THE_LANG),
		'id' => $shortname."_menunav_font",
		'std' => '',
		'type' => 'select',
		'options' => $optGoogleFonts);
		
	$options[] = array( 'name' =>  __('Background Settings', THE_LANG),
	'desc' => __('Change the background CSS.', THE_LANG),
	'id' => $shortname."_body_background",
	'std' => $background_defaults,
	'type' => 'background');
	
	$options[] = array( 'name' =>  __('Background Header', THE_LANG),
	'desc' => __('Change the background on header.', THE_LANG),
	'id' => $shortname."_header_background",
	'std' => $background_defaults,
	'type' => 'background');
	
	$options[] = array( 'name' =>  __('Background Footer', THE_LANG),
	'desc' => __('Change the background on footer.', THE_LANG),
	'id' => $shortname."_footer_background",
	'std' => $background_defaults,
	'type' => 'background');
	
	$options[] = array( 'name' => __('Social Network', THE_LANG),
		'type' => 'heading');
		
	
	$options[] = array( 'name' => __('Social Icon', THE_LANG),
		'type' => 'headingchild');
	
	for($i=1;$i<=count($optSocialIcons);$i++){
		$options[] = array( 'name' => __('Social Icon', THE_LANG)." ".$i,
			'desc' => __('Please choose your social icon and input the URL in textbox.', THE_LANG),
			'id' => $shortname."_socialicon_".$i,
			'std' => $selectTextDefault,
			'class' => 'mini',
			'type' => 'selecttext',
			'options' => $optSocialIcons);
	}
	
	
	$options[] = array( 'name' => __('Slider Settings', THE_LANG),
		'type' => 'heading');
	
	$options[] = array( 'name' => __('Arrange Slider Post', THE_LANG),
		'desc' => __('Select the order for your slider. the default is Ascending', THE_LANG),
		'id' => $shortname."_slider_arrange",
		'std' => 'ASC',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $optArrSlider);
	
	$options[] = array( 'name' => __('Slider Effect', THE_LANG),
		'desc' => __('Please select transition effect. The default is fade', THE_LANG),
		'id' => $shortname."_slider_effect",
		'std' => 'slide',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $optSliderEffect);
	
	$options[] = array( 'name' => __('Slider Interval', THE_LANG),
		'desc' => __('Please enter number for slider interval. Default is 600', THE_LANG),
		'id' => $shortname."_slider_interval",
		'std' => '1000',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Disable Slider Text', THE_LANG),
		'desc' => __('Select this checkbox to disable the slider text.', THE_LANG),
		'id' => $shortname."_slider_disable_text",
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array( 'name' => __('Disable Slider Navigation', THE_LANG),
		'desc' => __('Select this checkbox to disable navigation.', THE_LANG),
		'id' => $shortname."_slider_disable_nav",
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array( 'name' => __('Disable Slider Previous/Next Navigation', THE_LANG),
		'desc' => __('Select this checkbox to disable previous/next navigation.', THE_LANG),
		'id' => $shortname."_slider_disable_prevnext",
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array( 'name' => __('Miscellaneous', THE_LANG),
		'type' => 'heading');
		
	$options[] = array( 'name' => __('Header text', THE_LANG),
		'desc' => __('Put your text for header text.', THE_LANG),
		'id' => $shortname."_header_text",
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array( 'name' => __('Demo Switcher', THE_LANG),
		'desc' => __('Select this checkbox to enable the switcher feature.', THE_LANG),
		'id' => $shortname."_enable_switcher",
		'std' => '0',
		'type' => 'checkbox');
		
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}