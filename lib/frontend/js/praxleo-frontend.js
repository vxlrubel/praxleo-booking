const { createApp } = Vue;

const BookingForm = createApp({
    data() {
        return {
            currentStep: 'service',
            steps: ['service', 'location', 'employee', 'timeslot'],
            selectedCategoryId: 'all',
            selectedServiceId: null,
            selectedLocationId: null,
            selectedEmployeeId: null,
            selectedDate: '',
            selectedTime: '',
            bookingSubmitted: false,

            categories: [
                { id: '1', name: 'General Practice', description: 'General health consultations' },
                { id: '2', name: 'Diagnostics & Screening', description: 'Tests and health checks' },
                { id: '3', name: 'Women’s Health', description: 'Women’s health services' },
                { id: '4', name: 'Skin & Aesthetics', description: 'Skin consultations and treatments' },
                { id: '5', name: 'Wellness & Prevention', description: 'Preventive and wellness services' }
            ],

            locations: [
                { id: '1', name: 'Central Medical Clinic', address: '12 High Street', city: 'London' },
                { id: '2', name: 'Riverside Health Centre', address: '24 Riverside Road', city: 'London' },
                { id: '3', name: 'Northside Family Practice', address: '8 North Avenue', city: 'London' },
                { id: '4', name: 'West End Wellness Clinic', address: '31 West End Lane', city: 'London' },
                { id: '5', name: 'Southgate Medical Centre', address: '6 Southgate Street', city: 'London' }
            ],

            employees: [
                { id: '1', name: 'Dr. Olivia Bennett', role: 'General Practitioner', locationIds: ['1', '2'], serviceIds: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'] },
                { id: '2', name: 'Dr. James Wilson', role: 'General Practitioner', locationIds: ['1', '3', '5'], serviceIds: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'] },
                { id: '3', name: 'Dr. Aisha Rahman', role: 'Women’s Health Specialist', locationIds: ['2', '4', '5'], serviceIds: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'] },
                { id: '4', name: 'Dr. Daniel Moore', role: 'Dermatology Clinician', locationIds: ['1', '3', '4'], serviceIds: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'] },
                { id: '5', name: 'Dr. Sophia Patel', role: 'Health Screening Clinician', locationIds: ['2', '3', '4', '5'], serviceIds: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'] }
            ],

            services: [
                { id: '1', name: 'General Practitioner Consultation', description: 'A consultation to discuss general health concerns and next steps.', price: 35, duration: 30, timeSlot: '30 min', thumb: 'general-practitioner.jpg', categoryIds: ['1'], locationIds: ['1', '2', '3', '5'], employeeIds: ['1', '2', '3'] },
                { id: '2', name: 'Follow-up Consultation', description: 'A follow-up visit to review progress and discuss ongoing care.', price: 25, duration: 20, timeSlot: '20 min', thumb: 'follow-up-consultation.jpg', categoryIds: ['1'], locationIds: ['1', '2', '3'], employeeIds: ['1', '2'] },
                { id: '3', name: 'Minor Illness Assessment', description: 'Assessment of common, non-emergency symptoms and care options.', price: 30, duration: 20, timeSlot: '20 min', thumb: 'minor-illness.jpg', categoryIds: ['1'], locationIds: ['1', '3', '5'], employeeIds: ['1', '2'] },
                { id: '4', name: 'Blood Pressure Check', description: 'A blood pressure measurement with general guidance on the result.', price: 12, duration: 15, timeSlot: '15 min', thumb: 'blood-pressure.jpg', categoryIds: ['2', '5'], locationIds: ['1', '2', '3', '4', '5'], employeeIds: ['1', '2', '5'] },
                { id: '5', name: 'Blood Test Appointment', description: 'Appointment for a clinician-requested blood sample collection.', price: 20, duration: 15, timeSlot: '15 min', thumb: 'blood-test.jpg', categoryIds: ['2'], locationIds: ['1', '2', '5'], employeeIds: ['2', '5'] },
                { id: '6', name: 'Health Screening Package', description: 'A preventive health screening appointment based on the selected package.', price: 75, duration: 45, timeSlot: '45 min', thumb: 'health-screening.jpg', categoryIds: ['2', '5'], locationIds: ['2', '3', '4', '5'], employeeIds: ['1', '5'] },
                { id: '7', name: 'Diabetes Risk Assessment', description: 'A review of diabetes risk factors and appropriate screening options.', price: 28, duration: 25, timeSlot: '25 min', thumb: 'diabetes-risk.jpg', categoryIds: ['2', '5'], locationIds: ['1', '2', '3', '5'], employeeIds: ['1', '2', '5'] },
                { id: '8', name: 'Cholesterol Check', description: 'A cholesterol screening appointment with guidance on follow-up.', price: 22, duration: 15, timeSlot: '15 min', thumb: 'cholesterol-check.jpg', categoryIds: ['2', '5'], locationIds: ['1', '2', '4', '5'], employeeIds: ['2', '5'] },
                { id: '9', name: 'Women’s Health Consultation', description: 'A confidential consultation for general women’s health concerns.', price: 45, duration: 30, timeSlot: '30 min', thumb: 'womens-health.jpg', categoryIds: ['3'], locationIds: ['2', '4', '5'], employeeIds: ['3', '1'] },
                { id: '10', name: 'Contraception Consultation', description: 'Discuss contraception options and suitability with a clinician.', price: 35, duration: 25, timeSlot: '25 min', thumb: 'contraception.jpg', categoryIds: ['3'], locationIds: ['2', '4', '5'], employeeIds: ['3'] },
                { id: '11', name: 'Menopause Support Consultation', description: 'A consultation to discuss menopause symptoms and support options.', price: 48, duration: 30, timeSlot: '30 min', thumb: 'menopause-support.jpg', categoryIds: ['3'], locationIds: ['2', '4'], employeeIds: ['3', '1'] },
                { id: '12', name: 'Cervical Screening Appointment', description: 'An appointment for cervical screening where clinically appropriate.', price: 40, duration: 25, timeSlot: '25 min', thumb: 'cervical-screening.jpg', categoryIds: ['3', '5'], locationIds: ['2', '4', '5'], employeeIds: ['3', '5'] },
                { id: '13', name: 'Skin Consultation', description: 'A consultation to assess skin concerns and discuss care options.', price: 42, duration: 30, timeSlot: '30 min', thumb: 'skin-consultation.jpg', categoryIds: ['4'], locationIds: ['1', '3', '4'], employeeIds: ['4', '1'] },
                { id: '14', name: 'Acne Consultation', description: 'Assessment of acne concerns and discussion of suitable treatment options.', price: 38, duration: 25, timeSlot: '25 min', thumb: 'acne-consultation.jpg', categoryIds: ['4'], locationIds: ['1', '3', '4'], employeeIds: ['4'] },
                { id: '15', name: 'Mole Assessment', description: 'A clinical assessment of a mole or other skin lesion; not an emergency service.', price: 55, duration: 30, timeSlot: '30 min', thumb: 'mole-assessment.jpg', categoryIds: ['4'], locationIds: ['1', '3', '4'], employeeIds: ['4'] },
                { id: '16', name: 'Hair and Scalp Consultation', description: 'Assessment of common hair or scalp concerns and possible next steps.', price: 40, duration: 25, timeSlot: '25 min', thumb: 'hair-scalp.jpg', categoryIds: ['4'], locationIds: ['1', '4'], employeeIds: ['4', '1'] },
                { id: '17', name: 'Nutrition Consultation', description: 'Discuss general nutrition goals and practical healthy eating strategies.', price: 40, duration: 30, timeSlot: '30 min', thumb: 'nutrition.jpg', categoryIds: ['5'], locationIds: ['2', '3', '4', '5'], employeeIds: ['5', '1'] },
                { id: '18', name: 'Lifestyle Health Review', description: 'A preventive review of lifestyle factors and general wellbeing goals.', price: 32, duration: 25, timeSlot: '25 min', thumb: 'lifestyle-review.jpg', categoryIds: ['5'], locationIds: ['1', '2', '3', '5'], employeeIds: ['1', '2', '5'] },
                { id: '19', name: 'Smoking Cessation Support', description: 'Support to discuss options for stopping smoking and maintaining progress.', price: 25, duration: 20, timeSlot: '20 min', thumb: 'smoking-cessation.jpg', categoryIds: ['1', '5'], locationIds: ['1', '2', '3', '5'], employeeIds: ['1', '2'] },
                { id: '20', name: 'Travel Health Consultation', description: 'A consultation to discuss travel health needs and recommended preparation.', price: 35, duration: 25, timeSlot: '25 min', thumb: 'travel-health.jpg', categoryIds: ['1', '5'], locationIds: ['1', '2', '4', '5'], employeeIds: ['1', '2', '5'] }
            ],

            availableTimes: [
                '09:00', '09:30', '10:00', '10:30',
                '11:00', '11:30', '13:00', '13:30',
                '14:00', '14:30', '15:00', '15:30'
            ]
        };
    },

    computed: {
        selectedService() {
            return this.services.find(service => service.id === this.selectedServiceId) || null;
        },

        selectedLocation() {
            return this.locations.find(location => location.id === this.selectedLocationId) || null;
        },

        selectedEmployee() {
            return this.employees.find(employee => employee.id === this.selectedEmployeeId) || null;
        },

        filteredServices() {
            if (this.selectedCategoryId === 'all') {
                return this.services;
            }

            return this.services.filter(service =>
                service.categoryIds.includes(this.selectedCategoryId)
            );
        },

        availableLocations() {
            if (!this.selectedService) {
                return [];
            }

            return this.locations.filter(location =>
                this.selectedService.locationIds.includes(location.id)
            );
        },

        availableEmployees() {
            if (!this.selectedService || !this.selectedLocation) {
                return [];
            }

            return this.employees.filter(employee =>
                this.selectedService.employeeIds.includes(employee.id) &&
                employee.locationIds.includes(this.selectedLocation.id) &&
                employee.serviceIds.includes(this.selectedService.id)
            );
        },

        stepIndex() {
            return this.steps.indexOf(this.currentStep);
        },

        formattedPrice() {
            return this.selectedService
                ? new Intl.NumberFormat('en-GB', {
                    style: 'currency',
                    currency: 'GBP'
                }).format(this.selectedService.price)
                : '';
        }
    },

    methods: {
        selectCategory(categoryId) {
            this.selectedCategoryId = categoryId;
        },

        selectService(serviceId) {
            this.selectedServiceId = serviceId;
            this.selectedLocationId = null;
            this.selectedEmployeeId = null;
            this.selectedDate = '';
            this.selectedTime = '';
            this.bookingSubmitted = false;
        },

        selectLocation(locationId) {
            this.selectedLocationId = locationId;
            this.selectedEmployeeId = null;
            this.selectedDate = '';
            this.selectedTime = '';
        },

        selectEmployee(employeeId) {
            this.selectedEmployeeId = employeeId;
            this.selectedDate = '';
            this.selectedTime = '';
        },

        selectDate(date) {
            this.selectedDate = date;
            this.selectedTime = '';
        },

        selectTime(time) {
            this.selectedTime = time;
        },

        canContinue() {
            switch (this.currentStep) {
                case 'service':
                    return Boolean(this.selectedServiceId);
                case 'location':
                    return Boolean(this.selectedLocationId);
                case 'employee':
                    return Boolean(this.selectedEmployeeId);
                case 'timeslot':
                    return Boolean(this.selectedDate && this.selectedTime);
                default:
                    return false;
            }
        },

        nextStep() {
            if (!this.canContinue()) {
                return;
            }

            if (this.stepIndex < this.steps.length - 1) {
                this.currentStep = this.steps[this.stepIndex + 1];
            }
        },

        previousStep() {
            if (this.stepIndex > 0) {
                this.currentStep = this.steps[this.stepIndex - 1];
            }
        },

        goToStep(step) {
            const targetIndex = this.steps.indexOf(step);

            if (targetIndex !== -1 && targetIndex <= this.stepIndex) {
                this.currentStep = step;
            }
        },

        formatPrice(price) {
            return new Intl.NumberFormat('en-GB', {
                style: 'currency',
                currency: 'GBP'
            }).format(price);
        },

        formatDuration(minutes) {
            if (minutes < 60) {
                return `${minutes} min`;
            }

            const hours = Math.floor(minutes / 60);
            const remainingMinutes = minutes % 60;

            return remainingMinutes
                ? `${hours} hr ${remainingMinutes} min`
                : `${hours} hr`;
        },

        submitBooking() {
            if (!this.canContinue()) {
                return;
            }

            const booking = {
                service: this.selectedService,
                location: this.selectedLocation,
                employee: this.selectedEmployee,
                date: this.selectedDate,
                time: this.selectedTime
            };

            // Demo only: send this data to your WordPress backend for validation and saving.
            console.log('Booking details:', booking);
            this.bookingSubmitted = true;
        }
    }
});

BookingForm.mount('#bookingForm');
