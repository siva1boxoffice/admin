<style>
	.check_box_status {
		padding: 0 15px;
		margin-top: 15px;
		margin-bottom: 15px;
	}
</style>
<?php $this->load->view(THEME . 'common/header'); ?>
<div id="overlay">
	<div id="loader">
		<!-- Add your loading spinner HTML or image here -->
		<img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
	</div>
</div>

<!-- Begin main content -->
<div class="main-content">
	<!-- content -->
	<div class="page-content">
		<!-- page header -->
		<div class="page-title-box">
			<div class="container-fluid">
				<!-- <div class="page-title dflex-between-center">
			   <h3 class="mb-1">Ticket Type Lists</h3>
			</div> -->
				<div class="page-title dflex-between-center">
					<h3 class="mb-1">Other Event Ticket Lists</h3>
					<div class="float-sm-right mt-3 mt-sm-0 add_team_s">
						<a href="<?php echo base_url(); ?>tickets/index/create_oe_ticket" class="btn btn-success mb-2">Add	Ticket</a>
					</div>
				</div>
			</div>
		</div>
		<!-- page content -->
		<div class="page-content-wrapper mt--45 all_orders_page">
			<div class="container-fluid">

				<div class="card">
					<div class="card-body">

						<div class="section_all ticket_sort_approval filter_new">
							<div class="">
								<!-- cta -->
								<div class="row">
									<div class="col-md-1 nopadds">
										<div class="sort_by">
											<span>Sort By:</span>
										</div>
									</div>
									<div class="col-md-11">
										<div class="sort_filters">
											<ul>
												<li class="sort_list">
													<div class="btn-group">
														<div class="dropdown">
															<button
																class="btn btn-light dropdown-toggle date_search_filter"
																type="button" id="dropdownMenuButton"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Date <i class="mdi mdi-chevron-down"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-custom"
																aria-labelledby="dropdownMenuButton">
																<form class="px-3 py-2">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group datemark">
																				<input class="form-control"
																					id="MyTextbox3" type="text"
																					name="MyTextbox" placeholder="From"
																					autocomplete="off">
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group datemark_to">
																				<input class="form-control"
																					id="MyTextbox2" type="text"
																					name="MyTextbox1" placeholder="To"
																					autocomplete="off">
																			</div>
																		</div>
																	</div>
																</form>
																<div class="reset_btn">
																	<div class="reset_txt"><button
																			class="btn btn-info reset_date">Reset</button>
																	</div>
																	<div class="reset_ok"><button
																			class="btn btn-info date_search">Search</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>


												<li class="sort_list">
													<div class="btn-group">
														<div class="dropdown">
															<button
																class="btn btn-light dropdown-toggle seller_name_btn"
																type="button" id="dropdownMenuButton"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Seller Name <i class="mdi mdi-chevron-down"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-custom"
																aria-labelledby="dropdownMenuButton">
																<div id="view_project_list_wrapper"
																	class="dataTables_wrapper dt-bootstrap4 no-footer">
																	<div id="view_project_list_filter"
																		class="dataTables_filter"><label
																			class="search-box d-inline-flex position-relative">Search:<input
																				type="search"
																				class="form-control form-control-sm search_box"
																				placeholder="Search in Filters..."
																				aria-controls="view_project_list"
																				id="seller_name"></label>
																	</div>
																</div>
																<div class="check_box">

																	<?php
																	echo $this->data['html'];
																	?>
																</div>
																<div class="reset_btn">
																	<div class="reset_txt"><button
																			class="btn btn-info seller_reset">Reset</button>
																	</div>
																	<div class="reset_ok"><button
																			class="btn btn-info seller_search">Search</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>


												<li class="sort_list">
													<div class="btn-group">
														<div class="dropdown">
															<button
																class="btn btn-light dropdown-toggle event_name_filter"
																type="button" id="dropdownMenuButton"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Event Name <i class="mdi mdi-chevron-down"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-custom"
																aria-labelledby="dropdownMenuButton">
																<div id="view_project_list_wrapper"
																	class="dataTables_wrapper dt-bootstrap4 no-footer">
																	<div id="view_project_list_filter"
																		class="dataTables_filter"><label
																			class="search-box d-inline-flex position-relative">Search:<input
																				type="search" id="event_name"
																				class="form-control form-control-sm"
																				placeholder="Search in Filters..."
																				aria-controls="view_project_list"></label>
																	</div>
																</div>
																<div class="reset_btn">
																	<div class="reset_txt"><button
																			class="btn btn-info event_reset">Reset</button>
																	</div>
																	<div class="reset_ok"><button
																			class="btn btn-info event_search_ok">Search</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>

												<li class="sort_list">
													<div class="btn-group">
														<div class="dropdown">
															<button
																class="btn btn-light dropdown-toggle tournament_name_filter"
																type="button" id="dropdownMenuButton"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Tournament <i class="mdi mdi-chevron-down"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-custom"
																aria-labelledby="dropdownMenuButton">
																<div id="view_project_list_wrapper"
																	class="dataTables_wrapper dt-bootstrap4 no-footer">
																	<div id="view_project_list_filter"
																		class="dataTables_filter"><label
																			class="search-box d-inline-flex position-relative">Search:<input
																				type="search" id="tournament_name"
																				class="form-control form-control-sm"
																				placeholder="Search in Filters..."
																				aria-controls="view_project_list"></label>
																	</div>
																</div>
																<div class="reset_btn">
																	<div class="reset_txt"><button
																			class="btn btn-info tournament_reset">Reset</button>
																	</div>
																	<div class="reset_ok"><button
																			class="btn btn-info tournament_search">Search</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>

												<li class="sort_list">
													<div class="btn-group">
														<div class="dropdown">
															<button
																class="btn btn-light dropdown-toggle stadium_name_filter"
																type="button" id="dropdownMenuButton"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Stadium <i class="mdi mdi-chevron-down"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-custom"
																aria-labelledby="dropdownMenuButton">
																<div id="view_project_list_wrapper"
																	class="dataTables_wrapper dt-bootstrap4 no-footer">
																	<div id="view_project_list_filter"
																		class="dataTables_filter"><label
																			class="search-box d-inline-flex position-relative">Search:<input
																				type="search" id="stadium_name"
																				class="form-control form-control-sm"
																				placeholder="Search in Filters..."
																				aria-controls="view_project_list"></label>
																	</div>
																</div>
																<div class="reset_btn">
																	<div class="reset_txt"><button
																			class="btn btn-info stadium_reset">Reset</button>
																	</div>
																	<div class="reset_ok"><button
																			class="btn btn-info stadium_search">Search</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>

												<li class="sort_list">
													<a class="clear_all" href="javascript:void(0)">Clear All</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="">
							<table style='width:100% !important' id="ticket-type-list"
								class="table table-hover table-nowrap mb-0 tournament">
								<thead class="thead-light">
									<tr>
										<th></th>
										<th>Date</th>
										<th>Event</th>
										<th>Tournament</th>
										<th>Stadium</th>
										<th>City</th>
										<th>Country</th>
										<th>QTY</th>
										<th>Sold</th>
										<th>Price Range</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- main content End -->

