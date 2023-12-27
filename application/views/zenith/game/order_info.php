<style>
.swal2-popup .swal2-close:hover{
  color: #ccc !important;
}
.swal2-popup .swal2-title{
	/* margin-top: 30px !important; */
	font-size: 28px !important;
    font-weight: 700 !important;
    text-align: center !important;
    line-height: 39.2px !important;
    padding: 0 30px !important;
    margin-bottom: 15px !important;
	color: #0037D5 !important;	
}
.swal2-popup .btn-primary{
    background: #039871 !important;
	background-color: #039871 !important;
    color: #fff;
    border-color: #039871 !important;
}

.swal2-popup .btn-light {
    background: #ED1C24;
    border: #ED1C24;
    width: 163px;
    height: 35px;
    border-radius: 0px;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}

.view_bg{
color: #ffffff !important;
}
.highlighted {
color: #00a3ed !important;
}
#on_hold{
	height:40px;
}
</style>
<?php $this->load->view(THEME.'/common/header'); ?>

 <!-- Begin main content -->
 <div class="main-content">
		 <!-- content -->
		 <div class="page-content">
			<!-- page header -->
			<div class="page-title-box">
			   <div class="container-fluid">
				  <div class="page-title dflex-between-center side_arrow">
					 <h3 class="mb-1"> 
						<div class="go_back_btn" data-click="<?php
							echo $url = base_url() . "game/orders/list_order/all";
							?>">
					  <i class="fas fa-arrow-left"></i></a>
					  </div>
					  Order Info</h3>
					 
				  </div>
			   </div>
			</div>

			
			<!-- page content -->
			<div class="page-content-wrapper mt--45 order_info">
			   <div class="container-fluid">
				  <div class="row">
					 <div class="col-md-12 col-lg-12">
						<div class="card card-body">
						   <!-- <div class="col-md-12 col-lg-12">
							  <h4>Order Info</h4>
						   </div> -->
						   <div class="table-responsive">
							  <table class="table table-hover table-nowrap mb-0 form-drp-btn">
								 <thead class="thead-light">
									<tr>
									   <th class="fs-16">Order ID</th>
									   <th class="fs-16">Source Type</th>
									   <th class="fs-16">Delivery Status</th>
									   <th class="fs-16">Booking Status</th>
									   <th class="fs-16">Send Email</th>
									   <th class="fs-16">Transaction Date</th>
									   <th class="fs-16">Delivery Deadline</th>
									   <th class="fs-16">E-Ticket</th>
									   <?php if ($orderData->booking_status == 2) { ?>
												<th>&nbsp;</th>
												<?php } ?>
									</tr>
								 </thead>
								 <tbody>
									<tr>
									   <td><span class="order_id" id="copy_order_id"><b>
										<p id='output'></p>
										<?php 

										$tixstock_order_id =  $orderData->tixstock_order_id ? " / ".$orderData->tixstock_order_id : "";

										//echo $orderData->booking_no; 
										$booking_no='<a href="'.base_url()."game/orders/details/". md5($orderData->booking_no).'" '."id='copy_order'".'>#'.$orderData->booking_no.$tixstock_order_id.'</a>';    
										echo $booking_no   ;                                         ?>
									</b> </span><i class="far fa-copy"  id="copyButton"></i>
									<i class="far fa-copy" onclick="copy_data('copy_order_id',this)" ></i></td>
									   <td> <?php echo ucfirst($orderData->source_type); ?> </td>
									  
									   <td>
										  <div class="form-group">

										  <select name="delivery_status" id="delivery_status_order" class="custom-select">
										  	<option value="0" <?php if ($orderData->delivery_status == 0 ) { ?> selected
											<?php } ?>>Tickets Not Uploaded</option>
											<option value="1" <?php if ($orderData->delivery_status == 1 ) { ?> selected
											<?php } ?>>Tickets In-Review</option>
											<option value="2" <?php if ($orderData->delivery_status == 2 ) { ?> selected
											<?php } ?>>Tickets Approved</option>
											<option value="3" <?php if ($orderData->delivery_status == 3 ) { ?> selected
											<?php } ?>>Tickets Rejected</option>
											<option value="4" <?php if ($orderData->delivery_status == 4 ) { ?> selected
											<?php } ?>>Tickets Downloaded</option>
											<option value="5" <?php if ($orderData->delivery_status == 5 ) { ?> selected
											<?php } ?>>Tickets Shipped</option>
											<option value="6" <?php if ($orderData->delivery_status == 6 ) { ?> selected
											<?php } ?>>Tickets Delivered</option>
									   	  </select>
										  <?php /* if ($orderData->delivery_status == 0 || $orderData->delivery_status == '') { ?>
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
												<?php } */?>
										 </div>
									  </td>


									   <td>
										  <div class="form-group">
											<?php 
										

											if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 11) { ?>

												<select name="e-tickets" id="status" class="custom-select call_modals"
													data-toggle="modal" data-target="update_booking_status"  data-title="Are you sure want to Confirm this Booking ?" data-sub-title="Email will go to user if status change !" data-yes="Yes, Change it!" data-no="No, Cancel!" data-btn-id="update_modal_booking_status" data-bg-id="<?php echo md5($orderData->bg_id); ?>" >
													<?php if ($orderData->booking_status != 0 && $orderData->booking_status != 7 && $orderData->booking_status != 3) { ?>
														<option value="2" <?php if ($this->session->userdata('role') == 1 && $orderData->booking_status == 1) { ?>
																disabled <?php } ?> 		<?php if ($orderData->booking_status == 2) { ?> selected <?php } ?>>Pending</option>
														<option value="1" <?php if ($orderData->booking_status == 1) { ?> selected <?php } ?>>Confirmed</option>
													<?php } ?>
													<?php if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 11) { ?>
														<option value="0" <?php if ($orderData->booking_status == 0 || $orderData->booking_status == 7) { ?> selected
															<?php } ?>>Failed</option>
														<option value="3" <?php if ($orderData->booking_status == 3) { ?> selected <?php } ?>>Cancelled</option>
														<?php if ($orderData->booking_status != 0 && $orderData->booking_status != 7 && $orderData->booking_status != 3) { ?>
															<option value="4" <?php if ($orderData->booking_status == 4) { ?> selected <?php } ?>>Shipped</option>
															<option value="5" <?php if ($orderData->booking_status == 5) { ?> selected <?php } ?>>Delivered</option>
															<option value="6" <?php if ($orderData->booking_status == 6) { ?> selected <?php } ?>>Downloaded</option>
														<?php } ?>
													<?php } ?>
												</select>
											<?php } ?>
										</div>
									</td>
									<td>
										  <div class="">
								  <div class="content">
									  <div class="custom-control custom-switch">
										 <input name="sendmail" type="checkbox" class="custom-control-input" value="1" checked id="sendmail" >										
										 <label class="custom-control-label" for="sendmail"></label>
									   </div>
								  </div>
								</div>
									  </td>
									   <td data-label="Transaction date:">
										  <span class="tr_date">
										  <!-- <i class="fa fa-calendar"></i> -->
										  <?php echo date("D j F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->payment_date))) . ' ' . @$_COOKIE["time_zone"];
										  ?></span><br>
										  <span class="tr_date">
										  <!-- <i class="fas fa-clock"></i>--><?php echo date("H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->payment_date)));
										  ?></span> 
									   </td>
									   <td data-label="Transaction date:">
										  <span class="tr_date">										
										  <?php 

												$date1 = new DateTime(date("D j F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->payment_date))) . @$_COOKIE["time_zone"] . date("H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->payment_date))));
												$date2 = new DateTime(date('D j F Y', strtotime($orderData->match_date . ' -3 days')) . date('H:i', strtotime($orderData->match_time)));

												$diff = $date1->diff($date2);
												$days = $diff->days;

												$delivery_date = "";

												if ($days <= 1) {
													$delivery_date = "Delivery In Due";
												} else {
													$delivery_date = date('D j F Y', strtotime($orderData->match_date . ' -3 days')) . "<br/>" . date('H:i', strtotime($orderData->match_time));
												}

												echo $delivery_date;

										 	
										  ?></span><br>
										  <span class="tr_date"></span> 
									   </td>
										<?php
										
										if($orderData->ticket_type == 2 || $orderData->ticket_type == 4){
										if (count($eticketData) > 0 && ($orderData->booking_status == 1 || $orderData->booking_status == 4 || $orderData->booking_status == 5 || $orderData->booking_status == 6) && ($eticketDatas[0]->ticket_file != '')) { ?>
											<td style="cursor: pointer;">
												<div class="receive_btn">
													<button type="button" class="btn btn-info waves-effect waves-light fs-18" data-effect="wave"><a
															class="button is-success"
															href="<?php echo base_url(); ?>/game/download_tickets/<?php echo md5($orderData->booking_no); ?>">
															Download (
															<?php echo count($eticketData); ?> Tickets /
															<?php echo $orderData->quantity; ?>)
														</a></button>
												</div>
											</td>
										<?php }}else if(($orderData->ticket_type != 2 || $orderData->ticket_type != 4) && ($orderData->booking_status == 1 || $orderData->booking_status == 4 || $orderData->booking_status == 5)){ ?>
											<td style="cursor: pointer;">
												-
											</td>
										 <?php } else { ?>
											<td style="cursor: pointer;">
												<div class="receive_btn">
													<button type="button" class="btn btn-info waves-effect waves-light fs-18" data-effect="wave"><a id='' 
															class="button is-success send_ticket call_modal" href="javascript:void(0);"  data-toggle="modal" data-target="centermodal1"  data-title="Are you sure you want to send a email ?" data-sub-title="Email will go to the user if there is a status change !" data-yes="Yes, Send!" data-no="No, Cancel!" data-btn-id="emailIcon_need_to_receive">
															Need to Receive (
															<?php echo $orderData->quantity; ?>)
														</a></button>
												</div>
											</td>

										<?php } ?>
										<?php if ($orderData->booking_status == 2) { ?>
											<td>
												<div class="receive_btn">
													<button type="button" class="btn btn-info waves-effect waves-light fs-18" data-effect="wave"><a
															class="button is-success" href="javascript:void(0);"
															onclick="update_booking_status('<?php echo md5($orderData->bg_id); ?>',1);">
															Confirm
														</a></button>
												</div>
											</td>

										<?php } else { ?>
											<td></td>
											<?php }  ?>

									</tr>
								 </tbody>
							  </table>
						   </div>                  
						</div>
					 </div>				   
					 <div class="col-md-9 col-lg-9">
						<div class="card">
						   <div class="card-body">
							  <h3>Ticket Information</h3>
							  <div class="row">
								 <div class="col-md-6">
									<div class="img_stadium">
									   <!-- <img src="https://www.listmyticket.com//uploads/stadium/maps/user-uploads/old-trafford-stadium.svg"> -->
									   <img src="<?php echo UPLOAD_PATH; ?><?php echo $orderData->stadium_image; ?>">
									</div>
								 </div>
								 <div class="col-md-6">
									  <h4 id="copy_match_name"><?php echo $orderData->match_name; ?></h4>
									  <p style="color:#a2a5b9;">
										<span>
											<?php echo $orderData->stadium_name . ',' . $orderData->stadium_city_name . ',' . $orderData->stadium_country_name; ?>
										</span>
									  </p>
									  <p>
										<span class="tr_date"><?php echo date('d F Y', strtotime($orderData->match_date)); ?> </span> &nbsp; <span class="tr_date"><?php echo $orderData->match_time; ?></span>
									  </p>
									  <table style="width:100%;" class="blk_sect">
										 <tbody>
										 	<tr>
											   <td>Block:</td>
											   <td id="copy_block"><?php
											   if ($orderData->ticket_block != '') {
												   echo $orderData->ticket_block;
											   } else {
												   echo "Any";
											   }
											   ?></td>
											 </tr>
											<tr>
											   <td>Row:</td>
											   <td id="copy_row"><?php
											   if ($orderData->row != '') {
												   echo $orderData->row;
											   } else {
												   echo "Any";
											   }
											   ?></td>
											 </tr>
											 <tr>
											   <td>Section:</td>
											   <td id='copy_section'><?php echo $orderData->seat_category; ?></td>
											 </tr>
											 <tr>
											   <td>Ticket Section:</td>
											   <td>
												<?php
												if ($orderData->section == '0') {
													$section = "Any";
												} else if ($orderData->section == '1') {
													$section = "Home";
												} else if ($orderData->section == '2') {
													$section = "Away";
												} else {
													$section = $orderData->section;
												}
												?>
											   </td>
											 </tr>
											 <tr>
											   <td>Ticket Type:</td>
											   <td><?php echo $orderData->ticket_type_name; ?></td>
											 </tr>
											 <tr>
											   <td>Sellers Notes:</td>
											   <td id='copy_notes'>													
	<?php if (isset($seller_notes)) { ?>
			<?php foreach ($seller_notes as $seller_note) { ?>					
					<?php echo $seller_note->ticket_name; ?><br>
			<?php } ?>
	<?php } ?>
												</td>

