<?php $this->load->view('common/header');?>
<style type="text/css">
	.profile-wrapper .profile-body .settings-section .settings-box{
	width: calc(30% - 16px);
}
</style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/add_store_settings/save_store_settings">
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Edit Store Settings</h3>
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
                                            <h4>Edit Store Basic Info</h4>
                                            <p>Fill the following Store Basic information</p>
                                        </div>

                                                <div class="h-avatar profile-h-avatar is-xl">
                                                    <label>Store Logo *</label>
                                                    <?php if($settings['SITE_LOGO'] != ''){ ?>
    <img src="<?php echo base_url() .$settings['SITE_LOGO'];?>"  alt="" id="display_profile" class="avatar" >
                                                    <?php } else{ ?>
                                                    <img id="display_profile" class="avatar" src="https://via.placeholder.com/150x150"  alt="">
                                                    <?php } ?>
                                                    <div class="filepond-profile-wrap is-hidden">
                                                        <input type="file" id="profile-filepond"  name="profile_filepond" accept="image/png, image/jpeg, image/gif" onchange="loadFile(event)">
                                                    </div>
                                                    <label class="button is-circle edit-button is-edit" href="javascript:void(0);" onclick="file_upload_trigger();" for="profile-filepond">
                                                        <span class="icon is-small">
                                                          <i data-feather="edit-2"></i>
                                                      </span>
                                                    </label>
                                                  <!--   <button class="button is-circle edit-button is-back is-hidden">
                                                        <span class="icon is-small">
                                                          <i data-feather="arrow-left"></i>
                                                      </span>
                                                    </button> -->
                                                </div>
                                            </div>
                                    <div class="form-fieldset" style="max-width: 580px;">
                                        
                                        <div class="columns is-multiline">
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Storefront Name *</label>
                                                    <div class="control">
                                                        <input type="text" id="SITE_TITLE" name="SITE_TITLE" class="input" placeholder="Enter Storefront Name" required value="<?php echo $settings['SITE_TITLE'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Storefront Currency *</label>
                                                     <select class="form-control"
                                                     name="SITE_CURRENCY" id="SITE_CURRENCY">
                                                   	<option value="">-Choose Currency-</option>
                                                   	<?php foreach($currency_details as $currency_detail){ ?> 
													<option value="<?php echo $currency_detail->currency_code;?>" <?php if($currency_detail->currency_code == $settings['SITE_CURRENCY']){?> selected <?php } ?>><?php echo $currency_detail->currency_code;?> (<?php echo $currency_detail->symbol;?>)</option>
												<?php } ?>
													</select>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Storefront Domain *</label>
                                                    <div class="control">
<!-- <input type="text" id="SITE_DOMAIN" name="SITE_DOMAIN" class="input" placeholder="Enter Storefront Domain Name" required value="<?php echo $settings['SITE_DOMAIN'];?>" onchange="frmValidate(this.value,'SITE_DOMAIN');"> -->
<input type="text" id="SITE_DOMAIN" name="SITE_DOMAIN" class="input" placeholder="Enter Storefront Domain Name" required value="<?php echo $settings['SITE_DOMAIN'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Storefront Meta Title *</label>
                                                    <div class="control">
                                                        <input type="text" id="SITE_TITLE" name="SITE_TITLE" class="input" placeholder="Enter Storefront Title" required value="<?php echo $settings['SITE_TITLE'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Storefront Meta Description *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Storefront Description" name="SITE_DESCRIPTION" required><?php echo $settings['SITE_DESCRIPTION'];?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>Contact Name *</label>
                                                    <div class="control">
                                                        <input type="text" id="contact_name" name="CONTACT_NAME" class="input" placeholder="Enter Contact Name" required value="<?php echo $settings['CONTACT_NAME'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Contact Email *</label>
                                                    <div class="control">
                                                        <input type="text" id="contact_email" name="CONTACT_EMAIL" class="input" placeholder="Contact Email" required value="<?php echo $settings['CONTACT_EMAIL'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Contact Phone *</label>
                                                    <div class="control">
                                                        <input type="text" id="contact_phone" name="CONTACT_PHONE" class="input" placeholder="Contact Phone" required value="<?php echo $settings['CONTACT_PHONE'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Country *</label>
                                                    <div class="control">
                                                        <input type="text" id="contact_country" name="CONTACT_COUNTRY" class="input" placeholder="Country" required value="<?php echo $settings['CONTACT_COUNTRY'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>State *</label>
                                                    <div class="control">
                                                        <input type="text" id="contact_state" name="CONTACT_STATE" class="input" placeholder="State" required value="<?php echo $settings['CONTACT_STATE'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>City *</label>
                                                    <div class="control">
                                                        <input type="text" id="contact_city" name="CONTACT_CITY" class="input" placeholder="City" required value="<?php echo $settings['CONTACT_CITY'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Storefront Address *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Storefront Address" name="CONTACT_ADDRESS" required><?php echo $settings['CONTACT_ADDRESS'];?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Contact Phone *</label>
                                                    <div class="control">
                                                        <input type="text" id="contact_phone" name="CONTACT_PHONE" class="input" placeholder="Contact Phone" required value="<?php echo $settings['CONTACT_PHONE'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Store Markup *</label>
                                                    <div class="control">
                                                        <input type="text" id="store_markup" name="STORE_MARKUP" class="input" placeholder="Store Markup" required value="<?php echo $settings['STORE_MARKUP'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                  
                                   <div class="profile-wrapper">
<!-- 
                            <div class="profile-body">

                                <div class="settings-section">
                                    <a class="settings-box" target="_blank" href="<?php echo base_url();?>settings/gateway_settings/add_gateway_settings">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                            <i class="fa fa-cc-mastercard"></i>
                                        </div>
                                        <span>Payment Gateway</span>
                                        <h3>Payment Gateway Settings</h3>
                                    </a>
                                    <a class="settings-box" target="_blank" href="<?php echo base_url();?>settings/api_settings/add_api_settings">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                          <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                        </div>
                                        <span>Social Login</span>
                                        <h3>Social Login Settings</h3>
                                    </a>
                                    <a class="settings-box" target="_blank" href="<?php echo base_url();?>settings/currency/list_currency">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                            <i class="fa fa-gbp" aria-hidden="true"></i>
                                        </div>
                                        <span>Currency</span>
                                        <h3>Currency Settings</h3>
                                    </a>
									<a class="settings-box" target="_blank" href="<?php echo base_url();?>home/geo_ip_settings/add">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                            <i class="fa fa-server" aria-hidden="true"></i>
                                        </div>
                                        <span>GEO IP</span>
                                        <h3>GEO IP Settings</h3>
                                    </a>
									<a class="settings-box" target="_blank" href="<?php echo base_url();?>settings/static_pages/add">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </div>
                                        <span>Pages</span>
                                        <h3>Static Pages</h3>
                                    </a>
                                </div>

                            </div>
 -->
                        </div>
                                    </div>
                                    <!--Fieldset-->
                                                                   </div>
                            </div>
                        </div>

                      
                    </form>
                    </div>

                <?php $this->load->view('common/footer');?>
                <script type="text/javascript">

                    function frmValidate(domainName,id) {
        if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(domainName)) {
            return true;
        } else {
            $("#"+id).val("");
            domainName.name.focus();
            return false;
        }
    }

              
                </script>
				<?php exit;?>
