<div class="wrap" id="appointment" v-cloak>
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Appointments', 'praxleo-booking' ); ?></h1>
	<a href="javascript:void(0)" class="page-title-action" @click.prevent="open_add_new_appointment_modal()">
		<?php esc_html_e( 'Add Appointment', 'praxleo-booking' ); ?>
	</a>

	<hr class="wp-header-end">


	<!-- add new appointment modal -->
	<template v-if="add_new_appointment_modal">
		<div class="px-modal">
			<div class="px-modal-content">
				<div class="px-modal-header">
					<div class="px-modal-title"><?php esc_html_e( 'Add New Appointment', 'praxleo-booking' ); ?></div>
					<button type="button" class="px-close-button"><span class="dashicons dashicons-no-alt" @click="close_add_new_appointment_modal()"></span></button>
				</div>

				<div class="px-modal-body">
					body content
					p*500>lorem20

				</div>

				<div class="px-modal-footer">
					<button type="button" class="px-primacy-button" @click="close_add_new_appointment_modal()">Close</button>
					<button type="button" class="px-primacy-button">Save Changes</button>
				</div>

			</div>
		</div>
	</template>


</div>
