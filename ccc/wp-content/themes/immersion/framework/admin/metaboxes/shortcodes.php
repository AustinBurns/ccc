<?php

global $shortcode_options;


$shortcode_options = array(	
    
	
			array(
				"name" => "Blog Posts",
				"id" => "blog-posts",
				"options" => array (
					array(
						"name" => "Categories",
						"id" => "cats",
						"type" => "multiselect_categories",
						"options"=> "category"
					),
					
			
					
				)
			),

		array(
				"name" => "Buttons",
				"id" => "button",
				"options" => array (
					array(
						"name" => "Text",
						"id" => "text",
						"type" => "text"
					),
					
					array(
						"name" => "Link",
						"id" => "link",
						"type" => "text"
					),
					
					array(
						"name" => "Color (optional)",
						"id" => "color",
						"type" => "select",
						"options" => array("...","blue","cyan","red","yellow","orange","purple","green","brown","pink","gray","black","gray"),
						"type" => "select"
					),
					
					array(
						"name" => "Full Width (optional)",
						"id" => "fullwidth",
						"options" => array("no","yes"),
						"type" => "select"
					)
					
				)
			),
	
			
	array(
				"name" => "Contact Form",
				"id" => "contactform",
				"options" => array (
					array(
						"name" => "Email (optional)",
						"id" => "email",
						"type" => "text",
						"desc" => "leave empty if you want the admin email to be used"
					)
				)
			),
			
	 array(
				  "name" => "Gallery",
				  "id" => "gallery",
				  "options" => array(

					  array(
						  "name" => "Galleries",
						  "id" => "cats",
						  "type" => "multiselect_galleries",
					  ),
		
		
					 
					 
		           ),
				   
	           ),
	
				 array(
				  "name" => "Google map",
				  "id" => "gmap",
				  "options" => array(

					  array(
						  "name" => "Longitude",
						  "id" => "longitude",
						  "type" => "text",
					  ),
					  
					   array(
						  "name" => "Latitude",
						  "id" => "latitude",
						  "type" => "text",
					  ),
					  
					   array(
						  "name" => "Zoom",
						  "id" => "zoom",
						  "type" => "range",
						  "min" => 0,
						  "max" => 15,
						  "step" => 1,
					  ),
					  
					   array(
						  "name" => "Height",
						  "id" => "height",
						  "type" => "range",
						  "min" => 0,
						  "max" => 1000,
						  "step" => 1,
					  ),
		
					    array(
						  "name" => "Popup content",
						  "id" => "popup",
						  "type" => "text",
					  ),
			
					
				
					 
		           ),
				   
	           ),
			   
	array(
		"name" => "Images",
		"id" => "images",
		"options" => array(
			
					array(
						"name" => "Image Atatchment ID",
						"desc" => "click browse and click the 'Insert ID' button",
						"id" => "id",
						"type" => "upload",
					),
					
					array(
						"name" => "Width (optional)",
						"desc" => "specify an image width in pixels",
						"id" => "width",
						"min" => 0,
						"max" => 800,
						"step" => "1",
						"type" => "range"
					),
					
						
					array(
						"name" => "Height (optional)",
						"id" => "height",
						"min" => 0,
						"max" => 800,
						"step" => "1",
						"type" => "range"
					),
						
										
					array(
						"name" => "Align (optional)",
						"desc" => "",
						"id" => "align",
						"type" => "select",
						"options" => array('none','left','right')
					),
					
						array(
						"name" => "Lightbox (optional)",
						"desc" => "",
						"id" => "lightbox",
						"type" => "select",
						"options" => array('no','yes')
					),
					
						array(
						"name" => "Link (optional)",
						"desc" => "if lightbox is on the link will open in a lightbox",
						"id" => "link",
						"type" => "text"
					),
					
					

									
		),
	),
			   
			
			array(
				"name" => "Latest Portfolio Projects",
				"id" => "portfolio-projects",
				"options" => array (
					array(
						"name" => "Categories",
						"id" => "cats",
						"type" => "multiselect_categories",
						"options"=> "portfolio_category"
					),
					
			
					
				)
			),
			
			array(
				"name" => "Portfolio",
				"id" => "portfolio",
				"options" => array (
					array(
						"name" => "Categories",
						"id" => "cats",
						"type" => "multiselect_categories",
						"options"=> "portfolio_category"
					),
					
			
					
				)
			),
			
			
			array(
				"name" => "Pricing Table",
				"id" => "pricing_table",
				"options" => array (
					array(
						"name" => "Columns",
						"id" => "columns",
						"min" => 2,
						"max" => 5,
						"step" => "1",
						"type" => "range"
					),
					
					array(
						"name" => "1. Plan Name",
						"id" => "plan_name_1",
						"type" => "text"
					),
					
					array(
						"name" => "1. Plan Price",
						"id" => "plan_price_1",
						"type" => "text"
					),
					
					array(
						"name" => "1. Per",
						"id" => "plan_per_1",
						"type" => "text"
					),
					
					array(
						"name" => "1. Description",
						"id" => "plan_description_1",
						"type" => "text"
					),
					
					array(
						"name" => "1. Link Name",
						"id" => "plan_linkname_1",
						"type" => "text"
					),
					
					array(
						"name" => "1. Link",
						"id" => "plan_link_1",
						"type" => "text"
					),
					
					array(
						"name" => "1. Featured",
						"id" => "plan_featured_1",
						"type" => "select",
						"options" => array('no','yes')
					),
					
					array(
						"name" => "1. Color",
						"id" => "plan_color_1",
						"type" => "color"
					),
					
					array(
						"name" => "1. Features",
						"id" => "plan_features_1",
						"type" => "textarea"
					),
					
					
					
					
					
					array(
						"name" => "2. Plan Name",
						"id" => "plan_name_2",
						"type" => "text"
					),
					
					array(
						"name" => "2. Plan Price",
						"id" => "plan_price_2",
						"type" => "text"
					),
					
					array(
						"name" => "2. Per",
						"id" => "plan_per_2",
						"type" => "text"
					),
					
					array(
						"name" => "2. Description",
						"id" => "plan_description_2",
						"type" => "text"
					),
					
					array(
						"name" => "2. Link Name",
						"id" => "plan_linkname_2",
						"type" => "text"
					),
					
					array(
						"name" => "2. Link",
						"id" => "plan_link_2",
						"type" => "text"
					),
					
					array(
						"name" => "2. Featured",
						"id" => "plan_featured_2",
						"type" => "select",
						"options" => array('no','yes')
					),
					
					array(
						"name" => "2. Color",
						"id" => "plan_color_2",
						"type" => "color"
					),
					
					array(
						"name" => "2. Features",
						"id" => "plan_features_2",
						"type" => "textarea"
					),
					
						array(
						"name" => "3. Plan Name",
						"id" => "plan_name_3",
						"type" => "text"
					),
					
					array(
						"name" => "3. Plan Price",
						"id" => "plan_price_3",
						"type" => "text"
					),
					
					array(
						"name" => "3. Per",
						"id" => "plan_per_3",
						"type" => "text"
					),
					
					array(
						"name" => "3. Description",
						"id" => "plan_description_3",
						"type" => "text"
					),
					
					array(
						"name" => "3. Link Name",
						"id" => "plan_linkname_3",
						"type" => "text"
					),
					
					array(
						"name" => "3. Link",
						"id" => "plan_link_3",
						"type" => "text"
					),
					
					array(
						"name" => "3. Featured",
						"id" => "plan_featured_3",
						"type" => "select",
						"options" => array('no','yes')
					),
					
					array(
						"name" => "3. Color",
						"id" => "plan_color_3",
						"type" => "color"
					),
					
					array(
						"name" => "3. Features",
						"id" => "plan_features_3",
						"type" => "textarea"
					),
					
					
					
					
					array(
						"name" => "4. Plan Name",
						"id" => "plan_name_4",
						"type" => "text"
					),
					
					array(
						"name" => "4. Plan Price",
						"id" => "plan_price_4",
						"type" => "text"
					),
					
					array(
						"name" => "4. Per",
						"id" => "plan_per_4",
						"type" => "text"
					),
					
					array(
						"name" => "4. Description",
						"id" => "plan_description_4",
						"type" => "text"
					),
					
					array(
						"name" => "4. Link Name",
						"id" => "plan_linkname_4",
						"type" => "text"
					),
					
					array(
						"name" => "4. Link",
						"id" => "plan_link_4",
						"type" => "text"
					),
					
					array(
						"name" => "4. Featured",
						"id" => "plan_featured_4",
						"type" => "select",
						"options" => array('no','yes')
					),
					
					array(
						"name" => "4. Color",
						"id" => "plan_color_4",
						"type" => "color"
					),
					
					array(
						"name" => "4. Features",
						"id" => "plan_features_4",
						"type" => "textarea"
					),
					
					
									array(
						"name" => "5. Plan Name",
						"id" => "plan_name_5",
						"type" => "text"
					),
					
					array(
						"name" => "5. Plan Price",
						"id" => "plan_price_5",
						"type" => "text"
					),
					
					array(
						"name" => "5. Per",
						"id" => "plan_per_5",
						"type" => "text"
					),
					
					array(
						"name" => "5. Description",
						"id" => "plan_description_5",
						"type" => "text"
					),
					
					array(
						"name" => "5. Link Name",
						"id" => "plan_linkname_5",
						"type" => "text"
					),
					
					array(
						"name" => "5. Link",
						"id" => "plan_link_5",
						"type" => "text"
					),
					
					array(
						"name" => "5. Featured",
						"id" => "plan_featured_5",
						"type" => "select",
						"options" => array('no','yes')
					),
					
					array(
						"name" => "5. Color",
						"id" => "plan_color_5",
						"type" => "color"
					),
					
					array(
						"name" => "5. Features",
						"id" => "plan_features_5",
						"type" => "textarea"
					),
					
					
					
					
					)),
			
			
	
				array(
				"name" => "Slideshow",
				"id" => "slideshow",
				"options" => array (
					array(
						"name" => "Gallery",
						"id" => "cats",
						"type" => "select_posts",
						"options"=> "gallery"
					),
					
					array(
						"name" => "Height",
						"id" => "height",
						"min" => 0,
						"max" => 800,
						"step" => "1",
						"type" => "range"
						
					),
					
			
					
				)
			),
			
			
			array(
				"name" => "Slogan",
				"id" => "slogan",
				"options" => array (
					array(
						"name" => "Content",
						"id" => "content",
						"type" => "textarea",
					),
					
			
					
				)
			),		
	
			   	
	array(
		"name" => "Typography",
		"id" => "typography",
		"subtype" => "yes",
		"options" => array(
			
			array(
				"name" => "Block Quotes",
				"id" => "blockquote",
				"options" => array (
				
					array(
						"name" => "Content",
						"id" => "content",
						"type" => "textarea"
					),

				)
			),
			
			array(
				"name" => "Highlight",
				"id" => "highlight",
				"options" => array (
					array(
						"name" => "Content",
						"id" => "content",
						"type" => "textarea"
					),
					array(
						"name" => "Color (optional)",
						"id" => "color",
						"options" => array(
						    "...",
							"black",
							"gray",
							"red",
							"yellow",
							"blue",
							"pink",
							"green",
							"orange",
							"magenta",
						),
						"type" => "select",
					),
				)
				
			),
			
			array(
				"name" => "Dropcap",
				"id" => "dropcap",
				"options" => array (
					array(
						"name" => "Text",
						"id" => "text",
						"type" => "text"
					),
				)
			),
			
			
			
			
			
		),
	),
	
		array(
				"name" => "Tabs",
				"id" => "tabs",
				"options" => array (
					array(
						"name" => "Count",
						"id" => "count",
						"min" => 2,
						"max" => 8,
						"step" => "1",
						"type" => "range"
					),
					
					array(
						"name" => "Tab Title 1",
						"id" => "tab_title_1",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 1",
						"id" => "tab_content_1",
						"type" => "textarea"
					),
					
					array(
						"name" => "Tab Title 2",
						"id" => "tab_title_2",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 2",
						"id" => "tab_content_2",
						"type" => "textarea"
					),
					
										array(
						"name" => "Tab Title 3",
						"id" => "tab_title_3",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 3",
						"id" => "tab_content_3",
						"type" => "textarea"
					),
					
										array(
						"name" => "Tab Title 4",
						"id" => "tab_title_4",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 4",
						"id" => "tab_content_4",
						"type" => "textarea"
					),
					
										array(
						"name" => "Tab Title 5",
						"id" => "tab_title_5",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 5",
						"id" => "tab_content_5",
						"type" => "textarea"
					),
					
										array(
						"name" => "Tab Title 6",
						"id" => "tab_title_6",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 6",
						"id" => "tab_content_6",
						"type" => "textarea"
					),
					
										array(
						"name" => "Tab Title 7",
						"id" => "tab_title_7",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 7",
						"id" => "tab_content_7",
						"type" => "textarea"
					),
					
										array(
						"name" => "Tab Title 8",
						"id" => "tab_title_8",
						"type" => "text"
					),
					
					array(
						"name" => "Tab Content 8",
						"id" => "tab_content_8",
						"type" => "textarea"
					),
					
										
					
					
					
					
				)
			),
	
	array(
				"name" => "Toggles",
				"id" => "toggles",
				"options" => array (
					array(
						"name" => "Title",
						"id" => "title",
						"type" => "text"
					),
					
					array(
						"name" => "Content",
						"id" => "content",
						"type" => "textarea"
					),
					
					array(
						"name" => "Hidden",
						"id" => "hidden",
						"type" => "select",
						"options" => array('yes','no')
					),
					
				)
			),
	

	array(
		"name" => "Videos",
		"id" => "videos",
		"subtype" => "yes",
		"options" => array(
			array(
				"name" => "YouTube",
				"id" => "youtube",
				"options" => array(
					array(
						"name" => "Video ID",
						"desc" => "the id from the video's URL (http://www.youtube.com/watch?v=<span style='color:red'>d0vXxH1IEmQ</span>)",
						"id" => "id",
						"type" => "text",
					),
					
				),
			),
			array(
				"name" => "Vimeo",
				"id" => "vimeo",
				"options" => array(
					array(
						"name" => "Video ID",
						"desc" => "the id from the video's URL (http://vimeo.com/<span style='color:red'>123456</span>)",
						"id" => "id",
						"type" => "text",
					),
					
				),
			),

		),
	),
	
	
	
	

	
	
	
	
	
	
	
	
);				



