<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/customers/save_customer">
                            <input type="hidden" name="id" value="<?php echo $customers->id;?>">
                         
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New Customer</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>settings/customers/customer_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Customers</span>
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
                                            <h4>Customer Basic Info</h4>
                                            <p>Fill the Customer Basic information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>First Name *</label>
                                                    <div class="control">
                                                        <input type="text" id="type" name="firstname" class="input" placeholder="Enter First Name" required value="<?php echo $customers->first_name;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Last Name *</label>
                                                    <div class="control">
                                                        <input type="text" id="typel" name="lastname" class="input" placeholder="Enter Last Name" required value="<?php echo $customers->last_name;?>">
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>Email *</label>
                                                    <div class="control">
                                                        <input type="text" id="email" name="email" class="input" placeholder="Enter Email" required value="<?php echo $customers->email	;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Telephone *</label>
                                                    <div class="control">
                                                      <div class="field has-addons">
                                            <p class="control">
                                                <span class="select smallselect">
                                                  <select name="phonecode" required>
                                                  	  <?php foreach($countries as $country){ ?>
                                                      <option <?php if($country->phonecode == $customers->dialing_code){?> selected <?php } ?> value="<?php echo $country->phonecode;?>">+<?php echo $country->phonecode;?> (<?php echo $country->sortname;?>)</option>
                                                  <?php } ?>
                                                  </select>
                                              </span>
                                            </p>
                                            <p class="control is-expanded">
                                                <input class="input" name="phone" type="text" placeholder="Telephone No." value="<?php echo $customers->mobile;?>" required>
                                            </p>
                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                        </div>
                                    </div>
                                    <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 580px;">
                                        <div class="fieldset-heading">
                                            <h4>Customer Contact Info</h4>
                                            <p>Fill the User Contact Information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                         <div class="column is-6">
                                                <div class="field">
                                                    <label>Street Address *</label>
                                                    <div class="control">
                                                        <input type="text" id="address" name="address" class="input" placeholder="Enter Street Address" required value="<?php echo $customers->address;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Zip/Postal Code *</label>
                                                    <div class="control">
                                                        <input type="text" id="postal_code" name="postal_code" class="input" placeholder="Enter Postal Code" required value="<?php echo $customers->code;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Country *</label>
                                                   <select class="form-control" required name="country" id="country" onchange="get_state(this.value);">
													 <?php foreach($countries as $country){ ?>
                                                      <option <?php if($country->id == $customers->country){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                  <?php } ?>
													</select>
                                                </div>
                                            </div>


                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>State *</label>
                                                   <select required class="form-control" id="state" name="state" onchange="get_city(this.value);">
                                                                     <option value="">-Select State-</option>
                                                                </select>
                                                </div>
                                            </div>

                                             <div class="column is-6">
                                                <div class="">
                                                    <label>City *</label>
													<select class="form-control" name="city" id="city" required>
													<option>--Select City--</option>
													</select>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Customer Status *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="status" value="1" 
<?php if($customers->status == '1'){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Customer Status</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>

                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Allow Offline Booking *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="allow_offline" value="1" 
<?php if($customers->allow_offline == '1'){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Offline Booking</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                         
                                        </div>
                                            
                                        </div>

                                        <div class="form-fieldset" style="max-width: 580px;">
                                        <div class="fieldset-heading">
                                            <h4>Customer Login Info</h4>
                                            <p>Fill the Customer Login Information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                         
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Password <?php if($customers->id == ''){?> * <?php } ?></label>
                                                    <div class="control">
                                                        <input type="text" id="password" name="password" class="input" placeholder="Enter password" <?php if($customers->id == ''){?> required <?php } ?> value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Confirm Password <?php if($customers->id == ''){?> * <?php } ?></label>
                                                    <div class="control">
                                                        <input type="text" id="confirm_password" name="confirm_password" class="input" placeholder="Enter Confirm Password" <?php if($customers->id == ''){?> required <?php } ?> value="">
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
                     <script type="text/javascript">
                    var base_url = "<?php echo base_url();?>";
                    var country    = "<?php echo $customers->country;?>";
                    var state    = "<?php echo $customers->state;?>";
                    var city    = "<?php echo $customers->city;?>";
                    </script>
                <?php $this->load->view('common/footer');?>
                         <script type="text/javascript">
        
        $( document ).ready(function() {
        
<?php if($customers->state != ''){ ?> 
 get_state("<?php echo $customers->country;?>");
<?php } ?>
<?php if($customers->city != ''){ ?> 
 get_city("<?php echo $customers->state;?>");
<?php } ?>
});
</script>

                
				<?php exit;?>
