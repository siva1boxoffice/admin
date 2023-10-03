<?php $this->load->view('common/header'); ?>

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
									<h2>Payment History</h2>
									
								</div>
								<div class="tab_sec orders list_odd" id="no-more-tables">
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Order</th>
												<th>Payment Type</th>
												<th>Customer Email</th>
												<th>Transaction Id</th>
												<th>Total Payment</th>
												<th>Transaction Date</th>
												<th>Payment Status</th>
												<th>&nbsp;</th>
											</tr>
											<?php if ($getMySalesData) {
												foreach ($getMySalesData as $getMySalesDa) {
											?>
													<tr>
														<td data-label="Order:"><span class="order"><?php echo $getMySalesDa->booking_no; ?></span></td>
														<!-- <td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
															<?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?><br>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
														</td> -->
														<td data-label="Ticket Format:">
															<?php
															if ($getMySalesDa->payment_type == 1) {
																echo 'CREDIT/DEBIT CARD';
															} else if ($getMySalesDa->payment_type == 2) {
																echo "OFFLINE";
															}  ?>
														</td>
														<td data-label="Customer Email:">
															<?php echo $getMySalesDa->email;
															?>
														</td>
														<td data-label="Tickets Type:">
															<?php echo $getMySalesDa->transcation_id;
															?>
														</td>
														
														<td data-label="Price:"><b>
																 <?php //echo strtoupper($getMySalesDa->currency_type) ?> 
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
												<?= $getMySalesDa->total_payment ?>
															</b></td>
														<td data-label="Transaction date:"><span class="tr_date">
																<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$getMySalesDa->payment_date))).' '.@$_COOKIE["time_zone"];?>


															</span> </td>
														<td data-label="Status:">
															<?php
															if ($getMySalesDa->payment_status == 0) {
																echo "FAILED";
															}
															if ($getMySalesDa->payment_status == 1) {
																echo "SUCCESS";
															}
															if ($getMySalesDa->payment_status == 2) {
																echo "PENDING";
															}
															?>

														</td>
														<td data-label="Total:"><a href="<?php echo base_url(); ?>game/orders/payment_details/<?php echo md5($getMySalesDa->booking_no); ?>"><i class="fas fa-angle-double-right"></i></a></td>
													</tr>
											<?php
												}
											}else{?>
												<tr><td colspan="7">No Payment History.</td></tr>
											<?php }
											?>

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
<?php $this->load->view('common/footer'); ?>
<?php exit; ?>
