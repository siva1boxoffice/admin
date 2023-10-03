<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">


			<div class="page-content-inner">
				<form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>event/other_events/save_events">
					<input type="hidden" name="matchId" value="<?php echo $event->m_id; ?>">
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
                                                <a target="_blank" href="<?php echo FRONT_END_URL; ?>/en/<?php echo $event->slug; ?>" class="button h-button is-light is-dark-outlined">
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
										<div class="column is-6">
											<div class="field">
												<label>Category</label>
												<div class="control">
													<select class="form-control select2" id="category" name="category" required>
														<option value="">-Select Category -</option>
														<?php foreach ($categories as $category) { ?>
															<option value="<?php echo $category->id; ?>" <?php if ($category->id == $event->other_event_category) { ?> selected <?php } ?><?php if ($category->parent_id == 0) { ?> disabled <?php  } ?>><?php echo $category->category_name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Event Name</label>
												<div class="control">
													<input type="text" id="eventname" name="eventname" class="input" placeholder="Enter Event Name" required value="<?php echo $event->match_name; ?>">
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Active</label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="is_active" value="1" <?php if ($event->match_status == '1') { ?> checked <?php } ?>>
															<i></i>
														</label>
														<div class="text">
															<span>Enable / disable Event Status</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Availability</label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="availability" value="1" <?php if ($event->availability == '1') { ?> checked <?php } ?>>
															<i></i>
														</label>
														<div class="text">
															<span>Enable / disable Availabilty</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Private Link</label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="privatelink" value="1" <?php if ($event->privatelink == '1') { ?> checked <?php } ?>>
															<i></i>
														</label>
														<div class="text">
															<span>Enable / disable Private Link</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>API Share</label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="apishare" value="1" <?php if ($event->apishare == '1') { ?> checked <?php } ?>>
															<i></i>
														</label>
														<div class="text">
															<span>Enable / disable API Share</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--Fieldset-->
								<!-- <div class="form-fieldset" style="max-width: 580px;">
									<div class="fieldset-heading">
										<h4>Event Content Info</h4>
										<p>Fill the Event Content Information</p>
									</div>

									<div class="columns is-multiline">
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
										<div class="column is-12">
											<div class="field">
												<label>Event Description </label>
												<div class="control">
													<textarea id="match_description" name="description"><?php echo $event->description; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div> -->
								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">
									<div class="fieldset-heading">
										<h4>Event Info</h4>
										<p>Fill the following Event information</p>
									</div>

									<div class="columns is-multiline">
										<div class="column is-6">
											<div class="field">
												<label>Event Date *</label>
												<div class="control">
													<input name="matchdate" id="bulma-datepicker-1" class="input" type="date" placeholder="dd/mm/yyy" required value="">
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Event Time *</label>
												<div class="control">
													<input class="input" type="time" name="matchtime" placeholder="hh:mm" required value="<?php echo date('H:m', strtotime($event->match_date)); ?>" <?php if ($event->m_id == '') { ?> id="bulma-datepicker-5" <?php } ?>>

												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Country *</label>
												<div class="control">
													<select class="form-control select2" id="country" name="country" onchange="get_state_city(this.value);" required>
														<option value="">-Select Country-</option>
														<?php foreach ($countries as $country) { ?>
															<option <?php if ($event->country == $country->id) { ?> selected <?php } ?> value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>City *</label>
												<?php $cityArray = $this->General_Model->get_state_cities($event->country);
												?>
												<div class="control">
													<select class="form-control select2" id="city" name="city" required>
														<option value="">-Select City-</option>
														<?php


														foreach ($cityArray as $cityArr) {
														?>
															<option value="<?= $cityArr->id; ?>" <?php
																									if ($event->city) : if ($event->city == $cityArr->id) {
																											echo 'selected';
																										}
																									endif;
																									?>><?= $cityArr->name; ?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
										</div>
										<input type="hidden" name="state" id="state" value="">
										<div class="column is-6">
											<div class="field">
												<label>Venue (Stadium Name) *</label>
												<div class="control">
													<select class="form-control select2" id="venue" name="venue" required>
														<option value="">-Select Venue-</option>
														<?php foreach ($stadiums as $stadium) { ?>
															<option <?php if ($event->venue == $stadium->s_id) { ?> selected <?php } ?> value="<?php echo $stadium->s_id; ?>"><?php echo $stadium->stadium_name; ?></option>
														<?php } ?>
													</select>
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
										<div class="column is-6">
											<div class="field">
												<label>Event Image </label>
												<div class="control has-icon">
													<div class="file has-name is-fullwidth">
														<label class="file-label">
															<input type="hidden" name="exs_file" value="<?php if (isset($event->event_image)) {
																											echo $event->event_image;
																										} ?>">
															<input class="file-input" type="file" id="event_image" name="event_image">
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

										if (isset($event->event_image)) {
											if (UPLOAD_PATH . './uploads/event_image/' . $event->event_image) { ?>
												<div class="column is-6">
													<div class="field">
														<label>Previous Event Image </label>
														<div class="control has-icon">
															<div class="file has-name is-fullwidth">
																<label class="file-label">
																	<img class="imgTbl" src="<?= UPLOAD_PATH . './uploads/event_image/' . $event->event_image; ?>"></span>
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
