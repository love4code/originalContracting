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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8889');

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
define('AUTH_KEY',         'l10r05IW06-LEk7HIb6-|i!`TMf9n?mL^H+72e;_3-bmHDXO3RjyF[T {5y;o`!6');
define('SECURE_AUTH_KEY',  '`ufcxti2M]%u-?8p#/|1s_llhRSD0T9{:5|eVifki+e{!+*A%YF|T1DR:UJIZ,w>');
define('LOGGED_IN_KEY',    'YjGG??(~;5P#$bd+_l_<^udCG+cC|K/;dVk~p]8-B{dHo/]J`L|oLu2=|h-G4?g,');
define('NONCE_KEY',        'v(W9{cwWzqCZi|=-o?$M@}z |]F;rOeJ9<xd|G]sD.AI*#rHU|$L+Dq#A]F}l&>$');
define('AUTH_SALT',        'Vu..AI[K@jFQwO&c6s~;|KPTNg[/uj#od`r>Y2KrN-&)2UUle91Dl{-7t2+6V@^Q');
define('SECURE_AUTH_SALT', 'o[_X-o-%H(0X/3t#-aj%u}<S- )-_l$6.-z8eaMagbBRcYk@2@cgb%Gs*DKJG]h/');
define('LOGGED_IN_SALT',   '1z>--bF#=,!>0<3v&Zte&]8[cM<rr>_mMxd_.`1F]{`[NU{qG]_qQb*eUbQ.).7T');
define('NONCE_SALT',       'Xv6P]ygtNC-KRY>k[+sk-= .xOAg-n]]9)-.v{9,31wbCT8F{s;]guIQ5c[Ax7LG');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
