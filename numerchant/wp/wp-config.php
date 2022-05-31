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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'creapkxk_numerchant' );

/** Database username */
define( 'DB_USER', 'creapkxk_numerchant' );

/** Database password */
define( 'DB_PASSWORD', 'tv=16NIgTri;' );

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
define( 'AUTH_KEY',         'Gf~Vh:+WFynaG5bIBortvW~$r[??7eP)ZR4duLPzubWt-f_|ZDhQ70n[RnRC)aF[' );
define( 'SECURE_AUTH_KEY',  '@2GBo1<0MB:oq?2z4`QKIrYBs#v~CxPu:IA2# Tr4tM`(C:g8HFG3WZs./Np=Av(' );
define( 'LOGGED_IN_KEY',    ' )FWZZ`bOGJmaZMmpa@-1Vld:M~|m^w19{+Uk!wTNn~hX;`OwqEr`!FM`oC`C4w(' );
define( 'NONCE_KEY',        'BFH1*Wt_knBOCryA%P|3c-@eZhr8(mAO/rB3tMd22/2&._[;5W<xaS|E.#/VX:0.' );
define( 'AUTH_SALT',        '*ZMK@]aB|IaB#%@1IbadVvl[7V|/LoB2 8m7>IC1{HqtXcz7Z.RS5OGQ>6DBZ=EJ' );
define( 'SECURE_AUTH_SALT', '>=GaDw&nGEY/F5X(AZV|zK#5im!rHy>p(xC.}Q5 2MoS<&j6nuv~oP^3DSuR~jFg' );
define( 'LOGGED_IN_SALT',   '4a/&qo<l[PP8K)rGul-q}1w.4d1y=}91Wy:e))@48cn}=|a(*`|^>pMD9f]zO hd' );
define( 'NONCE_SALT',       'rYcp`5YE1]*$ia%8a2XwVi,bR[K6`Hj[?TR`4:HqaoQFJ>Vc$es.Wkffgth=N Nn' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'nt_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
