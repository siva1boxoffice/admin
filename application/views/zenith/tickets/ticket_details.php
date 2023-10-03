<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/app.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/main.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/style.css" />
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

	<div id="huro-app" class="app-wrapper">
		
		<div id="app-projects" class="view-wrapper-1 " data-naver-offset="214" data-menu-item="#layouts-sidebar-menu" data-mobile-item="#home-sidebar-menu-mobile">
			<div class="page-content-wrapper">
				<div class="page-content is-relative">
					<div class=" onebox-order-info">
						<div class="container_new">
							<div class="row">
								<div class="sub_heading">
									<div class="onebox-order-heading">
										<h2>Request Ticket Info</h2>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="table_section ordr_info  " id="no-more-tables">
									
									<table class="toptable toptable_new res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
											<th>Event ID</th>
											<th>Event</th>
											<th>Tournment</th>
											<th>Status</th>
											<th>Qty</th>
											<th>Requested On</th>
											</tr>
											<tr>
											<td data-label="Event Id:">
											<span class="event_id">#<?php echo $tickets->event_id; ?></span>
											</td>
											<td data-label="Event:"><?php echo $tickets->match_name; ?><br>
											<p><?php echo $tickets->country_name . ', ' . $tickets->city_name; ?></p>
											<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $tickets->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $tickets->match_time; ?></span>
											</td>
											<td data-label="Tournment:">
											<?php echo $tickets->tournament_name;
											?>
											</td>
											<td data-label="Status:">
											<select name="e-tickets" id="status" class="form-control" onchange="update_enquiry_status('<?php echo ($tickets->request_id);?>',this.value,'ticket');">
											<option value="0" <?php if ($tickets->request_status == 0) { ?> selected <?php } ?>>OPEN</option>
											<option value="1" <?php if ($tickets->request_status == 1) { ?> selected <?php } ?>>CLOSED</option>
											</select>
											</td>
											<td data-label="Request Qty:">
											<?php echo $tickets->quantity;
											?>
											</td>
											<td data-label="Request On:">
											<?php $request_date = date("Y-m-d h:i:s",($tickets->request_date));
											?>
											<?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$request_date))).' '.@$_COOKIE["time_zone"];?>
											</td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>
							
							<div class="account-wrapper">
								<div class="columns">
									<div class="column is-6">
										<h3>Ticket Information</h3>
										<div class="status_item">
											<div class="details">
												<div class="columns">
													<div class="column is-5">
														<div class="img">
														<img src="<?php echo UPLOAD_PATH; ?>uploads/stadium<?php echo $tickets->stadium_image; ?>">

														</div>
													</div>
													<div class="column is-7">
														<h4><?php echo $tickets->match_name; ?></h4>
														<p><?php echo $tickets->country_name . ',' . $tickets->city_name; ?></p>
														<p>
															<span class="tr_date">
																<i class="fas fa-calendar"></i><?php echo $tickets->match_date; ?> </span>
															<span class="tr_date">
																<i class="fas fa-clock"></i><?php echo $tickets->match_time; ?> </span>
														</p>

														<p>
															<span class="">Category: <?php echo $tickets->seat_category; ?></span>
														</p>
														<p>
															<span class="">Quantity: <?php echo $tickets->quantity; ?></span>
														</p>
														
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="column is-6">
										<h3>Customer Information</h3>
										<div class="tick_info">
											<div class="details">
											<table>
													<tbody>
														<tr>
															<td>Customer Name</td>
															<td>
																<?php echo $tickets->full_name ; ?> 
														
															</td>
														</tr>
														<tr>
															<td>Email</td>
															<td> <?php echo $tickets->email_id ; ?></td>
														</tr>
														<tr>
															<td>Contact No</td>
															<td><?php echo $tickets->diallingcode ; ?> <?php echo $tickets->mobilenumber ; ?></td>
														</tr>
														<tr>
															<td>Special Request</td>
															<td><?php echo $tickets->special_request ; ?></td>
														</tr>
														
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
<?php $this->load->view('common/footer');
?>
<?php exit; ?>
