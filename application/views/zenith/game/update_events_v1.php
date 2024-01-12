<style>
    .check_box,.seat_category_check_box {
    max-height: 250px;
    overflow-y: auto;
}
</style>

<style type="text/css">
    
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
<?php $this->load->view(THEME . 'common/header');
//echo "<pre>";print_r($dropdownlist);exit;  
function getChildren($array, $category = NULL){  

  foreach($array as $child){

    if(isset($child['children']) && $child['children']){

      if($category != NULL){

        $newCategory = $category . ' > ' . $child['name'];


      }else {

          $newCategory = $child['name'];

        }

      getChildren($child['children'], $newCategory);

    } else {

     // echo '<option value="' . $child['id'] . '">' . $category . ' > ' . $child['name'] . '</option>';
       echo '<option value="' . $child['name'] . '">' . $category . ' > ' . $child['name'] . '</option>';

    }

  }

  unset($category);

}

function getChildren_oneclicket($array, $category = NULL){  

  foreach($array as $child){

    if(isset($child['children']) && $child['children']){

      if($category != NULL){

        $newCategory = $category . ' > ' . $child['category'];


      }else {

          $newCategory = $child['category'];

        }

      getChildren_oneclicket($child['children'], $newCategory);

    } else {

     // echo '<option value="' . $child['id'] . '">' . $category . ' > ' . $child['name'] . '</option>';
       echo '<option value="' . $child['category_id'] . '">' . $category . ' > ' . $child['category'] . '</option>';

    }

  }

  unset($category);

}


function getChildren_xs2event($array, $category = NULL){  

  foreach($array as $child){

    if(isset($child['children']) && $child['children']){

      if($category != NULL){

        $newCategory = $category . ' > ' . $child['category'];


      }else {

          $newCategory = $child['category'];

        }

      getChildren_xs2event($child['children'], $newCategory);

    } else {

     // echo '<option value="' . $child['id'] . '">' . $category . ' > ' . $child['name'] . '</option>';
       echo '<option value="' . $child['unique_id'] . '">' . $category . ' > ' . $child['category'] . '</option>';

    }

  }

  unset($category);

}
 ?>

