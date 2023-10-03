<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">


			<div class="page-content-inner">
				<form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>settings/email_templates/save_email_templates">
					<input type="hidden" name="id" value="<?php echo $emails->id; ?>">

					<!--Form Layout 1-->
					<div class="form-layout">
						<div class="form-outer">
							<div class="form-header stuck-header">
								<div class="form-header-inner">
									<div class="left">
										<h3>Create New Email Template</h3>
									</div>
									<div class="right">
										<div class="buttons">
											<a href="<?php echo base_url(); ?>settings/email_templates/list_email_templates" class="button h-button is-light is-dark-outlined">
												<span class="icon">
													<i class="lnir lnir-arrow-left rem-100"></i>
												</span>
												<span>Go to Templates</span>
											</a>
											<button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Save</button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-body has-loader">

								<!--Loader-->
								<div class="h-loader-wrapper">
									<div class="loader is-small is-loading"></div>
								</div>
								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">
									<div class="fieldset-heading">
										<h4>Email Template Info</h4>
										<p>Fill the following Template information</p>
									</div>
									<div class="columns is-multiline">

										<div class="column is-6">
											<div class="field">
												<label>Email Type *</label>
												<div class="control">
													<input type="text" id="template_key" name="template_key" class="input" placeholder="Enter Template Key" required value="<?php echo $emails->template_key; ?>">
												
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>CC Email  *</label>
												<div class="control">
													<input type="text" id="cc_email" name="cc_email" class="input" placeholder="Enter From email ID" required value="<?php echo $emails->cc_email; ?>">
												</div>
											</div>
										</div>
										

										<div class="column is-6">
											<div class="field">
												<label>Subject *</label>
												<div class="control">
													<input type="text" id="subject_english" name="subject_english" class="input" placeholder="Email Subject" required value="<?php echo $emails->subject_english; ?>">
												</div>
											</div>
										</div>

										<div class="column is-6">
											<div class="field">
												<label>Subject Arabic*</label>
												<div class="control">
													<input type="text" id="subject_arabic" name="subject_arabic" class="input" placeholder="Email Subject" required value="<?php echo $emails->subject_arabic; ?>">
												</div>
											</div>
										</div>

										<div class="column is-6">
											<div class="field">
												<label>Template Status *</label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="status" value="1" <?php if ($emails->status == '1') { ?> checked <?php } ?>>
															<i></i>
														</label>
														<div class="text">
															<span>Enable / disable Template Status</span>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">
									<div class="fieldset-heading">
										<h4>Template Content Info</h4>
										<p>Fill the Template Content Information</p>
									</div>

									<div class="column is-12">
										<div class="field">
											<label>Template Content </label>
											<div class="control">
												<textarea id="message_english" name="message_english"><?php echo $emails->message_english; ?></textarea>
											</div>
										</div>
									</div>
								</div>

								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">
							

									<div class="column is-12">
										<div class="field">
											<label>Template Content Arabic </label>
											<div class="control">
												<textarea id="message_arabic" name="message_arabic"><?php echo $emails->message_arabic; ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--Fieldset-->
						</div>
					</div>
			</div>


			</form>
		</div>

		<?php $this->load->view('common/footer'); ?>
		<script type="text/javascript">

			$('#message_english').summernote({
				placeholder: 'Message English',
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

			$('#message_arabic').summernote({
				placeholder: 'Message Arabic',
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
		</script>

		<?php exit; ?>
