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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define( 'AS3CF_SETTINGS', serialize( array(
    'provider' => 'aws',
    'access-key-id' => 'AKIAR533PBHXLE6YLD6Z',
    'secret-access-key' => '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',
) ) );


define( 'DB_NAME', 'dukekunshan' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '12y%01t4k~[%!$,`-Qgy))*0 ]i`>AsrSL7AC$BP-N^cB{y7fL`(8*F(YA+0Z$gZ' );
define( 'SECURE_AUTH_KEY',  'bgwu*eDkEZI#X@{jCwD17>4Aa(O:]IJp&0#w~aRj6ugM&)<3UtWPY6WiCuXfJLF<' );
define( 'LOGGED_IN_KEY',    '1QxLp`c2&76@=BMT>V}c;pvY <Vhc2>/+bO^-uO6Z[TAg$dY.lz<dxw.0!s^oA.s' );
define( 'NONCE_KEY',        'S5#cJs6/;HZP&>8Q3at~N@Jw3?5Ln)bE-#@[Orop7{K~3D#NTb6f?R/t!x>LF<yB' );
define( 'AUTH_SALT',        'yd5p#`U>s28Ek*U2rZCeh:m-pcj|}?tBZg6cI8ffDW;apfd6)q@>8yoL cSLb^_j' );
define( 'SECURE_AUTH_SALT', 'w5-A!kt7_u9goTXR)J>(}7t@c+dL_9dnh.w)={Hk_h6P->z$SewDbM*vYH1Ok*^@' );
define( 'LOGGED_IN_SALT',   'pk135>~ZT{27<C;S) bh~JUlfgkg{@uzYUSW;TDS1y2A=YW=5@sxTSi~ u<TtCYh' );
define( 'NONCE_SALT',       'c!!J9fP2Jamqo(E]*H5YFp$v<JGuKKN1sZ@^Ls8e)6w5Kf?1>P<Fd?,q.lDYu4YN' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

// define('MULTISITE', true);
// define('SUBDOMAIN_INSTALL', false);
// define('DOMAIN_CURRENT_SITE', 'localhost');
// define('PATH_CURRENT_SITE', '/');
// define('SITE_ID_CURRENT_SITE', 1);
// define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy publishing. */

define('WP_ALLOW_MULTISITE', true);    // 开启多站点功能
define( 'COOKIE_DOMAIN', '' );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define("FS_METHOD","direct");
define("FS_CHMOD_DIR", 0777);
define("FS_CHMOD_FILE", 0777);