<?php

namespace Praxleo\Booking\Traits;

defined( 'ABSPATH' ) || exit;

/**
 * Provides arrtibues used by the Praxleo Booking plugin.
 *
 * @package Praxleo_Booking
 */
trait Helper {

	/**
	 * Loads a template file.
	 *
	 * @param string $file The template path relative to the plugin templates directory.
	 * @return void
	 */
	public function get_template_file( string $file ): void {

		$file_path = PX_BOOKING_PATH . 'templates/' . $file;

		if ( is_file( $file_path ) ) {
			require $file_path;
		}
	}

}
