<?php
/**
 * connecting to all framework files
 */

/****************Connecting to Optionsframework***********************/ 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', THE_FRAMEWORKURI . 'admin/' );
	require_once THE_FRAMEWORKPATH . 'admin/options-framework.php';
}

require_once THE_FRAMEWORKPATH . 'if-general-functions.php';
require_once THE_FRAMEWORKPATH . 'if-googlefontjson.php';
 
/****************Connecting to Sidebar Generator***********************/ 
require_once THE_FRAMEWORKPATH . 'sidebargenerator/if-form.php';
require_once THE_FRAMEWORKPATH . 'sidebargenerator/if-sidebar.php';


/****************Connecting to Standards Shortcodes***********************/ 
$shortcode_path = THE_FRAMEWORKPATH . 'shortcodes/';
require_once($shortcode_path. "columns.php" );
require_once($shortcode_path. "dropcap.php" );
require_once($shortcode_path. "tabs.php" );
require_once($shortcode_path. "toggles.php" );
require_once($shortcode_path. "highlight.php" );
require_once($shortcode_path. "quote.php" );
require_once($shortcode_path. "separator.php" );
require_once($shortcode_path. "portfolio.php" );
require_once($shortcode_path. "pre.php" );
require_once($shortcode_path. "recent-posts.php" );
require_once($shortcode_path. "content-title.php" );