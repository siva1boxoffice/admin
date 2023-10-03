<?php $this->load->view('common/header'); ?>
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/app.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/main.css?v=1.1" /> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/style.css?v=3.9.4" />

<style>
	.onebox-order-info td {
    color: #000;
}
</style>
<div id="app-onboarding" class="view-wrapper is-webapp mobile_order_view" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

	<div id="huro-app" class="app-wrapper">
		<!-- Content Wrapper -->
		<div id="app-projects" class="view-wrapper-1 " data-naver-offset="214" data-menu-item="#layouts-sidebar-menu" data-mobile-item="#home-sidebar-menu-mobile">
			<div class="page-content-wrapper">
				<div class="page-content is-relative">
					<div class="page-content-inner">
						<div class=" onebox-order-info">
							<div class="container_new">
								<div class="row">
									<div class="sub_heading">
										<div class="onebox-order-heading">
											<h3>Order Info</h3>
										</div>
										<!-- <?php
															
										if (($orderData->booking_status == 1 || $orderData->booking_status == 4 || $orderData->booking_status == 5)) { ?>
										<div class="sub_head">
											<a href="<?php echo base_url().'game/uploadNominee/'.md5($orderData->booking_no); ?>" target="_blank">Update Nominee</a>
											<a href="<?php echo base_url().'game/uploadEticket/'.md5($orderData->booking_no); ?>" target="_blank">Upload E Ticket</a>
										</div>
									<?php } ?> -->
									</div>
								</div>
							
								<div class="row">
									<div class="toptable table_section ordr_info  " id="no-more-tables">
										
										<table class="toptable toptable_new res_table_new table-responsive">
											<tbody>
												<tr class="accordion">
												<th>Order ID</th>
												<th>Delivery Status</th>
												<th>Booking Status</th>
												<th>Date and Time</th>
												<th>E-Ticket</th>
												</tr>
												<tr>
												<td data-label="Order:">
												<span class="order_id">#<?php echo $orderData->booking_no; ?></span>
												</td>
												<td data-label="Delivery Status:">
												<?php if ($orderData->delivery_status == 0 || $orderData->delivery_status == '') { ?>
												Tickets Not Uploaded
												<?php } ?>
												<?php if ($orderData->delivery_status == 1) { ?>
												Tickets In-Review
												<?php } ?>
												<?php if ($orderData->delivery_status == 2) { ?>
												Tickets Approved
												<?php } ?>
												<?php if ($orderData->delivery_status == 3) { ?>
												Tickets Rejected
												<?php } ?>
												<?php if ($orderData->delivery_status == 4) { ?>
												<i data-feather="download"></i> Tickets Downloaded
												<?php } ?>
												<?php if ($orderData->delivery_status == 5) { ?>
												Tickets Shipped
												<?php } ?>
												<?php if ($orderData->delivery_status == 6) { ?>
												Tickets Delivered
												<?php } ?>
												</td>
												<td data-label="Booking Status:">
													<?php  if ($this->session->userdata('role') == 6) { ?>

														<select name="e-tickets" id="status" class="form-control" onchange="update_booking_status('<?php echo md5($orderData->bg_id);?>',this.value);">
														<?php if ($orderData->booking_status != 0 && $orderData->booking_status != 7 && $orderData->booking_status != 3) { ?>
														<option value="2"  <?php if ($this->session->userdata('role') == 1 && $orderData->booking_status == 1) { ?> disabled <?php } ?> <?php if ($orderData->booking_status == 2) { ?> selected <?php } ?>>PENDING</option>
														<option value="1" <?php if ($orderData->booking_status == 1) { ?> selected <?php } ?>>CONFIRMED</option>
													<?php } ?>
														<?php  if ($this->session->userdata('role') == 6) { ?>
														<option value="0" <?php if ($orderData->booking_status == 0 || $orderData->booking_status == 7) { ?> selected <?php } ?>>FAILED</option>
														<option value="3" <?php if ($orderData->booking_status == 3) { ?> selected <?php } ?>>CANCELLED</option>
														<?php if ($orderData->booking_status != 0 && $orderData->booking_status != 7 && $orderData->booking_status != 3) { ?>
														<option value="4" <?php if ($orderData->booking_status == 4) { ?> selected <?php } ?>>SHIPPED</option>
														<option value="5" <?php if ($orderData->booking_status == 5) { ?> selected <?php } ?>>DELIVERED</option>
														<option value="6" <?php if ($orderData->booking_status == 6) { ?> selected <?php } ?>>DOWNLOADED</option>
													<?php } ?>
													<?php } ?>
														</select>
														<div class="form-check">
														<input class="form-check-input" name="sendmail" type="checkbox" value="1" id="sendmail">
														<label class="form-check-label" for="sendmail">
														Send Mail
														</label>
														</div>
													<?php } ?>
													<?php  if ($this->session->userdata('role') == 1) { ?>
														<?php if ($orderData->booking_status == '' || $orderData->booking_status == 7) { ?>BOOKING NOT INITIATED<?php } ?>
														<?php if ($orderData->booking_status == 0) { ?>FAILED<?php } ?>
														<?php if ($orderData->booking_status == 1) { ?>CONFIRMED<?php } ?>
														<?php if ($orderData->booking_status == 2) { ?>PENDING<?php } ?>
														<?php if ($orderData->booking_status == 3) { ?>CANCELLED<?php } ?>
														<?php if ($orderData->booking_status == 4) { ?>SHIPPED<?php } ?>
														<?php if ($orderData->booking_status == 5) { ?>DELIVERED<?php } ?>
														<?php if ($orderData->booking_status == 6) { ?>
															<i data-feather="download"></i> DOWNLOADED<?php } ?>
													<?php }?>
													</td>
															<td data-label="Transaction date:">
																<span class="tr_date">
																	<i class="fa fa-calendar"></i>
															<?php

															$date = strtotime($orderData->payment_date);
															$dat = date('d-m-Y', $date);
															$tme = date('h:m', $date);
															?><?php echo $dat; ?> 
															</span><!-- <br> -->
															&nbsp;
																<span class="tr_date">
															<i class="fas fa-clock"></i><?php echo $tme; ?> </span>
															</td>
															<?php
															
															if (count($eticketData) > 0 && ($orderData->booking_status == 1 || $orderData->booking_status == 4 || $orderData->booking_status == 5)) { ?>
																<td style="cursor: pointer;">
																	<a href="<?php echo base_url();?>/game/download_tickets/<?php echo md5($orderData->booking_no);?>">
																	<span class="clrb">Download (<?php echo count($eticketData); ?> Tickets / <?php echo $orderData->quantity; ?>)</span>
																</a>
																</td>
															<?php } else { ?>
																<!-- <td data-label="Payment Status:">Not Available</td> -->
																<td data-label="&nbsp;" style="cursor: pointer;">
																	<a href="javascript:void(0);">
																	<span class="clrb">NEED TO RECEIVE (<?php echo $orderData->quantity; ?>)</span>
																</a>
																</td>
																
															<?php } ?>
														</tr>
											</tbody>
										</table>
									</div>

								</div>

								<div class="account-wrapper mob_hide">
									<div class="columns">
										<div class="column is-6 list_add">
											<h3>Ticket Information</h3>
										</div>
										<div class="column is-3 list_add">
											<h3>Order Information</h3>
										</div>
										<div class="column is-3 list_add">
											<h3>E-Ticket</h3>
										</div>
									</div>
								</div>
								
								<div class="account-wrapper">
									<div class="columns">
										<div class="column is-6 list_add">
											<?php //echo "<pre>";print_r($orderData);?>
											<div class="status_item">
												<h3 class="mob_show">Ticket Information</h3>
												<div class="details">
													<div class="columns">
														<div class="column is-5">
															<div class="img">
															<img src="<?php echo UPLOAD_PATH; ?>uploads/stadium<?php echo $orderData->stadium_image; ?>">

															</div>
														</div>
														<div class="column is-7">
															<h4><?php echo $orderData->match_name; ?></h4>
															<p style="color:#a2a5b9;"><span><?php echo $orderData->stadium_name . ',' . $orderData->stadium_city_name. ',' . $orderData->stadium_country_name; ?></span></p>
															<p>
																<span class="tr_date">
																	<i class="fas fa-calendar"></i><?php echo date('d-m-Y',strtotime($orderData->match_date)); ?> </span>
																	&nbsp;
																<span class="tr_date">
																	<i class="fas fa-clock"></i><?php echo $orderData->match_time; ?> </span>
															</p>
															<p>
																<span class="">Block: <?php 
																if($orderData->ticket_block != 0){
																echo $orderData->block_id;
																}
																else{
																echo "Any";
																}
																?></span>
															</p>
															<p>
																<span class="">Section: <?php echo $orderData->seat_category; ?></span>
															</p>
															<?php if(isset($seller_notes)){ ?>
															<p>
																<span class="">Seller Note: </span>
																<?php foreach($seller_notes as $seller_note){?>
																	<img src="<?php echo UPLOAD_PATH.'uploads/ticket_details/'.$seller_note->ticket_image;?>" width="14px" height="14px">
																 <?php echo $seller_note->ticket_name; ?><br>
																 	<?php } ?>
																
															</p>
															<?php } ?>
															<table>
																<tbody>
																	<tr>
																		<td>Price:</td>
																		<td>
																		
																		<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->price,2);?>
																		</td>
																	</tr>
																	<tr>
																		<td>Quantity:</td>
																		<td><span class="qty"><?php echo $orderData->quantity; ?></span></td>
																	</tr>
																	<tr>
																		<td>Sub Total:</td>
																		<td>
																		
																		<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->ticket_amount,2); ?>
																		</td>
																	</tr>
																	<?php  if ($this->session->userdata('role') != 1) { ?>
																		
																		<tr>
																		<td>Seller Fee:</td>
																		<td>
																			<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																			<?php echo number_format($orderData->seller_fee,2); ?></td>
																	</tr>
																	<tr>
																		<td>Store Fee/Tax:</td>
																		<td>
																			<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																			<?php echo number_format($orderData->store_fee,2); ?></td>
																	</tr>
																	<?php if($orderData->premium_price != "" && $orderData->premium_price != 0){?>
																	<tr>
																	<td>Booking Protect Price:</td>
																		<td>
																			<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																			<?php echo number_format($orderData->premium_price,2); ?></td>
																	</tr>
																<?php } ?>
																	<tr>
																		<td>Total:</td>
																		<td>
																		
																		<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->total_amount,2); ?>
																		</td>
																	</tr>

																	<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										 <?php  //if ($this->session->userdata('role') == 6) { ?>
										 <?php  //if ($this->session->userdata('role') == 6) { ?>	
										<div class="column is-3 list_add">
											
											<div class="tick_info_head border-tick-info">
												<h3 class="mob_show">Order Information</h3>
												<div class="details">
											<!-- 	<table> -->
												<table>
														<tbody>
															
																<?php  if ($this->session->userdata('role') == 1) { ?>
															<tr>
																<td>Sale Amount:</td>
																<td>
																	<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->ticket_amount,2);?>
																</td>
															</tr>
														<?php } ?>
														<?php  if ($this->session->userdata('role') == 1) { ?>
															<tr>
																<td>Payable:</td>
																<td>
																	<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->ticket_amount,2);?>
																</td>
															</tr>
														<?php } ?>
															<?php  if ($this->session->userdata('role') == 1) { ?>
															<tr>
																<td>Charged Amount:</td>
																<td>
																	<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->ticket_amount,2);?>
																</td>
															</tr>
														<?php } ?>
															<?php  if ($this->session->userdata('role') != 1) { ?>
															<tr>
																<td>Sale Amount:</td>
																<td>
																	<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->total_payment,2);?>
																</td>
															</tr>
														<?php } ?>
														<?php  if ($this->session->userdata('role') != 1) { ?>
															<tr>
																<td>Payable:</td>
																<td>
																	<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->total_payment,2);?>
																</td>
															</tr>
														<?php } ?>
															<?php  if ($this->session->userdata('role') != 1) { ?>
															<tr>
																<td>Charged Amount:</td>
																<td>
																	<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->total_payment,2);?>
																</td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												<!-- </table> -->
												</div>
											</div>
										</div>
										<?php //} ?>

										 <?php // if ($this->session->userdata('role') == 6) { ?>	
										<div class="column is-3 list_add">
											
											<div class="tick_info_head">
												<h3 class="mob_show">E-Ticket</h3>

												<div class="details">
	                                                <div class="detail_sec_left">
	                                                    <div class="order_info_type select">
	                                                        <select name="single-ticket" id="single-ticket" class="form-control">
	                                                        <option value="tickets">Single-Tickets</option>
	                                                        <option value="tickets">Single-Tickets</option>
	                                                        <option value="tickets">Single-Tickets</option>
	                                                        <option value="tickets">Single-Tickets</option>
	                                                        </select>
	                                                    </div>
	                                                    <div class="type_btn">
	                                                        <a href="">Save</a>
	                                                    </div>
	                                                    <div class="e_ticket">
	                                                    	<?php if ($orderData->delivery_status == 4) { ?>
	                                                        <p>e-tickets downloaded by the buyer</p>
	                                                    	<?php } ?>
	                                                        <a href="<?php echo base_url().'game/uploadEticket/'.md5($orderData->booking_no); ?>" target="_blank">Upload E-ticket</a>
	                                                    </div>
	                                                </div>
	                                            </div>
											
											</div>
										</div>
										<?php //} ?>
										<?php //} ?>

									</div>
									 
								</div>
								<?php  if ($this->session->userdata('role') == 6) { ?>

								
										<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>Customer Information</h3>
														</div>
											<div class="toptable table_section ordr_info" id="no-more-tables">
												<table>
													<tbody>
														<tr class="accordion">
															<th>Customer Name</th>
															<th>Billing Name</th>
															<th>Billing Email</th>
															<th>Billing Contact No.</th>
															<th>Billing Address</th>
														</tr>
														<tr>
															<td data-label="Customer Name:">
																<a target="_blank" href="<?php echo base_url();?>settings/customers/add_customer/<?php echo base64_encode(json_encode($orderData->user_id)) ; ?>">
																	<?php echo $orderData->customer_first_name ; ?> <?php echo $orderData->customer_last_name ; ?>
																</a>
															</td>
															<td data-label="Billing Name:">
																<?php echo $orderData->title ; ?> <?php echo $orderData->first_name ; ?> <?php echo $orderData->last_name ; ?>
															</td>
															<td data-label="Billing Email:">
															<?php echo $orderData->email ; ?>
															</td>
															<td data-label="Billing Contact:">
															<?php echo $orderData->dialing_code ; ?> <?php echo $orderData->mobile_no ; ?>
															</td>
															<td data-label="Billing Address:">
															<?php echo $orderData->address ; ?>,<?php echo $orderData->city_name ; ?>,<?php echo $orderData->country_name ; ?>, <?php echo $orderData->postal_code ; ?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

									<?php } ?>

								<?php  if ($this->session->userdata('role') == 6) { ?>

								

								<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>Payment Information</h3>
														</div>
									
											<div class="toptable table_section ordr_info" id="no-more-tables">
												<table>
													<tbody>
														<tr class="accordion">
															<th>Transaction Id</th>
															<th>Transaction Amount</th>
															<th>Transaction Status</th>
															<th>Transaction Date Time</th>
															<th>Transaction IP</th>
														</tr>
														<tr>
															<td data-label="Txn Id:">
																<?php echo $orderData->transcation_id ; ?>
															</td>
															<td data-label="Txn Amount:">
																	<?php 
																if (strtoupper($orderData->currency_type) == "GBP") { ?>
																<i class="fas fa-pound-sign"></i>
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																<i class="fas fa-euro-sign"></i>
																<?php } 
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
																echo strtoupper($orderData->currency_type); 
																}
																 ?>
																 <?php echo number_format($orderData->total_payment,2);?>
															</td>
															<td data-label="Txn Status:">
																<?php
																if ($orderData->payment_status == 0) {
																	echo "FAILED";
																}
																if ($orderData->payment_status == 1) {
																	echo "SUCCESS";
																}
																if ($orderData->payment_status == 2) {
																	echo "PENDING";
																}
																?>
															</td>
															<td data-label="Txn Date Time:">
																<?php echo $orderData->payment_date ; ?>
															</td>
															<td data-label="Txn IP:">
																<?php echo $orderData->ip_address ; ?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

									<?php } ?>

								<?php  if ($this->session->userdata('role') == 6) { ?>

								
								<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>More Information</h3>
														</div>
											<div class="toptable table_section ordr_info" id="no-more-tables">
												<table>
													<tbody>
														<tr class="accordion">
															<th>Ticket ID</th>
															<th>Seller Name</th>
															<th>Ticket Source</th>
															<th>Tournament</th>
															<th>Ticket Created Time</th>
															<th>Last Ticket updated time</th>
															<th>Ticket Deleted Time</th>
														</tr>
														<tr>
															<td data-label="Ticket ID:">
																<?php echo $orderData->ticketid; ?>
															</td>
															<td data-label="Seller:">
																<?php echo $orderData->seller_first_name; ?>
																<?php echo $orderData->seller_last_name; ?>
															</td>
															<td data-label="Ticket Source:">
															<?php
																if ($orderData->booking_source == 1) {
																	echo "WEB";
																}
																else if ($orderData->booking_source == 2) {
																	echo "API";
																}
																else if ($orderData->booking_source == 3) {
																	echo "AFFILIATE";
																}
																?>
															</td>
															<td data-label="Tournament:">
															<?php echo $orderData->tournament_name;?>
															</td>
															<td data-label="Ticket Created Date:">
																<?php echo $orderData->sell_date;?>
															</td>
															<td data-label="Ticket Updated Date:">
																<?php echo $orderData->ticket_updated_date;?>
															</td>
															<td data-label="Ticket Deleted Date:">
																<?php echo $orderData->ticket_deleted_date;?>
															</td>
															
															
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						

									<?php } ?>
									
								<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>ATTENDEES DETAILS</h3>
														</div>
														<div class="table_section" id="no-more-tables-v1">
															<table class="toptable res_table_new table-responsive table_padd">
																<tbody>
																	<tr class="accordion">
																	<th>Customer Name</th>
																	<th>Nationality</th>
																	<th>Date Of Birth</th>
																	</tr>
																	<?php 
																		if($nominees[0]->first_name != ''){
																	//echo "<pre>";print_r($eticketData);
																	foreach($nominees as $nominee){
																	
																		?>
																	<tr>
																	<td data-label="First Name:">
																	<span class="order_id"><?php echo $nominee->first_name;?> <?php echo $nominee->last_name;?></span>
																	</td>
																	<td data-label="Last Name:">
																	<span class="order_id"><?php echo $nominee->nationality;?></span>
																	</td>
																	<td data-label="Date Of Birth:">
																	<span class="order_id"><?php echo date('d.m.Y',strtotime($nominee->dob));?></span>
																	</td>
																			</tr>
																	<?php }  ?>
																	
																	<?php  } else{ ?>
																	<tr><td colspan="3">NO ATTENDEES DETAILS UPDATED.</td> </tr>
																	<?php } ?>
																</tbody>
															</table>
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
		</div>
	</div>
</div>
<?php $this->load->view('common/footer');
?>
<?php exit; ?>
