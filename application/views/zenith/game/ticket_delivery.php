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
               <h3 class="mb-1">Ticket Delivery</h3>
               <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                  <a href="<?php  echo $url = htmlspecialchars($_SERVER['HTTP_REFERER']); ?>" class="btn btn-primary mb-2">Back</a>
               </div>
             </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">
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
                                             <button class="btn btn-light dropdown-toggle customer_name_search_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Customer Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="customer_name" placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button
                                                         class="btn btn-info customer_reset">Reset</button></div>
                                                   <div class="reset_ok"><button
                                                         class="btn btn-info customer_name_search">Search</button></div>
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
                     <table style='width:100% !important' id="ticket-delivery-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                        <tr>
                            <th>Order</th>
                            <th>Customer Name</th>
                            <th>Seller Name</th>
                            <th>Event</th>
                            <th>Tickets Qty</th>
                            <th>Pending</th>
                            <th>Uploaded</th>
                            <th>Downloaded</th>
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
   var Dtable = $('#ticket-delivery-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         // 'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         autoWidth: false,
         "ajax": {
            url: base_url + 'game/get_ticket_delivery_list',
            data: function (d) {
              var booking_no = $("#booking_no").val();
              var customer_name = $("#customer_name").val();
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
              d.customer_name = customer_name;
              d.seller_name = checkedIds;
              d.seat = seatIds;
              d.event = event_name;
              d.event_start_date = fromDate;
              d.event_end_date = toDate;
            
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
            { data: 'booking_no' },
            { data: 'customer' },
            { data: 'seller' },
            { data: 'event' },
            { data: 'quantity' },
            { data: 'pending' },
            { data: 'uploaded' },
            { data: 'downloaded' },		
         ],
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

      $('.customer_name_search').on('click', function (e) {
         $('.customer_name_search_filter').addClass("filter_active");
       // Dtable.draw();
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
         $('.customer_name_search_filter').removeClass("filter_active");
        
         $("#booking_no").val('');
         $("#customer_name").val(''); 
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

      $('.customer_reset').click(function () {          
         $('.customer_name_search_filter').removeClass("filter_active");
         $("#customer_name").val(''); // clear selected date value
         updateFilters("customer_name");
         //Dtable.ajax.reload(); 
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
            const customer_name=document.getElementById('customer_name').value;            
            const event_name=document.getElementById('event_name').value;            
            const seller_name=checkedIds;
            const ticket_category=seatIds;

            var filters = {
               ticket_delivery_fromDate: fromDate,
               ticket_delivery_toDate: toDate,
               ticket_delivery_booking_no: booking_no,
               ticket_delivery_customer_name: customer_name,
               ticket_delivery_event_name: event_name,
               ticket_delivery_seller_name: seller_name,
               ticket_delivery_ticket_category: ticket_category
            // ... Add other filters
            };
            sessionStorage.setItem('ticket_delivery', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        ticket_delivery_fromDate           :     "",
                        ticket_delivery_toDate             :     "",
                        ticket_delivery_booking_no         :     "",
                        ticket_delivery_customer_name      :     "",
                        ticket_delivery_seller_name        :     "",
                        ticket_delivery_event_name         :     "",
                        ticket_delivery_ticket_category    :     ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('ticket_delivery', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('ticket_delivery');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var fromDateValue = filters.ticket_delivery_fromDate;
      var toDateValue = filters.ticket_delivery_toDate;
      var booking_no = filters.ticket_delivery_booking_no;
      var customer_name = filters.ticket_delivery_customer_name;
      var event_name = filters.ticket_delivery_event_name;
      var seller_name =filters.ticket_delivery_seller_name;
      var ticket_category =filters.ticket_delivery_ticket_category;

      
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
      $('#customer_name').val(customer_name);
      $('#event_name').val(event_name);

      if ((fromDateValue && toDateValue)) {
         $('.date_search_filter').addClass("filter_active");
      }
      if(booking_no)
      {
         $('.order_id_search_filter ').addClass("filter_active");
      }
      if(customer_name)
      {
         $('.customer_name_search_filter ').addClass("filter_active");
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
  var filters = JSON.parse(sessionStorage.getItem('ticket_delivery'));

  // Check if sales_summary_seller_name has a value
  if (filters["ticket_delivery_" + argName] && filters["ticket_delivery_" + argName] !== "") {
    // Clear the remaining values while keeping the existing ticket_delivery_seller_name value
    filters["ticket_delivery_" + argName] = "";
    filters = {
      ticket_delivery_fromDate: filters.ticket_delivery_fromDate,
      ticket_delivery_toDate: filters.ticket_delivery_toDate,
      ticket_delivery_booking_no: filters.ticket_delivery_booking_no,
      ticket_delivery_customer_name: filters.ticket_delivery_customer_name,
      ticket_delivery_event_name: filters.ticket_delivery_event_name,
      ticket_delivery_ticket_category: filters.ticket_delivery_ticket_category,
      ticket_delivery_seller_name: filters.ticket_delivery_seller_name,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('ticket_delivery', JSON.stringify(filters));
}
});
</script>