
<?php 
$total_quantity =0 ;
$total_sold =0 ;
if($match_details[0]->tickets){

 $total_quantity  = array_sum(array_column($match_details[0]->tickets,'quantity'));
 $total_sold  = array_sum(array_column($match_details[0]->tickets,'sold'));

 $total_quantity = $total_quantity + $total_sold;
}
$tab = @$_GET['tab'] ?  $_GET['tab'] :"home";
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
.data_edit_2{
      min-height: 230px;
   }
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
                     <a href="#home" data-id="home" data-toggle="tab" aria-expanded="false" class="nav-link <?php echo $tab=="home" ? "active" : ""  ;?>">
                     Add or Edit Event
                     </a>
                  </li>
                  
                 
                  <li class="nav-item">
                     <a href="#content" data-id="content" data-toggle="tab" aria-expanded="true" class="nav-link  <?php echo $tab=="content" ? "active" : ""  ;?>">
                     Content Info
                     </a>
                  </li>
                
                 
                  <li class="nav-item">
                     <a href="#tickets" data-id="tickets" data-toggle="tab" aria-expanded="false" class="nav-link <?php echo $tab=="tickets" ? "active" : ""  ;?>">
                     Ticket Details
                     </a>
                  </li>
                
               </ul>
               <div class="tab-content">
                  <div class="tab-pane show <?php echo $tab=="home" ? "active" : ""  ;?>" id="home">
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

                                          <?php      
                                           foreach ($categories as $key => $value) {
                                                      if($value->parent_id == 0){
                                                         $categories_data[$value->category_name][]  = $value;
                                                      }
                                                      else{
                                                         $categories_data[$value->PARENT][]  = $value;
                                                      }
                                                   } ?>
                                    
                                          <option value="">Select Category</option>
                                             <?php foreach ($categories_data as $category_main) {
                                                foreach ($category_main as $key => $category ) { ?>
                                             
                                            <option value="<?php echo $category->id; ?>" <?php if ($category->id == $event->other_event_category) { ?> selected <?php } ?> > <?php if ($category->parent_id != 0) { ?>-<?php  } ?> <?php echo $category->category_name; ?></option>
                                             <?php }  } ?>
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
                                             $stadium_name = $stadium->stadium_name.' - '.$stadium->s_id;                                     if($stadium->stadium_variant != ''){
                                               $stadium_name = $stadium->stadium_name.' - '.$stadium->s_id.' - '.$stadium->stadium_variant;
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
                                       <input class="form-control" id="example-time" type="time" name="matchtime" value="<?php echo $event->match_time;?>" required >
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
                                      <input type="text" id="matchticket" name="matchticket" class="form-control input" placeholder="Enter Tickets Count"  value="<?php echo ($event->matchticket == 0) ? 500 : $event->matchticket; ?>">
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
                                          <label for="example-select">Event Image</label>
                                          <div class="prev_back_img">
                                            <label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($event->event_image)) {
                                          echo $event->event_image;
                                          } ?>"><input type="file"  class="form-control-file input"  name="event_image" id="event_image" value="" onchange="loadFiles(event,'blog_img_file')" <?php  echo isset($event->m_id) ? '' : 'required'; ?> > Upload JPEG File</label>
                                            <div class="blog_del">
                                            <p>Previous Blog Image</p>
                                            <a href="javascript:void(0);" style="display:none;" class="event_image_delete"><i class="bx bxs-trash " data-input="event_image" ></i> Delete</a>

                                         </div>
                                            <a id="blog_img_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($event->event_image)) {
                                          echo UPLOAD_PATH.'uploads/event_image/'.$event->event_image;
                                          } ?>')" class="view_bg">
                                          <img width="30" height="30" src="<?php if (isset($event->event_image)) {
                                          echo UPLOAD_PATH.'uploads/event_image/'.$event->event_image;
                                          }else { echo UPLOAD_PATH.'/uploads/general_settings/no-image.png';} ?>" id="blog_img_file">
                                      </a>
                                          </div>
                                          <label id="event_image-error" class="error" for="event_image"></label>
                                      </div> 
                                   </div>


                                   <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="example-select">Upload Seating Map</label>
                                          <div class="prev_back_img">
                                            <label class="custom-upload mb-0"><input type="hidden" name="exs_file2" value="<?php if (isset($event->seat_mapping)) {
                                          echo $event->seat_mapping ;
                                          } ?>"><input type="file"  class="form-control-file input"  name="seat_mapping" id="seat_mapping" value="" onchange="loadFiles(event,'seat_mapping_file')"> Upload JPEG File</label>
                                            <div class="blog_del">
                                            <p>Previous Blog Image</p>

                                            <a href="javascript:void(0);" style="display:none;" class="seat_mapping_image_delete" data-input="seat_mapping"><i class="bx bxs-trash " ></i> Delete</a>

                                         </div>
                                            <a id="seat_mapping_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($event->seat_mapping )) {
                                          echo UPLOAD_PATH.'uploads/seat_mapping/'.$event->seat_mapping;
                                          } ?>')" class="view_bg">
                                          <img width="30" height="30" src="<?php if (isset($event->seat_mapping)) {
                                          echo UPLOAD_PATH.'uploads/seat_mapping/'.$event->seat_mapping;
                                          }else { echo UPLOAD_PATH.'/uploads/general_settings/no-image.png';} ?>" id="seat_mapping_file">
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
                                          <!-- <tr>
                                             <td><label for="sellers" class="mb-0">Event Visible On 1Box </label></td>
                                             <td>
                                                <div class="form-group mb-1 cust-switch">
                                                   No / Yes
                                                   <div class="custom-control custom-switch">
                                                      <input type="checkbox" class="custom-control-input" id="customSwitch13" name="store[]" value="13" <?php
                                                      
                                                    /*   $storefront_ids = explode(', ', $event->storefronts);
                                                                          }

                                                                              if ($event->m_id == "" || in_array(13, $storefront_ids)) {
                                                                                 echo 'checked';
                                                                             }*/
                                                      ?> >
                                                      <label class="custom-control-label" for="customSwitch13"></label>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr> -->
                                          
                                          <tr>
                                             <td> <label for="customSwitch19" class="mb-0">Availability *</label></td>
                                             <td>
                                                <div class="form-group mb-1 cust-switch">
                                                   No / Yes
                                                   <div class="custom-control custom-switch">
                                                      <input type="checkbox" class="custom-control-input" id="customSwitch19" name="is_active" value="1" <?php if ($event->match_status == '1' || $event->match_status == '') { ?> checked <?php } ?> >
                                                      <label class="custom-control-label" for="customSwitch19"></label>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td><label for="customSwitch20" class="mb-0">Top Game</label></td>
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
                                             <td><label for="customSwitch21" class="mb-0">Upcoming Events</label></td>
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
                                             <td><label for="customSwitch22" class="mb-0">Almost Sold Ticket?</label></td>
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
                                             <td><label for="customSwitch23" class="mb-0">High Demand Ticket ?</label></td>
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

                                          <tr>
                                             <td><label for="customSwitch017" class="mb-0">To Be Confirmed</label></td>
                                             <td>
                                                <div class="form-group mb-1 cust-switch">
                                                   Disable / Enable
                                                   <div class="custom-control custom-switch">
                                                      <input type="checkbox" id="customSwitch017" class="is-switch custom-control-input" name="tbc_status" value="1" <?php if($event->tbc_status == '1'){?> checked <?php } ?> >
                                                      <label class="custom-control-label" for="customSwitch017"></label>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>

                                          <tr>
                                             <td> <label for="customSwitch018" class="mb-0">Ignore Auto 24 Off</label></td>
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
                                         
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="clearfix"></div>

                        <div class="team_info_details mt-3">
                          <h5 class="card-title">API Share</h5>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                                <div class="row column_modified">
                                    <div class="col-lg-4">
                                       <div class="data_edit data_edit_2">
                                          <table style="width: 100%;">
                                          
                                          <?php foreach ($partners as $partner) { ?>
                                             <tr>
                                                <td><label for="partner_<?php echo $partner->admin_id; ?>" class="mb-0"><?php echo $partner->company_name ; ?></label></td>
                                                <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                      Disable / Enable
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" name="partner[]" id="partner_<?php echo $partner->admin_id; ?>" value="<?php echo $partner->admin_id; ?>" <?php
                                                            $partner_ids = explode(',', $event->partners);

                                                            if ($event->m_id == "" || in_array($partner->admin_id, $partner_ids)) {
                                                               echo 'checked';
                                                           }
                                                          
                                                            ?>>
                                                            <label class="custom-control-label" for="partner_<?php echo $partner->admin_id; ?>"></label>
                                                         </div>
                                                      </div>
                                                </td>
                                             </tr>
                                          <?php } ?>

                                          <?php 
                                          foreach ($partners_api as $partner_api) { 
                                             
                                             ?>
                                                <tr>
                                                   <td><label for="sellers" class="mb-0"><?php echo $partner_api->api_name ; ?></label></td>
                                                   <td>
                                                         <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                            <div class="custom-control custom-switch">
                                                               <input type="checkbox" class="custom-control-input" name="partner_api[]" id="partner_api_<?php echo $partner_api->api_id; ?>" value="<?php echo $partner_api->api_id; ?>" <?php
                                                               $inpt_status = ($partner_api->api_id == 1) ? "tixstock_status" : "oneclicket_status";

                                                               if ($event->m_id == "" ||  $event->$inpt_status==1 ) { echo 'checked';  } ?>>
                                                               <label class="custom-control-label" for="partner_api_<?php echo $partner_api->api_id; ?>" ></label>
                                                            </div>
                                                         </div>
                                                   </td>
                                                </tr>
                                           <?php } ?>
                                           
                                          </table>
                                       </div>
                                    </div>

                                    <div class="col-lg-4">
                                       <div class="data_edit data_edit_2">
                                          <table style="width: 100%;">                                                  
                                          <?php foreach ($afiliates as $afiliate) { ?>
                                                <tr>
                                                   <td><label for="afiliate_<?php echo $afiliate->admin_id; ?>" class="mb-0"><?php 
                                                   //$afiliate->admin_name . ' ' . $afiliate->admin_last_name . ' (' .
                                                   echo  $afiliate->company_name ; ?></label></td>
                                                   <td>
                                                         <div class="form-group mb-1 cust-switch">
                                                         Disable / Enable
                                                            <div class="custom-control custom-switch">
                                                               <input type="checkbox" class="custom-control-input" id="afiliate_<?php echo $afiliate->admin_id; ?>" name="afiliate[]" value="<?php echo $afiliate->admin_id; ?>" <?php
                                                               $afiliate_ids = explode(',', $event->afiliates);
                                                               if ($event->m_id == "" || in_array($afiliate->admin_id, $afiliate_ids)) {
                                                                  echo 'checked';
                                                              }                                                                    
                                                               ?>>
                                                               <label class="custom-control-label" for="afiliate_<?php echo $afiliate->admin_id; ?>"></label>
                                                            </div>
                                                         </div>
                                                   </td>
                                                </tr>
                                             <?php } ?>
                                            
                                          </table>
                                       </div>
                                    </div>

                  <div class="col-lg-4">
                     <div class="data_edit data_edit_2">
                        <table style="width: 100%;">

                       
                           <?php foreach ($storefronts as $storefront) {

                                 if($storefront->store_id  != 238){
                                      ?>
                                          <tr>
                                                <td><label for="store_<?php echo $storefront->store_id; ?>" class="mb-0"><?php echo $storefront->site_value ; ?></label></td>
                                                <td>
                                                   <div class="form-group mb-1 cust-switch">
                                                   Disable / Enable
                                                      <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="store_<?php echo $storefront->store_id; ?>" name="store[]" value="<?php echo $storefront->store_id; ?>" <?php
                                                            $storefront_ids = explode(',', $event->storefronts);
                                                            if ($event->m_id == "" || in_array($storefront->store_id, $storefront_ids)) {
                                                               echo 'checked';
                                                           }
                                                        
                                                            ?>>
                                                            <label class="custom-control-label" for="store_<?php echo $storefront->store_id; ?>"></label>
                                                      </div>
                                                   </div>
                                                </td>
                                          </tr>
                                       <?php 
                                    } }  ?>

                          
                        </table>
                     </div>
                  </div>
                                 </div>
                             </div>
                          </div>
                       </div>

                     <div class="clearfix"></div>

                       <div class="team_info_details mt-3">
                          <h5 class="card-title">User Restrictions</h5>
                        </div>

                         <div class="row">
                          <div class="col-12">
                            <div class="card">
                                <div class="row column_modified">
                                   <div class="col-lg-12 mb-5">
                                    
                                       <div class="form-group">
                                           <label for="sellers">Select Sellers</span> </label>
                                           <select class="actionpayout roleuser form-control" multiple  name="seller[]" id="sellers">
                                             
                                              <?php foreach($sellers as $seller){ ?>
                                              <option 
                                                   <?php
                                                   $seller_ids = explode(',', $event->sellers);
                                                   if (in_array($seller->admin_id, $seller_ids)) {
                                                         echo 'selected';
                                                   }
                                                   ?>                                                   
                                             value="<?php echo $seller->admin_id;?>" ><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                                                                             <?php } ?>
                                          </select>
                                         
                                       <div class="sort_filters">
                                         
                                       </div>
                                    </div>
                                           
                                       </div> 
                                    </div>
                                </div>
                             </div>
                          </div>
                       <!-- </div> -->
                    
                     <!-- end row -->
                      <!-- end row -->
                        <div class="tick_details border-top mt-4">
                           <div class="row">
                              <div class="col-sm-8">
                                 <!-- <h5 class="card-title">Matches</h5> -->
                              </div>
                              <div class="col-sm-4">
                                 <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                    <a href="<?php echo base_url() . 'event/other_events/upcoming';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                       <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                  </form>
                  </div>
                  <div class="tab-pane <?php echo $tab=="content" ? "active" : ""  ;?>" id="content">
                     <div class="row">
                        <div class="col-12">
                           <div class="card">
                              <div class="team_info_details mt-3">
                                 <h5 class="card-title">Match Content Info</h5>
                                 <p>Fill the Match Content Information</p>
                           </div>
                              <div class="">
                                 <form id="branch-form-2" method="post" class="validate_form_v2 login-wrapper" action="<?php echo base_url();?>event/matches/save_matches_content">
                                    <input type="hidden" name="matchId" value="<?php  echo isset($event->m_id) ? $event->m_id : ''; ?>">
                                    <input type="hidden" name="flag" value="content">
                                    <input type="hidden" name="event_type" value="other">
                                    <div class="row column_modified">
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="simpleinput">Match Title <span class="text-danger">*</span></label>
                                             <!-- <input type="text" id="simpleinput" class="form-control" placeholder="Enter Tournament Name" <?php //echo $event->match_name;?> value="<?php echo $event->match_name;?>"> -->
                                             <!-- disabled -->
                                             <input  type="text" id="matchname" name="matchname" class="form-control" placeholder="Enter Match Title" value="<?php
                                                echo isset($event->match_name) ? $event->match_name : '';?>">
                                             <input  type="hidden" id="" name="" class="input" placeholder="Enter Match Title" required value="<?php echo $event->match_name;?>">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="simpleinput">Meta Title <span class="text-danger">*</span></label>
                                             <input type="text" id="simpleinput" class="form-control" placeholder="Enter Meta Title" name="metatitle" required value="<?php echo isset($matches_lang->meta_title) ? $matches_lang->meta_title : '';?>">
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="example-textarea">Meta Description <span class="text-danger">*</span></label>
                                             <textarea class="form-control height_auto" id="example-textarea" rows="5" name="metadescription" placeholder="Enter Meta Description"><?php echo isset($matches_lang->meta_description) ? $matches_lang->meta_description : ''; ?></textarea>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="example-textarea">Match Description<span class="text-danger">*</span></label>
                                             <textarea id="editor-4" name="description" placeholder="Enter Match Description"><?php echo isset($matches_lang->description) ? $matches_lang->description : ''; ?></textarea>
                                          </div>
                                       </div>

                                       <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="example-textarea">Long Description</label>
                                                 <textarea id="editor-5" name="long_description" placeholder="Enter Long Description"><?php echo isset($matches_lang->long_description) ? $matches_lang->long_description : ''; ?></textarea>
                                               </div>
                                          </div>  
                                          
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="simpleinput">Seo Keywords</label>
                                             <input type="text" id="choices1" class="form-control" placeholder="Enter Seo Keywords" value="<?php echo isset($matches_lang->seo_keywords) ? $matches_lang->seo_keywords : ''; ?>" name="seo_keywords">
                                          </div>
                                       </div>
                                       
                                    </div>
                                    <div class="tick_details border-top">
                           <div class="row">
                              <div class="col-sm-8">
                                 <!-- <h5 class="card-title">Matches</h5> -->
                              </div>
                              <div class="col-sm-4">
                                 <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                    <a href="<?php echo base_url() . 'event/other_events/upcoming';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                       <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                                 </form>
                              </div>
                              <!-- end card-body -->
                           </div>
                           <!-- end card -->
                        </div>
                        <!-- end col -->
                     </div>
                  </div>
                  <div class="tab-pane <?php echo $tab=="tickets" ? "active" : ""  ;?>" id="tickets">
                     <div class="row">
                        <div class="col-12">
                           <div class="card listing_details mt-3">
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
                                  <!--   <div class="col-lg-2">
                                       <div class="event_name">
                                          <h4>Tournament</h4>
                                          <p><?php
                                             if(isset($event->tournament_name))
                                             { echo $event->tournament_name;
                                             }?></p>
                                       </div>
                                    </div> -->
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


