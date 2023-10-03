<style>
	.imgTbl {
    max-width: 40px;
}

img {
    height: auto;
    max-width: 100%;
}
.check_box_status {
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
               <h3 class="mb-1">Report Issue List</h3>               
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
                                             <button class="btn btn-light dropdown-toggle seller_name_btn" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Seller Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            placeholder="Search in Filters..."
                                                            aria-controls="view_project_list" id="seller_name"></label>
                                                   </div>
                                                </div>
                                                <div class="check_box">                                                  
                                                   <?php
                                                   echo $html;
                                                   ?>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info seller_reset">Reset</button></div>
                                                   <div class="reset_ok"><button
                                                         class="btn btn-info seller_search">Search</button></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>                                   

                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle event_name_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Event Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" id="event_name"
                                                            class="form-control form-control-sm"
                                                            placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info event_reset">Reset</button></div>
                                                   <div class="reset_ok"><button
                                                         class="btn btn-info event_search_ok">Search</button></div>
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

                  <div class="table-responsive">
                     <table style='width:100% !important' id="tournament-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Seller Name</th>
                              <th>Event Name</th>
                              <th>Event Date</th>
                              <th>Issue</th>
                              <th>Reported Date</th>
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
            url: base_url + 'tickets/get_report_issue',
            data: function (d) {
               var seller_name = '';
               var event_name = $("#event_name").val();

               var checkedIds = [];
               $(".check_box input:checked").each(function () {

                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");

                  checkedIds.push(newID);
               });


               d.event = event_name;
               d.seller_name = checkedIds;

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
            { data: 'seller_name' },    
            { data: 'match_name' },  
            { data: 'match_date' },    
           { data: 'report_text' },
           { data: 'report_date' },
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

        $('.tournament_search').on('click', function (e) {
         $('.tournament_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
        applyFilters();
      });

      $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");        
        applyFilters();
        //Dtable.ajax.reload(); 
      });

      $('.event_reset').click(function () {          
         $('.event_name_filter').removeClass("filter_active");
         $("#event_name").val(''); // clear selected date value
         updateFilters("event_name");
        // Dtable.ajax.reload(); 
        
      });      

      $(".clear_all").on('click', function(){
         resetFilters();
          $('.tournament_search_filter').removeClass("filter_active");
          $('.event_name_filter').removeClass("filter_active");     
          $('.status_search_filter').removeClass("filter_active");
          $('.tournament_search_filter ').text("Country");
          $('.status_search_filter ').text("Status");  
          $(".tournament_id").prop('checked', false);
          $(".status").prop('checked', false);
          $("#event_name").val('');
          $('.seller_name_btn').removeClass("filter_active");
          $("#seller_name").val('');
          $('.check_box input:checked').prop("checked", false);
          Dtable.ajax.reload();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
        applyFilters();
      });

      $('.seller_search').on('click', function (e) {
         $('.seller_name_btn').addClass("filter_active");
         //Dtable.draw();
         applyFilters();

       //Dtable.ajax.reload(); 
      });

      $('.seller_reset').click(function () {  
         $('.seller_name_btn').removeClass("filter_active");
         $('.seller_name_btn').text("Seller Name");
         $("#seller_name").val('');
         $('.check_box input:checked').prop("checked", false);
        // Dtable.ajax.reload(); 
        updateFilters("seller_name");
        //resetFilters();
      });

      $("#seller_name").keyup(function () { // Bind to the keyup event of the textbox
         var searchText = $(this).val(); // Get the text entered in the textbox
         $.ajax({
            url: base_url + 'accounts/get_seller_name',
            type: "POST",
            data: { search_text: searchText }, // Pass the search text to the PHP script
            success: function (response) {
               $(".check_box").html(response); // Bind the response data to the checkbox container
               Dtable.draw();
            }
         });
      });

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.seller_name_btn ').text(checkedCount+" Selected");
         } 
         else 
            $('.seller_name_btn ').text("Seller Name");  
            
         });  


         function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  checkedIds.push($(this).attr('id'));
               });
            const seller_name=checkedIds;
            const event_name=document.getElementById('event_name').value;  

            var filters = {                   
               seller_name: seller_name,
               event_name: event_name,
            // ... Add other filters
            };
            sessionStorage.setItem('report_issue', JSON.stringify(filters));
          Dtable.draw();        
         
         }


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        seller_name         :     "",
                        event_name    :     ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('report_issue', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('report_issue');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var event_name =filters.event_name;
      var seller_name =filters.seller_name;
     // return false;
$(".check_box input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.check_box').length) {  
    // Checkbox belongs to the seat category group
    if (seller_name.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
});

      $('#event_name').val(event_name);
     
      if (seller_name && seller_name.length > 0) {
         $('.seller_name_btn').addClass("filter_active");
         $('.seller_name_btn').text(seller_name.length + " Selected");
      }

      if(event_name)
      {
         $('.event_name_filter ').addClass("filter_active");
      }   
      
      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('report_issue'));
  // Check if sales_summary_seller_name has a value
  if (filters[argName] && filters[argName] !== "") {
   
    // Clear the remaining values while keeping the existing tournaments_seller_name value
    filters[argName] = "";
    filters = {
      event_name: filters.event_name,
      seller_name: filters.seller_name,
    };
  }
  
  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('report_issue', JSON.stringify(filters));
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
