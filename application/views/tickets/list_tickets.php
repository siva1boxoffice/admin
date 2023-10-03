 <?php $this->load->view('common/header'); ?>
 <style type="text/css">
 	.datetimepicker-dummy .datetimepicker-dummy-wrapper .datetimepicker-dummy-input {
 		max-width: 100% !important;
 	}
 </style>
 <link rel="stylesheet" href="<?php echo base_url(); ?>myassets/css/style.css?v=?v=3.4.2" />
 <div id="app-lists" class="view-wrapper is-webapp" data-page-title="List View" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

 	<div class="page-content-wrapper">
 		<div class="all-projects page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

 			

 			<div class="page-content-inner">

                <?php //echo "<pre>";print_r($this->session->all_userdata());
                ?>

            <div class="project-minimal-grid list-view-toolbar is-reversed list_filter filter_button_list">
                <div class="control has-icon listing_filter">
                    <a href="<?php echo base_url();?>tickets/index/create_ticket" id="reset-button" class="reset-button button h-button is-primary is-raised is-bold">
                        <i class="fas fa-plus"></i>&nbsp;New Listing
                    </a>
                    <a data-panel="activity-panel" class="button h-button is-primary is-raised is-bold right-panel-trigger">
                        <!-- <span class="select-all fas"> Advance Filter</span> -->
                        <i class="fas fa-sliders-h"></i>&nbsp;Advance Filter 
                    </a>
                    <!-- <a href="javascript:void(0);" id="reset-button" class="reset-button button h-button is-primary is-raised is-bold">
                        <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset Filter
                    </a> -->
                </div>
                <div class="grid-header"  id="source_type" data-id="<?php echo @$_GET['only'] ;?>">
                    <div class="filter">
                        <span>Filter by</span>
                        <div class="control">
                            <div class="h-select">
                                <div class="select-box">
                                    <span>Upcoming</span>
                                </div>
                                <div class="select-icon">
                                    <i data-feather="chevron-down"></i>
                                </div>
                                <div class="select-drop has-slimscroll-sm">
                                    <div class="drop-inner">
                                        <div class="option-row">
                                            <input type="radio" name="search_event" value="upcoming" checked onclick="filter_search('upcoming',0);">
                                            <div class="option-meta">
                                                <span>Upcoming</span>
                                            </div>
                                        </div>
                                        <div class="option-row">
                                            <input type="radio" name="search_event" value="expired" onclick="filter_search('expired',0);">
                                            <div class="option-meta">
                                                <span>Expired</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php  if ($this->session->userdata('role') == 6) { ?>
                <div id="source_type" data-id="<?php echo @$_GET['only'] ;?>" >
                    <div class="filter">
                        <span>Filter by Seller</span>
                        <div class="control">
                            <select class="ticket_split form-control" onchange="load_my_tickets(this.value);">
                            <option value="all" selected="selected">All Seller</option>
                            <?php foreach ($sellers as $seller) { ?>
                            <option value="<?php echo $seller->admin_id;?>" <?php if($seller->admin_id == 1){?>  <?php } ?>><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->admin_email;?>)</option>
                             <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } ?>

            </div>

 				<!--List-->
 				<div class="list-view list-view-v3">



 					<!--Active Tab-->
 					<div id="active-items-tab" class="tab-content is-active">
 						<div class="list-view-inner" id="list_body">

 							



 								

 						</div>


 					</div>

 					<!--Inactive Tab-->
 					<div id="inactive-items-tab" class="tab-content">
 						No more items to load
 					</div>

 				</div>

 			</div>

 		</div>
 	</div>
 </div>

 <div id="activity-panel" class="right-panel-wrapper is-activity">
 	<div class="panel-overlay"></div>
 	<input type="hidden" name="search_flag" id="search_flag" value="listing">
 	<div class="right-panel">
 		<div class="right-panel-head">
 			<h3>Advance Ticket Filter</h3>
 			<a class="close-panel">
 				<i data-feather="chevron-right"></i>
 			</a>
 		</div>
 		<div class="right-panel-body has-slimscroll">
 			<div class="languages-boxes">
 				<div class="form-fieldset">
 					<div class="fieldset-heading">
 						<h4>Filter</h4>
 						<p>Filter Your Tickets</p>
 					</div>
 					<form id="filter-form" method="post" class="login-wrapper" action="<?php echo base_url(); ?>tickets/index/filter_tickets">
 						<input type="hidden" name="match_id" id="match_id" value="">
 						<div class="columns is-multiline">
 							<div class="column is-12">
 								<div class="field">
 									<label>Search Event</label>
 									<div class="control">
 										<input type="text" name="event" class="input" placeholder="Event">
 									</div>
 								</div>
 							</div>
 							<div class="column is-12">
 								<div class="field">
 									<label>Ticket Category Or Code</label>
 									<div class="control">
 										<input type="text" name="ticket_category" class="input" placeholder="Ticket Category">
 									</div>
 								</div>
 							</div>
 							<div class="column is-12">
 								<div class="field">
 									<label>Arena Or Stadium</label>
 									<div class="control">
 										<input type="text" name="stadium" class="input" placeholder="Stadium">
 									</div>
 								</div>
 							</div>


 						</div>
 						<div class="columns is-multiline">
 							<div class="column is-6">
 								<div class="field">
 									<label>Event Start Date</label>
 									<div class="control has-icon">
 										<input type="date" name="event_start_date" id="event-start" class="input" placeholder="Select a date" value="<?php echo date("d-m-Y"); ?>">
 										<div class="form-icon">
 											<i data-feather="calendar"></i>
 										</div>
 									</div>
 								</div>
 							</div>
 							<div class="column is-6">
 								<div class="field">
 									<label>Event End Date</label>
 									<div class="control has-icon">
 										<input type="date" name="event_end_date" id="event-end" class="input" placeholder="Select a date" value="<?php echo date('d-m-Y', strtotime(date("d-m-Y") . ' +1 day')) ?> ">
 										<div class="form-icon">
 											<i data-feather="calendar"></i>
 										</div>
 									</div>
 								</div>
 							</div>
 							<div class="column is-12">
 								<div class="field">
 									<div class="control subcontrol">
 										<label class="checkbox">
 											<input name="ignore_end_date" type="checkbox" value="1" checked>
 											<span></span>
 											Ignore Event End Date.
 										</label>
 									</div>
 								</div>
 							</div>
                            <div class="column is-12">
                                    <div class="field srch_btn">
                                        <label>&nbsp;</label>
                                        <div class="control has-icon">
                                            <button type="submit" id="next-button" class="button h-button is-primary is-bold">Search</button>
                                        </div>
                                    </div>
                                </div>



 							<!-- <div class="columns is-multiline">
 								<div class="column is-6">
 									<div class="field">
 										<label>&nbsp;</label>
 										<div class="control has-icon">
 											<button type="button" id="reset-button" class="reset-button button h-button is-primary is-bold">Reset Search</button>
 										</div>
 									</div>
 								</div>
 								
 							</div> -->
 					</form>
 				</div>

 			</div>

 		</div>
 	</div>

 </div>

 <?php $this->load->view('common/footer'); ?>


 <script>

      function load_my_tickets(seller_id) { 
            if(seller_id != '' && seller_id != 'all'){
             load_tickets('',0,seller_id);
            }
            else if(seller_id == 'all'){
            load_tickets('',0,'all');
            }
            
        }

 	$(document).ready(function() {


 		bulmaCalendar.attach("#event-start", {
 			startDate: new Date('<?php echo date('m/d/Y'); ?>'),
 			color: themeColors.primary,
 			lang: "en",
 			showHeader: false,
 			showButtons: false,
 			showFooter: false
 		});

 		bulmaCalendar.attach("#event-end", {
 			startDate: new Date('<?php echo date('m/d/Y', strtotime(date("m/d/Y") . ' +1 day')) ?>'),
 			color: themeColors.primary,
 			lang: "en",
 			showHeader: false,
 			showButtons: false,
 			showFooter: false
 		});

 		$('.reset-button').on('click', function() {
 			$('#filter-form').trigger("reset");
 			$('.close-panel').trigger("click");
 			$('#search_flag').val("listing");
 			load_tickets('',0);
 		})


 		load_tickets('',0);

 	});
 </script>