$(document).ready(function () {
var m_id = '<?php echo $event->m_id; ?>';
if (m_id === "") {
$('#blog_img_file_link, #seat_mapping_file_link')
.removeAttr('onclick')
.css('pointer-events', 'none');
}

});

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


   function get_state_city(country_id,city_id="") {
        if(country_id != ''){ 

         $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'event/matches/get_sortname',
            data: {'country_id' : country_id},
            success: function(response) {
               $("#price_type").val(response.currency);               
            }
          })


          $('#city').html('');
          $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'event/matches/get_city',
            data: {'country_id' : country_id},
            success: function(res_data) {
      
                var state_city = JSON.parse(JSON.stringify(res_data));
               
      
              $('#city').html(state_city.city);
              $('#state').val(state_city.state);
              if(city_id != "'"){
                   $('#city').val(city_id);
                }
            }
          })
      
        }
      }

$('.content_form').validate({
  submitHandler: function(form) {
   
   var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
   var formData = new FormData(myform);
  var overlay = $('#overlay');

   // $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

   // $('.has-loader').addClass('has-loader-active');
    
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
      beforeSend: function() {
                    overlay.show();
                    },
      success: function(data) { 
        overlay.hide();
     //   $('#'+$(form).attr('id')+'-btn').removeClass("is-loading no-click");

        if(data.status == 1) {

         swal('Success !', data.msg, 'success');
         // setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
          swal('Failed !', data.msg, 'error');
          //setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
      }
    })
    return false;
  }
});



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

