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
               <h3 class="mb-1">Ticket Type Lists</h3>
            </div> -->
            <div class="page-title dflex-between-center">
               <h3 class="mb-1">API Lists</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <a href="<?php echo base_url(); ?>api/api_key_settings/add_setting"  class="btn btn-success mb-2">Add API</a>
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
                                             <button class="btn btn-light dropdown-toggle api_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Partner <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="partner_name" placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info split_reset">Reset</button></div>
                                                   <div class="reset_ok"><button
                                                         class="btn btn-info search_ok">Search</button></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>

                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle seller_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Seller <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="seller_name" placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info split_seller_reset">Reset</button></div>
                                                   <div class="reset_ok"><button
                                                         class="btn btn-info search_seller_ok">Search</button></div>
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
                     <table style='width:100% !important' id="api-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Partner Name</th>                              
                              <th>Seller Name</th>                              
                              <th>API Key</th>
                              <th>Status</th>
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
   var Dtable = $('#api-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'api/get_api_list',
            data: function (d) {
				//var ticket_type = $("#ticket_type").val();
            var partner_name = $("#partner_name").val();
            var seller_name = $("#seller_name").val();
            
				var statuss= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = statuss.length===0?'':',';

                              //   if(e.value == 0 ) e.value = 2
                                 statuss += (comma+e.value);
                        }
                     });

            d.partner_name = partner_name;
            d.seller_name = seller_name;
				d.status=statuss;
            
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
            { data: 'partner_name' },
            { data: 'seller_name' },
            { data: 'api_key' },
            { data: 'status' },
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
		  $('.api_search_filter').removeClass("filter_active");
		  $('.seller_search_filter').removeClass("filter_active");
		  $('#partner_name').val('');
		  $('#seller_name').val('');
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

	  $("body").on("click",".status_reset",function(){
         $('.status_search_filter').removeClass("filter_active");
        $(".check_box .custom-checkbox input").prop('checked', false);

		var checkedCount = $('.check_box input:checked').length;
		if (checkedCount > 0) {
            $('.status_search_filter').text(checkedCount + " Selected");
         }
         else
            $('.status_search_filter').text("Status");

		
         updateFilters("status");
            Dtable.ajax.reload();
         });

		 $("body").on("click",".search_ok",function(){
			$('.api_search_filter').addClass("filter_active");
			applyFilters();
			//Dtable.ajax.reload();
       });
		 
       $("body").on("click",".search_seller_ok",function(){
			$('.seller_search_filter').addClass("filter_active");
			applyFilters();
			//Dtable.ajax.reload();
       });

	   $("body").on("click",".split_reset",function(){
         $('.api_search_filter').removeClass("filter_active");
		 $('#partner_name').val('');
          updateFilters("partner_name");
            Dtable.ajax.reload();
         });
	   
         $("body").on("click",".split_seller_reset",function(){
         $('.seller_search_filter').removeClass("filter_active");
		 $('#seller_name').val('');
          updateFilters("seller_name");
            Dtable.ajax.reload();
         });

		 function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  var ID = $(this).attr('id');
                  checkedIds.push(ID);
               });

               const partner_name=document.getElementById('partner_name').value;         
               const seller_name=document.getElementById('seller_name').value;         
            const status=checkedIds;

            var filters = {
               partner_name: partner_name,
               seller_name: seller_name,
               status: checkedIds
            // ... Add other filters
            };
            sessionStorage.setItem('API', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        partner_name: "",
                        seller_name: "",
                        status: ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('API', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('API');
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
     
      var partner_name = filters.partner_name;
      var seller_name = filters.seller_name;
      var status =filters.status;
      
$(".check_box input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.check_box').length) {
    // Checkbox belongs to the seat category group
    if (status.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } 
});

$('#partner_name').val(partner_name);
	  if(partner_name)
      {
		$('.api_search_filter').addClass("filter_active");
      }

      $('#seller_name').val(seller_name);
	  if(seller_name)
      {
		$('.seller_search_filter').addClass("filter_active");
      }

	  
      if (status && status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(status.length + " Selected");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('API'));

  // Check if sales_summary_seller_name has a value
  if (filters[argName] && filters[argName] !== "") {
    // Clear the remaining values while keeping the existing ticket_type_seller_name value
    filters[argName] = "";
    filters = {
      partner_name: filters.partner_name,
      seller_name: filters.seller_name,
        status: filters.status,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('API', JSON.stringify(filters));
}
});
</script>