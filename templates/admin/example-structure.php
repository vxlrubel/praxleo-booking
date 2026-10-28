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

<script>
	const { createApp } = Vue
	const Appointment = createApp({
		data(){
			return {
				add_new_appointment_modal: false,
			}
		},

		methods: {
			open_add_new_appointment_modal(){
				this.add_new_appointment_modal = true
			},

			close_add_new_appointment_modal(){
				this.add_new_appointment_modal = false
			}
		}

	})

	Appointment.mount('#appointment');

</script>
