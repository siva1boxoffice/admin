<style>
	.imgTbl {
    max-width: 40px;
}

img {
    height: auto;
    max-width: 100%;
}
.check_box_status,.check_box_category {
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
               <h3 class="mb-1">Tournaments</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <a href="<?php echo base_url();?>settings/tournaments/add"  class="btn btn-success mb-2">Add Tournament</a>
                </div>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">

                   <!-- <div class="card">
                      <div class="card-body">
                          <div class="row">
                            <div class="col-sm-9 col-md-4">
                                
                            </div>
                            <div class="col-sm-3 col-md-8">
                                <div class="float-sm-right mt-3 mt-sm-0">                               
                                
                                <div class="float-sm-right mt-3 mt-sm-0">
                                  <a href="<?php echo base_url();?>settings/tournaments/add"  class="btn btn-success mb-2">Add Tournament</a>
                                </div>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div> -->

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
                                             Tournaments Name <i class="mdi mdi-chevron-down"></i>
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

                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status2" name="status[]" value="2">
                                                    <label class="custom-control-label" for="status2">Trash</label>
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
                              <th>Tournament ID</th>
                              <th>Tournament Name</th>
                              <th>Event Category</th>
                              <th>Tournament Image</th>
                              <th>Ticket Listed</th>
                              <th>Sort By</th>
                              <th>Status</th>
                              <th>SEO Status</th>
                              <th>SEO Preview</th>
                              <th>Clone</th>
                              <th>Source Type</th>
                              <th>Actions</th>
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
         'scrollX': !0,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_tournaments',
            data: function (d) {
              var tournament_ids= '';
                $('.tournament_id').each(function(i,e) {
                  if ($(e).is(':checked')) {
                            var comma = tournament_ids.length===0?'':',';
                            tournament_ids += (comma+e.value);
                  }
              });

              var status= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = status.length===0?'':',';
                                 status += (comma+e.value);
                        }
                     });

                     var category= '';
                     $('.category').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = category.length===0?'':',';
                                 category += (comma+e.value);
                        }
                     });

              d.tournament_ids = tournament_ids;
              d.status = status;
              d.category = category;
            
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
            { data: 's_no' },
            { data: 'tournament' },
            { data: 'event_category' },
            { data: 'image' },
            { data: 'ticket_listed' },
            { data: 'sort_by' },
            { data: 'status' },
            { data: 'seo_status' },
            { data: 'seo_preview' },
            { data: 'clone' },
            { data: 'source_type' },
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

         $('.dropdown-menu-custom .check_box, .dropdown-menu-custom .check_box_status, .dropdown-menu-custom .check_box_category').click(function(e) {
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

      $('.category_reset').click(function () {    
      $('.category_search_filter').removeClass("filter_active");
      $('.category_search_filter').text("Event Category");
      $('.check_box_category input:checked').prop("checked", false); 
      updateFilters("category");
      });

      $('.tournament_reset').click(function () {    
      $('.tournament_search_filter').removeClass("filter_active");
      $('.tournament_search_filter').text("Tournament Name");
      $("#tournament_search_box").val('');
      $('.check_box input:checked').prop("checked", false);
      updateFilters("tournament");
     
      // 
      });

      $(".clear_all").on('click', function(){
         resetFilters();
          $('.tournament_search_filter').removeClass("filter_active");
          $('.status_search_filter').removeClass("filter_active");
          $('.category_search_filter').removeClass("filter_active");
          $('.tournament_search_filter ').text("Tournaments Name");
          $('.status_search_filter ').text("Status");  
          $('.category_search_filter ').text("Event Category");  
          $(".tournament_id").prop('checked', false);
          $(".status").prop('checked', false);
          $(".category").prop('checked', false);
          Dtable.ajax.reload();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
        applyFilters();
      });

      $('.category_search').on('click', function (e) {
         $('.category_search_filter').addClass("filter_active");
        applyFilters();
      });

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.tournament_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.tournament_search_filter ').text("Seller Name");  
            
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
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  checkedIds.push($(this).attr('id'));
               });

               var seatIds = [];
               $(".check_box_status input:checked").each(function () {
                  seatIds.push( $(this).attr('id'));
               });

               var categoryIds = [];
               $(".check_box_category input:checked").each(function () {
                  categoryIds.push( $(this).attr('id'));
               });

            const tournament=checkedIds;
            const status=seatIds;
            const category=categoryIds;

            var filters = {                   
               tournaments_tournament: tournament,
               tournaments_status: status,
               tournaments_category: category
            // ... Add other filters
            };
            sessionStorage.setItem('tournaments', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        tournaments_tournament         :     "",
                        tournaments_status    :     "",
                        tournaments_category    :     ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('tournaments', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('tournaments');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var tournament =filters.tournaments_tournament;
      var status =filters.tournaments_status;
      var category =filters.tournaments_category;
     // return false;
$(".check_box input[type='checkbox'], .check_box_status input[type='checkbox'],.check_box_category input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.check_box').length) {
  
    // Checkbox belongs to the seat category group
    if (tournament.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } else if ($(this).closest('.check_box_status').length) {
  
    // Checkbox belongs to the seller name group
    if (status.includes(ID)) {
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
     
      if (tournament && tournament.length > 0) {
         $('.tournament_search_filter').addClass("filter_active");
         $('.tournament_search_filter').text(tournament.length + " Selected");
      }
      if (status && status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(status.length + " Selected");
      }
      if (category && category.length > 0) {
         $('.category_search_filter').addClass("filter_active");
         $('.category_search_filter').text(category.length + " Selected");
      }      

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('tournaments'));
  // Check if sales_summary_seller_name has a value
  if (filters["tournaments_" + argName] && filters["tournaments_" + argName] !== "") {
   
    // Clear the remaining values while keeping the existing tournaments_seller_name value
    filters["tournaments_" + argName] = "";
    filters = {
      tournaments_tournament: filters.tournaments_tournament,
      tournaments_status: filters.tournaments_status,
      tournaments_category: filters.tournaments_category      
    };
  }
  
  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('tournaments', JSON.stringify(filters));
  Dtable.ajax.reload();
}

});
  </script>
