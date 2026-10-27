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

if ( ! class_exists( 'Praxleo_Booking' ) ) {
	/**
	 * Main booking class.
	 */
	final class Praxleo_Booking {

		/**
		 * The single instance of the class.
		 *
		 * @var self|null
		 */
		private static $instance = null;

		/**
		 * Initialize the plugin.
		 */
		private function __construct() {
			$this->load_dependencies();
			$this->register_hooks();
		}

		/**
		 * Retrieve the main plugin instance.
		 *
		 * @return self
		 */
		public static function init(): self {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Load plugin dependencies.
		 *
		 * @return void
		 */
		private function load_dependencies(): void {
			// Load additional classes or files here.
		}

		/**
		 * Register WordPress hooks.
		 *
		 * @return void
		 */
		private function register_hooks(): void {
			add_action( 'init', array( $this, 'load_textdomain' ) );
		}

		/**
		 * Load the plugin text domain.
		 *
		 * @return void
		 */
		public function load_textdomain(): void {
			load_plugin_textdomain(
				'praxleo-booking',
				false,
				dirname( plugin_basename( PX_BOOKING_FILE ) ) . '/lang'
			);
		}
	}
}

if ( ! function_exists( 'praxleo_booking' ) ) {
	/**
	 * Return the main plugin instance.
	 *
	 * @return Praxleo_Booking
	 */
	function praxleo_booking(): Praxleo_Booking {
		return Praxleo_Booking::init();
	}
}

praxleo_booking();
