<?php
/**
 * Plugin Name:       Praxleo Booking
 * Plugin URI:        https://praxleo.com
 * Description:       Booking and scheduling for WordPress.
 * Version:           1.6.0
 * Requires at least: 6.0
 * Requires PHP:      8.1
 * Author:            Praxleo
 * Author URI:        https://praxleo.com
 * License:           GPL-2.0-or-later
 * Text Domain:       praxleo-booking
 * Domain Path:       /lang
 *
 * @package Praxleo_Booking
 */

defined( 'ABSPATH' ) || exit;

define( 'PX_BOOKING_VERSION', '1.6.0' );
define( 'PX_BOOKING_DB_VERSION', '1.6.0' );
define( 'PX_BOOKING_FILE', __FILE__ );
define( 'PX_BOOKING_PATH', plugin_dir_path( __FILE__ ) );
define( 'PX_BOOKING_URL', plugin_dir_url( __FILE__ ) );

$praxleo_autoloader = PX_BOOKING_PATH . 'vendor/autoload.php';

if ( file_exists( $praxleo_autoloader ) ) {
	require_once $praxleo_autoloader;
} else {
	spl_autoload_register(
		static function ( $class_name ) {
			$prefix   = 'Praxleo\\Booking\\';
			$base_len = strlen( $prefix );

			if ( 0 !== strncmp( $prefix, $class_name, $base_len ) ) {
				return;

			}

			$relative = substr( $class_name, $base_len );
			$file     = PX_BOOKING_PATH . 'inc/' . str_replace( '\\', '/', $relative ) . '.php';

			if ( file_exists( $file ) ) {
				require_once $file;

			}
		}
	);
}
