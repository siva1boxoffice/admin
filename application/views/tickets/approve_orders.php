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

							<div class="list_button order_inf">
								
							<a href="<?php echo base_url();?>tickets/index/approve_reject/pending" class="user_buts <?php if($this->uri->segment(4) == 'pending'){?> active <?php } ?>">Pending</a>
							<a href="<?php echo base_url();?>tickets/index/approve_reject/approved" class="user_buts <?php if($this->uri->segment(4) == 'approved'){?> active <?php } ?>">Approved</a>
							<a href="<?php echo base_url();?>tickets/index/approve_reject/rejected" class="user_buts <?php if($this->uri->segment(4) == 'rejected'){?> active <?php } ?>">Rejected</a>
							<a href="<?php echo base_url();?>tickets/index/approve_reject/downloaded" class="user_buts <?php if($this->uri->segment(4) == 'downloaded'){?> active <?php } ?>">Downloaded</a>

							</div><br>
							</div>
							 </div>
							 <br>
								<div class="tab_sec orders list_odd" id="no-more-tables">
									 
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Order</th>
												<th>Event</th>
												<th>Ticket Format</th>
												<th>Ticket Type</th>
												<th>Qty</th>
												<th>Ticket file</th>
												<th>Ticket QR Link</th>
												<th>Seller Name</th>
												<th>Ticket Status</th>
												<?php if($this->uri->segment(4) == 'pending'){?>  
												 <?php  if ($this->session->userdata('role') != 1) { ?>
												<th style="width: 250px;">Approve/Reject</th>
											<?php } ?>
											<?php } ?>
											<?php if($this->uri->segment(4) == 'downloaded'){?>  
												 <?php  if ($this->session->userdata('role') != 1) { ?>
												<th style="width: 250px;">Downloaded Date time</th>
											<?php } ?>
											<?php } ?>
												<th>&nbsp;</th>
											</tr>
											<?php 
											$ci=& get_instance();
											if ($approve_request) {
												foreach ($approve_request as $getMySalesDa) {
													$etickets = $ci->General_Model->etickets($this->uri->segment(4),$getMySalesDa->booking_id)->result();


											?>
													<tr>
														<td data-label="Order:"><span class="order"><?php echo $getMySalesDa->booking_no; ?></span></td>
														<td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
															<p><?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?></p>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
														</td>
														<td data-label="Tickets Format:">
															<?php echo $getMySalesDa->seat_category;
															?>
														</td>
														<td data-label="Tickets Type:">
															<?php if($getMySalesDa->ticket_type == 2){
																echo "E-Tickets";
															}
															else if($getMySalesDa->ticket_type == 4){
																echo "Mobile Tickets";
															}
															else if($getMySalesDa->ticket_type == 3){
																echo "Paper Tickets";
															}
															else if($getMySalesDa->ticket_type == 4){
																echo "Season Cards";
															}
															?>
														</td>
														<td data-label="Tickets Qty:">
															<?php echo $getMySalesDa->quantity;
															?>
														</td>
														<td data-label="Tickets Qty:">
															<?php 
															if($getMySalesDa->ticket_type == 2){
															foreach ($etickets as $eticket) {
																if($etickets[0]->qr_link == ""){
															 ?>
															<a target="_blank" href="<?php echo UPLOAD_PATH; ?>uploads/e_tickets/<?php echo $eticket->ticket_file; ?>">Ticket <?php echo $eticket->serial; ?></a><br>
																<?php }}}else{  
														if($etickets[0]->qr_link == ""){
															$pod_tickets = explode(',',$getMySalesDa->pod);
															if(!empty($pod_tickets)){
																$t = 1;
																foreach($pod_tickets as $pod_ticket){
															$pod_file = $pod_ticket;		
															if($pod_ticket->source_type == "1boxoffice"){

																$pod_file= UPLOAD_PATH.'uploads/pod/'.$pod_ticket;
															}

															
															?>
															<a target="_blank" href="<?php echo $pod_file; ?>">POD <?php echo $t;?></a><br>
														
															<!-- <a target="_blank" href="<?php echo UPLOAD_PATH; ?>uploads/pod/<?php echo $getMySalesDa->pod; ?>">POD Attachment</a><br> -->
														<?php $t++;}}}} ?>
														</td>
														<td data-label="Ticket QR Link:">
															<?php 
															foreach ($etickets as $eticket) {
																if($eticket->qr_link != ""){
															 ?>
															<a target="_blank" href="<?php echo $eticket->qr_link; ?>">Ticket #<?php echo $eticket->serial; ?> QR</a><br>
														<?php } } ?>
														</td>
														<td data-label="Seller Name:">
																<?php
																echo  $getMySalesDa->admin_name;
																?>
																<?php
																echo  $getMySalesDa->admin_last_name;
																?>
														</td>
									
														<td data-label="Status:">

															<?php
															if ($getMySalesDa->ticket_status == 1) {
																echo "UPLOADED";
															}
															if ($getMySalesDa->ticket_status == 2) {
																echo "APPROVED";
															}
															if ($getMySalesDa->ticket_status == 3) {
																echo "DOWNLOADED";
															}
															if ($getMySalesDa->ticket_status == 6) {
																echo "REJECTED";
															}  
															?>

														</td>
														<?php if($this->uri->segment(4) == 'pending'){?> 
														 <?php  if ($this->session->userdata('role') != 1) { ?>
														<td data-label="Order:">
															<!-- <a class="button is-success" href="javascript:void(0);" onclick="update_ticket_status('<?php echo md5($getMySalesDa->eticket_id);?>',2);">
														APPROVE
														</a> -->
														<a class="button is-success" href="javascript:void(0);" onclick="update_ticket_status('<?php echo md5($getMySalesDa->booking_id);?>',2,<?php echo $getMySalesDa->ticket_type;?>);">
														APPROVE
														</a>
														<a class="button is-danger" href="javascript:void(0);" onclick="update_ticket_status('<?php echo md5($getMySalesDa->booking_id);?>',6,<?php echo $getMySalesDa->ticket_type;?>);">
														REJECT
														</a>
												</td>
												<?php } ?>
											<?php } ?>
											<?php if($this->uri->segment(4) == 'downloaded'){?> 
														 <?php  if ($this->session->userdata('role') != 1) { ?>
														<td data-label="Order:">
															<?php echo $getMySalesDa->ticket_download_date;?>
														</td>
													<?php }}?>
														<td data-label="Total:"><a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($getMySalesDa->booking_no); ?>"><i class="fas fa-angle-double-right"></i></a></td>
													</tr>
											<?php
												}
											}else{ ?>
												<tr><td colspan="10">No Ticker Approval Request.</td></tr>
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
							<!-- <div class="column is-12">
								<div class="field">
									<label>Search By Ticket Id</label>
									<div class="control">
										<input type="text" name="ticket_id" class="input" placeholder="Ticket Id">
									</div>
								</div>
							</div> -->
							<div class="column is-12">
								<div class="field">
									<label>Order Id</label>
									<div class="control">
										<input type="text" name="order_id" class="input" placeholder="Order Id">
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
