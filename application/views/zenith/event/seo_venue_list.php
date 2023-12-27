<style>
	.imgTbl {
    max-width: 40px;
}

img {
    height: auto;
    max-width: 100%;
}
.check_box_status,.check_box_stadium_status {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
	</style>
<?php $this->load->view(THEME . '/common/header'); ?>


<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>

<!-- Begin main content -->
<div class="main-content">
   <!-- content -->
   <div class="page-content">
      <!-- page header -->
      <div class="page-title-box">
         <div class="container-fluid">
            <div class="page-title dflex-between-center">
               <h3 class="mb-1">SEO Stadium(Venue) List</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <a href="<?php echo base_url();?>settings/seo_venue_list/add"  class="btn btn-success mb-2">Add</a>
                </div>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">
            <div class="card">
               <div class="card-body">

                  <div class="section_all all_orders filter_new">
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
                              <ul>
                                  <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle tournament_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Venue <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='tournament_search_box'></label></div>
                                             </div>
                                                <div class="check_box">
                                                     <?php if($country){
                                                        foreach ($country as $key => $value) {
                                                          ?>                                                           
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input tournament_id" id="tournament_id<?php echo ++$key;?>" name="tournament[]" value="<?php echo $value->id;?>">
                                                    <label class="custom-control-label" for="tournament_id<?php echo $key;?>"><?php echo $value->name;?></label>
                                                  </div>
                                              <?php } }  ?>


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
                                             <button class="btn btn-light dropdown-toggle status_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Status <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box_status">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status1" name="status[]" value="1">
                                                    <label class="custom-control-label" for="status1">Active</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status0" name="status[]" value="0">
                                                    <label class="custom-control-label" for="status0">InActive</label>
                                                  </div>
                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info status_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info status_search">Search</button></div>
                                                      </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    

                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle top_status_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Top Venue <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box_stadium_status">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input venue_status" id="top_venue_status1" name="top_venue_status[]" value="1">
                                                    <label class="custom-control-label" for="top_venue_status1">Yes</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input venue_status" id="top_venue_status0" name="top_venue_status[]" value="0">
                                                    <label class="custom-control-label" for="top_venue_status0">No</label>
                                                  </div>
                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info top_venue_status_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info top_venue_status_search">Search</button></div>
                                                      </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    
                                    <li class="sort_list">
                                       <a class="clear_all" href="javascript:void(0)">Clear All</a>
                                    </li>

                                  </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="">
                     <table style='width:100% !important' id="tournament-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Venue Name</th>
                              <th>Status</th>
                              <th>Top Venue</th>
                              <th>&nbsp;</th>
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
</div>
<!-- main content End -->
<?php $this->load->view(THEME . '/common/footer'); ?>
<script>
     $(document).ready(function () {
    var overlay = $('#overlay');
   var Dtable = $('#tournament-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_seo_venue_list',
            data: function (d) {
               
               var venue_name = $("#tournament_search_box").val();

               var status= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = status.length===0?'':',';
                                 status += (comma+e.value);
                        }
                     });

                     var top_venue_status= '';
                     $('.venue_status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = top_venue_status.length===0?'':',';
                                 top_venue_status += (comma+e.value);
                        }
                     });

              
                d.status = status;
                d.top_venue_status = top_venue_status;
                d.venue_name = venue_name;

            },
            beforeSend: function () {
            // Show the loader before the request is sent
            overlay.show();
         },
         complete: function () {
            // Hide the loader after the request is completed
            overlay.hide();
         },
           
         },
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
         //   loadingRecords: '&nbsp;',
           // processing: 'Loading...'
         },
         drawCallback: function () {

            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
         'columns': [
            { data: 'venue_name' },     
            { data: 'status' },    
            { data: 'top_venue_status' },                
           { data: 'edit_content' },
         ],
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

        $('.dropdown-menu-custom .check_box').click(function(e){
            e.stopPropagation();
        });

        $('.dropdown-menu-custom .check_box_status').click(function(e){
            e.stopPropagation();
        });

        $('.dropdown-menu-custom .check_box_stadium_status').click(function(e){
            e.stopPropagation();
        });

        $('.tournament_search').on('click', function (e) {
         $('.tournament_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
        applyFilters();
      });

            
      $('.status_reset').click(function () {    
      $('.status_search_filter').removeClass("filter_active");
      $('.status_search_filter').text("Status");
      $('.check_box_status input:checked').prop("checked", false); 
      updateFilters("status");
      });

      $('.top_venue_status_reset').click(function () {    
      $('.top_status_search_filter').removeClass("filter_active");
      $('.top_status_search_filter').text("Top Venue");
      $('.check_box_stadium_status input:checked').prop("checked", false); 
      updateFilters("venue_status");
      });

      

      $('.tournament_reset').click(function () {    
      $('.tournament_search_filter').removeClass("filter_active");
      $('.tournament_search_filter').text("Venue");
      $("#tournament_search_box").val('');
      $('.check_box input:checked').prop("checked", false);
      updateFilters("tournament");
     
      // 
      });

      $(".clear_all").on('click', function(){
         resetFilters();
          $('.tournament_search_filter').removeClass("filter_active");
          $('.status_search_filter').removeClass("filter_active");
          $('.top_status_search_filter').removeClass("filter_active");
           
          $('.tournament_search_filter ').text("Venue");
          $('.status_search_filter ').text("Status");  
          $('.top_status_search_filter ').text("Top Venue");  
          
          $(".tournament_id").prop('checked', false);
          $(".status").prop('checked', false);
          $(".venue_status").prop('checked', false);
          
          $("#tournament_search_box").val('');
          Dtable.ajax.reload();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
        applyFilters();
      });

      $('.top_venue_status_search').on('click', function (e) {
         $('.top_status_search_filter').addClass("filter_active");
        //Dtable.ajax.reload();
        applyFilters();
      });

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.tournament_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.tournament_search_filter ').text("Country");  
            
         });  

         $(".check_box_status").change(function() { 
         var checkedCount = $('.check_box_status input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.status_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.status_search_filter ').text("Status");  
            
         }); 

         function applyFilters() {           

               var statusIds = [];
               $(".check_box_status input:checked").each(function () {
                  statusIds.push( $(this).attr('id'));
               });    
               
               var venueStatusIds = [];
               $(".check_box_stadium_status input:checked").each(function () {
                  venueStatusIds.push( $(this).attr('id'));
               });  

            const status=statusIds;
            const venue_name=document.getElementById('tournament_search_box').value;
            const venue_status=venueStatusIds;

            var filters = {                   
               venue_name: venue_name,
               status: status,
               venue_status: venue_status
            // ... Add other filters
            };
            sessionStorage.setItem('seo_venue', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        venue_name         :     "",
                        status    :     "",
                        venue_status: ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('seo_venue', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('seo_venue');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var venue_name =filters.venue_name;
      var status =filters.status;
      var venue_status=filters.venue_status
     // return false;
$(".check_box_stadium_status input[type='checkbox'],.check_box_status input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
      
  if ($(this).closest('.check_box_status').length) {  
    // Checkbox belongs to the seller name group
    if (status.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } else  if ($(this).closest('.check_box_stadium_status').length) {  
    // Checkbox belongs to the seller name group
    if (venue_status.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
});     
     
      if (status && status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(status.length + " Selected");
      }
      if (venue_status && venue_status.length > 0) {
         $('.top_status_search_filter ').addClass("filter_active");
         $('.top_status_search_filter ').text(venue_status.length + " Selected");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('seo_venue'));
  // Check if sales_summary_seller_name has a value
  if (filters[argName] && filters[argName] !== "") {
   
    // Clear the remaining values while keeping the existing tournaments_seller_name value
    filters[argName] = "";
    filters = {
      venue_name: filters.venue_name,
      status: filters.status,
      venue_status: filters.venue_status,
    };
  }
  
  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('seo_venue', JSON.stringify(filters));
  Dtable.ajax.reload();
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
               
      
              $('#city').html(state_city.city);
              $('#state').val(state_city.state);
              if(city_id != "'"){
                   $('#city').val(city_id);
                }
            }
          })
      
        }
      }
  </script>
