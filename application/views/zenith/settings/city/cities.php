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
               <h3 class="mb-1">City Lists</h3>
            </div> -->
			<div class="page-title dflex-between-center">
               <h3 class="mb-1">City Lists</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <a href="<?php echo base_url(); ?>settings/cities/add"  class="btn btn-success mb-2">Add City</a>
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
                                             <button class="btn btn-light dropdown-toggle city_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             City Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='city_search_box'></label></div>
                                             </div>
                                               
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info city_clear_all">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info city_search">Search</button></div>
                                                </div>                                               

                                             </div>
                                          </div>
                                       </div>
                                    </li>
									<li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle state_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             State Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='state_search_box'></label></div>
                                             </div>
                                               
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info state_clear_all">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info state_search">Search</button></div>
                                                </div>                                               

                                             </div>
                                          </div>
                                       </div>
                                    </li>
                              <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle country_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Country Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='country_search_box'></label></div>
                                             </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info country_clear_all">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info country_search">Search</button></div>
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
                     <table style='width:100% !important' id="city-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
						  	 <th>City Name</th>                              
                              <th>State Name</th>
							  <th>Country Name</th>							  
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
   var Dtable = $('#city-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_city_list',
            data: function (d) {
				var city = $("#city_search_box").val(); 
               d.city = city;
			   var state = $("#state_search_box").val(); 
               d.state = state;
			   var country = $("#country_search_box").val(); 
               d.country = country;
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
            { data: 'city_name' },
            { data: 'state_name' },
			{ data: 'country_name' },
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

        $('.city_search').on('click', function (e) {
         $('.city_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
		applyFilters();
      });

	  $('.state_search').on('click', function (e) {
         $('.state_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
		 applyFilters();
      });

	  $('.country_search').on('click', function (e) {
         $('.country_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
		 applyFilters();
      });


	  $("body").on("click",".city_clear_all",function(){
         $('.city_search_filter').removeClass("filter_active");
		 $('#city_search_box').val('');
          updateFilters("city");
            Dtable.ajax.reload();
         });

		 $("body").on("click",".state_clear_all",function(){
         $('.state_search_filter').removeClass("filter_active");
		 $('#state_search_box').val('');
          updateFilters("state");
            Dtable.ajax.reload();
         });

		 $("body").on("click",".country_clear_all",function(){
         $('.country_search_filter').removeClass("filter_active");
		 $('#country_search_box').val('');
          updateFilters("country");
            Dtable.ajax.reload();
         });

      $(".clear_all").on('click', function(){
		  $('.city_search_filter').removeClass("filter_active");
		  $('.state_search_filter').removeClass("filter_active");
		  $('.country_search_filter').removeClass("filter_active");
		  $('#city_search_box').val('');
		  $('#state_search_box').val('');
		  $('#country_search_box').val('');

          $('.status_search_filter').removeClass("filter_active");
          $('.country_search_filter ').text("Country Name");
          $('.status_search_filter ').text("Status");  
          //$(".check_box").prop('checked', false);
          $('.check_box input:checked').prop('checked', false);
          $(".status").prop('checked', false);
          //Dtable.ajax.reload();
		  resetFilters();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

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


		 function applyFilters() {
            const city		=	document.getElementById('city_search_box').value;  
			const state		=	document.getElementById('state_search_box').value;  
			const country	=	document.getElementById('country_search_box').value;  

            var filters = {
				city: city,
				state: state,
				country: country,
            };
            sessionStorage.setItem('cities', JSON.stringify(filters));
           Dtable.draw();        
         
		}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
						city: "",
						state: "",
						country: "",
                     };
                     sessionStorage.setItem('cities', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('cities');
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
     
      var city = filters.city;
	  var state = filters.state;
	  var country = filters.country;
   
      $('#city_search_box').val(city);
	  $('#state_search_box').val(state);
	  $('#country_search_box').val(country);
	  if(city)
      {
		$('.city_search_filter').addClass("filter_active");
      }
	  if(state)
      {
		$('.state_search_filter').addClass("filter_active");
      }
	  if(country)
      {
		$('.country_search_filter').addClass("filter_active");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('cities'));

  // Check if sales_summary_seller_name has a value
  if (filters[argName] && filters[argName] !== "") {
    // Clear the remaining values while keeping the existing ticket_type_seller_name value
    filters[argName] = "";
    filters = {
		city: filters.city,
		state: filters.state,
		country: filters.country
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('cities', JSON.stringify(filters));
}

});
</script>