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
define('DB_NAME', 'data');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'UY[1jc&:!(dp5/d7`VL;!T8fJW.[2Q >hrL=&N{c0>,`dk5sdns#-LfO7ql28mv9');
define('SECURE_AUTH_KEY',  '@k7f5&HIJbn5H->s.!)G:y.T:[8VQPQ-e?I9h~Gi;b*:dj[)K~`/8c;M<-u_wYd<');
define('LOGGED_IN_KEY',    'JK^enZc0CLY@$IYz,pr_xNVQNb?>BAOwFHj(0955DG3]6YFc!gf9!MN``eq,Xo4Z');
define('NONCE_KEY',        'jG@7P6_#Yz7aSyQbW%[Q=3P3We5H~=0~7hA8?-k;`3%89>}lcM.s=$z4+ag%`(~^');
define('AUTH_SALT',        'gT<v[,p|h1ZTQ@Qd5|r)(9tj.4=N=t I$#j,ZEJzsL:qWM)Ma7$pG8QE595)=cd}');
define('SECURE_AUTH_SALT', '[]N/kKXjb9f_uFqN70Of5,i+2IZsdLBFmQfEawuG2r;.lh(# ~2MB~rBwdj7lC+/');
define('LOGGED_IN_SALT',   'HPTK_WDlCcK)a/fVUn5**P;HJg/YVPr-(+~2|e!pn4|vD1;X@_r3fn{+,m{~X.If');
define('NONCE_SALT',       'mUeNyrqb`Mme35aptE-$/bkeT/]Yec!>!]RS}4E.^nq2yqki7:b^o& `!DZZ#Kv=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dos_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define( 'WP_AUTO_UPDATE_CORE', false );