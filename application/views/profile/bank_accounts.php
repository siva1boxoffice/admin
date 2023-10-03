        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative">

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
                                                <?php if($this->session->userdata('admin_type') != 'SUB ADMIN'){?>
                                                <span>Admin</span>
                                                <?php } ?>
                                                <?php if($this->session->userdata('admin_type') == 'SUB ADMIN'){?>
                                                <span>Seller</span>
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
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="email" class="input" placeholder="Email" value="<?php echo $admin_profile_info->admin_email;?>" disabled>
                                                                <div class="form-icon">
                                                                    <i data-feather="briefcase"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Mobile No." value="<?php echo $admin_profile_info->admin_cell_phone;?>" disabled>
                                                                <div class="form-icon">
                                                                    <i data-feather="map-pin"></i>
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
                                                                <div class="h-select">
                                                                    <div class="select-box">
                                                                        <span>Country</span>
                                                                    </div>
                                                                    <div class="select-icon">
                                                                        <i data-feather="chevron-down"></i>
                                                                    </div>
                                                                    <div class="select-drop has-slimscroll-sm">
                                                                        <div class="drop-inner">
                                                                           
                                                                            <div class="option-row">
                <input type="radio" name="country" value="<?php echo $admin_profile_info->country;?>">
                                                                                <div class="option-meta">
                                                                                    <span>10+ years</span>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                     </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                             <div class="control">
                                                                <div class="h-select">
                                                                    <div class="select-box">
                                                                        <span>State</span>
                                                                    </div>
                                                                    <div class="select-icon">
                                                                        <i data-feather="chevron-down"></i>
                                                                    </div>
                                                                    <div class="select-drop has-slimscroll-sm">
                                                                        <div class="drop-inner">
                                                                           
                                                                            <div class="option-row">
                    <input type="radio" name="state" value="<?php echo $admin_profile_info->state;?>">
                                                                                <div class="option-meta">
                                                                                    <span>10+ years</span>
                                                                                </div>
                                                                            </div>

                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                     </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                             <div class="control">
                                                                <div class="h-select">
                                                                    <div class="select-box">
                                                                        <span>City</span>
                                                                    </div>
                                                                    <div class="select-icon">
                                                                        <i data-feather="chevron-down"></i>
                                                                    </div>
                                                                    <div class="select-drop has-slimscroll-sm">
                                                                        <div class="drop-inner">
                                                                           
                                                                            <div class="option-row">
            <input type="radio" name="city" value="<?php echo $admin_profile_info->city;?>">
                                                                                <div class="option-meta">
                                                                                    <span>10+ years</span>
                                                                                </div>
                                                                            </div>

                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                     </div>
                                                    </div>

                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Zip Code." name="zip_code" value="<?php echo $admin_profile_info->zip_code;?>">
                                                                <div class="form-icon">
                                                                    <i data-feather="map-pin"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Field-->
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
                                                                <input type="text" class="input" placeholder="old Password" name="old_password">
                                                                <div class="form-icon">
                                                                    <i class="lnil lnil-lock-alt"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="New Password" name="new_password">
                                                                <div class="form-icon">
                                                                   <i class="lnil lnil-lock-alt"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Confirm Password" name="cpassword">
                                                                <div class="form-icon">
                                                                    <i class="lnil lnil-lock-alt"></i>
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

                <?php $this->load->view('common/footer');?>

                <script type="text/javascript">
                   

      var loadFile = function(event) {

      var output = document.getElementById('display_profile');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
      }

      };
                </script>

                