<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>
<!-- Begin main content -->
  <!-- Begin main content -->
    <div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">Pull Events & Tickets From Tixstock</h5>
               </div>
               <div class="col-sm-4">
                  <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                    <a href="javascript:void(0);" action="action"
    onclick="window.history.go(-1); return false;"
 class="btn btn-primary mb-2 mt-3">Back</a>
                    <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
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
                              <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Add Event Tickets
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                All Tickets Sync
                              </a>
                            </li>
                        </ul>
                        <div class="tab-content">


                           <div class="tab-pane show active" id="home-b1">



                              <div class="team_info_details mt-3">
                                <h5 class="card-title">Event Info</h5>
                                <p>Fill the following Event information</p>
                              </div>
                              <div class="row column_modified">
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select API</label>
                                                 <select class="custom-select" id="api" name="api" required>
                                                   <option value="">Select API</option>
                                                   <?php foreach($apis as $api){ ?>
                                                   <option value="<?php echo $api->api_value;?>"><?php echo $api->api_name;?></option>
                                                    <?php } ?>
                                                 </select>
                                             </div> 
                                          </div>
                                       </div>
                              <div class="row" id="tixstock_pull_area" style="display: none;">
                                <div class="col-12">
                                  <div class="card">
                                     <form id="search-form" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>tixstockcms/updateFeedsEvents/true" data-action="<?php echo base_url();?>tixstockcms/updateEventsData/true">
                                      <div class="row column_modified">
                                          <div class="col-lg-4">
                  <div class="form-group">
                  <label for="example-select">Event Category <span class="text-danger">*</span></label>
                  <?php echo
                  '<select name="category_name" id="main_category" class="actionpayout roleuser custom-select" >
                  <option value="">-- please select --</option>';

                  for($i = 0; $i < count($dropdownlist); $i++){

                  echo
                  '<optgroup label="' . $dropdownlist[$i]['name'] . '"></label>';

                  getChildren($dropdownlist[$i]['children']);    
                  echo'</optgroup>';
                  }
                  echo
                  '</select>';?>
                  </div> 
                  </div>                                      
                                       
                                          <div class="col-lg-3">
                                             <div class="form-group">
                                                 <label for="example-select">Select Content Type <span class="text-danger">*</span></label>
                                                 <select class="custom-select" id="content_type">
                                                   <option value="team">Tournament,Team,Stadium</option>
                                                   <option value="events">Events & tickets</option>
                                                 </select>
                                             </div> 
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group">
                                                 <label for="example-select">Page Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="page" id="page" required value="1">
                                             </div> 
                                          </div>
                                       </div>

                                       <div class="row column_modified">
                                          <div class="tick_details">
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Search</button>
                                          </div>
                                       </div>
                                  </div> <!-- end card -->
                              </form>
                                </div><!-- end col -->
                              </div>
                              <!-- end row -->

                              <div class="row" id="oneclicket_pull_area" style="display: none;">
                                <div class="col-12">
                                  <div class="card">
                                     <form id="search-form-oneclicket" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>oneclicketapi/updateFeedsEvents/true" data-action="<?php echo base_url();?>oneclicketapi/updateEventsData/true">
                                      <div class="row column_modified">
                                     

              <div class="col-lg-4">
                  <div class="form-group">
                  <label for="example-select">Event Category <span class="text-danger">*</span></label>
                 <?php 
                                        
                                          echo
                  '<select name="category_name" class="actionpayout roleuser custom-select" >
                  <option value="">-- please select --</option>';

                  for($i = 0; $i < count($dropdownlist_oneclicket); $i++){

                  echo
                  '<optgroup label="' . $dropdownlist_oneclicket[$i]['category'] . '"></label>';

                  getChildren_oneclicket($dropdownlist_oneclicket[$i]['children']);    
                  echo'</optgroup>';
                  }
                  echo
                  '</select>';?>
                  </div> 
                  </div>                                  

                                        
                                           <div class="col-lg-3">
                                             <div class="form-group">
                                                 <label for="example-select">Select Content Type <span class="text-danger">*</span></label>
                                                 <select class="custom-select" id="oneclicket_content_type">
                                                   <option value="team">Tournament,Team,Stadium</option>
                                                   <option value="events">Events & tickets</option>
                                                 </select>
                                             </div> 
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group">
                                                 <label for="example-select">Page Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="oneclicket_page" id="oneclicket_page" required value="1">
                                             </div> 
                                          </div>                                   
                                       </div> <!-- end col -->
                                      

                                       <div class="row column_modified">
                                          <div class="tick_details">
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Search</button>
                                          </div>
                                       </div>
                                  </div> <!-- end card -->
                              </form>
                                </div><!-- end col -->
                              </div>
                              <!-- end row -->
                             

                                <div class="row" id="xs2event_pull_area" style="display: none;">
                                <div class="col-12">
                                  <div class="card">
                                     <form id="search-form-xs2event" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>xs2event/updateFeedsEvents/true" data-action="<?php echo base_url();?>xs2event/updateEventsData/true">
                                      <div class="row column_modified">
                                     

              <div class="col-lg-4">
                  <div class="form-group">
                  <label for="example-select">Event Category <span class="text-danger">*</span></label>
                  
                <!--   <select name="xs2event_category_name" id="xs2event_category_name" class="actionpayout roleuser custom-select" >
                  <option value="">-- please select --</option>
                   <?php for($i = 0; $i < count($dropdownlist_xs2event); $i++){ ?>
                   <option value="<?php echo trim($dropdownlist_xs2event[$i]->category);?>"><?php echo ucfirst($dropdownlist_xs2event[$i]->category);?></option>
                 <?php } ?>
                  </select> -->
                  

                  <?php 
                                        
                                          echo
                  '<select name="category_name" class="actionpayout roleuser custom-select" >
                  <option value="">-- please select --</option>';
                  //echo "<pre>";print_r($dropdownlist_xs2event);exit;
                  for($i = 0; $i < count($dropdownlist_xs2event); $i++){

                  echo
                  '<optgroup label="' . ucfirst($dropdownlist_xs2event[$i]['category']) . '"></label>';

                  getChildren_xs2event($dropdownlist_xs2event[$i]['children']);    
                  echo'</optgroup>';
                  }
                  echo
                  '</select>';?>
                  </div> 
                  </div> 

                                           <div class="col-lg-3">
                                             <div class="form-group">
                                                 <label for="example-select">Select Content Type <span class="text-danger">*</span></label>
                                                 <select class="custom-select" id="xs2event_content_type">
                                                   <option value="team">Tournament,Team,Stadium</option>
                                                   <option value="events">Events & tickets</option>
                                                 </select>
                                             </div> 
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group">
                                                 <label for="example-select">Page Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="xs2event_page" id="xs2event_page" required value="1">
                                             </div> 
                                          </div>                                   
                                       </div> <!-- end col -->
                                      

                                       <div class="row column_modified">
                                          <div class="tick_details">
                                             <button id="xs2event_search" type="submit" class="btn btn-success mb-2 ml-2 mt-3">Search</button>
                                          </div>
                                       </div>
                                  </div> <!-- end card -->
                              </form>
                                </div><!-- end col -->
                              </div>
                              <!-- end row -->
                              <div class="clearfix"></div>

                              <hr>

                              <form id="payout-form" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>tixstockcms/migrateevents" oneclicket-action="<?php echo base_url();?>oneclicketapi/migrateevents" xs2event-action="<?php echo base_url();?>xs2event/migrateevents">
                                <input type="hidden" name="action" id="action" value="pull">
                              <div class="" id="content_1">
                                    <div class="" id="payout_orders">
                                      
                                    </div>
                              </div>

                              <!-- end row -->
                              <div class="tick_details">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                    <a href="javascript:void(0);" action="action"
    onclick="window.history.go(-1); return false;"
 class="btn btn-primary mb-2 mt-3">Back</a>
                                    <button type="submit" class="btn btn-success mb-2 ml-2 mt-3 btn-action" data-action="pull">Save</button>
                                    <button type="submit" id="boxoffice_btn" class="btn btn-success mb-2 ml-2 mt-3 btn-action" data-action="save">Save to 1boxoffice</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                           </div>
                           <div class="tab-pane" id="profile-b1">
                              <div class="team_info_details mt-3 mb-2">
                                <h5 class="card-title">All Tickets Sync</h5>
                              </div>
                              <div class="section_all filter_new">
                                 <div class="row">
                                    <div class="col-md-1 nopadds">
                                       <div class="sort_by">
                                          <span>Sort By:</span>
                                       </div>
                                    </div>
                                    <div class="col-md-11">

                                       <div class="sort_filters">
                                          <ul>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle parent_category_btn" type="button" id="dropdownMenuButton"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Event Parent Category <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                         <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                         <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="parent_category_name">></label></div>
                                                      </div>
                                                         <div class="parent_check_box check_box">
                                                            <?php 
                                                            echo $this->data['parent_categories'];
                                                        ?>
                                                         </div>
                                                         <div class="reset_btn">
                                                            <div class="reset_txt"><button class="btn btn-info parent_category_reset">Reset</button></div>
                                                            <div class="reset_ok"><button class="btn btn-info parent_category_search">Search</button></div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle parent_child_btn" type="button" id="dropdownMenuButton"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Category <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                     <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                         <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="parent_child_category_name">></label></div>
                                                      </div>
                                                         <div class="parent_child_check_box">
                                                          
                                                      </div>
                                                       <div class="reset_btn">
                                                            <div class="reset_txt"><button class="btn btn-info parent_child_category_reset">Reset</button></div>
                                                            <div class="reset_ok"><button class="btn btn-info parent_child_category_search">Search</button></div>
                                                         </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle tournament_category_button" type="button" id="dropdownMenuButton"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Tournament Category <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                         <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                         <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="tournament_category_name">></label></div>
                                                      </div>
                                                       <div class="tournament_category_check_box">
                                                          
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info tournament_category_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info tournament_category_search">Search</button></div>
                                                      </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle tournament_button" type="button" id="dropdownMenuButton"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Tournament <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                         <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                         <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="tournament_name"></label></div>
                                                      </div>
                                                       <div class="tournament_check_box">
                                                          
                                                      </div>
                                                     <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info tournament_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info tournament_search">Search</button></div>
                                                      </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle teams_btn" type="button" id="dropdownMenuButton"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Team <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                         <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                         <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="teams_search"></label></div>
                                                      </div>
                                                         <div class="teams_check_box check_box">
                                                            <?php 
                                                            echo $this->data['teams'];
                                                        ?>
                                                         </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info teams_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info teams_search">Search</button></div>
                                                      </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                                <div class="btn-group">
                                                   <div class="dropdown">
                                                      <button class="btn btn-light dropdown-toggle date_search_filter" type="button" id="dropdownMenuButton"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Date <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <form class="px-3 py-2">
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                               <div class="form-group datemark">
                                                                  <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From">
                                                               </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <div class="form-group datemark_to">
                                                                  <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To">
                                                               </div>
                                                            </div>
                                                         </div>
                                                       </form>                                     
                                                         <div class="reset_btn">
                                                            <div class="reset_txt"><button class="btn btn-info date_reset">Reset</button></div>
                                                            <div class="reset_ok"><button class="btn btn-info date_search">Search</button></div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li class="sort_list">
                                               <a class="clear_all reset_txt" href="javascript:void(0)">Clear All</a>
                                             </li>
                                             <li class="sort_list">
                                                <a class="report_sts" href="javascript:void(0);">Search</a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="">
                                        <table style="width: 100% !important;" class="table  stad_lists table-hover table-nowrap mb-0 events_new-1" id="tickets-datatable-3">


                              <thead class="thead-light">
                                     
                                             <tr>
                                                <th>Number</th>
                                                <th>Event</th>
                                                <th>Tournament</th>
                                                <th>Stadium</th>
                                                <th>Date & Time</th>
                                                <th>Tickets</th>
                                                <th>Status</th>
                                                <th>Event Found</th>

                                             </tr>
                                          </thead>
                                          <tbody>
                                             
                                          </tbody>
                                    </table>
                                    
                                    
                              </div>
                              
                              <div class="tick_details">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                          <a href="javascript:void(0);" action="action"
                                              onclick="window.history.go(-1); return false;"
                                           class="btn btn-primary mb-2 mt-3">Back</a>
                                          <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2 mt-3">Save</a>
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
      <!-- main content End -->
