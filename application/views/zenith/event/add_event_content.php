<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">


			<div class="page-content-inner">
				<form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>event/other_events/save_events">
					<input type="hidden" name="matchId" value="<?php echo $event->m_id; ?>">
					<input type="hidden" name="flag" value="content">
					<div class="dashboard-title is-main">
						<div class="left">
							<h2 class="dark-inverted">Other Events</h2>
						</div>
					</div>
					<!--Form Layout 1-->
					<div class="form-layout">
						<div class="form-outer">
							<div class="form-header stuck-header">
								<div class="form-header-inner">
									<div class="left">
										<h3>Create New Other Event</h3>
									</div>
									<div class="right">
										<div class="buttons">
											<?php if (isset($event->m_id)) { ?>
												SEO : &nbsp;
												<div class="switch-block no-padding-all">
												<!-- <div class="text">
												<span>SEO Status</span>
												</div> -->
												<label class="form-switch is-primary">
												<input data-href="<?php echo base_url(); ?>event/other_events/seo_status/<?php echo $event->m_id;?>" type="checkbox" class="is-switch seo_status" name="is_seo_active" value="1" <?php if (isset($event->seo_status)) {
												if ($event->seo_status == 1) { ?> checked <?php
												}
												} ?>>
												<i></i>
												</label>
												</div>&nbsp;
                                                <a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $event->slug; ?>" class="button h-button is-light is-dark-outlined">
                                                <span class="icon">
                                                <i class='fa fa-eye'></i>
                                                </span>
                                                </a>
                                                <?php } ?>
											<a href="<?php echo base_url(); ?>event/other_events/upcoming" class="button h-button is-light is-dark-outlined">
												<span class="icon">
													<i class="lnir lnir-arrow-left rem-100"></i>
												</span>
												<span>Go to Other Events</span>
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
										<h4>Basic Info</h4>
										<p>Fill the following Event information</p>
									</div>
									<div class="columns is-multiline">
									
										<div class="column is-12">
											<div class="field">
												<label>Event Name</label>
												<div class="control">
													<input disabled type="text" id="" name="" class="input" placeholder="Enter Event Name" required value="<?php echo $event->match_name; ?>">
													<input type="hidden" id="eventname" name="eventname" class="input" placeholder="Enter Event Name" required value="<?php echo $event->match_name; ?>">
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">
									<div class="fieldset-heading">
										<h4>Event Content Info</h4>
										<p>Fill the Event Content Information</p>
									</div>

									<div class="columns is-multiline">
										<?php if($this->session->userdata('role') != 7){?>
										<div class="column is-12">
											<div class="field">
												<label>Meta Title *</label>
												<div class="control">
													<textarea class="textarea" rows="4" placeholder="Meta Title" name="metatitle" required><?php echo $event->meta_title; ?></textarea>
												</div>
											</div>
										</div>
										<div class="column is-12">
											<div class="field">
												<label>Meta Description *</label>
												<div class="control">
													<textarea class="textarea" rows="4" placeholder="Meta Description" name="metadescription" required><?php echo $event->meta_description; ?></textarea>
												</div>
											</div>
										</div>
									<?php }else{ ?>
										<textarea style="display:none;" class="textarea" rows="4" placeholder="Meta Title" name="metatitle" ><?php echo $event->meta_title; ?></textarea>
										<textarea style="display:none;" class="textarea" rows="4" placeholder="Meta Description" name="metadescription" ><?php echo $event->meta_description; ?></textarea>
									<?php } ?>
										<div class="column is-12">
											<div class="field">
												<label>Event Description </label>
												<div class="control">
													<textarea id="match_description" name="description"><?php echo $event->description; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">
									<div class="fieldset-heading">
										<h4>Event Info</h4>
										<p>Fill the following Event information</p>
									</div>

									<div class="columns is-multiline">
										
										<div class="column is-6">
                                            <div class="field">
                                                <label>Keywords</label>
                                                <div class="control">
                                                     <input id="choices-text-remove-button" class="input" value="<?php echo $event->seo_keywords;?>" name="seo_keywords" placeholder="Enter Keywords">
                                                </div>
                                            </div>
                                        </div>

										<div class="column is-6">
											<div class="field">
												<label>URL Key *</label>
												<div class="control">
													<input type="text" class="input" placeholder="Enter Match URL" name="event_url" id="event_url" value="<?php echo $event->slug; ?>" required>
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
				$('#match_description').summernote({
					placeholder: 'Event Description',
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

				<?php if (strtotime($event->match_date)) { ?>

					bulmaCalendar.attach("#bulma-datepicker-1", {
						startDate: new Date('<?php echo date('m/d/Y', strtotime($event->match_date)); ?>'),
						color: themeColors.primary,
						lang: "en",
						showHeader: false,
						showButtons: false,
						showFooter: false
					});

				<?php } else { ?>

					bulmaCalendar.attach("#bulma-datepicker-1", {
						startDate: new Date('<?php echo date('m/d/Y'); ?>'),
						color: themeColors.primary,
						lang: "en",
						showHeader: false,
						showButtons: false,
						showFooter: false
					});

				<?php } ?>

				<?php if (strtotime($event->match_time)) { ?>
					var now = new Date()
					console.log(moment(now).format('HH:mm'))
					bulmaCalendar.attach("#bulma-datepicker-5", {
						startTime: moment(now).format('HH:mm'),
						color: themeColors.primary,
						lang: "en"
					});

				<?php } else { ?>

					bulmaCalendar.attach("#bulma-datepicker-5", {
						startTime: '<?php echo date('h:m'); ?>',
						color: themeColors.primary,
						lang: "en"
					});

				<?php } ?>
				$("#event_image").change(function() {
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