<?php $this->load->view(THEME . 'common/footer'); ?>
<script>
	$(document).ready(function () {
		var overlay = $('#overlay');
		var Dtable = $('#ticket-type-list').DataTable({
			'info': false,
			'serverSide': true,
			'serverMethod': 'post',
			'scrollX': !0,
			"pageLength": 50,
			"targets": 'no-sort',
			"bSort": false,
			"ajax": {
				url: base_url + 'tickets/get_oe_ticket_list',
				data: function (d) {

					var fromDate = document.getElementById('MyTextbox3').value;
					var toDate = document.getElementById('MyTextbox2').value;

					var checkedIds = [];
					$(".check_box input:checked").each(function () {

						var ID = $(this).attr('id');
						var newID = ID.replace("customCheck", "");

						checkedIds.push(newID);
					});

					var event_name = $("#event_name").val();
					var tournament_name = $("#tournament_name").val();
					var stadium_name = $("#stadium_name").val();

					d.event_start_date = fromDate;
					d.event_end_date = toDate;
					d.seller_name = checkedIds;
					d.event = event_name;
					d.tournament_name = tournament_name;
					d.stadium_name = stadium_name;

				},
				beforeSend: function () {
					// Show the loader before the request is sent
					overlay.show();
				},
				complete: function () {
					// Hide the loader after the request is completed
					overlay.hide();
				},

			},
			language: {
				paginate: {
					previous: "<i class='mdi mdi-chevron-left'>",
					next: "<i class='mdi mdi-chevron-right'>"
				},
			},
			drawCallback: function () {

				$(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
			},
			'columns': [
				{ data: 'mark_as_completed' },
				{ data: 'event_date' },
				{ data: 'event' },
				{ data: 'tournament_name' },
				{ data: 'stadium_name' },
				{ data: 'city_name' },
				{ data: 'country_name' },
				{ data: 'qty' },
				{ data: 'total_sold' },
				{ data: 'price_range' },
				{ data: 'action' },

			],
		});

		$(".search_box").on('keyup', function () {
			var value = $(this).val().toLowerCase();
			$(this).parents(".dropdown-menu").find(".custom-checkbox").each(function () {
				if ($(this).find("label").text().toLowerCase().search(value) > -1) {
					$(this).show();

				} else {
					$(this).hide();
				}
			});
		});

		$('.dropdown-menu-custom .check_box').click(function (e) {
			e.stopPropagation();
		});
		$('.dropdown-menu-custom .check_box_status').click(function (e) {
			e.stopPropagation();
		});

		$('.country_search').on('click', function (e) {
			$('.country_search_filter').addClass("filter_active");
			Dtable.ajax.reload();
		});


		$(".clear_all").on('click', function () {
			$('.check_box input:checked').prop('checked', false);
			$(".status").prop('checked', false);

			$('.date_search_filter').removeClass("filter_active");
			$('.seller_name_btn').removeClass("filter_active");
			$('.event_name_filter').removeClass("filter_active");
			$('.tournament_name_filter').removeClass("filter_active");
			$('.stadium_name_filter').removeClass("filter_active");


			$("#booking_no").val('');
			$("#seller_name").val('');
			$("#event_name").val('');
			$("#tournament_name").val('');
			$("#stadium_name").val('');
			$("#MyTextbox2").datepicker("setDate", null); // clear selected date value
			$("#MyTextbox3").datepicker("setDate", null); // clear selected date value

			$('.seller_name_btn').text("Seller Name");

			resetFilters();
			//Dtable.ajax.reload();
		});


		$(".check_box").change(function () {
			var checkedCount = $('.check_box input:checked').length;

			if (checkedCount > 0) {
				$('.country_search_filter ').text(checkedCount + " Selected");
			}
			else
				$('.country_search_filter ').text("Country Name");

		});

		$(".check_box_status").change(function () {
			var checkedCount = $('.check_box_status input:checked').length;

			if (checkedCount > 0) {
				$('.status_search_filter ').text(checkedCount + " Selected");
			}
			else
				$('.status_search_filter ').text("Status");

		});

		$('.status_search').on('click', function (e) {
			$('.status_search_filter').addClass("filter_active");
			var dropdown = $(this).closest('.dropdown');
			var statusCount = dropdown.find(".check_box input:checked").length;
			$('.status_search_filter').text(statusCount + " Selected");
			applyFilters();
		});

		$("body").on("click", ".status_reset", function () {
			$('.status_search_filter').removeClass("filter_active");
			$(".check_box .custom-checkbox input").prop('checked', false);

			var checkedCount = $('.check_box input:checked').length;
			if (checkedCount > 0) {
				$('.status_search_filter').text(checkedCount + " Selected");
			}
			else
				$('.status_search_filter').text("Status");


			updateFilters("status");
			Dtable.ajax.reload();
		});

		$("body").on("click", ".search_ok", function () {
			$('.ticket_search_filter').addClass("filter_active");
			applyFilters();
			//Dtable.ajax.reload();
		});

		$("body").on("click", ".split_reset", function () {
			$('.ticket_search_filter').removeClass("filter_active");
			$('#ticket_type').val('');
			updateFilters("ticket_type");
			Dtable.ajax.reload();
		});

		function applyFilters() {
			var checkedIds = [];
			$(".check_box input:checked").each(function () {
				var ID = $(this).attr('id');
				checkedIds.push(ID);
			});

			const fromDate = document.getElementById('MyTextbox3').value;
			const toDate = document.getElementById('MyTextbox2').value;
			const seller_name = checkedIds;
			const event_name = document.getElementById('event_name').value;
			const tournament_name = document.getElementById('tournament_name').value;
			const stadium_name = document.getElementById('stadium_name').value;


			var filters = {
				fromDate: fromDate,
				toDate: toDate,
				seller_name: checkedIds,
				event_name: event_name,
				tournament_name: tournament_name,
				stadium_name: stadium_name,
				// ... Add other filters
			};
			sessionStorage.setItem('ticket_list_filter', JSON.stringify(filters));
			Dtable.draw();

		}


		function resetFilters() {
			// Save the filter values in session storage
			var filters = {
				fromDate: "",
				toDate: "",
				seller_name: "",
				event_name: "",
				torunament_name: "",
				stadium_name: "",
			};
			sessionStorage.setItem('ticket_list_filter', JSON.stringify(filters));
			Dtable.draw();

		}

		var storedFilters = sessionStorage.getItem('ticket_list_filter');
		if (storedFilters) {
			var filters = JSON.parse(storedFilters);


			var fromDate = filters.fromDate;
			var toDate = filters.toDate;
			var seller_name = filters.seller_name;
			var event_name = filters.event_name;
			var tournament_name = filters.tournament_name;
			var stadium_name = filters.stadium_name;

			$(".check_box input[type='checkbox']").each(function () {
				var ID = $(this).attr('id');

				if ($(this).closest('.check_box').length) {
					// Checkbox belongs to the seat category group
					if (seller_name.includes(ID)) {
						$(this).prop("checked", true);
					} else {
						$(this).prop("checked", false);
					}
				}
			});


			$('#MyTextbox3').val(fromDate);
			$('#MyTextbox2').val(toDate);
			$('#event_name').val(event_name);
			$('#tournament_name').val(tournament_name);
			$('#stadium_name').val(stadium_name);


			if ((fromDate && toDate)) {
				$('.date_search_filter').addClass("filter_active");
			}

			if (event_name) {
				$('.event_name_filter ').addClass("filter_active");
			}

			if (tournament_name) {
				$('.tournament_name_filter ').addClass("filter_active");
			}

			if (stadium_name) {
				$('.stadium_name_filter ').addClass("filter_active");
			}

			if (seller_name && seller_name.length > 0) {
				$('.seller_name_btn').addClass("filter_active");
				$('.seller_name_btn').text(seller_name.length + " Selected");
			}

			Dtable.ajax.reload()
		}


		function updateFilters(argName) {
			// Retrieve filters object from sessionStorage
			var filters = JSON.parse(sessionStorage.getItem('ticket_list_filter'));

			// Check if sales_summary_seller_name has a value
			if (filters[argName] && filters[argName] !== "") {
				// Clear the remaining values while keeping the existing ticket_type_seller_name value
				filters[argName] = "";
				filters = {
					fromDate: filters.fromDate,
					toDate: filters.toDate,
					seller_name: filters.seller_name,
					event_name: filters.event_name,
					tournament_name: filters.tournament_name,
					stadium_name: filters.stadium_name
				};
			}

			// Update sessionStorage with the modified filters object
			sessionStorage.setItem('ticket_list_filter', JSON.stringify(filters));
		}

		$(document).on('change', '.all_ticket_status_new', function () {
				var match_id = $(this).data('match_id');
				var ticket_status = $(this).is(':checked');
				var flag = "";

				// Make an AJAX POST request
				$.ajax({
					url: base_url + 'tickets/index/ticket_update_status',
					type: 'POST',
					dataType: 'json',
					data: {
						"match_id": match_id,
						"ticket_status": ticket_status,
						"flag": flag
					},
					success: function (data) {
						if (data.status == 1) {
							swal('Updated !', data.msg, 'success');

						} else if (data.status == 0) {

							swal('Updation Failed !', data.msg, 'error');

						}
						 setTimeout(function () { window.location.reload(); }, 2000);
					},
					error: function (xhr, status, error) {
						// Handle the error here
						console.log(error);
					}
				});
			//}
		});

		$('.date_search').click(function (event) {

			$('.date_search_filter').addClass("filter_active");

			const fromDate = document.getElementById('MyTextbox3').value;
			const toDate = document.getElementById('MyTextbox2').value;
			console.log('Chosen date:', toDate);

			// Validate the from date
			if (!fromDate) {
				alert('From date cannot be empty!');
				return;
			}

			// Validate the to date
			if (!toDate) {
				alert('To date cannot be empty!');
				return;
			}

			if (new Date(toDate) <= new Date(fromDate)) {
				alert('To date must be greater than From date!');
				return;
			}

			applyFilters();

			//Dtable.draw();

		});


		$('.seller_search').on('click', function (e) {
			$('.seller_name_btn').addClass("filter_active");

			var checkedCount = $('.check_box input:checked').length;

			if (checkedCount > 0) {
				$('.seller_name_btn').text(checkedCount + " Selected");
			}
			else
				$('.seller_name_btn').text("Seller Name");
			//Dtable.draw();
			applyFilters();
			//Dtable.draw();
		});


		$('.seller_reset').click(function () {
			$('.seller_name_btn').removeClass("filter_active");
			$('.seller_name_btn').text("Seller Name");
			$("#seller_name").val('');
			$('.check_box input:checked').prop('checked', false);
			updateFilters("seller_name");
			Dtable.ajax.reload();
		});
		//   


		$('.reset_date').click(function () {
			$('.date_search_filter').removeClass("filter_active");
			$("#MyTextbox2").datepicker("setDate", null); // clear selected date value
			$("#MyTextbox3").datepicker("setDate", null); // clear selected date value
			updateFilters("fromDate");
			updateFilters("toDate");
			Dtable.ajax.reload();
			$('.dropdown-menu-custom').removeClass('show');
			$('.dropdown').removeClass('show');
		});

		const datepicker = document.getElementById('MyTextbox2');
		const to_datepicker = document.getElementById('MyTextbox3');

		// Initialize the datepicker
		$(datepicker).datepicker({
			// onSelect: function (datesel) {
			//    $('#MyTextbox2').trigger('change')
			// }, maxDate: new Date()
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
		}
		);
		$(to_datepicker).datepicker(
			{
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
			}
		);

		$('.event_search_ok').on('click', function (e) {
			$('.event_name_filter').addClass("filter_active");
			// Dtable.draw();
			applyFilters();
			//Dtable.ajax.reload();
		});

		$('.event_reset').click(function () {
			$('.event_name_filter').removeClass("filter_active");
			$("#event_name").val(''); // clear selected date value
			updateFilters("event_name");
			Dtable.ajax.reload();
		});

		$('.tournament_search').on('click', function (e) {
			$('.tournament_name_filter').addClass("filter_active");
			//Dtable.draw();
			applyFilters();
		});

		$('.tournament_reset').click(function () {
			$('.tournament_name_filter').removeClass("filter_active");
			$("#tournament_name").val(''); // clear selected date value
			updateFilters("tournament_name");
			Dtable.ajax.reload();
		});

		$('.stadium_search').on('click', function (e) {
			$('.stadium_name_filter').addClass("filter_active");
			//Dtable.draw();
			applyFilters();
		});

		$('.stadium_reset').click(function () {
			$('.stadium_name_filter').removeClass("filter_active");
			$("#stadium_name").val(''); // clear selected date value
			updateFilters("stadium_name");
			Dtable.ajax.reload();
		});

	});
</script>