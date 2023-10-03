        <?php $this->load->view('common/header'); ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
        <!-- Content Wrapper -->
        <div id="app-apex-charts" class="view-wrapper is-webapp" data-page-title="Add Details" data-naver-offset="150" data-menu-item="#dashboards-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

        	<div class="page-content-wrapper">
        		<div class="page-content is-relative">
        			<form id="create_ticket" action="<?php echo base_url(); ?>tickets/create_ticket" class="form-horizontal validate_form_v1" method="post">
        				<div class="page-content-inner all-projects">
        					<h2>Select Match Event *</h2>
        					<div class="">
        						<div class="control has-icon">
        							<select name="add_eventname_addlist[]" id="add_event_name" class="input sell_select">
        								<option value="">-Choose Match Event-</option>
        								<?php foreach ($matches as $matche) { ?>
        									<option value="<?php echo $matche->m_id; ?>"><?php echo $matche->match_name; ?> - <?php echo $matche->match_date_format; ?></option>
        								<?php } ?>
        							</select>
        							<div class="form-icon">
        								<i data-feather="search"></i>
        							</div>
        						</div>
        					</div>

        					<!--Food Delivery Dashboard-->
        					<div class="food-delivery-dashboard">

        						<!--Left-->
        						<div class="left" id="left_event" >
        							<div class="page-content-inner all-projects">
        								<h2>Choose ticket type</h2>
        								<div class="columns is-multiline project-grid">
        									<?php
											$ticket_key = 0;
											foreach ($ticket_types as $ticket_type) { ?>
        										<div class="column is-one-fourth">
        											<a class="project-grid-item">
        												<div class="radio-toolbar">
        													<input type="radio" id="radio_ticket_<?php echo $ticket_key; ?><?php echo $ticket_key; ?>" name="ticket_types[]" value="<?php echo $ticket_type->id; ?>">
        													<label for="radio_ticket_<?php echo $ticket_key; ?><?php echo $ticket_key; ?>">
        														<h3><?php echo $ticket_type->tickettype; ?></h3>
        														<p>Printed tickets, not in electronic format</p>
        													</label>
        												</div>
        											</a>
        										</div>
        									<?php $ticket_key++;
											} ?>
        								</div>
        							</div>
        							<div class="left-body">
        								<div class="restaurants">
        									<div class="restaurants-toolbar">
        										<div class="left">
        											<h3>Enter Number of Tickets</h3>
        										</div>
        										<div class="right">
        										</div>
        									</div>
        									<div class="food-pills">
        										<div class="food-pills-inner pill-carousel">
        											<!--Pill-->
        											<?php for ($i = 1; $i <= $ticket_max; $i++) { ?>
        												<div class="food-pill" onclick="getticketQty(<?php echo $i; ?>);">
        													<div class="radio-toolbar">
        														<input type="radio" id="getticketQty_<?php echo $i; ?>" name="add_qty_addlist[]" value="<?php echo $i; ?>">
        														<span><?php echo $i; ?></span>
        													</div>
        												</div>
        											<?php } ?>
        										</div>
        									</div>

        									<div class="page-content-inner all-projects">
        										<h2>Choose Split Type</h2>
        										<div class="columns is-multiline project-grid">
        											<?php
													$split_key = 0;
													foreach ($split_types as $split_type) { ?>
        												<div class="column is-one-third">
        													<a class="project-grid-item">
        														<div class="radio-toolbar">
        															<input type="radio" id="radio_split_<?php echo $split_key; ?>" name="split_type[]" value="<?php echo $split_type->id; ?>">
        															<label for="radio_split_<?php echo $split_key; ?>">
        																<h3><?php echo $split_type->splittype; ?></h3>
        																<p>Any number of tickets may be purchased</p>
        															</label>
        														</div>
        													</a>
        												</div>
        											<?php $split_key++;
													} ?>
        										</div>
        									</div>

        									<div class="page-content-inner all-projects">
        										<h2>Enter Seating Details</h2>
        										<div class="field">
        											<p>You are required to provide section, row and seat information if this information is available to you at the time of listing.If you do not have all of this information at present, you may list your tickets,but you must update your listing once you have this information.Listings can be updated using My Account.</p>
        											<div class="restaurants-list">
        												<div class="columns is-multiline">
        													<!--Restaurant-->
        													<div class="column is-6">
        														<label for="section">Section *:</label>
        														<div class="control">
        															<select class="form-control" id="ticket_category" name="ticket_category[]" onchange="get_block(this.value);">
        																<option value="">-Ticket Category-</option>
        															</select>

        														</div>
        													</div>
        													<div class="column is-6">
        														<label for="section">Block *</label>
        														<div class="control">
        															<select class="form-control" id="ticket_block" name="ticket_block">
        																<option value="">-Ticket Block-</option>
        															</select>
        														</div>
        													</div>
        												</div>

        												<div class="columns is-multiline">
        													<div class="column is-6">
        														<label for="section">Row</label>
        														<div class="control">
        															<input type="text" class="input" placeholder="Row" name="row" value="">
        														</div>
        													</div>

        													<div class="column is-6">
        														<label for="section">Home/Away</label>

        														<div class="control">
        															<select class="form-control" id="home_town" name="home_town">
        																<option value="0">Any</option>
        																<option value="1">Home</option>
        																<option value="2">Away</option>
        															</select>

        														</div>
        													</div>
        												</div>
        											</div>
        										</div>
        									</div>

        									<div class="page-content-inner all-projects">

        										<h2>Enter Selling Price</h2>
        										<div class="field">
        											<div class="restaurants-list">
        												<div class="columns is-multiline">
        													<!--Restaurant-->
        													<div class="column is-6">
        														<label for="section">Selling Currency</label>
        														<div class="control">
        															<select class="form-control" id="add_pricetype_addlist" name="add_pricetype_addlist[]">
        															</select>
        														</div>
        													</div>
        													<div class="column is-6">
        														<label for="section">Price *</label>
        														<div class="control">
       <input type="text" class="input" placeholder="10.00" name="add_price_addlist[]" id="add_price_addlist">
        														</div>
        													</div>





        												</div>


        											</div>
        										</div>

        									</div>




        									<div class="page-content-inner all-projects">

        										<h2>Select required ticket details</h2>
        										<div class="field">
        											<p>If any of the following conditiond apply to your tickets, you must select the correspoding options below.</p>
        											<div class="control">
        												<?php
														$ticket_key = 0;
														foreach ($ticket_details as $ticket_detail) { ?>
        													<label class="checkbox">
        														<input type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>">
        														<span></span>
        														<?php echo $ticket_detail->ticket_det_name; ?>
        													</label>
        												<?php $ticket_key++;
														} ?>
        											</div>
        										</div>
        									</div>

        									<div class="page-content-inner all-projects">
        										<div class="button-wrap">
        											<button type="submit" class="button h-button is-primary is-bold is-raised is-fullwidth">Create Ticket and Continue</button>
        										</div>
        									</div>
        								</div>
        							</div>
        						</div>

        						<div class="right fixed-parent" id="right_event" >
        							<div class="page-content-inner all-projects">

        								<h2>Event Information</h2>
        							</div>
        							<div class="sticky-panel fixed-child">
        								<div id="cart-section" class="cart-widget side-section is-active">
        									<div class="widget-toolbar">
        										<h3 class="is-bigger" id="res-match-name">Event Not Availabale</h3>
        									</div>

        									<div class="cart-button">
        										<div class="total">
        											<span class="label">Match Date</span>
        											<span id="res-match-date">Not Available</span>
        										</div>

        										<div class="total">
        											<span class="label">Match Time</span>
        											<span id="res-match-time">Not Available</span>
        										</div>

        										<div class="total">
        											<span class="label">Match Location</span>
        											<span id="res-match-place">0</span>
        										</div>
        										<div class="total">
        											<span class="label">Number of tickets</span>
        											<span id="matchticket">0</span>
        										</div>

        									</div>

        									<div class="section-placeholder">
        										<div class="placeholder-content">
        											<img id="res-stadium-image" src="https://phpstack-720521-2396435.cloudwaysapps.com/admin/assets/img/illustrations/dashboard/food/desktop.png" alt="">
        										</div>
        									</div>
        								</div>



        							</div>
        						</div>

        					</div>
        				</div>

        		</div>
        		</form>
        	</div>

        </div>

        </div>

        <!--Huro Scripts-->
        <?php $this->load->view('common/footer'); ?>
        <script type="text/javascript">

			var index = 0;
			getticketQty = function (direction) { //alert(direction);

			$('#getticketQty_'+direction).prop("checked", true);

			};

        	$(document).ready(function() {
        		if ($('#add_event_name').length) new Choices('#add_event_name', {
        			removeItemButton: !0
        		});

        		/*$('#add_event_name').on('change', function() {
        			if ($(this).val() != '') {
        				$("#right_event").css("display", "block");
        				$("#left_event").css("display", "block");
        			}
        		})*/


        		$(document).on('change', "#add_event_name", function() {

        			$.ajax({
        				type: 'POST',
        				url: '<?php echo base_url(); ?>Tickets/get_tktcat_by_stadium_id',
        				data: {
        					'match_id': $(this).val()
        				},
        				dataType: "json",
        				success: function(data) {

        					$("#ticket_category").empty().html('<option value="" selected>--Ticket Category--</option>');
        					if (data.block_data) {

        						$.each(data.block_data, function(index, item) {

        							$("#ticket_category").append('<option value="' + index + '">' + item + '</option>');

        						})
        						//$("#left_event").show();

        					}
        					if (data.match_data) {

        						$('#res-match-name').html(data.match_data.match_name);
        						$('#res-match-date').html(data.match_data.match_date_format);
        						$('#res-match-time').html(data.match_data.match_time);
        						//$('#right_event').show();

        					}
        				}
        			});


        			$.ajax({
        				type: 'POST',
        				url: '<?php echo base_url(); ?>Tickets/getMatchDetails',
        				data: {
        					'match_id': $(this).val()
        				},
        				dataType: "json",
        				success: function(data) {
        					let html = '';
        					if (data.city_name != null) {
        						html += data.city_name + ', ';
        					}
        					if (data.state_name != null) {
        						html += data.state_name + ', ';
        					}
        					if (data.country_name != null) {
        						html += data.country_name;
        					}
        					
        					$('#res-match-place').html(html);
        					$('#matchticket').html(data.matchticket);
        					$('#res-stadium-image').attr('src', data.stadium_image);
        				}
        			});


        			$.ajax({
        				type: 'POST',
        				url: '<?php echo base_url(); ?>tickets/getCurrency_event',
        				data: {
        					'match_id': $(this).val()
        				},
        				dataType: "json",
        				success: function(data) {

        					$("#add_pricetype_addlist").empty();
        					if (data) {
        						$.each(data, function(index, item) {

        							$("#add_pricetype_addlist").append("<option value='" + item.currency_code + "'>" + item.name + ' (' + item.symbol + ')' + "</option>");
        						})
        					}

        				}
        			});
        		});


        		$(document).on('change', "#ticket_category", function() {

        			$.ajax({
        				type: 'POST',
        				url: '<?php echo base_url() ?>' + 'Tickets/get_block_by_stadium_id',
        				data: {
        					'match_id': $('#add_event_name').val(),
        					'category_id': $('#ticket_category').val()
        				},
        				dataType: "json",
        				success: function(data) {

        					$("#ticket_block").empty().html('<option value="" selected>--Ticket Block--</option>');
        					if (data) {
        						$.each(data, function(index, item) {

        							$("#ticket_block").append('<option value="' + item + '">' + index + '</option>');

        						})

        					}
        				}
        			});

        		});

        		$("#add_price_addlist").on("change", function(evt) {
        			var self = $(this);
        			//$("#add_price_addlist").attr("minlength", "2");
        			if (self.val().length == 1 || parseInt(self.val()) < 10) {
        				self.val('');
        				$(this).focus();
        				evt.preventDefault();
        			}

        			self.val(self.val().replace(/[^0-9\.]/g, ''));
        			if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
        				evt.preventDefault();
        			}
        		});

        	});
        </script>
        <?php exit; ?>
