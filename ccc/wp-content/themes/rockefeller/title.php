<?php
//custom meta field
$prefix = 'if_';
$custom = get_post_custom(get_the_ID());
$cf_pagetitle = (isset($custom[$prefix."page-title"][0]))? $custom[$prefix."page-title"][0] : "";
$cf_enableSlider = (isset($custom[$prefix."enable-slider"][0]))? $custom[$prefix."enable-slider"][0] : "";

if(is_singular('portofolio') || is_attachment()){

	echo '<h1 class="pagetitle"><span>'.get_the_title().'</span></h1>';
	
}elseif(is_single()){
	
	echo '<h1 class="pagetitle"><span>'.get_the_title().'</span></h1>';
	
}elseif(is_archive()){
	echo ' <h1 class="pagetitle"><span>';
	if ( is_day() ) :
	printf( __( 'Daily Archives <span>%s</span>', THE_LANG ), get_the_date() );
	elseif ( is_month() ) :
	printf( __( 'Monthly Archives <span>%s</span>', THE_LANG ), get_the_date('F Y') );
	elseif ( is_year() ) :
	printf( __( 'Yearly Archives <span>%s</span>', THE_LANG ), get_the_date('Y') );
	elseif ( is_author()) :
	printf( __( 'Author Archives %s', THE_LANG ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" );
	else :
	printf( __( '%s', THE_LANG ), '<span>' . single_cat_title( '', false ) . '</span>' );
	endif;
	echo '</span> </h1>';
	
}elseif(is_search()){
	echo ' <h1 class="pagetitle"><span>';
	printf( __( 'Search Results for %s', THE_LANG ), '<span>' . get_search_query() . '</span>' );
	echo '</span> </h1>';
	
}elseif(is_404()){
	echo ' <h1 class="pagetitle"><span>';
	_e( '404 Page', THE_LANG );
	echo '</span> </h1>';
	
}elseif( is_home() ){
	$postspage = get_option('page_for_posts');
	$poststitle = get_the_title($postspage);
	
	echo ' <h1 class="pagetitle"><span>';
	echo ($postspage)? $poststitle : __('Blog', THE_LANG );
	echo '</span> </h1>';
	
}else{

 if (have_posts()) : while (have_posts()) : the_post();
	$titleoutput='';
	
	if($cf_pagetitle == ""){
		$titleoutput.='<h1 class="pagetitle"><span>'.get_the_title().'</span></h1>';
	}else{
		$titleoutput.='<h1 class="pagetitle"><span>'.$cf_pagetitle.'</span></h1>';
	}
	
	echo $titleoutput;
endwhile; endif; wp_reset_query();

}