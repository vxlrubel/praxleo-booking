<?php

namespace Praxleo\Booking\Frontend;
use Praxleo\Booking\Traits\Helper;

defined( 'ABSPATH' ) || exit;


/**
 * Handles the Praxleo Booking admin assets.
 *
 * @package Praxleo_Booking
 */
class Assets {

	use Helper;

	/**
	 * Registers the admin asset enqueueing hook.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
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
	public function enqueue_scripts(): void {
		wp_enqueue_script(
			'vue-global',
			PX_LIB_GLOBAL . 'vue.global.js',
			array(),
			'3.5.44',
			true
		);

		wp_enqueue_script(
			'praxleo-frontend',
			PX_JS_URL . 'praxleo-frontend.js',
			array( 'vue-global' ),
			'1.0',
			true
		);

		wp_localize_script(
			'praxleo-frontend',
			'PX',
			$this->localize_object()
		);

		wp_enqueue_style( 'praxleo-frontend', PX_CSS_URL . 'praxleo-frontend.css', array(), '1.0' );
	}

}