function slugfly(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
  var to   = "aaaaaeeeeeiiiiooooouuuunc------";
  for (var i = 0, l = from.length; i < l; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
           .replace(/\s+/g, '-') // collapse whitespace and replace by -
           .replace(/-+/g, '-'); // collapse dashes

  return str;
}
<?php if(empty($event->m_id)) { ?>
$("body").on("keyup","#eventname",function(){
var val = $("#eventname").val();
 var slug ="";
if(val){
    slug = slugfly(val);
    $("#event_url").val(slug);
}


});
<?php } ?>

new Choices(document.getElementById("choices2"), { delimiter: ",", editItems: !0, removeItemButton: !0 });

new Choices(document.getElementById("choices1"), { delimiter: ",", editItems: !0, removeItemButton: !0 });




$(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
  var href =  $(this).data("id");
<?php if(empty($event->m_id)){ ?>
   if(href != "home"){
      swal('Attention!', ' Please Fill The Event Details', 'error');
      return false;
   }
<?php  } else{
?>
 
   // Get current URL parts
   const path = window.location.pathname;
   const params = new URLSearchParams(window.location.search);
   const hash = window.location.hash;
   // Update query string values
   params.set('tab', href);

   window.history.replaceState({}, '', `${path}?${params.toString()}${hash}`);
<?php } ?>
});

