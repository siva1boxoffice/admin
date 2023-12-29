<style>
.check_box_status {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.markup_type_check_box {
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
               <h3 class="mb-1"><?php echo $heading; ?> Markup Lists</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <a href='<?php echo base_url()."settings/seller_settings/add_".trim(strtolower($heading))."_settings"?>'  class="btn btn-success mb-2">Add <?php echo $heading; ?> Markup</a>
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
                                             <button class="btn btn-light dropdown-toggle ticket_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                User Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="user" placeholder="Search in Filters..."
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
                                             <button class="btn btn-light dropdown-toggle markup_type_filter" data-name="markup_type" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Markup Type <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="markup_type_check_box">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input markup_type" id="markup_type1" name="markup_type[]" value="TO_CUSTOMER">
                                                    <label class="custom-control-label" for="markup_type1">To Customer</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input markup_type" id="markup_type0" name="markup_type[]" value="TO_SELLER">
                                                    <label class="custom-control-label" for="markup_type0">To Seller</label>
                                                  </div>

                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input markup_type" id="markup_type2" name="markup_type[]" value="TO_PARTNER">
                                                    <label class="custom-control-label" for="markup_type2">To Partner</label>
                                                  </div>

                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input markup_type" id="markup_type3" name="markup_type[]" value="TO_AFFILIATE">
                                                    <label class="custom-control-label" for="markup_type3">To Affiliate</label>
                                                  </div>
                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info markup_type_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info markup_type_search">Search</button></div>
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
                     <table style='width:100% !important' id="markup-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>User</th>
                              <th>Markup Type</th>
                              <th>Markup</th>
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
   var Dtable = $('#markup-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         // 'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_afliliate_markup_list',
            data: function (d) {
				var user = $("#user").val();
				var statuss= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = statuss.length===0?'':',';

                              //   if(e.value == 0 ) e.value = 2
                                 statuss += (comma+e.value);
                        }
                     });

                     var markup_type= '';
                     $('.markup_type').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = markup_type.length===0?'':',';
                                 markup_type += (comma+e.value);
                        }
                     });
            d.role='<?php echo $role?>';
				d.user = user;
				d.status=statuss;
            d.markup_type=markup_type;
            
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
            { data: 'user' },
            { data: 'markup_type' },
            { data: 'markup' },
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
        $('.dropdown-menu-custom .markup_type_check_box').click(function(e){
            e.stopPropagation();
        });
        

        $('.country_search').on('click', function (e) {
         $('.country_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });


      $(".clear_all").on('click', function(){
	
          $('.status_search_filter').removeClass("filter_active");
          $('.status_search_filter ').text("Status");  
		  $('.ticket_search_filter').removeClass("filter_active");
        $('.markup_type_filter').removeClass("filter_active");
        $('.markup_type_filter ').text("Markup Type");
         
		  $('#user').val('');
          //$(".check_box").prop('checked', false);
          $('.check_box input:checked').prop('checked', false);
          $(".status").prop('checked', false);
          $('.markup_type_check_box input:checked').prop('checked', false);
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

      $('.markup_type_search').on('click', function (e) {
         $('.markup_type_filter').addClass("filter_active");
		var dropdown = $(this).closest('.dropdown');
		var statusCount = dropdown.find(".markup_type_check_box input:checked").length;
		$('.markup_type_filter').text(statusCount + " Selected");
     applyFilters();
     Dtable.ajax.reload();
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
			$('.ticket_search_filter').addClass("filter_active");
			applyFilters();
			//Dtable.ajax.reload();
       });

	   $("body").on("click",".split_reset",function(){
         $('.ticket_search_filter').removeClass("filter_active");
		 $('#user').val('');
          updateFilters("user");
            Dtable.ajax.reload();
         });        

         $("body").on("click",".markup_type_reset",function(){
         $('.markup_type_filter').removeClass("filter_active");
        $(".markup_type_check_box .custom-checkbox input").prop('checked', false);

		var checkedCount = $('.markup_type_check_box input:checked').length;
		if (checkedCount > 0) {
            $('.markup_type_filter').text(checkedCount + " Selected");
         }
         else
            $('.markup_type_filter').text("Markup Type");

		
         updateFilters("markuptype");
            Dtable.ajax.reload();
         });

		 function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  var ID = $(this).attr('id');
                  checkedIds.push(ID);
               });

               var markedcheckedIds = [];
               $(".markup_type_check_box input:checked").each(function () {
                  var ID = $(this).attr('id');
                  markedcheckedIds.push(ID);
               });

            const user=document.getElementById('user').value;    
            const markuptype=markedcheckedIds;     
            const status=checkedIds;

            var filters = {
               markup_user: user,
               markup_status: checkedIds,
               markup_markuptype: markedcheckedIds
            // ... Add other filters
            };
            console.log(filters)
            
            sessionStorage.setItem('<?php echo trim(strtolower($heading))."_";?>'+'markup_type', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        markup_user: "",
                        markup_status: "",
                        markup_markuptype: ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('<?php echo trim(strtolower($heading))."_";?>'+'markup_type', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('<?php echo trim(strtolower($heading))."_";?>'+'markup_type');
console.log(storedFilters);
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
     
      var user = filters.markup_user;
      var status =filters.markup_status;
      var markuptype =filters.markup_markuptype;
      console.log("ddddddddddd :"+markuptype);
$(".markup_type_check_box input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.markup_type_check_box').length) {
    // Checkbox belongs to the seat category group
    if (markuptype.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } 
});

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

   
      $('#user').val(user);
	  if(user)
      {
		$('.ticket_search_filter').addClass("filter_active");
      }

	  
      if (status && status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(status.length + " Selected");
      }

      if (markuptype && markuptype.length > 0) {
         $('.markup_type_filter').addClass("filter_active");
         $('.markup_type_filter').text(markuptype.length + " Selected");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('<?php echo trim(strtolower($heading))."_";?>'+'markup_type'));
console.log(argName);
  // Check if sales_summary_seller_name has a value
  if (filters["markup_" + argName] && filters["markup_" + argName] !== "") {
    // Clear the remaining values while keeping the existing markup_seller_name value
    filters["markup_" + argName] = "";
    filters = {
      markup_markup_user: filters.markup_user,
      markup_status: filters.markup_status,
      markup_markuptype: filters.markup_markuptype,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('<?php echo trim(strtolower($heading))."_";?>'+'markup_type', JSON.stringify(filters));
}
});
</script>