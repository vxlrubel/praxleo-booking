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

	<div style="display: block">
		<label for="">
			<input type="checkbox" v-model="table_columns.ref_id"> RefID {{table_columns.ref_id}}
		</label>
	</div>



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
			<div class="alignleft actions">
				<button type="button" class="button button-compact">
					Export
				</button>
			</div>
			<div class="alignleft actions">
				<button type="button" class="button button-compact">
					Import
				</button>
			</div>
			<div class="tablenav-pages one-page">
				<span class="displaying-num">1 item</span>
				<span class="pagination-links"
					><span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>
					<span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>
					<span class="paging-input"
						><label for="current-page-selector" class="screen-reader-text">Current Page</label
						><input
							class="current-page"
							id="current-page-selector"
							type="text"
							name="paged"
							value="1"
							size="1"
							aria-describedby="table-paging"
						/><span class="tablenav-paging-text"> of <span class="total-pages">1</span></span></span
					>
					<span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>
					<span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span></span
				>
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
					<td scope="col" class="manage-column" style="max-width: 150px; width: 150px;">Appointment Date</td>
					<th scope="col" id="service" class="manage-column column-title column-primary sortable desc" abbr="Service">
						<a href="javascript:void(0)">
							<span>Service</span >
							<span class="sorting-indicators">
								<span class="sorting-indicator asc" aria-hidden="true"></span>
								<span class="sorting-indicator desc" aria-hidden="true"></span>
							</span>
							<span class="screen-reader-text">Sort ascending.</span>
						</a>
					</th>
					<td scope="col" class="manage-column column-title">Customer</td>
					<td scope="col" class="manage-column column-title">Categories</td>
					<td scope="col" class="manage-column column-title">Price</td>
					<td scope="col" class="manage-column column-title">Payment Status</td>
					<td scope="col" class="manage-column column-title">Created At</td>
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
					<td scope="row" class="has-row-actions column-primary">
							20 Oct 2026 at 7:29 pm
					</td>
					<td scope="row" class="has-row-actions column-primary">
						<strong>
							<a href="javascript:void(0)">
								Hepatytis B Vaccine
							</a>
						</strong>
					</td>
					<td scope="row" class="has-row-actions column-primary">
						<a href="javascript:void(0)">Elizabeth Anderson</a>
					</td>
					<td scope="row" class="has-row-actions column-primary">
						<a href="javascript:void(0)">Oral Vaccine</a>
					</td>
					<td scope="row" class="has-row-actions column-primary">
						$29.99
					</td>
					<td scope="row" class="has-row-actions column-primary">
						Pending
					</td>
					<td scope="row" class="has-row-actions column-primary">
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
					<button type="button" class="px-primacy-button" @click="close_add_new_appointment_modal()">Close</button>
					<button type="button" class="px-primacy-button">Save Changes</button>
				</div>

			</div>
		</div>
	</template>


</div>
