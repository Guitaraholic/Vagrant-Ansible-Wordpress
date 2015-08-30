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
define('DB_NAME', '{{dbName}}');

/** MySQL database username */
define('DB_USER', '{{dbUser}}');

/** MySQL database password */
define('DB_PASSWORD', '{{dbPass}}');

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
define('AUTH_KEY',         'Qh1,`YuYa|,Pf(XpB9AUHzBWeO>V6)HgxKU%$bhH+zY,Yx|7kd~z$j,s~bTq?$Qn');
define('SECURE_AUTH_KEY',  '2!Pei-yY0+L=8kVZuX2k~SiWVWzhT+H+ml0M#U)9%@@$I,`&e]VXoW%Gwv>+|FK[');
define('LOGGED_IN_KEY',    'r]i/(()NFkM&--F:$/t^[WO9Q]mUXJ31]52uAk@6K]|)Uzq::N9l/+&DxKC)wn:R');
define('NONCE_KEY',        '*BfL]!T7:x6#|I9,uC<&cr6yqx@^jkPKoB|IUq,z+;x%ZF:jkCJ&&+2nFiv[|`H?');
define('AUTH_SALT',        'i-K*bzGLW:3((Wg<|Y3vI@|[qw1.w/!fjyY@MSE=EeWf$7hGgNHvbo`+V|-xICvX');
define('SECURE_AUTH_SALT', 'G|lmdA-/YQ=E; R-?0dC0tf>,Dc!^J[ny40/HhU]i8*Hl:gl=>v*i+#}dUm>PE<<');
define('LOGGED_IN_SALT',   'gzClK;OkMn>zp002P3b SBSzwXyeOgW@OLL%#S,1 (.^&CDX!yt3;gze>^p.+hr.');
define('NONCE_SALT',       'Hy+Q;$5$#<MK5K)gPSs99[q&iQNMz-z]?,li5teH+HH5 ~/~N_CCj(MAww2Yao|@');

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
