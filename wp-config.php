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
define( 'DB_NAME', 'garimpo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'NKUZOLA18' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'FS_METHOD', 'direct' );
// ADICIONADO PARA CAPTURA DE ERROS DO PROJECTO PARA O SENTRY
define( 'WP_SENTRY_DSN', 'https://313dc7770aa14f97a5817818f136254f@o433433.ingest.sentry.io/5436468' );
// https://313dc7770aa14f97a5817818f136254f@o433433.ingest.sentry.io/5436468 
// para pegar erros de js
define( 'WP_SENTRY_BROWSER_DSN', 'https://313dc7770aa14f97a5817818f136254f@o433433.ingest.sentry.io/5436468' );
define( 'WP_SENTRY_ERROR_TYPES', E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_USER_DEPRECATED );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~I  X^pY=#8Qn2q|of69w>tBH .82cl4o|~k=n:mE8q7LoMT _yGW.DF{:>m{,E$' );
define( 'SECURE_AUTH_KEY',  'PRpX-Go5~]]=rew7++}%CzAS7Ze_JX[4lW= 1G*Pfb.Le:MfIX3TcaQ,1n+fhNU!' );
define( 'LOGGED_IN_KEY',    'FMn(x][W0ZEFR^:5bg6{1Vh [2<wkXz:zLK{A?c[al~wF80w~aR+[02U [`nnc5Q' );
define( 'NONCE_KEY',        'y.vC:#T|~V iP49>og.BXNK#!_he NCqMzA#2aizm!~:37fMsfI:Dh:9RU-3ov5^' );
define( 'AUTH_SALT',        'tBSGxE3= Vaxc)e_|;pFXh`r9xHXBKST!lPdcRK4W-OQ87Oknj2(eN?UQ07B3aJ+' );
define( 'SECURE_AUTH_SALT', '8)=|Fb_ ZC@>kcQ?*+78z:+p5!zo ;>nB6Pv):}.H&U=lAp 0T3P:_8.YmDT/~8B' );
define( 'LOGGED_IN_SALT',   '=+$!+2Y8K=<ib$`0Tn6:2Ru.0;oo~#>r}0gN!Q>ri[Z2F@VaPq9m)A>X{(hH>HWe' );
define( 'NONCE_SALT',       'BCqe )a!Woo,0Ui2P/Ab4)Qh2QlT~&EYP5Cyh/SGzRCt^j({0:vzStM~Ix)R(s*i' );

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
define( 'WP_DEBUG', true );
@ini_set('upload_max_size' , '256M' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
