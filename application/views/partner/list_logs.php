<?php $this->load->view('common/header'); ?>
<style type="text/css">
	.active{
    background-color:  #272357 !important;
    color : #fff !important;
	}
</style>
<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				<div class="flex-list-wrapper">
					<div class="flex-table-item">
						<div class="">
							<div class="container_new">
							
							 <div class="control has-icon listing_filter">
							 	<div class="tab_head">
			
							
						
								<div class="tab_sec orders list_odd" id="no-more-tables">
							<style type="text/css">
								.events{
									list-style: none;
									width: 100%;
									float: left;
								}
								.events li {
									float: left;
									padding: 10px 20px;
								}
								.events li:first-child {
									padding-left: 0;
								}
							</style>		 
						

						<h2>Events Logs</h2>

						<ul class="events">
							<li class=""><a href="<?php echo base_url('partner/logs/lists/Events') ;?>" class="search_logs"  onclick="search_logs('Events');">Events</a></li>
                        <li class=""><a href="<?php echo base_url('partner/logs/lists/Search Events') ;?>" class="search_logs"  > Search Events</a></li>
                        <li><a href="<?php echo base_url('partner/logs/lists/Events Details') ;?>" class="search_logs" >Events Details</a></li>
                        <li><a href="<?php echo base_url('partner/logs/lists/Block Ticket') ;?>" class="search_logs" >Block Ticket</a></li>
                        <li><a href="<?php echo base_url('partner/logs/lists/Block Details') ;?>" class="search_logs" onclick="search_logs('Block Details');">Block Details</a></li>
                        <li><a href="<?php echo base_url('partner/logs/lists/Reservation') ;?>" class="search_logs" >Reservation</a></li>
                        <li><a href="<?php echo base_url('partner/logs/lists/Orders') ;?>" class="search_logs" >Orders</a></li>
                        <li><a href="<?php echo base_url('partner/logs/lists/Orders Details') ;?>" class="search_logs" >Orders Details</a></li>
                        
						</ul>

									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Events</th>
												<th>Partner Name</th>
												<th>Request</th>
												<th>Response</th>
												<th>Date</th>
												
											</tr>
											
										</tbody>
										
											<?php if ($results) {
												foreach ($results as $row) {
											?>
											<tr>
												<td><?php echo $row->request_type;?></td>
												<td><?php echo $row->admin_name;?> <?php echo $row->admin_last_name;?></td>
												<td><?php echo $row->request_filename;?></td>
												<td><?php echo $row->response_filename;?></td>
												<td><?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$row->created_at)));?>
												</td>

											</tr>
											<?php } ?>
											</tr>
											<?php
											
											}else{ ?>
												<tr><td colspan="11">No Order list.</td></tr>
											<?php }
											?>

										</tbody>
									</table>
									 <div class="pagination datatable-pagination pagination-datatables flex-column">
                                        <?php echo $pagination; ?>
                                </div>
								</div>
							</div>
						</div>
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
			<h3>Advance Sales Filter</h3>
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
					<form id="filter-forms" method="post" class="login-wrapper" action="<?php echo base_url(); ?>game/orders/list_order">
						<div class="columns is-multiline">
							<?php  if ($this->session->userdata('role') == 6) { ?>
							<div class="column is-12">
								<div class="field">
									<label>Search By Seller</label>
									<div class="control">
										 <select  id="slct" class="form-control" name="seller">
                                                 <option value="">-Choose Seller-</option>
                                                 <?php foreach ($sellers as $seller) { ?>
                                                 <option value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?></option>
                                              <?php } ?>
                                             </select>
									</div>
								</div>
							</div>
						<?php } ?>
							<div class="column is-12">
								<div class="field">
									<label>Search By Ticket Id</label>
									<div class="control">
										<input type="text" name="ticket_id" class="input" placeholder="Ticket Id">
									</div>
								</div>
							</div>
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
											<button type="submit" id="salesfilter" class="button h-button is-primary is-bold">Search</button>
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
<script type="text/javascript">
	function load_my_orders(seller_id) {
		window.location.href = "<?php echo base_url();?>game/orders/list_order/all/"+seller_id;
	}
</script>
<?php exit; ?>
