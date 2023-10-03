        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Country" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative business-dashboard course-dashboard">
        			<div class="page-content-inner">
        				<div class="flex-list-wrapper">

        					<!--Form Layout 1-->
        					<div class="form-layout">
        						<div class="form-outer">
        							<form id="country-form" method="post" class=" login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url(); ?>settings/countries/save">
        								<input type="hidden" name="country_id" value="<?php if (isset($country_details->id)) {
																							echo $country_details->id;
																						} ?>">
        								<div class="form-header stuck-header">
        									<div class="form-header-inner">
        										<?php if (!empty($country_details)) { ?>
        											<div class="left">
        												<h3>Edit Country</h3>
        											</div>
        										<?php	} else { ?>
        											<div class="left">
        												<h3>Add New Country</h3>
        											</div>
        										<?php } ?>
        										<div class="right">
        											<div class="buttons">
        												<a href="<?php echo base_url(); ?>settings/countries" class="button h-button is-light is-dark-outlined">
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
        											<h4>Country Info</h4>
        										</div>

        										<div class="columns is-multiline">
        											<div class="column is-6">
        												<div class="field">
        													<label>Country Name</label>
        													<div class="control ">
        														<input type="text" class="input" minlength="2" placeholder="Country Name" id="cname" name="cname" required value="<?php if (isset($country_details->name)) {
																																																		echo $country_details->name;
																																																	} ?>">

        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>Sort Name</label>
        													<div class="control ">
        														<input type="text" class="input" minlength="2" placeholder="Sort Name" id="sname" name="sname" required value="<?php if (isset($country_details->sortname)) {
																																																		echo $country_details->sortname;
																																																	} ?>">

        													</div>
        												</div>
        											</div>
													<div class="column is-6">
        												<div class="field">
        													<label>Phone Code</label>
        													<div class="control ">
        														<input type="text" class="input" minlength="2" placeholder="Phone Code" id="pcode" name="pcode" required value="<?php if (isset($country_details->phonecode)) {
																																																		echo $country_details->phonecode;
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
        			<?php $this->load->view('common/footer'); ?>
