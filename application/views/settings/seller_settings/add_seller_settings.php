<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/seller_settings/save_markup">
                            <input type="hidden" name="id" value="<?php echo $markup->id;?>">
                            <input type="hidden" name="role" value="<?php echo $role;?>">
                         
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New Markup</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                            	<?php if($role == 1){ ?>
                                                <a href="<?php echo base_url();?>settings/seller_settings/seller_settings_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Markup</span>
                                                </a>
                                            <?php } ?>
                                            <?php if($role == 2){ ?>
                                                <a href="<?php echo base_url();?>settings/seller_settings/partner_settings_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Markup</span>
                                                </a>
                                            <?php } ?>
                                            <?php if($role == 3){ ?>
                                                <a href="<?php echo base_url();?>settings/seller_settings/afliliate_settings_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Markup</span>
                                                </a>
                                            <?php } ?>
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
                                            <h4>Markup Info</h4>
                                            <p>Fill the Markup information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                        	<?php if($this->session->userdata('role') == 6){ ?>
                                             <div class="column is-6">
                                                <div class="field">
                                                	<?php if($role == 1){ ?>
                                                    <label>Seller *</label>
                                                	<?php } ?>
                                                	<?php if($role == 2){ ?>
                                                    <label>Partner *</label>
                                                	<?php } ?>
                                                	<?php if($role == 3){ ?>
                                                    <label>Afliliate *</label>
                                                	<?php } ?>
                                                   <select class="form-control select2"  name="user_id" id="user_id">
                                                   	<?php if($role == 1){ ?>
                                                   	<option value="">-Choose Seller-</option>
                                                   	<?php } ?>
                                                   	<?php if($role == 2){ ?>
                                                    <option value="">-Choose Partner-</option>
                                                	<?php } ?>
                                                	<?php if($role == 3){ ?>
                                                    <option value="">-Choose Afliliate-</option>
                                                	<?php } ?>
                                                   	<?php foreach($sellers as $seller){ ?>
                                                   	 <?php if($role == $seller->admin_role_id){?> 
													<option value="<?php echo $seller->admin_id;?>" <?php if($markup->user_id == $seller->admin_id){?> selected <?php } ?>><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
													<?php } ?>
												<?php } ?>
													</select>
                                                </div>
                                            </div>
                                        <?php } ?>
                                       <?php if($this->session->userdata('role') != 6){ ?>
                                       	 <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata('admin_id');?>" >
                                       <?php } ?>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Markup in % *</label>
                                                    <div class="control">
                                                        <input type="text" id="markup" name="markup" class="input" placeholder="Enter Markup" required value="<?php echo $markup->markup;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Markup Status *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="status" value="1" 
<?php if($markup->status == 1){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Markup Status</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>

                                            
                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                        </div>
                                    </div>
                                   
                                    
                                                                   </div>
                            </div>
                        </div>

                      
                    </form>
                    </div>
                <?php $this->load->view('common/footer');?>
                       
                
				<?php exit;?>