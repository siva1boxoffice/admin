        <?php $this->load->view('common/header');?>
  <style>
      .form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 6px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 2px;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
  </style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative has-loader">

                    <div class="h-loader-wrapper">
                            <div class="loader is-small is-loading"></div>
                            </div>
                    <?php
                    // echo "<pre>";print_r($admin_profile_info);?>

                     <div class="page-content-inner">

                        <!--Edit Profile-->
                        <div class="account-wrapper">
                            <div class="columns">

                                <!--Navigation-->
                                <div class="column is-4">
                                    <div class="account-box is-navigation">
                                        <div class="media-flex-center">
                                            <div class="h-avatar is-large">

<?php if($admin_profile_info->admin_profile_pic != ''){ ?>
<img src="<?php echo $admin_profile_info->admin_profile_pic;?>"  alt="" id="display_profile" class="avatar" >
<?php } else{ ?>
<img class="avatar" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/8.jpg" alt="">
<?php } ?>

                                                
                                            </div>
                                            <div class="flex-meta">
                                                <span><?php echo $this->session->userdata('admin_name'); ?></span>
                                                <?php if($this->session->userdata('role') == '5'){?>
                                                <span>Admin</span>
                                                <?php } ?>
                                                <?php if($this->session->userdata('role') == '1'){ ?>
                                                <span>Seller</span>
                                                <?php } ?>
                                                 <?php if($this->session->userdata('role') == '2'){ ?>
                                                <span>Partners</span>
                                                <?php } ?>
                                                 <?php if($this->session->userdata('role') == '3'){ ?>
                                                <span>Afiliates</span>
                                                <?php } ?>
                                                 <?php if($this->session->userdata('role') == '4'){ ?>
                                                <span>Storefronts</span>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="account-menu">
                                            <a href="<?php echo base_url();?>home/profile/manage_profile/1" class="account-menu-item <?php if($flag == '1'){ ?> is-active <?php } ?>">
                                                <i class="lnil lnil-user-alt"></i>
                                                <span>General</span>
                                                <span class="end">
                                                  <i aria-hidden="true" class="fas fa-arrow-right"></i>
                                              </span>
                                            </a>
                                            <a href="<?php echo base_url();?>home/profile/manage_profile/2" class="account-menu-item <?php if($flag == '2'){ ?> is-active <?php } ?>">
                                                <i class="fa fa-address-book-o" aria-hidden="true"></i>
                                                <span>Address</span>
                                                <span class="end">
                                                  <i aria-hidden="true" class="fas fa-arrow-right"></i>
                                              </span>
                                            </a>
                                            <a href="<?php echo base_url();?>home/profile/manage_profile/3" class="account-menu-item <?php if($flag == '3'){ ?> is-active <?php } ?>">
                                                <i class="lnil lnil-cog"></i>
                                                <span>Login Access</span>
                                                <span class="end">
                                                  <i aria-hidden="true" class="fas fa-arrow-right"></i>
                                              </span>
                                            </a>
                                              <a href="<?php echo base_url();?>home/profile/manage_profile/4" class="account-menu-item <?php if($flag == '4'){ ?> is-active <?php } ?>">
                                                <i class="lnil lnil-bank"></i>
                                                <span>Bank Details</span>
                                                <span class="end">
                                                  <i aria-hidden="true" class="fas fa-arrow-right"></i>
                                              </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!--Form-->
                                <div class="column is-8">
                                    <div class="account-box is-form is-footerless">
        <form id="profile-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>home/profile/update_profile">
                                            <input type="hidden" name="flag" value="<?php echo $flag;?>">
                                            <input type="hidden" name="address_details_id" value="<?php echo $admin_profile_info->address_details_id;?>">
                                            
                                        <div class="form-head stuck-header">
                                            <div class="form-head-inner">
                                                <div class="left">
                                                    <?php if($flag == '1'){ ?>
                                                    <h3>General Info</h3>
                                                    <p>Edit your account's general information</p>
                                                     <?php } ?>
                                                     <?php if($flag == '2'){ ?>
                                                    <h3>Address Info</h3>
                                                    <p>Edit your account's Address information</p>
                                                     <?php } ?>
                                                     <?php if($flag == '3'){ ?>
                                                    <h3>Login Access</h3>
                                                    <p>Edit your account's Login information</p>
                                                     <?php } ?>
                                                      <?php if($flag == '4'){ ?>
                                                    <h3>Bank Details</h3>
                                                    <p>Edit your Bank's information</p>
                                                     <?php } ?>
                                                </div>
                                                <div class="right">
                                                    <div class="buttons">
                                                        <a href="<?php echo base_url();?>home/profile/edit_profile" class="button h-button is-light is-dark-outlined">
                                                            <span class="icon">
                                                              <i class="lnir lnir-arrow-left rem-100"></i>
                                                          </span>
                                                            <span>Go Back</span>
                                                        </a>
                                                        <button id="save-button" class="button h-button is-primary is-raised">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <?php if($flag == '1'){ ?>
                                            <!--Fieldset-->
                                            <div class="fieldset">
                                                <div class="fieldset-heading">
                                                    <h4>Profile Picture</h4>
                                                    <p>This is how others will recognize you</p>
                                                </div>

                                                <div class="h-avatar profile-h-avatar is-xl">

                                                    <?php if($admin_profile_info->admin_profile_pic != ''){ ?>
    <img src="<?php echo $admin_profile_info->admin_profile_pic;?>"  alt="" id="display_profile" class="avatar" >
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
                                            <!--Fieldset-->
                                            <div class="fieldset">
                                                <div class="fieldset-heading">
                                                    <h4>Personal Info</h4>
                                                    <p>Others diserve to know you more</p>
                                                </div>

                                                <div class="columns is-multiline">
                                                    <!--Field-->
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="First Name" name="first_name" value="<?php echo $admin_profile_info->admin_name;?>">
                                                                <div class="form-icon">
                                                                    <i data-feather="user"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Field-->
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Last Name" name="last_name" value="<?php echo $admin_profile_info->admin_last_name;?>">
                                                                <div class="form-icon">
                                                                    <i data-feather="user"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Field-->
                                                     <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input disabled type="email" class="input" placeholder="Email" value="<?php echo $admin_profile_info->admin_email;?>">
                                                                <div class="form-icon">
                                                                    <i class="lnir lnir-global"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input disabled type="text" class="input" placeholder="Mobile No." value="<?php echo $admin_profile_info->admin_cell_phone;?>">
                                                                <div class="form-icon">
                                                                    <i class="lnir lnir-mobile-alt-1"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                     <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" name="company_name" class="input" placeholder="Company Name." value="<?php echo $admin_profile_info->company_name;?>">
                                                                <div class="form-icon">
                                                                  <i class="lnil lnil-briefcase"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" name="company_url" class="input" placeholder="Company Url." value="<?php echo $admin_profile_info->company_url;?>">
                                                                <div class="form-icon">
                                                                    <i class="lnil lnil-Website"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php } ?>
                                            <!--Fieldset-->
                                             <?php if($flag == '2'){ ?>
                                            <div class="fieldset">
                                                <div class="fieldset-heading">
                                                    <h4>Address Info</h4>
                                                    <p>This can help you to identify your location</p>
                                                </div>
                                                 <div class="columns is-multiline">
                                                    <!--Field-->
                                                      <div class="column is-12">
                                                        <div class="field">
                                                             <div class="control">
                                                                <select class="form-control" id="country" name="country" onchange="get_state(this.value);" >
                                                                    <option value="">-Select Country-</option>
                                                                    <?php foreach($country_lists as $country_list){ ?>
                                                                    <option value="<?php echo $country_list->id;?>" <?php if($country_list->id == $admin_profile_info->country){?> selected <?php } ?>><?php echo $country_list->name;?></option>
                                                                    <?php } ?>
                                                                </select>

                                                               
                                                            </div>
                                                     </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                             <div class="control">
                                                                <select class="form-control" id="state" name="state" onchange="get_city(this.value);">
                                                                     <option value="">-Select State-</option>
                                                                </select>
                                                            </div>
                                                     </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                             <div class="control">
                                                                <select class="form-control" id="city" name="city">
                                                                 <option value="">-Select City-</option>
                                                                </select>
                                                            </div>
                                                     </div>
                                                    </div>

                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Zip Code." name="zip_code" value="<?php echo $admin_profile_info->zip_code;?>">
                                                                <div class="form-icon">
                                                                    <i class="lnir lnir-postcard"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control">
                                                                <textarea class="textarea" rows="4" placeholder="Address" name="address"><?php echo $admin_profile_info->address;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
 
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <!--Fieldset-->
                                            <?php if($flag == '3'){ ?>
                                            <div class="fieldset">
                                                <div class="fieldset-heading">
                                                    <h4>Login Access</h4>
                                                    <p>This can help to login your account</p>
                                                </div>
                                                <div class="columns is-multiline">
                                                  
                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Password" name="password">
                                                                <div class="form-icon">
                                                                    <i class="lnir lnir-lock-alt-1"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Confirm Password" name="cpassword">
                                                                <div class="form-icon">
                                                                   <i class="lnir lnir-key"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                   
                                                   
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if($flag == '4'){ ?>
                                            <div class="fieldset">
                                                <div class="fieldset-heading">
                                                    <h4>Bank Details</h4>
                                                    <p>This can help to Manage your Bank account</p>
                                                </div>
                                                <div class="columns is-multiline">
                                                  
                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Beneficiary Full Name
" name="beneficiary_name" value="<?php echo $admin_profile_info->beneficiary_name;?>">
                                                                <div class="form-icon">
                                                                   <i class="lnil lnil-user-alt-1"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Bank Name" name="bank_name" value="<?php echo $admin_profile_info->bank_name;?>">
                                                                <div class="form-icon">
                                                                   <i class="lnir lnir-bank"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="IBAN Number
" name="iban_number" value="<?php echo $admin_profile_info->iban_number;?>">
                                                                <div class="form-icon">
                                                                    <i class="lnir lnir-menu-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Beneficiary Address
" name="beneficiary_address" value="<?php echo $admin_profile_info->beneficiary_address;?>">
                                                                <div class="form-icon">
                                                                    <i class="fas fa-address-card"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Bank Address" name="bank_address" value="<?php echo $admin_profile_info->bank_address;?>">
                                                                <div class="form-icon">
                                                                   <i class="fas fa-address-book"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Account Number
" name="account_number" value="<?php echo $admin_profile_info->account_number;?>">
                                                                <div class="form-icon">
                                                                    <i class="fas fa-sort-numeric-asc"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="BIC / SWIFT Code
" name="swift_code" value="<?php echo $admin_profile_info->swift_code;?>">
                                                                <div class="form-icon">
                                                                    <i class="fas fa-barcode"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                   
                                                   
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <script type="text/javascript">
                    var base_url = "<?php echo base_url();?>";
                    var country    = "<?php echo $admin_profile_info->country;?>";
                    var state    = "<?php echo $admin_profile_info->state;?>";
                    var city    = "<?php echo $admin_profile_info->city;?>";
                    </script>

                <?php $this->load->view('common/footer');?>

                 <script type="text/javascript">
        
        $( document ).ready(function() {
        
<?php if($admin_profile_info->state != ''){ ?> 
 get_state("<?php echo $admin_profile_info->country;?>");
<?php } ?>
<?php if($admin_profile_info->city != ''){ ?> 
 get_city("<?php echo $admin_profile_info->state;?>");
<?php } ?>
});

      var loadFile = function(event) {

      var output = document.getElementById('display_profile');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
      }

      };
                </script>

                