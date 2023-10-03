        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Game Category" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative business-dashboard course-dashboard">
        			<div class="page-content-inner">
        				<div class="flex-list-wrapper">

                            <!--Form Layout 1-->
                            <div class="form-layout">
                                <div class="form-outer has-loader">

                                     <!--Loader-->
                                            <div class="h-loader-wrapper">
                                                <div class="loader is-small is-loading"></div>
                                            </div>

                                    <form id="category-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>game/category/save_category">
                                        <input type="hidden" name="category_id" value="<?php if (isset($category_details->id)) {
                                                                                            echo $category_details->id;
                                                                                        } ?>">
                                        <div class="form-header stuck-header">
                                            <div class="form-header-inner">
                                                <div class="left">
                                                    <h3>Create New Game Category</h3>
                                                </div>
                                                <div class="right">
                                                    <div class="buttons">
                                                        <a href="<?php echo base_url(); ?>game/category/list_category" class="button h-button is-light is-dark-outlined">
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
                                                    <h4>Game Category Info</h4>
                                                </div>

        										<div class="columns is-multiline">
        											<div class="column is-6">
        												<div class="field">
        													<label>Category Name</label>
        													<div class="control has-icon">
        														<input type="text" required class="input" minlength="2" placeholder="Category Name" id="category_name" name="category_name" value="<?php if (isset($category_details->category)) {
																																																echo $category_details->category;
																																															} ?>">
        														<div class="form-icon">
        															<i class="fas fa-list"></i>
        														</div>
        													</div>
        												</div>
        											</div>
        											<div class="column is-6">
        												<div class="field">
        													<label>Category Status</label>
        													<div class="control has-icon">
        														<div class="select">
        															<select name="status" id="status" required>
        																<option value="1" <?php if (isset($category_details->status)) {
																								if ($category_details->status == '1') {
																									echo "selected";
																								}
																							} ?>>Active</option>
        																<option value="0" <?php if (isset($category_details->status)) {
																								if ($category_details->status == '0') {
																									echo "selected";
																								}
																							} ?>>Inactive</option>

        															</select>
        														</div>
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
                    <?php exit;?>
