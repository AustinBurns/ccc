<?php

$options[] = array( "name" => "Footer",
					"type" => "heading"); 
				


$options[] = array( "name" => "Create Footer",
					"desc" => "enter the name of the footer and select the layout of the footer you'd like to create then click the 'Create Footer' button",
					"id" => THEME_SLUG."adm_custom_footers_name",
					"type" => "custom_footer");

$options[] = array(  "id" => THEME_SLUG."adm_custom_footers_layout");
					
					
$options[] =	array(
			"name" => "Copyright text",
			"desc" => "displayed at the bottom of the page",
			"id" => THEME_SLUG."copyright_text",
			"type" => "text"
		);
		
		
$social_icons=array('addthis',
'behance','blogger','deviantart','digg','dribbble','facebook','flickr','forrst','googleplus','instagram','lastfm','linkedin','livejournal','myspace','paypal','picasa','pinterest','reddit','rss','sharethis','skype','spotify','stumbleupon','tumblr','twitter','vimeo','wordpress','yelp','youtube'

);
					
$options[] = array(
			"name" => "Social Icons",
			"desc" => "multiselect by pressing Ctrl+Click or Cmd+Click and the selected fields will appear below",
			"id" => THEME_SLUG."social_icons",
			"options" => $social_icons,
			"type" => "multiselect"
		);

		

		
for($i=0; $i<count($social_icons); $i++)  {

$options[] = array(
			"name" => $social_icons[$i]." URL",
			"id" => THEME_SLUG."social_icons_".$social_icons[$i],
			"type" => "text",
			"class" => "social_icon social_icon_".$social_icons[$i]
		);
}
		


			
?>