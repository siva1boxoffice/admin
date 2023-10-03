<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				<div class="flex-list-wrapper">
					<div class="flex-table-item">
						<div class="">
							<div class="container">
								 <?php  if ($this->session->userdata('role') == 6) { ?>
								<div class="tab_head">
									<h2>Order List</h2>
									<div class="list_button">
										<!-- <a href="<?php echo base_url(); ?>game/orders/add_order" class="button h-button is-primary is-elevated"><i aria-hidden="true" class="fas fa-plus"></i>
											Add New Order
										</a> -->
									</div>
								</div>
							<?php } ?>
								<div class="tab_sec orders" id="no-more-tables">
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Order</th>
												<th>Event</th>
												<th>Ticket Format</th>
												<th>Ticket Type</th>
												<th>Qty</th>
												<th>Price</th>
												<th>Transaction Date</th>
												<th>Status</th>
												<th>&nbsp;</th>
											</tr>
											<?php if ($getMySalesData) {
												foreach ($getMySalesData as $getMySalesDa) {
											?>
													<tr>
														<td data-label="Order:"><span class="order"><?php echo $getMySalesDa->booking_no; ?></span></td>
														<td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
															<p><?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?></p>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
														</td>
														<td data-label="Ticket Format:">
															<?php
															if ($getMySalesDa->ticket_type == 1) {
																echo 'Season cards';
															} else
													if ($getMySalesDa->ticket_type == 2) {
																echo "E-Tickets";
															} else
													if ($getMySalesDa->ticket_type == 3) {
																echo "Paper";
															} else	if ($getMySalesDa->ticket_type == 4) {
																echo "Mobile";
															} ?>
														</td>
														<td data-label="Tickets Type:">
															<?php echo $getMySalesDa->seat_category;
															?>
														</td>
														<td data-label="Tickets Qty:">
															<?php echo $getMySalesDa->quantity;
															?>
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
												<?= $getMySalesDa->total_amount ?> 
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
												<?= $getMySalesDa->ticket_amount ?> 
												 </b></td>
												 <?php }?>
														<td data-label="Transaction date:"><span class="tr_date">
																<?php
																echo  $getMySalesDa->updated_at;
																?>
															</span> </td>
														<td data-label="Status:">
															<?php
															if ($getMySalesDa->booking_status == 0) {
																echo "FAILED";
															}
															if ($getMySalesDa->booking_status == 1) {
																echo "CONFIRMED";
															}
															if ($getMySalesDa->booking_status == 2) {
																echo "PENDING";
															}
															if ($getMySalesDa->booking_status == 3) {
																echo "CANCELLED";
															}
															if ($getMySalesDa->booking_status == 4) {
																echo "SHIPPED";
															}
															if ($getMySalesDa->booking_status == 5) {
																echo "DELIVERED";
															}
															if ($getMySalesDa->booking_status == 6) {
																echo "DOWNLOADED";
															}
															?>

														</td>
														<td data-label="Total:"><a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($getMySalesDa->booking_no); ?>"><i class="fas fa-angle-double-right"></i></a></td>
													</tr>
											<?php
												}
											}else{ ?>
												<tr><td colspan="9">No Order list.</td></tr>
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
