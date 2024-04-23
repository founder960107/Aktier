<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'xG$8^4]l*KCs3b?^VSN[]|;4Hz(zBKH5@mo7<xd+xle!/=5&/OZ2bcMULVL1+l8Q' );
define( 'SECURE_AUTH_KEY',  'kGXi<C~ 2(_.>{LhwwC`?580MQs8>%;d{bu~F?1kU7wOqt5v.f9j/:cgQ6wZ]?Qm' );
define( 'LOGGED_IN_KEY',    '4b#nY2OY`/)2viMsnOvsg*C8Z&{G)08?hO~tUkZE? o>mecv[&r17o%?*Zp,=>/p' );
define( 'NONCE_KEY',        'AoW:SA`w]-gzSaDZ=PDhSn7nWsL;dn<FRr5/ N:<0YCbBHZg_?}LfzjTsG1Dl}>O' );
define( 'AUTH_SALT',        '9;wb?XM16nnYf|hBb*awH;~Nznhi*@AQh:dy|)U/S@_FV+,dgi<_/$I6B#Y#Aj2V' );
define( 'SECURE_AUTH_SALT', 'kZ.e64~hN;cI?r*W.v5&.MNtf#e^{,0{q+Bqf{<fmiNe+Fc#ROi~jLT%x{,Ts4:Q' );
define( 'LOGGED_IN_SALT',   'dpkC22|o9%KAzw_l0[PT< ^J[_mx<pQYwCT=RV,aCnrt%LahO}BN.y@J#9Tvv(dg' );
define( 'NONCE_SALT',       'fuB1r9F(OQQHsc$UuJ]*s/MfZm`d[[oB:w+{)/^wVI{8rjU=BOS%s&jbz-thRIP9' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
