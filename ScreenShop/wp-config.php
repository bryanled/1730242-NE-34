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
define( 'DB_NAME', 'bd2' );

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
define( 'AUTH_KEY',         'hKmU]>`` )X=o.Fu}}lNh!P]_a#lU!:}s)QV$3:;b.o<n6WrR!3)+7={2.Rz%#9d' );
define( 'SECURE_AUTH_KEY',  'B@<Br6M@e(v2>~W(N%,YMgjJ[-{mC|s%)$!VKa,nV>Yx4}D[rR73~rK21udeas-,' );
define( 'LOGGED_IN_KEY',    '_wk$Y;,:l?pK&)Tm}/d+%UXwN!^xZ4mfB1WB+R#x3/@{Vag3/#%m08eE?9|GJ5Qf' );
define( 'NONCE_KEY',        'Fx)hJ]GH37bJk_rK?Gd0sT@[Jm&OOQzANg=gL*Z~7Y5P+5H /CE5ftf8NY|48*Qh' );
define( 'AUTH_SALT',        '}W{-,<+PFZG~pVn>0zG{3$Bm2kJsOW[ZC(e%,_#Vx;m7[qNM}tJY_b5Jtk*)8JM]' );
define( 'SECURE_AUTH_SALT', '9`yfI4{@3NP2&V{i^2vz{}7|[w%l]/q5QA@=]2I[WN@/?5*hq8IR[G8e:?Ei,61$' );
define( 'LOGGED_IN_SALT',   'S*Tha]+%ReC.Z,IhwKm1v7S?]z;Q&}n})=s?%&]qI+eY0uO_*6-neu&zd{f[?Kq^' );
define( 'NONCE_SALT',       '5AR1weh^2+ax.eGATg;k/QIw+sJ<o3bJZo[VB#.y`dP(]xQ3P9Kj.V{6-`THs4KV' );

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