<?php $this->load->view(THEME . 'common/footer'); ?>
               <script type="text/javascript">
                     var loadFile_receipt = function(event) {
                   
                     document.getElementById('preview').style.display = 'block';
                    var output = document.getElementById('preview');
                    output.href = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                    URL.revokeObjectURL(output.href) // free memory
                    }
                    };

                    $(document).ready(function(){


      $('.btn-action').on('click', function (e) {  
        var action = $(this).data('action');
        $('#action').val(action);
      });

      $('#api').on('change', function (e) {  
         var api = $(this).val();
         if(api == 'tixstock'){
            $('#oneclicket_pull_area').hide();
            $('#xs2event_pull_area').hide();
            $('#tixstock_pull_area').show();

           // $('#boxoffice_btn').show();
         }
         else if(api == 'oneclicket'){
            $('#oneclicket_pull_area').show();
            $('#xs2event_pull_area').hide();
            $('#tixstock_pull_area').hide();
          //  $('#boxoffice_btn').hide();
         }
         else if(api == 'xs2event'){
            $('#oneclicket_pull_area').hide();
            $('#tixstock_pull_area').hide();
            $('#xs2event_pull_area').show();
          //  $('#boxoffice_btn').hide();
         }
      });   

                        if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0 });

$('.parent_category_search').on('click', function (e) {  
         $('.parent_category_btn').addClass("filter_active");  
             

         var checkedIds = [];
               $(".parent_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds; // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_category_name',
        type: "POST",
        data: { parent_category_id: parent_category_id,'flag' : 'parent_category' }, // Pass the search text to the PHP script
        success: function(response) {
          $(".parent_child_check_box").html(response); // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });   

            });


$('.parent_child_category_search').on('click', function (e) {  
         $('.parent_child_btn').addClass("filter_active");  
             

         var checkedIds = [];
               $(".parent_child_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds; // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_category_name',
        type: "POST",
        data: { parent_category_id: parent_category_id ,'flag' : 'child_category'}, // Pass the search text to the PHP script
        success: function(response) {
          $(".tournament_category_check_box").html(response); // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });   

            });


$('.tournament_category_search').on('click', function (e) {  
         $('.tournament_category_button').addClass("filter_active");  
             

         var checkedIds = [];
               $(".tournament_category_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds; // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_category_name',
        type: "POST",
        data: { parent_category_id: parent_category_id,'flag' : 'parent_tournament' }, // Pass the search text to the PHP script
        success: function(response) {
          $(".tournament_check_box").html(response); // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });   

            });


$('.tournament_search').on('click', function (e) {  
         $('.tournament_button').addClass("filter_active");  
             

         var checkedIds = [];
               $(".tournament_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds; // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_category_name',
        type: "POST",
        data: { parent_category_id: parent_category_id,'flag' : 'child_tournament' }, // Pass the search text to the PHP script
        success: function(response) { // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });   

            });

$('.tournament_search').on('click', function (e) {  
         $('.tournament_button').addClass("filter_active");  
               
         var checkedIds = [];
               $(".tournament_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds; // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_category_name',
        type: "POST",
        data: { parent_category_id: parent_category_id }, // Pass the search text to the PHP script
        success: function(response) { // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });   

            });

  // Get the datepicker input element
       const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({

           dateFormat: 'dd-mm-yy' ,
           changeMonth: true,
           changeYear: true,
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd-mm-yy' ,
           changeMonth: true,
           changeYear: true,}
      );



      $('.date_search').click(function (event) {

         $('.date_search_filter').addClass("filter_active");

         const fromDate = document.getElementById('MyTextbox3').value;
         const toDate = document.getElementById('MyTextbox2').value;
         console.log('Chosen date:', toDate);

         // Validate the from date
         if (!fromDate) {
            alert('From date cannot be empty!');
            return;
         }

         // Validate the to date
         if (!toDate) {
            alert('To date cannot be empty!');
            return;
         }

         if (new Date(toDate) <= new Date(fromDate)) {
            alert('To date must be greater than From date!');
            return;
         }

         Dtable.draw();

      });


   $('.teams_search').on('click', function (e) {  
         $('.teams_btn').addClass("filter_active");  
                Dtable.draw();
             });
   $("#parent_category_name").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox


      $.ajax({
        url: base_url + 'game/get_category_search',
        type: "POST",
        data: { search_text: searchText,'flag' : 'parent_category' }, // Pass the search text to the PHP script
        success: function(response) {
          $(".parent_check_box").html(response); // Bind the response data to the checkbox container
         
        }
      });     
    });

$("#parent_child_category_name").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox

        var checkedIds = [];
               $(".parent_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds;

      $.ajax({
        url: base_url + 'game/get_category_search',
        type: "POST",
        data: { search_text: searchText,'flag' : 'child_category','parent_category_id' : parent_category_id }, // Pass the search text to the PHP script
        success: function(response) {
          $(".parent_child_check_box").html(response); // Bind the response data to the checkbox container
         
        }
      });     
    });


$("#tournament_category_name").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox

        var checkedIds = [];
               $(".parent_child_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds;

      $.ajax({
        url: base_url + 'game/get_category_search',
        type: "POST",
        data: { search_text: searchText,'flag' : 'parent_tournament','parent_category_id' : parent_category_id }, // Pass the search text to the PHP script
        success: function(response) {
          $(".tournament_category_check_box").html(response); // Bind the response data to the checkbox container
          
        }
      });     
    });

$("#tournament_name").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox

        var checkedIds = [];
               $(".tournament_category_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

                 var parent_category_id = checkedIds;

      $.ajax({
        url: base_url + 'game/get_category_search',
        type: "POST",
        data: { search_text: searchText,'flag' : 'child_tournament','parent_category_id' : parent_category_id }, // Pass the search text to the PHP script
        success: function(response) {
          $(".tournament_check_box").html(response); // Bind the response data to the checkbox container
          
        }
      });     
    });

$("#teams_search").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox

        var checkedIds = [];
             

      $.ajax({
        url: base_url + 'game/get_teams_name',
        type: "POST",
        data: { search_text: searchText,}, // Pass the search text to the PHP script
        success: function(response) {
          $(".teams_check_box").html(response); // Bind the response data to the checkbox container
          
        }
      });     
    })

var overlay = $('#overlay');

var Dtable = $('#tickets-datatable-3').DataTable({
         'info': false,
         scrollX: !0,
       //  'processing': false,
         'serverSide': true,
         'serverMethod': 'post',
         "pageLength" : 50,
         "ajax": {
            url: base_url + 'game/get_event_pulling_api',
            data: function (d) {
                var fromDate = document.getElementById('MyTextbox3').value;
                var toDate = document.getElementById('MyTextbox2').value;


               var parent_category = [];
               $(".parent_category").each(function() {
                 if ($(this).prop('checked')==true){ 
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  parent_category.push(newID);
               }
               });

               var child_category = [];
               $(".child_category").each(function() {
                    if ($(this).prop('checked')==true){ 
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  child_category.push(newID);
               }
               });

               var parent_tournament = [];
               $(".parent_tournament").each(function() {
                   if ($(this).prop('checked')==true){ 
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  parent_tournament.push(newID);
               }
               });

               var child_tournament = [];
               $(".child_tournament").each(function() {
                   if ($(this).prop('checked')==true){ 
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  child_tournament.push(newID);
               }
               });
               var teams = [];
               $(".teams").each(function() {
                   if ($(this).prop('checked')==true){ 
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  teams.push(newID);
               }
               });
               d.parent_category = parent_category;
               d.child_category = child_category;
               d.parent_tournament = parent_tournament;
               d.child_tournament = child_tournament;
               d.teams = teams;
               d.event_start_date = fromDate;
               d.event_end_date = toDate;
            },
            beforeSend: function () {
            overlay.show();
         },
         complete: function () {
            overlay.hide();
         },

         },
        
         "targets": 'no-sort',
         "bSort": false,
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
         },
         drawCallback: function () {

            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
         'columns': [
            { data: 'sl' },
            { data: 'event_name' },
            { data: 'tournament' },
            { data: 'stadium' },
            { data: 'match_date_time' },
            { data: 'tickets' },
            { data: 'merge_status' },
            { data: 'match_found' }
         ],

      });


    $('#payout-form').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  

    var formData = new FormData(myform);
    formData.append('api_id', $("#api").val()); 
    var api = $('#api').val();
    if(api == "tixstock"){
      var action = $(form).attr('action');
    }
    else if(api == "oneclicket"){
      var action = $(form).attr('oneclicket-action');
    }
    else if(api == "xs2event"){
      var action = $(form).attr('xs2event-action');
    }
    
    $.ajax({
      type: "POST",
     // enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        // setting a timeout
        $("#overlay").show();
        },
      success: function(data) {
          $("#overlay").hide();
        if(data.status == 1) {
         swal('Success !', data.msg, 'success');
        }else if(data.status == 0) {
           swal('Failed !', data.msg, 'error');
          
        }
      }
    })
    return false;
  }
});


