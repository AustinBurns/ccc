<?php

$options[] = array( "name" => "General",
					"type" => "heading");
					
$options[] = array( "name" => "Accent color",
					"desc" => "",
					"id" => THEME_SLUG."color_scheme",
					"std" => "#0073fe",
					"type" => "color"); 
					
 				
$options[] = array( "name" => "Custom Favicon",
					"desc" => "upload a 16x16 pixels png/gif image with your desired favicon",
					"id" => THEME_SLUG."favicon",
					"type" => "upload");  

		
$options[] = array( "name" => "Tracking Code",
					"desc" => "paste your Google Analytics tracking code here",
					"id" => THEME_SLUG."google_analytics",
					"type" => "textarea");  
					

		
$options[] = array( "name" => "Custom CSS",
					"desc" => "paste your custom css code here",
					"id" => THEME_SLUG."custom_css",
					"type" => "textarea"); 
									
									
					
?>