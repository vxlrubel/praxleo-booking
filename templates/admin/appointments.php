<div class="wrap" id="appointment" v-cloak>
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Appointments', 'praxleo-booking' ); ?></h1>
	<a href="javascript:void(0)" class="page-title-action" @click.prevent="open_add_new_appointment_modal()">
		<?php esc_html_e( 'Add Appointment', 'praxleo-booking' ); ?>
	</a>

	<hr class="wp-header-end">

	<ul class="subsubsub">
		<li class="all">
			<a href="javascript:void(0)" class="current" aria-current="page">All <span class="count">(15)</span></a> |
		</li>
		<li class="publish">
			<a href="javascript:void(0)">Approved <span class="count">(9)</span></a>
		</li>
		<li class="draft">
			<a href="javascript:void(0)">Pending <span class="count">(4)</span></a>
		</li>
		<li class="draft">
			<a href="javascript:void(0)">Cancel <span class="count">(2)</span></a>
		</li>
		<li class="trash">
			<a href="javascript:void(0)">Trash <span class="count">(7)</span></a>
		</li>
	</ul>

	<form method="get">
		<p class="search-box">
			<label class="screen-reader-text" for="post-search-input">Search Appoientment:</label>
			<input type="search" id="post-search-input" name="s" value="" />
			<button type="button" id="search-submit" class="button action button-compact">Search</button>
		</p>

		<div class="tablenav top">
			<div class="alignleft actions bulkactions">
				<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label
				><select name="action" id="bulk-action-selector-top">
					<option value="-1">Bulk actions</option>
					<option class="hide-if-no-js">Approve</option>
					<option class="hide-if-no-js">Pending</option>
					<option>Move to Trash</option>
				</select>
				<button type="button" id="doaction" class="button action button-compact">Apply</button>
			</div>

			<div class="alignleft actions">
				<label for="filter-by-date" class="screen-reader-text">Filter by date</label>
				<select name="m" id="filter-by-date">
					<option selected="selected" value="0">All dates</option>
					<option value="202610">October 2026</option>
					<option value="202610">November 2026</option>
				</select>
				<label class="screen-reader-text" for="cat">Filter by category</label
				><select id="cat" class="postform">
					<option>All Categories</option>
					<option class="level-0">Travel Vaccination</option>
					<option class="level-0">Oral Vaccine</option>
					<option class="level-0">Hair Loss</option>
					<option class="level-0">Weight Loss</option>
				</select>
				<button type="button" class="button button-compact">
					Filter
				</button>
			</div>
			<div class="alignright actions" style="padding-right: 0;">
				<button type="button" class="button button-compact">
					Export
				</button>
			</div>
			<div class="alignright actions">
				<button type="button" class="button button-compact">
					Import
				</button>
			</div>
			<div class="alignright actions">
				<button
					@click="open_filter_options = true"
					type="button" class="button button-compact inline-center">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="16px" width="16px" fill="currentColor">
						<path d="M5,20V13H3V11H9v2H7v7H5ZM5,9V4H7V9H5ZM9,9V7h2V4h2V7h2V9H9Zm2,11V11h2v9H11Zm6,0V17H15V15h6v2H19v3H17Zm0-7V4h2v9H17Z"/>
					</svg>
				</button>
			</div>

			<br class="clear" />
		</div>

		<h2 class="screen-reader-text">Appointment list</h2>

		<table class="wp-list-table widefat fixed striped table-view-list">
			<caption class="screen-reader-text">
				Table ordered by Date. Descending.
			</caption>
			<thead>
				<tr>
					<td id="cb" class="manage-column column-cb check-column">
						<input id="cb-select-all-1" type="checkbox" />
						<label for="cb-select-all-1"><span class="screen-reader-text">Select All</span></label>
					</td>
					<td scope="col" class="manage-column" style="max-width: 150px; width: 150px;"  v-if="table_columns.ref_id">Reference ID</td>
					<td
						v-if="table_columns.appointment_date"
						scope="col" class="manage-column" style="max-width: 150px; width: 150px;">Appointment Date</td>
					<th
						v-if="table_columns.service"
						scope="col" id="service" class="manage-column column-title column-primary sortable desc" abbr="Service">
						<a href="javascript:void(0)">
							<span>Service</span >
							<span class="sorting-indicators">
								<span class="sorting-indicator asc" aria-hidden="true"></span>
								<span class="sorting-indicator desc" aria-hidden="true"></span>
							</span>
							<span class="screen-reader-text">Sort ascending.</span>
						</a>
					</th>
					<td
						v-if="table_columns.customer"
						scope="col" class="manage-column column-title">Customer</td>
					<td
						v-if="table_columns.category"
						scope="col" class="manage-column column-title">Categories</td>
					<td
						v-if="table_columns.price"
						scope="col" class="manage-column column-title">Price</td>
					<td
						v-if="table_columns.payment_status"
						scope="col" class="manage-column column-title">Payment Status</td>
					<td
						v-if="table_columns.created_at"
						scope="col" class="manage-column column-title">Created At</td>
				</tr>
			</thead>
			<tbody>
				<tr class="iedit status-publish format-standard" v-for="n in 100">
					<td class="check-column">
						<input id="cb-select-1" type="checkbox" name="post[]" value="1" />
						<div class="locked-indicator">
							<span class="locked-indicator-icon" aria-hidden="true"></span>
							<span class="screen-reader-text"> “Hello world!” is locked </span>
						</div>
					</td>
					<td scope="row"
						v-if="table_columns.ref_id"
						class="has-row-actions column-primary"
						data-colname="Title"
						aria-label="Hello world!">
						<div>PXA-AK7RKSHAR85</div>
						<div class="row-actions">
							<span class="edit">
								<a href="javascript:void(0)" aria-label="Hepatytis B Vaccine"
									>Edit
								</a>
								|
							</span>
							<span class="trash">
								<a href="javascript:void(0)" class="submitdelete">Trash</a>
							</span>
						</div>
					</td>
					<td
						v-if="table_columns.appointment_date"
						scope="row" class="has-row-actions column-primary">
							20 Oct 2026 at 7:29 pm
					</td>
					<td
						v-if="table_columns.service"
						scope="row" class="has-row-actions column-primary">
						<strong>
							<a href="javascript:void(0)">
								Hepatytis B Vaccine
							</a>
						</strong>
					</td>
					<td
						v-if="table_columns.customer"
						scope="row" class="has-row-actions column-primary">
						<a href="javascript:void(0)">Elizabeth Anderson</a>
					</td>
					<td
						v-if="table_columns.category"
						scope="row" class="has-row-actions column-primary">
						<a href="javascript:void(0)">Oral Vaccine</a>
					</td>
					<td
						v-if="table_columns.price"
						scope="row" class="has-row-actions column-primary">
						$29.99
					</td>
					<td
						v-if="table_columns.payment_status"
						scope="row" class="has-row-actions column-primary">
						Pending
					</td>
					<td
						v-if="table_columns.created_at"
						scope="row" class="has-row-actions column-primary">
						2026/10/20 at 7:29 pm
					</td>
				</tr>

			</tbody>
		</table>
	</form>



	<!-- add new appointment modal -->
	<template v-if="add_new_appointment_modal">
		<div class="px-modal">
			<div class="px-modal-content">
				<div class="px-modal-header">
					<div class="px-modal-title"><?php esc_html_e( 'Add New Appointment', 'praxleo-booking' ); ?></div>
					<button type="button" class="px-close-button" @click="close_add_new_appointment_modal()"><span class="dashicons dashicons-no-alt" ></span></button>
				</div>

				<div class="px-modal-body">
					body content
					p*500>lorem20

				</div>

				<div class="px-modal-footer">
					<button type="button" class="button" @click="close_add_new_appointment_modal()">Close</button>
					<button type="button" class="button button-primary">Save Changes</button>
				</div>

			</div>
		</div>
	</template>

	<template v-if="open_filter_options">
		<div
			style="--px-modal-max-width: 720px;"
			class="px-modal">
			<div class="px-modal-content">
				<div class="px-modal-header">
					<div class="px-modal-title"><?php esc_html_e( 'Settings', 'praxleo-booking' ); ?></div>
					<button
						@click="open_filter_options = false"
						type="button" class="px-close-button">
						<span class="dashicons dashicons-no-alt" ></span>
					</button>
				</div>

				<div class="px-modal-body">
					<strong>Table List column:</strong>
					<div class="column-enable-disable-field">
						<label
							@click="table_columns.ref_id = !table_columns.ref_id"
							for="refId">
							<input type="checkbox" v-model="table_columns.ref_id" id="refId"> Reference ID
						</label>
						<label
							@click="table_columns.appointment_date = !table_columns.appointment_date"
							for="appointmentID">
							<input type="checkbox" v-model="table_columns.appointment_date" id="appointmentID"> Appointment Date
						</label>
						<label
							@click="table_columns.service = !table_columns.service"
							for="serviceID">
							<input type="checkbox" v-model="table_columns.service" id="serviceID"> Service
						</label>
						<label
							@click="table_columns.customer = !table_columns.customer"
							for="customerID">
							<input type="checkbox" v-model="table_columns.customer" id="customerID"> Customer
						</label>
						<label
							@click="table_columns.category = !table_columns.category"
							for="catID">
							<input type="checkbox" v-model="table_columns.category" id="catID"> Categories
						</label>
						<label
							@click="table_columns.price = !table_columns.price"
							for="priceID">
							<input type="checkbox" v-model="table_columns.price" id="priceID"> Price
						</label>
						<label
							@click="table_columns.payment_status = !table_columns.payment_status"
							for="paymentID">
							<input type="checkbox" v-model="table_columns.payment_status" id="paymentID"> Payment Status
						</label>
						<label
							@click="table_columns.created_at = !table_columns.created_at"
							for="createID">
							<input type="checkbox" v-model="table_columns.created_at" id="createID"> Created At
						</label>
					</div>
				</div>

				<div class="px-modal-footer">
					<button type="button" class="button" @click="open_filter_options = false">Close</button>
					<button type="button" class="button button-primary">Save Changes</button>
				</div>

			</div>
		</div>
	</template>


</div>