<td id='hide_copy_notes' style="display:none"><?php if (isset($seller_notes)) { $count = count($seller_notes); foreach ($seller_notes as $key => $seller_note) {
            echo $seller_note->ticket_name . ($key < $count - 1 ? ', ' : '.');
            ?><br/><?php
        }
    } ?></td>
											 </tr>

										 </tbody>
									  </table>
									  <table style="width:100%" class="quan_sect">
										<tbody>
										  <tr>
											<td class="w-40">Quantity:</td>
											<td id='copy_qty'>
												<?php echo $orderData->quantity; ?>
											</td>
										  </tr>
										  <tr>
											<td class="w-40"> Price:</td>
											<td>
											  <span class="qty">
											  <?php
											  if (strtoupper($orderData->currency_type) == "GBP") { ?>
														<!-- <i class="fas fa-pound-sign"></i> -->
														£
													<?php } ?>
													<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
														<!-- <i class="fas fa-euro-sign"></i> -->
														€
													<?php }
													if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
														echo strtoupper($orderData->currency_type);
													}
													?>
														<?php echo number_format($orderData->price, 2);
														?>
											  </span>
											</td>
										  </tr>
										  <tr>
											<td class="w-40">Sub Total:</td>
											<td>
											<?php
											if (strtoupper($orderData->currency_type) == "GBP") { ?>
													<!-- <i class="fas fa-pound-sign"></i> -->
													£
												<?php } ?>
												<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
													<!-- <i class="fas fa-euro-sign"></i> -->
													€
												<?php }
												if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
													echo strtoupper($orderData->currency_type);
												}
												?>
													<?php echo number_format($orderData->ticket_amount, 2);
													?>
											</td>
										  </tr>
										  <?php if ($this->session->userdata('role') != 1) { ?>
													<tr>
														<td class="w-40">Seller Fee:</td>
														<td>
														<?php
														if (strtoupper($orderData->currency_type) == "GBP") { ?>
																		<!-- <i class="fas fa-pound-sign"></i> -->
																		£
																	<?php } ?>
																	<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																		<!-- <i class="fas fa-euro-sign"></i> -->
																		€
																	<?php }
																	if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
																		echo strtoupper($orderData->currency_type);
																	}
																	?>
																				<?php echo number_format($orderData->seller_fee, 2); ?>
														</td>
													</tr>
										  <?php } ?>
										  <?php if ($orderData->partner_id != "") { ?>
													<tr>
														<td class="w-40">Partner  Fee:</td>
														<td>
														<?php
														if (strtoupper($orderData->currency_type) == "GBP") { ?>
																		<!-- <i class="fas fa-pound-sign"></i> -->
																		£
																	<?php } ?>
																	<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																		<!-- <i class="fas fa-euro-sign"></i> -->
																		€
																	<?php }
																	if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
																		echo strtoupper($orderData->currency_type);
																	}
																	?>
																				<?php echo number_format($orderData->partner_fee, 2); ?>
														</td>
													</tr>
										  <?php } ?>
										  <tr>
											<td class="w-40">Store Fee/Tax:</td>
											<td>
											<?php
											if (strtoupper($orderData->currency_type) == "GBP") { ?>
																	<!-- <i class="fas fa-pound-sign"></i> -->
																	£
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																	<!-- <i class="fas fa-euro-sign"></i> -->
																	€
																<?php }
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
																	echo strtoupper($orderData->currency_type);
																}
																?>
																			<?php echo number_format($orderData->store_fee, 2); ?>
											</td>
										  </tr>
											  <?php if ($orderData->premium_price != "" && $orderData->premium_price != 0) { ?>
													<tr>
														<td class="w-40">Booking Protect Price:</td>
														<td>
														<?php
														if (strtoupper($orderData->currency_type) == "GBP") { ?>
																		<!-- <i class="fas fa-pound-sign"></i> -->
																		£
																	<?php } ?>
																	<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																		<!-- <i class="fas fa-euro-sign"></i> -->
																		€
																	<?php }
																	if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
																		echo strtoupper($orderData->currency_type);
																	}
																	?>
																				<?php echo number_format($orderData->premium_price, 2); ?>
														</td>
													 </tr>
											<?php } ?>

											<?php if ($orderData->discount_amount != "" && $orderData->discount_amount != 0) { ?>
													<tr>
												<td class="w-40">Discount Price(-):</td>
												<td>
												<?php
												if (strtoupper($orderData->currency_type) == "GBP") { ?>
														<!-- <i class="fas fa-pound-sign"></i> -->
														£
													<?php } ?>
													<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
														<!-- <i class="fas fa-euro-sign"></i> -->
														€
													<?php }
													if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
														echo strtoupper($orderData->currency_type);
													}
													?>  	<?php echo number_format($orderData->discount_amount, 2); ?>
												</td>
											  </tr>
											<?php } ?>

											<?php if ($orderData->delivery_fee != "" && $orderData->delivery_fee != 0) { ?>
													<tr>
														<td class="w-40">Delivery Fee(+):</td>
														<td>
														<?php
														if (strtoupper($orderData->currency_type) == "GBP") { ?>
														<!-- <i class="fas fa-pound-sign"></i> -->
														£
													<?php } ?>
													<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
														<!-- <i class="fas fa-euro-sign"></i> -->
														€
													<?php }
													if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
														echo strtoupper($orderData->currency_type);
													}
													?>  	<?php echo number_format($orderData->delivery_fee, 2); ?>
														</td>
													  </tr>
											<?php } ?>
										  <tr>
											<td class="w-40">Total:</td>
											<td>
											<?php
											if (strtoupper($orderData->currency_type) == "GBP") { ?>
																	<!-- <i class="fas fa-pound-sign"></i> -->
																	£
																<?php } ?>
																<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
																	<!-- <i class="fas fa-euro-sign"></i> -->
																	€
																<?php }
																if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
																	echo strtoupper($orderData->currency_type);
																}
																?>
																 <?php echo number_format($orderData->total_amount, 2); ?>
											</td>
										  </tr>

										  <?php if ($orderData->partner_id) { ?>
												<tr>
													<td class="w-40">Partner Commission:</td>
													<td>
													<?php
													if (strtoupper($orderData->currency_type) == "GBP") { ?>
															<!-- <i class="fas fa-pound-sign"></i> -->
															£
														<?php } ?>
														<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
															<!-- <i class="fas fa-euro-sign"></i> -->
															€
														<?php }
														if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
															echo strtoupper($orderData->currency_type);
														}
														?>
													<?php echo number_format($orderData->partner_commission, 2); ?>
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

					 <div class="col-md-3 col-lg-3">
						<div class="card info_all">
						   <div class="card-body">
							  <h3>Seller Order Status</h3>
									  <form id="seller_status" method="post" action="<?php echo base_url(); ?>game/orders/list_order">
										<input type="hidden" name="bg_id" value="<?php echo $orderData->bg_id; ?>">
											<div class="details form-drp-btn">
												<div class="form-group form-drp-dwn">
												<select name="seller_status" id="seller_status" class="form-control">
													<option value="">-Selec Status-</option>
													<option value="0" <?php if ($orderData->seller_status == 0) { ?> selected <?php } ?>>Processing</option>
													<option <?php if ($orderData->seller_status == 1) { ?> selected <?php } ?> value="1">Completed</option>
													<option <?php if ($orderData->seller_status == 2) { ?> selected <?php } ?> value="2">Issue</option>
													<option <?php if ($orderData->seller_status == 3) { ?> selected <?php } ?> value="3">Get Paid</option>
													</select>
												</div>
												<div class="save_btn">
												<button type="submit" id="seller_order_status" class="btn btn-info waves-effect waves-light is-raised" data-effect="wave">Save</button>
												</div>
												<div class="save_btn">
												<button type="button" id="set_on_hold" class="btn btn-info waves-effect waves-light is-raised" data-effect="wave" data-toggle="modal"                           data-target="#tracking_number">Set On Hold</button>
												</div>

												<div class="modal fade" id="tracking_number" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myCenterModalLabel">Set On Hold</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form id="ticket_tracking" novalidate="novalidate"
				action="#" class="name" method="post">
				
				<div class="modal-body">
					<div class="signed_cnct">
						<?php
						/* if ($tracking_data[0]->tracking_id != "")
						{*/
						?>
						<div class="col-lg-12">
							<div class="form-group">
							<label for="simpleinput">Hold Price</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text rounded-0" id="basic-addon1">
											<?php
												if (strtoupper($orderData->currency_type) == "GBP") { ?>
														£
													<?php } ?>
													<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
														€
													<?php }
													if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
														echo strtoupper($orderData->currency_type);
													}
											?>
									   </span>
                                    </div>
									<input type="text" class="form-control" placeholder="Enter Hold Price" name="on_hold"  id="on_hold"  value="<?php echo $orderData->on_hold; ?>" required>
                                 </div>                                                    
                                 <label id="coupon_value-error" class="error" for="coupon_value"></label>
                              </div>

						</div>
						<div class="signed_upload mt-3 mb-4">
							<div class="form-group mb-0">
								<div class="input-group">
									<div class="custom-file">
										<button type="button"
											form-id="ticket_tracking"
											class="on_hold_submit custom-file-label" for="inputGroupFile04">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
									</form>
								<?php


								 //if($orderData->ticket_type == 2 || $orderData->ticket_type == 4){ ?>
								 <div class="upload_e_ticket_btn_page">
									<div class="form-group mb-20">
											 <div class="input-group">
											   <div class="custom-file">
												 <!-- <input type="file" class="custom-file-input" id="inputGroupFile04"> -->
												 <label class="custom-file-label" for="inputGroupFile05">
													<!-- <a href="<?php //echo base_url(); ?>game/orders/upload_e_ticket/<?php //echo md5($orderData->booking_no); ?>" class="view_bg">Upload Ticket </a> -->													
													<button type="button" class="custom-file-label" data-effect="wave" onclick="return upload_ticket('<?php echo md5($orderData->booking_no); ?>');">Upload Ticket</button>
												</label>
											   </div>
											 </div>
										  </div>
								 </div>
								<?php //} ?>
								 <div class="btn_instructions">
                                    <div class="form-group mb-20">
                                             <div class="input-group">
                                               <div class="custom-file">
                                                 <input type="file" name="ticket_instruction" class="custom-file-input ticket-instruction" id="inputGroupFile04" data-id="<?php echo $orderData->booking_no; ?>"  accept="image/jpeg,image/png,application/pdf">
                                                 <label class="custom-file-label" for="inputGroupFile04">Upload Ticket Instructions</label>
                                               </div>
                                             </div>
                                          </div>
                                   <!-- <button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave">
                                    <a class="button is-success" href="javascript:void(0);" onclick="">Upload Ticket Instructions</a>
                                    </button> -->
                                 </div>
								 <?php

									//if (($eticketDatas[0]->ticket_status == 2 || $eticketDatas[0]->ticket_status == 1) && ($orderData->ticket_type == 2 || $orderData->ticket_type == 4)) { 

										if ($eticketDatas[0]->ticket_file != '') {
										?>
								 <h4>Uploaded Tickets</h4>
								 	
								 <div id="TopAirLine_new" class="topAirSlider_new owl-carousel owl-theme">
									<?php
									//if (!empty($eticketDatas)) {
										$i=1;
										foreach ($eticketDatas as $data) {
											if ($data->ticket_status == 2 || $data->ticket_status == 1) {
									?>
												<div class="item">
													<div class="imag_view">
													<embed  class="d-block img-fluid embed_file" src="<?php echo TICKET_UPLOAD_PATH."uploads/e_tickets/".$data->ticket_file;?>"  />
														<p><?php echo $data->ticket_file;?></p>
													</div>

													<div class="icon_hover">
														<ul>
															<!-- <li><div class="remove_ico"><i class="far fa-trash-alt"></i></div></li>
															<li><div class="view_ico"><i class="far fa-eye"></i></div></li> -->

															<li><div class="remove_ico"><i class=" far fa-trash-alt delete_ticket" data-delete-id='<?php echo $data->ticketid; ?>' ></i></div></li>  
                      
                          									<li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/e_tickets/'.$data->ticket_file;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>

														</ul>
													</div>
												</div>
									<?php
											}
											$i++;
										} ?>
									</div>
									<?php } //} 
									 if(($eticketDatas[0]->ticket_status == 0 || $eticketDatas[0]->ticket_status == 2 || $eticketDatas[0]->ticket_status == 1) && ($orderData->ticket_type == 1 || $orderData->ticket_type == 2 || $orderData->ticket_type == 4)){
									 		//if ($eticketDatas[0]->qr_link != '') {
									  ?>
										<h4>Tickets QR Links</h4>
								 	
								 		<div >
										<?php
									//if (!empty($eticketDatas)) {
										$i=1;
										foreach ($eticketDatas as $serial => $data) {
											if ($data->ticket_status == 0 || $data->ticket_status == 2 || $data->ticket_status == 1) {
									?>
												<div class="upload_inst">
														<?php //if($data->qr_link != ""){ ?>
														<p><span style="text-decoration: underline;color: #00A3ED" class="tooltip_texts" data-toggle="tooltip" data-placement="right" data-html="true" target="_blank" href="<?php echo $data->qr_link;?>" data-original-title="<?php echo $data->qr_link;?>"><i class="bx bxl-android" aria-hidden="true"></i> Ticket #<?php echo $data->serial;?> Android QR</span></p>
													<ul>
													<li><div class="remove_ico" data-toggle="modal"
                           data-target="#qr_link_android_<?php echo $data->id; ?>"><i class="far fa-edit qr_edit" data-delete-id='<?php echo $data->id; ?>' ></i></div></li>  
                           							<?php if($data->qr_link != ""){ ?>
													<li><div class="remove_ico" onclick="copy_data('copy_qr_link_<?php echo $data->id; ?>',this)"><i style="color: #ffff;" class="far fa-copy qr_copy"></i></div></li> 
													<span style="display: none;" id="copy_qr_link_<?php echo $data->id; ?>"><?php echo $data->qr_link;?></span>
												<?php } ?>
													<div class="modal fade" id="qr_link_android_<?php echo $data->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myCenterModalLabel">TICKET #<?php echo $data->serial;?> Android QR Link</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form id="qr_link_update_<?php echo $data->id;?>" novalidate="novalidate" action="<?php echo base_url();?>/game/update_qr_link" class="name" data-attr="<?php echo $data->id;?>" method="post">

                                <div class="modal-body">
                                 <div class="signed_cnct">
                                     <?php 
                                     /*if ($data->qr_link != "")
                                     {*/
                                      ?>
								<div class="col-lg-12">
								<div class="form-group mt-3 mb-0">
								<label for="simpleinput">QR Link</label>
								<input type="text" class="form-control reference" name="qr_link" placeholder="Ticket #<?php echo $data->serial;?> QR" value="<?php echo $data->qr_link;?>">
								<input type="hidden" name="os" value="ANDROID">
								<input type="hidden" name="ticket_id" value="<?php echo $data->id;?>">								
								</div>
								</div>
                                   <?php //} ?>
                                     <div class="signed_upload mt-3 mb-4">
                                       <div class="form-group mb-0">
                                          <div class="input-group">
                                            <div class="custom-file">
                                              <button type="submit" form-id="qr_link_update_<?php echo $data->id;?>" class="submit_qr custom-file-label" for="inputGroupFile04">Save</button>
                                            </div>
                                          </div>
                                       </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->

													</ul>
													   <?php //} ?>
													   <?php //if($data->qr_link_ios != ""){ ?>
														<p><span style="text-decoration: underline;color: #00A3ED" class="tooltip_texts" data-toggle="tooltip" data-placement="right" data-html="true" target="_blank" href="<?php echo $data->qr_link_ios;?>" data-original-title="<?php echo $data->qr_link_ios;?>"><i class="mdi mdi-apple" aria-hidden="true"></i>Ticket #<?php echo $data->serial;?> IOS QR</span></p>
														<ul>
													<li><div class="remove_ico" data-toggle="modal"
                           data-target="#qr_link_ios_<?php echo $data->id; ?>"><i class="far fa-edit qr_edit_ios" data-delete-id='<?php echo $data->id; ?>' ></i></div></li>  

                           							<?php if($data->qr_link_ios != ""){ ?>
													<li><div class="remove_ico" onclick="copy_data('copy_qr_link_ios_<?php echo $data->id; ?>',this)"><i style="color: #ffff;" class="far fa-copy qr_copy"></i></div></li> 
													<span style="display: none;" id="copy_qr_link_ios_<?php echo $data->id; ?>"><?php echo $data->qr_link_ios;?></span>
												<?php } ?>
													<div class="modal fade" id="qr_link_ios_<?php echo $data->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myCenterModalLabel">TICKET #<?php echo $data->serial;?> IOS QR Link</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                  <form id="qr_link_updates_<?php echo $data->id;?>" novalidate="novalidate" action="<?php echo base_url();?>/game/update_qr_link" class="name" data-attr="<?php echo $data->id;?>" method="post">
                                <div class="modal-body">
                                 <div class="signed_cnct">
                                     <?php 
                                     /*if ($data->qr_link_ios != "")
                                     {*/
                                      ?>
								<div class="col-lg-12">
								<div class="form-group mt-3 mb-0">
								<label for="simpleinput">QR Link</label>
								<input type="text" class="form-control reference" placeholder="Ticket #<?php echo $data->serial;?> QR" name="qr_link" value="<?php echo $data->qr_link_ios;?>">
								<input type="hidden" name="os" value="IOS">
								<input type="hidden" name="ticket_id" value="<?php echo $data->id;?>">
								</div>
								</div>
                                   <?php// } ?>
                                     <div class="signed_upload mt-3 mb-4">
                                       <div class="form-group mb-0">
                                          <div class="input-group">
                                            <div class="custom-file">
                                           <button type="submit" form-id="qr_link_updates_<?php echo $data->id;?>" class="submit_qr custom-file-label" for="inputGroupFile04">Save</button>
                                            </div>
                                          </div>
                                       </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
													</ul>
													   <?php //} ?>

													
												</div>
									<?php
											}
											$i++;
										} ?>
										</div>
									<?php //}
								} ?>
									<?php  if(($eticketDatas[0]->ticket_status == 0 || $eticketDatas[0]->ticket_status == 2 || $eticketDatas[0]->ticket_status == 1) && ($orderData->ticket_type == 3 || $orderData->ticket_type == 4 || $orderData->ticket_type == 1)){ 
										$tracking_data = 		$this->General_Model->getAllItemTable_Array('booking_ticket_tracking', array('booking_id' => $eticketDatas[0]->booking_id))->result();
										?>
										<?php 
								 		//echo "tracking_number <pre>";print_r($tracking_data);
								 		//if($tracking_data[0]->tracking_number != "" || $tracking_data[0]->pod != ""){ ?>
								 		<?php //if($tracking_data[0]->tracking_number != "") { 
											?>
										<h4>Tickets Tracking Details</h4>
								 		<div class="upload_inst">
								 		
														<p><span style="color: #00A3ED" class="tooltip_texts" data-toggle="tooltip" data-placement="right" data-html="true" target="_blank" href="<?php echo $tracking_data[0]->tracking_number;?>" data-original-title="<?php echo $tracking_data[0]->tracking_number;?>"><?php echo $tracking_data[0]->tracking_number;?></span></p>
									
													   
													</div>
									 <?php //} ?>
										<?php if($tracking_data[0]->pod != "") { 
											?>
											<h4>Ticket POD</h4>
										<div class="upload_inst">	
										<p><span><?php echo $tracking_data[0]->pod;?></span></p>
										</div>
										<?php } ?>
									


													<div class="modal fade" id="tracking_number_<?php echo $tracking_data[0]->tracking_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myCenterModalLabel">TICKET TRACKING DETAILS</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form id="ticket_tracking_<?php echo $tracking_data[0]->tracking_id;?>" novalidate="novalidate" action="<?php echo base_url();?>/game/update_tracking_data" class="name" method="post">
                                	<input type="hidden" name="bg_id" value="<?php echo $orderData->bg_id;?>">
                                <div class="modal-body">
                                 <div class="signed_cnct">
                                     <?php 
                                    /* if ($tracking_data[0]->tracking_id != "")
                                     {*/
                                      ?>
								<div class="col-lg-12">
								<div class="form-group mt-3 mb-0">
								<label for="simpleinput">Delivery Provider</label>
								<input type="text" class="form-control reference" placeholder="Enter Delivery Provider" name="delivery_provider" value="<?php echo $tracking_data[0]->delivery_provider;?>">
								<input type="hidden" name="tracking_id" value="<?php echo $tracking_data[0]->tracking_id;?>">
								</div>
								</div>
								<div class="col-lg-12">
								<div class="form-group mt-3 mb-0">
								<label for="simpleinput">Tracking Link</label>
								<input type="text" class="form-control reference" name="tracking_link" placeholder="Enter Tracking Link" value="<?php echo $tracking_data[0]->tracking_link;?>">
								</div>
								</div>
								<div class="col-lg-12">
								<div class="form-group mt-3 mb-0">
								<label for="simpleinput">Tracking Number</label>
								<input type="text" class="form-control reference" name="tracking_number" placeholder="Tracking Number" value="<?php echo $tracking_data[0]->tracking_number;?>">
								</div>
								</div>
                                   <?php //} ?>
                                <div class="col-lg-12">
								<div class="form-group mt-3 mb-0">
								<label for="simpleinput">POD</label>
								<input type="file" class="form-control reference" name="pod_file" placeholder="Ticket #<?php echo $data->serial;?> QR" value="<?php echo $tracking_data[0]->tracking_number;?>">
								<input type="hidden" name="pod" value="<?php echo $tracking_data[0]->pod;?>">
								</div>
								</div>
								<div class="col-lg-12">
								<div class="form-group mt-3 mb-0">
									

									<?php if($tracking_data[0]->source_type == "tixstock") { ?>

                          				 <a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo $tracking_data[0]->pod;?>')"><?php echo $tracking_data[0]->pod;?></a>

                          				<?php } else if($tracking_data[0]->source_type == "1boxoffice") { ?>
                          				
                          				<a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/pod/'.$tracking_data[0]->pod;?>')"><?php echo $tracking_data[0]->pod;?></a>
                          				<?php } ?>


								</div>
								</div>
                                     <div class="signed_upload mt-3 mb-4">
                                       <div class="form-group mb-0">
                                          <div class="input-group">
                                            <div class="custom-file">
                                              <button type="submit" form-id="ticket_tracking_<?php echo $tracking_data[0]->tracking_id;?>" class="submit_qr custom-file-label" for="inputGroupFile04">Save</button>
                                            </div>
                                          </div>
                                       </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                          <div class="upload_inst">
                          				<ul>
													<li><div class="remove_ico" data-toggle="modal"
                           data-target="#tracking_number_<?php echo $tracking_data[0]->tracking_id; ?>"><i class="far fa-edit qr_edit" data-delete-id='<?php echo $tracking_data[0]->tracking_id; ?>' ></i></div></li>  

													<li><div class="remove_ico" onclick="copy_data('copy_tracking_number_<?php echo $tracking_data[0]->tracking_id; ?>',this)"><i style="color: #ffff;" class="far fa-copy qr_copy"></i></div></li> 
													<span style="display: none;" id="copy_tracking_number_<?php echo $tracking_data[0]->tracking_id; ?>"><?php echo $tracking_data[0]->tracking_number;?></span>


													</ul>
												</div>
													<?php //} ?>
									<?php } ?>
                                 </div>
									
									<!-- <div class="upload_inst">
										
										<?php 
										$tracking_data = 		$this->General_Model->getAllItemTable_Array('booking_ticket_tracking', array('booking_id' => $eticketDatas[0]->booking_id))->result();
										if($tracking_data[0]->pod != "") { 
											?>
											<h4>Ticket POD</h4>

										<p><span><?php echo $tracking_data[0]->pod;?></span></p>
										<ul>
										<?php if($tracking_data[0]->source_type == "tixstock") { ?>
                          				
                          				 <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo $tracking_data[0]->pod;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>
                          				<?php } else if($tracking_data[0]->source_type == "1boxoffice") { ?>
                          				
                          				  <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/pod/'.$tracking_data[0]->pod;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>
                          				<?php } ?>
										</ul>
										<?php } ?>
									</div> -->

									<div class="upload_inst">
										
										<?php if( !empty($orderData->instruction_file)) { ?>
											<h4>Uploaded Instructions</h4>
											<!-- <embed  class="d-block img-fluid embed_file" src="<?php //echo TICKET_UPLOAD_PATH."uploads/ticket_instruction/".$orderData->instruction_file;?>"  /> -->

										<p><span><?php echo $orderData->instruction_file; ?></span></p>
										<ul>
										<li><div class="remove_ico"><i class=" far fa-trash-alt delete_ticket_instruction" data-delete-id='<?php echo $orderData->booking_no; ?>' ></i></div></li>  
                          
                          				 <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/e_tickets/'.$orderData->instruction_file;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>
										</ul>
										<?php } ?>
									</div>
							 	</div>
						   </div>
						</div>
					 </div>

				  </div>
					  <?php if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 11) { ?>
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<div class="card card-body">
									<div class="col-md-12 col-lg-12">
										<h4>Customer Information</h4>
									</div>
									<div class="table-responsive">
										<table class="table table-hover table-nowrap mb-0">
											<thead class="thead-light">
												<tr>
												<th>Customer Name</th>
												<th>Billing Name</th>
												<th>Billing Email</th>
												<th>Billing Contact No</th>
												<th>Billing Address</th>
												</tr>
											</thead>
											<tbody>
										
												<tr>
												<td>									
							<!-- <a id="copy_name" target="_blank" href="<?php //echo base_url(); ?>game/orders/list_order/all?customer_id=<?php //echo base64_encode(json_encode($orderData->customer_id)); ?>"> -->
													
												<!-- </a> -->
											
												<span id="copy_name" ><?php echo $orderData->customer_first_name.' '.$orderData->customer_last_name; ?></span>
													<i class="far fa-copy" onclick="copy_data('copy_name',this)" ></i>
												</td>
												<td>
														<?php echo $orderData->title; ?> 	<?php echo $orderData->first_name; ?> 	<?php echo $orderData->last_name; ?>
														<span id="copy_billing_name" style="display:none;"><?php echo $orderData->title.' '.$orderData->first_name.' '.$orderData->last_name; ?></span>										
														<i class="far fa-copy" onclick="copy_data('copy_billing_name',this)"></i>									
													</td>
												<td>
														<span id="copy_billing_email" style="display:none;"><?php echo $orderData->customer_email; ?></span>	
														<div class="input-group widh">
											
											<input type="email" name="bill_email_address" class="form-control" id="bill_email_address" value="<?php echo $orderData->customer_email; ?>">
												<div class="input-group-append">
											<span class="input-group-text save_bill_email" >
											<i class="fa fa-edit" aria-hidden="true"></i>
											</span>
											<i class="far fa-copy" style="padding-top:10px;"onclick="copy_data('copy_billing_email',this)"></i>
												</div>
										</div>



												</td>
												<td>
														<?php echo $orderData->dialing_code; ?> 	<?php echo $orderData->mobile_no; ?>
														<span id="copy_billing_contact" style="display:none;"><?php echo $orderData->dialing_code.' '.$orderData->mobile_no; ?></span>
														<i class="far fa-copy" onclick="copy_data('copy_billing_contact',this)"></i>
												</td>
												<td>
														<?php echo $orderData->address; ?>,<?php echo $orderData->city_name; ?>,<?php echo $orderData->country_name; ?>, <?php echo $orderData->postal_code; ?>
														<span id="copy_billing_address" style="display:none;"><?php echo $orderData->address; ?>,<?php echo $orderData->city_name; ?>,<?php echo $orderData->country_name; ?>, <?php echo $orderData->postal_code; ?></span>										
													<i class="far fa-copy" onclick="copy_data('copy_billing_address',this)"></i>
												</td>
												</tr>
											</tbody>
										</table>
									</div>                  
									</div>
								</div>
							</div>
					  <?php } ?>

					  <?php if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 11) { ?>
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<div class="card card-body">
									<div class="col-md-12 col-lg-12">
										<h4>Payment Information</h4>
									</div>
									<div class="table-responsive">
										<table class="table table-hover table-nowrap mb-0">
											<thead class="thead-light">
												<tr>
												<th>Transaction ID</th>
												<th>Transaction Amount</th>
												<th>Transaction Status</th>
												<th>Transaction Date & Time</th>
												<th>Transaction IP</th>
												<th>Storefront</th>
												</tr>
											</thead>
											<tbody>
										
												<tr>
												<td><?php echo $orderData->transcation_id; ?></td>
												<td> 
													<?php
													if (strtoupper($orderData->currency_type) == "GBP") { ?>
															<!-- <i class="fas fa-pound-sign"></i> --> £
														<?php } ?>
														<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
															<!-- <i class="fas fa-euro-sign"></i> --> €
														<?php }
														if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
															echo strtoupper($orderData->currency_type);
														}
														?>
															<?php echo number_format($orderData->total_payment, 2);
															?>
												</td>
												<td>
													<?php
													if ($orderData->payment_status == 0) {
														echo "Failed";
													}
													if ($orderData->payment_status == 1) {
														echo "Success";
													}
													if ($orderData->payment_status == 2) {
														echo "Pending";
													}
													?>
												</td>
												<td>
													<?php
													echo date("d F Y H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->payment_date))) . ' ' . @$_COOKIE["time_zone"];
													?> 
												</td>
												<td><?php echo $orderData->ip_address; ?></td>
												<td><?php echo $orderData->store_name; ?></td>
												</tr>
											</tbody>
										</table>
									</div>                  
									</div>
								</div>
							</div>
					  <?php } ?>
					  <?php if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 11) { ?>
								  <div class="row">
									<div class="col-md-12 col-lg-12">
										<div class="card card-body">
										<div class="col-md-12 col-lg-12">
											<h4>More Information</h4>
										</div>
										<div class="table-responsive">
											<table class="table table-hover table-nowrap mb-0">
												<thead class="thead-light">
													<tr>
													<th>Ticket ID</th>
													<th>Seller Name</th>
													<th>Ticket Source</th>
													<th>Tournament</th>
													<th>Ticket Created Time</th>
													<th>Last Ticket Updated Time</th>
													<th>Ticket Deleted Time</th>
													</tr>
												</thead>
												<tbody>
											
													<tr>
													<td><?php echo $orderData->ticketid; ?></td>
													<td><?php echo $orderData->seller_first_name; ?>
																	<?php echo $orderData->seller_last_name; ?></td>
													<td>
														<?php
														echo $orderData->partner_company_name;
														// if ($orderData->booking_source == 1) {
														// 	echo "Web";
														// } else if ($orderData->booking_source == 2) {
														// 	echo "Api";
														// } else if ($orderData->booking_source == 3) {
														// 	echo "Affiliate";
														// }
														?>
													</td>
													<td><?php echo $orderData->tournament_name; ?></td>
													<td><?php echo date("d F Y H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->sell_date))) . ' ' . @$_COOKIE["time_zone"];
													?></td>
													<td>
														<?php
														if ($orderData->ticket_updated_date) {
															date("d F Y H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->ticket_updated_date))) . ' ' . @$_COOKIE["time_zone"];
														}
														?>
													</td>
													<td>
													<?php
													if ($orderData->ticket_deleted_date) {
														date("d F Y H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->ticket_deleted_date))) . ' ' . @$_COOKIE["time_zone"];
													}
													?>
													</td>
													</tr>
												</tbody>
											</table>
										</div>                  
										</div>
									</div>
								 </div>
						<?php } ?>
				  <div class="row">
					 <div class="col-md-12 col-lg-12">
						<div class="card card-body">
						   <div class="col-md-12 col-lg-12">
							  <h4>Delivery Information</h4>
						   </div>
						   <div class="table-responsive">
							  <table class="table table-hover table-nowrap mb-0">
								 <thead class="thead-light">
									<tr>
									   <th>Ticket Type</th>
									   <th>Delivery Fee</th>
									   <th>Delivery Status</th>
									   <th>Order Status</th>
									   <th>Share Contact No.</th>
									   <th>Email Send</th>
									   <th>Resend Email</th>
									   <th>Seller</th>
									</tr>
								 </thead>
								 <tbody>
								   
									<tr>
									   <td><?php echo $orderData->ticket_type_name; ?></td>
									   <td>
											<?php
											if (strtoupper($orderData->currency_type) == "GBP") { ?>
													<!-- <i class="fas fa-pound-sign"></i> -->
													£
												<?php } ?>
												<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
													<!-- <i class="fas fa-euro-sign"></i> -->
													€
												<?php }
												if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR") {
													echo strtoupper($orderData->currency_type);
												}
												?>
													<?php echo number_format($orderData->delivery_fee, 2);
													?>
											</td>
									   <td>

									   <select name="delivery_status" id="delivery_status_order" class="custom-select">
										  	<option value="0" <?php if ($orderData->delivery_status == 0 ) { ?> selected
											<?php } ?>>Tickets Not Uploaded</option>
											<option value="1" <?php if ($orderData->delivery_status == 1 ) { ?> selected
											<?php } ?>>Tickets In-Review</option>
											<option value="2" <?php if ($orderData->delivery_status == 2 ) { ?> selected
											<?php } ?>>Tickets Approved</option>
											<option value="3" <?php if ($orderData->delivery_status == 3 ) { ?> selected
											<?php } ?>>Tickets Rejected</option>
											<option value="4" <?php if ($orderData->delivery_status == 4 ) { ?> selected
											<?php } ?>>Tickets Downloaded</option>
											<option value="5" <?php if ($orderData->delivery_status == 5 ) { ?> selected
											<?php } ?>>Tickets Shipped</option>
											<option value="6" <?php if ($orderData->delivery_status == 6 ) { ?> selected
											<?php } ?>>Tickets Delivered</option>
									   	  </select>
											<?php
											
											/*if ($orderData->delivery_status == 0 || $orderData->delivery_status == '') { ?>
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
													<?php } ?> <?php if ($eticketDatas->ticket_upload_date)
														   echo date("d F Y H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $eticketDatas[$i - 1]->ticket_upload_date))) . ' ' . @$_COOKIE["time_zone"];*/

													   ?> 
									   </td>
									   <td>
										<?php
										if ($orderData->ticket_status == 1)
											echo "Approved Pending";
										else if ($orderData->ticket_status == 2)
											echo "Approved";
										else if ($orderData->ticket_status == 3)
											echo "Downloaded";
										else
											echo "Pending";

										?>
													<br>

										<?php
										if ($eticketDatas->ticket_approve_date)
											echo date("d F Y H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $eticketDatas[$i - 1]->ticket_approve_date))) . ' ' . @$_COOKIE["time_zone"];

										?>
										</td>
									   <td> 
										 <div class="input-group form-group widh">
											
											<input type="text" id="contact_number" class="form-control" placeholder="Contact Number" value="<?php echo $orderData->delivery_contact_number; ?>" data-num='<?php echo md5($orderData->bg_id); ?>'>
											<div class="input-group-prepend">
												<span class="input-group-text call_modal" id="" 
												data-toggle="modal" data-target="centermodal_mobile_icon"  data-title="Are you sure you want to save this Contact Number." data-sub-title="Yes or No" data-yes="Yes" data-no="No" data-btn-id="mobile-icon"
												>
												<i class="fas fa-mobile-alt "></i>
												</span>
											</div>
											</div>

									  </td>
									   <td>  <?php  echo $orderData->ticket_email_status == 1 ? "Sent" : "Pending"; ?></td>
									   
										<td>

									
											<div class="input-group">
											
											<input type="email" name="email_address" class="form-control" id="email_address" value="<?php echo $orderData->customer_email; ?>">
												<div class="input-group-append">
												<!-- id="emailIcon" 
											data-toggle="modal"                      data-target="#centermodal"
											-->
											<span class="input-group-text clickable call_modal" data-toggle="modal" data-target="centermodal"  data-title="Are you sure you want to send a email ?" data-sub-title="Email will go to the user if there is a status change !" data-yes="Yes, Send!" data-no="No, Cancel!" data-btn-id="emailIcon" >
											<i class="fa fa-envelope" aria-hidden="true"></i>
											</span>
												</div>
										</div>

									   </td>
									  
									   <td>
											  <?php echo $orderData->seller_first_name; ?>
											<?php echo $orderData->seller_last_name; ?>
									   </td>
									</tr>
								 </tbody>
							  </table>
						   </div>                  
						</div>
					 </div>
				  </div>
	
				 <caption></caption>
				 <div class="row">
					 <div class="col-md-12 col-lg-12">
						<div class="card card-body">
						   <div class="col-md-12 col-lg-12">
							  <h4>Attendees Details</h4>
						   </div>
												
						   <div class="clone-listing-table-div">
						   		<form method="post" class="validate_form_v3"  id="nomaini" action="<?php echo base_url('game/saveNominee');?>">
										<input type="hidden" name="ticket_id" value="<?php echo $orderData->bt_id;?>">
										<input type="hidden" name="booking_id" value="<?php echo $orderData->booking_id;?>">
										<input type="hidden" name="booking_no" value="<?php echo $orderData->booking_no;?>">
										<input type="hidden" name="serial" value="<?php echo $orderData->serial;?>">
										<input type="hidden" name="eticket_id" value="" id="eticket_id">
									<table class="table  table-borderless clone-listing-table_new count_check">
									<thead class="thead-light">   
										<tr>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
											<th>Nationality</th>
											<th>Date Of Birth</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
									<?php 
								//	foreach($nominees as $key => $nominee){
										$key=0;
														?>
													<tr id="clone-listing-table-tr" data-label="First Name:">
															<td> 
																<div class="form-group">
																	<input type="text" name="first_name[<?php echo $key; ?>]" value="<?php echo $nominee->first_name; ?>" required
																			id="first_name<?php echo $key; ?>" class="form-control first_name" placeholder="First Name" />
																</div>
															</td>
															<td data-label="Last Name:">
																<div class="form-group">
																	<input type="text" name="last_name[<?php echo $key; ?>]"
																		value="<?php echo $nominee->last_name; ?>" class="form-control" placeholder="Last Name"
																		id="last_name<?php echo $key; ?>">
																</div>
																</td>
															<td data-label="Email">
																<div class="form-group">
																	<input type="email"  name="email[<?php echo $key;?>]" value="<?php echo $nominee->email;?>" class="form-control" placeholder="Email" id="email<?php echo $key;?>" required>
																</div>
															</td>
															<td data-label="Nationality:">
																<div class="form-group">
																<input type="text"  class="form-control" placeholder="Nationality" name="nationality[<?php echo $key;?>]" value="<?php echo $nominee->nationality;?>" id="nationality<?php echo $key;?>">
																</div>
															</td>
															<td data-label="Date Of Birth:">
																<div class="form-group calenders">
																<!-- <input class="form-control" id="bulma-datepicker<?php //echo $key;?>" type="date" name="dob[<?php //echo $key;?>]" value="" > -->
																<input class="form-control attendee_date" id="MyTextbox2<?php echo $key;?>" type="text" name="dob[<?php echo $key;?>]" value="<?php echo $nominee->dob ? $nominee->dob : "";?>" readonly >
																<i class="bx bx-calendar-week"></i>
																</div>
															</td>
																<td>
																	<a href="javascript:void(0)" class="td_close btn" style="display: none;"><i class="fas fa-times"></i></a><a href="javascript:void(0)" class="btn clone-plus-btn fs-16" id="savenominee" ><i class="fas fa-plus"></i></a>

																	<a href="javascript:void(0)" class="btn clone-plus-btn fs-16" id="updateNominee" data-edit-id="" style="display:none"><i class="fas fa-plus" ></i></a>

																</td>
														</tr>

														<?php 
								foreach($nominees as $key => $nominee){
									$key=0;
									if($nominee->first_name!="")
									{
													?>
												<tr  class="nopadd" data-label="First Name:" id="nominee<?php echo $nominee->id; ?>">
														<td class=""> 
															
																<?php echo $nominee->first_name; ?>
															
														</td>
														<td> 
															
																<?php echo $nominee->last_name; ?>
															
														</td>
														<td> 
															
																<?php echo $nominee->email; ?>
															
														</td>
														<td> 
															
																<?php echo $nominee->nationality; ?>
															
														</td>
														<td> 
															
																<?php
																if($nominee->dob!="")
																{
																	$dateStr = $nominee->dob; 
																	$timestamp = strtotime($dateStr);
																	echo $updated_dob	 = date('d F Y', $timestamp);
																} ?>
															
														</td>
														<td>
														<i class="far fa-edit qr_edit editNominee" data-edit-id='<?php echo $nominee->id; ?>' ></i>

															<a href="javascript:void(0)" class="td_close btn remove_nominee" data-remove="<?php echo $nominee->id; ?>"><i class="fas fa-times"></i></a>
															<i class="far fa-copy copyNominee"   data-remove="<?php echo $nominee->id; ?>"></i>
															
														</td>
													</tr>

													
									
									<?php } }  ?>

														
										
										<?php //}  ?>
										
									</tbody>  
										
									</table>									
									
							  	</form>
						   </div>	
						   
						 <br/>
						   <div class="table-responsive remove_nominee_table">
						   <table class="table" id='read_attendee_details'>
								
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
		 </div>
 </div>
 <input type="hidden" id="source_type" name="source_type" value="<?php echo $orderData->source_type;?>">

 <div id="modal_content_ajax">
				<!-- Your modal content here -->
				</div>

<!-- main content End -->
<?php $this->load->view(THEME.'/common/footer'); ?>


<script>

$(document).ready(function() {

	$('.go_back_btn').click(function() {
            window.location.href =  $(this).data("click");	
        });

	$("#updateNominee").click(function (e) {
		// eticket_id
		var editId = $(this).data("edit-id");	
		$('#eticket_id').val(editId);
		e.preventDefault();
		var valid = true;
			$('.first_name').each(function() {
		if (!$(this).val()) {
			$(this).addClass('is-invalid');
			valid = false;
		} 
		else {
			$(this).removeClass('is-invalid');
		}
		});
		
		if (!valid) {
		return;
		}

		var formData = $('#nomaini').serialize();

		$.ajax({
			url: base_url + 'game/updateNominee',
			method: "POST",
			data: formData,
			dataType: 'json',
			success: function (result) {
			if (result.status==1) {
    
			$('#nominee' + result.nominee_details.id).remove();

				var ajaxResponse = '<tr class="nopadd" data-label="First Name:" id="nominee'+result.nominee_details.id+'">'
            + '<td class=""> '+result.nominee_details.first_name+' </td>'
			 + '<td class=""> '+result.nominee_details.last_name+' </td>'
			 + '<td class=""> '+result.nominee_details.email+' </td>'
			 + '<td class=""> '+result.nominee_details.nationality+' </td>'
			 + '<td class=""> '+result.nominee_details.dob+' </td>'
            + '<td>'
            + '<i class="far fa-edit qr_edit editNominee" data-edit-id="'+result.nominee_details.id+'"></i>'
            + '<a href="javascript:void(0)" class="td_close btn remove_nominee" data-remove="'+result.nominee_details.id+'"><i class="fas fa-times"></i></a>'
            + '<i class="far fa-copy copyNominee" data-remove="'+result.nominee_details.id+'"></i>'
            + '</td>'
            + '</tr>';
			$('.count_check tbody').append(ajaxResponse);
			

		
				swal('Updated !', result.msg, 'success');
			}
			else {
				swal('Updation Failed !', result.msg, 'error');
			}
			//setTimeout(function () { window.location.reload(); }, 2000);
			$('#first_name0').val("");
			$('#last_name0').val("");
			$('#email0').val("");
			$('#nationality0').val("");
			$( ".attendee_date" ).datepicker("setDate","");
			$("#savenominee").show();
			$("#updateNominee").hide();

			}
		});

		var nominees= '<?php echo count($nominees);?>';
		var rowCount = ($(".count_check tbody tr").length)-1;
		var source_type = $('#source_type').val();
		var serial = rowCount + 1;
		if((source_type == "tixstock") && (nominees == rowCount)){
			send_tixstock_nominee_update("<?php echo $orderData->bg_id;?>");
		}
		
	});

	

	$('.count_check').on('click', '.editNominee', function(e) {
	// $(".editNominee").click(function () {

		var dataRemoveValue = $(this).data("edit-id");		
        // $("#savenominee").attr("id", "updateNominee");
		 $("#updateNominee").data("edit-id", dataRemoveValue);
		 $("#savenominee").hide();
		 $("#updateNominee").show();
		// var updatedValue = $("#updateNominee").data("edit-id");
		// console.log(updatedValue);

    	var nomineeId = 'nominee' + dataRemoveValue;
    	var nomineeRow = $('#' + nomineeId);
    
		if (nomineeRow.length) {
			var formGroupElements = nomineeRow.find('td');
			var values = formGroupElements.toArray().map(function(element, index) {
			return $(element).text().trim();
			});
		
			if (values.length >= 5) {
			var [first_name, last_name, email, nationality, dob] = values;
			}
  		}	
		  	$('#first_name0').val(first_name);
			$('#last_name0').val(last_name ? last_name : "");
			$('#email0').val(email ? email : "");
			$('#nationality0').val(nationality ? nationality : "");
		
			var formattedDate="";
			if(dob!=""){
				var originalDateText = dob
				var originalDate = new Date(originalDateText);
				var formattedDate = ("0" + originalDate.getDate()).slice(-2) + "-" + ("0" + (originalDate.getMonth() + 1)).slice(-2) + "-" + originalDate.getFullYear();
			}

			$( ".attendee_date" ).datepicker("setDate",formattedDate);
		
	});

	$('.count_check').on('click', '.copyNominee', function(e) {
	//$(".copyNominee").click(function () {
		$(this).addClass('highlighted');		
		var dataRemoveValue = $(this).data('remove');
    	var nomineeId = 'nominee' + dataRemoveValue;
    	var nomineeRow = $('#' + nomineeId);
    
		if (nomineeRow.length) {
			var formGroupElements = nomineeRow.find('td');
			var values = formGroupElements.toArray().map(function(element, index) {
			return $(element).text().trim();
			});
		
			if (values.length >= 5) {
			var [first_name, last_name, email, nationality, dob] = values;
			}
  		}	
		var textarea = document.createElement("textarea");		
			var text = first_name;

			if (last_name) {
				text += "\n" + last_name;
			}
			
			if (email) {
				text += "\n" + email;
			}
			
			if (nationality) {
				text += "\n" + nationality;
			}
			
			if (dob) {
				text += "\n" + dob;
			}
  
  			textarea.value = text;  
	
		// Append the textarea element to the body
		document.body.appendChild(textarea);

		// Select the text in the textarea
		textarea.select();

		// Execute the copy command
		document.execCommand("Copy");

		// Remove the textarea element
		document.body.removeChild(textarea);
    });

  $("#copyButton").click(function () {
		$(this).addClass('highlighted');
		// Select the elements whose text you want to copy
		var copy_order = $("#copy_order").text();
		var copy_match_name = $("#copy_match_name").text();
		var copy_section = $("#copy_section").text();
		var copy_block = $("#copy_block").text();
		var copy_row = $("#copy_row").text();
		var block_row="Block:"+copy_block+" - "+copy_row;

		var copy_qty = $("#copy_qty").text();
		var qty="Qty:"+copy_qty.trim();

		var copy_name = $("#copy_name").text();
		var copy_email = $("#copy_billing_email").text();
		var copy_contact = $("#copy_billing_contact").text();

		var copy_notes = $("#hide_copy_notes").text().trim();
		var notes = copy_notes ? "\nSeller Notes: " + copy_notes : "";
	
		var textarea = document.createElement("textarea");
		textarea.value = copy_order + "\n" + copy_match_name+ "\n" + copy_section+ "\n" + block_row+ "\n" + qty+ notes+ "\n" + copy_name+ "\n" + copy_email+ "\n" + copy_contact;
	
		// Append the textarea element to the body
		document.body.appendChild(textarea);

		// Select the text in the textarea
		textarea.select();

		// Execute the copy command
		document.execCommand("Copy");

		// Remove the textarea element
		document.body.removeChild(textarea);
    });

	//const datepicker = document.getElementById('MyTextbox2');
	const datepicker = document.getElementsByClassName('attendee_date');
	$(datepicker).datepicker({
          dateFormat: 'dd-mm-yy' ,
           changeMonth: true,
    		changeYear: true,
    		yearRange: "-100:+0",
			maxDate:0

      }
      );


	$('#contact_number').keypress(function(event) {
    var keyCode = event.which;
    
    // Allow only numbers (0-9) or specific control keys (e.g., backspace, delete)
    if (keyCode < 48 || keyCode > 57) {
      event.preventDefault(); // Prevent the input of non-numeric characters
    }
  });

/*	$('#mobile-icon').click(function() {

				var contact_number = $('#contact_number').val(); // Get the value of the textbox
				if(contact_number=="")
				{	
					swal('Error!', "Contact Number Cannot be empty.", 'error');
					return false;
				}
				var ticket_id='<?php //echo md5($orderData->bg_id); ?>';
							swal({
						title: 'Are you sure you want to save this Contact Number.',
						text: "Yes or No",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#0CC27E',
						cancelButtonColor: '#FF586B',
						confirmButtonText: 'Yes',
						cancelButtonText: 'No',
						confirmButtonClass: 'button h-button is-primary btn btn-primary ',
						cancelButtonClass: 'button h-button is-danger btn btn-danger',
						buttonsStyling: false
					}).then(function (res) {


				if (res.value == true) {    
							$.ajax({
						url: '<?php echo base_url();?>game/save_delivery_information ',
						type: 'POST',
						dataType: "json",
						data: {  contact_number: contact_number ,ticket_id:ticket_id  },
						success: function (response) {               
							
							// 
								if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
								setTimeout(window.location.reload(),300);
						},
						error: function () {
						console.log('Failed');
						}
					});
				}   
			}, function (dismiss) {

			});
});*/

$("body").on('click','.save_bill_email',function(e){

var bill_email = $('#bill_email_address').val(); // Get the value of the textbox
if(bill_email=="")
{	
	swal('Error!', "Email Cannot be empty.", 'error');
	return false;
}
var ticket_id='<?php echo md5($orderData->bg_id); ?>';
var data_close_modal = $(this).attr('data-close-modal');

$.ajax({
		url: '<?php echo base_url();?>game/save_bill_email ',
		type: 'POST',
		dataType: "json",
		data: {  bill_email: bill_email ,ticket_id:ticket_id  },
		success: function (response) { 
				if(response.status==0)
				{
					swal('Updation Failed !', response.msg, 'error');
				}
				else
				{
					swal('Updated !', response.msg, 'success');
					$('#copy_billing_email').text(bill_email);
					$('#email_address').val(bill_email);
				}
				$('#'+data_close_modal).modal("hide");  
				//setTimeout(window.location.reload(),300);
		},
		error: function () {
		console.log('Failed');
		}
	});
});

		$("body").on('click','#mobile-icon',function(e){

				var contact_number = $('#contact_number').val(); // Get the value of the textbox
				if(contact_number=="")
				{	
					swal('Error!', "Contact Number Cannot be empty.", 'error');
					return false;
				}
				var ticket_id='<?php echo md5($orderData->bg_id); ?>';
				var data_close_modal = $(this).attr('data-close-modal');

				$.ajax({
						url: '<?php echo base_url();?>game/save_delivery_information ',
						type: 'POST',
						dataType: "json",
						data: {  contact_number: contact_number ,ticket_id:ticket_id  },
						success: function (response) { 
								if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
								$('#'+data_close_modal).modal("hide");  
								//setTimeout(window.location.reload(),300);
						},
						error: function () {
						console.log('Failed');
						}
					});
		});
$(".call_modals").change(function() {
		var data_sub_title = $(this).attr('data-sub-title');
		var data_yes = $(this).attr('data-yes');
		var data_no = $(this).attr('data-no');
		var data_btn = $(this).attr('data-btn-id');
		var data_target = $(this).attr('data-target');
		var data_bg_id = $(this).attr('data-bg-id');
		status=$(this).val();
		data_title="Are you sure want to Change Status";
		/*if (typeof data_bg_id !== "undefined") 
		{			
			var status = $("#status option:selected").val();
			if (status == 1) {
				data_title = "Are you sure want to Confirm this Booking ?";
			} else if (status == 0) {
				data_title = "Are you sure want to Confirm Failed ?";
			} else if (status == 2) {
				data_title = "Are you sure want to Confirm Pending ?";
			} else if (status == 3) {
				data_title = "Are you sure want to Confirm Cancelling ?";
			} else if (status == 4) {
				data_title = "Are you sure want to Confirm Shipping ?";
			} else if (status == 5) {
				data_title = "Are you sure want to Confirm Delivering ?";
			} else if (status == 6) {
				data_title = "Are you sure want to Confirm Downloading ?";
			} else if (status == 7) {
				data_title = "Are you sure want to Confirm Failed booking ?";
			}
		}*/

	$.ajax({
			url: '<?php echo base_url();?>game/call_modal',
			type: "POST",
			data: {  "data_title": data_title ,"data_sub_title":data_sub_title, "data_yes":data_yes,"data_no":data_no,"data_btn":data_btn,"data_target":data_target ,"data_bg_id":data_bg_id,"status":status},
			success: function (response) {  
				$("#modal_content_ajax").html(response); 
				 $('#'+data_target).modal("show");  
				//$("#").modal('show');
			},
			error: function () {
			}
		});

});
	$(".call_modal").click(function() {
		var data_title = $(this).attr('data-title');
		var data_sub_title = $(this).attr('data-sub-title');
		var data_yes = $(this).attr('data-yes');
		var data_no = $(this).attr('data-no');
		var data_btn = $(this).attr('data-btn-id');
		var data_target = $(this).attr('data-target');
		var data_bg_id = $(this).attr('data-bg-id');
		
	$.ajax({
			url: '<?php echo base_url();?>game/call_modal',
			type: "POST",
			data: {  "data_title": data_title ,"data_sub_title":data_sub_title, "data_yes":data_yes,"data_no":data_no,"data_btn":data_btn,"data_target":data_target ,"data_bg_id":data_bg_id},
			success: function (response) {  
				$("#modal_content_ajax").html(response); 
				 $('#'+data_target).modal("show");  
				//$("#").modal('show');
			},
			error: function () {
			}
		});

});

$("body").on('click',' #update_modal_booking_status ',function(e){

	var sendmail = $('#sendmail').is(":checked");
    var mail_enable = 0;
    if (sendmail == true) {
        mail_enable = 1;
    }

	var bg_id = $(this).attr('data-bg-id');
	var status = $(this).attr('data-status');
	var data_close_modal = $(this).attr('data-close-modal');

	$("#update_modal_booking_status").prop('disabled', true);
	$("#update_modal_booking_status").html("Please Wait..");

	var reason = "";
            if (status == 3) {
                reason = prompt("Please Enter the reason for Cancel ", "");
            }
            $.ajax({
                url: base_url + 'game/orders/update_booking_status',
                method: "POST",
                data: {
                    "bg_id": bg_id,
                    "status": status,
                    "mail_enable": mail_enable,
                    "reason": reason
                },
                dataType: 'json',
                success: function(result) {
                	$("#update_modal_booking_status").prop('disabled', false);
					$("#update_modal_booking_status").html("Yes, Change it!	");
                    if (result) {
                        swal('Updated !', result.msg, 'success');
                    } else {
                        swal('Updation Failed !', result.msg, 'error');
                    }					
					$('#'+data_close_modal).modal("hide");  
					setTimeout(window.location.reload(),1000);
                }
            });
});


$("body").on('click',' #emailIcon ,#emailIcon_need_to_receive',function(e){
    var Email = $('#email_address').val(); 
	var email_status= '<?php echo $orderData->ticket_email_status == 1 ? "Resend" : "Send"; ?>';
	var ticket_id='<?php echo md5($orderData->bg_id); ?>';
	var data_close_modal = $(this).attr('data-close-modal');
	$("#emailIcon").prop('disabled', true);
	$("#emailIcon").html("Please Wait..");
	if(Email==""){	
		swal('Error!', "Emai ID Cannot be empty.", 'error');
		return false;
	}				   
		$.ajax({
			url: '<?php echo base_url();?>game/send_email',
			type: 'POST',
			dataType: "json",
			data: {  email: Email ,ticket_id:ticket_id  },
			success: function (response) { 

				$("#emailIcon").prop('disabled', false);
				$("#emailIcon").html("Yes, Send!");
				if(response.status==0)
				{
					swal('Updation Failed !', response.msg, 'error');
				}
				else
				{
					swal('Updated !', response.msg, 'success');
				}
				$('#'+data_close_modal).modal("hide");  
			},
			error: function () {
			console.log('Failed');
			}
		});
	});
/*$("body").on('click',' #emailIcon_need_to_receive',function(e){
    var Email = $('#email_address').val(); // Get the value of the textbox
	var email_status= '<?php //echo $orderData->ticket_email_status == 1 ? "Resend" : "Send"; ?>';
	var ticket_id='<?php //echo md5($orderData->bg_id); ?>';
	if(Email=="")
				{	
					swal('Error!', "Emai ID Cannot be empty.", 'error');
					return false;
				}
					swal({
						title: 'Are you sure you want to '+email_status+' a email ?',
						text: "Send or Cancel",
						// type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#43D39E',
						cancelButtonColor: '#FF5C75',
						confirmButtonText: 'Yes, Send!',
		   				cancelButtonText: 'No, Cancel!',
						confirmButtonClass: 'button h-button is-primary btn btn-primary ',
						// cancelButtonClass: 'button h-button is-danger btn btn-danger',
						cancelButtonClass: 'btn-light btn',
						buttonsStyling: false,
						showCloseButton: true,
						reverseButtons: true
					}).then(function (res) {


				if (res.value == true) {    
							$.ajax({
						url: '<?php //echo base_url();?>game/send_email',
						type: 'POST',
						dataType: "json",
						data: {  email: Email ,ticket_id:ticket_id  },
						success: function (response) {               
							
							// 
								if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
								setTimeout(window.location.reload(),300);
						},
						error: function () {
						console.log('Failed');
						}
					});
				}   
			}, function (dismiss) {

			});
			});*/

  $(".owl-prev").html('<i class="fas fa-arrow-left"></i>');
  $( ".owl-next").html('<i class=" fas fa-arrow-right"></i>');

  $(".delete_ticket").click(function () {
var data_id = $(this).attr('data-delete-id');
   swal({
			title: 'Are you sure you want to delete this ticket?',
		    text: "Yes or No",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#0CC27E',
		    cancelButtonColor: '#FF586B',
		    confirmButtonText: 'Yes',
		    cancelButtonText: 'No',
		    confirmButtonClass: 'button h-button is-primary btn btn-primary ',
            cancelButtonClass: 'button h-button is-danger btn btn-danger',
		    buttonsStyling: false
		  }).then(function (res) {


    if (res.value == true) {    
		$.ajax({
         url: '<?php echo base_url();?>game/delete_upload_single_ticket',
         type: 'POST',
         dataType: "json",
         data: {  ticket_id: data_id   },
         success: function (response) {               
               swal('Updated !', response.msg, 'success');
               setTimeout(window.location.reload(),300);
         },
         error: function () {
         console.log('Failed');
         }
      });
    }   
  }, function (dismiss) {

  });
   });



   $(".delete_ticket_instruction").click(function () {
var data_id = $(this).attr('data-delete-id');
   swal({
			title: 'Are you sure you want to delete this Uploaded Instructions?',
		    text: "Yes or No",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#0CC27E',
		    cancelButtonColor: '#FF586B',
		    confirmButtonText: 'Yes',
		    cancelButtonText: 'No',
		    confirmButtonClass: 'button h-button is-primary btn btn-primary ',
            cancelButtonClass: 'button h-button is-danger btn btn-danger',
		    buttonsStyling: false
		  }).then(function (res) {


    if (res.value == true) {    
		$.ajax({
         url: '<?php echo base_url();?>game/delete_uploaded_instructions',
         type: 'POST',
         dataType: "json",
         data: {  ticket_id: data_id   },
         success: function (response) {               
               swal('Updated !', response.msg, 'success');
               setTimeout(window.location.reload(),300);
         },
         error: function () {
         console.log('Failed');
         }
      });
    }   
  }, function (dismiss) {

  });
   });

});
//$(document).ready(function() {
//$( ".owl-prev").html('<i class="fas fa-arrow-left"></i>');
 //$( ".owl-next").html('<i class=" fas fa-arrow-right"></i>');

 $("#TopAirLine_new").owlCarousel({
 
 autoPlay: 500, //Set AutoPlay to 3 seconds

 items : 2,
 itemsDesktop : [1199,2],
 itemsDesktopSmall : [979,2],
 nav:true,
 pagination:false,
 dots: false
});
//});

	function copy_data(id, element){
		element.classList.add('highlighted');
		var copyText = document.getElementById(id);
		var textArea = document.createElement("textarea");
		textArea.value = ((copyText.textContent).trim());
		document.body.appendChild(textArea);
		textArea.select();
		document.execCommand("Copy");
		textArea.remove();
		//alert("Copied Successfully.");

	}
	
		function resend_email(id,status,ticket_type){

		 swal({
		    title: 'Are you sure you want to resend a email ?',
		    text: "Send or Cancel",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#0CC27E',
		    cancelButtonColor: '#FF586B',
		    confirmButtonText: 'Yes, Send!',
		    cancelButtonText: 'No, cancel!',
			confirmButtonClass: 'button h-button is-primary btn btn-primary ',
   cancelButtonClass: 'button h-button is-danger btn btn-danger',
		    buttonsStyling: false
		  }).then(function (res) {


    if (res.value == true) {
       var email = $("#email_address").val();
      $.ajax({
		url: '<?php echo base_url();?>game/send_email',
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

$('#seller_order_status').on('click',function (e){
	e.preventDefault();
		var bg_id = "<?php echo $orderData->bg_id; ?>";
		var seller_status = $("#seller_status option:selected").val();

		$.ajax({
			url: base_url + 'game/orders/update_seller_status',
			method: "POST",
			data: { "bg_id": bg_id, "seller_status": seller_status },
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


	});


	//$('.ticket-instruction').on('change', function() {
	$('.ticket-instruction').on('change', function() {
    var file_data = $('.ticket-instruction').prop('files')[0];
    var allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
    if (allowed_types.indexOf(file_data.type) === -1) {
      alert('File type not allowed. Please select a PDF, JPEG, or PNG file.');
      return;
    }
	// const inpt_fileInput = inpt_dropZoneId.querySelector('.etickets');

    //   var id = inpt_fileInput.getAttribute('id');
	
	var booking_id = $(this).attr('data-id');
	//var booking_id_param= booking_id.replace("1BX", "");   
	//var booking_id = inpt_fileInput.getAttribute('id');

    var form_data = new FormData();
    form_data.append('file', file_data);
	form_data.append('booking_id', booking_id);

    $.ajax({
	  url: '<?php echo base_url();?>game/save_ticket_instruction',
      type: 'POST',
	  async: false,
	  cache: false,
	  contentType: false,
	  enctype: 'multipart/form-data',
	  dataType: "json",           
      data: form_data,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
        console.log(response);
		swal('Updated !', response.msg, 'success');
                      setTimeout(window.location.reload(),200);
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  });
  
  $('.count_check').on('click', '.remove_nominee', function(e) {
  //$('.remove_nominee').on('click',function (e){
	var nomineeId = $(this).attr('data-remove');
	swal({
						title: 'Are you sure you want to delete this Attendee.',
						text: "Yes or No",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#0CC27E',
						cancelButtonColor: '#FF586B',
						confirmButtonText: 'Yes',
						cancelButtonText: 'No',
						confirmButtonClass: 'button h-button is-primary btn btn-primary ',
						cancelButtonClass: 'button h-button is-danger btn btn-danger',
						buttonsStyling: false
					}).then(function (res) {


				if (res.value == true) {              		
							$.ajax({
						url: '<?php echo base_url();?>game/delete_attendee',
						type: 'POST',
						dataType: "json",
						data: {  id: nomineeId   },
						success: function (response) {               
							
							// 
								if(response.status==0)
								{
								
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									$('#nominee' + nomineeId).remove(); // Remove the corresponding <tr>
									$('#first_name0').val("");
									$('#last_name0').val("");
									$('#email0').val("");
									$('#nationality0').val("");
									$( ".attendee_date" ).datepicker("setDate","");
									$("#savenominee").show();
									$("#updateNominee").hide();
									swal('Updated !', response.msg, 'success');
								}
							
						},
						error: function () {
						console.log('Failed');
						}
					});
				}   
			}, function (dismiss) {

			});


  });
  $('#add_nomine').on('click',function (e){
	// var nominees= '<?php echo count($nominees);?>';
	// var rowCount = $("#read_attendee_details tbody tr").length;
	// if(nominees<=rowCount)
	// {
	// 	swal('Updated !', "You have exceed the limit", 'error');
	// 	return false;		
	// }
  });

  $('.on_hold_submit').click(function () {

var on_hold = $('#on_hold').val(); 
var order_id = '<?php echo $eticketDatas[0]->booking_id; ?>';
if (on_hold == "") {
   swal('Error!', "Hold Price Cannot be empty.", 'error');
   return false;
}

      $.ajax({
         url: '<?php echo base_url();?>game/hold_price',
         type: 'POST',
         dataType: "json",
         data: { on_hold: on_hold, order_id: order_id },
         success: function (response) {
            // 
            if (response.status == 0) {
               swal('Updation Failed !', response.msg, 'error');
            }
            else {
               swal('Updated !', response.msg, 'success');
               $('.close').trigger('click');
            }
            //setTimeout(window.location.reload(),300);
         },
         error: function () {
            console.log('Failed');
         }
      });
});  
  
	$('#savenominee').on('click',function (e){
		var nominees= '<?php echo count($nominees);?>';

		//var rowCount = $("#read_attendee_details tbody tr").length;
		var rowCount = ($(".count_check tbody tr").length)-1;
		
		var serial = rowCount + 1;
		if(nominees<=rowCount)
		{ 
			var quantity = '<?php echo $orderData->quantity; ?>';
			swal('Updated !', "Only "+quantity+" Attendees able to add.", 'error');
		return false;		
		}
		else
		{ 

		e.preventDefault();
		var valid = true;
			$('.first_name').each(function() {
		if (!$(this).val()) {
			$(this).addClass('is-invalid');
			valid = false;
		} 
		else {
			$(this).removeClass('is-invalid');
		}
		});
		
		if (!valid) {
		return;
		}

		var formData = $('#nomaini').serialize();
		
		$.ajax({
			url: base_url + 'game/saveNominee',
			method: "POST",
			data: formData,
			dataType: 'json',
			success: function (result) {
				//console.log(result);
			if (result.status==1) {
				var ajaxResponse = '<tr class="nopadd" data-label="First Name:" id="nominee'+result.nominee_details.id+'">'
            + '<td class=""> '+result.nominee_details.first_name+' </td>'
			 + '<td class=""> '+result.nominee_details.last_name+' </td>'
			 + '<td class=""> '+result.nominee_details.email+' </td>'
			 + '<td class=""> '+result.nominee_details.nationality+' </td>'
			 + '<td class=""> '+result.nominee_details.dob+' </td>'
            + '<td>'
            + '<i class="far fa-edit qr_edit editNominee" data-edit-id="'+result.nominee_details.id+'"></i>'
            + '<a href="javascript:void(0)" class="td_close btn remove_nominee" data-remove="'+result.nominee_details.id+'"><i class="fas fa-times"></i></a>'
            + '<i class="far fa-copy copyNominee" data-remove="'+result.nominee_details.id+'"></i>'
            + '</td>'
            + '</tr>';
			$('.count_check tbody').append(ajaxResponse);

			$('#first_name0').val("");
			$('#last_name0').val("");
			$('#email0').val("");
			$('#nationality0').val("");
			$( ".attendee_date" ).datepicker("setDate","");
			$("#savenominee").show();
			$("#updateNominee").hide();

				swal('Updated !', result.msg, 'success');
				
			}
			else {
				swal('Updation Failed !', result.msg, 'error');
			}
		//	setTimeout(function () { window.location.reload(); }, 2000);
			}
		});
		
	}

		var nominees= '<?php echo count($nominees);?>';
		var rowCount = ($(".count_check tbody tr").length);
		var source_type = $('#source_type').val();
		var serial = rowCount + 1;
		if((source_type == "tixstock") && (nominees == rowCount)){ 
			send_tixstock_nominee_update("<?php echo $orderData->bg_id;?>");
		}


	});

	function send_tixstock_nominee_update(bg_id){
		
		$.ajax({
			url: base_url + 'game/update_tixstock_nominee',
			method: "POST",
			data: {"bg_id" : bg_id},
			dataType: 'json',
			success: function (result) {
				if (result.status==1) {
				//swal('Success !', result.msg, 'success');
				}
				else{
				swal('Updation Failed !', result.msg, 'error');	
				}
			}
		});
	}

	function upload_ticket(id)
	{
		
		var url='<?php echo base_url()."/game/orders/upload_e_ticket/";?>'+id; 
			window.open(url,"_self");
	}

	function popitup(url,temp='')
   {
      if(temp!="")
            var url='<?php echo base_url()."/uploads/e_tickets/temp/";?>'+url; 

      newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

      if (window.focus) {newwindow.focus()}
      return false;
   }
	</script>
