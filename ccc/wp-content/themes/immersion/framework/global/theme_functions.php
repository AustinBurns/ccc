<?php

function tf_title(){

	$title = wp_title( '|', false, 'right' );
	$title.=get_bloginfo('name');

	if ( is_front_page() ) $title= get_bloginfo('name')." | ".get_bloginfo( 'description' );

	echo $title;

}




function tf_get_title(){

	if(is_archive()){
							
			if(is_category())  $page_title = __('Category Archives: ',THEME_SLUG).sprintf('<span>%s</span>',single_cat_title('',false));  
			elseif(is_tag())  $page_title = __('Tag Archives: ',THEME_SLUG). sprintf('<span>%s</span>',single_tag_title('',false));  
			elseif(is_day())  $page_title = __('Archives: ',THEME_SLUG). sprintf('<span>%s</span>',get_the_time('F jS, Y'));  
			elseif(is_month())  $page_title = __('Archives: ',THEME_SLUG). sprintf('<span>%s</span>',get_the_time('F, Y'));  
			elseif(is_year())  $page_title = __('Archives: ',THEME_SLUG). sprintf('<span>%s</span>',get_the_time('Y'));  

			
		}
		elseif (is_404()) $page_title = __('404 - Not Found',THEME_SLUG); 
		elseif (is_search()) $page_title = __('Search results: ',THEME_SLUG). sprintf('<span>%s</span>',stripslashes( strip_tags( get_search_query() ) )); 
		
	if(is_tax( 'portfolio_category' )) $page_title = sprintf('%s',single_cat_title('',false));   
		

	echo $page_title; 

		
		

}



function tf_the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			return mb_substr( $subex, 0, $excut );
		} else {
			return $subex;
		}

	} else {
		return $excerpt;
	}
}

function tf_get_excerpt($post_id){
	global $wpdb;
	$query = 'SELECT post_excerpt FROM '. $wpdb->posts .' WHERE ID = '. $post_id .' LIMIT 1';
	$result = $wpdb->get_results($query, ARRAY_A);
	$post_excerpt=$result[0]['post_excerpt'];
	return $post_excerpt;
}


function tf_get_gallery_images(){



	$category=get_theme_option('default_gallery');
	if(get_meta_option('back_slideshow')=='off') return;
	if(get_meta_option('back_slideshow')!='default' && is_numeric(get_meta_option('back_slideshow'))) $category=get_meta_option('back_slideshow');
	
	$category=get_meta_option('gallery_items', $category);
	$atts=explode(',', $category);
	
	foreach( $atts as $att ):
	
		$att=get_post($att);
		
		$images[] = array(
			'title' => get_the_title($att->ID),
			'src' => get_image_url($att->ID),
			'description' => $att->post_content,
			'url'  => get_meta_option('url_adress', $att->ID),
			);

	endforeach;

	return $images;

}


function tf_supersized(){

if(get_meta_option('show_bg')=='off') return false;



$images=tf_get_gallery_images();
if(count($images)==0) return;	


if(count($images)>1): ?>

<div id="left_arrow"></div>
<div id="right_arrow"></div>
	
<?php endif; ?>

<?php if(get_meta_option('show_captions')=='on'): ?>

<div id="slidecaption">

	<h3></h3>
	
	<p></p>
	
	<?php if(get_meta_option('show_read_more')=='on'): ?>
	
		<div id="down_arrow"><?php _e('read more...', THEME_SLUG); ?></div>
		
	<?php endif; ?>
	
</div>

<?php endif; ?>

<ul id="slide-list"></ul>

<script>
	
	jQuery(document).ready(function($) {
	
	jQuery(function($){
		
		$.supersized({
		
			// Functionality	
			<?php if(get_theme_option('slide_autoplay')=='yes'): ?>
			autoplay:1,
			<?php else: ?>
			autoplay:0,
			<?php endif; ?>
			
			slide_interval          :   <?php echo get_theme_option('slide_interval'); ?>,		// Length between transitions
			transition              :   <?php echo get_theme_option('slide_effect'); ?>, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed		:	800,		// Speed of transition
			keyboard_nav            :   1,			// Keyboard navigation on/off
			performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)				
								   
			// Components							
			slide_links				:	'blank',	// Individual links for each slide (Options: false, 'number', 'name', 'blank')

			slides 					:  	[			// Slideshow Images
			
			
			<?php $i=0; foreach( $images as $image ):  ?>
				{image : '<?php echo $image['src']; ?>', title : '<?php echo $image['title']; ?>', desc: '<?php echo $image['description']; ?>', url:'<?php echo $image['url']; ?>' }
			<?php 
				$i++;
				if($i!=count($images)) echo ',';
				endforeach;  ?>

										],

			
		});
		
		
	});
	
	});
	
