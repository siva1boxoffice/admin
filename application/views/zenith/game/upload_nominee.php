<?php $this
	->load
	->view('common/header'); ?>

<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				<!--User profile-->
				<div class="profile-wrapper">
					<div class="profile-body">
						<div class="columns">
							<div class="column is-8">
								<div class="profile-header">
									<h3 class="title is-4 is-narrow is-thin">Upload Nominee - Ticket Quantity (<?php echo $orderData->quantity;?>)</h3>
								</div>
								<form id="add-eticket" enctype='multipart/form-data' method="post" class="login-wrapper validate_form_v2" action="<?php echo base_url(); ?>game/saveNominee">
									<input type="hidden" name="booking_id" value="<?php echo $orderData->bg_id; ?>">
									<input type="hidden" name="booking_no" value="<?php echo $orderData->booking_no; ?>">
									<input type="hidden" name="ticket_id" value="<?php echo $orderData->bt_id; ?>">
									<div class="profile-card">
										<div class="profile-card-section">
											<div class="section-upload-E-ticket">
												<div class="control">
													<div class="">
														<?php
														
														if ($orderData->quantity > 0 && $orderData->quantity != '') {
															for ($i = 1; $i <= $orderData->quantity; $i++) {
														?>
																<div class="columns is-multiline">
        											<div class="column is-3">
        												<div class="field">
        													<label>First Name *</label>
        													<div class="control">
        														<input type="text" class="input" placeholder="First Name" id="first_name" name="first_name[]" value="<?php echo $eticketData[$i - 1]->first_name;?>" required>
        													</div>
        												</div>
        											</div>
        											<div class="column is-3">
        												<div class="field">
        													<label>Last Name *</label>
        													<div class="control">
        														<input type="text" class="input" placeholder="Last Name" id="last_name" name="last_name[]" value="<?php echo $eticketData[$i - 1]->last_name;?>" required>
        													</div>
        												</div>
        											</div>
        											<div class="column is-3">
        												<div class="field">
        													<label>Nationality *</label>
        													<div class="control">
        														<input type="text" class="input" placeholder="Nationality" id="nationality" name="nationality[]" value="<?php echo $eticketData[$i - 1]->nationality;?>" required>
        													</div>
        												</div>
        											</div>
        											<div class="column is-3">
        												<div class="field">
        													<label>Date Of Birth *</label>
        													<div class="control">
        														<input type="date" class="input" placeholder="d-m-y" id="dob" name="dob[]" value="<?php echo date('d-m-Y',strtotime($eticketData[$i - 1]->dob));?>" required>
        													</div>
        												</div>
        											</div>
        										</div>
																
														<?php }
														} ?>
													</div>
													
												</div>
											</div>
										</div>
									</div>
									<div class="upload_button">
										<a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($orderData->booking_no); ?>" class="button h-button is-primary is-raised">Update Later</a>
										<button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Finish</button>
									</div>
								</form>
							</div>
							<div class="column is-4">

								<!--Notifications-->
								<div class="profile-card">
									<div class="profile-card-section no-padding">
										<div class="details">
											<div class="event_img">
												<img src="<?php echo base_url(); ?><?php echo $orderData->stadium_image; ?>">
											</div>
											<h5><?php echo $orderData->match_name; ?></h5>
											<p><?php echo $orderData->country_name . ',' . $orderData->city_name; ?></p>
											<p>
												<span class="tr_date">
													<i class="fas fa-calendar"></i><?php echo $orderData->match_date; ?> </span>
												<span class="tr_date">
													<i class="fas fa-clock"></i><?php echo $orderData->match_time; ?> </span>
											</p>
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

<?php $this
	->load
	->view('common/footer'); ?>
<script type="text/javascript">

	$(function() {

		$("input:file").change(function() {
			var fileName = $(this).val();
			$(this).next(".upFileName").html('<span class="file-label">' + fileName + '</span>');

		});
	});
</script>
<style>
	.section-upload-E-ticket .file.is-primary .file-cta {
		width: 192px;
	}
</style>
