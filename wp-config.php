<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lazyjour_wp667');

/** MySQL database username */
define('DB_USER', 'lazyjour_wp667');

/** MySQL database password */
define('DB_PASSWORD', '7US[p@81B1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '2nwkg6gftevfflwjydwnntiacvwygrr49dyy0zvyvgvmj0ouzpymy2oashdqcrbp');
define('SECURE_AUTH_KEY',  'i1pfsyp8kstbonsygdvqfx8xrzcsvygacwudhhfc14mdyufqk5q9cj2xsv1vwjz0');
define('LOGGED_IN_KEY',    'bg77nq8cmq7ijshfkuqrfolofzxuxyaiogixduk8e5bflixirtts2kaqxgdgktri');
define('NONCE_KEY',        '8cmia8zgakwoha58z910mpn0x06z0k8lxhopwxymv8uqqx4g61tj6egjbj7ztqxh');
define('AUTH_SALT',        'kucdhmpkjxsspibq2c1zr329lzphc8pirubbt9tcrpqzg22zrp3naij5eltfuigw');
define('SECURE_AUTH_SALT', 'pa7abshvu6mum1rxdngfdstwd2czovsrntksuwf9zv4m3rifpoam9hphgwdvpko8');
define('LOGGED_IN_SALT',   'sksdd0ndgg2jjkkmywwrrlhp8o2jxaozznna2fur5i2l5jqm5khkfjws11cf5p1x');
define('NONCE_SALT',       '1ggmu8fuoeqzqlph9e55ryo1y5kcacu6xrgxgmocrxqeqbehup4uude3rsmngfbr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);
define( 'WP_DEBUG_DISPLAY', false ); // Turn forced display OFF
define('WP_DEBUG_LOG', true);
define('WP_ALLOW_REPAIR',true);
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'WP_POST_REVISIONS', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');



@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system