</script>

<?php

}




add_action('widgets_init', 'tf_register_sidebars');


$tf_sidebars = array('Post Sidebar','Page Sidebar');
$tf_footer_sidebars_number = 0;

function tf_register_sidebars(){

	global $tf_sidebars, $tf_footer_sidebars;

	foreach ($tf_sidebars as $sidebar){
	
		$name=explode(' ',$sidebar);
	
		register_sidebar(array(
			'name' => $sidebar,
			'description' => 'will be displayed on a created '.$name[0],
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="line_sep"></div>',
			'before_title' => '<h5 class="widget_title">',
			'after_title' => '</h5>',
		));
		
	}
		

		
	//register footer sidebars
	$custom_footers_names=get_theme_option("adm_custom_footers_name");
	$custom_footers_layout=get_theme_option("adm_custom_footers_layout");


	if($custom_footers_names!=''){
	
		$custom_footers_names = explode(',',$custom_footers_names);
		$custom_footers_layout = explode(',',$custom_footers_layout);
		
		for($i=0; $i<count($custom_footers_names)-1; $i++){
		
			$layout=$custom_footers_layout[$i];
			
			switch ($layout):
				case 1:  $nr_columns=1;  break;
				case 2:  $nr_columns=2;  break;
				case 3:  $nr_columns=3;   break;
				case 4:  $nr_columns=2;   break;
				case 5:  $nr_columns=2;   break;
				case 6:  $nr_columns=4;   break;
				case 7:  $nr_columns=3;   break;
				case 8:  $nr_columns=3;   break;
				case 9:  $nr_columns=3;   break;
				case 10:  $nr_columns=2;   break;
				case 11:  $nr_columns=2;   break;
			endswitch;
			
			for($j=1; $j<=$nr_columns; $j++){
			
				register_sidebar(array(
					'name' =>  $custom_footers_names[$i].' '.$j.' column',
					'description' => 'column number '.$j.' of the footer with the name: '.$custom_footers_names[$i],
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h5 class="widget_title">',
					'after_title' => '</h5><div class="widget_sep"></div>',
				));
			
			}
		
		}
			
	}
	
	//register custom sidebars
	$custom_sidebars=get_theme_option('custom_sidebars');
	if(!empty($custom_sidebars)) $custom_sidebars_array = explode(',',$custom_sidebars);
	
	if(!empty($custom_sidebars)){

		for($i=0; $i<count($custom_sidebars_array)-1; $i++){
		
			register_sidebar(array(
				'name' =>  $custom_sidebars_array[$i].' - Custom Sidebar',
				'description' => '',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h5 class="widget_title">',
				'after_title' => '</h5>',
			));
		
		}
		
	}
	
}

function tf_get_sidebar(){

	$page_type= get_meta_option('theme_page_type');

	$post_type=get_post_type();
	
	global $tf_sidebars,$post;
				 
	if($post_type=='post' || $page_type==2)	$sidebar = $tf_sidebars[0];		 
	elseif($post_type=='page') $sidebar = $tf_sidebars[1];
	
	$custom = get_post_meta($post->ID, 'custom_sidebar_value', true);
	
	if( $custom && $custom!='off') $sidebar = $custom.' - Custom Sidebar';
	
	dynamic_sidebar($sidebar);
	
}



function custom_css() {

	$logo_left=get_theme_option('logo_left');
	$logo_top=get_theme_option('logo_top');
	
	$color_scheme=get_theme_option('color_scheme');
	
	$custom_css=get_theme_option('custom_css');
	



    ?>
<style>

#logo{

left:<?php echo $logo_left; ?>px;
top:<?php echo $logo_top; ?>px;

}

a:hover, a:focus { color: <?php echo $color_scheme; ?>; }

#header #nav > li > a:hover{

color: <?php echo $color_scheme; ?>;

}

#nav li ul.sub-menu{

border-top:2px solid <?php echo $color_scheme; ?>;

}

#nav li ul.sub-menu > span{


border-bottom: 6px solid <?php echo $color_scheme; ?>;


}

#nav li ul.sub-menu > li a:hover{

color: <?php echo $color_scheme; ?>;


}

.pagination a.current{

color:<?php echo $color_scheme; ?>;

}

.meta_wrap li.entry_comments a:hover, .meta_wrap li.entry_categories a:hover {

color: <?php echo $color_scheme; ?>;

}

#bottom_wrap a:hover{

color:<?php echo $color_scheme; ?>;

}

aside a:hover{

color: <?php echo $color_scheme; ?> !important;

}

#bottom_wrap ul.posts li .post_title:hover{

color: <?php echo $color_scheme; ?>;

}

<?php echo $custom_css; ?>


</style>
<?php
}
add_action( 'wp_head', 'custom_css' );





?>