function meta_options_shortcode($shortcode_options) {
	

	
	global $shortcode_options;
	
	echo '<div>
			<table class="metabox_table">
				<tr>
					<th><h4><label>Shortcode</label></h4></th>
					<td><select id="first_sc_select">
							<option value="none">select the shortcode</option>';
	
							foreach($shortcode_options as $shortcode) 
									echo '<option value="'.$shortcode['id'].'">'.$shortcode['name'].'</option>';
							
	
				echo '</select>
					</td>
				</tr>
				
			
			</table>
		</div>';
	
	foreach($shortcode_options as $shortcode):
	
			echo '<div class="first_sc_container first_sc_container_'.$shortcode['id'].'">';
			
			if(!isset($shortcode['subtype'])):
							
			    echo '<table class="metabox_table">';
				foreach($shortcode['options'] as $option):
					
					echo '<tr>';
					echo '<th><h4>'.$option['name'].'</h4></th>';
					
					echo '<td class="option">';
					$option['id']='sc_'.$shortcode['id'].'_'.$option['id'];
					
					renderHTML($option);
					
					echo '</td>';

					if(!isset($option['desc'])) $option['desc']='';

					echo '<td class="description">'.$option['desc'].'</td>';
					echo '</tr>';
					
				endforeach;
				echo '</table>';
				
			else:
			
				echo '<div>
						<table class="metabox_table">
							<tr><th><h4><label>Type</label></h4></th>
							<td><select class="secondary_sc_select secondary_sc_select_'.$shortcode['id'].'">
									<option value="none">...</option>';
									
									foreach($shortcode['options'] as $secondary_shortcode)
										echo '<option value="'.$secondary_shortcode['id'].'">'.$secondary_shortcode['name'].'</option>';
								
				
							echo '</select>
								 </td>
								</tr>
							</table>
						</div>';
				
				foreach($shortcode['options'] as $secondary_shortcode):
					echo '<div class="secondary_sc_container secondary_sc_container_'.$secondary_shortcode['id'].'">
							<table class="metabox_table">';
							
							foreach($secondary_shortcode['options'] as $option):
								
								echo '<tr>';
								echo '<th><h4>'.$option['name'].'</h4></th>';
								
								echo '<td class="option">';
								$option['id']='sc_'.$shortcode['id'].'_'.$secondary_shortcode['id'].'_'.$option['id'];
								
								renderHTML($option);
								
								echo '</td>';

								if(!isset($option['desc'])) $option['desc']='';

								echo '<td class="description">'.$option['desc'].'</td>';
								echo '</tr>';
							  
							endforeach;
					echo '</table>
						</div>';
				endforeach;
		
			endif;
			
			echo '</div>';
		endforeach;
		
		echo '<input id="generate_code" class="button-primary"  value="Generate Code"/>';
	
		
		echo '<table class="metabox_table">
				<tr>
					<th><h4><label>Generated Code</label></h4></th>
					<td><textarea id="generated-code"></textarea></td>
				</tr>
			</table>';
		
		
		



}

