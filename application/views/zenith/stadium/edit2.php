<?php  $this->load->view(THEME.'common/header'); ?>
<div id="overlay" style="display: none;">
   <div id="loader">
      <!-- Add your loading spinner HTML or image here -->
      <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
   </div>
</div>
<style type="text/css">
   .event_img {
   margin: 30px 0;
   }
   .event_img img {
   width: 100%;
   height: auto;
   }
   .std_info  .custom-file-label {
   background-color: #E8EAEF;
   border-radius: 0px;
   color: #4C5271;
   height: 40px;
   text-align: left;
   font-weight: 700;
   border: 1px solid #E8EAEF;
   }
   .std_info  .custom-file-input:lang(en) ~ .custom-file-label::after{display: none;}
   .edit_map .form-control {
   color: #1A1919;
   height: 40px;
   border-radius: 0px;
   }
   .clr_select .form-control {
   width: 25px;
   height: 25px;
   border: none;
   margin: 5px auto;
   padding: 0px;
   }
   input[type="color"] {
   -webkit-appearance: none;
   border: none;
   width: 25px;
   height: 25px;
   }
   input[type="color"]::-webkit-color-swatch-wrapper {
   padding: 0;
   }
   input[type="color"]::-webkit-color-swatch {
   border: none;
   }
   .preview_details {
   margin: 0 auto;
   text-align: center;
   }
   .preview_details .btn-primary {
   padding: 10px 20px;
   border-radius: 0px;
   margin-right: 0px;
   margin-bottom: 0px;
   }
   .preview_details .btn-success {
   padding: 5px 20px;
   border-radius: 0px;
   margin-right: 0px;
   margin-bottom: 0px;
   }
   .grp_clrs .form-control {
   color: #1A1919;
   height: 40px;
   }
   .vertical-middle td {
   font-size: 14px;
   vertical-align: middle;
   }
   .add_delete_icon .fa-plus-circle {
   color: #43D39E;
   font-size: 20px;
   }
   .add_delete_icon .fa-trash-alt {
   color: #FF5C75;
   font-size: 20px;
   margin: 0px 10px;
   }
   .map_details_view .btn-success {
   padding: 8px 0px;
   border-radius: 0px;
   width: 100%;
   }
   .preview_details .btn-light {
   padding: 10px 20px;
   border-radius: 0px;
   margin-right: 0px;
   margin-bottom: 0px;
   }
   svg{
      cursor: pointer;
   }

   .st1{ fill:#FFF ; opacity: 0.3;     stroke: #f8f8f8;  }

</style>
<div class="main-content">
<!-- content -->
<div class="page-content">
   <input type="hidden" id="hiddenStadiumId" value="<?php echo $getStadium->s_id;?>">
   <!--  <prE> <?php 
      print_r($getStadium) ; 
      
      $stadium_img = explode("/", $getStadium->stadium_image);
      echo end($stadium_img);
      ?> </prE> -->
   <?php 
      $stadium_img = explode("/", $getStadium->stadium_image);
      $stadium_img  = end($stadium_img);
      ?>
   <!-- page header -->
   <div class="page-title-box tick_details">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-8">
               <h5 class="card-title"><?php echo $getStadium->stadium_name ;?></h5>
            </div>
            <div class="col-sm-4">
               <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                  <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2">Back</a>
                  <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2">Save</a>
               </div>
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
                           <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link ">
                           Settings
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                           Edit Map
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#messages-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                           Group Colors
                           </a>
                        </li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane  " id="home-b1">
                           <div class="row">
                              <div class="col-6">
                                 <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-md-12">
                                          <div class="event_img">
                                             <img id="res-stadium-image" src="<?php echo base_url($getStadium->stadium_image);?>">
                                          </div>
                                          <!--  <div class="button-list preview_details mb-3">
                                             <button type="button" class="btn btn-primary waves-effect waves-light" data-effect="wave">Preview</button>
                                             <button type="button" class="btn btn-light waves-effect" data-effect="wave">Edit Regions</button>
                                             </div> -->
                                       </div>
                                    </div>
                                    <!-- end col -->
                                 </div>
                                 <!-- end card -->
                              </div>
                              <!-- end col -->
                              <div class="col-6">
                                 <div class="card">
                                    <div class="team_info_details mt-0">
                                       <h5 class="">Stadium Info</h5>
                                       <p>Fill the Stadium Information</p>
                                    </div>
                                    <form method="post" action="<?php echo base_url('stadium/save_stadium');?>" class="validate_form_edit" id="save_stadium" >

                                        <input type="hidden"  name="satdiumId" id="satdiumId" value="<?php echo $getStadium->s_id;?>">


                                       <div class="row column_modified">
                                          <div class="col-lg-12">
                                             <div class="std_info">
                                                <div class="form-group">
                                                   <label for="simpleinput">File</label>
                                                   <div class="input-group">
                                                      <div class="custom-file">
                                                         <input type="file" class="custom-file-input" id="inputGroupFile04">
                                                         <label class="custom-file-label" for="inputGroupFile04"><?php echo $stadium_img;?></label>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="simpleinput">Stadium Category</label>
                                                <select class="custom-select" id="category" name="category" required data-live="change">
                                                   <option value="">Select Category</option>
                                                   <?php foreach ($gcategory as $category) { ?>
                                                   <option value="<?php echo $category->id; ?>" <?php if (isset($getStadium->category)) {
                                                      if ($getStadium->category == $category->id) {
                                                         echo ' selected  ';
                                                      }
                                                      } ?>><?php echo $category->category_name; ?></option>
                                                   <?php } ?>                                                        
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="stadium_name">Stadium Name (English)</label>
                                                <input type="text" name="stadium_name" id="stadium_name" class="form-control valid" placeholder="Stadium Name (English)" value="<?php echo $getStadium->stadium_name;?>" required="" aria-invalid="false">
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="stadium_name_ar">Stadium Name (Arabic)</label>
                                                <input type="text" name="stadium_name_ar" id="stadium_name_ar" class="form-control valid" placeholder="Stadium Name (Arabic)" value="<?php echo $getStadium->stadium_name_ar;?>" required="" aria-invalid="false">
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="search_keywords">Search Keywords</label>
                                                <input type="text" name="search_keywords" id="search_keywords" class="form-control valid" placeholder="Enter keyword here" value="<?php  echo $getStadium->search_keywords;?>" required="" aria-invalid="false">
                                             </div>
                                             <p>Use comma separated key. For ex. Lord Stadium, London.</p>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="simpleinput">Stadium Variant</label>
                                                <input type="text" name="stadium_variant" id="stadium_variant" class="form-control valid" placeholder="Enter stadium variant here" value="<?php  echo $getStadium->stadium_variant;?>"  aria-invalid="false">
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="row">
                                                <label class="col-md-12 control-label" for="stadium_country">Stadium Country</label>
                                                <div class="col-md-12">
                                                   <select class="custom-select" id="stadium_country" name="stadium_country" required  onchange="get_state_city(this.value);">
                                                      <option value="">Select Stadium Country</option>
                                                      <?php foreach ($countries as $country) { ?>
                                                      <option value="<?php echo $country->id; ?>" <?php if (isset($getStadium->country)) {
                                                         if ($getStadium->country == $country->id) {
                                                            echo ' selected  ';
                                                         }
                                                         } ?>><?php echo $country->name; ?></option>
                                                      <?php } ?>                                                        
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="row">
                                                <label class="col-md-12 control-label" for="stadium_city">Stadium City</label>
                                                <div class="col-md-12">
                                                   <select class="custom-select" id="stadium_city" name="stadium_city" required data-live="change">
                                                      <option value="">Select Stadium City</option>
                                                      <?php foreach ($cities as $city) { ?>
                                                      <option value="<?php echo $city->id; ?>" <?php if (isset($getStadium->city)) {
                                                         if ($getStadium->city == $city->id) {
                                                            echo ' selected  ';
                                                         }
                                                         } ?>><?php echo $city->name; ?></option>
                                                      <?php } ?>                                                          
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class=" mt-3"></div>

                                        <div class="tick_details border-top">
                  <div class="row">
                   
                     <div class="col-sm-12">
                        <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                           <a href="" class="btn btn-primary mb-2 mt-3">Back</a>
                           <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane  show active" id="profile-b1">
                           <div class="row">
                              <div class="col-6">
                                 <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-md-12">
                                          <div class="event_img">
                                            
                                             <div id="map-stadium">
                                               <?php echo file_get_contents(base_url($getStadium->stadium_image));?>
                                             </div>
                                          </div>
                                        
                                       </div>
                                    </div>
                                    <!-- end col -->
                                 </div>
                                 <!-- end card -->
                              </div>
                              <div class="col-6">
                                 <div class="card">
                                    <div class="row">
                                       <div class="col-lg-5 pl-1 pr-1">
                                          <div class="edit_map">
                                             <div class="form-group">
                                                <input type="text" id="mapsvg-regions-search" class="form-control" placeholder="Search regions by ID/Title">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-4 pl-1 pr-1">
                                          <div class="edit_map">
                                             <div class="form-group">
                                                <select class="custom-select  " id="default_category">
                                                         <option value="">Select Category</option>
                                                         <?php
                                                            if ($stadium_category): foreach ($stadium_category as $getSeatCat) {
                                                                    ;
                                                                    ?>
                                                         <option data-color="<?php echo $getSeatCat->color_code ;?>" data-name="<?php echo $getSeatCat->seat_category ;?>" value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                                         <?php } endif; ?>
                                                      </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3 pl-1 pr-1">
                                          <div class="map_details_view">
                                             <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-0 ml-2 edit_ticket_btn mt-0">Save Category</a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="section_left_scroll" id="content_1">
                                       <div class="">

                                         <script id="entry-template" type="text/x-handlebars-template">
                                           {{#each regions as | region |}}
                                               <tr id="mapsvg-region-{{main_category}}" data-region-id="{{id}}"  data-region-name="{{main_category}}" >
                                              <td class="dt-checkboxes-cell" tabindex="0">
                                                  <div class="custom-checkbox form-check"><input class="dt-checkboxes form-check-input checkboxinput region_block_id" type="checkbox" value="{{main_category}}" /><label class="form-check-label"></label></div>
                                              </td>
                                              <td>{{id}}</td>
                                              <td><select class="custom-select custom-select-2 mapsvg-region-link " type="text" autocomplete="off"  name="regions[{{main_category}}][href]" >
                                              <option value="">Select Category</option>
                                                         <?php
                                                            if ($stadium_category): foreach ($stadium_category as $getSeatCat) {
                                                                    ;
                                                                    ?>
                                                         <option data-color="<?php echo $getSeatCat->color_code ;?>" data-name="<?php echo $getSeatCat->seat_category ;?>" value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                                         <?php } endif; ?>
                                                      </select></td>
                                              <td>
                                                  <div class="clr_select"><input  name="regions[{{main_category}}][fill]" type="color" class="myjscolor mapsvg-region-color"  value="" id="aa-{{id}}"></div>
                                              </td>
                                          </tr>
                                          
                                       {{/each}}
                                       <tr id="mapsvg-search-regions-no-matches"  style="display"><td colspan="4" align="center" style="display:none">No Block Found</td></tr>
                                          </script>

                          
                                          <div class="compiled_template"></div>

                                          <table id="blocks_data" class="table  table-hover table-nowrap mb-0 vertical-middle">
                                             <thead class="thead-light">
                                                <tr >
                                                   <th tabindex="0" class="dt-checkboxes-cell" style="">
                                                      <div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" id="checkAll"><label class="form-check-label">&nbsp;</label></div>
                                                   </th>
                                                   <th>Block</th>
                                                   <th>Category</th>
                                                   <th>Colour </th>
                                                </tr>
                                             </thead>
                                            <tbody>
                                               
                                            </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane" id="messages-b1">
                           <div class="row">
                              <div class="col-6">
                                 <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-md-12">
                                          <div class="event_img">
                                             <img id="res-stadium-image" src="https://www.listmyticket.com//uploads/stadium/maps/user-uploads/san-siro.svg">
                                          </div>
                                          <div class="button-list preview_details mb-3">
                                             <button type="button" class="btn btn-primary waves-effect waves-light" data-effect="wave">Preview</button>
                                             <button type="button" class="btn btn-light waves-effect" data-effect="wave">Edit Regions</button>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end col -->
                                 </div>
                                 <!-- end card -->
                              </div>
                              <div class="col-6">
                                 <div class="card">
                                    <div class="row">
                                       <div class="col-lg-9 pl-1 pr-1">
                                          <div class="edit_map">
                                             <div class="form-group">
                                                <input type="text" id="simpleinput" class="form-control" placeholder="Type New Category Name">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3 pl-1 pr-1">
                                          <div class="map_details_view">
                                             <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-0 ml-2 edit_ticket_btn mt-0">Save Category</a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="section_left_scroll" id="content_2">
                                       <div class="">
                                          <table id="basic-datatable" class="table  table-hover table-nowrap mb-0 vertical-middle">
                                             <thead class="thead-light">
                                                <tr>
                                                   <th>Category</th>
                                                   <th>Colour Code</th>
                                                   <th>Colour</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <select class="custom-select" id="example-select">
                                                            <option>Longside Upper Tier</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                            <option>Select Team</option>
                                                         </select>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="grp_clrs">
                                                         <input type="text" id="matchticket" name="matchticket" class="form-control input valid" placeholder="RGBA (0,0,255,1)" required="" aria-invalid="false">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="clr_select">
                                                         <input class="form-control" id="example-color" type="color" name="color" value="#F18840">
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="add_delete_icon">
                                                         <a href=""><i class="fas fa-trash-alt"></i></a>
                                                         <a href=""><i class="fas fa-plus-circle"></i></a>
                                                      </div>
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
              
            </div>
         </div>
      </div>
   </div>
</div>
<pre>
<?php 
$json =  array();
if($stadium_details){
   foreach($stadium_details  as $sd){
      $json[] = array(
               'block_name'  => $sd->full_block_name,
               'block_color'  => $sd->block_color,
               'category'  => $sd->category,
      );
   }
}

?>
</pre>
<!-- main content End -->
<?php $this->load->view(THEME.'common/footer'); ?>

<?php $v="1.14";?>
<script src="<?php echo base_url() ?>assets/js/handlebars-v4.7.7.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/stadium-map.js?v=<?php echo $v;?>"></script>
<script type="text/javascript">

   var stadium_active = <?php echo  json_encode($json); ?>

      $.each(stadium_active, function(i, item) {
            $("[data-section="+item.block_name+"] .st1").css("fill" , rgb2hex(item.block_color ));
              $('input[name="regions[' + item.block_name + '][fill]"]').val( rgb2hex(item.block_color));
              $('select[name="regions[' + item.block_name + '][href]"]').val(item.category);
      });



      function call_color_text(){

            if($(".stadium_color").length  >0){

                  $('.stadium_color').each(function(key,value) {
                       var color_code =  $(this).val();
                      // console.log(color_code);
                       $(this).parents("tr").find(".mapsvg-region-color").val(rgb2hex(color_code))       ;                    });

                   var elements = document.getElementsByClassName("pandi_color");
                  for (var i = 0; i < elements.length; i++) {
                      elements[i].addEventListener('input', call_color, false);
                     // console.log(elements[i].value);

                  }

               }
         }
         function call_color(event){

                
                         var input = event.target.value;
                         var input_rgba = hexToRgbA2(event.target.value);

                         $(this).parents("tr").find(".stadium_color").val(input_rgba);

                           var staduim_id  = $("#hiddenStadiumId").val();
                           var category = $(this).parents("tr").find('.stadium_category_by_color').val();;
                           var color_name =input_rgba;
                           var old_category  = $(this).parents("tr").attr('data-category');
                           //  var color_name =  $(this).parents("tr").find('.stadium_color').val();
                           var id  =  $(this).parents("tr").attr('data-id');
                        // console.log(color_name);
                           
                           $("#default_category").attr('data-color',''  );

                           $('.mapsvg-region-link option[value="'+category+'"]').attr("data-color", color_name);

                           $(".cc-" + category ).find(".myjscolor").val(input);
                           $(".map-" + category ).css({fill: color_name});

                           $.ajax({
                               type: "POST",
                               url: base_url + '/game/stadium_color_category/update' ,
                               data: { "stadium_id"  : staduim_id, "color_code": color_name, "category_id" : category ,'id' : id,'old_category' :  old_category},
                               dataType: 'json',
                             success: function(data){
                                 console.log(data.stadium_category);
                                  var option_s ="<option value=''>Select Category</option>";
                                       if(data.stadium_category){
                                          $.each(data.stadium_category, function(key,val) {
                                              option_s += "<option data-color='"+val.color_code+"' data-name='"+val.seat_category+"' value='"+val.stadium_seat_id+"' >"+val.seat_category+"</option>"
                                          });
                                          $("#default_category").html(option_s);
                                       }
                                    //window.location.reload();
                                }
                           });

         }
   
            startup();
            var colorWell;
               


                  function startup() {
                          // colorWell = $("#aa-AA-101");
                          //colorWell.value = defaultColor;
                        var elements = document.getElementsByClassName("myjscolor");

                        for (var i = 0; i < elements.length; i++) {
                            elements[i].addEventListener('input', updateAll, false);
                         //   console.log(elements[i].value);

                        }

                       
                         
                          // colorWell.addEventListener("input", updateFirst, false);
                   // colorWell.select();
                  }
                  // function updateFirst(event) {
                  
                  //   var p = document.querySelector("p");

                  //   if (p) {
                  //     p.style.color = event.target.value;
                  //   }
                  // }
                  function updateAll(event) {
                      //  console.log(event);
                        

                           var color_name = event.target.value ?  hexToRgbA2(event.target.value) : "";

                            var rid = $(this).parents("tr").attr('data-region-name');
                                // alert(rid);
                            // var c = event.color.toRGB();
                            // var color = 'rgba(' + c.r + ',' + c.g + ',' + c.b + ',' + c.a + ')';
                            // if ($(this).closest('.form-group').find('input').val() == "")
                            //     color = null;

                            $('.preloader_full').css('display', 'none');

                            var stadiumId = $('#hiddenStadiumId').val();
                            var getUrl = window.location;
                            // var base_url = getUrl.origin + '/' + getUrl.pathname.split('/')[1]; // + '/' + getUrl.pathname.split('/')[1]
                            if (stadiumId != '') {
                                $.ajax({
                                    type: 'POST',
                                    url: base_url + 'stadium/update_statdium_block',
                                    data: {'stadiumid': stadiumId, 'block_id': rid, 'color': color_name , 'href': $('select[name="regions[' + rid + '][href]"]').val()},
                                    success: function (response) {



                                    }
                                });
                            }

                         $("[data-section="+rid+"] .st1").css("fill" , color_name);


                    

                    }

    $("body").on("click","#checkAll",function(){
       $('.checkboxinput:checkbox').not(this).prop('checked', this.checked);
   });

   $('body').on("click"," #map-stadium g[data-section]",function(){
         var section = $(this).data("section");
       //  var block = split_block(section);
         $("#content_1").mCustomScrollbar("scrollTo","#mapsvg-region-" + section);
        // $('#blocks_data').find('#mapsvg-region-' + block).css("background","RED");
        // $('#blocks_data').animate({
        //       scrollTop: $('#content_1 #mapsvg-region-'+ block).offset().top
        //  }, 2000);
   });

    

    $('body').on('change', '.mapsvg-region-link', function (e) {
     $('.preloader_full').css('display', 'none');
 // var dataname = $("#default_category").find(':selected').data('name');
     var datacolor = $(this).find(':selected').data('color');
     var rid = $(this).parents("tr").attr('data-region-name');
     var region_name = $(this).parents("tr").attr('data-region-name');
  
     // alert($('select[name="regions[' + rid + '][href]"]').val());
     var stadiumId = $('#hiddenStadiumId').val();
     // var getUrl = window.location;
     if (stadiumId != '') {
       
          var color_id = datacolor;
          var old_category  = $(this).parents("tr").attr('data-category');
            
         
          $('input[name="regions[' + rid + '][fill]"]').val( rgb2hex(datacolor));
          $('#aa-' + rid).css("background",datacolor);
          $("[data-section="+region_name+"] .st1").css("fill" , rgb2hex(datacolor ));
          $('path#'+ rid).addClass("map-"+$(this).val()).removeClass("map-"+old_category);
          $('#mapsvg-region-'+ rid).addClass("cc-"+$(this).val()).removeClass("cc-"+old_category).attr('data-category',$(this).val());;
         //var color_id = $('input[name="regions[' + rid + '][fill]"]').val();
       
         $.ajax({
             type: 'POST',
             url: base_url + 'stadium/update_statdium_block',
             data: {'stadiumid': stadiumId, 'block_id': rid, 'color': datacolor, 'href': $(this).val()},
             success: function (response) {
             }
         });
     }

     return;

 });

      $("body").on("change",".region_block_id",function(){
         var seval = $(this).val();
         if (!$(this).is(':checked')) {
               $("#"+ seval).css("opacity","1");
           
         }else{
            $("#"+ seval).css("opacity","0.5");
         } 
      });


    $("body").on("click",".edit_ticket_btn ",function(){
       var selected_val  =$("#default_category").val();
       var dataname = $("#default_category").find(':selected').data('name');
       var datacolor = $("#default_category").find(':selected').data('color');
       if(selected_val){
          var checked_val = $(".region_block_id:checked").length ;
           if(checked_val > 0){
   
               var block_ids = new Array();
   
               $('.region_block_id:checked').each(function() {
                  var sel_val = $(this).val();
                  var old_category  = $(this).parents("tr").attr('data-category');
                  $("#mapsvg-region-" + sel_val).attr("data-category",selected_val ) ; 
                  var region_name = $(this).parents("tr").attr('data-region-name');

                  $(this).parents("tr.cc-"+ old_category ).addClass("cc-"+ selected_val).removeClass("cc-"+ old_category); 

                  $("#category_name_"+ sel_val).html(dataname);
                  $('input[name="regions[' + sel_val + '][fill]"]').val( rgb2hex(datacolor));
                  $('#picker_' + sel_val).css("background",datacolor);

                  $("[data-section="+region_name+"] .st1").css("fill" , rgb2hex(datacolor));


                  $('#' + sel_val).css("background",datacolor);
                  $('#' + sel_val).addClass("map-" + selected_val ).removeClass("map-"+ old_category);;
                  block_ids.push(sel_val);
                  $("#"+sel_val).css("fill" , datacolor);
                  $('select[name="regions[' + sel_val + '][href]"]').val(selected_val);
                   $("#"+ sel_val).css("opacity","1");
               });
              // console.log(block_ids);
   
               var category = selected_val;
               var staduim_id  = $("#hiddenStadiumId").val();
               var block_id  = block_ids;
               //var color_name = hexToRgbA2(datacolor);
               var color_name = datacolor;
   
               $.ajax({
                   type: "POST",
                   url: base_url + '/stadium/update_multiple_category' ,
                   data: { "staduim_id"  : staduim_id, "color_name": color_name, "category" : category, "block_id" : block_ids  },
                   success: function(msg){
                       $('.region_block_id:checked').each(function() {
                        var rid = $(this).val();
              
                       $('select[name="regions[' + rid + '][href]"]').val(category);
                       $(".region_block_id.checkboxinput").prop("checked",false);
                       $("#checkAll").prop("checked",false);
                       $("#default_category").val("");
                   });
   
                       //window.location.reload();
                   }
               });
           }
           else{
   
                swal({
                 title: 'Please Choose Block',
                 type: 'warning',
            

             });
           }
   
       }
       else{
   
          swal({
                 title: 'Please Choose Category',
                 type: 'warning',
            

             });

       }
   
   });


   // Regions
   var searchTimer;
   $('#mapsvg-regions-search').on('keyup', function () {
       searchTimer && clearTimeout(searchTimer);
       var that = this;
       var search_keyword = $(that).val();
       searchTimer = setTimeout(function () {
           $('#mapsvg-search-regions-no-matches').hide();
           if (search_keyword.length >  0) {
            
               $('#blocks_data  tbody tr').hide();

               $("tr[data-region-id^='"+ search_keyword+"']").show();  
               if(  $("tr[idata-region-id^='"+ search_keyword+"']").length == 0)   {
                     $('#mapsvg-search-regions-no-matches').show();
               } 
           } else {
               $('#blocks_data tr').show();
               $('#mapsvg-search-regions-no-matches').hide();
           }
       }, 300);
   });

  




   $("#content_1").mCustomScrollbar({
      mouseWheelPixels: 500 ,
      scrollButtons:{
        enable:true
      }

    });
   $("#content_2").mCustomScrollbar({
        mouseWheelPixels: 500 ,
      scrollButtons:{
        enable:true
      }
    });
   
   function get_state_city(country_id,city_id="") { 
    if(country_id != ''){ 
      $('#city').html('');
      $.ajax({
        type: "POST",
        dataType: "json",
        url: base_url + 'event/matches/get_city',
        data: {'country_id' : country_id},
        success: function(res_data) {
   
            var state_city = JSON.parse(JSON.stringify(res_data));
           
   
          $('#stadium_city').html(state_city.city);
          $('#state').val(state_city.state);
          if(city_id != "'"){
               $('#stadium_city').val(city_id);
            }
        }
      })
   
    }
   }
</script>