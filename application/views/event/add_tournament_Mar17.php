<?php $this->load->view('common/header');//echo "<pre>";prrint_r($tournaments); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Tournament" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				<form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>settings/tournaments/save" >
					<input type="hidden" name="tournamentId" value="<?php if (isset($tournaments->t_id)) { echo $tournaments->t_id; } ?>">
					<div class="dashboard-title is-main">
						<div class="left">
							<h2 class="dark-inverted">Tournaments</h2>
						</div>
					</div>

					<!--Form Layout 1-->
					<div class="form-layout">
						<div class="form-outer">
							<div class="form-header stuck-header">
								<div class="form-header-inner">
									<div class="left">
										<h3>Add Or Edit Tournaments</h3>
									</div>
									<div class="right">
										<div class="buttons">
											<?php if (isset($tournaments->t_id)) { ?>
											<a target="_blank" href="<?php echo FRONT_END_URL; ?>/en/<?php echo $tournaments->url_key; ?>" class="button h-button is-light is-dark-outlined">
												<span class="icon">
													<i class='fa fa-eye'></i>
												</span>
											</a>
											<?php } ?>
											<a href="<?php echo base_url(); ?>settings/tournaments" class="button h-button is-light is-dark-outlined">
												<span class="icon">
													<i class="lnir lnir-arrow-left rem-100"></i>
												</span>
												<span>Go to tournaments</span>
											</a>
											<button type="submit" id="save-button" class="button h-button is-primary is-raised">Save</button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-body">
								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">

									<div class="columns is-multiline">
										<div class="column is-12">
											<div class="field">
												<label>Tournament Name *</label>
												<div class="control">
													<input type="text" id="name" name="name" class="input" placeholder="Enter Tournament Name" required value="<?php  if (isset($tournaments->tournament)) { echo $tournaments->tournament; } ?>">
												</div>
											</div>
										</div>

										<div class="column is-6">
											<div class="field">
												<label> Status </label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="is_active" value="1" <?php if (isset($tournaments->status)) {
																																	if ($tournaments->status == '1') { ?> checked <?php }
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
												<label> Popular Tournament </label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="is_popular" value="1" <?php if (isset($tournaments->popular_tournament)) {
																																		if ($tournaments->popular_tournament == '1') { ?> checked <?php }
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
								<!-- <div class="form-fieldset" style="max-width: 580px;">
									<div class="columns is-multiline">
										<div class="column is-12">
											<div class="field">
												<label> Title</label>
												<div class="control">
													<input type="text" id="title" name="title" class="input" placeholder="Enter Title" value="<?php if (isset($tournaments->title)) { echo $tournaments->title; } ?>">
												</div>
											</div>
										</div>
										<div class="column is-12">
											<div class="field">
												<label>Meta Description</label>
												<div class="control">
													<textarea class="textarea" rows="4" placeholder="Meta Description" name="metadescription"><?php if (isset($tournaments->metdes)) { echo $tournaments->metdes; } ?></textarea>
												</div>
											</div>
										</div>
										<?php //echo "<pre>";print_r($tournaments);?>
										<div class="column is-12">
											<div class="field">
												<label>Tournament Content </label>
												<div class="control">
													<textarea id="tournament_content" rows="4" placeholder="Tournament Content" name="tournament_content"><?php if (isset($tournaments->pcontent)) { echo $tournaments->pcontent; } ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div> -->
								<!--Fieldset-->
								<div class="form-fieldset" style="max-width: 580px;">
									<div class="columns is-multiline">
										
										
										<div class="column is-6">
											<div class="field">
												<label>API League</label>
												<div class="control">
													<select class="form-control select2" id="apileague" name="apileague">
														<option value="">-Select-</option>
														<?php 
														if(!empty($apiTournaments)){
														 foreach($apiTournaments->api->leagues as $at){ ?>
                                                  
															<option <?php if (isset($tournaments->api_tournament_id)) { if($at->league_id == $tournaments->api_tournament_id){ ?> selected="selected" <?php } } ?> value="<?php echo $at->league_id; ?>"><?php echo $at->name; ?></option>          
																	
															<?php }
																	
																	  } ?>
														
													</select>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Tournament Image (40x40)</label>
												<div class="control has-icon">
													<div class="file has-name is-fullwidth">
														<label class="file-label">
															<input type="hidden" name="exs_file" value="<?php if (isset($tournaments->tournament_image)) {
																											echo $tournaments->tournament_image;
																										} ?>">
															<input class="file-input" type="file" id="tournament_image" name="tournament_image" <?php if ($tournaments->t_id == "") { ?> required <?php  } ?>>
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

										if (isset($tournaments->tournament_image)) {
											if (UPLOAD_PATH  . 'uploads/tournaments/' . $tournaments->tournament_image) { ?>
												<div class="column is-6">
													<div class="field">
														<label>Previous Image </label>
														<div class="control has-icon">
															<div class="file has-name is-fullwidth">
																<label class="file-label">
																	<img class="imgTbl" src="<?= UPLOAD_PATH  . 'uploads/tournaments/' . $tournaments->tournament_image; ?>"></span>
																</label>
															</div>
														</div>
													</div>
												</div>
										<?php }
										} ?>
										<div class="column is-6">
											<div class="field">
												<label> Show Tournament in List </label>
												<div class="control has-icon">
													<div class="switch-block no-padding-all">
														<label class="form-switch is-primary">
															<input type="checkbox" class="is-switch" name="show_tournament" value="1" <?php if (isset($tournaments->show_in_list)) {
																																			if ($tournaments->show_in_list == '1') { ?> checked <?php }
																																											} ?>>
															<i></i>
														</label>
														<div class="text">
															<span>Hide tournament in list / Show tournament in list</span>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="column is-6">
											<div class="field">
												<label>Countries that are denied access </label>
												<div class="control">
													<select class="form-control select2" multiple id="bcountry" name="bcountry[]" >
														<option value="">-Select denied Countries-</option>
														<?php foreach ($countries as $country) { ?>
															<option <?php
																	if (isset($ban_arr)) {
																		if (in_array($country->id, $ban_arr)) {
																			echo 'selected="selected"';
																		}
																	}
																	?> value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Url Key</label>
												<div class="control">
													<input required type="text" id="url_key" name="url_key" class="input" placeholder="Enter URL Key" value="<?php if (isset($tournaments->url_key)) { echo $tournaments->url_key; } ?>">
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Sort Order *</label>
												<div class="control">
													<input required type="text" id="sortby" name="sortby" class="input" placeholder="Enter Sort Order" value="<?php if (isset($tournaments->sort_by)) { echo $tournaments->sort_by; } else { echo 1000;} ?>">
												</div>
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
			$('#tournament_content').summernote({
				placeholder: 'Tournament Content',
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
			$('#t_content_left').summernote({
				placeholder: 'Tournament Content Left',
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
			$('#t_content_right').summernote({
				placeholder: 'Tournament Content Right',
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
			$("#tournament_image").change(function() {
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
