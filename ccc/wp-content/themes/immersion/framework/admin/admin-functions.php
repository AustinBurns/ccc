<?php


/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/

function of_head() { do_action( 'of_head' ); }

/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/

function of_style_path() {
    $style = $_REQUEST['style'];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = get_option('of_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	add_action('admin_head','of_option_setup');
}

function of_option_setup(){

	//Update EMPTY options
	$of_array = array();
	add_option('of_options',$of_array);

	$template = get_option('of_template');
	$saved_options = get_option('of_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$of_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$of_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$of_array[$id] = $db_option;
			}
		}
	}
	update_option('of_options',$of_array);
}

//other conditional tags
function of_is_admin_panel() {
	if ('admin.php' == basename($_SERVER['PHP_SELF'])) return true;
	return false;
}

function of_is_post_page(){

	if( of_is_post_new() || of_is_post_edit() ) return true;
	return false;
}




function of_is_post_new() {

	if ('post-new.php' == basename($_SERVER['PHP_SELF'])) return true; 
	return false;
	
}


function of_is_post_edit() {

	if ('post.php' == basename($_SERVER['PHP_SELF']) &&  $_GET['action']=='edit' ) return true;  
	return false;

}
function of_is_attachment() {

	if ('media.php' == basename($_SERVER['PHP_SELF']) || 'media-upload.php' == basename($_SERVER['PHP_SELF'])  ) return true;  
	return false;

}



?>