<?php

namespace Praxleo\Booking;

defined( 'ABSPATH' ) || exit;
/**
 * Main Praxleo Booking plugin class.
 *
 * Manages plugin initialization, dependency loading, and WordPress hooks.
 *
 * @package Praxleo_Booking
 */
final class PraxleoBooking {

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
