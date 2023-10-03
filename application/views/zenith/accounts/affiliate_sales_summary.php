<style>
 
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
               <h3 class="mb-1">Affiliate Sales Summary</h3>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 col-xl-3">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="media align-items-center">
                           <div class="media-body currency_status">
                              <p class="mb-2 font-weight-normal color_main">Total Sales in GBP</p>
                              <h4 class="mb-0 font-weight-bold"><span class="font-weight-bold mr-1">£</span>
                                 <!-- 1,842,081.35 -->
                                 <?php
                                 $cnt = count($getMySalesData_gbp);

                                 if ($cnt > 0) {
                                    echo $total_base_amount = number_format(array_sum(array_column($getMySalesData_gbp,'total_amount')),2);
                                    ?>
                                 </h4>
                                 <p class="mt-2 mb-1 no_orders font-12">No of Orders
                                    <span class="font-weight-normal mt-0 mb-0 font-10 color_main ml-3"><i
                                          class="bx bx-up-arrow-alt"></i>+
                                       <?php echo count($getMySalesData_gbp); ?>
                                    </span>
                                 </p>
                              <?php } else {
                                    echo '<h3>No Orders.</h3>';
                                 }
                                 ?>
                           </div>
                           <div class="text-center currency_symb pound">
                              <span class="pound font-weight-normal">£</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-xl-3">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="media align-items-center">
                           <div class="media-body currency_status">
                              <p class="mb-2 font-weight-normal color_main">Total Sales in EUR</p>
                              <?php if (count($getMySalesData_eur) > 0) { ?>
                                 <h4 class="mb-0 font-weight-bold"><span class="font-weight-bold mr-1">€</span>
                                    <?php  echo $total_base_amount = number_format(array_sum(array_column($getMySalesData_eur,'total_amount')),2); ?>
                                 </h4>
                                 <p class="mt-2 mb-1 no_orders font-12">No of Orders
                                    <span class="font-weight-normal mt-0 mb-0 font-10 color_main ml-3"><i
                                          class="bx bx-up-arrow-alt"></i>+
                                       <?php echo count($getMySalesData_eur);?>
                                    </span>
                                 </p>
                              <?php } else {
                                 echo '<h3>No Orders.</h3>';
                              } ?>
                           </div>
                           <div class="text-center currency_symb euro">
                              <span class="euro font-weight-normal">€</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-xl-3">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="media align-items-center">
                           <div class="media-body currency_status">
                              <p class="mb-2 font-weight-normal color_main">Total Sales in USD</p>
                              <?php if (count($getMySalesData_usd) > 0) { ?>
                                 <h4 class="mb-0 font-weight-bold"><span class="font-weight-bold mr-1">$</span>
                                    <?php echo $total_base_amount = number_format(array_sum(array_column($getMySalesData_usd,'total_amount')),2); ?>
                                 </h4>
                                 <p class="mt-2 mb-1 no_orders font-12">No of Orders
                                    <span class="font-weight-normal mt-0 mb-0 font-10 color_main ml-3"><i
                                          class="bx bx-up-arrow-alt"></i>+
                                       <?php echo count($getMySalesData_usd); ?>
                                    </span>
                                 </p>
                              <?php } else {
                                 echo '<h3>No Orders.</h3>';
                              } ?>
                           </div>
                           <div class="text-center currency_symb dollar">
                              <span class="dollar font-weight-normal">$</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-xl-3">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="media align-items-center">
                           <div class="media-body currency_status">
                              <p class="mb-2 font-weight-normal color_main">Total Sales</p>
                              <?php if(count($getMySalesData) > 0){?>
                                 <h4 class="mb-0 font-weight-bold"><span class="font-weight-bold mr-1">£</span>
                                 <?php echo $total_base_amount = number_format(array_sum(array_column($getMySalesData,'total_base_amount')),2);?>
                                 </h4>
                                 <p class="mt-2 mb-1 no_orders font-12">No of Orders
                                    <span class="font-weight-normal mt-0 mb-0 font-10 color_main ml-3"><i
                                          class="bx bx-up-arrow-alt"></i>+
                                          <?php echo count($getMySalesData);?>
                                    </span>
                                 </p>
                              <?php } else {
                                 echo '<h3>No Orders.</h3>';
                              } ?>
                           </div>
                           <div class="text-center currency_symb pounds">
                              <span class="pounds font-weight-normal">£</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-body">

                  <div class="section_all ticket_sort_approval filter_new">
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
                                             <button class="btn btn-light dropdown-toggle date_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Date <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <form class="px-3 py-2">
                                                   <div class="row">
                                                      <div class="col-md-6">
                                                         <div class="form-group datemark">
                                                            <input class="form-control" id="MyTextbox3" type="text"
                                                               name="MyTextbox" placeholder="From" autocomplete="off">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group datemark_to">
                                                            <input class="form-control" id="MyTextbox2" type="text"
                                                               name="MyTextbox1" placeholder="To" autocomplete="off"> 
                                                         </div>
                                                      </div>
                                                   </div>
                                                </form>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info reset_date">Reset</button></div>
                                                   <div class="reset_ok"><button
                                                         class="btn btn-info date_search">Search</button></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>

                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle order_id_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Order ID <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="booking_no" placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info order_reset">Reset</button></div>
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
                                                   <!-- <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                          <label class="custom-control-label" for="customCheck1">Arnab Gupta</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                          <label class="custom-control-label" for="customCheck2">Ali Wikilins</label>
                                                        </div> -->
                                                   <?php
                                                   echo $this->mydatas['html'];
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
                                    <!-- <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Ticket Category <i class="mdi mdi-chevron-down"></i>
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
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="">
                     <table style='width:100% !important' id="affiliate-sales-summary-datatable"
                        class="table table-hover table-nowrap mb-0 sales-summary-class">
                        <thead class="thead-light">
                           <tr>
                            <th>Order</th>
                            <th>Match Name</th>
                            <th>Seller Name</th>
                            <th>Customer Name</th>
                            <th>Transaction Date</th>
                            <th>Affiliate Name</th>
                            <th>QTY</th>                        
                            <th>Partner Fee</th>                        
                            <th>Total</th>
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
<?php $this->load->view(THEME . 'common/footer'); ?>
<script>
   $(document).ready(function () {
      $(document).on('click', '.order_status', function () {
  
    //  $('.order_status').on('click', function () {

         var orderId = $(this).attr('data-id');

         if ($(this).is(":checked")) {
            var seller_status = 1;
         }
         else {
            var seller_status = 0;
         }

         $.ajax({
            url: '<?= base_url() ?>game/orders/update_seller_status',
            method: 'post',
            data: { seller_status: seller_status, bg_id: orderId },
            dataType: 'json',
            success: function (data) {
               console.log('data', data);
               if (data.status == 1) {
                  swal('Updated !', data.msg, 'success');
                
               } else if (data.status == 0) {

                  swal('Updation Failed !', data.msg, 'error');
                
               }

               setTimeout(function () { window.location.reload(); }, 2000);

            }
         });

      });

      //dta  $('[data-toggle="tooltip"]').tooltip();

      $("body").on('click', '.dropdown-menu-custom .check_box, .seat_category_check_box', function (e) {
         //    alert('dd');
         e.stopPropagation();
      });

      
      var overlay = $('#overlay');
      var Dtable = $('#affiliate-sales-summary-datatable').DataTable({
         'info': false,
         //'processing': true,
         'scrollX': !0,
         'serverSide': true,
         'serverMethod': 'post',
         "pageLength" : 50,
         "ajax": {
            url: base_url + 'accounts/get_affiliate_sales_summary',
            data: function (d) {

               var booking_no = $("#booking_no").val();



               var seller_name = '';

               var event_name = $("#event_name").val();
               var fromDate = document.getElementById('MyTextbox3').value;
               var toDate = document.getElementById('MyTextbox2').value;

               var checkedIds = [];
               $(".check_box input:checked").each(function () {

                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");

                  checkedIds.push(newID);
               });


               var seatIds = [];
               $(".seat_category_check_box input:checked").each(function () {

                  var ID = $(this).attr('id');
                  var newID = ID.replace("seatCheck", "");

                  seatIds.push(newID);
               });


               d.booking_no = booking_no;
               d.seller_name = checkedIds;
               d.seat = seatIds;
               d.event = event_name;
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
         "targets": 'no-sort',
         "bSort": false,
         //"paging":false,
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
        //    loadingRecords: '&nbsp;',
          //  processing: 'Loading...'
               processing: false
         },
         drawCallback: function () {
            // $(".dataTables_paginate").addClass("page-link"),
            // $(".dataTables_paginate  .paginate_button").addClass("page-link")
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")

            // Initialize tooltips after DataTable setup
            toolTipShow();

         },
         'columns': [
            { data: 'booking_no' },
            { data: 'evernt_name' },
            { data: 'seller_name' },
            { data: 'customer_name' },
            { data: 'transaction_date' },          
            { data: 'partner_name' },
            { data: 'quantity' },
            { data: 'partner_fee' },
            { data: 'total' },

         ]
      });

      $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
        // Dtable.draw();
        applyFilters();
      });

      $('.search_ok').on('click', function (e) {
         $('.order_id_search_filter').addClass("filter_active");
        // Dtable.draw();
        applyFilters();
      });


      $('.seller_search').on('click', function (e) {
         $('.seller_name_btn').addClass("filter_active");
         //Dtable.draw();
         applyFilters();
      });

      $('.ticket_ctgry').on('click', function (e) {
         $('.ticket_category_btn').addClass("filter_active");
        // Dtable.draw();
        applyFilters();
      });

      $('.clear_all').click(function () {
         resetFilters();
         $('.date_search_filter').removeClass("filter_active");
         $('.order_id_search_filter').removeClass("filter_active");
         $('.seller_name_btn').removeClass("filter_active");
         $('.event_name_filter').removeClass("filter_active");
         $('.ticket_category_btn').removeClass("filter_active");
         
               
         $("#booking_no").val('');
         $("#seller_name").val('');
         $("#event_name").val('');
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('.seller_reset').trigger('click');
         $('.category_reset').trigger('click');

         // trigger your desired action here
         //  Dtable.draw();

      });

      $(".check_box").change(function () {
         var checkedCount = $('.check_box input:checked').length;

         if (checkedCount > 0) {
            $('.seller_name_btn').text(checkedCount + " Selected");
         }
         else
            $('.seller_name_btn').text("Seller Name");

      });

      $(".seat_category_check_box").change(function () {
         var checkedCount = $('.seat_category_check_box input:checked').length;

         if (checkedCount > 0) {
            $('.ticket_category_btn').text(checkedCount + " Selected");
         }
         else
            $('.ticket_category_btn').text("Ticket Category");

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

      $("#ticket_category").keyup(function () { // Bind to the keyup event of the textbox

         var searchText = $(this).val(); // Get the text entered in the textbox
         $.ajax({
            url: base_url + 'accounts/get_ticket_category',
            type: "POST",
            cache: false,
            data: { search_text: searchText }, // Pass the search text to the PHP script
            success: function (response) {
               $(".seat_category_check_box").html(response); // Bind the response data to the checkbox container
               Dtable.draw();
            }
         });
      });


      $('.reset_date').click(function () { 
         $('.date_search_filter').removeClass("filter_active");
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         updateFilters("fromDate");
         updateFilters("toDate");
         Dtable.ajax.reload();
         $('.dropdown-menu-custom').removeClass('show');
         $('.dropdown').removeClass('show');         
      });

      $('.order_reset').click(function () {          
         $('.order_id_search_filter').removeClass("filter_active");
         $("#booking_no").val(''); // clear selected date value
         updateFilters("booking_no");
         Dtable.ajax.reload(); 
      });

      $('.event_reset').click(function () {          
         $('.event_name_filter').removeClass("filter_active");
         $("#event_name").val(''); // clear selected date value
         updateFilters("event_name");
         Dtable.ajax.reload(); 
      });      
     
      $('.seller_reset').click(function () {    

         updateFilters("seller_name");
         
         $('.seller_name_btn').removeClass("filter_active");
         $('.seller_name_btn').text("Seller Name");
         $("#seller_name").val('');
         $('.check_box input:checked').removeAttr('checked');
         $('#seller_name').trigger('keyup');
         // 
      });


      $('.category_reset').click(function () {

         updateFilters("ticket_category");       

         $('.ticket_category_btn').text("Ticket Category");
         $('.ticket_category_btn').removeClass("filter_active");
         $("#ticket_category").val('');
         $('.seat_category_check_box input:checked').removeAttr('checked');
         $('#ticket_category').trigger('keyup');
         // 
      });
      // Get the datepicker input element
      const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
         // onSelect: function (datesel) {
         //    $('#MyTextbox2').trigger('change')
         // }, maxDate: new Date()
         dateFormat: 'dd-mm-yy',
         changeMonth:true,
         changeYear:true,
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd-mm-yy',
            changeMonth:true,
         changeYear:true, }
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

         applyFilters();

        

      });


      function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {

                  var ID = $(this).attr('id');
                //  var newID = ID.replace("customCheck", "");

                  checkedIds.push(ID);
               });

               var seatIds = [];
               $(".seat_category_check_box input:checked").each(function () {

                  var new_seat = $(this).attr('id');
                //  var new_seat_ID = new_seat.replace("seatCheck", "");

                  seatIds.push(new_seat);
               });

            const fromDate = document.getElementById('MyTextbox3').value;
            const toDate = document.getElementById('MyTextbox2').value;
            const booking_no=document.getElementById('booking_no').value;
            const event_name=document.getElementById('event_name').value;            
            const seller_name=checkedIds;
            const ticket_category=seatIds;

            var filters = {
               sales_summary_fromDate: fromDate,
               sales_summary_toDate: toDate,
               sales_summary_booking_no: booking_no,
               sales_summary_event_name: event_name,
               sales_summary_seller_name: seller_name,
               sales_summary_ticket_category: ticket_category
            // ... Add other filters
            };
            sessionStorage.setItem('filters', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        sales_summary_fromDate           :     "",
                        sales_summary_toDate             :     "",
                        sales_summary_booking_no         :     "",
                        sales_summary_seller_name        :     "",
                        sales_summary_event_name         :     "",
                        sales_summary_ticket_category    :     ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('filters', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('filters');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var fromDateValue = filters.sales_summary_fromDate;
      var toDateValue = filters.sales_summary_toDate;
      var booking_no = filters.sales_summary_booking_no;
      var event_name = filters.sales_summary_event_name;
      var seller_name =filters.sales_summary_seller_name;
      var ticket_category =filters.sales_summary_ticket_category;

      
$(".seat_category_check_box input[type='checkbox'], .custom-checkbox input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.seat_category_check_box').length) {
    // Checkbox belongs to the seat category group
    if (ticket_category.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } else if ($(this).closest('.custom-checkbox').length) {
    // Checkbox belongs to the seller name group
    if (seller_name.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
});

      $('#MyTextbox3').val(fromDateValue);
      $('#MyTextbox2').val(toDateValue);
      $('#booking_no').val(booking_no);
      $('#event_name').val(event_name);

      if ((fromDateValue && toDateValue)) {
         $('.date_search_filter').addClass("filter_active");
      }
      if(booking_no)
      {
         $('.order_id_search_filter ').addClass("filter_active");
      }
      if(event_name)
      {
         $('.event_name_filter ').addClass("filter_active");
      }      
      if (seller_name && seller_name.length > 0) {
         $('.seller_name_btn').addClass("filter_active");
         $('.seller_name_btn').text(seller_name.length + " Selected");
      }
      if (ticket_category && ticket_category.length > 0) {
         $('.ticket_category_btn').addClass("filter_active");
         $('.ticket_category_btn').text(ticket_category.length + " Selected");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('filters'));

  // Check if sales_summary_seller_name has a value
  if (filters["sales_summary_" + argName] && filters["sales_summary_" + argName] !== "") {
    // Clear the remaining values while keeping the existing sales_summary_seller_name value
    filters["sales_summary_" + argName] = "";
    filters = {
      sales_summary_fromDate: filters.sales_summary_fromDate,
      sales_summary_toDate: filters.sales_summary_toDate,
      sales_summary_booking_no: filters.sales_summary_booking_no,
      sales_summary_event_name: filters.sales_summary_event_name,
      sales_summary_ticket_category: filters.sales_summary_ticket_category,
      sales_summary_seller_name: filters.sales_summary_seller_name,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('filters', JSON.stringify(filters));
}


   });
   function toolTipShow() {
      //$('[data-toggle="tooltip"]').tooltip();

      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
         return new bootstrap.Tooltip(tooltipTriggerEl)
      })


   }

  

</script>