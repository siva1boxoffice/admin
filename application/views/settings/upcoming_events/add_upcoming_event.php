        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Top Cups" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
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
        							<form id="top-league-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/upcoming_events/save">
        								<input type="hidden" name="upcoming_event_id" value="<?php if (isset($upcoming_events->id)) {
																									echo $upcoming_events->id;
																								} ?>">
        								<div class="form-header stuck-header">
        									<div class="form-header-inner">
        										<div class="left">
        											<h3>Add New Upcoming Event</h3>
        										</div>
        										<div class="right">
        											<div class="buttons">
        												<a href="<?php echo base_url(); ?>settings/upcoming_events" class="button h-button is-light is-dark-outlined">
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
        											<h4>Upcoming Event Info</h4>
        										</div>
        										<div class="columns is-multiline">
        											<div class="column is-6">
        												<div class="field">
        													<label>Match </label>
        													<div class="control has-icon">
        														<select class="form-control select2" id="match" name="match" required>
        															<option value="">-Select Match -</option>
        															<?php foreach ($matches as $match) { ?>
        																<option value="<?php echo $match->m_id; ?>" <?php if (isset($upcoming_events->match_id)) {
																														if ($match->m_id == $upcoming_events->match_id) {
																															echo ' selected  ';
																														}
																													} ?>><?php echo $match->match_name; ?></option>
        															<?php } ?>
        														</select>

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
        			<?php exit; ?>
