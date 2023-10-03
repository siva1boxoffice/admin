<style>
   .ticket_sold_checkbox {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.ticket_sold_checkbox, {
    max-height: 250px;
    overflow-y: auto;
}
.venue_check_box {
   padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
    max-height: 250px;
    overflow-y: auto;
}
.tournament_check_box,.check_box_category
{
   padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
    max-height: 250px;
    overflow-y: auto;
}
</style>
<?php 
    $tournments   = $this->General_Model->get_tournments()->result();
    $stadiums   = $this->General_Model->get_stadium()->result();
     $match_lists   = $this->General_Model->get_match_list();
  
    $only = @$_GET['only'] ;
    $only_url =   @$_GET['only'] ? "?only=".@$_GET['only']  : "" ;
?>
<?php  $this->load->view(THEME.'common/header'); ?>


<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>
    
    <style>
        .check_box{
            max-height: 250px;
            overflow-y: auto;
        }
    </style>
    <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-4 col-xl-4">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold">Events</h3>
                        </div>
                     </div>
                     <div class="col-sm-8 col-xl-8 text-sm-right mt-2 mt-sm-0">
                        <div class="float-sm-right mt-3 mt-sm-0 team_lists_bttn">
                           <a href="javascript:void(0);"  class="active_event btn btn-primary mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Top Game</a> 
                           <a href="javascript:void(0);"  class="active_event btn btn-success mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Active</a> 
                           <a href="javascript:void(0);"  class="active_event btn btn-danger mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Inactive</a>
                           <a href="<?php echo base_url();?>event/matches/add_match"  class="btn btn-success mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Add Event</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- page content -->

            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">

              <!-- <div class="card">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-sm-9 col-md-4">
                              
                           </div>
                           <div class="col-sm-3 col-md-8">
                              <div class="float-sm-right mt-3 mt-sm-0">                               
                              
                              <div class="float-sm-right mt-3 mt-sm-0">
                                 <a href="javascript:void(0);"  class="active_event btn btn-primary mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Top Game</a> 
                                 <a href="javascript:void(0);"  class="active_event btn btn-success mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Active</a> 
                                 <a href="javascript:void(0);"  class="active_event btn btn-danger mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Inactive</a>
                                 <a href="<?php echo base_url();?>event/matches/add_match"  class="btn btn-success mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Add Event</a>
                              </div>
                              </div>
                           </div>
                        </div>
                     </div>
              </div> -->

                  
                  <div class="card">
                     <div class="card-body">

                        <div class="section_all filter_new">
                     <div class="">
                        <!-- cta -->
                        <div class="row">
                           <div class="col-md-1 nopadds">
                              <div class="sort_by">
                                 <span>Sort By:</span>
                              </div>
                           </div>
                           <div class="col-md-11">
                              <div class="sort_filters">
                                <input type="hidden" class="flag" name="flag" id="flag" value="<?php echo $this->uri->segment(3);?>">
                                 <input type="hidden" class="only" name="only" id="only" value="<?php echo @$_GET['only'];?>">
                                 <ul>
                                    <!-- <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Event Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                             </div>
                                               
                                                <div class="check_box">
                                                     <?php //if($match_lists){
                                                       // foreach ($match_lists as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input match_id" id="customCheck<?php //echo $key;?>" name="match_id[]" value="<?php// echo $value->m_id;?>">
                                                    <label class="custom-control-label" for="customCheck<?php //echo $key;?>"><?php //echo $value->match_name;?></label>
                                                  </div>
                                              <?php //} }  ?>
                                                
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt match_id_rest">Reset</div>
                                                   <div class="reset_ok search_ok"><button>Ok</button></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li> -->

                                    <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle event_name_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" data-name="event_name" aria-haspopup="true" aria-expanded="false">
                                                   Event Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" id="event_name" name="event_name" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info match_id_rest">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle venue_search_filter" data-name="venue" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Venue <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input id='venue_details' type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                             </div>
                                                <div class="venue_check_box">

                                                    <?php if($stadiums){
                                                        foreach ($stadiums as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input stadium_id" id="stadium<?php echo $key;?>" name="stadium_id[]" value="<?php echo $value->s_id;?>">
                                                    <label class="custom-control-label" for="stadium<?php echo $key;?>"><?php echo $value->stadium_name;?></label>
                                                  </div>
                                              <?php } }?>
                                                  
                                                </div>
                                                <!-- <div class="reset_btn">
                                                   <div class="reset_txt stadium_id_rest">Reset</div>
                                                   <div class="reset_ok search_ok"><button>Ok</button></div>
                                                </div> -->

                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info venue_filter">Search</button></div>
                                                      </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>

                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle category_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Event Category <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box_category">                                               <?php if($gcategory){
                                                        foreach ($gcategory as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input category" id="category_id<?php echo $key;?>" name="category[]" value="<?php echo $value->id;?>">
                                                    <label class="custom-control-label" for="category_id<?php echo $key;?>"><?php echo $value->category_name;?></label>
                                                  </div>
                                              <?php } }  ?>                                                     

                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info category_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info category_search">Search</button></div>
                                                      </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <!-- <li class="sort_list">Event Date</li>
                                    <li class="sort_list">
                                       <div class="form-group datemark">
                                          <input class="form-control from_date" id="from_date" type="text" name="from_date" placeholder="From">
                                       </div>
                                    </li>
                                    <li class="sort_list">
                                       <div class="form-group datemark_to">
                                          <input class="form-control to_date" id="to_date" type="text" name="to_date" placeholder="To">
                                       </div>
                                    </li> -->

                                    <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle date_search_filter"  data-name="date" type="button" id="dropdownMenuButtondate"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Event Date <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom datepicker-dropdown" aria-labelledby="dropdownMenuButtondate">
                                                     
                                                   <form class="px-3 py-2">
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="form-group datemark">
                                                               <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From" autocomplete="off">
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <div class="form-group datemark_to">
                                                               <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To" autocomplete="off">
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </form>
                                                     
                                                   <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info date_search">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle tournament_search_filter" data-name="tournament" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Tournaments <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='tournament_search_box'></label></div>
                                             </div>
                                                <!-- <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                <a class="dropdown-item" href="#">Super Lig</a>
                                                <a class="dropdown-item" href="#">Test Tournament English2</a> -->
                                                <div class="tournament_check_box">
                                                     <?php if($tournments){
                                                        foreach ($tournments as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input tournament_id" id="tournament_id<?php echo $key;?>" name="tournament[]" value="<?php echo $value->t_id;?>">
                                                    <label class="custom-control-label" for="tournament_id<?php echo $key;?>"><?php echo $value->tournament_name;?></label>
                                                  </div>
                                              <?php } }  ?>


                                                </div>

                                                 <!-- <div class="reset_btn">
                                                   <div class="reset_txt match_id_rest">Reset</div>
                                                   <div class="reset_ok search_ok"><button>Ok</button></div>
                                                </div> -->

                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info tournament_search">Search</button></div>
                                                </div>                                               

                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle status_search_filter" data-name="status" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Status <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status1" name="status[]" value="1">
                                                    <label class="custom-control-label" for="status1">Active</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status0" name="status[]" value="0">
                                                    <label class="custom-control-label" for="status0">InActive</label>
                                                  </div>


                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status4" name="status[]" value="4">
                                                    <label class="custom-control-label" for="status4">TBC</label>
                                                  </div>


                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status2" name="status[]" value="2">
                                                    <label class="custom-control-label" for="status2">Expired</label>
                                                  </div>
                                             


                                                </div>

                                                 <!-- <div class="reset_btn">
                                                   <div class="reset_txt match_id_rest">Reset</div>
                                                   <div class="reset_ok search_ok"><button>Ok</button></div>
                                                </div> -->

                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info status_search">Search</button></div>
                                                      </div>
                                                
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <!-- <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Ticket Sold <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                <a class="dropdown-item" href="#">Super Lig</a>
                                                <a class="dropdown-item" href="#">Test Tournament English2</a>
                                             </div>
                                          </div>
                                       </div>
                                    </li> -->
                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle ticket_sold_btn" data-name="ticket_sold" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Ticket Sold <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="ticket_sold_checkbox">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ticket_sold" id="ticket_sold1" name="ticket_sold[]" value="1">
                                                    <label class="custom-control-label" for="ticket_sold1">Yes</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ticket_sold" id="ticket_sold0" name="ticket_sold[]" value="0">
                                                    <label class="custom-control-label" for="ticket_sold0">No</label>
                                                  </div>
                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info ticket_search_ok">Search</button></div>
                                                </div>                                                
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="sort_list">
                                       <a class="clear_all" href="javascript:void(0)">Clear All</a>
                                    </li>
                                    <li class="sort_list">
                                       <!-- <a class="report_sts" href="">Reports</a> -->
                                       <a href=""class="button h-button is-primary download_orders report_sts">Reports</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                           <table style="width: 100% !important;" class="table  table-hover table-nowrap mb-0 events_new-1" id="view_project_list">


                              <thead class="thead-light">
                                 <tr>
                                 <th tabindex="0" class="dt-checkboxes-cell" style=""><div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" id="check-all"><label class="form-check-label">&nbsp;</label></div></th>
                                    <th class="before_none">Event Name</th>
                                    <th class="before_none">Event Category</th>
                                    <th class="before_none">Venue</th>
                                    <th class="before_none">Event Date</th>
                                    <th class="before_none">Tournament</th>                                    
                                    <th class="before_none">Status</th>
                                    <th class="before_none">Top Games</th>
                                    <th class="before_none">Number Of <br>Ticket Listed</th>
                                    <th class="before_none">Number Of <br>API Tickets</th>
                                    <th class="before_none">Tickets Sold</th>
                                    <th class="before_none">Seo Status</th>
                                    <th class="before_none">Seo Preview</th>
                                    <th class="before_none">Source Type</th>
                                    <th class="before_none">Actions</th>
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
<?php $this->load->view(THEME.'common/footer');?>

 

   <script type="text/javascript">

