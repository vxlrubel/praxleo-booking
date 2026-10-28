<?php

namespace Praxleo\Booking\Admin;

defined( 'ABSPATH' ) || exit;


/**
 * Handles the Praxleo Booking admin assets.
 *
 * @package Praxleo_Booking
 */
class AdminAssets {

	/**
	 * Registers the admin asset enqueueing hook.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Provides localized data for admin scripts.
	 *
	 * @return array<string, string> The localized script data.
	 */
	public function localize_object(): array {
		return array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'praxleo_admin_nonce' ),
		);
	}

	/**
	 * Enqueues admin scripts and styles.
	 *
	 * Loads appointment-specific assets only on the appointments page.
	 *
	 * @return void
	 */
	public function enqueue_admin_scripts(): void {
		wp_enqueue_script(
			'vue-global',
			PX_LIB_GLOBAL . 'vue.global.js',
			array(),
			'3.5.44',
			true
		);

		wp_enqueue_script(
			'praxleo-admin',
			PX_ADMIN_JS_URL . 'praxleo-admin.js',
			array( 'vue-global' ),
			'1.0',
			true
		);

		wp_localize_script(
			'praxleo-admin',
			'praxleoAdmin',
			$this->localize_object()
		);

		wp_enqueue_style( 'praxleo-admin', PX_ADMIN_CSS_URL . 'praxleo-admin.css', array(), '1.0' );

		if ( $this->get_page_slug() === 'praxleo-appointments' ) {
			wp_enqueue_script(
				'praxleo-admin-appointment',
				PX_ADMIN_JS_URL . 'appointment.js',
				array( 'praxleo-admin' ),
				'1.0',
				true
			);

			wp_enqueue_style( 'praxleo-admin-appointment', PX_ADMIN_CSS_URL . 'appointment.css', array(), '1.0' );
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
