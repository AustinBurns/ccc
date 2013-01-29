<?php
/**
 * The Sidebar containing the post widget areas.
 *
 * @package WordPress
 * @subpackage Rockefeller
 * @since Rockefeller 1.0
 */

global $post;
$custom = get_post_custom($post->ID);
$prefix = "if_";
$defaultsidebar = THE_SHORTNAME . "-sidebar";
$chosensidebar = (isset($custom[$prefix."sidebar"][0]) && !is_search())? $custom[$prefix."sidebar"][0] : $defaultsidebar;
?>
<div class="widget-area">
	<?php if ( ! dynamic_sidebar( $chosensidebar ) ) : ?><?php endif; // end general widget area ?>
</div>