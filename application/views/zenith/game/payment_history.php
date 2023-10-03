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
               <h3 class="mb-1">Payment History</h3>
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
                                                   <button class="btn btn-light dropdown-toggle order_id_search_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Order ID <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" name="booking_no" id="booking_no" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info reset_order">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info search_ok">Search</button></div>
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
                                            Payment Status <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box_status">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status1" name="payment_status[]" value="1">
                                                    <label class="custom-control-label" for="status1">Success</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status2" name="payment_status[]" value="2">
                                                    <label class="custom-control-label" for="status2">Pending</label>
                                                  </div>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status0" name="payment_status[]" value="0">
                                                    <label class="custom-control-label" for="status0">Failed</label>
                                                  </div>
                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info reset_status">Reset</button></div>
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
                     <table style='width:100% !important' id="payment-history-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Order</th>
                              <th>Customer Name</th>
                              <th>Event Name</th>
                              <th>Payment Type</th>
                              <th>Customer Email</th>
                              <th>Transaction ID</th>
                              <th>Total Payment</th>
                              <th>Transaction Date</th>
                              <th>Payment Status</th>
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

<?php $this->load->view(THEME.'common/footer'); ?>
<script>
	 $(document).ready(function () {
    var overlay = $('#overlay');
   var Dtable = $('#payment-history-list').DataTable({
         'info': false,
         'serverSide': true,
		 'scrollX': !0,
         'serverMethod': 'post',
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'game/get_payment_history',
            data: function (d) {
               var booking_no = $("#booking_no").val();

               var status = [];
               $(".check_box_status input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("status", "");     

                  status.push(newID);
               });

               d.booking_no = booking_no;
               d.status = status;
            
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
            { data: 'booking_no' },
            { data: 'name' },
            { data: 'event' },
            { data: 'payment_type' },
            { data: 'email' },
			{ data: 'transcation_id' },			
            { data: 'total_payment' },
            { data: 'transaction_date' },
            { data: 'payment_status' },
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

        $('.teams_search').on('click', function (e) {
         $('.teams_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

      $('.reset_order').click(function () {          
         $('.order_id_search_filter').removeClass("filter_active");
         $("#booking_no").val(''); // clear selected date value
         updateFilters("booking_no");
         Dtable.ajax.reload(); 
      });

      $('.reset_status').click(function () {          
         $('.status_search_filter').removeClass("filter_active");
         $(".status").prop('checked', false); // clear selected date value
         updateFilters("payment_status");
         $('.status_search_filter').text("Payment Status");
         Dtable.ajax.reload(); 
      });

      $(".clear_all").on('click', function(){
          resetFilters();
          $('.teams_search_filter').removeClass("filter_active");
          $('.status_search_filter').removeClass("filter_active");
          $('.teams_search_filter ').text("Teams Name");
          $('.status_search_filter ').text("Status");  
          $(".teams_id").prop('checked', false);
          $(".status").prop('checked', false);
          $('.order_id_search_filter').removeClass("filter_active");
          $("#booking_no").val('');
          Dtable.ajax.reload();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
        applyFilters();
      });

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.teams_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.teams_search_filter ').text("Seller Name");  
            
         });  

         $(".check_box_status").change(function() { 
         var checkedCount = $('.check_box_status input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.status_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.status_search_filter ').text("Payment Status");  
            
         });  

         $('.search_ok').on('click', function (e) {
         $('.order_id_search_filter').addClass("filter_active");
        // Dtable.draw();
        applyFilters();
      });

      function applyFilters() {
         var checkedIds = [];
               $(".check_box_status input:checked").each(function () {
                  var ID = $(this).attr('id');
                  checkedIds.push(ID);
               });              

            const booking_no=document.getElementById('booking_no').value;           
            const payment_status=checkedIds;

            var filters = {
               payment_history_booking_no: booking_no,
               payment_history_payment_status: payment_status
            // ... Add other filters
            };
            sessionStorage.setItem('payment_history_filters', JSON.stringify(filters));
            Dtable.ajax.reload();   
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        payment_history_booking_no: "",
                        payment_history_payment_status: ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('payment_history_filters', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('payment_history_filters');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      
       payment_status = [];     
      var booking_no = filters.payment_history_booking_no;
       payment_status =filters.payment_history_payment_status;
console.log(payment_status);
      if(payment_status && payment_status.length > 0)
      {
$(".check_box_status input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.check_box_status').length) {
    // Checkbox belongs to the seat category group
    if (payment_status.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } 
});
      }

      $('#booking_no').val(booking_no);
      
      if(booking_no)
      {
         $('.order_id_search_filter ').addClass("filter_active");
      }
         
      if (payment_status && payment_status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(payment_status.length + " Selected");
      }
   

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('payment_history_filters'));

  // Check if sales_summary_seller_name has a value
  if (filters["payment_history_" + argName] && filters["payment_history_" + argName] !== "") {
    // Clear the remaining values while keeping the existing sales_summary_seller_name value
    filters["payment_history_" + argName] = "";
    filters = {

      payment_history_filters_booking_no: filters.payment_history_filters_booking_no,
      payment_history_filters_payment_status: filters.payment_history_filters_payment_status,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('payment_history_filters', JSON.stringify(filters));
}

});
</script>