        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Email Permissions" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative has-loader">
        			<div class="h-loader-wrapper">
        				<div class="loader is-small is-loading"></div>
        			</div>
        			<div class="page-content-inner">
        				<div class="form-layout">
        					<div class="form-outer">
        						<form id="profile-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>settings/save_email_permission">
        							<div class="form-header stuck-header">
        								<div class="form-header-inner">
        									<div class="left">
        										<h3>Set Email Permission</h3>
        									</div>
        									<div class="right">
        										<div class="buttons">
        											<a href="<?php echo base_url(); ?>home/index" class="button h-button is-light is-dark-outlined">
        												<span class="icon">
        													<i class="lnir lnir-arrow-left rem-100"></i>
        												</span>
        												<span>Cancel</span>
        											</a>
        											<button id="save-button" class="button h-button is-primary is-raised">Save Changes</button>
        										</div>
        									</div>
        								</div>
        							</div>
        							<div class="form-body">
        								<table id="" class="table is-datatable is-hoverable table-is-bordered menu_list">
        									<thead>
        										<tr>
        											<th>Email Type
        											</th>
        											<?php foreach ($roles as $role) { ?>
        												<th><?php echo $role->admin_role_name; ?></th>
        											<?php } ?>

        										</tr>
        									</thead>
        									<tbody>
        										<?php

												$CI = &get_instance();
												$CI->load->model('General_Model');
												$email_types = $CI->General_Model->getAllItemTable('email_types')->result();
												for ($k = 0; $k < count($email_types); $k++) { ?>
        											<tr>
        												<td><?php echo ucfirst($email_types[$k]->email_type); ?></td>
        												<?php foreach ($roles as $rkey => $role) { ?>
        													<td>
        														<div class="control">
        															<label class="checkbox">
        																<?php
																		$checked = '';
																		if (count($active_functions[$role->admin_role_id]) > 0) {
																			if (in_array($email_types[$k]->id, $active_functions[$role->admin_role_id])) {
																				$checked = 'checked="checked"';
																			}
																		}
																		?>
        																<input type="checkbox" name="privilege[<?php echo $role->admin_role_id; ?>][]" value="<?php echo $email_types[$k]->id; ?>" <?php echo $checked; ?>>
        																<span></span>
        															</label>
        														</div>
        													</td>
        												<?php } ?>
        											</tr>
        										<?php } ?>
        									</tbody>
        								</table>
        							</div>
        						</form>
        					</div>
        				</div>
        			</div>
        			<?php $this->load->view('common/footer'); ?>
        			<?php exit; ?>
