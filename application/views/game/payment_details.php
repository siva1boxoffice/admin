<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/app.css?v=1.4" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/main.css?v=1.4" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/style.css?v=1.4" />
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

	<div id="huro-app" class="app-wrapper">
		<!-- Content Wrapper -->
		<div id="app-projects" class="view-wrapper" data-naver-offset="214" data-menu-item="#layouts-sidebar-menu" data-mobile-item="#home-sidebar-menu-mobile">
			<div class="page-content-wrapper">
				<div class="page-content is-relative">
					<div class=" onebox-order-info">
						<div class="container_new">
							<div class="row">
								<div class="sub_heading">
									<div class="onebox-order-heading">
										<h2>Payment <span>Info</span></h2>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="table_section" id="no-more-tables">
									
									<table>
										<tbody>
											<tr class="accordion">
											<th>Order ID</th>
														<th>Confirmation Id</th>
														<th>Order Status</th>
														<th>Order Date and Time</th>
											</tr>
											<tr>
														<td data-label="Order:">
															<span class="order_id"><a target="_blank" href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($orderData->booking_no); ?>">#<?php echo $orderData->booking_no; ?></a></span>
														</td>
														<td data-label="Order:">
															<span class="order_id">#<?php echo $orderData->booking_confirmation_no; ?></a></span>
														</td>
														<?php 
														if ($orderData->booking_status == 7) { ?>
															<td data-label="Order:">
																<span class="">
													Payment Not Initiated
																</span>
															</td>
														<?php  } 
														if ($orderData->booking_status == 1) { ?>
															<td data-label="Order:">
																<span class="">CONFIRMED</span>
															</td>
														<?php  } ?>
														<?php if ($orderData->booking_status == 0) { ?>
															<td data-label="Order:">
																<span class="">FAILED</span>
															</td>
														<?php  } ?>
														<?php if ($orderData->booking_status == 2) { ?>
															<td data-label="Order:">
																<span class="">PENDING</span>
															</td>
														<?php  } ?>
														<?php if ($orderData->booking_status == 3) { ?>
															<td data-label="Order:">
																<span class="">CANCELLED</span>
															</td>
														<?php  } ?>
														<?php if ($orderData->booking_status == 4) { ?>
															<td data-label="Order:">
																<span class="">SHIPPED</span>
															</td>
														<?php  } ?>
														<?php if ($orderData->booking_status == 5) { ?>
															<td data-label="Order:">
																<span class="">DELIVERED</span>
															</td>
														<?php  } ?>
														<?php if ($orderData->booking_status == 6) { ?>
															<td data-label="Order:">
																<span class="">DOWNLOADED</span>
															</td>
														<?php  } ?>

														<td data-label="Transaction date:">
															<span class="tr_date">
																<i class="fas fa-calendar"></i><?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->payment_date))).' '.@$_COOKIE["time_zone"];?> </span>
															<!-- <span class="tr_date">
																<i class="fas fa-clock"></i><?php echo $tme; ?> </span> -->
														</td>
														
														
													</tr>
										</tbody>
									</table>
								</div>

							</div>
							
							<div class="account-wrapper">
								<div class="columns">
									
									<div class="column is-12">
										<h3>Payment Information</h3>
										<div class="tick_info">
											<table>
											<table>
													<tbody>
														<tr>
															<td>Customer Name</td>
															<td>
																<a target="_blank" href="<?php echo base_url();?>settings/customers/add_customer/<?php echo base64_encode(json_encode($orderData->user_id)) ; ?>">
																<?php echo $orderData->customer_first_name ; ?> <?php echo $orderData->customer_last_name ; ?>
															</a>
															</td>
														</tr>
														<tr>
															<td>Billing Name</td>
															<td><?php echo $orderData->title ; ?> <?php echo $orderData->first_name ; ?> <?php echo $orderData->last_name ; ?></td>
														</tr>
														<tr>
															<td>Billing Contact</td>
															<td><?php echo $orderData->dialing_code ; ?> <?php echo $orderData->mobile_no ; ?> / <?php echo $orderData->email ; ?></td>
														</tr>
														<tr>
															<td>Billing Address</td>
															<td><?php echo $orderData->address ; ?>,<?php echo $orderData->city_name ; ?>,<?php echo $orderData->country_name ; ?>, <?php echo $orderData->postal_code ; ?></td>
														</tr>
														<tr>
															<td>Payment Status</td>
															<td>
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
														</tr>
														<tr>
															<td>Transaction Id</td>
															<td><?php echo $orderData->transcation_id ; ?></td>
														</tr>
														<tr>
															<td>Transaction Amount</td>
															<td>
																<?php if (strtoupper($orderData->currency_type) == "GBP") { ?>
															<i class="fas fa-pound-sign"></i>
															<?php } ?>
												<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
															<i class="fas fa-euro-sign"></i>
												<?php } 
													if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
												 echo strtoupper($orderData->currency_type); 
												}
												?><?php echo $orderData->total_payment//.' '.$orderData->currency_type; ?>
																
															</td>
														</tr>
														<tr>
															<td>Payment Date & Time</td>
															<td>
															<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->payment_date))).' '.@$_COOKIE["time_zone"];?> </td>
														</tr>
														<tr>
															<td>Paymented IP</td>
															<td><?php echo $orderData->ip_address ; ?></td>
														</tr>
														<tr>
															<td>Response Logs</td>
															<td>

															<div class="mb-3">
															<label for="exampleFormControlTextarea1" class="form-label">Response</label>
															<textarea class="form-control" style="height:130px;" id="exampleFormControlTextarea1" rows="13"><?php echo $orderData->payment_response ; ?></textarea>
</div>
															</td>
														</tr>
														<tr>
															<td>Booking Logs</td>
															<td>

															<div class="mb-3">
															<a target="_blank" href="https://1boxoffice.com/storage/booking_logs/<?php echo $orderData->booking_no ; ?>/<?php echo $orderData->booking_no; ?>.txt">View Booking Logs</a>
</div>
															</td>
														</tr>
														
													</tbody>
												</table>
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
<?php $this->load->view('common/footer');
?>
<?php exit; ?>
