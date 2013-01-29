<?php

/*********For Localization**************/
load_theme_textdomain( THE_LANG, get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);
/*********End For Localization**************/

if( !function_exists('if_register_font') ){
	function if_register_font ( $sectionName ) {		
		$got_font=of_get_option($sectionName);
		
		if ($got_font!="0") {
			$font_pieces = explode(":", $got_font);
			
			$font_name = $font_pieces[0];
			$font_name = str_replace (" ","+", $font_pieces[0] );
			
			if( isset($font_pieces[1]) ){
				$font_variants = $font_pieces[1];
				$font_variants = ":" . str_replace ("|",",", $font_pieces[1] );
			}else{
				$font_variants = "";
			}
			
			wp_register_style( $sectionName, 'http://fonts.googleapis.com/css?family='.$font_name . $font_variants );
			return true;
		}else{
			return false;
		}
		
	}
}

// The excerpt based on character
if(!function_exists("if_string_limit_char")){
	function if_string_limit_char($excerpt, $substr=0, $strmore = "..."){
		$string = strip_tags(str_replace('...', '...', $excerpt));
		if ($substr>0) {
			$string = substr($string, 0, $substr);
		}
		if(strlen($excerpt)>=$substr){
			$string .= $strmore;
		}
		return $string;
	}
}
// The excerpt based on words
if(!function_exists("if_string_limit_words")){
	function if_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  
	  return implode(' ', $words);
	}
}

if ( ! isset( $content_width ) )
	$content_width = 610;


/* Remove inline styles printed when the gallery shortcode is used.*/
function if_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'if_remove_gallery_css' );

/*Template for comments and pingbacks. */
if ( ! function_exists( 'if_comment' ) ) :
function if_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="con-comment">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
		</div><!-- .comment-author .vcard -->


		<div class="comment-body">
			<?php  printf( __( '%s ', THE_LANG ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            <span class="time">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s %2$s', THE_LANG ), get_comment_date(),  get_comment_time() ); ?></a>
                <?php edit_comment_link( __( '(Edit)', THE_LANG ), ' ' );?>
            </span>
            <span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ,'reply_text' => 'Reply') ) ); ?></span>
            
            <div class="clear"></div>
			<div class="commenttext">
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', THE_LANG ); ?></em>
			<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
			echo '<li class="post pingback">';
				echo '<p>'. __( 'Pingback:', THE_LANG ).' ';
					comment_author_link();
					edit_comment_link( __('(Edit)', THE_LANG), ' ' );
				echo '</p>';
				
			break;
	endswitch;
}
endif;



if (!function_exists('if_socialicon')){
	function if_socialicon(){
		
		$socialfolder = get_template_directory_uri() . '/images/social/';
		$optSocialIcons = if_readsocialicon();
		
		$outputli = "";
		for($i=1;$i<=count($optSocialIcons);$i++){
			$socialoption = of_get_option( THE_SHORTNAME . '_socialicon_'.$i, "" );

			if($socialoption['select']!='0'){
				$socialicon = $socialfolder . $socialoption['select'] ;
				$sociallink = $socialoption['text'];
				$outputli .= '<li><a href="'.$sociallink.'" style="background-image:url('.$socialicon.')"><span class="icon-img" style="background-image:url('.$socialicon.')"></span></a></li>'."\n";
			}
		}
		$output = "";
		if($outputli!=""){
			$output .= '<ul class="sn">';
			$output .= $outputli;
			$output .= '</ul>';
		}
		return $output;
	}
}//end if(!function_exists('if_get_socialicon'))

if(!function_exists('if_readsocialicon')){
	function if_readsocialicon(){
		$opt_social_icons_path = get_template_directory() . '/images/social/';
		$optSocialIcons = array();
		
		if ( is_dir($opt_social_icons_path) ) {
			if ($opt_social_icons_dir = opendir($opt_social_icons_path) ) { 
				$optSocialIcons[] = "None";
				while ( ($opt_social_icons_file = readdir($opt_social_icons_dir)) !== false ) {
					if(stristr($opt_social_icons_file, ".png") !== false) {
						$optSocialIcons[$opt_social_icons_file] = $opt_social_icons_file;
					}
				}    
			}
		}
		return $optSocialIcons;
	}
}

/*Prints HTML with meta information for the current post (category, tags and permalink).*/
if ( ! function_exists( 'if_posted_in' ) ) :
function if_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'Categories: %1$s <br/> Tags: %2$s', THE_LANG );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'Categories: %1$s', THE_LANG );
	} else {
		$posted_in = __( '', THE_LANG );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*Clearing the automatic paragraphs and breaks on shortcodes that WordPress is adding automatically when filtering content.*/
function if_content_formatter($content) { 
	$content = do_shortcode(shortcode_unautop($content)); 
	$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
	$content = str_replace('<br />', '', $content);
	$content = str_replace('<p><div', '<div', $content);
	return $content;
}

/* for top menu */
function nav_page_fallback() {
if(is_front_page()){$class="current_page_item";}else{$class="";}
print '<ul id="topnav" class="sf-menu"><li class="'.$class.'"><a href=" '.home_url( '/') .' " title=" '.__('Click for Home',THE_LANG).' ">'.__('Home',THE_LANG).'</a></li>';
    wp_list_pages( 'title_li=&sort_column=menu_order' );
print '</ul>';
}


/* Filter Custom Post Type Categories */
function if_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomies you want to display. Use the taxonomy name or slug
	if($typenow=="slider-view"){
	$taxonomies = array('slidercat');
	}elseif($typenow=="pdetail"){
	$taxonomies = array('portfoliocat');
	}elseif($typenow=="testimonial-view"){
	$taxonomies = array('testimonialcat');
	}
 
	// must set this to the post type you want the filter(s) displayed on
	if($typenow == $typenow &&  $typenow != "page" && $typenow != "post"){
 	if(count($taxonomies) > 0) {
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>".__('Show All Categories',THE_LANG)."</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
		}
	}
}
add_action( 'restrict_manage_posts', 'if_add_taxonomy_filters' );

/* for tagcloud widget  */
add_filter( 'widget_tag_cloud_args', 'if_tag_cloud_args' );
function if_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 12; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 12;
	$args['unit'] = 'px';
	$args['format'] = 'array';
	return $args;
}

add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);
function wp_tag_cloud_filter($return, $args)
{
  $strreturn = "";
  if(is_array($return)){
	  foreach($return as $ret){
		$strreturn .="<span class='tag'>".$ret."</span>";
	  }
  }
  echo '<div id="tag-cloud">'.$strreturn.'</div>';
}

/* for shortcode widget  */
add_filter('widget_text', 'do_shortcode');

function change_posttype() {
  if( is_tax('portfoliocat') && !is_admin() ) {
    set_query_var( 'post_type', array( 'post', 'portofolio' ) );
  }
  return;
}
add_action( 'parse_query', 'change_posttype' );
