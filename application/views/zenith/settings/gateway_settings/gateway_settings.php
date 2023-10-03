<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/gateway_settings/save_gateway_settings">
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Edit Gateway Settings</h3>
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
                                            <h4>Edit Gateway Info</h4>
                                            <p>Fill the following Gateway information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Paypal ID *</label>
                                                    <div class="control">
                                                        <input type="text" id="PAYPAL_ID" name="PAYPAL_ID" class="input" placeholder="Enter Paypal ID" required value="<?php echo $gateways['PAYPAL_ID'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>Paypal KEY *</label>
                                                    <div class="control">
                                                        <input type="text" id="PAYPAL_KEY" name="PAYPAL_KEY" class="input" placeholder="Enter Paypal Gateway Url" required value="<?php echo $gateways['PAYPAL_KEY'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Network Merchant ID *</label>
                                                    <div class="control">
                                                        <input type="text" id="NETWORK_ID" name="NETWORK_ID" class="input" placeholder="Network Merchant ID." required value="<?php echo $gateways['NETWORK_ID'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Network Merchant Key *</label>
                                                    <div class="control">
                                                        <input type="text" id="NETWORK_KEY" name="NETWORK_KEY" class="input" placeholder="Network Merchant Key" required value="<?php echo $gateways['NETWORK_KEY'];?>">
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

                <?php $this->load->view('common/footer');?>
                
				<?php exit;?>