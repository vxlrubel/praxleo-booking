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
		return self::$prefix . 'appointments';
	}

	/**
	 * Get the booking service slug.
	 *
	 * @return string
	 */
	protected function get_service_slug(): string {
		return self::$prefix . 'services';
	}

	/**
	 * Get the booking category slug.
	 *
	 * @return string
	 */
	protected function get_category_slug(): string {
		return self::$prefix . 'categories';
	}

	/**
	 * Get the booking employee slug.
	 *
	 * @return string
	 */
	protected function get_employee_slug(): string {
		return self::$prefix . 'employees';
	}

	/**
	 * Get the booking customer slug.
	 *
	 * @return string
	 */
	protected function get_customer_slug(): string {
		return self::$prefix . 'customers';
	}

	/**
	 * Get the booking location slug.
	 *
	 * @return string
	 */
	protected function get_location_slug(): string {
		return self::$prefix . 'locations';
	}

	/**
	 * Get the booking company slug.
	 *
	 * @return string
	 */
	protected function get_company_slug(): string {
		return self::$prefix . 'company';
	}

	/**
	 * Get the booking feature slug.
	 *
	 * @return string
	 */
	protected function get_feature_slug(): string {
		return self::$prefix . 'features';
	}

	/**
	 * Get the booking holiday slug.
	 *
	 * @return string
	 */
	protected function get_holiday_slug(): string {
		return self::$prefix . 'holidays';
	}

	/**
	 * Get the booking email notification slug.
	 *
	 * @return string
	 */
	protected function get_email_notification_slug(): string {
		return self::$prefix . 'email-notifications';
	}

	/**
	 * Get the booking email notification slug.
	 *
	 * @return string
	 */
	protected function get_payment_methods_slug(): string {
		return self::$prefix . 'payment-methods';
	}

	/**
	 * Get the booking settings slug.
	 *
	 * @return string
	 */
	protected function get_settings_slug(): string {
		return self::$prefix . 'settings';
	}

}