$('#search-form').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];

    var parent_label=$('#main_category :selected').parent().attr('label');
    //is-loading no-click
   // branch-form-btn
    var formData = new FormData(myform);
    formData.append('sport_type', parent_label); 
    formData.append('parent_category', $("#parent_category").val()); 
    formData.append('category', $("#category").val()); 
    formData.append('tournament', $("#tournament").val()); 
    formData.append('tournaments', $("#tournaments").val()); 

    $('#search').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');

    var tournament   = $("#tournament").val();
    var page         = $("#page").val();

     var dataString = $('#'+$(form).attr('id')).serialize();
     
     var content_type         = $("#content_type").val();
     
    if(content_type == "team"){
        var action = $(form).attr('data-action');
    }
    else{

    var action = $(form).attr('action');
    }
    

    $.ajax({
      type: "POST",
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        // setting a timeout
        $("#overlay").show();
        },
      success: function(data) { 
        $("#overlay").hide();
               $("#content_1").addClass("section_left_scroll");
                  $("#content_1").mCustomScrollbar({
          scrollButtons:{
            enable:true
          }
        });
        $('#search').removeClass("is-loading no-click");

        $('.has-loader').removeClass('has-loader-active');

        if(data.flag == "team" && data.status == 1) {
            $('#page').val(data.next);
         swal('Success !', data.msg, 'success');
        }else if(data.flag == "team" && data.status == 0) {
           swal('Failed !', data.msg, 'error');
          
        }

             if(data.flag == "event" && data.status == 1) {
                             $('#page').val(data.next);
                            $('#payout_orders').html(data.matches);
            }
            else if(data.flag == "event" && data.status == 0) {
                swal('Failed !', data.msg, 'error');
            }
      }
    })
    return false;
  }
});


