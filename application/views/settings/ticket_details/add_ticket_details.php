        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Ticket Details" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative business-dashboard course-dashboard">
        			<div class="page-content-inner">
        				<div class="flex-list-wrapper">

        					<!--Form Layout 1-->
        					<div class="form-layout">
        						<div class="form-outer">
        							<form id="split-type-form" method="post" class=" login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url(); ?>settings/ticket_details/save">
        								<input type="hidden" name="ticket_details_id" value="<?php if (isset($ticket_details->id)) {
																									echo $ticket_details->id;
																								} ?>">
        								<div class="form-header stuck-header">
        									<div class="form-header-inner">
        										<?php if (!empty($ticket_details)) { ?>
        											<div class="left">
        												<h3>Edit Ticket Details</h3>
        											</div>
        										<?php	} else { ?>
        											<div class="left">
        												<h3>Add New Ticket Details</h3>
        											</div>
        										<?php } ?>
        										<div class="right">
        											<div class="buttons">
        												<a href="<?php echo base_url(); ?>settings/ticket_details" class="button h-button is-light is-dark-outlined">
        													<span class="icon">
        														<i class="lnir lnir-arrow-left rem-100"></i>
        													</span>
        													<span>Cancel</span>
        												</a>
        												<button id="save-button" class="button h-button is-primary is-raised">Save</button>
        											</div>
        										</div>
        									</div>
        								</div>
        								<div class="form-body">
        									<!--Fieldset-->
        									<div class="form-fieldset">
        										<div class="fieldset-heading">
        											<h4>Ticket Details Info</h4>
        										</div>
        										<div class="columns is-multiline">
        											<div class="column is-6">
        												<div class="field">
        													<label>Ticket Name</label>
        													<div class="control ">
        														<input type="text" class="input" minlength="2" placeholder="Ticket Name" id="name" name="name" required value="<?php if (isset($ticket_details->ticket_det_name)) {
																																													echo $ticket_details->ticket_det_name;
																																												} ?>">

        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>Status</label>
        													<div class="control has-icon">
        														<div class="switch-block no-padding-all">
        															<label class="form-switch is-primary">
        																<input type="checkbox" class="is-switch" name="status" value="1" <?php if (isset($ticket_details->status)) {
																																				if ($ticket_details->status == 1) { ?> checked <?php }
																																														} ?>>
        																<i></i>
        															</label>
        															<div class="text">
        																<span>Inactive / Active</span>
        															</div>
        														</div>
        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>Ticket Image (40x40)</label>
        													<div class="control has-icon">
        														<div class="file has-name is-fullwidth">
        															<label class="file-label">
        																<input type="hidden" name="exs_file" value="<?php if (isset($ticket_details->timage)) {
																														echo $ticket_details->timage;
																													} ?>">
        																<input class="file-input" type="file" id="tdetails_image" name="tdetails_image">
        																<span class="file-cta">
        																	<span class="file-icon">
        																		<i class="lnil lnil-lg lnil-cloud-upload"></i>
        																	</span>
        																	<span class="file-label">
        																		Choose a file…
        																	</span>
        																</span>
        																<span class="file-name light-text imgSelected" id="previewImage">
        																	<img class="imgTbl" id="imageFile"></span>

        																</span>
        															</label>
        														</div>
        													</div>
        												</div>
        											</div>
        											<?php

													if (isset($ticket_details->ticket_image)) {
														if (@UPLOAD_PATH. 'uploads/ticket_details/' . $ticket_details->timage) { ?>
        													<div class="column is-6">
        														<div class="field">
        															<label>Previous Image </label>
        															<div class="control has-icon">
        																<div class="file has-name is-fullwidth">
        																	<label class="file-label">
        																		<img class="imgTbl" src="<?= UPLOAD_PATH. 'uploads/ticket_details/' . $ticket_details->timage; ?>"></span>
        																	</label>
        																</div>
        															</div>
        														</div>
        													</div>
        											<?php }
													} ?>
        										</div>
        									</div>
        									<!--Fieldset-->
        								</div>
        							</form>
        						</div>
        					</div>
        				</div>
        			</div>
        			<script>

        			</script>
        			<?php $this->load->view('common/footer'); ?>
        			<script type="text/javascript">
        				$("#tdetails_image").change(function() {
        					filePreview(this);
        				})

        				function filePreview(input) {
        					if (input.files && input.files[0]) {
        						var reader = new FileReader();
        						reader.onload = function(e) {
        							$('#previewImage + img').remove();
        							$('#imageFile').remove();
        							$('#previewImage').append('<img class="imgTbl" id="imageFile" src="' + e.target.result + '" />');
        						}
        						reader.readAsDataURL(input.files[0]);
        					}
        				}
        			</script>
