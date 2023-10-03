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
									<h2>Email Logs</h2>
									<div class="list_button order_inf">
									<a href="<?php echo base_url();?>settings/email_logs/abondaned" class="user_buts <?php if($this->uri->segment(3) == 'abondaned'){?> active <?php } ?>">Cart Abondaned</a>
									<a href="<?php echo base_url();?>settings/email_logs/tickets" class="user_buts <?php if($this->uri->segment(3) == 'tickets'){?> active <?php } ?>">Tickets Available</a>
									<a href="<?php echo base_url();?>settings/email_logs/orders" class="user_buts <?php if($this->uri->segment(3) == 'orders'){?> active <?php } ?>">Orders</a>
								</div>
								</div>
								<div class="tab_sec orders" id="no-more-tables">

										<p><a href="<?php echo base_url();?>settings/email_export/<?php echo $this->uri->segment(3);?>/1" class="user_buts" >Export</a><br><br><br></p>

										
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Log id</th>
												<th>Email Type</th>
												<th>Customer Email</th>
												<th>Customer Name</th>
												<th>Match Name</th>
												<th>Match Date</th>
												<th>Tournament</th>
												<th>Stadium</th>
												<th>log date</th>
											</tr>
											<?php if ($email_logs) {
												foreach ($email_logs as $email_log) {
											?>
													<tr>
														<td data-label="Log Id:"><?php echo $email_log->id; ?></td>
														<td data-label="Email Type:">
															<?php
															echo $email_log->email_type;  ?>
														</td>
														<td data-label="Customer Email:">
															<?php echo $email_log->customer_email;
															?>
														</td>
														<td data-label="Customer Name:">
															<?php echo $email_log->customer_name;
															?>
														</td>
														<td data-label="Match Name:">
															<?php echo $email_log->match_name;
															?>
														</td>
														<td data-label="Match Date:">
															<span class="tr_date">
															<?php echo $email_log->match_date;
															?>
														</span>
														</td>
														<td data-label="Tournament:">
															<?php echo $email_log->tournament;
															?>
														</td>
														<td data-label="Stadium:">
															<?php echo $email_log->stadium;
															?>
														</td>
														<td data-label="Logs Date:">
															<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$email_log->created_at))).' '.@$_COOKIE["time_zone"];?>
														</td>
														</tr>
											<?php
												}
											}else{?>
												<tr><td colspan="9">No Email Logs Available.</td></tr>
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
<?php $this->load->view('common/footer'); ?>
<?php exit; ?>
