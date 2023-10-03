        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Banner" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative business-dashboard course-dashboard">
        			<div class="page-content-inner">
        				<div class="flex-list-wrapper has-loader">
        					<div class="h-loader-wrapper">
        						<div class="loader is-small is-loading"></div>
        					</div>
        					<!--Form Layout 1-->
        					<div class="form-layout">
        						<div class="form-outer">
        							<form id="banner-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/banners/save">
        								<input type="hidden" name="banner_id" value="<?php if (isset($banner_details->id)) {
																							echo $banner_details->id;
																						} ?>">
        								<div class="form-header stuck-header">
        									<div class="form-header-inner">
        										<div class="left">
        											<h3>Add New Banner</h3>
        										</div>
        										<div class="right">
        											<div class="buttons">
        												<a href="<?php echo base_url(); ?>settings/banners" class="button h-button is-light is-dark-outlined">
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
        											<h4>Banner Info</h4>
        										</div>

        										<div class="columns is-multiline">


        											<div class="column is-12">
        												<div class="field">
        													<label>Banner Title</label>
        													<div class="control ">
        														<input type="text" required class="input" placeholder="Banner Ttitle" id="title" name="title" value="<?php if (isset($banner_details->title)) {
																																											echo $banner_details->title;
																																										} ?>">

        													</div>

        												</div>
        											</div>

        											<div class="column is-12">
        												<div class="field">
        													<label>Banner Description </label>
        													<div class="control">
        														<textarea required id="banner_description" required rows="4" placeholder="Banner Description" name="banner_description"><?php if (isset($banner_details->description)) {
																																															echo $banner_details->description;
																																														} ?></textarea>
        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>Banner Image </label>
        													<div class="control has-icon">
        														<div class="file has-name is-fullwidth">
        															<label class="file-label">
        																<input type="hidden" name="exs_file" value="<?php if (isset($banner_details->banner_image)) {
																														echo $banner_details->banner_image;
																													} ?>">
        																<input class="file-input" required type="file" id="banner_image" name="banner_image">
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

													if (isset($banner_details->image)) {
														if (@UPLOAD_PATH. './uploads/banners/' . $banner_details->image) { ?>
        													<div class="column is-6">
        														<div class="field">
        															<label>Previous Image </label>
        															<div class="control has-icon">
        																<div class="file has-name is-fullwidth">
        																	<label class="file-label">
        																		<img class="imgTbl" src="<?= UPLOAD_PATH. './uploads/banners/' . $banner_details->image; ?>"></span>
        																	</label>
        																</div>
        															</div>
        														</div>
        													</div>
        											<?php }
													} ?>
        											<div class="column is-6">
        												<div class="field">
        													<label>Status</label>
        													<div class="control has-icon">
        														<div class="switch-block no-padding-all">
        															<label class="form-switch is-primary">
        																<input type="checkbox" class="is-switch" name="status" value="1" <?php if (isset($banner_details->status)) {
																																				if ($banner_details->status == 1) { ?> checked <?php }
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
        										</div>
        									</div>
        									<!--Fieldset-->
        								</div>
        							</form>
        						</div>
        					</div>
        				</div>
        			</div>

        			<?php $this->load->view('common/footer'); ?>
        			<script type="text/javascript">
        				$('#banner_description').summernote({
        					placeholder: 'Banner Description',
        					tabsize: 2,
        					height: 250, // set editor height
        					minHeight: null, // set minimum height of editor
        					maxHeight: null, // set maximum height of editor
        					focus: true,
        					toolbar: [
        						['style', ['style']],
        						['font', ['bold', 'underline', 'clear']],
        						['para', ['ul', 'ol', 'paragraph']],
        						['table', ['table']],
        						['insert', ['link', 'picture', 'video']],
        						['view', ['codeview', 'help']]
        					]
        				});
        				$("#banner_image").change(function() {
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
        			<?php exit; ?>
