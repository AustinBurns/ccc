<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?php echo get_theme_option('favicon'); ?>" />

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	

	
	<?php wp_head();  ?>

	<!--[if lte IE 9]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!--[if IE 8]>
	<link rel="stylesheet" href="<?php echo THEME_CSS; ?>/ie8.css" type="text/css" media="screen" />
	<![endif]-->

	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,800,700' rel='stylesheet' type='text/css'>


	
	<title><?php tf_title(); ?></title>
	

</head>



<body <?php body_class(); ?>>

	<header id="header">
	
		<div class="container">
		
			<div class="sixteen columns">
			
				<a id="logo" title="<?php echo get_bloginfo('name'); ?>" href="<?php echo home_url( '/' ); ?>">
				
					<img src="<?php echo get_theme_option('logo_image'); ?>">
				
				</a>
	
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => false, 'theme_location'  =>'main_nav', 'menu_id' => 'nav')); ?>
		
			</div>
		
		</div>
		
		
	</header>
	

	

		

	
