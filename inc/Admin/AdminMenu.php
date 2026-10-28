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
			__( 'Appointments', 'praxleo-booking' ),
			__( 'Appointments', 'praxleo-booking' ),
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
			__( 'Categories', 'praxleo-booking' ),
			__( 'Categories', 'praxleo-booking' ),
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

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Locations', 'praxleo-booking' ),
			__( 'Locations', 'praxleo-booking' ),
			'manage_options',
			$this->get_location_slug(),
			array( $this, 'render_location' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Company', 'praxleo-booking' ),
			__( 'Company', 'praxleo-booking' ),
			'manage_options',
			$this->get_company_slug(),
			array( $this, 'render_company' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Features', 'praxleo-booking' ),
			__( 'Features', 'praxleo-booking' ),
			'manage_options',
			$this->get_feature_slug(),
			array( $this, 'render_feature' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Holidays', 'praxleo-booking' ),
			__( 'Holidays', 'praxleo-booking' ),
			'manage_options',
			$this->get_holiday_slug(),
			array( $this, 'render_holiday' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Email Notifications', 'praxleo-booking' ),
			__( 'Email Notifications', 'praxleo-booking' ),
			'manage_options',
			$this->get_email_notification_slug(),
			array( $this, 'render_email_nofitication' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Payment Methods', 'praxleo-booking' ),
			__( 'Payment Methods', 'praxleo-booking' ),
			'manage_options',
			$this->get_payment_methods_slug(),
			array( $this, 'render_payment_method' )
		);

		add_submenu_page(
			$this->get_dashboard_slug(),
			__( 'Settings', 'praxleo-booking' ),
			__( 'Settings', 'praxleo-booking' ),
			'manage_options',
			$this->get_settings_slug(),
			array( $this, 'render_settings' )
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

	/**
	 * Render the plugin location page.
	 *
	 * @return void
	 */
	public function render_location(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Locations', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin company page.
	 *
	 * @return void
	 */
	public function render_company(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Company Information', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin features page.
	 *
	 * @return void
	 */
	public function render_feature(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Features & Integrations', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin holiday page.
	 *
	 * @return void
	 */
	public function render_holiday(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Holidays', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin email notifications page.
	 *
	 * @return void
	 */
	public function render_email_nofitication(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Email Notifications', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin payment method page.
	 *
	 * @return void
	 */
	public function render_payment_method(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Payments Methods', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}

	/**
	 * Render the plugin settings page.
	 *
	 * @return void
	 */
	public function render_settings(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Settings', 'praxleo-booking' ); ?></h1>
		</div>
		<?php
	}
}
