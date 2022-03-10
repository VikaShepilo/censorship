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
define( 'DB_NAME', 'cens' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'u4BiP2I2<@Wf$^FLEgk4r4L#D1*Ru*hW7UIZc[cb*7oEhQ+-7y9._LJ|` aYNTA-');
define('SECURE_AUTH_KEY',  'WFGX?U~kut)0ezAVrO=YE|^FaEU+wmBs-Vl1ds{+1?r-&q?-L4eds@cn)&)Tvw:|');
define('LOGGED_IN_KEY',    '[x+}Z#$`Elwr4{}pjO$bz@mRhnh~+@>YqbQo~-l`9E]R|&oM8q=qr,iC18s+;Ioa');
define('NONCE_KEY',        '+xi5]YaNJqP!>s{G MIYNv6+Qw-<+[R$4:|*pj~u#PJB4kV/cAt<:`EJD>0l9)WL');
define('AUTH_SALT',        'Taey^zG?Aaj,]5<uCVzNH>u6w%@jN#N]I9IXn^ |1d|e-R?w-O>`i%#@odG7=F#+');
define('SECURE_AUTH_SALT', '(+i-$IOtjb`-(>Qrbz&4dJ:s5J4dLL;,dJ<9>6^-Gz`<.~;O8.uFQfh-([|j>!M{');
define('LOGGED_IN_SALT',   '}cn;1Aal7i0U6]wO?hU)Q||%*gl6s<jag!)m;*VT[pTR{Wf_E/DBXTa(wQ!ZB5I(');
define('NONCE_SALT',       'n/vyDYx-R0io7cM7yzzlWsy!;<vlO6Tp!Fg_f+ak@<Mo`ya59$pw?OIf<f;yY0Fl');

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
