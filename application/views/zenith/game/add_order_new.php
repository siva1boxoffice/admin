<style>
   #overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity to control the overlay effect */
  z-index: 9999;
  display: none;
}

#loader {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  /* Add your styles to center the loader */
}
   </style>
<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>

<?php $this
   ->load
   ->view(THEME.'common/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/svg/svgmap.css" />
  <!-- Begin main content -->
      <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center">
                     <h3 class="mb-1">New Orders</h3>
                     <!-- <ol class="breadcrumb mb-0 mt-1">
                        <li class="breadcrumb-item">
                           <a href="../index.html">
                              <i class="bx bx-home fs-xs"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item">
                           <a href="calender.html">
                              Orders
                           </a>
                        </li>
                        <li class="breadcrumb-item active">New Orders</li>
                     </ol> -->
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">

                  <div class="card rounded-0 shadow-none">
                     <div class="card-body all_new_orders ">
                        <div class="row">
                           <div class="col-lg-9">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="customer_selection_id">Select Customer</label>
                                        <select class="custom-select" id="customer_selection_id" name="customer_selection_id" required="false">
                                           <option value="">-- Select Customer --</option>
                                        <?php foreach ($customers_list as $customer)
                                          { ?>
                                       <option value="<?=$customer->id
                                          ?>" <?=@$selected_customer->id == $customer->id ? 'selected' : ''; ?>><?=$customer->first_name . " " . $customer->last_name . " -  " . $customer->email ?></option>
                                       <?php
                                          } ?>
                                        </select>
                                    </div> 
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="event_selection_id">Select Event</label>
                                        <select class="custom-select" id="event_selection_id" required="false">
                                           <option value="">-- Select Event --</option>
                                          <?php foreach ($events_list as $event)
                                 { ?>
                              <option value="<?=$event->m_id
                                 ?>" <?=$this
                                 ->input
                                 ->get('match_id') == $event->m_id ? 'selected' : ''; ?>><?=$event->match_name ?> - <?=$event->match_date_format ?> -  <?=$event->tournament_name ?></option>
                              <?php
                                 } ?>
                                        </select>
                                    </div> 
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-3">
                              <div class="add_new_bttn">
                                 <a href="#" data-toggle="modal" data-target="#centermodal_add" class="btn btn-success mb-2 rounded-0">Add New Customer</a>
                                 <div class="modal fade" id="centermodal_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Add New Customer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <div class="create_coupon">
               <form>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="basic_info">Basic Info</div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="firstName">First Name</label>
                           <input type="text" id="firstName" class="form-control" placeholder="Enter First Name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="lastNames">Last Name</label>
                           <input type="text" id="lastNames" class="form-control" placeholder="Enter Last Name">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="emailId">Email ID</label>
                           <input type="email" id="emailId" name="example-email" class="form-control" placeholder="Enter Email ID">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="PhoneNumber">Phone Number</label>
                           <input class="form-control" id="PhoneNumber" type="number" name="number" placeholder="Enter phone number">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="basic_info">Contact Info</div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="address">Street Address</label>
                           <input type="text" id="address" class="form-control" placeholder="Enter Street Address">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="zipCode">Zip Code</label>
                           <input type="text" id="zipCode" class="form-control" placeholder="Enter Zip Code">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="country">Country</label>
                           <!--<select class="custom-select" id="add_customer_country">
                              <option value="" selected="">Select Country</option>
                                <option value="1">Category 4</option>
                                <option value="2">Category 5</option>
                                <option value="3">Category 6</option> 
                                countries
                              </select>-->
                              <?php $countries = $this->General_Model->getAllItemTable('countries')->result(); ?>
                           <select class="custom-select" id="add_customer_country" name="add_customer_country" onchange="get_state_city(this.value);" required>
                              <option value="">Select Country</option>
                              <?php foreach($countries as $country){ ?>
                              <option <?php if($matches->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <!-- <div class="col-md-4">
                        <div class="form-group">
                           <label for="state">State</label>
                           <select class="custom-select" id="add_customerstate">
                              <option value="" selected="">Select state</option>
                              <option value="1">EUR</option>
                           </select>
                        </div>
                     </div> -->
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="city">City</label>
                           <!-- <select class="custom-select" id="add_customer_city">
                              <option value="" selected="">Select City</option>
                              <option value="1">EUR</option>
                              </select> -->
                           <select class="custom-select" id="add_customer_city" name="add_customer_city" required>
                              <option value="">Select City</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="customerStatus">Customer Status</label>
                           <div class="custom-control custom-switch">
                              <input type="checkbox" checked class="custom-control-input" id="customerStatus">
                              <label class="custom-control-label" for="customerStatus">Inactive / Active Customer Status </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="Booking">Allow Offline Booking</label>
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="Booking">
                              <label class="custom-control-label" for="Booking">No / Yes Offline Booking</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="basic_info">Login Info</div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="text" id="password" id="password" class="form-control" placeholder="Enter password">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="confirmPassword">Confirm Password</label>
                           <input type="text" id="confirmPassword" class="form-control" placeholder="Re-enter Password">
                        </div>
                     </div>
                  </div>
               </form>
               <div class="coupon_btn_save">
                  <button type="button" class="btn btn-cancel">Cancel</button>
                  <button type="button" class="btn btn-primary" id="createCustomer">Create</button>
               </div>
            </div>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php if ($this->input->get('match_id')) { ?>
                  <div class="row">
                     <div class="col-md-6 col-lg-5 columns">
                        <div class="card rounded-0 shadow-none col_height">
                           <div class="card-body">
                              <div class="event_img">
                                 <div id="mapsvg"></div>
                              </div>
                              <div class="select_sec">
                                 <!-- <h4>Select a section that you like to be seated in</h4> -->

                                 <?php if($results['total_quantity'] > 0) { ?>
                            <div class="select_sec">
                            <h4>Select a section that you like to be seated in</h4>
                            <ul>
                              <?php foreach($category as $list) {
                                 //echo "<pre>";print_r($list);
                                    if($list['seat_category']) {
                                       ?>
                              <li class="<?php echo $list['ticket_category']; ?>-button">
                                 <a href="javascript:;" map-id="<?php echo $list['ticket_category']; ?>" data-target="16" data-class="<?php echo $list['ticket_category']; ?>" color-code="<?php echo $list['block_color']; ?>" onmouseover="showMouseOver(this)" onmouseout="hideMouseOver(this)" onclick="selectCategory('<?php echo $list['ticket_category']; ?>')"><span class="seat_color" style="background:<?php echo $list['block_color']; ?>"></span><?php echo $list['seat_category']; ?></a>
                              </li>
                           <?php } } ?>
                             
                           </ul>
                           
                           </div>
                        <?php } ?>

                                 
                              </div>
                           </div>
                         </div>
                     </div>
                     <div class="col-md-6 col-lg-7 columns">

                        <input type="hidden" name="nooftick" id="noofticket" value="">
                        <input type="hidden" name="allticktype" id="allticktype" value="">
                        <input type="hidden" name="seller_id" id="seller_id" value="">
                        <div class="card rounded-0 shadow-none col_height">
                           <div class="card-body">
                              <div class="section_all ticket_sort_approval">
                                 <div class="row">
                                    <div class="col-md-2 nopadds">
                                       <div class="sort_by">
                                          <span>Sort By:</span>
                                       </div>
                                    </div>
                                    <div class="col-md-10">
                                       <div class="sort_filters">
                                          <ul>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Ticket Quantity <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">

                                                         <?php if($ticketQuantity){
                                          for($i=1; $i<=$ticketQuantity;$i++) { ?>
                                        
                                        <a data-quantity="<?php echo $i;?>" class="dropdown-item ticket_qunaity" href="javascript:void(0)"><?php echo $i;?></a>
                                       <?php }} ?>

                                                        
                                                       
                                                         
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Ticket Type <i class="mdi mdi-chevron-down"></i>
                                                      </button> <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <?php if($category) {
                                             foreach($category as $list){
                                                ?>
                                                 <a data-id="<?php echo $list['ticket_category'];?>" class="dropdown-item" href="javascript:void(0)" onClick="selectType('<?php echo $list['ticket_category'];?>')"><?php echo $list['seat_category'] ;?></a>
                                            <?php } } ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Seller Name <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <?php if($seller_list) {
                                             foreach($seller_list as $list){
                                                ?>

                                                <a data-id="<?php echo @$list->admin_id;?>" class="dropdown-item seller_id" href="javascript:void(0)" ><?php echo @$list->admin_name ;?></a>

                                                 
                                            <?php } } ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <a class="clear_all" href="">Clear All</a>
                                             </li>
                                             <!-- <li class="sort_list">
                                                <a class="report_sts" href="">Reports</a>
                                             </li> -->
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="new_orders_lft mt-2" id="content_1">
                               <div class="tickets_details_list"></div>
                            </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               <?php } else  {?>
                     <div class="">
                        <p class="text-center">No Ticket Available </p>

                        <!-- <a class="ticket_request_link" href="<?=base_url('request-ticket/' . $results['m_id']) ?>">Request Now</a> -->

                     </div>
                  <?php } ?>

                   <?php if($cid != ''){ ?>

                      <form id="order-form" method="post" class="call_modal" action="<?php echo base_url(); ?>game/orders/save_order_new"  data-toggle="modal" data-target="centermodal1"  data-title="Are you sure?" data-sub-title="Are you sure want to do the make booking?!" data-yes="Yes" data-no="No" data-btn-id="new_order" data-target="update_booking_status">
                           
                           <div  style="display:none">
                           <input type="hidden" name="currency_code" value="<?php echo $category_details['currency_code']; ?>">

                           <input type="hidden" name="cart_id" value="<?php echo base64_encode($category_details['cart_id']);?>">
                           <input type="hidden" name="user_id" value="<?php echo $selected_customer->id;?>">
                           <div class="add_details">
                              <div class="columns is-multiline is-flex-tablet-p">
                                 <div class="column is-8">
                                    <div class="price">
                                       <h2>Billing Details</h2>
                                       <div class="columns">

                                           <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Title</label>
                                             <select name="title" id="title" class="input" required="">
                                               <option value="">Select</option>
                                               <option value="Mr" selected>Mr</option>
                                               <option value="Mrs">Mrs</option>
                                               <option value="Miss">Miss</option>
                                           </select>
                                            
                                          
                                          </div>
                                       </div>

                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">First Name</label>
                                             <input type="text" class="input" minlength="2" placeholder="First Name" id="first_name" name="first_name" value="<?=$selected_customer->first_name?>" required />
                                             <input type="hidden" name="process_checkout" value="1">
                                            
                                          
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Last Name</label>
                                             <input type="text" class="input" minlength="2" placeholder="Last Name" id="last_name" name="last_name" value="<?=$selected_customer->last_name?>" required />
                                          </div>
                                       </div>
                                    </div>
                                     <div class="columns">

                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Address</label>
                                             <input type="text" class="input" minlength="2" placeholder="Address" id="address" name="address" value="<?=$selected_customer->address?>" required />
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Postcode</label>
                                             <input type="text" class="input" minlength="2" placeholder="Postcode" id="postcode" name="postcode" required value="<?=$selected_customer->code?>" />
                                          </div>
                                       </div>
                                    </div>
                                        <div class="columns">

                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="section">Select Country </label>
                                             <select name="country" class="countries form-control" id="country" required>
                                                <option value="">Select Country</option>
                                                <?php foreach ($allCountries as $allCount) { ?>

                                                   
                                                <option value="<?= $allCount->id; ?>" <?php if ($selected_customer){ if ( $selected_customer->country == $allCount->id) { echo 'selected'; } } else { if($allCount->id == '230'){ echo 'selected'; } }?>><?= $allCount->name; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                      
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="section">Select City</label>
                                             <select name="city" class="form-control" id="cityAd" required>
                                                <option value="">Select City</option>
                                                <?php
                                                   $stateValue = $this->General_Model->getAllItemTable_Array('states', array('country_id' => $selected_customer->country ))->result();
                                                   foreach ($stateValue as $key =>  $getMatch) {
                                                   ?>
                                                <option value="<?= $getMatch->id; ?>"   <?php 
                                          if ($key == 1) { echo 'selected'; } ?> ><?= $getMatch->name; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                     <div class="columns">

                                        <div class="column is-2">
                                          <div class="details">
                                             <label for="row">Phone Code</label>
                                             <input type="text" id="phoneCode" placeholder="e.g. +1 702 123 4567" name="phoneCode" value="<?php if ($selected_customer): echo $selected_customer->dialing_code; endif; ?>" required>
                                          </div>
                                       </div>
                                        <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Phone</label>
                                             <input type="text" placeholder="" name="billingphonenumber" id="billingPhonenumber" class="input-box" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if ($selected_customer): echo $selected_customer->mobile; endif; ?>" required>                                                        
                                            
                                          </div>
                                       </div>
                                     
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Email</label>
                                             <input type="text" id="email" placeholder="Email" name="email" value="<?php if ($selected_customer): echo $selected_customer->email; endif; ?>" required>
                                          </div>
                                       </div>

                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Price</label>
                                             <input type="text" id="price" placeholder="Price" name="price" value="<?php echo $category_details['total_amount'];?>" required>
                                          </div>
                                       </div>

                                    </div>
                                      <!--  <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Phone</label>
                                             <input type="text" id="phoneCode" placeholder="e.g. +1 702 123 4567" name="phonecode" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->phonecode; endif; ?>" readonly>
                                             <input type="text" placeholder="" name="billingphonenumber" id="billingPhonenumber" class="input-box" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->mobile; endif; ?>">                                                        
                                             <input type="hidden" id="stadiumblockid" name="stadiumblockid" value="<?= $stadiumdetails[0]->ticket_block; ?>">
                                          </div>
                                       </div> -->
                                       <!-- <div class="column is-one-three">
                                          <?php if($stadiumdetails[0]->ticket_type != 2) { ?>
                                          <div class="field check_box_coll button_container">
                                             <?php if(count($addresses) >= 0) { ?>
                                             <label><input type="checkbox" checked id="notSameaddress">Billing Address Same<i></i></label>
                                             <label><input type="checkbox" value="" id="notLater">Shipping Address<i></i></label>
                                             <?php } ?>
                                          </div>
                                          <?php } ?>
                                       </div> -->
                                       <div class="shipping_address_new" style="display: none;">
                                          <div class="column is-one-three">
                                             <div class="details shipfirstname"> 
                                                <label>First Name *</label>
                                                <input type="text" placeholder="" name="shipfirstname" id="shipfirstname" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->first_name; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shiplastname"> 
                                                <label>Last Name *</label>
                                                <input type="text" placeholder="" name="shiplastname" id="shiplastname" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->last_name; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipAddress"> 
                                                <label>Address *</label>
                                                <input type="text" placeholder="" name="shipaddress" id="shipAddress" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->address; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipPostalcode"> 
                                                <label>Postal Code *</label>
                                                <input type="text" placeholder="" name="shippostalcode" id="shipPostalcode" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->code; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipCity">
                                                <label>Select City *</label>
                                                <select name="shipCity" class="form-control" id="shipCity">
                                                   <option value="">Select City</option>
                                                   <?php 
                                                      $stateValue = $this->General_Model->getAllItemTable_Array('states', array('country_id' => $getRegisterDataByid[0]->country))->result();
                                                      foreach ($stateValue as $getMatch) {
                                                      ?>
                                                   <option value="<?= $getMatch->id; ?>" <?php if ($stateValue): if ($getRegisterDataByid[0]->city == $getMatch->id) { echo 'selected'; } endif; ?>><?= $getMatch->name; ?></option>
                                                   <?php } ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipCountry">
                                                <label>Select Country *</label>
                                                <select name="shipCountry" class="form-control countries" id="shipCountry">
                                                   <option value="">Select Country</option>
                                                   <?php foreach ($allCountries as $allCount) { ?>
                                                   <option value="<?= $allCount->id; ?>" <?php if ($getRegisterDataByid){ if ($getRegisterDataByid[0]->country == $allCount->id) { echo 'selected'; } } else { if($allCount->id == '230'){ echo 'selected'; } } ?>><?= $allCount->name; ?></option>
                                                   <?php } ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="ship_country country_phone details">
                                                <input type="text" id="shipPhonecode" placeholder="" name="shipphonecode" value="<?php if ($getRegisterDataByid): echo $allCount->phonecode; endif; ?>" readonly>
                                                <input type="text" placeholder="" name="shipphonenumber"  id="shipPhonenumber" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->phone; endif; ?>">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                               
                              </div>
                           </div>
                      
                        </div>
                  <div class="card rounded-0 shadow-none">
                     <div class="card-body all_new_orders">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="ticket_time_mins">
                                 <p>Tickets are in your hands! Confirm before 10 minutes as these tickets may not be available, or price might change</p>
                                 <span id="timer_span" class="timer_span">10:00</span>
                              </div>
                           </div>
                           <div class="col-lg-5">
                              <div class="orders_team_name">
                                <h3><?php echo $category_details['match_name'];?> - <?php echo $category_details['tournament_name'];?></h3>
                                <p><span class="no_of_ticket"><i class="mdi mdi-ticket-confirmation-outline"></i> <?php echo $category_details['no_ticket'];?> Tickets</span> <span class="ticket_trans">Mobile Tickets Transfer</span></p>
                                <p><span class="date_and_tim"><?php echo date('D', strtotime($category_details['match_date']));?> <?php echo $category_details['match_date'];?></span> </p>
                                <p><span class="team_place"><?php echo $category_details['stadium_name'];?>, Doha, Qatar</span></p>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="total_amt_price">
                                 <table style="width:100%;" class="blk_sect">
                                   <tbody>
                                      <tr>
                                         <td class="fees_tax">Fees & Taxes: </td>
                                         <td class="fees_tax"><?php echo $category_details['tax_fees_with_symbol'];?></td>
                                       </tr>
                                       <tr>
                                         <td class="total_val">Total: </td>
                                         <td class="total_price"><?php echo $category_details['total_amount_sys'];?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <button class="btn btn-info ml-1 waves-effect waves-light rounded-0" data-effect="wave" type="submit">Confirm Order</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
  </form>
                    <?php } ?>

               </div>
            </div>
         </div>
      </div>
      <!-- main content End -->

      <div id="modal_content_ajax">
				<!-- Your modal content here -->
				</div>
<?php $this
   ->load
   ->view(THEME.'common/footer'); ?>
<script >
   $('#event_selection_id').change(function(e) {
       let customer_id = $('#customer_selection_id').val();
       if(customer_id == "") return;
   
       var uri = window.location.toString();
       if (uri.indexOf("?") > 0) {
           var clean_uri = uri.substring(0, uri.indexOf("?"));
           window.history.replaceState({}, document.title, clean_uri);
       }
   
       window.location.href = '?match_id=' + $(this).val() + "&customer_id="+customer_id;
   });
</script>

<?php if ($this
   ->uri
   ->segment(3) != 'checkout')
   { ?>

<script type="text/javascript">
   <?php if ($this->input->get('match_id')) {?>
   var full_block_data = <?=($full_block_data) ?>;
   var stadium_block_details =<?=$set_stadium_blocks ?>;
   var stadium_cat_details =<?=$set_stadium_blocks_with_cat ?>;
   var stadium_with_cat_name =<?=$set_stadium_cat_name ?>;
   var ticket_price_info =<?=$ticket_price_info ?>;
   var ticket_price_info_with_cat =<?=$ticket_price_info_with_cat ?>;
   var current_category = 0;
<?php } ?>
</script>
<script type="text/javascript">




   
   
    jQuery(document).ready(function () {

      $('.btn-cancel').click(function (e){                     
                    $('#centermodal_add')
                              .find("input,textarea,select")
                                 .val('')
                                 .end()
                              .find("input[type=checkbox], input[type=radio]")
                                 .prop("checked", "")
                                 .end();
                    $('.close').trigger('click');
                 });

                 $('.close').click(function (e){                     
                    $('#centermodal_add')
                              .find("input,textarea,select")
                                 .val('')
                                 .end()
                              .find("input[type=checkbox], input[type=radio]")
                                 .prop("checked", "")
                                 .end();                   
                 });

      $('#createCustomer').click(function() {
                  // Validate form fields
                  var firstName = $('#firstName').val();
                  var lastNames = $('#lastNames').val();
                  var emailId = $('#emailId').val();

                  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                  var PhoneNumber = $('#PhoneNumber').val();
                  var address = $('#address').val();
                  var zipCode = $('#zipCode').val();
                  add_customer_country
                  var country = $('#add_customer_country').val();
                //  var state = $('#add_customer_state').val();
                  var city = $('#add_customer_city').val();
                  var password = $('#password').val();
                  var confirmPassword = $('#confirmPassword').val();
                  var dialing_code =$("#dialing_code").val();
                  var allow_offline =0;
                  if ($("#Booking").is(':checked')) 
                      allow_offline=1;                
                  
                  var status =0;
                  if ($("#customerStatus").is(':checked')) 
                     status=1;  

                  // Clear previous error messages
                  $('.form-control').removeClass('is-invalid');
               
                  // Check if any field is empty
                  if (firstName === '') {
                     $('#firstName').addClass('form-control is-invalid');
                  }
                  if (lastNames === '') {
                     $('#lastNames').addClass('form-control is-invalid');
                  }
                  // Check if email field is empty or does not match the pattern
                  if (emailId === '' || !emailPattern.test(emailId)) {                     
                     $('#emailId').addClass('form-control is-invalid');
                  }
                  
                  if (PhoneNumber === '') {
                     $('#PhoneNumber').addClass('form-control is-invalid');
                  }
                  if (address === '') {
                     $('#address').addClass('form-control is-invalid');
                  }
                  if (zipCode === '') {
                     $('#zipCode').addClass('form-control is-invalid');
                  }
                  if (country === '') {
                     $('#add_customer_country').addClass('form-control is-invalid');
                  }
                  // if (state === '') {
                  //    $('#add_customer_state').addClass('form-control is-invalid');
                  // }
                  if (city === '') {
                     $('#add_customer_city').addClass('form-control is-invalid');
                  }
                  if (password === '') {
                     $('#password').addClass('form-control is-invalid');
                  }
                  if (confirmPassword === '') {
                     $('#confirmPassword').addClass('form-control is-invalid');
                  } 
                  if (password !== confirmPassword) {
                     $('#confirmPassword').addClass('form-control is-invalid');
                  }
               
                  // If there are any error messages, stop further processing
                  if ($('.is-invalid').length > 0) {
                     return;
                  }

                  $.ajax({
                           url: base_url + 'settings/customers/save_customer',
                           method: 'POST',
                           data: {
                           firstName: firstName,
                           lastNames: lastNames,
                           emailId: emailId,
                           PhoneNumber: PhoneNumber,
                           address: address,
                           zipCode: zipCode,
                           country: country,
                         //  state: state,
                           city: city,
                           password: password,
                           phonecode: "+91",
                           allow_offline: allow_offline,
                           status: status,
                           },
                           success: function(response) {
                           // Handle success response
                            swal('Updated !', response.msg, 'success');
                          setTimeout(window.location.reload(),300);

                           },
                           error: function(error) {
                           // Handle error response
                           }
                  });
               
                  });

      $("#content_1").mCustomScrollbar({
          scrollButtons:{
            enable:true
          }
        });

        
   <?php if ($this->input->get('match_id')) {?>


      $('.ticket_qunaity').click(function(){
         //alert($(this).data('quantity'));
       $('#noofticket').val($(this).data('quantity'));
        var cat = $('#allticktype').val();
        ////console.log(cat);
        if(cat != null)
       // get_ticket(cat);
        selectCategory(cat);
     });

       $('.seller_id').click(function(){
          // alert($(this).data('id'));
       $('#seller_id').val($(this).data('id'));
        var cat = $('#allticktype').val();
        ////console.log(cat);
        if(cat != null)
       // get_ticket(cat);
        selectCategory(cat);
     });


  
       $('#noofticket, #allticktype',"#seller_id").change(function(){
        var cat = $('#allticktype').val();
        ////console.log(cat);
        if(cat != null)
       // get_ticket(cat);
        selectCategory(cat);
     });

       
     get_ticket(0);


       var stadiumId = '<?php if ($stadiumImage): echo $stadiumImage[0]->s_id;endif; ?>';
       var overlay = $('#overlay');
       $.ajax({
           type: "POST",
           url: "<?=base_url('game/orders/get_stadium_api') ?>",
           data: {'stadiumid': stadiumId},
           beforeSend: function() {
      // Show the overlay before the AJAX call
      overlay.show();
    },
           success: function (response)
           {
               //console.log(response);
                 var jsonObject = $.parseJSON(response);

               //console.log(jsonObject);

                var status = jsonObject['Status'];
                var object = jsonObject['Json'];


                var stadiumCode = object['map_code'];
               var stadiumValue = $.parseJSON(stadiumCode);
               if (status == 'OK') {
   
                   jQuery("#mapsvg").mapSvg(stadiumValue);
   
                   setTimeout(function () {
                       var svg_data = stadiumValue;
                       $.each(svg_data.regions, function (svg_itm, svg_val) {
                           if ($("#" + svg_val.id).attr("class")) {
                               var exist_class = $("#" + svg_val.id).attr("class");
                           } else {
                               var exist_class = "";
                           }
   
                           $("#" + svg_val.id).attr("class", exist_class + " " + svg_val.href.replace(/[^a-zA-Z0-9]/g, '').toLowerCase());
                           $("#" + svg_val.id).attr("data-cat", stadium_with_cat_name[svg_val.href][0]);
                           //$('.mapsvg-region').css('pointer-events', 'none');
   
                       });
                       $(".mapsvg-region").each(function () {
                           $(this).css('opacity', '0.5');
                           // console.log('full_block_data', full_block_data)
                           if (full_block_data == null) {
                               /* $(".mapsvg-region").each(function () {
                                $(this).css('opacity', '0.5');
                                }); */
   
                           } else {
                               $('.mapsvg-region').css('pointer-events', '');
                               $.each(full_block_data, function (indx, itm) {
                                   if (itm != '') {
                                       $.each(itm, function (indx2, itm2) {
                                           if(itm2 != "") {
                                               $('#' + itm2).css('opacity', '1');
                                               $('#' + itm2).css('cursor', 'pointer');
                                           }
                                       })
                                   }
                               });
                           }
   
                       });
   
   <?php if ($checkSellTicketData):
    
      ?>
                               //$('#content-l').css({'height': $('#Layer_1').innerHeight()});
                               var heightValue = parseInt($('#Layer_1').innerHeight() - 46);
                               //$('#content-l').css({'height': heightValue});
   
   <?php
  
      endif;
      ?>
                       $(".statium_select_seat").removeAttr("style");
                       $("#mapsvg").css("visibility", "visible");
                   }, 2000);
               }
           },
           complete: function() {
      // Hide the overlay after the AJAX call is complete (regardless of success or error)
      overlay.hide();
    }
       });
    <?php } ?>
   });
     
   
   function noTickets(value) {
       $('.noticketsform').each(function () {
           $(this).val(value);
       });
   
       var matchId = '<?=@$checkSellTicketData->m_id ?>';
       var ticketType = $('#allticktype').val();
       if (ticketType != 0) {
           var ticketcategory = stadium_with_cat_name[ticketType][0];
           data = {'matchid': matchId, 'notickets': value, 'ticketcategory': ticketcategory};
       } else {
           data = {'matchid': matchId, 'notickets': value};
       }
       $.ajax({
           type: 'POST',
           url: '<?=base_url('game/getSellTicketsById') ?>',
           data: data,
           success: function (response) {
               var jsonObject = $.parseJSON(response);
               var status = jsonObject['Status'];
               var getJsonArray = jsonObject['Json'];
               // console.log(getJsonArray.length);
               /*$("#allticktype").val("0");
                $("#allticktype").trigger("change");*/
               if (getJsonArray != '') {
                   $.each(getJsonArray, function (index, item) {
                       // console.log("#seatid-" + item.s_no);
                       if (item.ticket_block != '') {
                           //  $('#text-message').text('Ticket prices are set by sellers and may be below or above face value.');
                           $("#seatid-" + item.ticket_block).each(function (i) {
                               $(this).hide().delay(i * 1).fadeIn(1).siblings(".seat_select_items").hide();
                           });
                       } else {
                           $('#ticket-message').text('');
                           $("#seatid-" + item.s_no).each(function (i) {
                               $(this).hide().delay(i * 1).fadeIn(1).siblings(".seat_select_items").hide();
                               
                           });
                       }
                   });
                   
                   $('.ticket_tab_flt4 select').val(value);
                   
               } else {
                   $('#ticket-message').text('there are no tickets matching your criteria');
                   $(".seat_select_items").hide();
               }
   
           }
       })
   }
   
   function goCheckOut(obj) {
       var sellticid = obj.getAttribute('data-sellid');
       
       $("#checkout-" + sellticid + " input[name=nooftick]").val($('#noofticket'+sellticid).val());
   
       $('.tick_book_btn > a').html('select').removeClass('ticket-selected');
   
       $(obj).html('selected').addClass('ticket-selected');
       
       // $('#checkout-' + sellticid).submit();
      var customer_id = "<?=$this->input->get('customer_id') ;?>";
      var overlay = $('#overlay');
      //alert(customer_id);
       $.ajax({
           type: 'POST',
           url: $('#checkout-' + sellticid).attr('action'),
           data: $('#checkout-' + sellticid).serialize()  + "&customerid=" +customer_id,
           beforeSend: function() {
            // Show the loader before the AJAX call
            overlay.show();
            }, 
           success: function(response) {
               var jsonObject = $.parseJSON(response);
               if(jsonObject.status == 1){
              
                   window.location.href = "<?php echo base_url();?>game/orders/add_order?match_id="+jsonObject.match_id+"&customer_id="+jsonObject.customer_id+"&cid="+jsonObject.cid;
               }
               else{
                   alert(jsonObject.msg);
               }
               
              // $('#order-checkout-section').html(response);
           },
           complete: function() {
            // Hide the loader after the AJAX call is complete (regardless of success or error)
            overlay.hide();
            }   
       });
   }
   
   
   function selectType(value) {
       // console.log('value', value)
       if (value != 0) {
           $(".seat_select_items").hide();
       } else {
           $(".seat_select_items").show();
       }
       $("#allticktype").val(value);
       selectCategory(value);
   }
   
    function selectSeller(value) {

       var cat = $('#allticktype').val();
        ////console.log(cat);
        if(cat != null)
       // get_ticket(cat);
        selectCategory(cat);
   }
   
   
   $(document).ready(function () {
     /*  $('[data-toggle="tooltip"]').tooltip();*/
       $('.chng_cur').on('click', function () {
           var selected = $(this).data('currency');
           $.ajax({
               type: "POST",
               url: "<?php echo base_url('home/setcurrency'); ?>",
               data: {'currency': selected},
               success: function (response)
               {
                   location.reload();
               }
           });
       });
   
       //Dhana Moorthi
       /*          setTimeout(function () {
        var stickyNavTop = jQuery('.ticket_sold_notice').offset().top;
        
        var stickyNav = function () {
        var scrollTop = jQuery(window).scrollTop();
        
        if (scrollTop > stickyNavTop) {
        jQuery('.ticket_sold_notice').addClass('sticky');
        } else {
        jQuery('.ticket_sold_notice').removeClass('sticky');
        }

        };
        
        stickyNav();
        jQuery(window).scroll(function () {
        stickyNav();
        });
        }, 1000); */
   
   });

    function selectType(value) {
        if (value != 0) {
            $(".seat_select_items").hide();
        } else {
            $(".seat_select_items").show();
        }
        selectCategory(value);
    }

     function selectCategory(value) {
        $("#allticktype").val(value);

        // alert();
        var no_tckt = $("#noofticket").val();
        if (no_tckt != '') {
            var matchId = '<?=@$checkSellTicketData->m_id ?>';
            get_ticket(value);
            
        } else {
            get_ticket(value)
        }

        if (value == 0) {

            console.log(value);
            current_category = 0;
            $(".seat_select_items").each(function (i) {
                $(this).show();
            });
            $.each(stadium_cat_details, function (indx, itm) {
                $.each(itm, function (indx2, itm2) {
                    //$('#'+itm2).css('opacity', '1');
                    $('#' + itm2).css({fill: stadium_block_details[itm2]});
                    var sn_exst = 0;
                    $.each(full_block_data, function (indx_s, itm_s) {
                        if ($.inArray(itm2, itm_s) !== -1) {
                            sn_exst++;
                            //break;
                        }
                    });

                    if (sn_exst > 0) {
                        $('#' + itm2).css('opacity', '1');
                    } else {
                       // $('#' + itm2).css('opacity', '0.5');
                    }
                });
            });
            //$('.mapsvg-region').css('pointer-events', '');
        } else {
            var selectCategory = value.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();

            //console.log(selectCategory);
            var categoryId = stadium_with_cat_name[value][0];
            current_category = categoryId;
            $(".mapsvg-region").css({fill: 'rgb(221, 221, 221)'});
            //$(".mapsvg-region").css('pointer-events', 'none');
            $.each(stadium_cat_details, function (indx, itm) {
                if (parseInt(indx) == parseInt(categoryId)) {
                    $.each(itm, function (indx2, itm2) {
                        $('#' + itm2).css({fill: stadium_block_details[itm2]});
                        //$('#'+itm2).css('pointer-events', '');
                        var sn_exst = 0;
                        $.each(full_block_data, function (indx_s, itm_s) {
                            if ($.inArray(itm2, itm_s) !== -1) {
                                sn_exst++;
                                //break;
                            }
                        });

                        if (sn_exst > 0) {
                            $('#' + itm2).css('opacity', '1');
                        } else {
                            //$('#' + itm2).css('opacity', '0.5');
                        }

                    });
                }
            });
        }

    }
   

   function get_ticket(cat){

       
        // alert();
        //alert(cat);
        var qty = $('#noofticket').val();
        var seller_id = $('#seller_id').val();
        var overlay = $('#overlay');
        $("#loading_2").show();
        $('.tickets_details_list').html("");
        $.ajax({
            url:  "<?php echo base_url();?>game/orders/get_ticket",
            type: "post",
            dataType: "json",
            data: { "category":cat,"quantity":qty,"seller_id" : seller_id ,"match_id": "<?=$this->input->get('match_id') ;?>"},
            beforeSend: function() {
               // Show the loader before the AJAX call
               overlay.show();
            },
            success: function(response) {
                if(response.success == true && response.html != ""){
                    $("#loading_2").hide();
                    $('.tickets_details_list').html(response.html);
                } 
            },
            complete: function() {
               // Hide the loader after the AJAX call is complete (regardless of success or error)
               overlay.hide();
            }            
        });
     }

    function showMouseOver(obj) {
        var mouseHover = obj.getAttribute('data-target');
        var categoryId = obj.getAttribute('data-ticketcategory');
        var matchId = obj.getAttribute('data-matchid');
        var blockColor = obj.getAttribute('color-code');
        var ticketsCount = obj.getAttribute('tickets');
        var mapId = obj.getAttribute('map-id');
        var blockId = obj.getAttribute('data-blockid');
        var dataClass = obj.getAttribute('data-class');
        var mouseHoverValue = mouseHover.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
        if (ticketsCount == 0) {
            return false;
        } else {
            //$(".mapsvg-region").css('opacity', '0.5');
            $(".mapsvg-region").css({fill: 'rgb(221, 221, 221)'});
            if (blockId != "0") {
                $('#' + blockId).css('opacity', '1');
                $('#' + blockId).css({fill: stadium_block_details[blockId]});
            } else {

                $.each(stadium_cat_details, function (indx, itm) {
                    if (parseInt(indx) == parseInt(categoryId)) {
                        $.each(itm, function (indx2, itm2) {
                            var sn_exst = 0;
                            $('#' + itm2).css({fill: stadium_block_details[itm2]});
                            $.each(full_block_data, function (indx_s, itm_s) {
                                if ($.inArray(itm2, itm_s) !== -1) {
                                    sn_exst++;
                                    //break;
                                }
                            });

                            if (sn_exst > 0) {
                                $('#' + itm2).css('opacity', '1');
                            } else {
                               // $('#' + itm2).css('opacity', '0.5');
                            }
                        });
                    }
                });
                /*$.each(full_block_data,function(indx, itm){
                 if(parseInt(indx)==parseInt(categoryId)){
                 $.each(itm,function(indx2, itm2){
                 $('#'+itm2).css('opacity', '1');
                 $('#'+itm2).css({fill: stadium_block_details[itm2]});
                 });
                 }
                 });*/
            }
            // if (mapId) {
            //     //$('#seatid-'+mapId).css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');

            //     $('.seat_select_items[data-blockid="' + mapId + '"]').css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');
            // } else {
            //     $('.' + mouseHoverValue).css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');
            // }
            // $('.' + mouseHoverValue + '-button').children().css('background', '#d9d9d9');
        }

    }

    function hideMouseOver(obj) {
        var mouseHover = obj.getAttribute('data-target');
        var blockColor = obj.getAttribute('color-code');
        var areaid = obj.getAttribute('map-id');
        var ticketsCount = obj.getAttribute('tickets');
        var dataClass = obj.getAttribute('data-class');
        if (ticketsCount == 0) {
        } else {
            var mouseHoverValue = mouseHover.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
            /*$(".mapsvg-region").each(function () {
             $(this).css('opacity', '1');
             });*/
            if (parseInt(current_category) != 0) {
                $.each(stadium_cat_details, function (indx, itm) {
                    if (parseInt(indx) == parseInt(current_category)) {
                        $.each(itm, function (indx2, itm2) {
                            $('#' + itm2).css('opacity', '1');
                            $('#' + itm2).css({fill: stadium_block_details[itm2]});
                        });
                    }
                });
            } else {
                $.each(stadium_cat_details, function (indx, itm) {
                    $.each(itm, function (indx2, itm2) {
                        $('#' + itm2).css('opacity', '1');
                        $('#' + itm2).css({fill: stadium_block_details[itm2]});
                    });
                });
            }

            $(".mapsvg-region").each(function () {
               // $(this).css('opacity', '0.5');
                if (full_block_data == null) {
                    $(".mapsvg-region").each(function () {
                        //$(this).css('opacity', '0.5');
                    });
                } else {
                    $.each(full_block_data, function (indx, itm) {
                        if (itm != '') {
                            $.each(itm, function (indx2, itm2) {
                                $('#' + itm2).css('opacity', '1');
                            })
                        }
                    });
                }

            });
            // $('.' + mouseHoverValue).css('background', '');
            // $('.' + mouseHoverValue + '-button').children().css('background', '#fff');
        }
    }


    function convertHex(hex, opacity) {
        hex = hex.replace('#', '');
        rgb = hex.replace(/[^\d,]/g, '').split(',');
        r = parseInt(rgb[0]);
        g = parseInt(rgb[1]);
        b = parseInt(rgb[2]);
        result = 'rgba(' + r + ',' + g + ',' + b + ',' + 0.25 + ')';
        return result;
    }
    function convertHexMap(hex, opacity) {
        hex = hex.replace('#', '');
        rgb = hex.replace(/[^\d,]/g, '').split(',');
        r = parseInt(rgb[0]);
        g = parseInt(rgb[1]);
        b = parseInt(rgb[2]);
        result = 'rgba(' + r + ',' + g + ',' + b + ')';
        return result;
    }
</script>
<script type="text/javascript">
   $(document).ready(function () {
      var overlay = $('#overlay');
       $("#read_more").click(function () {
           if ($("#me_top .entry-content").hasClass("active")) {
               $("#me_top .entry-content").removeClass("active");
           } else if (!$("#me_top .entry-content").hasClass("active")) {
               $("#me_top .entry-content").addClass("active");
           }
           if ($(this).hasClass("active")) {
               $(this).removeClass("active");
           } else if (!$(this).hasClass("active")) {
               $(this).addClass("active");
           }
       });
   });
   
   // $(document).on('click', 'a[href^="#"]', function (event) {
   //     event.preventDefault();
   
   //     $('html, body').animate({
   //         scrollTop: $($.attr(this, 'href')).offset().top - 60
   //     }, 500);
   // });
        
</script>
<?php
   } ?>
<script>
  
   <?php if ($cid) {?>
 
 $(document).ready(function () {

   $("body").on('click',' #new_order',function(e){
                      //var myform = $('#'+$(form).attr('id'))[0];
                      var myform = $('#order-form')[0];
                      var formData = new FormData(myform);
                      //$('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");
                      $('#order-form'+'-btn').addClass("is-loading no-click");

                      $('.has-loader').addClass('has-loader-active');
                       var submit = $("#order-form").find('button:first');
                         submit.attr("disabled", true);
                         submit.html('<i class="fa fa-spinner fa-spin" style="color:#color: #325edd;"></i>&nbsp;Processing ...');
                        //action="";
                     // var action = $(form).attr('action');
                      var action = $('#order-form').attr('action');
                      $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: action,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",

                        success: function(data) {
                            submit.html("Confirm Order");
                           console.log(data);

                          if(data.status == 1) {
                        //    alert('Booking Success');
                            swal('Updated !', "Booking Success", 'success');
                            setTimeout(window.location.reload(),300);
                          }else if(data.status == 0) {
                             submit.attr("disabled", false);
                              swal('Updated !', data.msg, 'success');
                            setTimeout(function(){ window.location.href = data.redirect_url; }, 1000);
                            
                          }
                          
                        }
                   })
                   return false;
            //      }
     
            //   else{
            //       return false;
            //   }
           // });

   });

       $('#order-form').validate({
         

         submitHandler: function(form) {

		var data_title = $(".call_modal").attr('data-title');
		var data_sub_title = $(".call_modal").attr('data-sub-title');
		var data_yes = $(".call_modal").attr('data-yes');
		var data_no = $(".call_modal").attr('data-no');
		var data_btn = $(".call_modal").attr('data-btn-id');
		var data_target = $(".call_modal").attr('data-target');
		var data_bg_id = "";
      var data_form="";
		
	$.ajax({
			url: '<?php echo base_url();?>game/call_modal',
			type: "POST",
			data: {  "data_title": data_title ,"data_sub_title":data_sub_title, "data_yes":data_yes,"data_no":data_no,"data_btn":data_btn,"data_target":data_target ,"data_bg_id":data_bg_id,"data_form":data_form},
			success: function (response) {  
				$("#modal_content_ajax").html(response); 
				 $('#'+data_target).modal("show");  
				//$("#").modal('show');
			},
			error: function () {
			}
		});
    /*  swal({
               title: 'Are you sure?',
               text: "Are you sure want to do the make booking?!",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#0CC27E',
               cancelButtonColor: '#FF586B',
               confirmButtonText: 'Yes, Proceed!',
               cancelButtonText: 'No, Cancel!',
               confirmButtonClass: 'btn btn-primary',
               cancelButtonClass: 'btn btn-danger',
               buttonsStyling: false
            }).then(function (res) {

                  if (res.value == true) {

                      var myform = $('#'+$(form).attr('id'))[0];
                      //is-loading no-click
                     // branch-form-btn
                      var formData = new FormData(myform);
                      $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

                      $('.has-loader').addClass('has-loader-active');
                       var submit = $("#order-form").find('button:first');
                         submit.attr("disabled", true);
                         submit.html('<i class="fa fa-spinner fa-spin" style="color:#color: #325edd;"></i>&nbsp;Processing ...');
                     //   action="";
                      var action = $(form).attr('action');
                      $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: action,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",

                        success: function(data) {
                            submit.html("Confirm Order");
                           console.log(data);

                          if(data.status == 1) {
                        //    alert('Booking Success');
                            swal('Updated !', "Booking Success", 'success');
                            setTimeout(window.location.reload(),300);
                           // window.location.href = data.redirect_url;
                            // notyf.success(data.msg, "Success", {
                            // timeOut: "1800"
                            // });
                            // setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                          }else if(data.status == 0) {
                             submit.attr("disabled", false);
                           //  alert('Failed')
                              swal('Updated !', data.msg, 'success');
                            setTimeout(function(){ window.location.href = data.redirect_url; }, 1000);
                            //  notyf.error(data.msg, "Failed", "Oops!", {
                            // timeOut: "1800"
                            // });
                            // setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                            
                          }
                          
                        }
                   })
                   return false;
                 }
     
              else{
                  return false;
              }
            });*/
         }
         });
   




       var timerData = [];
    function secondPassed(row) {
        var seconds = timerData[row].remaining;
        var minutes = Math.round((seconds - 30) / 60);
        var remainingSeconds = seconds % 60;
    
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }
        if(seconds == 60){
          openModal();
           seconds--;
           $(".timer_span").html(minutes + ":" + remainingSeconds)
            //document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;

        }
        else if (seconds <= 0) {
           // console.log("-----------");
            clearInterval(timerData[row].timerId);
           // release_ticket();
      
                let customer_id = $('#customer_selection_id').val();
                    
                  document.location.href= '?match_id=<?php echo $this->input->get('match_id') ;?>&customer_id='+customer_id ;
        } else {
            seconds--;
            $(".timer_span").html(minutes + ":" + remainingSeconds)
            //document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;
        }
        timerData[row].remaining = seconds;
    }
    function timer(row, min) {
            timerData[row] = {
                    remaining:min,
                    timerId: setInterval(function () { secondPassed(row); }, 1000)
                };
            var sec=timerData[row].timerId;
    }

   
   <?php
      
        $old = strtotime(date("m/d/Y h:i:s ",strtotime($category_details['current_time'])));
        $new = strtotime(date('m/d/Y, h:i:s',strtotime($category_details['expriy_datetime'])));
        $time = ($new - $old);
    
    ?>
   
    console.log(<?php echo $time;?>);
    timer(<?php echo "1"; ?>,<?php echo $time; ?>);

 

    // openModal();
   function openModal() {
    

            swal({
               title: 'Your Time Is Up! Would you like to release your tickets?',
               text: "If you choose release these tickets, they will become available for others to buy. Please note that these tickets may not be available at this price.",
               type: 'warning',
               allowOutsideClick: false,
               showCancelButton: true,
               confirmButtonColor: '#0CC27E',
               cancelButtonColor: '#FF586B',
               confirmButtonText: 'Release My Tickets',
               cancelButtonText: 'Continue Purchase',
               confirmButtonClass: 'btn btn-success',
               cancelButtonClass: 'btn btn-primary',
               buttonsStyling: false
            }).then(function (res) {

                  if (res.value == true) {

                     $.ajax({
                    url: "<?=base_url('game/orders/delete_cart') ?>",
                    type: "post",
                    dataType: "json",
                     data: {'cid' : ' <?php echo $cid; ?>'},
                    success: function(response) { 

                     let customer_id = $('#customer_selection_id').val();
                     if(response.status == 1){
                         document.location.href= '?match_id=<?php echo $this->input->get('match_id') ;?>&customer_id='+customer_id ;

                        }
                        else{
                          //  alert(response.message);
                            swal('Updation Failed !', response.message, 'error');

                        }
                    }            
                });

                  }
                  else{


                      $.ajax({
                          url: "<?=base_url('game/orders/update_cart') ?>",
                          type: "post",
                          dataType: "json",
                          data: {'cid' : ' <?php echo $cid; ?>'},
                          success: function(response) { 

                              if(response.status == 1){
                                  console.log(response.time);
                                  timer(<?php echo "1"; ?>,response.time);
                                  //document.location.href= "{{url('/')}}";
                              }
                              else{
                                  alert(response.message);
                              }
                          }            
                      });
                     
                  }
            });
      
   }
   


});

<?php } ?>


function get_state_city(state_id){
  if(state_id != ''){ 
  // $('#add_customer_city').html("");
    $.ajax({
      type: "POST",
      url: base_url + 'home/master/get_city',
      data: {'state_id' : state_id},
      dataType: "json",
      success: function(data) {
       
        var state = JSON.parse(JSON.stringify(data));
        var citites  = state.cities;
        var cityArr = [];
        var city_name ="";
        //$('#state_name').html('');
        cityArr[0] = "<option value=''>Select City</option>";
        $.each(citites, function(i, option)
        { 
        var sel = '';
        if(city_name == option['id']){
        sel = 'selected';
        }
        cityArr[i+1] = "<option value='" + option['id'] + "' "+sel +">" + option['name'] + "</option>";

        
        });

        $('#add_customer_city').html(cityArr.join(''));
      
      }
    })

  }
}
</script>