$("body").on('click', '.dropdown-menu-custom .check_box, .seat_category_check_box', function (e) {
   //    alert('dd');
   e.stopPropagation();
});


$(".search_box").on('keyup', function(){
        var value = $(this).val().toLowerCase();

          

     $(this).parents(".dropdown-menu").find(".custom-checkbox").each(function () {
           if ($(this).find("label").text().toLowerCase().search(value) > -1) {
              $(this).show();
          
           } else {
              $(this).hide();
           }
        });
     });


//         $('#seat_mapping').on('change', function() {
//      $('.seat_mapping_image_delete').show(); // Show delete option
//  });

//  // Delete option click event
//  $('.seat_mapping_image_delete').on('click', function(e) {
//      e.preventDefault();
//      $('#seat_mapping').val(''); // Reset file input value
//      $(this).hide(); // Hide delete option
//  });

//  $('#event_image').on('change', function() {
//      $('.event_image_delete').show(); // Show delete option
//  });

//  $('.event_image_delete').on('click', function(e) {
//      e.preventDefault();
//      $('#event_image').val(''); // Reset file input value
//      $(this).hide(); // Hide delete option
//  });

// Delete option click event
$(document).on('click', '.seat_mapping_image_delete, .event_image_delete', function(e) {
e.preventDefault();    
var inputId = $(this).data('input');
$('#' + inputId).val(''); // Reset file input value
$(this).hide(); // Hide delete option

if ($(this).hasClass('event_image_delete')) {
$('#event_image').val('');
var class_name='blog_img_file';
var pointer_not_click='blog_img_file_link';
$('#event_image').attr('required', true);

} else {
$('#seat_mapping').val('');
var class_name='seat_mapping_file';
var pointer_not_click='seat_mapping_file_link';
}

var imageUrl = base_url+'/uploads/general_settings/no-image.png';
$('#'+class_name).attr('src', imageUrl);

$('#'+pointer_not_click).removeAttr('onclick');
$('#'+pointer_not_click).css('pointer-events', 'none');

});

