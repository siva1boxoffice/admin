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
									<h2>Abondanned Cart List</h2>
									<div class="list_button order_inf">
							<a href="<?php echo base_url();?>game/orders/abandoned/upcoming" class="user_buts <?php if($this->uri->segment(4) == 'upcoming'){?> active <?php } ?>">Upcoming</a>
							<a href="<?php echo base_url();?>game/orders/abandoned/past" class="user_buts <?php if($this->uri->segment(4) == 'past'){?> active <?php } ?>">Expired</a>

							</div>
								</div>
								<div class="tab_sec orders list_odd" id="no-more-tables">
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Order</th>
												<th>Event</th>
												<th>Customer Name</th>
												<th>Country</th>
												<!-- <th>Ticket Type</th> -->
												<th>Qty</th>
												<th>Price</th>
												<th>Transaction Date</th>
												<th>Status</th>
												<th>&nbsp;</th>
											</tr>
											<?php
//echo "<pre>";print_r($getMySalesData);exit;
											 if ($getMySalesData) {
												foreach ($getMySalesData as $getMySalesDa) {
											?>
													<tr>
														<td data-label="Order:"><span class="order"><?php echo $getMySalesDa->booking_no; ?></span></td>
														<td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
															<p><?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?></p><br>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
														</td>
														<td data-label="Customer Name:">
															<?php echo $getMySalesDa->title; ?>.<?php echo $getMySalesDa->first_name; ?> <?php echo $getMySalesDa->last_name; ?>
														</td>
														<!-- <td data-label="Ticket Format:">
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
														</td> -->
														<!-- <td data-label="Tickets Type:">
															<?php echo $getMySalesDa->seat_category;
															?>
														</td> -->
														<td data-label="Tickets Type:">
															<?php echo $getMySalesDa->customer_country_name;
															?>
														</td>
														<td data-label="Tickets Qty:">
															<?php echo $getMySalesDa->quantity;
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
															<?= $getMySalesDa->total_amount ?>
																 </b></td>
														<td data-label="Transaction date:"><span class="tr_date">

															<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$getMySalesDa->updated_at))).' '.@$_COOKIE["time_zone"];?>
															
															</span> </td>
														<td data-label="Status:">
															ABONDANNED

														</td>
														<td data-label="Total:"><a href="<?php echo base_url(); ?>game/orders/abondaned_details/<?php echo md5($getMySalesDa->booking_no); ?>"><i class="fas fa-angle-double-right"></i></a></td>
													</tr>
											<?php
												}
											}
											?>

										</tbody>
									</table>

								</div>
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
<?php $this->load->view('common/footer'); ?>
<?php exit; ?>
