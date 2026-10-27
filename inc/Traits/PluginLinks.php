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
}
