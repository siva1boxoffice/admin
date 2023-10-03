        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add State" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative business-dashboard course-dashboard">
        			<div class="page-content-inner">
        				<div class="flex-list-wrapper">

        					<!--Form Layout 1-->
        					<div class="form-layout">
        						<div class="form-outer">
        							<form id="city-form" method="post" class=" login-wrapper form_req_validation" action="<?php echo base_url(); ?>settings/cities/save">
        								<input type="hidden" name="city_id" value="<?php if (isset($city_details->id)) {
																						echo $city_details->id;
																					} ?>">
        								<div class="form-header stuck-header">
        									<div class="form-header-inner">
        										<?php if (!empty($city_details)) { ?>
        											<div class="left">
        												<h3>Edit City</h3>
        											</div>
        										<?php	} else { ?>
        											<div class="left">
        												<h3>Add New City</h3>
        											</div>
        										<?php } ?>
        										<div class="right">
        											<div class="buttons">
        												<a href="<?php echo base_url(); ?>settings/cities" class="button h-button is-light is-dark-outlined">
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
        											<h4>City Info</h4>
        										</div>

        										<div class="columns is-multiline">

        											<div class="column is-6">
        												<div class="field">
        													<label>Country</label>
        													<div class="control">
        														<select class="form-control " id="cname" name="cname" required>
        															<option value="">-Select Country-</option>
        															<?php foreach ($countries as $country) { ?>
        																<option value="<?php echo $country->id; ?>" <?php if (isset($selected_country)) {
																														if ($country->id == $selected_country) {
																															echo ' selected  ';
																														}
																													} ?>><?php echo $country->name; ?></option>
        															<?php } ?>
        														</select>
        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>State</label>
        													<div class="control">
        														<select class="form-control select2" id="sname" name="sname" required>
        															<option value="">-Select State-</option>
        															<?php
																	if (isset($states)) {
																		foreach ($states as $state) { ?>
        																	<option value="<?php echo $state->id; ?>" <?php if (isset($city_details->state_id)) {
																															if ($state->id == $city_details->state_id) {
																																echo ' selected  ';
																															}
																														} ?>><?php echo $state->name; ?></option>
        															<?php }
																	} ?>
        														</select>
        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>City Name</label>
        													<div class="control ">
        														<input type="text" class="input" minlength="2" placeholder="City Name" id="cityname" name="cityname" required value="<?php if (isset($city_details->name)) {
																																															echo $city_details->name;
																																														} ?>">

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
        			<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        			<script>
        				$("#cname").change(function() {

        					var url = '<?php echo base_url(); ?>' + 'settings/getStates';
        					var data = {
        						country_id: $("#cname").val()
        					};
        					$.ajax({
        						url: url,
        						data: data,
        						type: "POST",
        						dataType: 'json',
        						success: function(data) {
        							if (data != '') {
        								var fil = data;
        								$('#sname').empty();
        								$('#sname').append("<option value='' selected disabled='disabled'>-Select State-</option>");
        								for (var i = 0; i < fil.length; i++) {
        									console.log(fil[i].name);
        									$('#sname').append("<option value=" + fil[i].id + ">" + fil[i].name + "</option>");
        								}
        							}
        						}
        					});
        				});
        			</script>
        			<?php $this->load->view('common/footer'); ?>
