<?php

/********** INTERFEIS DEFINITION *************/

global $themeoptionsvalue, $themedata, $themename ; 
define('THE_THEMENAME', 'rockefeller');
define('THE_SHORTNAME', 'interfeis');
define('THE_LANG', 'interfeis');
define('THE_PARENTMENU_SLUG', 'iftheme-settings' );
define('THE_FRAMEWORKPATH', get_template_directory() . '/framework/' );
define('THE_FRAMEWORKURI', get_template_directory_uri() . '/framework/' );
define('THE_STYLEURI', get_stylesheet_directory_uri() . '/');
define('THE_STYLEPATH', get_stylesheet_directory() . '/');
define('THE_CSSURI', get_template_directory_uri() . '/css/' );
define('THE_JSURI', get_template_directory_uri() . '/js/' );
define('THE_ENGINEPATH', get_template_directory() . '/engine/' );
define('THE_WIDGETPATH', get_template_directory() . '/widgets/' );
/********** END INTERFEIS DEFINITION *************/

//Connecting to Interfeis Framework
require_once THE_FRAMEWORKPATH . 'framework-connector.php';

//Starting the theme setting
require_once THE_ENGINEPATH . 'engine-start.php';

//Settings the theme options
require_once THE_ENGINEPATH . 'theme-options.php';