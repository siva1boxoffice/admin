<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

			          
				


			<div class="page-content-inner">

				<div class="dashboard-title is-main ">
                            <div class="left">

                            <div class="tabs approve_req">
                                <ul>
                                    <li <?php if(($status_flag == "pending" && $status_flag != "approve_reject" )){ ?> class="is-active" <?php } ?>><a href="<?php echo base_url();?>tickets/index/approve_reject/pending"><span>Pending</span></a></li>
                                    <li <?php if($status_flag == "approve_reject"){ ?> class="is-active" <?php } ?>><a href="<?php echo base_url();?>tickets/index/approve_reject/approve_reject"><span>Appr./Rej</span></a></li>

                                    <li class="tab-naver"></li>
                                </ul>
                            </div>
                        </div>
                            <div class="right">
                                 
                            </div>
                        </div>



				<div class="flex-list-wrapper">

					<div class="flex-table-item">
						<div class="">
							<div class="container_new">
								<div class="tab_head">
									<h2>Ticket Approval Request</h2>
								</div>
								<div class="tab_sec orders" id="no-more-tables">
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Order</th>
												<th>Event</th>
												<th>Ticket Format</th>
												<th>Qty</th>
												<th>Ticket file</th>
												<th>Seller Name</th>
												<!-- <th>Request Date</th> -->
												<?php //if($this->session->userdata('role') == 1){ ?>
												<!-- <th>Reject Reason</th> -->
												<?php //}
												?>
												<th>Ticket Status</th>
												 <?php  if ($this->session->userdata('role') != 1) { ?>
												<th style="width: 250px;">Approve/Reject</th>
											<?php } ?>
												<th>&nbsp;</th>
											</tr>
											<?php if ($approve_request) {
												foreach ($approve_request as $getMySalesDa) {
											?>
													<tr>
														<td data-label="Order:"><span class="order"><?php echo $getMySalesDa->booking_no; ?></span></td>
														<td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
															<p><?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?></p>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
														</td>
														<td data-label="Tickets Type:">
															<?php echo $getMySalesDa->seat_category;
															?>
														</td>
														<td data-label="Tickets Qty:">
															<?php echo $getMySalesDa->quantity;
															?>
														</td>
														<td data-label="Tickets Qty:">
															<a target="_blank" href="<?php echo UPLOAD_PATH; ?>uploads/e_tickets/<?php echo $getMySalesDa->ticket_file; ?>">Ticket <?php echo $getMySalesDa->serial; ?></a>
														</td>
														<td data-label="Seller Name:">
																<?php
																echo  $getMySalesDa->admin_name;
																?>
																<?php
																echo  $getMySalesDa->admin_last_name;
																?>
														</td>
												<!-- 		<td data-label="Transaction date:"><span class="tr_date">
																<?php
																echo  $getMySalesDa->ticket_upload_date;
																?>
															</span> </td> -->
														<?php //if($this->session->userdata('role') == 1){ ?>
											<!-- 			<td data-label="Transaction date:"><span class="tr_date"><?php echo $getMySalesDa->reject_reason;?></span> </td> -->
														<?php //} ?>
														<td data-label="Status:">
															<?php
															if ($getMySalesDa->ticket_status == 1) {
																echo "UPLOADED";
															}
															if ($getMySalesDa->ticket_status == 2) {
																echo "APPROVED";
															}
															if ($getMySalesDa->ticket_status == 6) {
																echo "REJECTED";
															}  
															?>

														</td>
														 <?php  if ($this->session->userdata('role') != 1) { ?>
														<td data-label="Order:">
															<a class="button is-success" href="javascript:void(0);" onclick="update_ticket_status('<?php echo md5($getMySalesDa->eticket_id);?>',2);">
														APPROVE
														</a>
														<a class="button is-danger" href="javascript:void(0);" onclick="update_ticket_status('<?php echo md5($getMySalesDa->eticket_id);?>',6);">
														REJECT
														</a>
													<!-- <select name="e-tickets" id="status" class="form-control" onchange="update_ticket_status('<?php echo md5($getMySalesDa->eticket_id);?>',this.value);">
													<option value="1" <?php if ($getMySalesDa->ticket_status == 1) { ?> selected <?php } ?>>UPLOADED</option>
													<option value="2" <?php if ($getMySalesDa->ticket_status == 2) { ?> selected <?php } ?>>APPROVE</option>
													<option value="6" <?php if ($getMySalesDa->ticket_status == 6) { ?> selected <?php } ?>>REJECT</option>
													</select> -->
												</td>
											<?php } ?>
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
