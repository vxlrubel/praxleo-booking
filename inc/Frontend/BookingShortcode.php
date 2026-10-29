<?php

namespace Praxleo\Booking\Frontend;
use Praxleo\Booking\Traits\Helper;
defined( 'ABSPATH' ) || exit;


/**
 * Handles the Praxleo Booking shortcode.
 *
 * @package Praxleo_Booking
 */
class BookingShortcode {

	use Helper;
	/**
	 * This methods handles the booking shortcode.
	 *
	 * @return void
	 */
	public function __construct() {
		add_shortcode( 'praxleo_booking', array( $this, 'render_booking_form' ) );
	}

	/**
	 * Handle the actual shortcode.
	 *
	 * @return string
	 */
	public function render_booking_form(): string {

		ob_start();

		$this->get_template_file( 'frontend/shortcode.php' );

		return ob_get_clean();

	}


}
