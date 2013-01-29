<?php

		

function create_meta_options($post, $metabox) {

	global $post;
	
	$output= '<input type="hidden" name="mytheme_meta_box_nonce" value="'. wp_create_nonce(basename(__FILE__)). '" />';
        
    $counter = 0;
	$menu = '';

	foreach ($metabox['args']['var1'] as $value) {
	   
		$counter++;
		$val = '';
		//Start Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class_string=''; 
			
			if(isset( $value['class'] )) {
			
				$class = $value['class']; 				
				$class=explode(' ',$class);

				foreach($class as $c) $class_string.='op_'.$c.' ';
				
			}
			
			$output .= '<div class="section section-'.$value['type'].' '. $class_string .'">'."\n";
			$output .= '<table class="metabox_table">'; 
			$output .= '<tr><th>'; 
			$output .= '<h4 class="heading">'. $value['name'] .'</h4>'."\n";
			$output .= '</th>'; 
			$output .= '<td class="option">'; 


		 } 
		 //End Heading
		 
		 
		$meta_box_value = get_post_meta($post->ID, $value['id'].'_value', true);
	    //if($meta_box_value == "") $meta_box_value = $value['std'];
		 
		$select_value = '';     
	
		
	switch ( $value['type'] ) :
	
		case 'text':
			//$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			
			$output .= '<input class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $meta_box_value .'" />';
			
		
		break;
		
		case 'select':

			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$selected_value = get_post_meta($post->ID, $value['id'].'_value', true);
			

			
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
		
		case 'select_letters':

			$output .= '<select name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$selected_value = get_post_meta($post->ID, $value['id'].'_value', true);
					 
			foreach ($value['options'] as $option) {
			
				
				$selected = '';
				
				 if ( $selected_value == $option) { $selected = ' selected="selected"';} 

				  
				 $output .= '<option'. $selected .' value="'.$option.'">';
				 $output .= $option;
				 $output .= '</option>';
				 
			 
			 } 
			 $output .= '</select>';


			
		break;
		
		case 'toggle':
		
			$post_meta=get_post_meta($post->ID, $value['id'].'_value', true);
						
			if(isset($value['std'])) if($value['std']=='on') $checked=' checked="checked"';
			if(isset($value['std'])) if($value['std']=='off') $checked='';
			if($post_meta=='on') $checked=' checked="checked"';
			if($post_meta=='off') $checked='';
		
			$output .= '<input name="'.$value['id'].'" type="checkbox" class="ibutton" '.$checked.'/>';
		
		break;
		
		case 'multiselect':

		   $of_categories_obj = get_categories('hide_empty=0');

		   $output .='<select style="height:5.5em;width:300px;" name="'.$value['id'].'" id="'.$value['id'].'" class="widefat" multiple="multiple">';
		   foreach ($of_categories_obj as $of_cat):
				 $output .= '<option'. $selected .' value="'.$of_cat->cat_ID.'">'.$of_cat->cat_name.'</option>';
		   endforeach;
		   $output .='</select>';
		break;
		
		case 'multiselect_post_categories':

		   $args = array("hide_empty" => 0);  
		   
		   $of_categories_obj = get_categories($args);

		   $post_meta=get_post_meta($post->ID, $value['id'].'_value', true);
		   if($post_meta=='') $post_meta=explode(',',$post_meta);
		   

		   
		   $output .='<select style="height:120px;" name="'.$value['id'].'[]" id="'.$value['id'].'" class="widefat of-input" multiple="multiple">';
		   foreach ($of_categories_obj as $of_cat):
			  
				$selected='';
				if($post_meta!=null) 
				
					foreach ($post_meta as $a => $b):

						if($b==$of_cat->cat_ID) $selected = ' selected="selected"';
				
					endforeach;

				$output .= '<option'. $selected .' class="of-input" value="'.$of_cat->cat_ID.'">'.$of_cat->cat_name.'</option>';
				 
		   endforeach;
		   $output .='</select>';
		break;
		
		case 'multiselect_portfolio_categories':

		   $args = array("hide_empty" => 1,"taxonomy" => "portfolio_category");  
		   
		   $of_categories_obj = get_categories($args);

		   $post_meta=get_post_meta($post->ID, $value['id'].'_value', true);
		   
		   $output .='<select style="height:120px;" name="'.$value['id'].'[]" id="'.$value['id'].'" class="widefat of-input" multiple="multiple">';
		   foreach ($of_categories_obj as $of_cat):
			  
				$selected='';
					if($post_meta) 
					foreach ($post_meta as $a => $b):

						if($b==$of_cat->cat_ID) $selected = ' selected="selected"';
				
					endforeach;

				$output .= '<option'. $selected .' class="of-input" value="'.$of_cat->cat_ID.'">'.$of_cat->cat_name.'</option>';
				 
		   endforeach;
		   $output .='</select>';
		   
		break;
		
		case 'multiselect_gallery':

		   $args = array("hide_empty" => 1,"taxonomy" => "gallery_category");  
		   
		   $of_categories_obj = get_categories($args);

		   $post_meta=get_post_meta($post->ID, $value['id'].'_value', true);
		   
		   $output .='<select style="height:120px;" name="'.$value['id'].'[]" id="'.$value['id'].'" class="widefat of-input" multiple="multiple">';
		   foreach ($of_categories_obj as $of_cat):
			  
				$selected='';
					if($post_meta) 
					foreach ($post_meta as $a => $b):

						if($b==$of_cat->cat_ID) $selected = ' selected="selected"';
				
					endforeach;

				$output .= '<option'. $selected .' class="of-input" value="'.$of_cat->cat_ID.'">'.$of_cat->cat_name.'</option>';
				 
		   endforeach;
		   $output .='</select>';
		   
		break;
		
		case 'gallery_items':
		
			if($meta_box_value!='' ) $meta_box_array=explode(',',$meta_box_value);
						
			$output.='<input id="gallery_upload" class="button-primary" value="Upload">';
			
			$output.='<ul class="gallery_items_wrap">';
			
			if(isset($meta_box_array))
			
				foreach($meta_box_array as $id):
				
					$image_wp = wp_get_attachment_image_src($id,'thumbnail', true);
					$output.='<li><img data-image="'.$id.'" src="'.$image_wp[0].'"/><div class="image_remove hidden"></li>';
				
				endforeach;

			$output.='</ul>';	
			
			$output.='<input id="gallery_items" class="hidden" type="text" value="'.$meta_box_value.'" name="gallery_items">';

		break;
		
		case "range":
			
			$output .= '<div class="range-input-container">';
			
			$output .= '<input type="range" name="' . $value['id'] . '" value="';
			
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
		
		

		
		case 'select_sidebar':
		

			$sidebars = get_theme_option('custom_sidebars');


			if(!empty($sidebars)) $sidebars_array = explode(',',$sidebars);
		
			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';

			$selected_value = get_post_meta($post->ID, $value['id'].'_value', true);



			$output .= '<option value="off">off</option>';

			if(!empty($sidebars)) foreach ($sidebars_array as $option) {

				$selected = '';
				if ( $selected_value == $option) { $selected = ' selected="selected"';} 
				$output .= '<option'. $selected .' value="'.$option.'">';
				$output .= $option;
				$output .= '</option>';
			} 
			$output .= '</select>';

		break;
		
		case 'select_footer':
		

			$footers = get_theme_option("adm_custom_footers_name");
			
			$custom_footer_layout=get_theme_option("adm_custom_footers_layout");

			$footers_array=array();
			if(!empty($footers)) $footers_array = explode(',',$footers);
			if(!empty($custom_footer_layout)) $custom_footer_layout_array = explode(',',$custom_footer_layout);
		
			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';

			$selected_value = get_post_meta($post->ID, $value['id'].'_value', true);


			for($i=0;$i<count($footers_array)-1; $i++) {
			
				$selected = '';
				if ( $selected_value == $footers_array[$i]) { $selected = ' selected="selected"';} 
				$output .= '<option'. $selected .' value="'.$footers_array[$i].','.$custom_footer_layout_array[$i].'">';
				$output .= $footers_array[$i];
				$output .= '</option>';
			
			}
			
			$output .= '</select>';

		break;
		
		case 'select_slideshow':
		
		   $args = array("post_type" => "gallery", "numberposts" => "-1");                    

		   $posts_obj = get_posts($args);
		   
			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$selected_value = get_post_meta($post->ID, $value['id'].'_value', true);
						
			if($value['id']=='back_gallery' || $value['id']=='back_slideshow'){
			
				if($selected_value=='default') $output .= '<option selected="selected" value="default">default</option>';
				else $output .= '<option value="default">default</option>';
			
			} 
			

			
	
			 
			foreach ($posts_obj  as $cat) {
				
				$selected = '';
				
				 if ( $selected_value == $cat->ID) { $selected = ' selected="selected"';} 

				  
				 $output .= '<option'. $selected .' value="'.$cat->ID.'">';
				 $output .= $cat->post_title;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;
		
		case 'select_booklet':
		
		   $args = array("post_type" => "booklet", "numberposts" => "-1");                    

		   $posts_obj = get_posts($args);
		   
			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$selected_value = get_post_meta($post->ID, $value['id'].'_value', true);
			

			 
			foreach ($posts_obj  as $cat) {
				
				$selected = '';
				
				 if ( $selected_value == $cat->ID) { $selected = ' selected="selected"';} 

				  
				 $output .= '<option'. $selected .' value="'.$cat->ID.'">';
				 $output .= $cat->post_title;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
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
			
			$std = get_option($value['id']);
			if( $std != "") { $ta_value = stripslashes( $std ); }
			$output .= '<textarea class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$meta_box_value.'</textarea>';
		
			
		break;
		case "radio":
			
			 $select_value = get_option( $value['id']);
				   
			 foreach ($value['options'] as $key => $option) 
			 { 

				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .= '<input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			
			}
			 
		break;
		case "checkbox": 
		
		   $std = $value['std'];  
		   
		   $saved_std = get_option($value['id']);
		   
		   $checked = '';
			
			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox of-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;
		case "multicheck":
		
			$std =  $value['std'];         
			
			foreach ($value['options'] as $key => $option) {
											 
			$of_key = $value['id'] . '_' . $key;
			$saved_std = get_option($of_key);
					
			if(!empty($saved_std)) 
			{ 
				  if($saved_std == 'true'){
					 $checked = 'checked="checked"';  
				  } 
				  else{
					  $checked = '';     
				  }    
			} 
			elseif( $std == $key) {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';                                                                                    }
			$output .= '<input type="checkbox" class="checkbox of-input" name="'. $of_key .'" id="'. $of_key .'" value="true" '. $checked .' /><label for="'. $of_key .'">'. $option .'</label><br />';
										
			}
			
		
		break;
		
		
		case 'upload':
		
		    $output .= '<div class="op_upload_wrap" >';
			$output .= '<input id="'.$value['id'].'" name="'.$value['id'].'" value="'.get_meta_option($value['id']).'" />';
			$output .= '<button class="button-primary">Browse</button>';
			$output .= '</div>';
		
		break;
		case "upload_min":
			
			$output .= optionsframework_uploader_function($value['id'],$value['std'],'min');
			
		break;
		case "color":
			$val = $value['std'];
			$stored  = get_option( $value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="of-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $meta_box_value .'" />';
		break;   

		
		case "images":
			$i = 0;
			$select_value = get_option( $value['id']);
				   
			foreach ($value['options'] as $key => $option) 
			 { 
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; } 
					} else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						else { $checked = ''; }
					}	
				
				$output .= '<span>';
				$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="of-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
				$output .= '</span>';
				
			}
		
		break; 
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;                                   
		
		case "heading":
			
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;   
								   
	endswitch;
		

	   
	    $output .= '</td>';

	   if(!isset($value['desc']) ) $value['desc']='';

		$output .= '<td class="description">'. $value['desc'] .'</td>';
		$output .= '</tr></table></div>';
	}
    

	
	echo $output;

}





?>