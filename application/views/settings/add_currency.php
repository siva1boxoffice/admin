        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Currency" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
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
                                    <form id="category-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/currency/save_currency">
                                        <input type="hidden" name="currency_id" value="<?php if (isset($currency_details->id)) {
                                                                                            echo $currency_details->id;
                                                                                        } ?>">
                                        <div class="form-header stuck-header">
                                            <div class="form-header-inner">
                                                <div class="left">
                                                    <h3>Add New Currency Type</h3>
                                                </div>
                                                <div class="right">
                                                    <div class="buttons">
                                                        <a href="<?php echo base_url(); ?>settings/currency/list_currency" class="button h-button is-light is-dark-outlined">
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
                                                    <h4>Currency Info</h4>
                                                </div>

                                                <div class="columns is-multiline">
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Currency Name</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" required placeholder="Currency Name" id="currency_name" name="currency_name" value="<?php if (isset($currency_details->name)) {
                                                                                                                                                                                echo $currency_details->name;
                                                                                                                                                                            } ?>">
                                                                <div class="form-icon">
                                                                    <i class="fas fa-dollar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Currency Code</label>
                                                            <div class="control ">
                                                                <input type="text" required class="input" placeholder="Currency code. Ex: USD, EUR, GBP" id="currency_code" name="currency_code" value=" <?php if (isset($currency_details->currency_code)) {
                                                                                                                                                                                                                                                echo $currency_details->currency_code;
                                                                                                                                                                                                                                            } ?>">
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Currency Symbol</label>
                                                            <div class="control ">
                                                                <input type="text" class="input" required placeholder="Currency symbol" id="currency_symbol" name="currency_symbol" value=" <?php if (isset($currency_details->symbol)) {
                                                                                                                                                                                                                                                echo $currency_details->symbol;
                                                                                                                                                                                                                                            } ?>">
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Price diffence between Pound £</label>
                                                            <div class="control ">
                                                                <input type="text" required class="input" placeholder="Price diffence between Pound £" id="difference" name="difference" value=" <?php if (isset($currency_details->price_difference)) {
                                                                                                                                                                                                                                                echo $currency_details->price_difference;
                                                                                                                                                                                                                                            } ?>">
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Currency Status</label>
                                                            <div class="control has-icon">
                                                                <div class="select">
                                                                    <select class="form-control" name="status" id="status" required>
																		<option value="" selected>Select</option>
                                                                        <option value="1" <?php if (isset($currency_details->status)) {
                                                                                                if ($currency_details->status == '1') {
                                                                                                    echo "selected";
                                                                                                }
                                                                                            } ?>>Active</option>
                                                                        <option value="0" <?php if (isset($currency_details->status)) {
                                                                                                if ($currency_details->status == '0') {
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