$('#search-form-oneclicket').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
    var formData = new FormData(myform);
     formData.append('parent_category', $("#oneclicket_parent_category").val()); 
     formData.append('tournaments', $("#oneclicket_tournaments").val()); 
     formData.append('page', $("#oneclicket_page").val()); 

    $('#search').addClass("is-loading no-click");

     var dataString = $('#'+$(form).attr('id')).serialize();
     
     var content_type         = $("#oneclicket_content_type").val();
     
    if(content_type == "team"){
        var action = $(form).attr('data-action');
    }
    else{

    var action = $(form).attr('action');
    }

    $.ajax({
      type: "POST",
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        // setting a timeout
        $("#overlay").show();
        },
      success: function(data) { 
        $("#overlay").hide();
               $("#content_1").addClass("section_left_scroll");
                  $("#content_1").mCustomScrollbar({
          scrollButtons:{
            enable:true
          }
        });
        $('#search').removeClass("is-loading no-click");

        $('.has-loader').removeClass('has-loader-active');

        if(data.flag == "team" && data.status == 1) {
            $('#oneclicket_page').val(data.next);
         swal('Success !', data.msg, 'success');
        }else if(data.flag == "team" && data.status == 0) {
           swal('Failed !', data.msg, 'error');
          
        }

             if(data.flag == "event" && data.status == 1) {
                             $('#oneclicket_page').val(data.next);
                            $('#payout_orders').html(data.matches);
            }
            else if(data.flag == "event" && data.status == 0) {
                swal('Failed !', data.msg, 'error');
            }
      }
    })
    return false;
  }
});
        
