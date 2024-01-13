<style>
   label.error {
    color: #ff0000 !important;
    font-weight: unset !important;
}
   </style>
<?php
 $user_id="";
if($user->user_id!="")
{
$user_id= base64_encode(json_encode($user->user_id));
}

 ?>
<?php
   $this->load->view(THEME.'/common/header'); ?>
<!-- Begin main content -->
<div class="main-content">
<!-- content -->
<div class="page-content">
   <!-- page header -->
   <div class="page-title-box tick_details">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-8">
               <!-- <h3 class="mb-1"> <div class="go_back_btn"><a href="<?php echo base_url(); ?>home/index"><i class="fas fa-arrow-left"></i></a></div>Order Info</h3> -->
               <h5 class="card-title">
                  <div class="go_back_btn"><a href="<?php echo base_url();?>home/users/users"><i class="fas fa-arrow-left"></i></a></div>
                 Add New User
               </h5>
            </div>
            <div class="col-sm-4">
               <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                  <!-- <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i> Go Back</a>  -->
                  <!-- <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2">Save</a> -->
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- page content -->
   <div class="page-content-wrapper mt--45">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-8 col-xl-8">
               <div class="card rounded-0">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-12 mt-3 mb-0 customer_detail">
                           <!-- 
                        
                        validate_form_v2 form_req_validation login-wrapper
                     
                     -->
                           <form id="profile-form" method="post" class="validate_form_v1 login-wrapper " action="<?php echo base_url();?>home/users/save_user">
                              <input type="hidden" name="flag" value="<?php echo $flag;?>">
                              <input type="hidden" name="admin_id" value="<?php echo $user->user_id;?>">
                              <input type="hidden" name="address_details_id" value="<?php echo $user->address_details_id;?>">
                              <ul class="nav nav-tabs nav-bordered">
                                 <li class="nav-item">
                                    <a href="<?php echo base_url();?>home/users/add_user/1/<?php echo $user_id ?>"  class="nav-link <?php if($flag == '1'){ ?> active <?php } ?>">
                                    General
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="<?php echo base_url();?>home/users/add_user/2/<?php echo $user_id ?>"  class="nav-link <?php if($flag == '2'){ ?> active <?php } ?> ">
                                    Address
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="<?php echo base_url();?>home/users/add_user/3/<?php echo $user_id ?>"  class="nav-link <?php if($flag == '3'){ ?> active <?php } ?> ">
                                    Login Access
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="<?php echo base_url();?>home/users/add_user/4/<?php echo $user_id ?>"  class="nav-link <?php if($flag == '4'){ ?> active <?php } ?> ">
                                    Bank Detail
                                    </a>
                                 </li>
                                 <?php if($user->admin_role_id == 3){ ?>
                                 <!-- <li class="nav-item">
                                    <a href="<?php //echo base_url();?>home/users/add_user/5/<?php // echo $user_id ?>"  class="nav-link <?php //if($flag == '5'){ ?> active <?php //} ?>">
                                    Website
                                    </a>
                                 </li> -->
                                 <?php }?>
                              </ul>
                              <div class="tab-content mt-3">
               <div class="tab-pane <?php if($flag == '1'){ ?> show active <?php } ?>" id="home-b1">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card mb-0 shadow-none">
                                             <div class="row column_modified data_hide ">
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">First Name</label><br>
                                                      <span><?php echo $user->admin_name;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Last Name</label><br>
                                                      <span><?php echo $user->admin_last_name;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="example-email" class="mb-0 gr_clr">Email ID</label><br>                                                       
                                                      <span><?php echo $user->admin_email;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Phone Number</label><br>                                                       
                                                      <span><?php echo $user->admin_cell_phone;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Company Name</label><br>
                                                      <span><?php echo $user->company_name;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Company Url</label><br>
                                                      <span><?php echo $user->company_url;?></span>
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Role</label><br>
                                                      <span><?php echo ucwords(
                                                      strtolower($user->admin_role_name));?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="edit_btn btn btn-primary ms-1 waves-effect waves-light " data-effect="wave" type="button">Edit</button>

                                                      <!-- <button
                                                            class="save_add_btn btn btn-success mb-2 ml-2 mt-3"
                                                            data-effect="wave" id='' type="submit">Save</button> -->
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end col -->
                                             <div class="row column_modified edit_data data_show" style="display:none;">
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">First Name <span class="text-danger">*</label>
                                                      <input type="text" name="first_name" id="first_name" class="form-control rounded-0" placeholder="First Name" value="<?php echo $user->admin_name;?>" required >
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Last Name <span class="text-danger">*</label>
                                                      <input type="text" name="last_name" id="last_name" class="form-control rounded-0" placeholder="Last Name"  value="<?php echo $user->admin_last_name;?>" required >
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="example-email" class="mb-0 gr_clr">Email ID <span class="text-danger">*</label>
                                                      <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="Email" value="<?php echo $user->admin_email;?>" required>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Phone Number <span class="text-danger">*</label>
                                                      <input type="text" id="mobile_no" class="form-control rounded-0" name="mobile_no"placeholder="Phone Number" value="<?php echo $user->admin_cell_phone;?>" required >
                                                   </div>
                                                </div>
                                                <!-- <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Birth Date</label>
                                                      <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name." value="<?php //echo $user->company_name;?>">
                                                   </div>
                                                </div> -->
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Company Url </label>
                                                      <input type="text" name="company_url"  id="company_url" class="form-control" placeholder="Company Url." value="<?php echo $user->company_url;?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Role <span class="text-danger">*</label>
                                                      <select class="form-control" id="role" name="role" required onchange="show_events(this.value)">
                                                <option value="">-Select Role-</option>
                                                <?php foreach ($roles as $role) { ?>
                                                <option value="<?php echo $role->admin_role_id;?>" <?php if($role->admin_role_id == $user->admin_role_id){ echo "selected";}?> ><?php echo $role->admin_role_name;?></option>
                                                <?php } ?>
                                             </select>
                                                   </div>
                                                </div>

                                                <div class="col-md-12" id="show_other_event" style="display:none;">
                                             <div class="field">
                                                <div class="control">
                                                   <div class="form-check">
                                                                          <input class="form-check-input" name="otherevent" type="checkbox" value="1"  <?php if($user->other_event == '1'){ ?> checked="" <?php } ?> id="sendmail">
                                                                          <label class="form-check-label" for="sendmail">
                                                                          Enable Other Events to this Seller
                                                                          </label>
                                                                          </div>
                                                </div>
                                             </div>
                                             <!--Field-->
                                          </div>
                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="save_add_btn btn btn-primary ms-1 waves-effect waves-light" data-effect="wave" id='' type="submit" >Save</button>
                                                      <!-- onclick="submitForm(event)" -->
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end col -->
                                          </div>
                                          <!-- end card -->
                                       </div>
                                       <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                 </div>
                                 <div class="tab-pane <?php if($flag == '2'){ ?> show active <?php } ?>" id="profile-b1">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card mb-0 shadow-none">
                                             
                                       <div class="row cust_info contact_hide column_modified ">
                                          
                                            <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Country</label><br>
                                                      <span><?php echo $user->country_name;?></span>
                                                   </div>
                                                </div>

                                                  <!-- <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">State</label><br>
                                                      <span><?php // echo //$user->city_name;?></span>
                                                   </div>
                                                </div> -->

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">City</label><br>
                                                      <span><?php echo $user->city_name;?></span>
                                                   </div>
                                                </div>

                                                  

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">ZipCode</label><br>
                                                      <span><?php echo $user->zip_code;?></span>
                                                   </div>
                                                </div>

                                          <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Address</label><br>
                                                      <span><?php echo $user->address;?></span>
                                                   </div>
                                                </div>
                                         
                                          <div class="col-lg-12">
                                             <div class="pt-2 float-right">
                                                <button class="cnct_edit_btn btn btn-primary ms-1 waves-effect waves-light" data-effect="wave" type="button">Edit</button>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- end col -->
                         
                <div class="row column_modified edit_data contact_show" style="display:none;">
                  

                    
                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label for="simpleinput" class="mb-0 gr_clr">Country</label>
                        <select class="form-control" id="country" name="country" onchange="get_state_city(this.value);"  required>
                                       <option value="">-Select Country-</option>
                                       <?php foreach($country_lists as $country_list){ ?>
                                       <option value="<?php echo $country_list->id;?>" <?php if($country_list->name == $user->country_name){?> selected <?php } ?>><?php echo $country_list->name;?></option>
                                       <?php } ?>
                                    </select>
                     </div>
                  </div>


                  <!-- <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label for="simpleinput" class="mb-0 gr_clr">State</label>
                         <select class="form-control" id="state" name="state" onchange="get_selected_city(this.value);" required>
                                       <option value="">-Select State-</option>
                                    </select>
                     </div>
                  </div> -->


                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                     <?php $cityArray = $this->General_Model->get_state_cities(2); 
                     ?>   
                        <label for="simpleinput" class="mb-0 gr_clr">City</label>
                         <select class="form-control" id="city" name="city" required>
                                 <option value="">-Select City-</option>
                                 <?php 
                                                                     foreach ($cityArray as $cityArr) {
                                                                        ?>
                                                                        <option value="<?= $cityArr->id; ?>" <?php
                                                                        if ($user->city): if ($user->city == $cityArr->id) {
                                                                                 echo 'selected';
                                                                           } endif;
                                                                        ?>><?= $cityArr->name; ?></option>
                                                                                 <?php
                                                                           }
                                                                  ?>
                              </select>
                     </div>
                  </div>

                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label for="simpleinput" class="mb-0 gr_clr">ZipCode</label>
                         <input type="text" class="form-control" placeholder="Zip Code." name="zip_code" value="<?php echo $user->zip_code;?>" required>
                     </div>
                  </div>


                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label for="simpleinput" class="mb-0 gr_clr">Address</label>
                          <textarea class="form-control textarea" rows="4" placeholder="Address" name="address" required><?php echo $user->address;?></textarea>
                     </div>
                  </div>



                     <div class="col-lg-12">
                           <div class="pt-2 float-right">
                           <button class="cnct_save_btn btn btn-primary ms-1 waves-effect waves-light" data-effect="wave" id='submit_address_info' type="submit">Save</button>
                           </div> 
                     </div>                            
              </div> <!-- end col -->
                           </div> <!-- end card -->
                           </div><!-- end col -->
                           </div>
                           </div>

                           <!-- Login Access Start-->

                           <div class="tab-pane <?php if($flag == '3'){ ?> show active <?php } ?>" id="home-b1">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card mb-0 shadow-none">
                                             <div class="row column_modified data_hide ">
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Password</label><br>
                                                      <span><?php echo "********"; ?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Confirm Password</label><br>
                                                      <span><?php echo "********";  ?></span>
                                                   </div>
                                                </div>
                                               
                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="edit_btn btn btn-primary ms-1 waves-effect waves-light " data-effect="wave" type="button">Edit</button>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end col -->
                                             <div class="row column_modified edit_data data_show" style="display:none;">
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Password</label>
                                                      <input type="password" name="password" id="simpleinput" class="form-control rounded-0" placeholder="Password"  required >
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Confirm Password</label>
                                                      <input type="password" name="cpassword" id="simpleinput" class="form-control rounded-0" placeholder="Confirm Password"  required >
                                                   </div>
                                                </div>

                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="save_add_btn btn btn-primary ms-1 waves-effect waves-light" data-effect="wave" id='' type="submit" >Save</button>
                                                      <!-- onclick="submitForm(event)" -->
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end col -->
                                          </div>
                                          <!-- end card -->
                                       </div>
                                       <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                 </div>

                           <!-- Login Access End -->

                            <!-- Login Access Start-->

                            <div class="tab-pane <?php if($flag == '4'){ ?> show active <?php } ?>" id="home-b1">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card mb-0 shadow-none">
                                             <div class="row column_modified data_hide ">
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Beneficiary Full Name</label><br>
                                                      <span><?php echo $user->beneficiary_name; ?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Bank Name</label><br>
                                                      <span><?php echo $user->bank_name;  ?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">IBAN Number</label><br>
                                                      <span><?php echo  $user->iban_number;  ?></span>
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Beneficiary Address</label><br>
                                                      <span><?php echo $user->beneficiary_address;  ?></span>
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Bank Address</label><br>
                                                      <span><?php echo $user->bank_address;  ?></span>
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Account Number</label><br>
                                                      <span><?php echo $user->account_number;  ?></span>
                                                   </div>
                                                </div>
                                              
                                       
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">  BIC / SWIFT Code</label><br>
                                                      <span><?php echo $user->swift_code;  ?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput" class="mb-0 gr_clr">  Currency</label><br>
                                                      <span><?php echo $user->currency;  ?></span>
                                                   </div>
                                                </div>
                                               
                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="edit_btn btn btn-primary ms-1 waves-effect waves-light " data-effect="wave" type="button">Edit</button>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end col -->
                                             <div class="row column_modified edit_data data_show" style="display:none;">
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Beneficiary Full Name</label>
                                                      <input type="text" name="beneficiary_name" id="simpleinput" class="form-control rounded-0" placeholder="Beneficiary Full Name" value="<?php echo $user->beneficiary_name;?>" required >
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Bank Name</label>
                                                      <input type="text" name="bank_name" id="simpleinput" class="form-control rounded-0" placeholder="Bank Name"  required  value="<?php echo $user->bank_name;?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">IBAN Number</label>
                                                      <input type="text" name="iban_number" id="simpleinput" class="form-control rounded-0" placeholder="Bank Name"  required  value="<?php echo $user->iban_number;?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Beneficiary Address</label>
                                                      <input type="text" name="beneficiary_address" id="simpleinput" class="form-control rounded-0" placeholder="Beneficiary Address"  required  value="<?php echo $user->beneficiary_address;?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Account Number</label>
                                                      <input type="text" name="account_number" id="simpleinput" class="form-control rounded-0" placeholder="Account Number"  required  value="<?php echo $user->account_number;?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">BIC / SWIFT Code</label>
                                                      <input type="text" name="swift_code" id="simpleinput" class="form-control rounded-0" placeholder="BIC / SWIFT Code"  required  value="<?php echo $user->swift_code;?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Bank Address</label>
                                                      <input type="text" name="bank_address" id="simpleinput" class="form-control rounded-0" placeholder="Bank Address"  required  value="<?php echo $user->bank_address;?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Currency</label>
                                                      <select class="form-control" id="currency" name="currency" required >
                                                <option value="">-Select Currency-</option>
                                                <?php foreach ($currencies as $currency) { ?>
                                                <option value="<?php echo $currency->currency_code;?>" <?php if($currency->currency_code == $user->currency){ echo "selected";}?> ><?php echo $currency->currency_code;?></option>
                                                <?php } ?>
                                             </select>
                                                   </div>
                                                </div>

                                                

                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="save_add_btn btn btn-primary ms-1 waves-effect waves-light" data-effect="wave" id='' type="submit" >Save</button>
                                                      <!-- onclick="submitForm(event)" -->
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end col -->
                                          </div>
                                          <!-- end card -->
                                       </div>
                                       <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                 </div>

                           <!-- Login Access End -->

                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  </form >
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="col-lg-4 col-xl-4">
               <div class="card rounded-0">
                  <div class="card-body">
                     <div class="profile_details mt-3 pt-2">
                        <?php if($user->admin_profile_pic != ''){ ?>
                        <img src="<?php echo $user->admin_profile_pic;?>"  alt="" id="display_profile" class="img-fluid rounded-circle" width="120" >
                        <?php } else{ ?>
                        <img class="avatar" src="https://via.placeholder.com/150x150" class="img-fluid rounded-circle" width="120" data-demo-src="assets/img/avatars/photos/8.jpg" alt="">
                        <?php } ?>
                        <p class="text-center"> <span><?php echo $user->admin_name; ?> <?php echo $user->admin_last_name; ?></span>
                           
                        </p>
                        <h5 class="mb-3 pt-2 fw-semibold text-dark">Contact Information</h5>
                        <div class="table-responsive">
                           <table class="table table-borderless mb-0 table-sm">
                              <tbody>
                                 <tr>
                                    <th>Role</th>
                                    <td><?php echo ucwords(
                                                      strtolower($user->admin_role_name));?></td>
                                 </tr>
                                 <tr>
                                    <th>Registration :</th>
                                    <td><?php  echo !empty($user->admin_creation_date_time) ? date("d F Y h:i A", strtotime($user->admin_creation_date_time)) : ""; ?></td>
                                 </tr>
                                 <tr>
                                    <th>Updated At:</th>
                                    <td><?php  
                                    echo !empty($user->admin_updation_date_time) ? date("d F Y h:i A", strtotime($user->admin_updation_date_time)) : ""; ?></td>
                                 </tr>
                                 
                            
                                 <tr>
                                    <th>Status :</th>
                                    <td>
                                       <?php if($user_id!="") {?>
                                       <div class="bttns">
                                          <span class="badge <?php echo $status = ($user->admin_status == 'ACTIVE') ? "badge-success" : "badge-danger"; ?>"><?php echo $status = ($user->admin_status == "ACTIVE") ? "Active" : "Inactive"; ?></span>
                                       </div>
                                      <?php } ?>
                                    </td>
                                 </tr>
                                
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- main content End -->
<?php $this->load->view(THEME.'/common/footer'); ?>
<script type="text/javascript">
   $(document).ready(function() {
      
   $(".edit_btn").click(function() {
    $(".data_hide").hide();
    $(".data_show").show();
   });
   // $(".save_add_btn").click(function() {
   //  $(".data_hide").show();
   //   $(".data_show").hide();
   // });
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
   $(".cnct_edit_btn").click(function() {
    $(".contact_hide").hide();
    $(".contact_show").show();
   });
   $(".cnct_save_btn").click(function() {
    $(".contact_hide").show();
     $(".contact_show").hide();
   });
   });
