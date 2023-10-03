
<style>
   .edit_btn, .save_add_btn, .cnct_edit_btn, .cnct_save_btn
   {
      background-color: #43d39e !important;
    border-color: #43d39e !important;
   }

   .save_add_btn:hover {
    color: #fff !important;
    background-color: #2dc28c !important;
    border-color: #2bb884 !important; 
}

label.error {
    color: #ff0000 !important;
    font-weight: unset !important;
}

</style><?php
$this->load->view(THEME . '/common/header'); ?>
<!-- Begin main content -->
<div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
                     <div class="col-sm-8">
                        <h5 class="card-title">Add New Seller</h5>
                     </div>
                     <div class="col-sm-4">
                        <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                           <a href="<?php echo base_url(); ?>home/users/seller"  class="btn btn-primary mb-2">Back</a>
                              <a href="javascript:void(0);" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2 trigger_save" >Save</a>
                        </div> 
                     </div>
                  </div>
          </div>
        </div>
        <!-- page content -->
        <div class="page-content-wrapper mt--45">
          <div class="container-fluid">
<!-- form_req_validation -->
            <div class="row">
               <div class="col-lg-8 col-xl-8">
                  <div class="card rounded-0">
                     <div class="card-body">            
                        <div class="row">
                           <div class="col-lg-12 mt-3 mb-0 customer_detail">
                           <form id="profile-form" method="post"
                                 class="validate_form_v1 login-wrapper"
                                 action="<?php echo base_url(); ?>home/users/save_seller_user">
                                 <input type="hidden" name="flag" value="<?php echo $flag; ?>">
                                 <input type="hidden" name="admin_id" value="<?php echo $user->user_id; ?>">
                                 <input type="hidden" name="create_seller" value="1">
                                 <input type="hidden" name="role" value="1">
                                 
                                 <input type="hidden" name="address_details_id" value="<?php echo $user->address_details_id; ?>">
                                    <ul class="nav nav-tabs nav-bordered">
                                    <li class="nav-item">
                                       <a href="<?php echo base_url(); ?>home/users/create_user/1/<?php echo base64_encode(json_encode($user->user_id));?>"
                                          class="nav-link <?php if ($flag == '1') { ?> active <?php } ?>">
                                          Personal Info
                                       </a>
                                    </li>
                                    <li class="nav-item">
                                       <a href="<?php echo base_url(); ?>home/users/create_user/2/<?php echo base64_encode(json_encode($user->user_id));?>"
                                          class="nav-link <?php if ($flag == '2') { ?> active <?php } ?> ">
                                          Address Info
                                       </a>
                                    </li>
                                    <li class="nav-item">
                                       <a href="<?php echo base_url(); ?>home/users/create_user/3/<?php echo base64_encode(json_encode($user->user_id));?>"
                                          class="nav-link <?php if ($flag == '3') { ?> active <?php } ?> ">
                                          Login Access
                                       </a>
                                    </li>
                                    <li class="nav-item">
                                       <a href="<?php echo base_url(); ?>home/users/create_user/4/<?php echo base64_encode(json_encode($user->user_id));?>"
                                          class="nav-link <?php if ($flag == '4') { ?> active <?php } ?> ">
                                          Bank Detail
                                       </a>
                                    </li>                                   
                                 </ul>
                              <div class="tab-content mt-3">
                                 <div class="tab-pane  <?php if ($flag == '1') { ?> show active <?php } ?>" id="home-b1">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card mb-0 shadow-none">   
                                             <div class="row column_modified edit_data">
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">First Name <span class="text-danger">*</label>
                                                       <input type="text" id="simpleinput" name="first_name"  class="form-control rounded-0 one"  placeholder="First Name" value="<?php echo $user->admin_name;?>" required>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Last Name <span class="text-danger">*</label>
                                                       <input type="text" name="last_name" id="last_name" class="form-control rounded-0 one" placeholder="Last Name"                                                            value="<?php echo $user->admin_last_name;?>" required >
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Company Name <span class="text-danger">*</label>
                                                       <input type="text"  name="company_name" id="company_name" class="form-control rounded-0"  placeholder="Company Name." value="<?php echo $user->company_name;?>" required>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Company URL <span class="text-danger">*</label>
                                                       <input type="text"  name="company_url" id="company_url" class="form-control rounded-0"  placeholder="Company Url." value="<?php echo $user->company_url;?>" required>
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
                                                       <input type="text" name="mobile_no" id="mobile_no" class="form-control rounded-0"   placeholder="Phone Number" value="<?php echo $user->admin_cell_phone;?>" required >
                                                   </div>
                                                </div>
                                               

                                                <div class="col-lg-6">
                                          <div class="form-group calander">
                                          <label for="simpleinput" class="mb-0 gr_clr">Date of Birth <span class="text-danger">*</label>
                                             <input class="form-control" id="MyTextbox2" type="text" name="dob" placeholder="Date of Birth" value="<?php
                                              if(isset($user->dob))
                                              {

                                                $dateString = "2023-07-04";
                                                $originalDate = new DateTime($user->dob);
                                                echo $formattedDate = $originalDate->format('d-m-Y');
                                              }
                                              ?>" autocomplete="off" required>
                                              <i class="bx bx-calendar-week"></i>
                                          </div>
                                       </div>
                                                
                                                <div class="col-lg-12">
                                                   <hr>
                                                   <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                                                      <a href="<?php echo base_url(); ?>home/users/seller"  class="btn btn-primary mb-2 mt-3">Back</a>
                                                         <!-- <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2 mt-3">Save</a> -->
                                                         <button
                                                            class="save_add_btn btn btn-success mb-2 ml-2 mt-3"
                                                            data-effect="wave" id='' type="submit">Save</button>
                                                   </div> 
                                                </div>                               
                                             </div> <!-- end col -->
                                          </div> <!-- end card -->
                                       </div><!-- end col -->
                                    </div>
                                    <!-- end row -->
                                 </div>
                                 <div class="tab-pane <?php if ($flag == '2') { ?> show active <?php } ?>" id="profile-b1">
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="card mb-0 shadow-none">
                                          <!-- <div class="">
                                            <h5 class="card-title">Match Content Info</h5>
                                            <p>Fill the Match Content Information</p>
                                          </div> -->
                                              <p class="blk_clr font-weight-600">Billing Address</p>
                                             <div class="row column_modified edit_data">
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Street Address <span class="text-danger">*</label>
                                                       <input type="text" name ="address" id="address" class="form-control rounded-0" placeholder="Street Address" value="<?php echo $user->address;?>" required>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                      <div class="form-group mb-3">
                                                         <label for="simpleinput" class="mb-0 gr_clr">Country <span class="text-danger">*</label>
                                                               <select class="custom-select" id="add_customer_country" name="country" onchange="get_state_city(this.value);" required>
                                                                     <option value="">Select Country</option>
                                                                        <?php foreach($countries as $country){ ?>
                                                                     <option <?php if($user->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                                     <?php } ?>
                                                               </select> 
                                                      </div>
                                                   </div>                                               
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Post / Zip Code <span class="text-danger">*</label>
                                                       <input type="text" id="zip_code" class="form-control rounded-0" placeholder="Zip Code." name="zip_code" value="<?php echo $user->zip_code;?>" autocomplete="off" required>
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                      <div class="form-group mb-3">
                                                      <?php $cityArray = $this->General_Model->get_state_cities($user->country); ?>   
                                                         <label for="simpleinput" class="mb-0 gr_clr">City <span class="text-danger">*</label>                                                     
                                                         <select class="custom-select" id="city" name="city"  required>
                                                            <option value="">Select City</option>
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
                                                
                                                <div class="col-lg-12">
                                                   <div class="checkbox checkbox-success mb-2 shipping_address">
                                                     <input id="checkbox3" type="checkbox">
                                                     <label for="checkbox3">
                                                       <b>Shipping address same as billing</b>
                                                     </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="col-lg-12">
                                                      <hr>
                                                      <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                                                         <a href="<?php echo base_url(); ?>home/users/seller" class="btn btn-primary mb-2 mt-3">Back</a>
                                                            <!-- <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2 mt-3">Save</a> -->

                                                            <button
                                                            class="save_add_btn btn btn-success mb-2 ml-2 mt-3"
                                                            data-effect="wave" id='' type="submit">Save</button>
                                                      </div> 
                                                   </div>
                                                </div>                            
                                             </div> <!-- end col -->
                                        </div> <!-- end card -->
                                      </div><!-- end col -->
                                    </div>
                                 </div>

                                 <div class="tab-pane <?php if ($flag == '3') { ?> show active <?php } ?>" id="profile-b2">
                                    <div class="row column_modified edit_data">
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="example-email" class="mb-0 gr_clr">Email ID <span class="text-danger">*</label>
                                              <input type="email" name="user_email" id="user_email" name="example-email" class="form-control rounded-0" placeholder="Email ID" value="<?php echo $user->login_email_id;?>" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">User Name <span class="text-danger">*</label>
                                              <input type="text" name="user_name" id="user_name" class="form-control rounded-0 one" placeholder="User Name" value="<?php echo $user->admin_user_name;?>" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">Password <span class="text-danger">*</label>
                                              <input type="password" name="password" id="password" class="form-control rounded-0 one" placeholder="*******" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">Confirm Password <span class="text-danger">*</label>
                                              <input type="password" id="cpassword" name="cpassword" class="form-control rounded-0 one" placeholder="*******" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <hr>
                                          <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                                             <a href="<?php echo base_url(); ?>home/users/seller/"  class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button
                                                            class="save_add_btn btn btn-success mb-2 ml-2 mt-3"
                                                            data-effect="wave" id='' type="submit">Save</button>
                                          </div> 
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane <?php if ($flag == '4') { ?> show active <?php } ?>" id="profile-b3">
                                    <div class="row column_modified edit_data">
                                      <?php //echo "<pre>";print_r($user);?>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="example-select" class="mb-0 gr_clr">Select Currency <span class="text-danger">* </label>
                                              <select class="custom-select" id="example-select" name="currency">   
                                              <option value="">Currency</option>                                            
                                                <option value='GBP' <?php if($user->currency == "GBP"){?>selected <?php } ?>>GBP</option>
                                                <option value='EUR' <?php if($user->currency == "EUR"){?>selected <?php } ?>>EUR </option>
                                                <option value='USD' <?php if($user->currency == "USD"){?>selected <?php } ?>>USD </option>
                                                <option value='AED' <?php if($user->currency == "AED"){?>selected <?php } ?>>AED</option>
                                              </select>
                                          </div>
                                       </div>
                                    </div>
                                    <p class="blk_clr font-weight-600">Bank Details</p>
                                    <div class="row column_modified edit_data">
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">Account Holder Name as per Bank <span class="text-danger">* </label>
                                              <input type="text" id="beneficiary_name" class="form-control rounded-0 one" placeholder="Beneficiary Full Name" value="<?php echo $user->beneficiary_name; ?>" name="beneficiary_name" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">Bank Name <span class="text-danger">*</label>
                                              <input type="text" id="bank_name" class="form-control rounded-0 one" placeholder="Bank Name"
                                                             value="<?php echo $user->bank_name; ?>" name="bank_name" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">Account Number <span class="text-danger">*</label>
                                              <input type="number" id="account_number" class="form-control rounded-0 one"  placeholder="Account Number"
                                                             value="<?php echo $user->account_number; ?>" name="account_number" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">Sort Code <span class="text-danger">*</label>
                                              <input type="number" id="sort_code" class="form-control rounded-0 one" placeholder="Sort Code" value="<?php echo $user->sort_code; ?>" name='sort_code' required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">IBAN <span class="text-danger">*</label>
                                              <input type="number" id="iban_number" class="form-control rounded-0 one"  placeholder="IBAN" value="<?php echo $user->iban_number; ?>"  name="iban_number" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                              <label for="simpleinput" class="mb-0 gr_clr">Swift / BIC <span class="text-danger">*</label>
                                              <input type="number" id="swift_code" class="form-control rounded-0 one" placeholder="Swift / BIC" value="<?php echo $user->swift_code; ?>" name="swift_code" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <hr>
                                          <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                                             <a href="<?php echo base_url(); ?>home/users/seller"  class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button
                                                            class="save_add_btn btn btn-success mb-2 ml-2 mt-3"
                                                            data-effect="wave" id='' type="submit">Save</button>
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
               <div class="col-lg-4 col-xl-4">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="profile_details mt-3 pt-2">
                           <!-- <img src="assets/images/ellipse18.png" alt="image" class="img-fluid rounded-circle" width="120">
                            <h5 class="mb-3 pt-2 fw-semibold text-dark">William Wilson</h5> 

                           <div class="form-group text-center mt-5">
                               <label class="custom-upload">
                                 <input type="file" name="upload_file">Upload Profile Image
                              </label>
                           </div> -->
                           <?php if($user->admin_profile_pic != ''){ ?>
    <img src="<?php echo $user->admin_profile_pic;?>"  alt="" id="display_profile" class="img-fluid rounded-circle" width="120" >
                                                    <?php } else{ ?>
                                                    <img id="display_profile" class="img-fluid rounded-circle" width="120" src="https://via.placeholder.com/150x150"  alt="">
                                                    <?php } ?>
                                                    <div class="form-group text-center mt-5">
                                                    <label class="custom-upload">
                                                        <input type="file" id="profile-filepond"  name="profile_filepond" accept="image/png, image/jpeg, image/gif" onchange="loadFile(event)">Upload Profile Image
                                                    </label>
                                                    </div>
                        </div>
                     </div>
                  </div>
               </div>
               </form>
            </div>
          </div>
        </div>
      </div>
      <!-- main content End -->
    </div>
   <!-- main content End -->
   <?php $this->load->view(THEME . '/common/footer'); ?>
   <script type="text/javascript">


      $(document).ready(function () {

         $("#MyTextbox2").datepicker({
          dateFormat: 'dd-mm-yy' ,
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
           maxDate:0,
          yearRange: "-100:+0",
      });

         $(".edit_btn").click(function () {
            $(".data_hide").hide();
            $(".data_show").show();
         });
         // $(".save_add_btn").click(function () {
         //    $(".data_hide").show();
         //    $(".data_show").hide();
         // });
      });
   </script>
   <script type="text/javascript">
      $(document).ready(function () {
         $(".cnct_edit_btn").click(function () {
            $(".contact_hide").hide();
            $(".contact_show").show();
         });
         // $(".cnct_save_btn").click(function () {
         //    $(".contact_hide").show();
         //    $(".contact_show").hide();
         // });
      });
   </script>
   <script>
      <?php if ($user->other_event == '1' || $user->admin_role_id == 1) { ?>
         $('#show_other_event').show();
      <?php } ?>
      function show_events(role) {
         if (role == 1) {
            $('#show_other_event').show();
         }
         else {
            $('#show_other_event').hide();
         }
      }

      $(document).ready(function () {

         $('.trigger_save').on('click', function(event) {
            console.log('trigger');
          //$("form").submit();
          $('#profile-form').trigger('submit');
         });
         <?php if ($user->state != '') { ?>
            get_selected_state("<?php echo $user->country; ?>", "<?php echo $user->state; ?>");
         <?php } ?>
         <?php if ($user->city != '') { ?>

            //get_selected_city("<?php // echo $user->state; ?>", "<?php //echo $user->city; ?>");//
          
         <?php } ?>

         function checkUserId() {
    var userId = "<?php echo $user->user_id; ?>";
    if (userId === '') {
      // SweetAlert popup when user_id is empty
      swal('Attention!', 'Please Fill The Personal Info', 'error');
      return false;
    }
    return true;
  }

  // Function to handle tab link clicks
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

      var loadFile = function (event) {

         var output = document.getElementById('display_profile');
         output.src = URL.createObjectURL(event.target.files[0]);
         output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
         }
      };

   </script>