$('#search-form-xs2event').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
    var formData = new FormData(myform);
     formData.append('category', $("#xs2event_category_name").val()); 
     formData.append('page', $("#xs2event_page").val()); 

    $('#xs2event_search').addClass("is-loading no-click");

     var dataString = $('#'+$(form).attr('id')).serialize();
     
     var content_type         = $("#xs2event_content_type").val();
     
    if(content_type == "team"){
        var action = $(form).attr('data-action');
    }
    else{

    var action = $(form).attr('action');
    }

    $.ajax({
      type: "POST",
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        // setting a timeout
        $("#overlay").show();
        },
      success: function(data) { 
        $("#overlay").hide();
               $("#content_1").addClass("section_left_scroll");
                  $("#content_1").mCustomScrollbar({
          scrollButtons:{
            enable:true
          }
        });
        $('#xs2event_search').removeClass("is-loading no-click");

        $('.has-loader').removeClass('has-loader-active');

        if(data.flag == "team" && data.status == 1) {
            $('#xs2event_page').val(data.next);
         swal('Success !', data.msg, 'success');
        }else if(data.flag == "team" && data.status == 0) {
           swal('Failed !', data.msg, 'error');
          
        }

             if(data.flag == "event" && data.status == 1) {
                             $('#xs2event_page').val(data.next);
                            $('#payout_orders').html(data.matches);
            }
            else if(data.flag == "event" && data.status == 0) {
                swal('Failed !', data.msg, 'error');
            }
      }
    })
    return false;
  }
});
$('body').on('change', '#oneclicket_parent_category', function() {
    var parent_category_id = $(this).val();
     var action = "<?php echo base_url();?>game/get_oneclicket_category";
    $.ajax({
      type: "POST",
      url: action,
      data: {'parent_category_id' : parent_category_id,'flag' : 'parent'},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
              $("#oneclicket_tournaments").html('<option value="">Choose Tournaments</option>');
             $.each(data.categories,function(key, value)
                {
                   
                    $("#oneclicket_tournaments").append('<option value=' + value.category_id + '>' + value.category + '</option>');
                });

        }
      }
    })

});

