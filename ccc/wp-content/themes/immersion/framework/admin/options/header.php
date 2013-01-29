<?php

$options[] = array( "name" => "Header",
					"type" => "heading"); 
					

					
$options[] = array( "name" => "Logo",
					"desc" => "upload the logo",
					"id" => THEME_SLUG."logo_image",
					"std" => "",
					"type" => "upload_min");   
					

		
$options[] =array(
			"name" => "Logo left position",
			"desc" => "left coordinate of the logo",
			"id" => THEME_SLUG."logo_left",
			"min" => "1",
			"max" => "400",
			"step" => "1",
			"std" => "0",
			"type" => "range",
			"unit" => "px"
		);
		
$options[] =array(
			"name" => "Logo top position",
			"desc" => "top coordinate of the logo",
			"id" => THEME_SLUG."logo_top",
			"min" => "1",
			"max" => "400",
			"step" => "1",
			"std" => "0",
			"type" => "range",
			"unit" => "pixels"
		);
		



?>