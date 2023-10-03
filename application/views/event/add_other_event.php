<?php 
   $total_quantity =0 ;
   $total_sold =0 ;
   if($match_details[0]->tickets){
   
       $total_quantity  = array_sum(array_column($match_details[0]->tickets,'quantity'));
       $total_sold  = array_sum(array_column($match_details[0]->tickets,'sold'));
   
       $total_quantity = $total_quantity + $total_sold;
   }
   
   ?>
<?php 
   $this->load->view(THEME.'common/header');
   //echo isset($event->m_id) ? $event->m_id : 'ddddddd'; 
   ?>
<div id="overlay" style="display: none;">
   <div id="loader">
      <!-- Add your loading spinner HTML or image here -->
      <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
   </div>
</div>
<style type="text/css">
   label.error{ color:RED !important;font-weight: unset !important; }
   #overlay {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(0, 0, 0, 0.5);
   z-index: 9999;
   }
</style>
<!-- Beginegin main content -->
<div class="main-content">
<!-- content -->
<div class="page-content">
   <!-- page header -->
   <div class="page-title-box tick_details">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-8">
               <h5 class="card-title">Other Events</h5>
            </div>
            <div class="col-sm-4">
               <!-- <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                  <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2">Back</a>
                     <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2">Save</a>
                  </div> -->
            </div>
         </div>
      </div>
   </div>
   <!-- page content -->
   <div class="page-content-wrapper mt--45 box-details">
      <div class="container-fluid">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-12">
                     <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                           <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                           Add or Edit Event
                           </a>
                        </li>
                        <?php if (isset($event->m_id)) { ?>
                        <?php
                           if($this->session->userdata('role') == 7 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 9){?>
                        <li class="nav-item">
                           <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link ">
                           Content Info
                           </a>
                        </li>
                        <?php } ?>
                        <?php } ?>
                        <?php if (isset($event->m_id)) { ?>
                        <li class="nav-item">
                           <a href="#messages-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                           Ticket Details
                           </a>
                        </li>
                        <?php } ?>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane show active" id="home-b1">
                               <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>event/other_events/save_events">
                           <input type="hidden" name="matchId" value="<?php echo $event->m_id; ?>">
                           <div class="team_info_details mt-3">
                              <h5 class="card-title">Event Info</h5>
                              <p>Fill the following Event information</p>
                           </div>
                           <div class="row">
                              <div class="col-8">
                                 <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="example-select">Event Category <span class="text-danger">*</span> </label>
                                             <select class="custom-select" id="category" name="category"   required  >
                                          
                                                <option value="">Select Category</option>
                                                   <?php foreach ($categories as $category) { ?>
                                                   <option value="<?php echo $category->id; ?>" <?php if ($category->id == $event->other_event_category) { ?> selected <?php } ?> > <?php if ($category->parent_id != 0) { ?> &nbsp;&nbsp;&nbsp;&nbsp;<?php  } ?> <?php echo $category->category_name; ?></option>
                                                   <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                      <!--  <div class="col-lg-4" style="display:none">
                                          <div class="form-group">
                                             <label for="example-select">Sub Category <span class="text-danger">*</span> </label>
                                             <select class="custom-select" id="category" name="category" required>
                                                <option value="">-Select  Sub Category -</option>
                                             </select>
                                          </div>
                                       </div> -->
                                       <div class="col-lg-4" style="display:none">
                                          <div class="form-group">
                                             <label for="example-select">Tournament</label>
                                             <select class="custom-select" id="tournament" name="tournament"   onchange="get_sub_tournament(this.value);" >
                                                <option value="">Select Tournament</option>
                                                <?php foreach($tournments as $tournment){ ?>
                                                <option value="<?php echo $tournment->t_id;?>" <?php if($event->tournament == $tournment->t_id){?> selected <?php } ?>><?php echo $tournment->tournament_name;?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-4"  style="display:none">
                                          <div class="form-group">
                                             <label for="example-select">Tournament Group</label>
                                             <select class="custom-select" id="tournament_group" name="tournament_group" >
                                                <option value="">Select Tournament Group</option>
                                             </select>
                                          </div>
                                       </div>
                                      
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="simpleinput">Event Name <span class="text-danger">*</span></label>
                                             <input type="text" id="eventname" name="eventname" class="form-control" placeholder="Enter Event Name" required value="<?php echo $event->match_name; ?>">
                                          </div>
                                       </div>

                                        <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="simpleinput">Event Sub-Title </label>
                                             <input type="text" id="extra_title" name="extra_title" class="form-control" placeholder="Enter Event Sub-Title"  value="<?php echo $event->extra_title; ?>">
                                          </div>
                                       </div>

                                        <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="simpleinput">Venue (Stadium Name) <span class="text-danger">*</span></label>
                                             <select class="custom-select" id="venue" name="venue" required>
                                                <option value="">Select Venue</option>
                                                <?php foreach ($stadiums as $stadium) {
                                                   $stadium_name = $stadium->stadium_name;                                     if($stadium->stadium_variant != ''){
                                                     $stadium_name = $stadium->stadium_name.'-'.$stadium->stadium_variant;
                                                                                                    }
                                                   ?>
                                                <option <?php if ($event->venue == $stadium->s_id) { ?> selected <?php } ?> value="<?php echo $stadium->s_id; ?>"><?php echo $stadium_name; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="simpleinput">URL Key <span class="text-danger">*</span></label>
                                             <input type="text" class="form-control" placeholder="Enter URL Key" name="event_url" id="event_url" value="<?php echo $event->slug; ?>" required>
                                          </div>
                                       </div>

                                         <div class="col-lg-4">
                                          <div class="form-group calander">
                                             <label for="example-date">Event Date <span class="text-danger">*</span></label>
                                             <input class="form-control" id="matchdate" type="text" name="matchdate" placeholder="DD/MM/YY" value="<?php echo  $event->match_date ? date("d-m-Y",strtotime($event->match_date)) : "";?>" autocomplete="off" required>
                                              <!-- <i class="bx bx-calendar-week"></i> -->
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label>Match Time <span class="text-danger">*</span></label>
                                             <input class="form-control" id="example-time" type="time" name="matchtime" value="<?php echo $event->match_time;?>">
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="example-select">Currency <span class="text-danger">*</span></label>
                                             <select class="custom-select" id="price_type" name="price_type" required>
                                                <option value="">Select Currency</option>
                                                <?php foreach($currencies as $currency){ ?>
                                                <option value="<?php echo trim($currency->currency_code);?>" <?php if($event->price_type == trim($currency->currency_code)){?> selected <?php } ?>><?php echo $currency->currency_code;?> (<?php echo $currency->symbol;?>)</option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-lg-4">
                                          <div class="form-group">
                                           <label for="simpleinput">Total Tickets </label>
                                            <input type="text" id="matchticket" name="matchticket" class="form-control input" placeholder="Enter Tickets Count"  value="<?php echo $event->matchticket;?>">
                                          </div>
                                       </div>

                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="example-select">Country <span class="text-danger">*</span></label>
                                             <select class="custom-select" id="country" name="country" onchange="get_state_city(this.value);" required>
                                                <option value="">Select Country</option>
                                                <?php foreach ($countries as $country) { ?>
                                                <option <?php if ($event->country == $country->id) { ?> selected <?php } ?> value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label for="example-select">City<span class="text-danger">*</span></label>
                                             <?php $cityArray = $this->General_Model->get_state_cities($event->country);
                                                ?>
                                             <select class="custom-select" id="city" name="city" required>
                                                <option value="">Select City</option>
                                                <?php
                                                   foreach ($cityArray as $cityArr) {
                                                   ?>
                                                <option value="<?= $cityArr->id; ?>" <?php
                                                   if ($event->city) : if ($event->city == $cityArr->id) {
                                                         echo 'selected';
                                                      }
                                                   endif;
                                                   ?>><?= $cityArr->name; ?></option>
                                                <?php
                                                   }
                                                   ?>
                                             </select>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Countries That Are Denied Access</label>
                                               <select name='bcountry[]' id="selectize-maximum" class="form-control" multiple="multiple">
                                                <option value="">Select Countries</option>
                                                            <?php foreach($countries as $country){ ?>
                                                            <option <?php 
                                                            if(isset($ban_arr)){
                                                            if(in_array($country->id, $ban_arr)){
                                                                 echo 'selected="selected"';
                                                                            } }
                                                                ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                            <?php } ?>
                                                </select>
                                          </div> 
                                       </div>

                                        <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="simpleinput">Search Keywords</label>
                                             <input type="text" class="form-control" placeholder="Enter Search Keywords" name="search_keywords" id="choices2" value="<?php echo $event->search_keywords; ?>" >
                                          </div>
                                       </div>

                                       <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="example-select">Blog Image</label>
                                                <div class="prev_back_img">
                                                  <label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($event->event_image)) {
                                                echo $event->event_image;
                                                } ?>"><input type="file"  class="form-control-file input"  name="event_image" id="event_image" value="" onchange="loadFiles(event,'blog_img_file')"> Upload JPEG File</label>
                                                  <p>Previous Blog Image</p>
                                                  <a id="blog_img_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($event->event_image)) {
                                                echo UPLOAD_PATH.'uploads/event_image/'.$event->event_image;
                                                } ?>')" class="view_bg">
                                                <img width="30" height="30" src="<?php if (isset($event->event_image)) {
                                                echo UPLOAD_PATH.'uploads/event_image/'.$event->event_image;
                                                }else { echo UPLOAD_PATH.'uploads/general_settings/no-image.png';} ?>" id="blog_img_file">
                                            </a>
                                                </div>
                                            </div> 
                                         </div>


                                         <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="example-select">Upload Seating Map</label>
                                                <div class="prev_back_img">
                                                  <label class="custom-upload mb-0"><input type="hidden" name="exs_file2" value="<?php if (isset($event->seat_mapping)) {
                                                echo $event->seat_mapping ;
                                                } ?>"><input type="file"  class="form-control-file input"  name="seat_mapping" id="seat_mapping" value="" onchange="loadFiles(event,'seat_mapping_file')"> Upload JPEG File</label>
                                                  <p>Previous Seating Map Image</p>
                                                  <a id="seat_mapping_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($event->seat_mapping )) {
                                                echo UPLOAD_PATH.'uploads/seat_mapping/'.$event->seat_mapping;
                                                } ?>')" class="view_bg">
                                                <img width="30" height="30" src="<?php if (isset($event->seat_mapping)) {
                                                echo UPLOAD_PATH.'uploads/seat_mapping/'.$event->seat_mapping;
                                                }else { echo UPLOAD_PATH.'uploads/general_settings/no-image.png';} ?>" id="seat_mapping_file">
                                            </a>
                                                </div>
                                            </div> 
                                         </div>

                                    </div>
                                    <!-- end col -->
                                 </div>
                                 <!-- end card -->
                              </div>
                              <!-- end col -->
                              <div class="col-4">
                                 <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-lg-12">
                                          <div class="data_edit">
                                             <table style="width: 100%;">
                                                <tr>
                                                   <td><label for="sellers" class="mb-0">Event Visible On 1Box</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch18" name="is_active" value="1" <?php if ($event->match_status == '1') { ?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch18"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td> <label for="sellers" class="mb-0">Availability *</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch19" name="availability" value="1" <?php if ($event->availability == '1') { ?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch19"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="sellers" class="mb-0">Top Game</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                          <input type="checkbox" id="customSwitch20" class="is-switch custom-control-input" name="top_games" value="1" <?php if($event->top_games == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch20"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                 <tr>
                                                   <td><label for="sellers" class="mb-0">Upcoming Events</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" id="customSwitch21" class="custom-control-input" name="upcomingevents" <?php if($event->upcoming_events == '1'){?> checked <?php } ?> value="1">
                                                            <label class="custom-control-label" for="customSwitch21"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                 <tr>
                                                   <td><label for="sellers" class="mb-0">Almost Sold Ticket?</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                             <input type="checkbox" id="customSwitch22" class="is-switch custom-control-input" name="almost_sold" value="1" <?php if($event->almost_sold == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch22"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="sellers" class="mb-0">High Demand Ticket ?</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                           <input type="checkbox" id="customSwitch23" class="is-switch custom-control-input" name="high_demand" value="1" <?php if($event->high_demand == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch23"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                               
                                             </table>



                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                           <div class="card mt-5">
                                    <div class="row column_modified">
                                       <div class="col-lg-12">
                                          <div class="data_edit_new">
                                             <table style="width: 100%;">
                                               <tr>
                                                   <td><label for="sellers" class="mb-0">TBC?</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" id="customSwitch016" class="is-switch custom-control-input" name="tbc_status" value="1" <?php if($event->tbc_status == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch016"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                  <tr>
                                                   <td><label for="sellers" class="mb-0">To Be Confirmed</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" id="customSwitch017" class="is-switch custom-control-input" name="confirm_status" value="1" <?php if($event->confirm_status == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch017"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td> <label for="sellers" class="mb-0">Ignore Auto 24 Off</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                             <input type="checkbox" id="customSwitch018" class="is-switch custom-control-input" name="ignoreautoswitch" value="1" <?php if($event->ignoreautoswitch == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch018"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                              
                                                 <tr>
                                                   <td><label for="sellers" class="mb-0">EPL World</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                             <input type="checkbox" class="custom-control-input" id="customSwitch28" name="epl_status" <?php if($event->epl_status == '1'){?> checked <?php } ?> value="1">
                                                            <label class="custom-control-label" for="customSwitch28"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="sellers" class="mb-0">365 Tickets</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                             <input type="checkbox" class="custom-control-input" id="customSwitch29" name="affiliate_status" <?php if($event->affiliate_status == '1'){?> checked <?php } ?> value="1">
                                                            <label class="custom-control-label" for="customSwitch29"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                 <tr>
                                                   <td><label for="sellers" class="mb-0">Private Link</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch254"
                                                               name="privatelink" value="1"
                                                               <?php if ($event->privatelink == '1') { ?> checked <?php } ?>>
                                                            <label class="custom-control-label" for="customSwitch254"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="sellers" class="mb-0">API Share *</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch256" name="apishare" value="1" <?php if ($event->apishare == '1') { ?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch256"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </table>
                                             </div>
                                       </div> </div>
                                    </div>

                              </div>
                           </div>
                          
                           <!-- end row -->
                            <!-- end row -->
                              <div class="tick_details border-top">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                          <a href="<?php echo base_url() . 'event/matches/upcoming';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                        </form>
                        </div>
                        <div class="tab-pane" id="profile-b1">
                           <div class="row">
                              <div class="col-12">
                                 <div class="card">
                                    <div class="">
                                       <h5 class="card-title">Match Content Info</h5>
                                       <p>Fill the Match Content Information</p>
                                    </div>
                                    <div class="">
                                       <form id="branch-form-2" method="post" class="validate_form_v2 login-wrapper" action="<?php echo base_url();?>event/matches/save_matches_content">
                                          <input type="hidden" name="matchId" value="<?php  echo isset($event->m_id) ? $event->m_id : ''; ?>">
                                          <input type="hidden" name="flag" value="content">
                                          <div class="row column_modified">
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="simpleinput">Match Title *</label>
                                                   <!-- <input type="text" id="simpleinput" class="form-control" placeholder="Enter Tournament Name" <?php //echo $event->match_name;?> value="<?php echo $event->match_name;?>"> -->
                                                   <input disabled type="text" id="" name="" class="form-control" placeholder="Enter Match Title" value="<?php
                                                      echo isset($event->match_name) ? $event->match_name : '';?>">
                                                   <input  type="hidden" id="matchname" name="matchname" class="input" placeholder="Enter Match Title" required value="<?php echo $event->match_name;?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="simpleinput">Meta Title <span class="text-danger">*</span></label>
                                                   <input type="text" id="simpleinput" class="form-control" placeholder="Enter Meta Title" name="metatitle" required value="<?php echo isset($event->meta_title) ? $event->meta_title : '';?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="example-textarea">Meta Description </label>
                                                   <textarea class="form-control height_auto" id="example-textarea" rows="5" name="metadescription" placeholder="Enter Meta Description"><?php echo isset($event->meta_description) ? $event->meta_description : ''; ?></textarea>
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="example-textarea">Match Description</label>
                                                   <textarea id="editor-5" name="description" placeholder="Enter Match Description"><?php echo isset($event->description) ? $event->description : ''; ?></textarea>
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="simpleinput">Seo Keywords</label>
                                                   <input type="text" id="choices1" class="form-control" placeholder="Enter Seo Keywords" value="<?php echo isset($event->seo_keywords) ? $event->seo_keywords : ''; ?>" name="seo_keywords">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                                                   <!-- <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i> Go Back</a>  -->
                                                   <a href="<?php echo base_url();?>event/matches/upcoming" class="btn btn-primary mb-2">Back</a> 
                                                   <!-- <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i>Save</a> -->
                                                   <button type="submit" id="branch-form-btn" class="btn btn-success mb-2">Save</button>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- end col -->
                                       </form>
                                    </div>
                                    <!-- end card-body -->
                                 </div>
                                 <!-- end card -->
                              </div>
                              <!-- end col -->
                           </div>
                        </div>
                        <div class="tab-pane" id="messages-b1">
                           <div class="row">
                              <div class="col-12">
                                 <div class="card listing_details">
                                    <div class="ticket_details_as">
                                       <div class="row">
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Event Name</h4>
                                                <p><?php 
                                                   if(isset($event->match_name))
                                                   {
                                                   $match_name_inpt = $event->match_name;
                                                   
                                                   $match_name_array = explode(" Vs ", $match_name_inpt);
                                                   $match_name = $match_name_array[0];
                                                   
                                                   if (!empty($match_name_array[1])) {
                                                     $match_name .= " Vs <br/>" . $match_name_array[1];
                                                   }
                                                   
                                                   echo $match_name;
                                                   }
                                                   ?> </p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Tournament</h4>
                                                <p><?php
                                                   if(isset($event->tournament_name))
                                                   { echo $event->tournament_name;
                                                   }?></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Date & Time</h4>
                                                <p>
                                                   <?php
                                                      // echo "dfdd";
                                                      if(isset($event->match_date))
                                                      {                                       
                                                            $dateString = $event->match_date;
                                                           $dateTime = new DateTime($dateString);
                                                           $formattedDate = $dateTime->format("l, j F Y");
                                                           
                                                          echo $formattedDate." ".date('H:i A',strtotime($match_details->match_time));
                                                      }
                                                       ?>
                                                   <!-- Saturday, 26 March 2023 1:30 PM -->
                                                </p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Stadium</h4>
                                                <p><?php  echo $event->stadium_name; ?></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>City</h4>
                                                <p><?php echo $event->city_name; ?></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Country</h4>
                                                <p><?php echo $event->country_name; ?></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Available Tickets </h4>
                                                <p>
                                                   <?php echo $total_quantity;
                                                      ?>
                                                </p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Quantity Sold </h4>
                                                <p><?php echo $total_sold;
                                                   ?></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-2">
                                             <div class="event_name">
                                                <h4>Price Range</h4>
                                                <p>
                                                   <?php 
                                                      // if(isset($match_details[0]->tickets))
                                                      // {
                                                      
                                                      
                                                      // //  echo min(array_column($match_details[0]->tickets, 'price')); 
                                                      // //  echo " - ";
                                                      // //  echo max(array_column($match_details[0]->tickets, 'price'));
                                                      // }
                                                      
                                                      
                                                        if (!empty($match_details[0]->tickets)) {
                                                          $prices = array_column($match_details[0]->tickets, 'price');
                                                          $minPrice = min($prices);
                                                          $maxPrice = max($prices);
                                                      
                                                          echo $minPrice . " - " . $maxPrice;
                                                      }
                                                      
                                                      
                                                        
                                                      ?>
                                                   <?php echo strtoupper($match_details[0]->price_type); ?>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="table-responsive" id="list_body">
                                    </div>
                                 </div>
                                 <!-- end card -->
                              </div>
                              <!-- end col -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="edit_modal_popup">
            <div class="modal fade bd-example-modal-lg" id="edit_ticket" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close edit_ticket_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body" id="ticket_edit_body">
                        <div class="row">
                           <div class="team_name">
                              <h3 style="text-align: center;"><i class="fa fa-spinner fa-spin" style="color:#color: #325edd;"></i>&nbsp;Please Wait ...</h3>
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
<div class="modal fade" id="clone-listing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="">
         <p class="text-right"><button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="<?php echo base_url();?>assets/img/close.svg" ></span></span>
            </button>
         </p>
         <div class="modal-body clone-listing" id="ticket_clone_body">
         </div>
      </div>
   </div>
</div>
<!-- main content End -->
<?php  $this->load->view(THEME.'common/footer'); ?>
<script>


   // function get_sub_category(category_id,select_id="") {
   //  if(category_id != ''){ 
   //    $('#category').html('');
   //    $.ajax({
   //      type: "POST",
   //      dataType: "json",
   //      url: base_url + 'event/other_events/get_sub_category',
   //      data: {'category_id' : category_id,'select_id' : select_id},
   //      success: function(res_data) {
   //          var response_data = JSON.parse(JSON.stringify(res_data));
   //         $('#category').html(response_data.category);
   //      }
   //    })
   
   //  }
   // }
   
   // <?php if($event->m_id){?>
   //   get_sub_category(<?php echo $event->parent_id;?>,<?php echo $event->id;?>);
   // <?php  } ?>
   
   // function get_sub_tournament(tournament,select_id="") {
   
   //  if(tournament != ''){ 
   //    $('#tournament_group').html('');
   //    $.ajax({
   //      type: "POST",
   //      dataType: "json",
   //      url: base_url + 'event/other_events/get_tournament_group',
   //      data: {'tournament' : tournament,'select_id' : select_id},
   //      success: function(res_data) {
   //          var response_data = JSON.parse(JSON.stringify(res_data));
   //         $('#tournament_group').html(response_data.tournament);
   //      }
   //    })
   
   //  }
   // }
   // <?php if($event->m_id){?>
   //   get_sub_tournament(<?php echo $event->tournament ? $event->tournament : 0;?>,<?php echo $event->tournament_group ? $event->tournament_group : 0 ?>);
   // <?php  } ?>

   function popitup(url,temp='')
   {
   
    newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');
   
    if (window.focus) {newwindow.focus()}
    return false;
   }
   
   
   var loadFiles = function(event,team_bg_file) {
   
   var formData = new FormData();
   formData.append('file', event.target.files[0]);
   
   $.ajax({
     url : "<?php echo base_url();?>event/upload_files",
     type : 'POST',
     data : formData,
     processData: false,  // tell jQuery not to process the data
     contentType: false,  // tell jQuery not to set contentType
     dataType: 'json',
     success : function(data) {
   
        if(data.uploaded_file){
          var src = "<?php echo UPLOAD_PATH;?>uploads/temp/"+data.uploaded_file;
          var output = document.getElementById(team_bg_file);
          output.src = src;
          $("#"+team_bg_file+"_link").attr("onclick", "return popitup('"+src+"');");
        }
         
   
   
     }
   });
   
   
   };
   
   $(document).ready(function(){ 
   load_tickets_details("<?php echo $event->m_id;?>");
   
   $(".edit_ticket_btn").click(function(){ 
           $('#bs-example-modal-lg').modal();
            $("#content_1").mCustomScrollbar({
        scrollButtons:{
          enable:true
        }
      });
    });
   
     $(".edit_clone_info").click(function(){
           $('#clone-example-modal-lg').modal();
    });
 
   
   
   //$('.ticket_clone').on('click',function(){
     $(document).on('click', '.ticket_clone', function(){
    var ticket_id = $(this).attr('data-ticket-id');
    //$('#clone-listing-modal').modal();  
   
    $('.edit_ticket_close').trigger('click');  
    
    setTimeout(
    function() 
    {
    $('#clone-listing-modal').modal({
    backdrop: 'static',
    keyboard: false
    })
   
    $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>tickets/index/get_ticket',
          data: {
             'ticket_id': ticket_id,
             'type': 'clone'
          },
          dataType: "json",
          success: function(data) {
   
              if(data.status == 1){
                $('#ticket_clone_body').html(data.html);
              }
   
          }
       });
    }, 500);
   
   })
   
     
   $(document).on('click', '.edit_ticket', function(){ 
   
    var ticket_id = $(this).attr('data-ticket-id');
    $('#edit_ticket').modal();  
     $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>tickets/index/get_ticket',
          data: {
             'ticket_id': ticket_id,
             'type': 'edit'
          },
          dataType: "json",
          success: function(data) {
   
              if(data.status == 1){
                $('#ticket_edit_body').html(data.html);
              }
   
          }
       });
   
   
   })
   
   $('#team1').on('change', function(event) {
   
   var team_id = $(this).val();
   if(team_id != ''){
   
   $("#hometown").val(team_id);
   $.ajax({
      url: "<?php echo base_url();?>event/get_team_basic",
      method: "POST",
      data : {"team_id" : team_id},
      dataType: 'json',
      success: function (result) { 
   
       if(result.status == 1) {
   
        var country_id = result.data.country;
        var city_id = result.data.city;
        var stadium_id = result.data.stadium;
        $("#country").val(country_id);
        $("#venue").val(stadium_id);
        get_state_city(country_id,city_id);
   
       }else if(result.status == 0) {
         notyf.error(result.msg, "Failed", "Oops!", {
        timeOut: "1800"
        });
        
        
      }
      
      }
    });
   
   }
   });
   
   /////////////////////////////////
   
   
     // Get the datepicker input element
     
   
    // Initialize the datepicker
    $("#matchdate").datepicker({
       // onSelect: function (datesel) {
       //    $('#MyTextbox2').trigger('change')
       // }, maxDate: new Date()
        dateFormat: 'dd-mm-yy' ,
        changeMonth: true,
         changeYear: true,
         showButtonPanel: true,
        minDate:0
    }
    );
   
      

   new Choices(document.getElementById("choices2"), { delimiter: ",", editItems: !0, removeItemButton: !0 });
   
   new Choices(document.getElementById("choices1"), { delimiter: ",", editItems: !0, removeItemButton: !0 });
   
   
   });


   
   
   
   
</script>