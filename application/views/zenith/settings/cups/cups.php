<style>
.check_box_status {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
	</style>
<?php $this->load->view(THEME.'common/header'); ?>
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
            <!-- <div class="page-title dflex-between-center">
               <h3 class="mb-1">Split Type Lists</h3>
            </div> -->
            <div class="page-title dflex-between-center">
               <h3 class="mb-1">Top Cups Lists</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <a href="<?php echo base_url(); ?>settings/league/add"  class="btn btn-success mb-2">Add Cups</a>
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
                                             <button class="btn btn-light dropdown-toggle cups_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Tournament <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="cups" placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info cups_reset">Reset</button></div>
                                                   <div class="reset_ok"><button
                                                         class="btn btn-info search_ok">Search</button></div>
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
                     <table style='width:100% !important' id="top-cups-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Tournament</th>
                              <th>Action</th>
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

<?php $this->load->view(THEME.'common/footer'); ?>
<script>
	 $(document).ready(function () {
    var overlay = $('#overlay');
   var Dtable = $('#top-cups-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_top_cups_list',
            data: function (d) {
				var cups = $("#cups").val();				
				d.cups = cups;
            
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
         },
         drawCallback: function () {

            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
         'columns': [
            { data: 'tournament_name' },
			{ data: 'action' },			
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

        $('.country_search').on('click', function (e) {
         $('.country_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });


      $(".clear_all").on('click', function(){
	
          $('.status_search_filter').removeClass("filter_active");
          $('.status_search_filter ').text("Status");  
		  $('.split_id_search_filter').removeClass("filter_active");
		  $('#cups').val('');
          //$(".check_box").prop('checked', false);
          $('.check_box input:checked').prop('checked', false);
          $(".status").prop('checked', false);
		  resetFilters();
          //Dtable.ajax.reload();
    });

    // $('.status_search').on('click', function (e) {
    //      $('.status_search_filter').addClass("filter_active");
    //     // Dtable.ajax.reload();
    //   });

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.country_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.country_search_filter ').text("Country Name");  
            
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

		 $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
		var dropdown = $(this).closest('.dropdown');
		var statusCount = dropdown.find(".check_box input:checked").length;
		$('.status_search_filter').text(statusCount + " Selected");
      applyFilters();
      });

		 $("body").on("click",".search_ok",function(){
			$('.cups_search_filter').addClass("filter_active");
			applyFilters();
			//Dtable.ajax.reload();
       });

	   $("body").on("click",".cups_reset",function(){
         $('.cups_search_filter').removeClass("filter_active");
		 $('#cups').val('');
          updateFilters("cups");
            Dtable.ajax.reload();
         });

		 function applyFilters() {
            const league=document.getElementById('cups').value;                   

            var filters = {
				cups: cups
            // ... Add other filters
            };
            sessionStorage.setItem('cups_filter', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
						cups: ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('cups_filter', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('league_filter');
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
     
      var cups = filters.cups;
   
      $('#cups').val(cups);
	  if(cups)
      {
		$('.cups_search_filter').addClass("filter_active");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('cups_filter'));

  // Check if sales_summary_seller_name has a value
  if (filters[argName] && filters[argName] !== "") {
    // Clear the remaining values while keeping the existing team_filter_seller_name value
    filters[argName] = "";
    filters = {
      team: filters.cups,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('cups_filter', JSON.stringify(filters));
}
});
</script>