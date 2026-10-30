/* Multi-step booking form (Vue 3)
 * Steps: Service (with category filter) > Location > Employee > Date & Time > Your Information > Payment
 *
 * The data below is mock data. Replace `db` with your API / wp_localize_script data.
 */
const { createApp } = Vue;

const db = {
	categories: [
		{ id: 1, name: 'Vaccination' },
		{ id: 2, name: 'Travel Medicine' },
		{ id: 3, name: 'Consultation' },
	],
	services: [
		{ id: 1, categoryId: 1, name: 'Flu Vaccine', duration: 15, price: 25 },
		{ id: 2, categoryId: 1, name: 'Hepatitis B Vaccine', duration: 15, price: 40 },
		{ id: 3, categoryId: 1, name: 'Typhoid Vaccine', duration: 15, price: 35 },
		{ id: 4, categoryId: 2, name: 'Malaria Tablet (Malarone)', duration: 30, price: 60 },
		{ id: 5, categoryId: 2, name: 'Travel Health Check', duration: 30, price: 45 },
		{ id: 6, categoryId: 3, name: 'General Consultation', duration: 30, price: 30 },
		{ id: 7, categoryId: 3, name: 'Follow-up Visit', duration: 15, price: 20 },
	],
	locations: [
		{ id: 1, name: 'Downtown Clinic', address: '12 Main Street', serviceIds: [1, 2, 3, 4, 5, 6, 7] },
		{ id: 2, name: 'Northside Pharmacy', address: '88 North Avenue', serviceIds: [1, 2, 4, 6] },
		{ id: 3, name: 'Airport Health Desk', address: 'Terminal 2', serviceIds: [3, 4, 5] },
	],
	employees: [
		{ id: 1, name: 'Dr. Sarah Khan', role: 'Physician', serviceIds: [1, 2, 3, 4, 5, 6, 7], locationIds: [1, 2], days: [1, 2, 3, 4, 5], start: 9, end: 17 },
		{ id: 2, name: 'James Miller', role: 'Pharmacist', serviceIds: [1, 2, 4, 6], locationIds: [2], days: [1, 2, 3, 4, 5, 6], start: 10, end: 18 },
		{ id: 3, name: 'Amira Rahman', role: 'Travel Nurse', serviceIds: [3, 4, 5], locationIds: [1, 3], days: [0, 1, 2, 3, 4, 5, 6], start: 8, end: 16 },
	],
	paymentMethods: [
		{ id: 'paypal', name: 'PayPal', description: 'Pay securely with your PayPal account' },
		{ id: 'stripe', name: 'Stripe', description: 'Pay by credit or debit card' },
		{ id: 'local', name: 'Local / Cash', description: 'Pay in person at the location' },
	],
};

