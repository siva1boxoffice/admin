<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="GEO IP Settings" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				<form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>home/geo_ip_settings/save">
					<!--Form Layout 1-->
					<div class="form-layout">
						<div class="form-outer">
							<div class="form-header stuck-header">
								<div class="form-header-inner">
									<div class="left">
										<h3>Edit GEO IP Settings</h3>
									</div>
									<div class="right">
										<div class="buttons">
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
										<h4>Edit GEO IP Info</h4>
									</div>
									<div class="columns is-multiline">
										<div class="column is-12">
											<div class="field demo-select">
												<div class="control">
													<label class="radio">
														<input type="radio" name="ctype" id="" value="allowed" required <?php if (isset($geoSettings)) {
																															if ($geoSettings['COUNTRY_SELECTION_TYPE'] == 'allowed') {
																																echo "checked";
																															}
																														} ?>>
														<span></span>
														Allowed Countries
													</label>
													<label class="radio is-outlined is-primary">
														<input type="radio" name="ctype" value="disallowed" required <?php if (isset($geoSettings)) {
																															if ($geoSettings['COUNTRY_SELECTION_TYPE'] == 'disallowed') {
																																echo "checked";
																															}
																														} ?>>
														<span></span>
														Disallowed Countires
													</label>
												</div>
											</div>
										</div>
										<div class="column is-6">
											<div class="field">
												<label>Countries </label>
												<div class="control">
													<select class="form-control select2" multiple id="gcountry" name="gcountry[]">
														<option value="">-Select Countries-</option>
														<?php
														$g_arr = explode(',', $geoSettings['COUNTRY_IDS']);
														foreach ($countries as $country) { ?>
															<option <?php
																	if (isset($g_arr)) {
																		if (in_array($country->id, $g_arr)) {
																			echo 'selected="selected"';
																		}
																	}
																	?> value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
														<?php } ?>
													</select>
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

		<?php exit; ?>