//     $('#view_project_list').dataTable( {
//           "ajax": {
//             "url": "<?php echo base_url('') ;?>",
//             "data": function ( d ) {
//                 d.extra_search = $('#extra').val();
//             }
//           }
// } );




     $(document).ready(function(){


      $('.report_sts').click(function(event) {
    event.preventDefault();

    var baseUrl = '<?php echo base_url(); ?>';
    var eventStartDate = encodeURIComponent($('input[name="MyTextbox"]').val());
    var eventEndDate = encodeURIComponent($('input[name="MyTextbox1"]').val());
    var event_name = encodeURIComponent($('input[name="event_name"]').val() || '');
   //  var users = encodeURIComponent($('input[name="users"]').val() || '');
   //  var tournaments = encodeURIComponent($('input[name="tournaments"]').val() || '');
   //  var matchId = encodeURIComponent($('input[name="match_id"]').val() || '');
   //  var nominee = encodeURIComponent($('input[name="nominee"]').val() || '');
   var stadiumIds = [];
   var tournamentIds = [];
   var status= [];
   $('.stadium_id:checked').each(function() {
      stadiumIds.push(encodeURIComponent($(this).val()));
    });

    $('.tournament_id:checked').each(function() {
      tournamentIds.push(encodeURIComponent($(this).val()));
    }); 
    
    $('.status:checked').each(function() {
      status.push(encodeURIComponent($(this).val()));
    }); 

    //console.log(stadiumIds);

    var url = baseUrl + 'event/event_reports?' + 'event_start_date=' + eventStartDate + '&event_end_date=' + eventEndDate + '&event_name=' +event_name + '&stadium_ids=' + stadiumIds.join(',') + '&tournament_ids=' + tournamentIds.join(',')+ '&status=' + status.join(',');
    window.location.href = url;
  });

      $("body").on('click','.ticket_sold_checkbox',function(e){
            e.stopPropagation();
         });

      $('.active_event').click(function() {
       var status=$(this).html();
    // Find all the checkboxes that are checked
    var checkedCheckboxes = $('.dt-checkboxes:checked');

    // Get the data-order-id value of each checked checkbox
    var orderIds = [];
    checkedCheckboxes.each(function() {
      var orderId = $(this).data('org-order-id');
      orderIds.push(orderId);
    });

    // Make an AJAX request to process the data
   if(orderIds=="")
   {
      swal('Error!', "Choose any one of the checkbox.", 'error');
      return;
   }
      $.ajax({
        url: base_url + 'event/change_match_info_status',
        type: "POST",
        data: { orderIds: orderIds , status:status}, // Pass the search text to the PHP script
        success: function(response) {
                      if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
								setTimeout(window.location.reload(),900);
        }
      }); 
  });

      $("#check-all").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

  // Add an onchange event to the checkbox
  $('#view_project_list').on('change', 'input[type="checkbox"]', function() {

  var allChecked = true;
    $('table tbody input[type="checkbox"]').each(function() {
      if(!$(this).is(":checked")) {
        allChecked = false;
      }
    });
    $("#check-all").prop('checked', allChecked);

  });
  var overlay = $('#overlay');
       var Dtable =  $('#view_project_list').DataTable(
{
                "language": {
                    paginate:{
                        previous:"<i class='bx bx-chevron-left'>",
                        next:"<i class='bx bx-chevron-right'>"
                    }
                },
                drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
        },
        "ordering": false,
         'processing': true,
          'serverSide': true,
          'scrollX': !0,
          'serverMethod': 'post',
          "targets": 'no-sort',
          "bSort": false,
          "pageLength" : 50,
         //  'info': false,
          'ajax': {
             'url':'<?php echo base_url('ajax/matches') ;?>',
              data: function (d) {
                var match_name = $(".match_name").val();
                var stadium = $(".stadium").val();


                     var match_ids = '';
                     $('.match_id').each(function(i,e) {
                        if ($(e).is(':checked')) {
                              var comma = match_ids.length===0?'':',';
                              match_ids += (comma+e.value);
                        }
                        });

                        var ticket_sold = '';
                     $('.ticket_sold').each(function(i,e) {
                        if ($(e).is(':checked')) {
                              var comma = ticket_sold.length===0?'':',';
                              ticket_sold += (comma+e.value);
                        }
                        });


                     var stadium_ids = '';
                     $('.stadium_id').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = stadium_ids.length===0?'':',';
                                 stadium_ids += (comma+e.value);
                        }
                     });

                     var tournament_ids= '';
                     $('.tournament_id').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = tournament_ids.length===0?'':',';
                                 tournament_ids += (comma+e.value);
                        }
                     });


                     var statuss= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = statuss.length===0?'':',';

                              //   if(e.value == 0 ) e.value = 2
                                 statuss += (comma+e.value);
                        }
                     }
                     
                     );


                     var category= '';
                     $('.category').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = category.length===0?'':',';
                                 category += (comma+e.value);
                        }
                     });

              //  d.match_ids = match_ids;
              var event_name = $("#event_name").val();

              var fromDate = document.getElementById('MyTextbox3').value;
               var toDate = document.getElementById('MyTextbox2').value;


                d.event_name = event_name;
                d.category = category;
                d.stadium_ids = stadium_ids;
                d.tournament_ids = tournament_ids;
                d.statuss = statuss;
                d.from_date = $(".from_date").val();
                d.to_date =  $(".to_date").val();
                d.flag =  $("#flag").val();
                d.only =  $("#only").val();
                d.event_start_date = fromDate;
               d.event_end_date = toDate;
               d.ticket_sold=ticket_sold;
                },
                
          beforeSend: function() {
      // Show the overlay before the AJAX call
    
      overlay.show();
    },

    complete: function() {
      // Hide the overlay after the AJAX call is complete (regardless of success or error)
      overlay.hide();
      
    }
          },
          'columns': [
             { data: 'checkbox' },
             { data: 'match_name' },
             { data: 'event_category' },
             { data: 'venue' },
             { data: 'event_date' },
             { data: 'tournament' },
             { data: 'status' },
             { data: 'top_game' },
             { data: 'no_of_ticket' },
             { data: 'no_of_api' },
             { data: 'ticket_sold' },
             { data: 'seo_status' },
             { data: 'seo_preview' },
             { data: 'source_type' },
             { data: 'action' },
          ]
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

       $("body").on("click",".search_ok",function(){
        //alert("search")
         
            Dtable.ajax.reload();

       });

       $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         applyFilters();
         //Dtable.ajax.reload();
      });

      $('.ticket_search_ok').on('click', function (e) {
         $('.ticket_sold_btn').addClass("filter_active");
         var dropdown = $(this).closest('.dropdown');
        var checkboxCount = dropdown.find(".ticket_sold_checkbox input:checked").length;
         $('.ticket_sold_btn').text(checkboxCount + " Selected");
         applyFilters();
        
         //Dtable.ajax.reload();
      });
      

      $('.venue_filter').on('click', function (e) {
         $('.venue_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
        var dropdown = $(this).closest('.dropdown');
        var checkboxCount = dropdown.find(".venue_check_box input:checked").length;
         $('.venue_search_filter').text(checkboxCount + " Selected");
        applyFilters();
      });
      $('.tournament_search').on('click', function (e) {
         $('.tournament_search_filter').addClass("filter_active");
         var dropdown = $(this).closest('.dropdown');
        var venueCount = dropdown.find(".tournament_check_box input:checked").length;
         $('.tournament_search_filter').text(venueCount + " Selected");
         applyFilters();
         //Dtable.ajax.reload();
      });

      $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
       //  Dtable.ajax.reload();
       var dropdown = $(this).closest('.dropdown');
        var venueCount = dropdown.find(".check_box input:checked").length;
         $('.status_search_filter').text(venueCount + " Selected");
       applyFilters();
      });

      $('.category_search').on('click', function (e) {
         $('.category_search_filter').addClass("filter_active");
        applyFilters();
      });

      $('.category_reset').click(function () {    
      $('.category_search_filter').removeClass("filter_active");
      $('.category_search_filter').text("Event Category");
      $('.check_box_category input:checked').prop("checked", false); 
      updateFilters("category");
      });
      
     

       $("body").on("click",".match_id_rest",function(){
         $('.event_name_filter').removeClass("filter_active");
       // alert("rest");
        $(".match_id").prop('checked', false);
          $("#event_name").val('');
          updateFilters("event_name");
            Dtable.ajax.reload();

         });



       $("body").on("click",".stadium_id_rest",function(){
       // alert("rest");
      
        $(".stadium_id").prop('checked', false);
            Dtable.ajax.reload();

         });

         const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
        
           dateFormat: 'dd-mm-yy' ,changeMonth: true,
            changeYear: true,
      }
      );
      $(to_datepicker).datepicker(
         {  dateFormat: 'dd-mm-yy',
            changeYear: true ,changeMonth: true, }
      );

      $("body").on("click","#ui-datepicker-div",function(event){
         event.stopPropagation();
      });

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
         applyFilters();
        // Dtable.draw();

      });


   //      $("#from_date").datepicker({
   //      dateFormat: "yy-mm-dd",
   //      onSelect: function () {
   //          var dt2 = $('#to_date');
   //          var startDate = $(this).datepicker('getDate');
   //          //add 30 days to selected date
   //          startDate.setDate(startDate.getDate() + 30);
   //          var minDate = $(this).datepicker('getDate');
   //          var dt2Date = dt2.datepicker('getDate');
   //          //difference in days. 86400 seconds in day, 1000 ms in second
   //          var dateDiff = (dt2Date - minDate)/(86400 * 1000);

   //          //dt2 not set or dt1 date is greater than dt2 date
   //          if (dt2Date == null || dateDiff < 0) {
   //                  dt2.datepicker('setDate', minDate);
   //          }
   //          //dt1 date is 30 days under dt2 date
   //          else if (dateDiff > 30){
   //                  dt2.datepicker('setDate', startDate);
   //          }
   //          //sets dt2 maxDate to the last day of 30 days window
   //          dt2.datepicker('option', 'maxDate', startDate);
   //          //first day which can be selected in dt2 is selected date in dt1
   //          dt2.datepicker('option', 'minDate', minDate);
   //           Dtable.ajax.reload();




   //      }
   //  });

   //  $('#to_date').datepicker({
   //      dateFormat: "yy-mm-dd",
   //      minDate: 0,
   //      onSelect: function () {
   //          Dtable.ajax.reload();
   //      }
   //  });


   $(".clear_all_single").on('click', function(){
           $(this).parents(".dropdown").find(".check_box .custom-checkbox input").prop('checked', false); 
           $(this).parents(".dropdown").find(".venue_check_box .custom-checkbox input").prop('checked', false); 
           $(this).parents(".dropdown").find(".ticket_sold_checkbox .custom-checkbox input").prop('checked', false); 
           $(this).parents(".dropdown").find(".tournament_check_box .custom-checkbox input").prop('checked', false); 
          
           $(this).parents(".dropdown").find(".venue_search_filter").text("Venue");
           $(this).parents(".dropdown").find(".ticket_sold_btn").text("Ticket Sold");
           $(this).parents(".dropdown").find(".status_search_filter").text("Status");
           $(this).parents(".dropdown").find(".tournament_search_filter").text("Tournament");

           var dropdown = $(this).closest('.dropdown');
            
            // Get the data-name attribute value from the dropdown-toggle button
            var dataName = dropdown.find('.dropdown-toggle').data('name');
            
            // Perform different actions based on the data-name value
            if (dataName === 'date') {
               updateFilters("fromDate");
               updateFilters("toDate");
            } else {
               updateFilters(dataName);
               console.log(dataName);
            }

           $(this).parents(".dropdown").find(".text_class").show();
           $(this).parents(".dropdown").find(".selected_class").hide().html("");
          $(this).parents(".dropdown").find('.dropdown-toggle').removeClass("filter_active");

          $(this).parents(".dropdown").find(".form-group input:text").val(""); 

         
          Dtable.ajax.reload();
       });


        $(".clear_all").on('click', function(){
      
         $('.event_name_filter').removeClass("filter_active");
        $('.venue_search_filter').removeClass("filter_active");
        $('.date_search_filter').removeClass("filter_active");
        $('.tournament_search_filter').removeClass("filter_active");
        $('.ticket_sold_btn').removeClass("filter_active");
        $('.status_search_filter').removeClass("filter_active");
        $('.category_search_filter').removeClass("filter_active");       
        
         
             $(".match_id").prop('checked', false);
             $(".stadium_id").prop('checked', false);
             $(".tournament_id").prop('checked', false);
             $(".status").prop('checked', false);
             $(".ticket_sold").prop('checked', false);
             $(".category").prop('checked', false);
             $("#from_date").val("");
             $("#to_date").val("");
             $("#tournament_search_box").val("");     
             $("#venue_details").val("");     
             $("#event_name").val("");     
             
             $('.search_box').trigger('keyup');
             $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('.dropdown-menu-custom').removeClass('show');
         $('.dropdown').removeClass('show');     

         $('.venue_search_filter').text("Venue");
            $('.status_search_filter').text("Status");
            $('.ticket_sold_btn').text("Ticket Sold");
            $('.tournament_search_filter').text("Tournament");
            $('.category_search_filter ').text("Event Category");  
         resetFilters();
          //  Dtable.ajax.reload();
        });


        function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  checkedIds.push($(this).attr('id'));
               });

               var seatIds = [];
               $(".ticket_sold_checkbox input:checked").each(function () {
                  seatIds.push($(this).attr('id'));
               });

               var venueIds = [];
               $(".venue_check_box input:checked").each(function () {
                  venueIds.push($(this).attr('id'));
               }); 

               var tournamentIds = [];
               $(".tournament_check_box input:checked").each(function () {
                  console.log('entered');
                  tournamentIds.push($(this).attr('id'));
               }); 

               var categoryIds = [];
               $(".check_box_category input:checked").each(function () {
                  categoryIds.push( $(this).attr('id'));
               });
                              

            const fromDate = document.getElementById('MyTextbox3').value;
            const toDate = document.getElementById('MyTextbox2').value;
            const event_name=document.getElementById('event_name').value;    
            const category=categoryIds;        
   

            var filters = {
               matches_fromDate: fromDate,
               matches_toDate: toDate,
               matches_event_name: event_name,
               matches_status: checkedIds,
               matches_ticket_sold: seatIds,
               matches_venue: venueIds,  
               matches_tournament: tournamentIds,  
               matches_category: category
                           
            // ... Add other filters
            };
            sessionStorage.setItem('matches', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                       matches_fromDate      :        "",
                       matches_toDate        :        "",
                       matches_event_name    :        "",
                       matches_status        :        "",
                       matches_ticket_sold   :        "",
                       matches_venue         :        "",
                       matches_tournament    :        "",  
                       matches_category      :        ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('matches', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('matches');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var fromDateValue = filters.matches_fromDate;
      var toDateValue = filters.matches_toDate;
      var event_name = filters.matches_event_name;

      var status =filters.matches_status;
      var ticket_sold =filters.matches_ticket_sold;
      var venue =filters.matches_venue;
      var tournament =filters.matches_tournament;
      var category =filters.matches_category;

      
$(".check_box input[type='checkbox'], .ticket_sold_checkbox input[type='checkbox'], .venue_check_box input[type='checkbox'] ,.tournament_check_box input[type='checkbox'],.check_box_category input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.check_box').length) {
    // Checkbox belongs to the seat category group
    if (status.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } else if ($(this).closest('.ticket_sold_checkbox').length) {
    // Checkbox belongs to the seller name group
    if (ticket_sold.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } else if ($(this).closest('.venue_check_box').length) {
    // Checkbox belongs to the seller name group
    if (venue.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
  else if ($(this).closest('.tournament_check_box').length) {
    // Checkbox belongs to the seller name group
    if (tournament.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
  else if ($(this).closest('.check_box_category').length) {
  
  // Checkbox belongs to the seller name group
  if (category.includes(ID)) {
    $(this).prop("checked", true);
  } else {
    $(this).prop("checked", false);
  }
}
});

      $('#MyTextbox3').val(fromDateValue);
      $('#MyTextbox2').val(toDateValue);
      $('#event_name').val(event_name);

      if ((fromDateValue && toDateValue)) {
         $('.date_search_filter').addClass("filter_active");
         // $('#MyTextbox2').datepicker('setDate', fromDateValue);
         // $('#MyTextbox3').datepicker('setDate', toDateValue);

      }
      if(event_name)
      {
         $('.event_name_filter ').addClass("filter_active");
      }      
      if (status && status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(status.length + " Selected");
      }
      if (ticket_sold && ticket_sold.length > 0) {
         $('.ticket_sold_btn').addClass("filter_active");
         $('.ticket_sold_btn').text(ticket_sold.length + " Selected");
      }
      if (venue && venue.length > 0) {
         $('.venue_search_filter').addClass("filter_active");
         $('.venue_search_filter').text(venue.length + " Selected");
      }
      if (tournament && tournament.length > 0) {
         $('.tournament_search_filter').addClass("filter_active");
         $('.tournament_search_filter').text(tournament.length + " Selected");
      }

      if (category && category.length > 0) {
         $('.category_search_filter').addClass("filter_active");
         $('.category_search_filter').text(category.length + " Selected");
      }   

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('matches'));
  console.log(argName);
  // Check if sales_summary_seller_name has a value
  if (filters["matches_" + argName] && filters["matches_" + argName] !== "") {
    // Clear the remaining values while keeping the existing sales_summary_seller_name value
    filters["matches_" + argName] = "";
   console.log(argName);
    filters = {
      matches_fromDate: filters.matches_fromDate,
      matches_toDate: filters.matches_toDate,
      matches_event_name: filters.matches_event_name,

      matches_status: filters.matches_status,
      matches_ticket_sold: filters.matches_ticket_sold,
      matches_venue: filters.matches_venue,
      matches_tournament: filters.matches_tournament,
      matches_category: filters.matches_category  
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('matches', JSON.stringify(filters));
}
   $('.dropdown-menu-custom .check_box, .venue_check_box, .status_check_box, .tournament_check_box, .check_box_category').click(function(e) {
    e.stopPropagation();
});

        

     });
       

       

   // $(document).ready(function () {
   //         $("#from_date").datepicker();
   //         $("#to_date").datepicker();
   //      }); 

             

   </script>
<?php exit;?>