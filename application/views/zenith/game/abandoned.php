<style>
    .check_box,.seat_category_check_box {
    max-height: 250px;
    overflow-y: auto;
}

</style>
<?php $this->load->view(THEME . 'common/header'); ?>

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
					 <h3 class="mb-1">Abondanned Cart List</h3>

				  </div>
			   </div>
			</div>
			<!-- page content -->
			<div class="page-content-wrapper mt--45">
			   <div class="container-fluid">
				  <div class="card">
					 <div class="card-body">

						<div class="section_all abondanned_cart filter_new">
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
                                                   <button class="btn btn-light dropdown-toggle date_search_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Date <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">                                                  
                                                   <form class="px-3 py-2">
                                                            <div class="row">
                                                               <div class="col-md-6">
                                                                  <div class="form-group datemark">
                                                                     <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-6">
                                                                  <div class="form-group datemark_to">
                                                                     <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To">
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </form>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info date_search">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
										  <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle event_name_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Event Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" id="event_name" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
										  <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle cust_name_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Customer Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" id="seller_name" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info cust_name_filter_btn">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
										  <li class="sort_list">
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button class="btn btn-light dropdown-toggle country_name_btn" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Country<i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                        <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                        <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="country"></label></div>
                                                    </div>
                                                    <div class="check_box">
                                                        
                                                        <?php 
                                                            echo $this->data['country'];
                                                        ?>
                                                        </div>
                                                        <div class="reset_btn">
                                                        <div class="reset_txt"><button class="btn btn-info country_reset" >Reset</button></div>
                                                        <div class="reset_ok"><button class="btn btn-info country_search">Search</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </li>

											<li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle status_type_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Status <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter">
                                                         <!-- <label class="search-box d-inline-flex position-relative">Search:
                                                          <input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="status_type"> 
                                                      </label>-->
                                                   </div>
                                                   </div>
                                                     
                                                      <!-- <div class="seat_category_check_box"> -->
                                                      <div class="" style="padding: 0 15px; margin-top: 15px; margin-bottom: 15px;">
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="status1">
                                                          <label class="custom-control-label" for="status1">ABONDANNED</label>
                                                        </div>
                                                        
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info status_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info status_type_search">Search</button></div>
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
												   Status <i class="mdi mdi-chevron-down"></i>
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
										  <a class="clear_all" href="javascript:void(0)">Clear All</a>
										  </li>
										  <li class="sort_list">
											 <a class="report_sts" href="">Search</a>
										  </li>
									   </ul>
									</div>
								 </div>
							  </div>
						   </div>
						</div>

						<div class="table-responsive">
						   <table style='width:100% !important' id="abondanned-datatable" class="table table-hover table-nowrap mb-0">
							  <thead class="thead-light">
							  <tr>
								<th>Order</th>
								<th>Event Name</th>
								<th>Customer Name</th>
								<th>Country</th>
								<th>Qty</th>
								<th>Price</th>
								<th>Date</th>
								<th>Status</th>
								<th>&nbsp;</th>
                           </tr>
							  </thead>
							  <tbody>
								 <!-- <tr>
									<td>1BX04012</td>  
									<td>Manchester United Vs Leicester City FC<br>
									   United Kingdom, Manchester<br>
									   <span class="tr_date"> 14/05/2023</span>  <span class="tr_date">15:00 PM</span>
									</td>                               
									<td>Daphenie Wolters</td>
									<td>United Kingdom</td>
									<td>4</td>
									<td>3750.00</td>                                 
									<td>22 January 2023<br>
									   19:45:35 GMT+05:30
									</td>
									<td>
									   <div class="bttns">
										  <span class="badge badge-danger">Abondanned</span>
									   </div>
									</td>
									<td>
									   <div class="dropdown">
										  <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
											 <i class="mdi mdi-dots-vertical fs-sm"></i>
										  </a>
										  <div class="dropdown-menu dropdown-menu-right">
											 <a href="#" class="dropdown-item">View</a>
										  </div>
									   </div>
									</td>
								 </tr> -->
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
<?php $this->load->view(THEME . 'common/footer'); ?>

