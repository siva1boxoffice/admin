  <style>
 /*     .form-control {
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
}*/
.control>label {
color: #000 !important;
}
  </style>
        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative has-loader">

          <!--Loader-->
                    <div class="h-loader-wrapper">
                        <div class="loader is-small is-loading"></div>
                    </div>

                        <?php //echo "<pre>";print_r($user);?>
                     <div class="page-content-inner">
                          <form id="profile-form" method="post" class="validate_form_v2 form_req_validation login-wrapper" action="<?php echo base_url();?>home/save_my_accounts">
                        <input type="hidden" name="admin_id" value="<?php echo $user->user_id;?>">
                        <input type="hidden" name="address_details_id" value="<?php echo $user->address_details_id;?>">
                        <!--Edit Profile-->
                         <div class="account-wrapper Personal_info">
                            <div class="columns">

                                <!--Form-->
                                <div class="column is-6">
                                    <div class="account-box is-form is-footerless">
                                        <div class="form-body">

                                            <!--Fieldset-->
                                            <div class="fieldset">
                                                <div class="fieldset-heading">
                                                    <h4>Personal Info</h4>
                                                </div>

                                                <div class="columns is-multiline">
                                                    <!--Field-->
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>First Name *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="First Name" name="first_name" value="<?php echo $user->admin_name;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Field-->
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Last Name *</label>
                                                            <div class="control has-icon">
                                                                  <input type="text" class="input" placeholder="Last Name" name="last_name" value="<?php echo $user->admin_last_name;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>Email *</label>
                                                            <div class="control has-icon">
                                                                <input type="email" name="email" class="input" placeholder="Email" value="<?php echo $user->admin_email;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Area Code *</label>
                                                            <div class="control">
                                                               
                                                                <select class="form-control select2" id="area_code" name="area_code" required >
                                                            <?php foreach($country_lists as $country){ ?>
                                                            <option value="<?php echo $country->phonecode;?>" <?php if($user->phone_code == $country->phonecode){?> selected <?php } ?>><?php echo $country->countryid;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Field-->
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Phone *</label>
                                                            <div class="control has-icon">
                                                               <input type="text" name="mobile_no" class="input" placeholder="Mobile No." value="<?php echo $user->admin_cell_phone;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Company *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" name="company_name" class="input" placeholder="Company Name." value="<?php echo $user->company_name;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Website *</label>
                                                            <div class="control has-icon">
                                                               <input type="text" name="company_url" class="input" placeholder="Company Url." value="<?php echo $user->company_url;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>Company Address *</label>
                                                            <div class="control has-icon">
                                                                <textarea class="textarea" rows="4" placeholder="Address" name="address" required><?php echo $user->address;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Zipcode *</label>
                                                            <div class="control has-icon">
                                                               <input type="text" class="input" placeholder="Zip Code." name="zip_code" value="<?php echo $user->zip_code;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Country *</label>
                                                            <div class="control">
                                                                 <select class="form-control select2" id="country" name="country" onchange="get_state(this.value);" required>
                                                                    <option value="">-Select Country-</option>
                                                                    <?php foreach($country_lists as $country_list){ ?>
                                                                    <option value="<?php echo $country_list->id;?>" <?php if($country_list->id == $user->country){?> selected <?php } ?>><?php echo $country_list->name;?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>State / Province *</label>
                                                            <div class="control">
                                                              <select class="form-control select2" id="state" name="state" onchange="get_city(this.value);" required>
                                                                     <option value="">-Select State-</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>City *</label>
                                                            <div class="control has-icon">
                                                                <select class="form-control select2" id="city" name="city" required>
                                                                 <option value="">-Select City-</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Password </label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Password" name="password">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-6">
                                                        <div class="field">
                                                            <label>Confirm Password </label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Confirm Password" name="cpassword">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="column is-6">
                                                        <div class="field">
                                                        <div class="control">
                                                      <!--   <label class="checkbox">
                                                        <input type="checkbox" value="1" name="ignore_password_update">
                                                        <span></span>
                                                        Ignore Password Update
                                                        </label> -->
                                                        <label class="checkbox is-outlined is-primary" style="padding:5px 0px">
                                                    <input type="checkbox" name="ignore_password_update" value="1">
                                                    <span></span>
                                                    Ignore Password Update
                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--Navigation-->
                                <div class="column is-6">
                                    <div class="account-box is-form is-footerless">
                                        <div class="form-body">

                                            <!--Fieldset-->
                                            <div class="fieldset">
                                                <div class="fieldset-heading">
                                                    <h4>Payment Method :Bank Transfer</h4>
                                                </div>

                                                <div class="columns is-multiline">


                                                   
                                                    <div class="column is-4">
                                                        <div class="field">
                                                            <div class="project-grid-item-sell">
                                                                <label>
                                                                <input type="radio" name="currency" value="EUR" <?php if($user->seller_currency == "EUR"){?> checked <?php } ?>>
                                                                <span></span> <i class="fas fa-euro-sign"></i> EUR
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-4">
                                                        <div class="field">
                                                            <div class="project-grid-item-sell">
                                                                <label>
                                                                <input type="radio" name="currency" value="GBP" <?php if($user->seller_currency == "GBP"){?> checked <?php } ?>>
                                                                <span></span> <i class="fas fa-pound-sign"></i> GBP
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>Beneficiary Full Name *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Beneficiary Full Name
" name="beneficiary_name" value="<?php echo $user->beneficiary_name;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>Bank Name *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Bank Name" name="bank_name" value="<?php echo $user->bank_name;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>IBAN Number *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="IBAN Number
" name="iban_number" value="<?php echo $user->iban_number;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>Beneficiary Address *</label>
                                                            <div class="control has-icon">
                                                                  <input type="text" class="input" placeholder="Beneficiary Address
" name="beneficiary_address" value="<?php echo $user->beneficiary_address;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>Bank Address *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Bank Address" name="bank_address" value="<?php echo $user->bank_address;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>Account Number *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="Account Number
" name="account_number" value="<?php echo $user->account_number;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Field-->
                                                    <div class="column is-12">
                                                        <div class="field">
                                                            <label>BIC / SWIFT Code *</label>
                                                            <div class="control has-icon">
                                                                <input type="text" class="input" placeholder="BIC / SWIFT Code
" name="swift_code" value="<?php echo $user->swift_code;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="form_submit">
                                        <button type="submit" value="Submit">Submit</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>

                     <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";
            var country    = "<?php echo $user->country;?>";
            var state    = "<?php echo $user->state;?>";
            var city    = "<?php echo $user->city;?>";
        </script>

                <?php $this->load->view('common/footer');?>

                <script type="text/javascript">
        
        $( document ).ready(function() {
        
<?php if($user->state != ''){ ?> 
 get_state("<?php echo $user->country;?>");
<?php } ?>
<?php if($user->city != ''){ ?> 
 get_city("<?php echo $user->state;?>");
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

                <?php exit;?>
