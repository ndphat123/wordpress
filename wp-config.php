<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$A pLueK6bWe~oe2y[iCf`6=>ex^aD^xu_O0C1^|O`-$3Ve]l*$-?$5BR:p26vDp' );
define( 'SECURE_AUTH_KEY',  'RZ{*n_hglaSkxbbrEVFh(/gL@nJ<b/QQZd;mTny2[*FkH=7;5p/fs@_mImf?@4n8' );
define( 'LOGGED_IN_KEY',    'AI$@pZW}cA.gFF0K?7!`rt8QuM;_3R{v }Q4>s(pSuakT:TTDlU2SMU=0e4o%,ns' );
define( 'NONCE_KEY',        'HN^sw8wKcwpMUPA_`/}aT6/wT~hgG/6.gFnc>9#v2TNRn&atV2^(???i@)zW~d*T' );
define( 'AUTH_SALT',        't%u?;#Lv%]D~%w25/IR,xuw,r`-DVbVt_+ 3%)Kh*9lxg*R}[5sDdc+#Mw=wW0{G' );
define( 'SECURE_AUTH_SALT', '[ImnKcU|!pnaCTECdUhi:MYL_Z}1iDPz<gUV/fay(E;7Ipgx{]|Y-n%uJpqA5N!G' );
define( 'LOGGED_IN_SALT',   'pu3Z;z2)1^Fad%B~;G*NHmp0Eb<u7t^@mtS9tB|?-P@4|D{CV@p|&}bcqSXz1<C_' );
define( 'NONCE_SALT',       '?H!SQxb4P-c6Gp]F7Naa($0wGdF-a?&F>)r%AJ@))w!gom<5;yEP,~VD)dyTRhTV' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_99';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
