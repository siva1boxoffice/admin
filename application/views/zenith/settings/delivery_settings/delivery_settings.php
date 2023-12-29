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
            <div class="page-title dflex-between-center">
               <h3 class="mb-1">Delivery Type Lists</h3>

               <div class="float-sm-right mt-3 mt-sm-0 team_lists_bttn">
                  <a href="<?php echo base_url();?>settings/delivery_settings/add"  class="btn btn-success mb-2">Add Delivery Details</a>
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
                                             <button class="btn btn-light dropdown-toggle split_id_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Delivery Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="split_type" placeholder="Search in Filters..."
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
                     <table style='width:100% !important' id="delivery-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                        <tr>
                        <th>Delivery Name</th>
                        <th>Delivery Company</th>
                        <th>Cost</th>
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
   </div>
</div>
<!-- main content End -->

<?php $this->load->view(THEME.'common/footer'); ?>
<script>
	 $(document).ready(function () {
    var overlay = $('#overlay');
   var Dtable = $('#delivery-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         // 'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_delivery_list',
            data: function (d) {
               var statuss= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = statuss.length===0?'':',';

                              //   if(e.value == 0 ) e.value = 2
                                 statuss += (comma+e.value);
                        }
                     });

            var delivery_name = $("#split_type").val();
				d.delivery_name = delivery_name;
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
            { data: 'category' },
            { data: 'company' },
            { data: 'delivery_cost' },
			{ data: 'status' },
			{ data: 'action' },			
         ],
   });

   $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
		var dropdown = $(this).closest('.dropdown');
		var statusCount = dropdown.find(".check_box input:checked").length;
		$('.status_search_filter').text(statusCount + " Selected");
    //  applyFilters();
    Dtable.draw();    
      });

      $("body").on("click",".search_ok",function(){
			$('.split_id_search_filter').addClass("filter_active");
		//	applyFilters();
      Dtable.draw();    
          
       });


      function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  var ID = $(this).attr('id');
                  checkedIds.push(ID);
               });

            const delivery=document.getElementById('split_type').value;         
            const status=checkedIds;

            var filters = {
               split_type_split_type: split_type,
               split_type_status: checkedIds
            // ... Add other filters
            };
            sessionStorage.setItem('delivery_setting', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        split_type_split_type: "",
               			split_type_status: ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('split_type', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('split_type');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
     
      var split_type = filters.split_type_split_type;
      var status =filters.split_type_status;

      
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

   
      $('#split_type').val(split_type);
	  if(split_type)
      {
		$('.split_id_search_filter').addClass("filter_active");
      }

	  
      if (status && status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(status.length + " Selected");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('split_type'));

  // Check if sales_summary_seller_name has a value
  if (filters["split_type_" + argName] && filters["split_type_" + argName] !== "") {
    // Clear the remaining values while keeping the existing split_type_seller_name value
    filters["split_type_" + argName] = "";
    filters = {
      split_type_split_type: filters.split_type_split_type,
      split_type_status: filters.split_type_status,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('split_type', JSON.stringify(filters));
}

});
</script>