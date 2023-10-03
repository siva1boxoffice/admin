
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

                        <h5 class="card-title"><div class="go_back_btn"><a href="<?php echo base_url(); ?>settings/customers/customer_list"><i class="fas fa-arrow-left"></i></a></div>Customer Info</h5>
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
                              <ul class="nav nav-tabs nav-bordered">
                                  <li class="nav-item">
                                    <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                      Personal Info
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                      Address Info
                                    </a>
                                  </li>
                              </ul>
                              <div class="tab-content mt-3">
                                 <div class="tab-pane show active" id="home-b1">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card mb-0 shadow-none">   
                                             
                                             <div class="row column_modified data_hide ">
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="simpleinput" class="mb-0 gr_clr">First Name</label><br>
                                                       <span><?php echo $customer_data[0]->first_name;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Last Name</label><br>
                                                       <span><?php echo $customer_data[0]->last_name ;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="example-email" class="mb-0 gr_clr">Email ID</label><br>                                                       
                                                       <span><?php echo $customer_data[0]->email ;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Phone Number</label><br>                                                       
                                                       <span><?php echo $customer_data[0]->mobile ;?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Birth Date</label><br>
                                                       <span><?php                                                       if($customer_data[0]->dob!="")
                                                       {
                                                         
                                                     
                                                       $dateTime = DateTime::createFromFormat('Y-m-d', $customer_data[0]->dob);
                                                      $newDateString = $dateTime->format('j F, Y');
                                                      echo $newDateString; // Outputs: 12th May, 1990
                                                   }
                                                   else 
                                                   echo "";
                                                       ?></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Language</label><br>
                                                       <span>English</span>
                                                   </div>
                                                </div> 
                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="edit_btn btn btn-primary ms-1 waves-effect waves-light " data-effect="wave" type="submit">Edit</button>
                                                   </div> 
                                                </div>                           
                                             </div> <!-- end col -->

                                             <form name="edit_profile" id="customer_data">
                                                <input type='hidden' name="cust_id" value="<?php echo $customer_data[0]->id;?>">
                                             <div class="row column_modified edit_data data_show" style="display:none;">
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">First Name</label>
                                                       <input type="text" name="first_name" id="simpleinput" class="form-control rounded-0" placeholder="First Name" value="<?php echo $customer_data[0]->first_name;?>">
                                                   </div> 
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Last Name</label>
                                                       <input type="text" name="last_name" id="simpleinput" class="form-control rounded-0" placeholder="Last Name"  value="<?php echo $customer_data[0]->last_name ;?>">
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="example-email" class="mb-0 gr_clr">Email ID</label>
                                                       <input type="email" name="email" id="example-email" class="form-control rounded-0" placeholder="Email" value="<?php echo $customer_data[0]->email ;?>">
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Phone Number</label>
                                                       <input type="text" id="simpleinput" class="form-control rounded-0" placeholder="Phone Number" value="<?php echo $customer_data[0]->mobile ;?>" >
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Birth Date</label>
                                                       <input type="text" name="dob" id="MyTextbox1" class="form-control rounded-0" placeholder="Birth Date" value="<?php echo $customer_data[0]->dob ;?>">

                                                       <!-- <input class="form-control" id="MyTextbox1" type="text" name="MyTextbox1" placeholder="To"> -->
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group mb-3">
                                                       <label for="simpleinput" class="mb-0 gr_clr">Language</label>
                                                       <input type="text" name="language" id="simpleinput" class="form-control rounded-0" placeholder="Language" value="English">
                                                   </div>
                                                </div> 
                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="save_add_btn btn btn-primary ms-1 waves-effect waves-light" data-effect="wave" id='submit_customer_info' type="submit" >Save</button>
                                                      <!-- onclick="submitForm(event)" -->
                                                   </div> 
                                                </div>                               
                                             </div> <!-- end col -->
                                                </form >
                                          </div> <!-- end card -->
                                       </div><!-- end col -->
                                    </div>
                                    <!-- end row -->
                                 </div>
                                 <div class="tab-pane" id="profile-b1">
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="card mb-0 shadow-none">
                                          <!-- <div class="">
                                            <h5 class="card-title">Match Content Info</h5>
                                            <p>Fill the Match Content Information</p>
                                          </div> -->

                                          
                                             <div class="row cust_info contact_hide">
                                             
                                                <div class="col-lg-6">
                                                   <div class="">
                                                  
                                                      <p class="blk_clr font-weight-600">Billing Address</p>
                                                      <ul class="list-unstyled activity-widget mb-0">
                                                         <li class="activity-list">
                                                            <div class="media pb-3">
                                                               <div class="text-center mr-3 bg-clr">
                                                                  <div class="avatar-sm">
                                                                     <span class="avatar-title rounded-circle text-primary">
                                                                        <!-- <i class="bx bx-server fs-sm"></i> -->
                                                                        <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/maps_ic.png">
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="media-body overflow-hidden">
                                                                  <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr">
                                                                  <?php echo $customer_data[0]->address ;?></a></h5>
                                                                  
                                                               </div>
                                                            </div>
                                                         </li>
                                                         <li class="activity-list">
                                                            <div class="media pb-3">
                                                               <div class="text-center mr-3 bg-clr">
                                                                  <div class="avatar-sm">
                                                                     <span class="avatar-title rounded-circle text-primary"><img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/phone_ic.png">
                                                                        <!-- <i class="bx bx-code fs-sm"></i> -->
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="media-body overflow-hidden">
                                                                  <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $customer_data[0]->mobile ;?></a></h5>
                                                                  
                                                               </div>
                                                            </div>
                                                         </li>
                                                         <li class="activity-list">
                                                            <div class="media pb-3">
                                                               <div class="text-center mr-3 bg-clr">
                                                                  <div class="avatar-sm">
                                                                     <span class="avatar-title rounded-circle text-primary">
                                                                        <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/email_ic.png">
                                                                        <!-- <i class="bx bx-photo-album fs-sm"></i> -->
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="media-body overflow-hidden">
                                                                  <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $customer_data[0]->email ;?></a></h5>
                                                                  
                                                               </div>
                                                            </div>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                   <div class="">
                                                      <p class="blk_clr font-weight-600">Shipping Address</p>
                                                      <ul class="list-unstyled activity-widget mb-0">
                                                         <li class="activity-list">
                                                            <div class="media pb-3">
                                                               <div class="text-center mr-3 bg-clr">
                                                                  <div class="avatar-sm">
                                                                     <span class="avatar-title rounded-circle text-primary">
                                                                        <!-- <i class="bx bx-server fs-sm"></i> -->
                                                                        <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/maps_ic.png">
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="media-body overflow-hidden">
                                                                  <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $customer_data[0]->address ;?></a></h5>
                                                                  
                                                               </div>
                                                            </div>
                                                         </li>
                                                         <li class="activity-list">
                                                            <div class="media pb-3">
                                                               <div class="text-center mr-3 bg-clr">
                                                                  <div class="avatar-sm">
                                                                     <span class="avatar-title rounded-circle text-primary"><img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/phone_ic.png">
                                                                        <!-- <i class="bx bx-code fs-sm"></i> -->
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="media-body overflow-hidden">
                                                                  <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $customer_data[0]->mobile ;?></a></h5>
                                                                  
                                                               </div>
                                                            </div>
                                                         </li>
                                                         <li class="activity-list">
                                                            <div class="media pb-3">
                                                               <div class="text-center mr-3 bg-clr">
                                                                  <div class="avatar-sm">
                                                                     <span class="avatar-title rounded-circle text-primary">
                                                                        <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/email_ic.png">
                                                                        <!-- <i class="bx bx-photo-album fs-sm"></i> -->
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="media-body overflow-hidden">
                                                                  <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $customer_data[0]->email ;?></a></h5>
                                                                  
                                                               </div>
                                                            </div>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div>  
                                                                     
                                                <div class="col-lg-12">
                                                   <div class="pt-2 float-right">
                                                      <button class="cnct_edit_btn btn btn-primary ms-1 waves-effect waves-light" data-effect="wave" type="submit">Edit</button>
                                                   </div> 
                                                </div>              
                                             </div> <!-- end col -->
                                             <form id="address_info" method="post" >
                                             <input type='hidden' name="cust_id" value="<?php echo $customer_data[0]->id;?>">
                                             <div class="row column_modified edit_data contact_show" style="display:none;">
                                                <div class="col-lg-6">
                                                   <p class="blk_clr font-weight-600">Billing Address</p>
                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">Street Address</label>
                                                          <input type="text" id="simpleinput" name="billing_address" class="form-control rounded-0" placeholder="Street Address" value="<?php echo $customer_data[0]->address ;?>">
                                                      </div>
                                                      <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Country</label>
                                                      <select class="custom-select" id="billing_country" name="billing_country" onchange="get_state_city(this.value);" required>
                                                         <option value="">Select Country</option>
                                                            <?php foreach($countries as $country){ ?>
                                                         <option <?php if($customer_data[0]->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                         <?php } ?>
                                                   </select> 
                                                      </div>
                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">City</label>
                                                          <?php $cityArray = $this->General_Model->get_state_cities($customer_data[0]->country);   ?>   

                                                          <select name="billing_city" class="form-control rounded-0" id="city" name="city"   required>


                                                          <option value="">-Select City-</option>
                                                            <?php

                                                                
                                                                foreach ($cityArray as $cityArr) {
                                                                    ?>
                                                                    <option value="<?= $cityArr->id; ?>" <?php
                                                                    if ($customer_data[0]->city): if ($customer_data[0]->city == $cityArr->id) {
                                                                            echo 'selected';
                                                                        } endif;
                                                                    ?>><?= $cityArr->name; ?></option>
                                                                            <?php
                                                                        }
                                                                ?>
                                                            

                                                        </select>

                                                      </div>
                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">Pin Code</label>
                                                          <input type="text" id="simpleinput" name="billing_code" class="form-control rounded-0" placeholder="Pin Code" value="<?php echo $customer_data[0]->code ;?>">
                                                      </div>
                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">Phone Number</label>
                                                          <input type="text" id="simpleinput" name="billing_mobile" class="form-control rounded-0" placeholder="Phone Number" value="<?php echo $customer_data[0]->mobile ;?>">
                                                      </div>
                                                      <div class="form-group mb-3">
                                                          <label for="example-email" class="mb-0 gr_clr">Email ID</label>
                                                          <input type="email" id="example-email" name="billing_email" class="form-control rounded-0" placeholder="Email" value="<?php echo $customer_data[0]->email ;?>">
                                                      </div>
                                                </div>   
                                                <div class="col-lg-6">
                                                   <p class="blk_clr font-weight-600">Shipping Address</p>
                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">Street Address</label>
                                                          <input type="text" id="simpleinput"  name="shipping_address" class="form-control rounded-0" placeholder="Street Address" value="<?php echo $customer_data[0]->address ;?>">
                                                      </div>

                                                      <div class="form-group mb-3">
                                                      <label for="simpleinput" class="mb-0 gr_clr">Country</label>
                                                      <select class="custom-select" id="add_customer_country" name="add_customer_country" onchange="get_state_city(this.value);" required>
                                                         <option value="">Select Country</option>
                                                            <?php foreach($countries as $country){ ?>
                                                         <option <?php if($customer_data[0]->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                         <?php } ?>
                                                   </select> 
                                                      </div>

                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">City</label>
                                                          <select name="shipping_city" class="form-control rounded-0" id="" name="shipping_city"   required>


                                                          <option value="">-Select City-</option>
                                                            <?php

                                                                
                                                                foreach ($cityArray as $cityArr) {
                                                                    ?>
                                                                    <option value="<?= $cityArr->id; ?>" <?php
                                                                    if ($customer_data[0]->city): if ($customer_data[0]->city == $cityArr->id) {
                                                                            echo 'selected';
                                                                        } endif;
                                                                    ?>><?= $cityArr->name; ?></option>
                                                                            <?php
                                                                        }
                                                                ?>
                                                            

                                                        </select>
                                                      </div>
                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">Pin Code</label>
                                                          <input type="text" name="shipping_code"  id="simpleinput" class="form-control rounded-0" placeholder="2680" value="<?php echo $customer_data[0]->code ;?>">
                                                      </div>
                                                      <div class="form-group mb-3">
                                                          <label for="simpleinput" class="mb-0 gr_clr">Phone Number</label>
                                                          <input type="text" id="simpleinput" name="shipping_mobile"  class="form-control rounded-0" placeholder="860-675-7689" value="<?php echo $customer_data[0]->mobile ;?>">
                                                      </div>
                                                      <div class="form-group mb-3">
                                                          <label for="example-email" class="mb-0 gr_clr">Email ID</label>
                                                          <input type="email" id="example-email" name="shipping_email"  class="form-control rounded-0" placeholder="Email" value="<?php echo $customer_data[0]->email ;?>">
                                                      </div>
                                                </div> 
                                                         </form>
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
                              </div>
                           </div> 
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="tab-content customer_info_page pt-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                                      aria-labelledby="v-pills-gen-ques-tab">
                                      <div class="accordion custom-accordion" id="general">
                                        <div class="card shadow-none mb-0 rounded-0">
                                          <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <div class="pb-0" id="headingOne">
                                              <h4 class="mb-0">
                                                Orders
                                                <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                              </h4>
                                            </div>
                                          </a>

                                          <div id="collapseOne" class="collapse show mt-3" aria-labelledby="headingOne"
                                            data-parent="#general">
                                             <div class="table-responsive">
                                                <table id="basic-datatable" class="table  table-hover table-nowrap mb-0">
                                                   <thead class="thead-light">
                                                      <tr>
                                                         <th>Order</th>
                                                         <th>Date & Time</th>
                                                         <th>Event</th>
                                                         <th>Qty</th>
                                                         <th>Category</th>
                                                         <th>Total</th>
                                                         <th>Status</th>
                                                         <th>&nbsp;</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>

                                                   <?php 
                                                   
                                                   foreach($customer_data_orders as $key=>$data) { ?>
                                                      <tr>
                                                         <td><?php
                                                         $booking_no='<a href="'.base_url()."game/orders/details/". md5($data->booking_no).'">#'.$data->booking_no.'</a>'; 
                                                         echo $booking_no; 
                                                         ?></td>
                                                         <td> <?php echo date("d F Y",strtotime($data->match_date)).'<br/>'.date("H:i",strtotime($data->match_time)); ?></td>
                                                         <td><?php echo $data->match_name ; ?> <br>
                                                            <span class="chmp_league"><?php echo $data->tournament_name ; ?></span>
                                                         </td>
                                                         <td><?php echo $data->quantity ; ?></td>                                 
                                                         <td><?php echo $data->seat_category ; ?></td>
                                                         <td><?php if($data->currency_type == "USD"){ ?>
                                                                           $
                                                                           <?php } else if($data->currency_type == "GBP"){ ?>
                                                                           £
                                                                           <?php } else if($data->currency_type == "EUR"){ ?>
                                                                           €
                                                                           <?php } ?> <?php echo number_format($data->ticket_amount,2);?></td>
                                                         <td>
                                                            <div class="bttns">
                                                              <!-- <span class="badge badge-success">Completed</span> -->
                                                              <?php if($data->booking_status == '1'){?><span class="badge badge-success">Confirmed</span><?php } ?>
                                                                  <?php if($data->booking_status == '2'){?><span class="badge badge-cancel">Pending</span><?php } ?>
                                                                  <?php if($data->booking_status == '3'){?><span class="badge badge-cancel">Cancelled</span><?php } ?>
                                                                  <?php if($data->booking_status == '4'){?><span class="badge badge-success">Shipped</span><?php } ?>
                                                                  <?php if($data->booking_status == '5'){?><span class="badge badge-success">Delivered</span><?php } ?>
                                                                  <?php if($data->booking_status == '6'){?><span class="badge badge-success">Downloaded</span><?php } ?> 
                                                            </div>
                                                         </td>
                                                         <td>
                                                            <div class="dropdown">
                                                               <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                                                                  <i class="mdi mdi-dots-vertical fs-sm"></i>
                                                               </a>
                                                               <div class="dropdown-menu dropdown-menu-right">
                                                                  <a href="#" class="dropdown-item">View</a>
                                                                  <a href="#" class="dropdown-item">Download </a>
                                                                  <a href="#" class="dropdown-item">Upload </a>
                                                                  <a href="#" class="dropdown-item">Replace </a>
                                                               </div>
                                                            </div>
                                                         </td>
                                                      </tr>
                                                     <?php } ?>
                                                     
                                                   </tbody>
                                                </table>
                                             </div>
                                             <?php if ($customer_data_count>0) { ?>
                                                <div class="pt-3 float-right">
                                                   <a href="#" class="ms-1 waves-effect waves-light" data-effect="wave" type="submit">View All</a>
                                                </div>
                                             <?php } ?>
                                          </div>
                                        </div>
                                     </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="card card-body rounded-0">
                     <div class="col-md-12 col-lg-12">
                        <h4 class="pb-2">Log Messages</h4>
                     </div>
                     <div class="table-responsive">
                           <table class="table table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th>Status</th>
                                    <th>Order ID</th>
                                    <th>Date &amp; Time</th>
                                    <th>Type</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php foreach($notify_orders_seller as $data) { ?>
                                 <tr>
                                    <td>
                                       <div class="bttns">
                                         <span class="badge badge-success">Order</span>
                                       </div>
                                    </td>
                                    <td><?php
                                     $booking_no='<a href="'.base_url()."game/orders/details/". md5($data->booking_no).'">#'.$data->booking_no.'</a>'; 
                                     echo $booking_no;  
                                    
                                     ?></td>
                                    <td><?php echo date("d F Y",strtotime($data->match_date)).'<br/>'.date("H:i",strtotime($data->match_time)); ?></td>
                                    <td>  <?php if($data->booking_status == '1'){?>Confirmed<?php } ?>
                                       <?php if($data->booking_status == '2'){?>Pending<?php } ?>
                                       <?php if($data->booking_status == '3'){?>Cancelled<?php } ?>
                                       <?php if($data->booking_status == '4'){?>Shipped<?php } ?>
                                       <?php if($data->booking_status == '5'){?>Delivered<?php } ?>
                                       <?php if($data->booking_status == '6'){?>Downloaded<?php } ?> </td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                                       <?php if ($notify_orders_seller>0  && !empty($notify_orders_seller)) { ?>
                                    <div class="pt-3 float-right text-right">
                                       <a href="#" class="ms-1 waves-effect waves-light" data-effect="wave" type="submit">View All</a>
                                    </div>    
                                    <?php } ?>
                  </div>

               </div>
               <div class="col-lg-4 col-xl-4">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="profile_details mt-3 pt-2">
                           
                           <img src="<?php 
                                          // $img = empty($customer_data[0]->admin_profile_pic) 
                                          // ? 'https://www.listmyticket.com/uploads/users/202204261458276850931.png' 
                                          // : $customer_data[0]->admin_profile_pic;
                                          $img='https://www.listmyticket.com/uploads/users/202204261458276850931.png' ;
                                          echo $img;
                           ?>" alt="<?php echo $customer_data[0]->first_name." ".$customer_data[0]->last_name; ?>" title="<?php echo $customer_data[0]->first_name." ".$customer_data[0]->last_name; ?>" class="img-fluid rounded-circle" width="120">
                           <h5 class="mb-3 pt-2 fw-semibold text-dark">Contact Information</h5>
                              <div class="table-responsive">
                                 <table class="table table-borderless mb-0 table-sm">
                                    <tbody>
                                       <tr>
                                          <th>Birth Date :</th>
                                          <td><?php 

                                          if($customer_data[0]->dob!="")
                                          {

                                          
                                           $dateTime = DateTime::createFromFormat('Y-m-d', $customer_data[0]->dob);
                                           $newDateString = $dateTime->format('j F, Y');
                                           echo $newDateString; // Outputs: 12th May, 1990
                                          }
                                          else 
                                           echo "";
                                          
                                          //echo date("d F Y h:i A", strtotime($customer_data[0]->dob));
                                          ?></td>
                                       </tr>
                                       <tr>
                                          <th>Registration :</th>
                                          <td><?php  echo date("d F Y h:i A", strtotime($customer_data[0]->created_date));?></td>
                                       </tr>
                                       <tr>
                                          <th>Last Visit :</th>
                                          <td>10 January 2023 1:25 PM</td>
                                       </tr>
                                       <tr>
                                          <th>Language :</th>
                                          <td>English</td>
                                       </tr>
                                       <tr>
                                          <th>Registrations :</th>
                                          <td>
                                             <div class="bttns">
                                               <span class="badge badge-news"><?php echo $getsubscription;?> </span>
                                             </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Status :</th>
                                          <td>
                                             <div class="bttns">
                                               <span class="badge <?php echo $status = ($customer_data[0]->status == 1) ? "badge-success" : "badge-danger"; ?>"><?php echo $status = ($customer_data[0]->status == 1) ? "Active" : "Inactive"; ?></span>
                                             </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Review Status:</th>
                                          <td>
                                             <div class="custom-control custom-switch">
                                               <input type="checkbox" class="custom-control-input" id="customSwitch19" checked>
                                               <label class="custom-control-label" for="customSwitch19">&nbsp;</label>
                                             </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                        </div>
                     </div>
                  </div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="media align-items-center">
                           <div class="media-body currency_status">
                              <p class="mb-4 font-weight-normal color_main">Orders in Total</p>
                              <h4 class="mb-2 font-weight-bold"><?php echo $customer_data_count; ?></h4>
                           </div>
                           <div class="text-center currency_symb pound">
                              <span class="pound font-weight-normal">£</span>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="media align-items-center">
                           <div class="media-body currency_status">
                              <p class="mb-4 font-weight-normal color_main">Orders Value</p>
                              <h4 class="mb-2 font-weight-bold">£ </h4>
                           </div>
                           <div class="text-center currency_symb pound">
                              <span class="pound font-weight-normal">£</span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="media align-items-center">
                           <div class="media-body currency_status">
                              <p class="mb-4 font-weight-normal color_main">Pending Fulfilment</p>
                              <h4 class="mb-2 font-weight-bold"><?php echo $fulfilment_data->fulfilment; ?></h4>
                           </div>
                           <div class="text-center currency_symb pound">
                              <span class="pound font-weight-normal">£</span>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- <div class="card rounded-0">
                     <div class="card-body">
                        <h5 class="mb-4 font-weight-600">Private Notes</h5>
                        <div class="private_note">
                           <div class="para">
                           <i class="fas fa-info-circle"></i> 
                           <p class="gr_clr font-weight-600">This note will be displayed to all employees but not to customers.</p>
                           </div>
                           <ul class="list-unstyled activity-widget mb-0">
                              <li class="activity-list private_notes mb-3">
                                 <div class="media pb-0">
                                    <div class="parag_text">
                                       <p class="mb-0 blk_clr">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    </div>
                                    <div class="media-body">
                                      <div class="dropdown">
                                          <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown" aria-expanded="true">
                                             <i class="mdi mdi-dots-vertical fs-sm"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-135px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                             <a href="#" class="dropdown-item">View</a>
                                             <a href="#" class="dropdown-item">Edit</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="order_val mt-2">
                                    <div class="order_ids"><p class="mb-0">#12565A</p></div>
                                    <div class="order_date_time">12 June 2019 13.45</div>
                                 </div>
                              </li>

                              <li class="activity-list private_notes mb-3">
                                 <div class="media pb-0">
                                    <div class="parag_text">
                                       <p class="mb-0 blk_clr">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    </div>
                                    <div class="media-body">
                                      <div class="dropdown">
                                          <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown" aria-expanded="true">
                                             <i class="mdi mdi-dots-vertical fs-sm"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-135px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                             <a href="#" class="dropdown-item">View</a>
                                             <a href="#" class="dropdown-item">Edit</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="order_val mt-2">
                                    <div class="order_ids"><p class="mb-0">#12565A</p></div>
                                    <div class="order_date_time">12 June 2019 13.45</div>
                                 </div>
                              </li>
                           </ul>

                           <div class="add_private_btn mt-5 float-right">
                              <button type="button" class="btn btn_currency btn-primary waves-effect waves-light rounded-0" data-effect="wave">Add</button>
                           </div>
                        </div>
                     </div>
                  </div> -->


                  <div class="card rounded-0">
                     <div class="card-body">
                        <h5 class="mb-4 font-weight-600">Private Notes</h5>
                        <div class="private_note">
                           <div class="para">
                           <i class="fas fa-info-circle"></i> 
                           <p class="gr_clr font-weight-600">This note will be displayed to all employees but not to customers.</p>
                           </div>
                           <ul class="list-unstyled activity-widget mb-0">
                             
                              <?php 
                              if(!empty($customer_private_notes))
                              {
                                 foreach ($customer_private_notes as $private_note) { ?>
                                  <li class="activity-list private_notes mb-3">
                                 <div class="media pb-0">
                                    <div class="parag_text">
                                      <p class="mb-0 blk_clr"><?php echo $private_note->private_note; ?></p>
                                    </div>
                                    <div class="media-body text-right">
                                      <div class="dropdown">
                                          <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown" aria-expanded="true">
                                             <i class="mdi mdi-dots-vertical fs-sm"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-135px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                             <a href="javascript:void(0);" class="dropdown-item viewButton "  data-orderid='<?php echo $private_note->booking_id; ?>' data-notes='<?php echo $private_note->private_note; ?>'  data-effect="wave" data-toggle="modal" data-target="#centermodal_edit" >View</a>
                                           
                                             <a href="#" class="dropdown-item editButton" data-edit-orderid='<?php echo $private_note->booking_id; ?>' data-edit-notes='<?php echo $private_note->private_note; ?>'  data-effect="wave" data-toggle="modal" data-target="#centermodal_edit" data-id='<?php echo $private_note->id; ?>'>Edit</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="order_val mt-2">
                                    <div class="order_ids"><p class="mb-0"><a href="<?php echo base_url()."game/orders/details/".md5($private_note->booking_id)?>">#<?php echo $private_note->booking_id; ?></a></p></div>
                                    <div class="order_date_time"><?php 
                                    $dateTime = new DateTime($private_note->created_date);
                                    $formattedDateTime = $dateTime->format('d F Y H:i');
                                    echo $formattedDateTime; ?></div>
                                 </div>
                              </li>
                                    <?php   } } ?>
                           </ul>

                           <div class="add_private_btn mt-5 float-right">
                              <button type="button" class="add_note btn btn_currency btn-primary waves-effect waves-light rounded-0" data-effect="wave" data-toggle="modal" data-target="#centermodal_edit">Add</button>

                              <!-- //////////////////////////////////////////////////////////////////////////// -->
                              <div class="modal fade" id="centermodal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h4 class="modal-title" id="myLargeModalLabel">Add Private Notes</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="edit_email">
                                                <form>
                                                   <div class="row">
                                                         <div class="col-lg-12">
                                                            <div class="form-group check_box">
                                                               <label for="simpleinput">Order ID</label>
                                                               <select name="select_order_id" id="select_order_id" class="form-control">
                                                                        <option value="">Selec Order ID</option>
                                                                        <?php foreach($customer_sales_data_count as $customer_order_data) {?>
                                                                           <option value="<?php echo $customer_order_data->booking_no;?>"><?php echo $customer_order_data->booking_no;?></option>
                                                                        <?php } ?>
                                                               </select>
                                                            </div>
                                                         </div>
                                                         <div class="col-lg-12">
                                                            <div class="form-group">
                                                               <label for="example-textarea">Notes</label>
                                                               <textarea id="editor-4"></textarea>
                                                            </div>
                                                         </div>   

                                                         <div class="col-lg-12" style="display:none">
                                                         <input type='hidden' name='hidden_note_id' value='' class='hidden_note_id' />
                                                         </div> 

                                                      </div>
                                                </form>
                                                <div class="coupon_btn_save">
                                                <button type="button" class="btn btn-cancel close_btn">Cancel</button>
                                                <button type="button" class="btn btn-primary save_notes">Save</button>
                                             </div>
                                             </div>
                                          </div>
                                       </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                 </div>
                              <!-- //////////////////////////////////////////////////////////////////////////// -->

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
  $(".save_add_btn").click(function() {
    $(".data_hide").show();
     $(".data_show").hide();
  });
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
   function submitForm(event) {
  event.preventDefault(); // stop the form from submitting normally

  const form = document.getElementById('customer_data');
  const formData = new FormData(form);
  url='<?php echo base_url();?>home/update_customer_data';
  fetch(url, {
    method: 'POST',
    body: formData
  })
  .then(response => {
    console.log('Form submitted successfully');
    // do something with the response if needed
  })
  .catch(error => {
    console.error('Error submitting form', error);
  });
}
   </script>

   <script>
      

      $(document).ready(function () {
         const datepicker = document.getElementById('MyTextbox1');
     

      // Initialize the datepicker
      $(datepicker).datepicker({         
          dateFormat: 'dd MM yy' 
      }
      );
     

         $('#submit_customer_info').on('click',function (e){
         	e.preventDefault();         
            const formData = new FormData($('#customer_data')[0]);

		$.ajax({
			url: base_url + 'home/update_customer_data',
			method: "POST",
			data: formData,
			dataType: 'json',
         contentType: false,
         processData: false,
         
			success: function (result) {

				if (result) {

					swal('Updated !', result.msg, 'success');

				}
				else {
					swal('Updation Failed !', result.msg, 'error');

				}

				setTimeout(function () { window.location.reload(); }, 2000);
			}
		});
	});

   

   $('#submit_address_info').on('click',function (e){

         	e.preventDefault();         
            const formData = new FormData($('#address_info')[0]);
            // Assuming you have a form element with the ID 'myForm'
          
		$.ajax({
			url: base_url + 'home/update_customer_address_info',
			method: "POST",
			data: formData,
			dataType: 'json',
         contentType: false,
         processData: false,
         
			success: function (result) {

				if (result) {

					swal('Updated !', result.msg, 'success');

				}
				else {
					swal('Updation Failed !', result.msg, 'error');

				}

				setTimeout(function () { window.location.reload(); }, 1000);
			}
		});
	});


   /////////////////////////////////////////////////////////

   $('.btn-cancel').click(function (e){
 
 $('.close').trigger('click');

});


   //Private notes code
   $(document).on('click', '.save_notes', function() {

var selectedValue = $("#select_order_id").val();

var editorData = CKEDITOR.instances['editor-4'].getData();   
var user_id= '<?php echo $user_id; ?>';

if(editorData!="" && selectedValue!="" )
{

$.ajax({
   url: base_url + 'home/private_notes',
   method: "POST",
   data: { "notes": editorData , "order_id":selectedValue,"seller_id":"0" ,"user_id":user_id},
   dataType: 'json',
   success: function (result) {
      
      if (result) {
         $('.close').trigger('click');
         swal('Updated !', result.msg, 'success');

      }
      else {
         $('.close').trigger('click');
         swal('Updation Failed !', result.msg, 'error');

      }

      setTimeout(function () { window.location.reload(); }, 1000);
   }
});
}
else{

swal('Updation Failed!', 'Please provide the necessary details and click the submit button.', 'error');
}
});

$(".viewButton").click(function() {

  var orderId = $(this).data("orderid");
  var notes = $(this).data("notes");

  // Set data in the modal

  $("#select_order_id").val(orderId);
  CKEDITOR.instances['editor-4'].setData(notes);
  
 // $("#select_order_id").prop("readonly", true);
 $("#select_order_id").prop("disabled", true);
   CKEDITOR.instances['editor-4'].setReadOnly(true);
  $('.save_notes').hide();
 
  
});

$(".add_note").click(function() {   

$("#select_order_id").val("");
CKEDITOR.instances['editor-4'].setData("");

$("#select_order_id").prop("disabled", false);
CKEDITOR.instances['editor-4'].setReadOnly(false);
$('.save_notes').show();
$('.save_notes').text('Save');
$('.save_notes').removeClass('update_notes').addClass('save_notes');

});


$(".editButton").click(function() {   

   var orderId = $(this).data("edit-orderid");
  var notes = $(this).data("edit-notes");
  var id=$(this).data("id");
 

  console.log(orderId);
  console.log(notes);

  // Set data in the modal
  $("#select_order_id").val(orderId);
  CKEDITOR.instances['editor-4'].setData(notes);

  $(".hidden_note_id").val(id);

 $("#select_order_id").prop("disabled", false);
   CKEDITOR.instances['editor-4'].setReadOnly(false);
  $('.save_notes').show();
  $('.save_notes').text('Update');
  $('.save_notes').removeClass('save_notes').addClass('update_notes');


});


// Trigger the click event of update_notes button with parameters
$(document).on('click', '.update_notes', function() {
// Handle the click event for updating notes
var selectedValue = $("#select_order_id").val();
var editorData = CKEDITOR.instances['editor-4'].getData();   
var seller_id= '<?php echo $seller_id; ?>';
var hidden_note_id = $(".hidden_note_id").val();

// AJAX request
$.ajax({
  url: base_url + 'home/update_notes',
  method: "POST",
  data: { "notes": editorData , "order_id": selectedValue, "seller_id": seller_id ,"hidden_note_id":hidden_note_id},
  dataType: 'json',
  success: function(result) {
      if (result) {
          $('.close').trigger('click');
          swal('Updated!', result.msg, 'success');
      } else {
          $('.close').trigger('click');
          swal('Updation Failed!', result.msg, 'error');
      }
     setTimeout(function() { window.location.reload(); }, 1000);
  }
});
});
   /////////////////////////////////////////////////////////

});

	

      </script>