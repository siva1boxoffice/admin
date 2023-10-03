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
								<div class="tab_head">
									<h2>Event Request List</h2>
									<div class="list_button order_inf">
							<a href="<?php echo base_url();?>tickets/index/ticket_request/all" class="user_buts <?php if($this->uri->segment(4) == 'all'){?> active <?php } ?>">All</a>
								<a href="<?php echo base_url();?>tickets/index/ticket_request/upcoming" class="user_buts <?php if($this->uri->segment(4) == 'upcoming'){?> active <?php } ?>">Upcoming</a>
							<a href="<?php echo base_url();?>tickets/index/ticket_request/past" class="user_buts <?php if($this->uri->segment(4) == 'past'){?> active <?php } ?>">Expired</a>
							<a href="<?php echo base_url();?>tickets/index/ticket_request/open" class="user_buts <?php if($this->uri->segment(4) == 'open'){?> active <?php } ?>">Open</a>
							<a href="<?php echo base_url();?>tickets/index/ticket_request/closed" class="user_buts <?php if($this->uri->segment(4) == 'closed'){?> active <?php } ?>">Closed</a>

							</div>
								</div>
								<div class="tab_sec orders list_odd" id="no-more-tables">

									<p><a href="<?php echo base_url();?>settings/email_export/request/2" class="user_buts" >Export</a><br><br><br></p>



									<?php if ($tickets) { ?>
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Request Id</th>
												<th>Event</th>
												<th>Tournment</th>
												<th>Quantity</th>
												<th>Request By</th>
												<th>Request On</th>
												<th>Action</th>
												<th>&nbsp;</th>
											</tr>
											<?php 
												foreach ($tickets as $ticket) {
											?>
													<tr>
														<td data-label="Request Id:">
															<?php echo $ticket->request_id;
															?>
														</td>
														<td data-label="Event:"><?php echo $ticket->match_name; ?><br>
															<p><?php echo $ticket->country_name . ', ' . $ticket->city_name; ?></p>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $ticket->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $ticket->match_time; ?></span>
														</td>
														<td data-label="Tournment:">
															<?php echo $ticket->tournament_name;
															?>
														</td>
														<td data-label="Request Qty:">
															<?php echo $ticket->quantity;
															?>
														</td>
														<td data-label="Customer Name:">
															<?php echo $ticket->full_name;
															?>
														</td>
														<td data-label="Request On:">
															<?php $date =  date("d-F-Y h:i:s",($ticket->request_date));

															?>
															<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$date))).' '.@$_COOKIE["time_zone"];?>
														</td>
														<td data-label="Status:">
															<select name="e-tickets" id="status" class="form-control" onchange="update_enquiry_status('<?php echo ($ticket->request_id);?>',this.value,'ticket');">
													<option value="0" <?php if ($ticket->request_status == 0) { ?> selected <?php } ?>>OPEN</option>
													<option value="1" <?php if ($ticket->request_status == 1) { ?> selected <?php } ?>>CLOSED</option>
													</select>
														</td>

														<td data-label="View Details:"><a href="<?php echo base_url(); ?>tickets/index/ticket_details/<?php echo ($ticket->request_id); ?>"><i class="fas fa-angle-double-right"></i></a></td>
													</tr>
											<?php
												}
											 ?>

										</tbody>
									</table>
									<?php } else{ ?>
											<h3>No Request Tickets Available.</h3>
											<?php }
											?>
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
<?php $this->load->view('common/footer'); ?>
<?php exit; ?>
