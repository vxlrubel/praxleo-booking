const { createApp } = Vue
const Appointment = createApp({
	data(){
		return {
			add_new_appointment_modal: false,
			open_filter_options: false,
			table_columns: {
				ref_id: true,
				appointment_date: true,
				service: true,
				customer: true,
				category: true,
				price: true,
				payment_status: true,
				created_at: true,
			},
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
