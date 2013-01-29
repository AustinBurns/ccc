<?php
	
function tf_pagination($pages = '', $range = 2){  



	 $showitems = ($range * 2)+1;  

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		
	 
	
	 global $wp_query;
	 $pages = $wp_query->max_num_pages;
	 if(!$pages) $pages = 1;


	 
	 $output='';

	 if($pages != 1){
	 

		 $output.= "<div class='pagination'>";
		
		 if($paged > 2 && $paged > $range+1 && $showitems < $pages) $output.= "<a class='' href='".get_pagenum_link(1)."'>&laquo;</a>";
		 if($paged > 1 && $showitems < $pages) $output.= "<a class='' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		 for ($i=1; $i <= $pages; $i++){
			 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
				 $output.= ($paged == $i)? "<a class='current'>".$i."</a>":"<a class='' href='".get_pagenum_link($i)."' >".$i."</a>";
			 }
		 }

		 if ($paged < $pages && $showitems < $pages) $output.= "<a class='' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
		 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $output.= "<a class='' href='".get_pagenum_link($pages)."'>&raquo;</a>";
		 $output.= "</div>\n";
		 
	 }
	 
	 return $output;
}
	
?>