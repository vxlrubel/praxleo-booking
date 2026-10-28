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