</script>
<script>
    <?php if($user->other_event == '1' || $user->admin_role_id == 1){ ?>
        $('#show_other_event').show();
    <?php } ?>
    function show_events(role){
        if(role == 1){
        $('#show_other_event').show();
        }
        else{
        $('#show_other_event').hide();
        }
    }

   $( document ).ready(function() {

      var userId = "<?php echo $user->user_id; ?>";
      if (userId === '') {
         $(".edit_btn").trigger("click");
      }
 
     
     
   <?php if($user->state != ''){ ?> 
      get_selected_state("<?php echo $user->country;?>","<?php echo $user->state;?>");
      <?php } ?>
      <?php if($user->city != ''){ ?> 
        
      get_selected_city("<?php echo $user->state;?>","<?php echo $user->city; ?>");
      <?php } ?>


      function checkUserId() {
    var userId = "<?php echo $user->user_id; ?>";
    if (userId === '') {
      // SweetAlert popup when user_id is empty
      swal('Attention!', 'Please Fill The General Info', 'error');
      return false;
    }
    return true;
  }

   $('.nav-link').on('click', function(event) {
    var href = $(this).attr('href');
    var flag = href.split('/').slice(-2, -1)[0]; // Extracting the flag from the URL
    if (flag) {
      if (!checkUserId()) {
        event.preventDefault(); // Prevent navigation when user_id is empty
      }
    }    
  });


   });
   
   var loadFile = function(event) {
   
   var output = document.getElementById('display_profile');
   output.src = URL.createObjectURL(event.target.files[0]);
   output.onload = function() {
   URL.revokeObjectURL(output.src) // free memory
   }
   
   };
</script>
