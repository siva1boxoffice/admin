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
									<h2>Contact Enquiry List</h2>
								</div>
								<div class="tab_sec orders list_odd" id="no-more-tables">
									<?php if ($contacts) { ?>
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Sl.No.</th>
												<th>Name</th>
												<th>Email</th>
												<th>Mobile No</th>
												<th>Country</th>
												<th>Message</th>
												<th>Enquiry Date</th>
												<th>Action</th>
											</tr>
											<?php 
												$i = 1;
												foreach ($contacts as $contact) {
											?>
													<tr>
														<td data-label="Event:"><?php echo $i;?></td>
														<td data-label="Event:"><?php echo $contact->first_name; ?> <?php echo $contact->last_name; ?>
														</td>
														<td data-label="Tickets Type:">
															<?php echo $contact->email;
															?>
														</td>
														<td data-label="Tickets Type:">
															<?php echo $contact->dialing_code;
															?> <?php echo $contact->mobile_no;
															?>
														</td>
														<td data-label="Tickets Type:">
															<?php echo $contact->country_name;
															?>
														</td>
														<td data-label="Tickets Type:">
															<?php echo $contact->message;
															?>
														</td>
														<td data-label="Tickets Type:">
															
															<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$contact->created_at))).' '.@$_COOKIE["time_zone"];?>
														</td>
														<td data-label="Total:">
															<select name="e-tickets" id="status" class="form-control" onchange="update_enquiry_status('<?php echo ($contact->contact_id);?>',this.value,'contact');">
													<option value="0" <?php if ($contact->contact_status == 0) { ?> selected <?php } ?>>OPEN</option>
													<option value="1" <?php if ($contact->contact_status == 1) { ?> selected <?php } ?>>CLOSED</option>
													</select>
														</td>
													</tr>
											<?php
												$i++;}
											 ?>

										</tbody>
									</table>
									<?php } else{ ?>
											<h3>No Contact Enquiries Available.</h3>
											<?php }
											?>
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
<?php $this->load->view('common/footer'); ?>
<?php exit; ?>
