
<?php 
    $tournments   = $this->General_Model->get_tournments()->result();
    $stadiums   = $this->General_Model->get_stadium()->result();
     $match_lists   = $this->General_Model->get_match_list();
  
    $only = @$_GET['only'] ;
    $only_url =   @$_GET['only'] ? "?only=".@$_GET['only']  : "" ;
?>
<?php  $this->load->view(THEME.'common/header'); ?>
<style>
   .ticket_sold_checkbox {
    padding: 0 15px;
    margin-top: 15px;
    max-height: 250px;
    overflow-y: auto;
    margin-bottom: 15px;
}
.venue_check_box {
   padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
    max-height: 250px;
    overflow-y: auto;
}

</style>

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
                           <h3 class="mb-1 font-weight-bold">Others Events</h3>
                        </div>
                     </div>
                     <div class="col-sm-8 col-xl-8 text-sm-right mt-2 mt-sm-0">
                        <div class="float-sm-right mt-3 mt-sm-0 team_lists_bttn">
                           <a href="javascript:void(0);"  class="active_event btn btn-primary mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Top Game</a> 
                           <a href="javascript:void(0);"  class="active_event btn btn-success mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Active</a> 
                           <a href="javascript:void(0);"  class="active_event btn btn-danger mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Inactive</a>
                           <a href="<?php echo base_url();?>event/other_events/add_event"  class="btn btn-success mb-2 <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Add Other Event</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- page content -->

            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">

             
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
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <span class="text_class">Event Name</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
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
                                             <button class="btn btn-light dropdown-toggle venue_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" data-name="venue" aria-haspopup="true" aria-expanded="false">
                                             <span class="text_class">Venue</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
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
                                                         <div class="reset_ok"><button class="btn btn-info button_click">Search</button></div>
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
                                                   <button class="btn btn-light dropdown-toggle date_search_filter" type="button" id="dropdownMenuButtondate"
                                                   data-toggle="dropdown" data-name="date" aria-haspopup="true" aria-expanded="false">
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
                                    <!-- <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle tournament_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <span class="text_class">Tournaments</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='tournament_search_box'></label></div>
                                             </div>
                               
                                                <div class="check_box">
                                                     <?php if($tournments){
                                                        foreach ($tournments as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input tournament_id" id="tournament_id<?php echo $key;?>" name="tournament[]" value="<?php echo $value->t_id;?>">
                                                    <label class="custom-control-label" for="tournament_id<?php echo $key;?>"><?php echo $value->tournament_name;?></label>
                                                  </div>
                                              <?php } }  ?>


                                                </div> 

                                          
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info button_click">Search</button></div>
                                                </div>                                               

                                             </div>
                                          </div>
                                       </div>
                                    </li>-->
                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle status_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" data-name="status" aria-haspopup="true" aria-expanded="false">
                                             <span class="text_class">Status</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
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
                                                         <div class="reset_ok"><button class="btn btn-info button_click">Search</button></div>
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
                                             <button class="btn btn-light dropdown-toggle ticket_sold_btn" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" data-name="ticket_sold" aria-haspopup="true" aria-expanded="false">
                                            <span class="text_class"> Ticket Sold</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
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
                                                         <div class="reset_ok"><button class="btn btn-info button_click">Search</button></div>
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
                                    <th class="before_none">Venue</th>
                                    <th class="before_none">Event Date</th>
                                    <!-- <th class="before_none">Tournament</th>                                     -->
                                    <th class="before_none">Category</th>                                    
                                    <th class="before_none">Status</th>
                                    <th class="before_none">Top Games</th>
                                    <th class="before_none">Number Of <br>Ticket Listed</th>
                             
                                    <th class="before_none">Tickets Sold</th>
                                    <th class="before_none">Seo Status</th>
                                    <th class="before_none">Seo Preview</th>
                                   
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

    var url = baseUrl + 'event/other_event_reports?' + 'event_start_date=' + eventStartDate + '&event_end_date=' + eventEndDate + '&event_name=' +event_name + '&stadium_ids=' + stadiumIds.join(',') + '&tournament_ids=' + tournamentIds.join(',')+ '&status=' + status.join(',')+ '&match_type=events';
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
             'url':'<?php echo base_url('ajax/other_events') ;?>',
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

              //  d.match_ids = match_ids;
              var event_name = $("#event_name").val();

              var fromDate = document.getElementById('MyTextbox3').value;
               var toDate = document.getElementById('MyTextbox2').value;


                d.event_name = event_name;
                d.stadium_ids = stadium_ids;
                d.tournament_ids = tournament_ids;
                d.statuss = statuss;
                d.from_date = $(".from_date").val();
                d.to_date =  $(".to_date").val();
                d.flag =  $("#flag").val();
                d.only =  $("#only").val();
                d.event_start_date = fromDate;
               d.event_end_date = toDate;
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
             { data: 'venue' },
             { data: 'event_date' },
             // { data: 'tournament' },
             { data: 'category' },
             { data: 'status' },
             { data: 'top_game' },
             { data: 'no_of_ticket' },
             { data: 'ticket_sold' },
             { data: 'seo_status' },
             { data: 'seo_preview' },
       
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

    

   //      $("#from_date").datepicker({
   
        
        $('.reset_ok .button_click').on('click', function (e) {
       /*var  count =  $(this).parents(".dropdown").find(".check_box  .custom-checkbox input:checked").length ;
               
         if(count > 0 ){
             $(this).parents(".dropdown").find('.dropdown-toggle').addClass("filter_active");
             $(this).parents(".dropdown").find(".text_class").hide();
             $(this).parents(".dropdown").find(".selected_class").show().html(count + " Selected");
           
         }
         else{
             $(this).parents(".dropdown").find(".text_class").show();
             $(this).parents(".dropdown").find(".selected_class").hide().html("");
             $(this).parents(".dropdown").find('.dropdown-toggle').removeClass("filter_active");
         }*/

         var dropdown = $(this).parents(".dropdown");
var checkboxCount = dropdown.find(".check_box .custom-checkbox input:checked").length;
var venueCheckboxCount = dropdown.find(".venue_check_box .custom-checkbox input:checked").length;
var ticketSoldCheckboxCount = dropdown.find(".ticket_sold_checkbox .custom-checkbox input:checked").length;
var statusCheckboxCount = dropdown.find(".status_search_filter .custom-checkbox input:checked").length;
 
console.log(ticketSoldCheckboxCount);
// Update dropdown toggle and selected text based on checkbox count
if (checkboxCount > 0) {
  dropdown.find('.dropdown-toggle').addClass("filter_active");
  dropdown.find(".text_class").hide();
//  dropdown.find(".selected_class").show().html(checkboxCount + " Selected");
  $('.status_search_filter ').text(checkboxCount + " Selected");
} else {
  dropdown.find(".text_class").show();
  dropdown.find(".selected_class").hide().html("");
  dropdown.find('.dropdown-toggle').removeClass("filter_active");
}

// Update venue search filter text and class based on venue checkbox count
if (venueCheckboxCount > 0) {
  $('.venue_search_filter').text(venueCheckboxCount + " Selected");
  $('.venue_search_filter').addClass("filter_active");
} 
// else {
//   $('.venue_search_filter').text("Venue");
//   $('.venue_search_filter').removeClass("filter_active");
// }

// Update ticket sold button text and class based on ticket sold checkbox count
if (ticketSoldCheckboxCount > 0) {
  $('.ticket_sold_btn').text(ticketSoldCheckboxCount + " Selected");
  $('.ticket_sold_btn').addClass("filter_active");
} 
// else {
//   $('.ticket_sold_btn').text("Ticket Sold");
//   $('.ticket_sold_btn').removeClass("filter_active");
// }

         applyFilters();
         Dtable.ajax.reload();
      });


       $(".clear_all_single").on('click', function(){
           $(this).parents(".dropdown").find(".check_box .custom-checkbox input").prop('checked', false); 
           $(this).parents(".dropdown").find(".venue_check_box .custom-checkbox input").prop('checked', false); 
           $(this).parents(".dropdown").find(".ticket_sold_checkbox .custom-checkbox input").prop('checked', false); 
          
           $(this).parents(".dropdown").find(".venue_search_filter").text("Venue");
           $(this).parents(".dropdown").find(".ticket_sold_btn").text("Ticket Sold");
           $(this).parents(".dropdown").find(".status_search_filter").text("Status");

           var dropdown = $(this).closest('.dropdown');
            
            // Get the data-name attribute value from the dropdown-toggle button
            var dataName = dropdown.find('.dropdown-toggle').data('name');
            
            // Perform different actions based on the data-name value
            if (dataName === 'date') {
               updateFilters("fromDate");
               updateFilters("toDate");
            } else {
               updateFilters(dataName);
            }

           $(this).parents(".dropdown").find(".text_class").show();
           $(this).parents(".dropdown").find(".selected_class").hide().html("");
          $(this).parents(".dropdown").find('.dropdown-toggle').removeClass("filter_active");

          $(this).parents(".dropdown").find(".form-group input:text").val(""); 

         
          Dtable.ajax.reload();
       });


       $(".clear_all").on('click', function(){

            $(".dropdown").find(".check_box .custom-checkbox input").prop('checked', false); 
            $(".dropdown").find(".venue_check_box .custom-checkbox input").prop('checked', false);             
            $(".dropdown").find(".text_class").show();
            $(".dropdown").find(".selected_class").hide();
            $(".dropdown").find('.dropdown-toggle').removeClass("filter_active");
   

            $('.date_search_filter').removeClass("filter_active");

             $("#from_date").val("");
             $("#to_date").val("");
             $("#event_name").val("");
 
             $('.search_box').trigger('keyup');
             $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
             $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
             $('.dropdown-menu-custom').removeClass('show');
             $('.dropdown').removeClass('show');     

             $('.venue_search_filter').text("Venue");
            $('.status_search_filter').text("Status");
            $('.ticket_sold_btn').text("Ticket Sold");

            $(".venue_check_box input:checked").prop("checked", false);
            $(".ticket_sold_checkbox input:checked").prop("checked", false);
            $(".check_box input:checked").prop("checked", false);       
            resetFilters();
             Dtable.ajax.reload();
        });

 
    
       $("body").on("click",".search_ok",function(){
        //alert("search")
         
         //  Dtable.ajax.reload();
         applyFilters();

       });

       $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         applyFilters();
       //  Dtable.ajax.reload();
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
             //  Dtable.ajax.reload();

      });


       $("body").on("click",".match_id_rest",function(){
         $('.event_name_filter').removeClass("filter_active");
       // alert("rest");
        $(".match_id").prop('checked', false);
          $("#event_name").val('');
          updateFilters("event_name");
            Dtable.ajax.reload();

         });





        $('.dropdown-menu-custom .check_box').click(function(e){
            e.stopPropagation();
        });
        $('.dropdown-menu-custom .venue_check_box').click(function(e){
            e.stopPropagation();
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

            const fromDate = document.getElementById('MyTextbox3').value;
            const toDate = document.getElementById('MyTextbox2').value;
            const event_name=document.getElementById('event_name').value;            
   

            var filters = {
               other_events_fromDate: fromDate,
               other_events_toDate: toDate,
               other_events_event_name: event_name,
               other_events_status: checkedIds,
               other_events_ticket_sold: seatIds,
               other_events_venue: venueIds,              
            // ... Add other filters
            };
            sessionStorage.setItem('other_events', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        other_events_fromDate      :        "",
                        other_events_toDate        :        "",
                        other_events_event_name    :        "",
                        other_events_status        :        "",
                        other_events_ticket_sold   :        "",
                        other_events_venue         :        "",  
                     // ... Add other filters
                     };
                     sessionStorage.setItem('other_events', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('other_events');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var fromDateValue = filters.other_events_fromDate;
      var toDateValue = filters.other_events_toDate;
      var event_name = filters.other_events_event_name;

      var status =filters.other_events_status;
      var ticket_sold =filters.other_events_ticket_sold;
      var venue =filters.other_events_venue;

      
$(".check_box input[type='checkbox'], .ticket_sold_checkbox input[type='checkbox'], .venue_check_box input[type='checkbox']").each(function() {
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
});

      $('#MyTextbox3').val(fromDateValue);
      $('#MyTextbox2').val(toDateValue);
      $('#event_name').val(event_name);

      if ((fromDateValue && toDateValue)) {
         $('.date_search_filter').addClass("filter_active");
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

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('other_events'));
  console.log(argName);
  // Check if sales_summary_seller_name has a value
  if (filters["other_events_" + argName] && filters["other_events_" + argName] !== "") {
    // Clear the remaining values while keeping the existing sales_summary_seller_name value
    filters["other_events_" + argName] = "";
   
    filters = {
      other_events_fromDate: filters.other_events_fromDate,
      other_events_toDate: filters.other_events_toDate,
      other_events_event_name: filters.other_events_event_name,

      other_events_status: filters.other_events_status,
      other_events_ticket_sold: filters.other_events_ticket_sold,
      other_events_venue: filters.other_events_venue
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('other_events', JSON.stringify(filters));
}

            });
       

   </script>
<?php exit;?>