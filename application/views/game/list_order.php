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
								 <?php  //if ($this->session->userdata('role') == 6) { ?>
							 <div class="control has-icon listing_filter">
							 	<div class="tab_head">
								

							<!-- <?php  if ($this->session->userdata('role') == 6) { ?>
								<p><span>Filter by Seller</span></p>
                    <div class="filter">
                        
                        <div class="control filter_seller">
                        	<div class="select">
                            <select class="order_split form-control" onchange="load_my_orders(this.value);">
                            <option value="">All Seller</option>
                            <?php foreach ($sellers as $seller) { ?>
                            <option value="<?php echo $seller->admin_id;?>" <?php if($seller->admin_id == $this->uri->segment(5)){?> selected="selected" <?php } ?>><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->admin_email;?>)</option>
                             <?php } ?>
                            </select>
                        </div>
                        </div>
                    </div>

            <?php } ?>


 -->

 <?php 
 		$customer_id = @$_GET['customer_id'] ? $_GET['customer_id'] : "";
 		$customer_url = '?customer_id='.$customer_id ;

 ?>

							<div class="list_button order_inf">
								<a href="<?php echo base_url();?>game/orders/list_order/all<?php echo $customer_url ;?>" class="user_buts <?php if($this->uri->segment(4) == 'all' || $this->uri->segment(4) == '' ){?> active <?php } ?>">All</a>
							<a href="<?php echo base_url();?>game/orders/list_order/confirmed<?php echo $customer_url ;?>" class="user_buts <?php if($this->uri->segment(4) == 'confirmed'){?> active <?php } ?>">Confirmed</a>
							<a href="<?php echo base_url();?>game/orders/list_order/pending<?php echo $customer_url ;?>" class="user_buts <?php if($this->uri->segment(4) == 'pending'){?> active <?php } ?>">Pending</a>
							<a href="<?php echo base_url();?>game/orders/list_order/shipped<?php echo $customer_url ;?>" class="user_buts <?php if($this->uri->segment(4) == 'shipped'){?> active <?php } ?>">Shipped</a>
							<a href="<?php echo base_url();?>game/orders/list_order/delivered<?php echo $customer_url ;?>" class="user_buts <?php if($this->uri->segment(4) == 'delivered'){?> active <?php } ?>">Delivered</a>
							<!-- <a href="<?php echo base_url();?>game/orders/list_order/downloaded" class="user_buts <?php if($this->uri->segment(4) == 'downloaded'){?> active <?php } ?>">Downloaded</a> -->
							<a data-panel="activity-panel" class="user_buts right-panel-trigger">
							<i class="fas fa-sliders-h"></i>Advanced Filter </a>

							</div><br>
							</div>
							 </div>
							
							<?php //} ?><br>
								<div class="tab_sec orders list_odd" id="no-more-tables">
									 
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Order</th>
												<th>Date</th>
												<th>Tickets Qty</th>
												<th>Category</th>
												<th>Section</th>
												<th>Payment Status</th>
												<th>Seller Name</th>
												<th>Buyer Name</th>
												<!-- <th>Buyer Country</th> -->
												<th>Delivery Status</th>
												<th>Price</th>
												<th>Order Total</th>
												<th>&nbsp;</th>
											</tr>
											<?php if ($getMySalesData) {
												foreach ($getMySalesData as $getMySalesDa) {
											?>
													<tr>
														<td data-label="Order:"><span class="order">#<?php echo $getMySalesDa->booking_no; ?></span></td>
														<td class="padd_50" data-label="Booked On:">
															<!-- <span class="tr_date"><i class="fas fa-calendar"></i><?php echo date('d-m-Y',strtotime($getMySalesDa->created_at)); ?></span> <br><span class="tr_date"><i class="fas fa-clock"></i><?php echo date('h:i',strtotime($getMySalesDa->created_at)); ?></span> -->
															<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$getMySalesDa->payment_date))).' '.@$_COOKIE["time_zone"];;?>
														</td>
														<td data-label="Tickets Qty:">
															<?php echo $getMySalesDa->quantity;
															?>
														</td>
														<td data-label="Ticket Category:">
															<?php 
															if($getMySalesDa->ticket_block != 0){
															echo $getMySalesDa->block_id;
															}
															else{
															echo "Any";
															}
															?>
														</td>
														<td data-label="Section:">
															<?php echo $getMySalesDa->seat_category;
															?>
														</td>
														<td data-label="Payment Status:">
														<?php if ($getMySalesDa->payment_status == 1) { ?>
															PAID
														<?php } ?>
														<?php if ($getMySalesDa->payment_status == 2) { ?>
															PENDING
														<?php } ?>
														<?php if ($getMySalesDa->payment_status == 0) { ?>
															FAILED
														<?php } ?>	
														<?php if ($getMySalesDa->payment_status != 0 && $getMySalesDa->payment_status != 1 && $getMySalesDa->payment_status != 2) { ?>
															NOT INITIATED
														<?php } ?>											</td>
														<td data-label="Seller Name:">
                                                            <?php echo $getMySalesDa->seller_first_name; ?> <?php echo $getMySalesDa->seller_last_name; ?>
                                                        </td>
															<td data-label="Buyer Name:">
															<?php echo $getMySalesDa->customer_first_name;
															?> <?php echo $getMySalesDa->customer_last_name;
															?>
															</td>
															<!--  <td data-label="Customer Country:">
                                                            <?php echo $getMySalesDa->customer_country_name; ?>
                                                        </td> -->
															<td data-label="Delivery Status:">
															<?php if ($getMySalesDa->delivery_status == 0 || $getMySalesDa->delivery_status == '') { ?>
											Tickets Not Uploaded
											<?php } ?>
											<?php if ($getMySalesDa->delivery_status == 1) { ?>
											Tickets In-Review
											<?php } ?>
											<?php if ($getMySalesDa->delivery_status == 2) { ?>
											Tickets Approved
											<?php } ?>
											<?php if ($getMySalesDa->delivery_status == 3) { ?>
											Tickets Rejected
											<?php } ?>
											<?php if ($getMySalesDa->delivery_status == 4) { ?>
											<i data-feather="download"></i> Tickets Downloaded
											<?php } ?>
											<?php if ($getMySalesDa->delivery_status == 5) { ?>
											Tickets Shipped
											<?php } ?>
											<?php if ($getMySalesDa->delivery_status == 6) { ?>
											Tickets Delivered
											<?php } ?>
															</td>
														
														<?php  if ($this->session->userdata('role') != 1) { ?>	
														<td data-label="Price:"><b>		
												<?php if (strtoupper($getMySalesDa->currency_type) == "GBP") { ?>
															<i class="fas fa-pound-sign"></i>
															<?php } ?>
												<?php if (strtoupper($getMySalesDa->currency_type) == "EUR") { ?>
															<i class="fas fa-euro-sign"></i>
												<?php } 
													if (strtoupper($getMySalesDa->currency_type) != "GBP" && strtoupper($getMySalesDa->currency_type) != "EUR"){
												 echo strtoupper($getMySalesDa->currency_type); 
												}
												?>
												<?= number_format($getMySalesDa->price,2) ?> 
												 </b></td>
												 <?php }?>
												 <?php  if ($this->session->userdata('role') == 1) { ?>	
														<td data-label="Price:"><b>		
												<?php if (strtoupper($getMySalesDa->currency_type) == "GBP") { ?>
															<i class="fas fa-pound-sign"></i>
															<?php } ?>
												<?php if (strtoupper($getMySalesDa->currency_type) == "EUR") { ?>
															<i class="fas fa-euro-sign"></i>
												<?php } 
													if (strtoupper($getMySalesDa->currency_type) != "GBP" && strtoupper($getMySalesDa->currency_type) != "EUR"){
												 echo strtoupper($getMySalesDa->currency_type); 
												}
												?>
												<?= number_format($getMySalesDa->price,2) ?> 
												 </b></td>
												 <?php }?>
												 

														<?php  if ($this->session->userdata('role') != 1) { ?>	
														<td data-label="Price:"><b>		
												<?php if (strtoupper($getMySalesDa->currency_type) == "GBP") { ?>
															<i class="fas fa-pound-sign"></i>
															<?php } ?>
												<?php if (strtoupper($getMySalesDa->currency_type) == "EUR") { ?>
															<i class="fas fa-euro-sign"></i>
												<?php } 
													if (strtoupper($getMySalesDa->currency_type) != "GBP" && strtoupper($getMySalesDa->currency_type) != "EUR"){
												 echo strtoupper($getMySalesDa->currency_type); 
												}
												?>
												<?= number_format($getMySalesDa->total_amount,2) ?> 
												 </b></td>
												 <?php }?>
												 <?php  if ($this->session->userdata('role') == 1) { ?>	
														<td data-label="Price:"><b>		
												<?php if (strtoupper($getMySalesDa->currency_type) == "GBP") { ?>
															<i class="fas fa-pound-sign"></i>
															<?php } ?>
												<?php if (strtoupper($getMySalesDa->currency_type) == "EUR") { ?>
															<i class="fas fa-euro-sign"></i>
												<?php } 
													if (strtoupper($getMySalesDa->currency_type) != "GBP" && strtoupper($getMySalesDa->currency_type) != "EUR"){
												 echo strtoupper($getMySalesDa->currency_type); 
												}
												?>
												<?= number_format($getMySalesDa->ticket_amount,2) ?> 
												 </b></td>
												 <?php }?>

														
														<td data-label="View Details:"><a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($getMySalesDa->booking_no); ?>"> <img style="width: 60px;" class="arrow_click" src="<?php echo base_url();?>assets/img/icons/arrow-right-circle.svg?v=1"><button class="btn_mobile">Click Here</button></a></td>
													</tr>
											<?php
												}
											}else{ ?>
												<tr><td colspan="12">No Order list.</td></tr>
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
