<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/api_settings/save_api_settings">
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Edit Social Login Settings</h3>
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
                                            <h4>Edit Social Login Info</h4>
                                            <p>Fill the following Social Login information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Facebook App ID *</label>
                                                    <div class="control">
                                                        <input type="text" id="FACEBOOK_ID" name="FACEBOOK_ID" class="input" placeholder="Enter Facebook App ID" required value="<?php echo $apis['FACEBOOK_ID'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>Facebook App Secret *</label>
                                                    <div class="control">
                                                        <input type="text" id="FACEBOOK_KEY" name="FACEBOOK_KEY" class="input" placeholder="Enter Facebook App Secret" required value="<?php echo $apis['FACEBOOK_KEY'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Google Client ID *</label>
                                                    <div class="control">
                                                        <input type="text" id="GOOGLE_ID" name="GOOGLE_ID" class="input" placeholder="Google Client ID." required value="<?php echo $apis['GOOGLE_ID'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Google Client Secret *</label>
                                                    <div class="control">
                                                        <input type="text" id="GOOGLE_KEY" name="GOOGLE_KEY" class="input" placeholder="Google Client Secret" required value="<?php echo $apis['GOOGLE_KEY'];?>">
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