$('#venue').on('change', function(event) {

selected_venue_value= $("#venue option:selected").val();
   $.ajax({
     type: "POST",
     dataType: "json",
     url: base_url + 'event/matches/get_venue',
     data: {'venue' : selected_venue_value},
     success: function(res_data) {
       $("#country").val(res_data.selected_country);
       get_state_city(res_data.selected_country,res_data.selected_city);       

     }
   })
});

// Change event for seat_mapping input
$('#seat_mapping').on('change', function() {
$('.seat_mapping_image_delete').show(); // Show delete option
});

// Change event for event_image input
$('#event_image').on('change', function() {
$('.event_image_delete').show(); // Show delete option
});
if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0,   searchFields: ['label', 'value'] ,allowSearch: true});

});

 $(document).on('change', '.sell_ticket_status', function () {
            var ticket_id = $(this).data('ticket');
            var ticket_status_check = $(this).is(':checked');
            var ticket_status = ticket_status_check ? 1 : 0;
            var flag = "";
            // Make an AJAX POST request
            $.ajax({
               url: base_url + 'tickets/index/event_ticket_update_status',
               type: 'POST',
               dataType: 'json',
               data: {
                  "ticket_id": ticket_id,
                  "ticket_status": ticket_status,
                  "flag": flag
               },
               success: function (data) {
                  if (data.status == 1) {
                     swal('Updated !', data.msg, 'success');

                  } else if (data.status == 0) {

                     swal('Updation Failed !', data.msg, 'error');

                  }
                  // setTimeout(function () { window.location.reload(); }, 2000);
               },
               error: function (xhr, status, error) {
                  // Handle the error here
                  console.log(error);
               }
            });
         //}
      });
</script>