$('body').on('change', '#parent_category', function() {
    var parent_category_id = $(this).val();
     var action = "<?php echo base_url();?>game/get_tixstock_category";
    $.ajax({
      type: "POST",
      url: action,
      data: {'parent_category_id' : parent_category_id,'flag' : 'parent'},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
              $("#category").html('<option value="">Choose Category</option>');
             $.each(data.categories,function(key, value)
                {
                   
                    $("#category").append('<option value=' + value.category_id + '>' + value.category + '</option>');
                });

        }
      }
    })

});


$('body').on('change', '#category', function() {
    var parent_category_id = $(this).val();
     var action = "<?php echo base_url();?>game/get_tixstock_category";
    $.ajax({
      type: "POST",
      url: action,
      data: {'parent_category_id' : parent_category_id,'flag' : 'parentchild'},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
              $("#tournament").html('<option value="">Choose Tournaments</option>');
             $.each(data.categories,function(key, value)
                {
                 
                    $("#tournament").append("<option value='" + value.category_id + "'>" + value.category + "</option>");
                });

        }
      }
    })

});


$('body').on('change', '#tournament', function() {
    var parent_category_id = $(this).val();
     var action = "<?php echo base_url();?>game/get_tixstock_category";
    $.ajax({
      type: "POST",
      url: action,
      data: {'parent_category_id' : parent_category_id,'flag' : 'parenttournament'},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
              $("#tournaments").html('<option value="">Choose Tournaments</option>');
             $.each(data.categories,function(key, value)
                {
                 
                    $("#tournaments").append("<option value='" + value.category + "'>" + value.category + "</option>");
                });

        }
      }
    })

});

// ajax call to show based on seller or api partner

