<?php

function meta_options_cc() {

global $post;


$colCount=get_post_meta($post->ID, 'col-count', true);
$collayout=get_post_meta($post->ID, 'col-layout', true);
$layoutType=get_post_meta($post->ID, 'layout-type', true);

if($layoutType=='') $layoutType=16;

if(get_post_type()=='post') $layoutType=12;


?>

	<input type="hidden" name="cc_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
	
	<?php if(get_post_type()=='page'): ?>

	<select id="layout-type" name="layout-type">
	
		
		<?php if($layoutType=='16'): ?>
			<option selected="selected" value="16">Full Width</option>
		<?php else: ?>
			<option value="16">Full Width</option>	
		<?php endif; ?>
		
		<?php if($layoutType=='12'): ?>
			<option selected="selected" value="12">Sidebar</option>
		<?php else: ?>
			<option value="12">Sidebar</option>	
		<?php endif; ?>
	
	</select>
	
	<?php endif; ?>
	
	<div id="content_composer_wrap" data-layout="<?php echo $layoutType; ?>">
	
		<input id="col-count" name="col-count" value="<?php echo $colCount; ?>" type="hidden"/>
		<input id="col-layout" name="col-layout" value="<?php echo $collayout; ?>" type="hidden"/>
	
		
		<?php 
		
		$rows=explode('|',$collayout); 
		$i=1;
		
		if($collayout!='') foreach($rows as $row):
		
			$li='';
			$row_size=0;
			$cols=explode(',',$row); 
			
			foreach($cols as $col):
			
				switch ($col):
					case "33":
						$class_name='one_third'; $col_size=33; $col_desc='1/3';
					break;
					case "66":
						$class_name='two_third'; $col_size=66; $col_desc='2/3';
					break;
					case "1":
						$class_name='one'; $col_size=1; $col_desc='1/'.$layoutType;
					break;
					case "2":
						$class_name='two'; $col_size=2; $col_desc='2/'.$layoutType;
					break;
					case "3":
						$class_name='three'; $col_size=3; $col_desc='3/'.$layoutType;
					break;
					case "4":
						$class_name='four'; $col_size=4; $col_desc='4/'.$layoutType;
					break;
					case "5":
						$class_name='five'; $col_size=5; $col_desc='5/'.$layoutType;
					break;
					case "6":
						$class_name='six'; $col_size=6; $col_desc='6/'.$layoutType;
					break;
					case "7":
						$class_name='seven'; $col_size=7; $col_desc='7/'.$layoutType;
					break;
					case "8":
						$class_name='eight'; $col_size=8; $col_desc='8/'.$layoutType;
					break;
					case "9":
						$class_name='nine'; $col_size=9; $col_desc='9/'.$layoutType;
					break;
					case "10":
						$class_name='ten'; $col_size=10; $col_desc='10/'.$layoutType;
					break;
					case "11":
						$class_name='eleven'; $col_size=11; $col_desc='11/'.$layoutType;
					break;
					case "12":
						$class_name='twelve'; $col_size=12; $col_desc='12/'.$layoutType;
					break;
					case "13":
						$class_name='thirteen'; $col_size=13; $col_desc='13/'.$layoutType;
					break;
					case "14":
						$class_name='fourteen'; $col_size=14; $col_desc='14/'.$layoutType;
					break;
					case "15":
						$class_name='fifteen'; $col_size=15; $col_desc='15/'.$layoutType;
					break;
					case "16":
						$class_name='sixteen'; $col_size=16; $col_desc='16/'.$layoutType;
					break;
					
										
				endswitch;
				
	
				$row_size+=$col_size;
			
			
				$li.='<li data-id="'.$i.'" class="content_column '.$class_name.'_columns" data-size="'.$col_size.'"><span>'.$col_desc.'</span><div class="content_button content_close"></div><div class="content_button content_plus"></div><div class="content_button content_left"></div><div class="content_button content_right"></div><textarea class="hidden" name="content_textarea_'.$i.'">'.get_post_meta($post->ID, 'content_textarea_'.$i, true).'</textarea></li>';	
				
				$i++;

			endforeach;
			
			switch ($row_size):
				case "33":
				
					$row_rem=2; $row_context=12;
					
				break;
				case "66":
					$row_rem=1; $row_context=12;
				break;
				case "99":
					$row_rem=0; $row_context=12;
				break;
				default:
				
					if($layoutType==16){
					
						$row_rem=16-$row_size; $row_context=16;
					
					}
					else{
					
						$row_rem=12-$row_size; $row_context=16;
				
					}
			
				break;
			endswitch;
			
			echo '<ul class="content_row" data-remaining="'.$row_rem.'" data-context="'.$row_context.'">';
			echo $li;
			echo '</ul>';
		
		endforeach;
		
		

		?>

	
	</div>

	<input type="button" id="add_column" class="button-primary" value="Add Column"/>

	
	<?php
}

function create_meta_box_cc() {

	if ( function_exists('add_meta_box') ) {
		
		add_meta_box( 'add_cc_metabox', 'Layout Manager', 'meta_options_cc', 'post', 'normal', 'high' );
		add_meta_box( 'add_cc_metabox', 'Layout Manager', 'meta_options_cc', 'page', 'normal', 'high' );
		//add_meta_box( 'add_cc_metabox', 'Layout Manager', 'meta_options_cc', 'portfolio', 'normal', 'high' );
		
	}
}

add_action('admin_menu', 'create_meta_box_cc');


function save_layout_data($post_id) {

	global $post;
	

	// verify nonce
	if (!wp_verify_nonce($_POST['cc_meta_box_nonce'], 'cc.php')) {
		return $post_id;
	}


	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	$old = get_post_meta($post_id, 'col-count', true);
	$new = $_POST['col-count'];
	if ($new != $old) {
		update_post_meta($post_id, 'col-count', $new );
	} 
	
	$old = get_post_meta($post_id, 'col-layout', true);
	$new = $_POST['col-layout'];
	if ($new != $old) {
		update_post_meta($post_id, 'col-layout', $new );
	} 
	
	$old = get_post_meta($post_id, 'layout-type', true);
	$new = $_POST['layout-type'];
	if ($new != '' && $new != $old) {
		update_post_meta($post_id, 'layout-type', $new );
	} 
	
	for($i=1;$i<=get_post_meta($post_id, 'col-count', true);$i++){
	
		$old = get_post_meta($post_id, 'content_textarea_'.$i, true);
		$new = $_POST['content_textarea_'.$i];
		if ($new != '' && $new != $old) 
			update_post_meta($post_id, 'content_textarea_'.$i, $new );
		
		
	}
	

	
}

add_action('save_post', 'save_layout_data');

?>