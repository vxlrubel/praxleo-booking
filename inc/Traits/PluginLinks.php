<?php

namespace Praxleo\Booking\Traits;

defined( 'ABSPATH' ) || exit;

/**
 * Provides links used by the Praxleo Booking plugin.
 *
 * @package Praxleo_Booking
 */
trait PluginLinks {

	/**
	 * The prefix used for admin menu slugs.
	 *
	 * @var string
	 */
	protected static $prefix = 'praxleo-';

	/**
	 * Get the plugin documentation URL.
	 *
	 * @return string
	 */
	protected function get_documentation_url(): string {
		return 'https://github.com/vxlrubel/praxleo-booking.git';
	}

	/**
	 * Get the plugin settings URL.
	 *
	 * @return string
	 */
	protected function get_settings_url(): string {
		return admin_url( 'praxleo-booking.php' );
	}

	/**
	 * Get the booking dashboard slug.
	 *
	 * @return string
	 */
	protected function get_dashboard_slug(): string {
		return self::$prefix . 'booking';
	}

	/**
	 * Get the booking appointment slug.
	 *
	 * @return string
	 */
	protected function get_appointment_slug(): string {
		return self::$prefix . 'appointment';
	}

	/**
	 * Get the booking service slug.
	 *
	 * @return string
	 */
	protected function get_service_slug(): string {
		return self::$prefix . 'service';
	}

	/**
	 * Get the booking category slug.
	 *
	 * @return string
	 */
	protected function get_category_slug(): string {
		return self::$prefix . 'category';
	}

	/**
	 * Get the booking employee slug.
	 *
	 * @return string
	 */
	protected function get_employee_slug(): string {
		return self::$prefix . 'employee';
	}

	/**
	 * Get the booking customer slug.
	 *
	 * @return string
	 */
	protected function get_customer_slug(): string {
		return self::$prefix . 'customer';
	}

}
