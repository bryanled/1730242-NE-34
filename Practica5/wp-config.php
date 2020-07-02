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
define( 'DB_NAME', 'cabbac' );

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
define( 'AUTH_KEY',         'w.C,sn%BLp`{9%S6A4H4!M^_.h1eOe#C9.n^,w:_z]pbQqiWCOUnjleW [l{s9hZ' );
define( 'SECURE_AUTH_KEY',  '4pymer]XfIH]BwFwv@cp7IZ9p)N1/&rLlB@!z7u#uz((h/$9O-xheGKTP60[:y&b' );
define( 'LOGGED_IN_KEY',    'DlLmK/_RJ/}G*aD,SqNv+j9ahp7&k,fE7{~2d/NgcS3_-|8>k,`[6fA>eie%uSv]' );
define( 'NONCE_KEY',        '<>LYxcqmduk[W}Umd#9{h!RR#BHbTl~cwf![jop&GE9@aPN?mQjC/R+e+ZO,j[aA' );
define( 'AUTH_SALT',        'Ka{E,`Sda*^V i{DITALb.YtO+R 8a;k}]n;[l@[$vn.TUZKBLLc.IkwlcU}=#Gr' );
define( 'SECURE_AUTH_SALT', 'N!4!q!#$N|2SBPg+*[{8-o`+onMu0LrnZLI.QyFl/,@+c?FKSk&Vj:Y(WJ4-QG`+' );
define( 'LOGGED_IN_SALT',   'bekUGYYEB2>=^@?5+Awii:IO3=zDReP|6n]dafsqRetjXX1ku^x[Fsh;>?G$T|84' );
define( 'NONCE_SALT',       '>LMP06;G`5Y+Q~M)z3hHCt}K[O!+ucHMq7aCG2xa1&6APk2fxQY{IO{uaa8^2BL@' );

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