function create_meta_box_shortcode() {

	if ( function_exists('add_meta_box') ) {
		
		add_meta_box( 'add_shortcode_metabox', 'Add Shortcode', 'meta_options_shortcode', 'post', 'normal', 'high' );
		add_meta_box( 'add_shortcode_metabox', 'Add Shortcode', 'meta_options_shortcode', 'page', 'normal', 'high' );
		add_meta_box( 'add_shortcode_metabox', 'Add Shortcode', 'meta_options_shortcode', 'portfolio', 'normal', 'high' );
	}
}

add_action('admin_menu', 'create_meta_box_shortcode');




function renderHTML($opt){
	
	    $output='';
	
		switch($opt['type']):
		case 'select':
		
			$output .= '<select id="'. $opt['id'] .'">';
		
			foreach ($opt['options'] as $option) {
				
				 $output .= '<option>';
				 $output .= $option;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;
		
		case 'text':

			$output .= '<input id="'. $opt['id'] .'" value="" />';
			
		break;
		case 'textarea':
			
			$output .= '<textarea id="'. $opt['id'] .'"></textarea>';
			
		break;
		
		
		
		case 'upload':
		
		    $output .= '<div class="op_upload_wrap" >';
			$output .= '<input id="'. $opt['id'] .'" value="" />';
			$output .= '<button class="button-primary">Browse</button>';
			$output .= '</div>';
		
		break;
		case "range":
			
			$output .= '<div class="range-input-container">';
			
			$output .= '<input id="'. $opt['id'].'" type="range" ';
			
			if (isset($opt['min'])) $output .= '" min="' . $opt['min'];
			if (isset($opt['max'])) $output .= '" max="' . $opt['max'];
			if (isset($opt['step'])) $output .= '" step="' . $opt['step'];
			$output .= '" />';
			
			if (isset($opt['unit'])) $output .= '<span>' . $opt['unit'] . '</span>';
			
			$output .= '</div>';
			
	    break;
		
		case 'multiselect_portfolio':

		   $args = array("hide_empty" => 1,"taxonomy" => "portfolio_category");  
		   
		   $of_categories_obj = get_categories($args);


		   
		   $output .='<select style="height:120px;" id="'. $opt['id'] .'" multiple="multiple">';
		   foreach ($of_categories_obj as $of_cat):
			  


				$output .= '<option value="'.$of_cat->cat_ID.'">'.$of_cat->cat_name.'</option>';
				 
		   endforeach;
		   $output .='</select>';
		   
		break;
		
		case 'multiselect_categories':

		   $args = array("hide_empty" => 1,"taxonomy" => $opt['options']);  
		   $categories_obj = get_categories($args);

		   $output .='<select style="height:120px;" id="'. $opt['id'] .'" multiple="multiple">';
		   foreach ($categories_obj as $cat):
			  
				$output .= '<option value="'.$cat->cat_ID.'">'.$cat->cat_name.'</option>';
				 
		   endforeach;
		   $output .='</select>';
		   
		break;
		
		case 'multiselect_galleries':

		   $args = array("post_type" => "gallery", "numberposts" => "-1");           
		   
		   $of_categories_obj = get_posts($args);


		   
		   $output .='<select style="height:120px;" id="'.$opt['id'].'" multiple="multiple">';
		   foreach ($of_categories_obj as $of_cat):
			  


				$output .= '<option value="'.$of_cat->ID.'">'.$of_cat->post_title.'</option>';
				 
		   endforeach;
		   $output .='</select>';
		   
		break;
		
		case "color":

			$output .= '<div id="'. $opt['id'] .'_picker" class="colorPicker"></div>';
			$output .= '<input id="'. $opt['id'] .'" type="text" value="#333333" /><div class="colorSelector"></div>';
			
			$output .= "<script>
			jQuery(document).ready( function($) {
			
				$('#".$opt['id']."_picker').farbtastic('#".$opt['id']."');
			
			});
			</script>";
		
		break; 
		
		case "select_posts":

			$args = array("post_type" => $opt['options'], "numberposts" => "-1");                    

		  	$posts_obj = get_posts($args);
		   
			$output .= '<select id="'. $opt['id'] .'">';
				 
			foreach ($posts_obj  as $cat) {
				
				 $output .= '<option value="'.$cat->ID.'">';
				 $output .= $cat->post_title;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';
			
	    break;
		


	endswitch;
	
	echo $output;
}







?>