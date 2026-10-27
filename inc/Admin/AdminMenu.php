<?php

namespace Praxleo\Booking\Admin;

use Praxleo\Booking\Traits\PluginLinks;

defined( 'ABSPATH' ) || exit;

/**
 * Handles the Praxleo Booking admin menu.
 *
 * @package Praxleo_Booking
 */
class AdminMenu {

	use PluginLinks;

	/**
	 * Initialize the admin menu.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
	}

	/**
	 * Register the plugin's admin menu and submenu pages.
	 *
	 * @return void
	 */
	public function register_admin_menu(): void {
		add_menu_page(
			__( 'Praxleo Booking', 'praxleo-booking' ),
			__( 'Praxleo Booking', 'praxleo-booking' ),
			'manage_options',
			$this->get_dashboard_slug(),
			array( $this, 'render_dashboard' ),
			'dashicons-schedule',
			15
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Dashboard', 'praxleo-booking' ),
			__( 'Dashboard', 'praxleo-booking' ),
			'manage_options',
			$this->get_dashboard_slug(),
			array( $this, 'render_dashboard' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Appointment', 'praxleo-booking' ),
			__( 'Appointment', 'praxleo-booking' ),
			'manage_options',
			$this->get_appointment_slug(),
			array( $this, 'render_appointment' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Services', 'praxleo-booking' ),
			__( 'Services', 'praxleo-booking' ),
			'manage_options',
			$this->get_service_slug(),
			array( $this, 'render_service' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Category', 'praxleo-booking' ),
			__( 'Category', 'praxleo-booking' ),
			'manage_options',
			$this->get_category_slug(),
			array( $this, 'render_employee' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Employees', 'praxleo-booking' ),
			__( 'Employees', 'praxleo-booking' ),
			'manage_options',
			$this->get_employee_slug(),
			array( $this, 'render_employee' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Customers', 'praxleo-booking' ),
			__( 'Customers', 'praxleo-booking' ),
			'manage_options',
			$this->get_customer_slug(),
			array( $this, 'render_customer' )
		);
	}

	/**
	 * Render the plugin dashboard page.
	 *
	 * @return void
	 */
	public function render_dashboard(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Dashboard', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin appointment page.
	 *
	 * @return void
	 */
	public function render_appointment(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Appointments', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin Service page.
	 *
	 * @return void
	 */
	public function render_service(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Services', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin category page.
	 *
	 * @return void
	 */
	public function render_category(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Categories', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin Service page.
	 *
	 * @return void
	 */
	public function render_employee(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Employees', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin customers page.
	 *
	 * @return void
	 */
	public function render_customer(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Customers', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}
}