$("input[name='sellerTypes']").click(function(){

    let partnerType = $(this).val();
    let action = "<?php echo base_url();?>accounts/partnerType";
    // alert(partnerType)
    $.ajax({
      type: "POST",
      url: action,
      data: {'partnerType' : partnerType},
      cache: false,
      dataType: "json",

      success: function(response) {
        var len = response.length;
        console.log(response)
        for( var i = 0; i<len; i++){
            var id = response[i]['admin_id'];
            var name = response[i]['company_name']
            $("#seller").empty()
        // alert(response[i]['admin_id'])
        $("#seller").append("<option value='"+id+"'>"+name+"</option>");

        }

      }
    })
});



   $('body').on('change', '.parent_category', function () {

         var checkedCount = $('input[name="parent_category[]"]:checked').length;
      
         if(checkedCount>0) 
         {
            $('.parent_category_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.parent_category_btn').text("Event parent Category");  
            
         });  

   $('body').on('change', '.child_category', function () {
         var checkedCount = $('input[name="child_category[]"]:checked').length;
      
         if(checkedCount>0) 
         {
            $('.parent_child_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.parent_child_btn').text("Category");  
            
         });  
 $('body').on('change', '.parent_tournament', function () {
         var checkedCount = $('input[name="parent_tournament[]"]:checked').length;
      
         if(checkedCount>0) 
         {
            $('.tournament_category_button').text(checkedCount+" Selected");
         } 
         else 
            $('.tournament_category_button').text("Tournament Category");  
            
         });  

$('body').on('change', '.child_tournament', function () {
         var checkedCount = $('input[name="child_tournament[]"]:checked').length;
      
         if(checkedCount>0) 
         {
            $('.tournament_button').text(checkedCount+" Selected");
         } 
         else 
            $('.tournament_button').text("Tournament");  
            
         });  
$('body').on('change', '.child_tournament', function () {
         var checkedCount = $('input[name="child_tournament[]"]:checked').length;
      
         if(checkedCount>0) 
         {
            $('.tournament_button').text(checkedCount+" Selected");
         } 
         else 
            $('.tournament_button').text("Tournament");  
            
         });  


$('body').on('change', '.teams', function () {
         var checkedCount = $('input[name="teams[]"]:checked').length;
      
         if(checkedCount>0) 
         {
            $('.teams_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.teams_btn').text("Team");  
            
         });  

$('.parent_category_reset').click(function () {
      $('.parent_category_btn').removeClass("filter_active");
         $('.parent_category_btn').text("Event Parent Category");  
         $("#parent_category_name").val('');
         $("#parent_category_name").trigger('keyup');
          $('input.parent_category:checkbox:checked').each(function () {
     $(this).prop('checked', false);

});
Dtable.draw();
    });

$('.parent_child_category_reset').click(function () {
   $(".parent_child_check_box").html('');
      $('.parent_child_btn').removeClass("filter_active");
         $('.parent_child_btn').text("Category");  
         $("#parent_child_category_name").val('');
         //$("#parent_child_category_name").trigger('keyup');
          $('input.child_category:checkbox:checked').each(function () {
     $(this).prop('checked', false);
     

});
          
Dtable.draw();
    });

$('.tournament_category_reset').click(function () {
      $('.tournament_category_button').removeClass("filter_active");
         $('.tournament_category_button').text("Tournament Category");  
         $("#tournament_category_name").val('');
         //$("#tournament_category_name").trigger('keyup');
          $('input.parent_tournament:checkbox:checked').each(function () {
     $(this).prop('checked', false);
    

});
          $(".tournament_category_check_box").html('');
Dtable.draw();
    });

$('.tournament_reset').click(function () {
      $('.tournament_button').removeClass("filter_active");
         $('.tournament_button').text("Tournament");  
         $("#tournament_name").val('');
         //$("#tournament_name").trigger('keyup');
          $('input.child_tournament:checkbox:checked').each(function () {
     $(this).prop('checked', false);

});
          $(".tournament_check_box").html('');
Dtable.draw();
    });

$('.teams_reset').click(function () {
      $('.teams_btn').removeClass("filter_active");
         $('.teams_btn').text("Team");  
         $("#teams_search").val('');
         $("#teams_search").trigger('keyup');
          $('input.teams:checkbox:checked').each(function () {
     $(this).prop('checked', false);


});
Dtable.draw();
    });


$('.report_sts').click(function () {
   Dtable.draw();
 });
$('.date_reset').click(function () {
    $('.date_search_filter').removeClass("filter_active");
    $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); 
         Dtable.draw();
 });
 $('.clear_all').click(function () {

$('.date_reset').trigger('click');
$('.parent_category_reset').trigger('click');
$('.parent_child_category_reset').trigger('click');
$('.tournament_category_reset').trigger('click');
$('.tournament_reset').trigger('click');
$('.teams_reset').trigger('click');
         //Dtable.draw();

      });

$('body').on('click','.nav-link', function (event) {

         if( $(this).attr("href") == "#profile-b1"){

            Dtable.draw();
         }

    } );


});




                    
                </script>