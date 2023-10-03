<?php $this->load->view('common/header'); ?>
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/app.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/main.css?v=1.1" /> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/style.css?v=3.9.4" />

<style>
	.onebox-order-info td {
    color: #000;
}
.datetimepicker-dummy .datetimepicker-dummy-wrapper .datetimepicker-dummy-input{
        max-width: 100%;
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
												<th>Source type</th>
												<th>Delivery Status</th>
												<th>Booking Status</th>
												<th>Date and Time</th>
												<?php if($orderData->partner_id){?>
												<th>Partner Status</th>
												<?php } ?>
												<th>E-Ticket</th>
												<?php if ($orderData->booking_status == 2) { ?>
												<th>&nbsp;</th>
												<?php } ?>
												</tr>
												<tr>
												<td data-label="Order:">
												<span class="order_id" id="copy_order">#<?php echo $orderData->booking_no; ?></span>
												<i class="fa fa-copy" style="font-size:13px;color:#000" onclick="copy_data('copy_order')"></i>
												</td>
												<td><?php echo $orderData->source_type; ?></td>
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
														<input class="form-check-input" name="sendmail" type="checkbox" value="1" checked id="sendmail">
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
															<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->payment_date))).' '.@$_COOKIE["time_zone"];
                                                            ?>
															</span><!-- <br> -->
															&nbsp;
																<span class="tr_date">
															<i class="fas fa-clock"></i><?php echo date("H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->payment_date)));
                                                            ?></span>
															</td>

															<?php if($orderData->partner_id){?>
													<td><select name="" class="form-control" onchange="update_partner_payment('<?php echo md5($orderData->bg_id);?>',this.value);">
														<option value="0" <?php echo $orderData->seller_payout_status == 0 ? "selected" : "" ;?>>Pending</option>
														<option value="1" <?php echo $orderData->seller_payout_status == 1 ? "selected" : "" ;?>>Paid</option>
													</select></td>
												<?php } ?>

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
														<?php if ($orderData->booking_status == 2) { ?>
														<td data-label="&nbsp;" style="cursor: pointer;">
														<a href="javascript:void(0);" onclick="update_booking_status('<?php echo md5($orderData->bg_id);?>',1);">
														<span style="background-color:#b00505;" class="clrb">CONFIRM</span>
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
											<h3>Seller Order Status</h3>
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
															<img src="<?php echo UPLOAD_PATH; ?><?php echo $orderData->stadium_image; ?>">

															</div>
														</div>
														<div class="column is-7">
															<h4 id="copy_match"><?php echo $orderData->match_name; ?></h4>
															<i class="fa fa-copy" style="font-size:13px;color:#000" onclick="copy_data('copy_match')"></i>
															<p style="color:#a2a5b9;"><span><?php echo $orderData->stadium_name . ',' . $orderData->stadium_city_name. ',' . $orderData->stadium_country_name; ?></span></p>
															<p>
																<span class="tr_date">
																	<i class="fas fa-calendar"></i><?php echo date('d F Y',strtotime($orderData->match_date)); ?> </span>
																	&nbsp;
																<span class="tr_date">
																	<i class="fas fa-clock"></i><?php echo $orderData->match_time; ?> </span>
															</p>
															<p>
																<span class="">Block: <?php 
																if($orderData->ticket_block != ''){
																echo $orderData->ticket_block;
																}
																else{
																echo "Any";
																}
																?></span>
															</p>
															<p>
																<span class="">Section: <?php echo $orderData->seat_category; ?></span>
															</p>
															<p>
																<span class="">Ticket Section: <?php if ($orderData->section == '0') {
            $section=  "Any";
        }
        else if ($orderData->section == '1') {
            $section=  "Home";
        }
        else if ($orderData->section == '2') {
            $section=  "Away";
        }
        else{
            $section=  $orderData->section;
        } ?></span>
															</p>
															<p>
																<span class="">Ticket Type: <?php echo $orderData->ticket_type_name; ?></span>
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
															<table style="width:100%">
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
																	<?php if($orderData->partner_id !="") {?>
																	<tr>
																		<td>Partner Fee:</td>
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
																			<?php echo number_format($orderData->partner_fee,2); ?></td>
																	</tr>

																<?php } ?>
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

																<?php if($orderData->discount_amount != "" && $orderData->discount_amount != 0){?>
<tr>
												<td>Discount Price(-):</td>
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
												?>  <?php echo number_format($orderData->discount_amount,2); ?></td>
												</tr>
												<?php } ?>

												<?php if($orderData->delivery_fee != "" && $orderData->delivery_fee != 0){?>
<tr>
												<td>Delivery Fee(+):</td>
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
												?>  <?php echo number_format($orderData->delivery_fee,2); ?></td>
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
																	<?php if($orderData->partner_id){?>
																	<tr>
																		<td>Partner Commission:</td>
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
												<?php echo number_format($orderData->partner_commission,2); ?></td>
											<?php } ?>
										</tr>

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
												<h3 class="mob_show">Seller Order Status</h3>

												<div class="details">
	                                                <div class="detail_sec_left">
	                                                	<form id="seller_status" method="post" action="<?php echo base_url();?>game/orders/update_seller_status">
	                                                		<input type="hidden" name="bg_id" value="<?php echo $orderData->bg_id;?>">
	                                                    <div class="order_info_type select">
	                                                        <select name="seller_status" id="seller_status" class="form-control">
	                                                        	 <option value="">-Selec Status-</option>
	                                                        <option value="0" <?php if ($orderData->seller_status == 0) { ?> selected <?php } ?>>Processing</option>
	                                                        <option <?php if ($orderData->seller_status == 1) { ?> selected <?php } ?> value="1">Completed</option>
	                                                        <option <?php if ($orderData->seller_status == 2) { ?> selected <?php } ?> value="2">Issue</option>
	                                                        <option <?php if ($orderData->seller_status == 3) { ?> selected <?php } ?> value="3">Get Paid</option>
	                                                       <!--  <option <?php if ($orderData->seller_status == 4) { ?> selected <?php } ?> value="4">Finalising Order</option>
	                                                        <option <?php if ($orderData->seller_status == 5) { ?> selected <?php } ?> value="5">Upload E-Tickets</option>
	                                                         <option <?php if ($orderData->seller_status == 6) { ?> selected <?php } ?> value="6">Upload POD</option>
	                                                        <option <?php if ($orderData->seller_status == 7) { ?> selected <?php } ?> value="7">Cancelled</option> -->
	                                                        </select>
	                                                    </div>
	                                                    <div class="type_btn">
	                                                        <button style="cursor:pointer;" type="submit">Save</button>
	                                                    </div>
	                                                    </form>
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


								<?php if($orderData->partner_id){?>
								<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>Partner Information</h3>
														</div>
											<div class="toptable table_section ordr_info" id="no-more-tables">
												<table>
													<tbody>
														<tr class="accordion">
															<th>Partner Name</th>
															<th>Company Name</th>
															<th>Partner Email</th>
															<th>Partner Mobile.</th>
														
														</tr>
														<tr>
															<td><?php echo $orderData->partner_first_name;?> <?php echo $orderData->partner_last_name;?></td>
															<td><?php echo $orderData->partner_company_name;?></td>
															<td><?php echo $orderData->partner_email;?></td>
															<td><?php echo $orderData->partner_mobile;?></td>
															
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
																<a id="copy_name" target="_blank" href="<?php echo base_url();?>game/orders/list_order/all?customer_id=<?php echo base64_encode(json_encode($orderData->customer_id)) ; ?>">
																	<?php echo $orderData->customer_first_name ; ?> <?php echo $orderData->customer_last_name ; ?>
																</a>
																<i class="fa fa-copy" style="font-size:13px;color:#000" onclick="copy_data('copy_name')"></i>
															</td>
															<td data-label="Billing Name:">
																<?php echo $orderData->title ; ?> <?php echo $orderData->first_name ; ?> <?php echo $orderData->last_name ; ?>
																<span id="copy_billing_name" style="display:none;"><?php echo $orderData->title ; ?> <?php echo $orderData->first_name ; ?> <?php echo $orderData->last_name ; ?></span>
																<i class="fa fa-copy" style="font-size:13px;color:#000" onclick="copy_data('copy_billing_name')"></i>
															</td>
															<td data-label="Billing Email:">
															<?php echo $orderData->email ; ?>
															<span id="copy_billing_email" style="display:none;"><?php echo $orderData->email ; ?></span>
																<i class="fa fa-copy" style="font-size:13px;color:#000" onclick="copy_data('copy_billing_email')"></i>
															</td>
															<td data-label="Billing Contact:">
															<?php echo $orderData->dialing_code ; ?> <?php echo $orderData->mobile_no ; ?>
														<span id="copy_billing_contact" style="display:none;"><?php echo $orderData->dialing_code ; ?> <?php echo $orderData->mobile_no ; ?></span>
														<i class="fa fa-copy" style="font-size:13px;color:#000" onclick="copy_data('copy_billing_contact')"></i>
															</td>
															<td data-label="Billing Address:">
															<?php echo $orderData->address ; ?>,<?php echo $orderData->city_name ; ?>,<?php echo $orderData->country_name ; ?>, <?php echo $orderData->postal_code ; ?>
															<span id="copy_billing_address" style="display:none;"><?php echo $orderData->address ; ?>,<?php echo $orderData->city_name ; ?>,<?php echo $orderData->country_name ; ?>, <?php echo $orderData->postal_code ; ?></span>
														<i class="fa fa-copy" style="font-size:13px;color:#000" onclick="copy_data('copy_billing_address')"></i>
															</td>
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
															<th>Storefront</th>
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
																<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->payment_date))).' '.@$_COOKIE["time_zone"];
                                                            ?>
															</td>
															<td data-label="Txn IP:">
																<?php echo $orderData->ip_address ; ?>
															</td>
															<td data-label="Storefront:">
																<?php echo $orderData->store_name ; ?>
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

																<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->sell_date))).' '.@$_COOKIE["time_zone"];
                                                            ?>
                                                            
																
															</td>
															<td data-label="Ticket Updated Date:">
																<?php

																if($orderData->ticket_updated_date){date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->ticket_updated_date))).' '.@$_COOKIE["time_zone"];
																}?>
															</td>
															<td data-label="Ticket Deleted Date:">
																<?php

																if($orderData->ticket_deleted_date){date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->ticket_deleted_date))).' '.@$_COOKIE["time_zone"];
																}?>
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
												<h3>Delivery Information</h3>
											</div>
								<div class="toptable table_section ordr_info" id="no-more-tables">
									<table>
										<tbody>
											<tr class="accordion">
												<th>Ticket Type</th>
												<th>Delivery Fee</th>
												<th>Uploaded</th>
												<th>Approved </th>
												<th>Email Send</th>
												<th>Resend Email</th>
												<th>Seller</th>
													
											</tr>

											
											<tr>
												    <td><?php echo $orderData->ticket_type_name; ?></td>
													<td><?php 
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
																 <?php echo number_format($orderData->delivery_fee,2);?> </td>
													<td><?php if ($orderData->delivery_status == 0 || $orderData->delivery_status == '') { ?>
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
                        <?php } ?> <?php if($eticketDatas->ticket_upload_date)   echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$eticketDatas[$i - 1]->ticket_upload_date))).' '.@$_COOKIE["time_zone"];
													
													 ?> </td>
													<td><?php  if($orderData->ticket_status == 1)
													echo "Approved Pending" ;

													 else if($orderData->ticket_status == 2)
													 echo "Approved";
													else if($orderData->ticket_status == 3)
													 echo "Downloaded";
													else 
													 echo "Pending";

													  ?>
													<br>

													<?php  if($eticketDatas->ticket_approve_date) echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$eticketDatas[$i - 1]->ticket_approve_date))).' '.@$_COOKIE["time_zone"];

													 ?>
														
													</td>
													
													<td><?php echo $orderData->ticket_email_status == 1? "Sent" :"Pending"; ?></td>
													
													<td><?php  if($orderData->ticket_status > 1) {  ?><a class="button h-button is-primary is-raised "  href="javascript:void(0)" onClick="resend_email('<?php echo md5($orderData->booking_id);?>',2,<?php echo $orderData->ticket_type;?>);">Resend</a>
														<br>
													<input type="email" name="email_address" class="form-control" id="email_address" value="<?php echo $orderData->email ; ?>">
													
													 <?php  } ?></td>
													<td><?php echo $orderData->seller_first_name; ?>
																<?php echo $orderData->seller_last_name; ?></td>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
									
									<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>ATTENDEES DETAILS</h3>
														</div>
														<div class="table_section" id="no-more-tables-v1">
											<form method="post" class="validate_form_v3"  id="nomaini" action="<?php echo base_url('game/saveNominee');?>">

												<input type="hidden" name="ticket_id" value="<?php echo $orderData->bt_id;?>">
												<input type="hidden" name="booking_id" value="<?php echo $orderData->booking_id;?>">
												<input type="hidden" name="booking_no" value="<?php echo $orderData->booking_no;?>">

											<table class="toptable res_table_new table-responsive table_padd">
											<tbody>
												
												<tr class="accordion">
												<th>First Name</th>
												<th>Last Name</th>
												<th>Email</th>
												<th>Nationality</th>

												<th>Date Of Birth</th>
												</tr>
												<?php 
													// if($nominees[0]->first_name != ''){
												//echo "<pre>";print_r($eticketData);
												foreach($nominees as $key => $nominee){
												
													?>
												<tr>
												<td data-label="First Name:">

													<input type="text" class="input" name="first_name[<?php echo $key;?>]" value="<?php echo $nominee->first_name;?>" placeholder="First Name" required id="first_name<?php echo $key;?>" >
												</td>

												<td data-label="Last Name:">
												<span class="order_id">
													<input type="text" class="input" name="last_name[<?php echo $key;?>]" value="<?php echo $nominee->last_name;?>" placeholder="Last Name" id="last_name<?php echo $key;?>"  ></span>
												</td>
												<td data-label="Email">
												<span class="order_id"><input type="email" class="input" name="email[<?php echo $key;?>]" value="<?php echo $nominee->email;?>" placeholder="Email" id="email<?php echo $key;?>" required ></span>
												</td>
												<td data-label="Nationality:">
												<span class="order_id">
													<input type="text" class="input" name="nationality[<?php echo $key;?>]" value="<?php echo $nominee->nationality;?>" placeholder="Nationality" >
													</span>
												</td>
												<td data-label="Date Of Birth:">
												<span class="order_id">
													<input type="date" id="bulma-datepicker<?php echo $key;?>" class="input" name="dob[<?php echo $key;?>]" value="" placeholder="DOB" >
													</span>
												</td>
														</tr>
												<?php }  ?>
												
												<?php // } else{ ?>
												<!-- <tr><td colspan="3">NO ATTENDEES DETAILS UPDATED.</td> </tr> -->
												<?php// } ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="5" align="right"><input class="button h-button is-primary is-raised" value="submit" type="submit" ></td>
												</tr>
											</tfoot>
											</table>
											</form>
											</div>
												</div>
										</div>
									</div>
										
								</div>
								<?php 
								//echo "<pre>";print_r($order_tickets);
								if($order_tickets[0]->reject_reason != ""){ ?>
								<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>Reject Reason</h3>
														</div>
														<div class="table_section details" id="no-more-tables-v1">

														<?php echo $order_tickets[0]->reject_reason;?>
													</div>
												</div>
										</div>
									</div>
										
								</div>
							<?php } ?>
								<?php 
								//echo '<pre>';print_r($eticketDatas);
								if ($eticketDatas[0]->ticket_file != "" && $orderData->ticket_type == 2) { ?>

								<div class="account-wrapper">
									<div class="row">									
												<div class="columns">
													<div class="column is-12">
														<div class="onebox-order-heading">
															<h3>Ticket Info</h3>
														</div>
														<div class="table_section" id="no-more-tables-v1">

							<table class="toptable res_table_new table-responsive table_padd">
											<tbody>
												<tr class="accordion ui-accordion ui-widget ui-helper-reset">
												<th>Ticket No</th>
												<th>Ticket ID</th>
												<th>Uploaded Date</th>
												<th>Download Date</th>
												<th>View Ticket</th>
												</tr>
												<?php
															
															if ($orderData->quantity > 0 && $orderData->quantity != '') {
																for ($i = 1; $i <= $orderData->quantity; $i++) {
															?>
												<tr>
													<td data-label="sl.No"><?php echo $i;?></td>
													<td data-label="Ticket Id"><?php echo $eticketData[$i - 1]->ticketid;?></td>
													<td data-label="Upload Date"><?php if ($eticketDatas[$i - 1]->ticket_file != "") { 

														if($eticketDatas[$i - 1]->ticket_upload_date != ""){

														echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$eticketDatas[$i - 1]->ticket_upload_date))).' '.@$_COOKIE["time_zone"];
														}

													} else{?> &nbsp; <?php } ?></td>
													<td data-label="Download Date"><?php if ($eticketDatas[$i - 1]->ticket_file != "") { 

														if($eticketDatas[$i - 1]->ticket_download_date != ""){

														echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$eticketDatas[$i - 1]->ticket_download_date))).' '.@$_COOKIE["time_zone"];

														}

													} else{?> &nbsp; <?php } ?></td>
													<?php if ($eticketDatas[$i - 1]->ticket_file != "") { ?>
													<td data-label="View"><a download target="_blank" href="<?php echo UPLOAD_PATH.'uploads/e_tickets/'.$eticketDatas[$i - 1]->ticket_file;?>">
																	<span title="View Ticket" class="ticket_cancel" style="cursor: pointer;">
																	<i class="fa fa-file-pdf"></i>
																	</span>
																</a></td>
													<?php } else{ ?>
													<td data-label="View">No Tickets Uploaded</td>
													<?php } ?>
													
													<!-- <td colspan="3">NO ATTENDEES DETAILS UPDATED.</td>  -->
												</tr>
											<?php } } ?>
											</tbody>
										</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

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
<script>
	function copy_data(id){
	 var copyText = document.getElementById(id);
    var textArea = document.createElement("textarea");
    textArea.value = copyText.textContent;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
    alert("Copied Successfully.");

	}
	<?php 
								
		foreach($nominees as $key => $nominee){?>
	 bulmaCalendar.attach("#bulma-datepicker<?php echo $key ;?>", { dateFormat: "YYYY-MM-DD" ,startDate: new Date('<?php echo date('Y-m-d' ,strtotime($nominee->dob));?>'), color: themeColors.primary, lang: "en",showHeader: false,
	    showButtons: false,
	    showFooter: false });
	<?php } ?>	

		function resend_email(id,status,ticket_type){

		 swal({
		    title: 'Are you sure resend the email ?',
		    text: "Send or Cancel",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#0CC27E',
		    cancelButtonColor: '#FF586B',
		    confirmButtonText: 'Yes, Send!',
		    cancelButtonText: 'No, cancel!',
		    confirmButtonClass: 'button h-button is-primary',
		    cancelButtonClass: 'button h-button is-danger',
		    buttonsStyling: false
		  }).then(function (res) {


    if (res.value == true) {
       var email = $("#email_address").val();
      $.ajax({
        url: base_url + 'game/orders/send_mail_ticket_status',
        method: "POST",
        data : {"ticket_id" : id,"status" : status,"ticket_type" : ticket_type,"email" : email},
        dataType: 'json',
        success: function (result) {

           if (result) {

            swal('Updated !', result.msg, 'success');

          }
          else {
            swal('Updation Failed !', result.msg, 'error');

          }

          setTimeout(function () { window.location.reload(); }, 2000);
        }
      });
    }
    else {

    }



  }, function (dismiss) {

  });

}

	</script>
<?php exit; ?>
