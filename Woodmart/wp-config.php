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
define( 'DB_NAME', 'bd3' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '<aw6%PEsUcN&6T_vw42[)9@r31Y0m5yJu6GDB%4E7H+A249_!H<qY&p0&wh34][~' );
define( 'SECURE_AUTH_KEY',  '7Gt#k.a|?FDDRHE|qEUxTi,FFbrmyld<C7RO*i--mH=W=5?Q|Ctd*Ssv-b^F~Y.v' );
define( 'LOGGED_IN_KEY',    'o&W}pKfZ ^m-2r6F%0nd:WWL(&y@vza?9)ST3;04<ERsPCt<eSeE*q:_@|DTTLDO' );
define( 'NONCE_KEY',        'Ni&<$ Q@%XkI[7(b%^C=F,/@T-|IcP@7y@8T{X?!>$.t$;!f#)ar*<OBu=?Plw;e' );
define( 'AUTH_SALT',        '#H#MX8;JKB?eKY^dtt^LL^&kT:gUuda)D_BW_qK/^UT1yVOpPf/OtprTl5AF8K6@' );
define( 'SECURE_AUTH_SALT', 'J<iL,Gl{88B.Mda?[+D:LzaV]uGMR%7X9WKPrIf4qa6Z16U*-:zOJRcSD[b{vBl%' );
define( 'LOGGED_IN_SALT',   'Tro)=E`%5T+)$26<vAA+<i>:FY;{X4SaVBG#C%lf61@Vs4n[4C]GFauOW~}nqMh>' );
define( 'NONCE_SALT',       'ML2v`Y#KS;DxLaC{qyS]g?._^Vw}Lq4tKw[x[<AB%WGUp?|81hl&{ 6T-Gkp[jy0' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
