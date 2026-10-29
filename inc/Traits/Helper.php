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

	/**
	 * Retrieves the current admin page slug.
	 *
	 * @return string The sanitized admin page slug, or an empty string if unavailable.
	 */
	public function get_page_slug(): string {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading the admin page slug; no state-changing action occurs.
		if ( isset( $_GET['page'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading the admin page slug; no state-changing action occurs.
			return sanitize_key( wp_unslash( $_GET['page'] ) );
		}

		return '';
	}

}
