<?php


 
global $options_at;

$options_at = array();


$options_at[] = array( "name" => "URL adress",
					"desc" => "used on slideshows, when you click on the slide image",
					"id" => "url_adress",
					"std" => "",
					"type" => "text"); 
					

					
					
function attachment_fields_to_edit($form_fields, $post) {  

	global $options_at;
	
	foreach($options_at as $option):
	
		$form_fields[$option['id']]["label"] = $option['name'];
		$form_fields[$option['id']]["input"] = "html";  
		$form_fields[$option['id']]["html"] = generate_html_option_attachment($option, $post);
		$form_fields[$option['id']]["helps"] = $option['desc'];
		
	endforeach;

	return $form_fields;  
	
}  

function generate_html_option_attachment($value, $post){

	$output='';

	switch($value['type']):
	
		case 'text':

			$val = get_post_meta($post->ID, $value['id'].'_value', true);

			
			$output .= '<input class="of-input" name="attachments['.$post->ID.']['. $value['id'] .']" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
			
		
		break;
		
		case 'textarea':
			
			$cols = '8';
			$ta_value = '';
			
			if(isset($value['std'])) {
				
				$ta_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
			
			$val = get_post_meta($post->ID, $value['id'].'_value', true);
			if( $val != "") { $ta_value = stripslashes( $val); }
			$output .= '<textarea name="attachments['.$post->ID.']['. $value['id'] .']" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
		
			
		break;
	
		case 'select':

			$output .= '<select class="of-input" name="attachments['.$post->ID.']['. $value['id'] .']" id="'. $value['id'] .'">';
		
			$selected_value = get_post_meta($post->ID, $value['id'].'_value', true);
			
			if(!$selected_value) $selected_value=$value['std'];
			
			$i=1;
		 
			foreach ($value['options'] as $option) {
			
				
				$selected = '';
				
				 if ( $selected_value == $i) { $selected = ' selected="selected"';} 

				  
				 $output .= '<option'. $selected .' value="'.$i.'">';
				 $output .= $option;
				 $output .= '</option>';
				 
				 $i++;
			 
			 } 
			 $output .= '</select>';


			
		break;

		case 'color':

			$output .= '<div class="colorpicker_wrap"><input type="text" id="colorpicker_'.$post->ID.'" class="colorpicker" name="attachments['.$post->ID.'][color]" value="'.(get_post_meta($post->ID, "color_value", true)?get_post_meta($post->ID, "color_value", true):'#ffffff')  .'" /><span></span><div id="picker_'.$post->ID.'" class="hidden picker"></div></div>';
			
		break;
		
		case "range":
					
			$output .= '<div class="range-input-container">';
			
			$output .= '<input type="range" name="attachments['.$post->ID.'][' . $value['id'] . ']" value="';
			
			$val = $value['std'];
			$std = get_post_meta($post->ID, $value['id'].'_value', true);

			if ( $std )  $val = $std; 
				
			$output .= $val;
			
			if (isset($value['min'])) $output .= '" min="' . $value['min'];
			if (isset($value['max'])) $output .= '" max="' . $value['max'];
			if (isset($value['step'])) $output .= '" step="' . $value['step'];
			
			$output .= '" />';
			
			if (isset($value['unit'])) $output .= '<span>' . $value['unit'] . '</span>';
			
			$output .= '</div>';
			
		break;

	endswitch;
	
	return $output;

}


function attachment_fields_to_save($post, $attachment) {  

	global $options_at;
	
	foreach($options_at as $option):
	
	    if( isset($attachment[$option['id']]) )  update_post_meta($post['ID'], $option['id'].'_value', $attachment[$option['id']]);  
  
	endforeach;
	
    return $post;  
}  



add_filter("attachment_fields_to_edit", "attachment_fields_to_edit", null, 2);  
add_filter("attachment_fields_to_save", "attachment_fields_to_save", null, 2);




?>