const pad = (n) => String(n).padStart(2, '0');
const toISODate = (d) => `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
const parseISODate = (s) => {
	const [y, m, d] = s.split('-').map(Number);
	return new Date(y, m - 1, d);
};
const formatTime = (mins) => {
	const h = Math.floor(mins / 60);
	const m = mins % 60;
	const suffix = h >= 12 ? 'PM' : 'AM';
	return `${pad(h % 12 === 0 ? 12 : h % 12)}:${pad(m)} ${suffix}`;
};

createApp({
	data() {
		const today = new Date();
		return {
			steps: [
				{ key: 'service', title: 'Service' },
				{ key: 'location', title: 'Location' },
				{ key: 'employee', title: 'Employee' },
				{ key: 'timeslot', title: 'Date & Time' },
				{ key: 'confirm', title: 'Your Information' },
				{ key: 'payment', title: 'Payment Method' },
			],
			step: 1,
			error: '',
			submitted: false,

			categories: db.categories,
			services: db.services,
			locations: db.locations,
			employees: db.employees,
			paymentMethods: db.paymentMethods,

			selectedCategoryId: 0, // 0 = all categories
			selectedServiceId: null,
			selectedLocationId: null,
			selectedEmployeeId: null,
			selectedDate: '',
			selectedSlot: null, // start time in minutes from midnight
			selectedPaymentId: null,

			// calendar state
			maxBookingDays: 365, // how far ahead customers can book
			calendarYear: today.getFullYear(),
			calendarMonth: today.getMonth(), // 0-11
			weekdays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

			customer: { name: '', email: '', phone: '' },
		};
	},

	computed: {
		currentStep() {
			return this.steps[this.step - 1];
		},

		/* step 1 */
		filteredServices() {
			if (!this.selectedCategoryId) return this.services;
			return this.services.filter((s) => s.categoryId === this.selectedCategoryId);
		},
		selectedService() {
			return this.services.find((s) => s.id === this.selectedServiceId) || null;
		},
		selectedCategory() {
			if (!this.selectedService) return null;
			return this.categories.find((c) => c.id === this.selectedService.categoryId) || null;
		},

		/* step 2 */
		availableLocations() {
			if (!this.selectedServiceId) return [];
			return this.locations.filter((l) => l.serviceIds.includes(this.selectedServiceId));
		},
		selectedLocation() {
			return this.locations.find((l) => l.id === this.selectedLocationId) || null;
		},

		/* step 3 */
		availableEmployees() {
			if (!this.selectedServiceId || !this.selectedLocationId) return [];
			return this.employees.filter(
				(e) =>
					e.serviceIds.includes(this.selectedServiceId) &&
					e.locationIds.includes(this.selectedLocationId)
			);
		},
		selectedEmployee() {
			return this.employees.find((e) => e.id === this.selectedEmployeeId) || null;
		},

		/* step 4 */
		timeSlots() {
			return this.selectedDate ? this.getSlots(this.selectedDate) : [];
		},
		calendarTitle() {
			return new Date(this.calendarYear, this.calendarMonth, 1).toLocaleDateString(undefined, {
				month: 'long',
				year: 'numeric',
			});
		},
		// leading nulls pad the first week so days line up under the weekday headers
		calendarDays() {
			const y = this.calendarYear;
			const m = this.calendarMonth;
			const cells = [];
			for (let i = 0; i < new Date(y, m, 1).getDay(); i++) cells.push(null);
			const daysInMonth = new Date(y, m + 1, 0).getDate();
			for (let d = 1; d <= daysInMonth; d++) {
				const iso = toISODate(new Date(y, m, d));
				cells.push({ day: d, iso, available: this.getSlots(iso).length > 0 });
			}
			return cells;
		},
		canGoPrevMonth() {
			const now = new Date();
			return this.calendarYear * 12 + this.calendarMonth > now.getFullYear() * 12 + now.getMonth();
		},
		canGoNextMonth() {
			const max = new Date();
			max.setDate(max.getDate() + this.maxBookingDays);
			return this.calendarYear * 12 + this.calendarMonth < max.getFullYear() * 12 + max.getMonth();
		},
		selectedSlotLabel() {
			return this.selectedSlot === null ? '' : formatTime(this.selectedSlot);
		},
		selectedDateLabel() {
			if (!this.selectedDate) return '';
			return parseISODate(this.selectedDate).toLocaleDateString(undefined, {
				weekday: 'short', year: 'numeric', month: 'short', day: 'numeric',
			});
		},

		/* step 6 */
		selectedPayment() {
			return this.paymentMethods.find((p) => p.id === this.selectedPaymentId) || null;
		},
	},

	watch: {
		// changing an earlier choice invalidates everything after it
		selectedServiceId() {
			this.selectedLocationId = null;
			this.selectedEmployeeId = null;
			this.selectedSlot = null;
		},
		selectedLocationId() {
			this.selectedEmployeeId = null;
			this.selectedSlot = null;
		},
		selectedEmployeeId() {
			// availability depends on the employee, so the date must be picked again
			this.selectedDate = '';
			this.selectedSlot = null;
		},
		selectedDate() {
			this.selectedSlot = null;
		},
		// picking a category that no longer contains the chosen service clears it
		selectedCategoryId(id) {
			if (id && this.selectedService && this.selectedService.categoryId !== id) {
				this.selectedServiceId = null;
			}
		},
	},

	methods: {
		/* Available slots for one date (ISO string) for the chosen employee + service.
		 * Returns [] for past dates, dates beyond the booking window, and days off.
		 * Replace the mock "booked" rule with real availability from your API. */
		getSlots(iso) {
			const emp = this.selectedEmployee;
			const svc = this.selectedService;
			if (!emp || !svc) return [];

			const now = new Date();
			const startOfToday = new Date(now.getFullYear(), now.getMonth(), now.getDate());
			const lastDay = new Date(startOfToday);
			lastDay.setDate(lastDay.getDate() + this.maxBookingDays);

			const date = parseISODate(iso);
			if (date < startOfToday || date > lastDay) return [];
			if (!emp.days.includes(date.getDay())) return [];

			const isToday = iso === toISODate(now);
			const nowMins = now.getHours() * 60 + now.getMinutes();
			const dateNum = date.getDate() + date.getMonth() * 31;

			const slots = [];
			let index = 0;
			for (let t = emp.start * 60; t + svc.duration <= emp.end * 60; t += svc.duration, index++) {
				if (isToday && t <= nowMins) continue;
				if ((emp.id + dateNum + index) % 5 === 0) continue; // mock: already booked
				slots.push({ value: t, label: formatTime(t) });
			}
			return slots;
		},
		selectDate(cell) {
			if (cell && cell.available) this.selectedDate = cell.iso;
		},
		changeMonth(delta) {
			const d = new Date(this.calendarYear, this.calendarMonth + delta, 1);
			this.calendarYear = d.getFullYear();
			this.calendarMonth = d.getMonth();
		},
		// jump to the first day that has at least one free slot
		pickFirstAvailableDate() {
			const day = new Date();
			for (let i = 0; i <= this.maxBookingDays; i++) {
				const iso = toISODate(day);
				if (this.getSlots(iso).length) {
					this.selectedDate = iso;
					this.calendarYear = day.getFullYear();
					this.calendarMonth = day.getMonth();
					return;
				}
				day.setDate(day.getDate() + 1);
			}
			// nothing free: show the current month with every day disabled
			const now = new Date();
			this.calendarYear = now.getFullYear();
			this.calendarMonth = now.getMonth();
		},

		validate() {
			const messages = {
				1: [!this.selectedServiceId, 'Please select a service.'],
				2: [!this.selectedLocationId, 'Please select a location.'],
				3: [!this.selectedEmployeeId, 'Please select an employee.'],
				4: [
					!this.selectedDate || this.selectedSlot === null,
					'Please choose a date and a time slot.',
				],
				5: [
					!this.customer.name.trim() ||
						!/^\S+@\S+\.\S+$/.test(this.customer.email) ||
						!this.customer.phone.trim(),
					'Please enter your name, a valid email and a phone number.',
				],
				6: [!this.selectedPaymentId, 'Please select a payment method.'],
			};
			const [invalid, message] = messages[this.step];
			this.error = invalid ? message : '';
			return !invalid;
		},
		next() {
			if (!this.validate()) return;
			if (this.step < this.steps.length) {
				this.step++;
				if (this.step === 4 && !this.selectedDate) this.pickFirstAvailableDate();
			} else {
				this.submit();
			}
		},
		back() {
			this.error = '';
			if (this.step > 1) this.step--;
		},
		submit() {
			const payload = {
				serviceId: this.selectedServiceId,
				locationId: this.selectedLocationId,
				employeeId: this.selectedEmployeeId,
				date: this.selectedDate,
				time: this.selectedSlotLabel,
				customer: { ...this.customer },
				paymentMethod: this.selectedPaymentId, // 'paypal' | 'stripe' | 'local'
			};
			// TODO: for PayPal / Stripe, take the payment here before marking the booking confirmed.
			// TODO: send `payload` to your backend (fetch / admin-ajax / REST route)
			console.log('Booking payload', payload);
			this.submitted = true;
		},
		reset() {
			Object.assign(this.$data, this.$options.data.call(this));
		},
	},
}).mount('#bookingForm');
