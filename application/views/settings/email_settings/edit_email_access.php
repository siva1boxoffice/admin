<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/email_settings/save_email_settings">
                            <input type="hidden" name="id" value="<?php echo $email_access->id;?>">
                         
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Edit Email Access</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>settings/email_settings/email_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Email Access</span>
                                                </a>
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
                                            <h4>Email Access Info</h4>
                                            <p>Fill the following Team information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>SMTP *</label>
                                                    <div class="control">
                                                        <input type="text" id="smtp" name="smtp" class="input" placeholder="Enter smtp" required value="<?php echo $email_access->smtp;?>">
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>Host *</label>
                                                    <div class="control">
                                                        <input type="text" id="host" name="host" class="input" placeholder="Enter Host" required value="<?php echo $email_access->host;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Port *</label>
                                                    <div class="control">
                                                        <input type="text" id="port" name="port" class="input" placeholder="port no." required value="<?php echo $email_access->port;?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>username *</label>
                                                    <div class="control">
                                                        <input type="text" id="topic" name="username" class="input" placeholder="username" required value="<?php echo $email_access->username;?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>password *</label>
                                                    <div class="control">
                                                        <input type="text" id="topic" name="password" class="input" placeholder="password" required value="<?php echo $email_access->password;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Email Access Status *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="status" value="1" 
<?php if($email_access->status == '1'){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Access Status</span>
                                                                    </div>
                                                                </div>
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