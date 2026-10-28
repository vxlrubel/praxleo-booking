<?php
/**
 * Plugin Name:       Praxleo Booking
 * Plugin URI:        https://praxleo.com
 * Description:       Booking and scheduling for WordPress.
 * Version:           1.0.0
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

use Praxleo\Booking\PraxleoBooking;

defined( 'ABSPATH' ) || exit;

define( 'PX_BOOKING_VERSION', '1.0.0' );
define( 'PX_BOOKING_DB_VERSION', '1.0.0' );
define( 'PX_BOOKING_FILE', __FILE__ );
define( 'PX_BOOKING_PATH', plugin_dir_path( __FILE__ ) );
define( 'PX_BOOKING_URL', plugin_dir_url( __FILE__ ) );
define( 'PX_LIB_GLOBAL', trailingslashit( PX_BOOKING_URL . 'lib/global' ) );
define( 'PX_ADMIN_CSS_URL', trailingslashit( PX_BOOKING_URL . 'lib/admin/css' ) );
define( 'PX_ADMIN_JS_URL', trailingslashit( PX_BOOKING_URL . 'lib/admin/js' ) );

$praxleo_autoloader = PX_BOOKING_PATH . 'vendor/autoload.php';

if ( file_exists( $praxleo_autoloader ) ) {
	require_once $praxleo_autoloader;
}

spl_autoload_register(
	static function ( $class_name ) {
		$prefix = 'Praxleo\\Booking\\';

		if ( 0 !== strpos( $class_name, $prefix ) ) {
			return;
		}

		$relative_class = substr( $class_name, strlen( $prefix ) );
		$class_file     = PX_BOOKING_PATH . 'inc/' . str_replace( '\\', '/', $relative_class ) . '.php';

		if ( file_exists( $class_file ) ) {
			require_once $class_file;
		}
	}
);


if ( ! function_exists( 'praxleo_booking' ) ) {
	/**
	 * Return the main plugin instance.
	 *
	 * @return PraxleoBooking
	 */
	function praxleo_booking(): PraxleoBooking {
		return PraxleoBooking::init();
	}
}

praxleo_booking();
