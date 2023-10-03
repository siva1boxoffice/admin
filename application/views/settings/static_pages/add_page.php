        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Page" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
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
        							<form id="static-page-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/static_pages/save">
        								<input type="hidden" name="page_id" value="<?php if (isset($page_details->id)) {
																						echo $page_details->id;
																					} ?>">
        								<div class="form-header stuck-header">
        									<div class="form-header-inner">
        										<div class="left">
        											<h3>Add New Page</h3>
        										</div>
        										<div class="right">
        											<div class="buttons">
        												<a href="<?php echo base_url(); ?>settings/static_pages" class="button h-button is-light is-dark-outlined">
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
        											<h4>Page Info</h4>
        										</div>

        										<div class="columns is-multiline">
        											<div class="column is-6">
        												<div class="field">
        													<label>Page Type</label>
        													<div class="control has-icon">
        														<select class="form-control select2" id="ptype" name="ptype" required>
        															<option value="">-Select Page Type-</option>
        															<?php foreach ($page_types as $page_type) { ?>
        																<option value="<?php echo $page_type->page_type_id; ?>" <?php if (isset($page_details->page_type)) {
																																	if ($page_type->page_type_id == $page_details->page_type) {
																																		echo ' selected  ';
																																	}
																																} ?>><?php echo $page_type->page_type_name; ?></option>
        															<?php } ?>
        														</select>

        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>Status</label>
        													<div class="control has-icon">
        														<div class="switch-block no-padding-all">
        															<label class="form-switch is-primary">
        																<input type="checkbox" class="is-switch" name="status" value="1" <?php if (isset($page_details->status)) {
																																				if ($page_details->status == 1) { ?> checked <?php }
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
        											<div class="column is-12">
        												<div class="field">
        													<label>Page Title</label>
        													<div class="control ">
        														<input type="text" required class="input" placeholder="Page Ttitle" id="title" name="title" value="<?php if (isset($page_details->title)) {
																																										echo $page_details->title;
																																									} ?>">

        													</div>

        												</div>
        											</div>

        											<div class="column is-12">
        												<div class="field">
        													<label>Page Content </label>
        													<div class="control">
        														<textarea required id="page_content" rows="4" placeholder="Page Content" name="page_content"><?php if (isset($page_details->description)) {
																																									echo $page_details->description;
																																								} ?></textarea>
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
        				$('#page_content').summernote({
        					placeholder: 'Page Content',
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
