<fieldset class="px-booking-form" id="bookingForm" v-cloak>
	<legend>Form Step: 1 of 5</legend>
	<div class="px-form-header">Service</div>
	<div class="px-form-body">
		<div class="left-side">

			<div class="px-grid">
				<label
					v-for="(item, index) in services"
					:key="item.id"
					:for="'px-connector-' + item.id"
					:style="{ '--px-delay': (item.id * 50) + 'ms' }"
					class="px-grid-item"
				>
					<input
						type="radio"
						:id="'px-connector-' + item.id"
						:value="item.id"
						v-model="selectedServiceId"
					>
					{{ item.name }}
				</label>
			</div>

			<div class="px-button-group">
				<button type="button" class="px-button">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="16px" width="16px" fill="currentColor">
						<path d="M10,22L0,12L10,2l1.78,1.77L3.55,12l8.23,8.23L10,22Z"/>
					</svg>
					<span>Back</span>
				</button>
				<button type="button" class="px-button px-button-primary">
					Continue
				</button>
			</div>
		</div>
		<div class="right-side">
			<div class="px-summary">Booking Summary</div>
			<div class="px-cart">
				<div class="px-summary-title">Service:</div>
				<div>Maleria tablet malarone</div>
				<div class="px-devider"></div>
			</div>
		</div>
	</div>

</fieldset>