<script type="text/javascript">
   $(document).ready(function () {

	$("body").on('click','.dropdown-menu-custom .check_box, .seat_category_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});

      var overlay = $('#overlay');
      var Dtable = $('#abondanned-datatable').DataTable({
         'info': false,
        // 'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         "pageLength" : 50,
         "ajax": {
            url: base_url + 'game/get_abondanned_items',
            data: function (d) {

			var fromDate = document.getElementById('MyTextbox3').value;
			var toDate = document.getElementById('MyTextbox2').value;
			var event_name = $("#event_name").val();
			var seller_name = $("#seller_name").val();

			var countryIds = [];
               $(".check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("country", "");     

                  countryIds.push(newID);
               });

			   d.country = countryIds;

			d.start_date = fromDate;
			d.end_date = toDate;
			d.event_name = event_name;
			d.seller_name = seller_name;
             
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
         "targets": 'no-sort',
         "bSort": false,
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
            loadingRecords: '&nbsp;',
            processing: 'Loading...'
         },
         drawCallback: function () {
            // $(".dataTables_paginate").addClass("page-link"),
            // $(".dataTables_paginate  .paginate_button").addClass("page-link")
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
         'columns': [
            { data: 'booking_no' },
            { data: 'event_name' },
            { data: 'buyer' },
            { data: 'country' },
            { data: 'qty' },
            { data: 'total' },
            { data: 'abnd_date' },
            { data: 'status' },
			{ data: 'action' }
         ]
      });

      $('.search_ok').on('click', function (e) {
         Dtable.draw();
      });

      $('.cust_name_filter_btn').on('click', function (e) {
         $('.cust_name_filter').addClass("filter_active");
         Dtable.draw();
      });
      

      $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         Dtable.draw();
      });

      $('.reset_txt').click(function () {
        
         $("#seller_name").val('');
         $("#event_name").val('');
        //  $('#order-status-hidden').data('status-hidden', "");
        //  $('#shipping-status-hidden').data('shipping-status-hidden', "");
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
        //  // trigger your desired action here
         Dtable.draw();

      });


	   // Get the datepicker input element
	   const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
         // onSelect: function (datesel) {
         //    $('#MyTextbox2').trigger('change')
         // }, maxDate: new Date()
          dateFormat: 'dd-mm-yy' 
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd-mm-yy' }
      );

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

         Dtable.draw();

      });


	  $('.clear_all').click(function () {

         $('.date_search_filter').removeClass("filter_active");
         $('.event_name_filter').removeClass("filter_active");
         $('.cust_name_filter').removeClass("filter_active");
         $('.country_name_btn').removeClass("filter_active");
         $('.status_type_btn').removeClass("filter_active");

        //  $("#booking_no").val('');
          $("#seller_name").val('');
          $("#event_name").val('');        
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('.country_reset').trigger('click');
         $('.status_reset').trigger('click');
         
         // trigger your desired action here
        Dtable.draw();

      });

	  $("#country").keyup(function() { // Bind to the keyup event of the textbox
                var searchText = $(this).val(); // Get the text entered in the textbox
                    $.ajax({
                        url: base_url + 'settings/get_country_name',
                        type: "POST",
                        data: { search_text: searchText }, // Pass the search text to the PHP script
                        success: function(response) {
                        $(".check_box").html(response); // Bind the response data to the checkbox container
                        Dtable.draw();
                        }
                    });     
                });

				$('.country_search').on('click', function (e) {
               
               $('.country_name_btn').addClass("filter_active");

                Dtable.draw();
                });

				$('.country_reset').click(function () {
               $('.country_name_btn').removeClass("filter_active");
                $('.country_name_btn').text("Country");  
                $("#country").val('');
                $('.checkbox input:checked').removeAttr('checked');
                $('#country').trigger('keyup');    
             });

			 $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.country_name_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.country_name_btn').text("Country");  
            
         }); 

		

		 $('.status_type_search').on('click', function (e) {
         
         $('.status_type_btn').addClasss("filter_active");
                Dtable.draw();
                });

				$('.status_reset').click(function () {
               $('.status_type_btn').removeClass("filter_active");
                $('.status_type_btn').text("Status");  
                $("#status_type").val('');
                $('.seat_category_check_box input:checked').removeAttr('checked');
                $('#status_type').trigger('keyup');    
             });
			 
			 $(".seat_category_check_box").change(function() { 
         var checkedCount = $('.seat_category_check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.status_type_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.status_type_btn').text("Status");  
            
         });
		 
		

		 $("#status_type").keyup(function() { // Bind to the keyup event of the textbox
                var searchText = $(this).val(); // Get the text entered in the textbox
                $.ajax({
                    url: base_url + 'game/get_status_type',
                    type: "POST",
                    data: { search_text: searchText }, // Pass the search text to the PHP script
                    success: function(response) {
                    $(".seat_category_check_box").html(response); // Bind the response data to the checkbox container
                    Dtable.draw();
                    }
                });     
             });


   });
</script>

<?php exit; ?>
