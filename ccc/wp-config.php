<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'gthrfivf_wrd3');

/** MySQL database username */
define('DB_USER', 'gthrfivf_wrd3');

/** MySQL database password */
define('DB_PASSWORD', 'uHPV0D4sE8');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'BSBory9eGrOb8IoPZmDFJAt3uG7KKzi2ictTLQNJZvT5avKEBJj0IfDCYfpEjyKP');
define('SECURE_AUTH_KEY',  'qmzTwxLZVXLTh2M2Xh5DS90jKCSLljNuF6ORokKpfTMKoTbAO32YUCiJx3HaDN3A');
define('LOGGED_IN_KEY',    '2qfz804iRhLCtJItcwpHopRhaSzp5YbucTosxsBlohxCYCHmOq2WDjoT6LrCVVdP');
define('NONCE_KEY',        'NeWqTowkzQ1ELSZNAam1ho4IfL2LMLpeGE0MZQhwgd2GC13pPPNqgrzpJsSEX4jb');
define('AUTH_SALT',        'QsBG4PakinIWBkRPs9fM2D9rHyrUlrifUtZAbVZr9BWcpki6mad0Gj3jBoUvty4P');
define('SECURE_AUTH_SALT', 'lrtVg3vxLxy2Hd6BkBW9VroiK1j4auPZpdToYSywpfFfCPI6MIFdRCzrZfEgWjSI');
define('LOGGED_IN_SALT',   'luAZQYzqua641XIjg05PwpX8YD14Nm6qcOgXWDPvOAILNZgLO4FH1RBtBV6NbreA');
define('NONCE_SALT',       'myFkwSaRhK99gOxS5v0a6WKPtsn8M8K2sdJjKxM5Wzdsf4sYbXRp0vlnXKE4w13K');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
