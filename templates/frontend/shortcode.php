<fieldset class="px-booking-form" id="bookingForm" v-cloak>
	<legend>Form Step: {{ step }} of {{ steps.length }}</legend>
	<div class="px-form-header">{{ currentStep.title }}</div>

	<div class="px-success" v-if="submitted">
		<h3>Booking confirmed</h3>
		<p>{{ selectedService.name }} with {{ selectedEmployee.name }}<br>
			{{ selectedDateLabel }} at {{ selectedSlotLabel }}<br>
			Payment: {{ selectedPayment.name }}</p>
		<button type="button" class="px-button px-button-primary" @click="reset">Book another</button>
	</div>

	<div class="px-form-body" v-else>
		<div class="left-side">

			<!-- STEP 1: category + service -->
			<template v-if="step === 1">
				<div class="px-category-bar">
					<button
						type="button"
						class="px-chip"
						:class="{ 'is-active': selectedCategoryId === 0 }"
						@click="selectedCategoryId = 0"
					>All</button>
					<button
						v-for="cat in categories"
						:key="cat.id"
						type="button"
						class="px-chip"
						:class="{ 'is-active': selectedCategoryId === cat.id }"
						@click="selectedCategoryId = cat.id"
					>{{ cat.name }}</button>
				</div>

				<div class="px-grid" :key="selectedCategoryId">
					<label
						v-for="(item, index) in filteredServices"
						:key="item.id"
						:for="'px-service-' + item.id"
						:style="{ '--px-delay': (index * 50) + 'ms' }"
						class="px-grid-item"
					>
						<input
							type="radio"
							name="px-service"
							:id="'px-service-' + item.id"
							:value="item.id"
							v-model="selectedServiceId"
						>
						<span class="px-item-title">{{ item.name }}</span>
						<span class="px-item-meta">{{ item.duration }} min &middot; ${{ item.price }}</span>
					</label>
				</div>
				<div class="px-empty" v-if="!filteredServices.length">No services in this category.</div>
			</template>

			<!-- STEP 2: location -->
			<template v-else-if="step === 2">
				<div class="px-grid" v-if="availableLocations.length">
					<label
						v-for="(item, index) in availableLocations"
						:key="item.id"
						:for="'px-location-' + item.id"
						:style="{ '--px-delay': (index * 50) + 'ms' }"
						class="px-grid-item"
					>
						<input
							type="radio"
							name="px-location"
							:id="'px-location-' + item.id"
							:value="item.id"
							v-model="selectedLocationId"
						>
						<span class="px-item-title">{{ item.name }}</span>
						<span class="px-item-meta">{{ item.address }}</span>
					</label>
				</div>
				<div class="px-empty" v-else>No location offers this service.</div>
			</template>

			<!-- STEP 3: employee -->
			<template v-else-if="step === 3">
				<div class="px-grid" v-if="availableEmployees.length">
					<label
						v-for="(item, index) in availableEmployees"
						:key="item.id"
						:for="'px-employee-' + item.id"
						:style="{ '--px-delay': (index * 50) + 'ms' }"
						class="px-grid-item"
					>
						<input
							type="radio"
							name="px-employee"
							:id="'px-employee-' + item.id"
							:value="item.id"
							v-model="selectedEmployeeId"
						>
						<span class="px-item-title">{{ item.name }}</span>
						<span class="px-item-meta">{{ item.role }}</span>
					</label>
				</div>
				<div class="px-empty" v-else>No employee is available for this service at this location.</div>
			</template>

			<!-- STEP 4: date + time slot -->
			<template v-else-if="step === 4">
				<p class="px-section-label">Select a date</p>
				<div class="px-calendar">
					<div class="px-calendar-header">
						<button type="button" class="px-calendar-nav" :disabled="!canGoPrevMonth" @click="changeMonth(-1)" aria-label="Previous month">&lsaquo;</button>
						<span>{{ calendarTitle }}</span>
						<button type="button" class="px-calendar-nav" :disabled="!canGoNextMonth" @click="changeMonth(1)" aria-label="Next month">&rsaquo;</button>
					</div>
					<div class="px-calendar-grid">
						<div class="px-calendar-weekday" v-for="w in weekdays" :key="w">{{ w }}</div>
						<template v-for="(cell, i) in calendarDays" :key="i">
							<span v-if="!cell"></span>
							<button
								v-else
								type="button"
								class="px-calendar-day"
								:class="{ 'is-selected': cell.iso === selectedDate }"
								:disabled="!cell.available"
								@click="selectDate(cell)"
							>{{ cell.day }}</button>
						</template>
					</div>
				</div>

				<p class="px-section-label">Available times</p>
				<div class="px-grid px-grid-slots" :key="selectedDate + '-' + selectedEmployeeId" v-if="timeSlots.length">
					<label
						v-for="(slot, index) in timeSlots"
						:key="slot.value"
						:for="'px-slot-' + slot.value"
						:style="{ '--px-delay': (index * 20) + 'ms' }"
						class="px-grid-item"
					>
						<input
							type="radio"
							name="px-slot"
							:id="'px-slot-' + slot.value"
							:value="slot.value"
							v-model="selectedSlot"
						>
						{{ slot.label }}
					</label>
				</div>
				<div class="px-empty" v-else>
					{{ selectedDate ? 'No time slots available on this date.' : 'No available dates in the next ' + maxBookingDays + ' days for this employee.' }}
				</div>
			</template>

			<!-- STEP 6: payment method (last step) -->
			<template v-else-if="step === 6">
				<div class="px-grid">
					<label
						v-for="(item, index) in paymentMethods"
						:key="item.id"
						:for="'px-payment-' + item.id"
						:style="{ '--px-delay': (index * 50) + 'ms' }"
						class="px-grid-item"
					>
						<input
							type="radio"
							name="px-payment"
							:id="'px-payment-' + item.id"
							:value="item.id"
							v-model="selectedPaymentId"
						>
						<span class="px-item-title">{{ item.name }}</span>
						<span class="px-item-meta">{{ item.description }}</span>
					</label>
				</div>
			</template>

			<!-- STEP 5: your information -->
			<template v-else-if="step === 5">
				<div class="px-fields-row">
					<div class="px-field">
						<label for="px-name">Full name</label>
						<input type="text" id="px-name" v-model="customer.name" autocomplete="name">
					</div>
					<div class="px-field">
						<label for="px-email">Email</label>
						<input type="email" id="px-email" v-model="customer.email" autocomplete="email">
					</div>
					<div class="px-field">
						<label for="px-phone">Phone</label>
						<input type="tel" id="px-phone" v-model="customer.phone" autocomplete="tel">
					</div>
				</div>
			</template>

			<div class="px-error" v-if="error" role="alert">{{ error }}</div>

			<div class="px-button-group">
				<button type="button" class="px-button" v-if="step > 1" @click="back">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="16px" width="16px" fill="currentColor">
						<path d="M10,22L0,12L10,2l1.78,1.77L3.55,12l8.23,8.23L10,22Z"/>
					</svg>
					<span>Back</span>
				</button>
				<span v-else></span>

				<button type="button" class="px-button px-button-primary" @click="next">
					{{ step === steps.length ? 'Confirm Booking' : 'Continue' }}
				</button>
			</div>
		</div>

		<div class="right-side">
			<div class="px-summary">Booking Summary</div>
			<div class="px-cart">
				<div class="px-cart-empty" v-if="!selectedService">Nothing selected yet.</div>

				<div class="px-cart-row" v-if="selectedService">
					<div class="px-summary-title">Service:</div>
					<div>{{ selectedService.name }}</div>
					<small v-if="selectedCategory">{{ selectedCategory.name }} &middot; {{ selectedService.duration }} min</small>
				</div>
				<div class="px-cart-row" v-if="selectedLocation">
					<div class="px-summary-title">Location:</div>
					<div>{{ selectedLocation.name }}</div>
					<small>{{ selectedLocation.address }}</small>
				</div>
				<div class="px-cart-row" v-if="selectedEmployee">
					<div class="px-summary-title">Employee:</div>
					<div>{{ selectedEmployee.name }}</div>
				</div>
				<div class="px-cart-row" v-if="selectedSlot !== null">
					<div class="px-summary-title">Date &amp; Time:</div>
					<div>{{ selectedDateLabel }}, {{ selectedSlotLabel }}</div>
				</div>

				<div class="px-cart-row" v-if="selectedPayment">
					<div class="px-summary-title">Payment:</div>
					<div>{{ selectedPayment.name }}</div>
				</div>

				<template v-if="selectedService">
					<div class="px-devider"></div>
					<div class="px-cart-total">
						<span>Total</span>
						<span>${{ selectedService.price }}</span>
					</div>
				</template>
			</div>
		</div>
	</div>
</fieldset>
